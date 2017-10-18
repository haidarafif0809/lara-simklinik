<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;
use Illuminate\Support\Facades\DB; 
use App\Pembelian;  
use App\TbsPembelian;  
use App\DetailPembelian;
use App\EditTbsPembelian;  
use App\Produk;  
use Session;
use Auth;
use Laratrust;


class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    { 
        if ($request->ajax()) { 
            $pembelian = Pembelian::all();
            return Datatables::of($pembelian)->addColumn('action', function($Pembelian){
              $detail_pembelian = DetailPembelian::with(['produk'])->where('no_faktur',$Pembelian->no_faktur)->get();
                    return view('pembelian._action', [
                        'model'     => $Pembelian,
                        'id_pembelian'     => $Pembelian->id,
                        'data_detail_pembelian'     => $detail_pembelian,
                        'form_url'  => route('pembelian.destroy', $Pembelian->id),
                        'edit_url'  => route('pembelian.proses_form_edit', $Pembelian->id),
                        'confirm_message'   => 'Yakin Mau Menghapus Item Masuk dengan nomor faktur ' . $Pembelian->no_faktur . '?',
                        ]);
                }) ->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'no_faktur', 'name' => 'no_faktur', 'title' => 'No. Faktur'])  
        ->addColumn(['data' => 'keterangan', 'name' => 'keterangan', 'title' => 'Keterangan']) 
        ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => 'Waktu']) 
        ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Waktu Edit'])  
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable'=>false]); 
        return view('pembelian.index')->with(compact('html'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 public function create(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) { 
            $session_id = session()->getId();
            $tbs_pembelian = TbsPembelian::with(['produk'])->where('session_id', $session_id)->get();
            return Datatables::of($tbs_pembelian)->addColumn('action', function($Pembelian){
                    return view('pembelian._hapus_produk', [
                        'model'     => $Pembelian,
                        'form_url'  => route('pembelian.proses_hapus_tbs_pembelian', $Pembelian->id_tbs_pembelian),  
                        'confirm_message'   => 'Yakin Mau Menghapus Produk ?'
                        ]);
                })
            ->editColumn('harga_produk', function($produk){
               return "<a href='#edit-harga' class='edit-harga' data-id='$produk->id_tbs_pembelian'>$produk->harga_produk</a>"; 
            })            
            ->editColumn('jumlah_produk', function($produk){
               return "<a href='#edit-jumlah' class='edit-jumlah' data-id='$produk->id_tbs_pembelian'>$produk->jumlah_produk</a>"; 
            })
            ->addColumn('data_produk_tbs', function($data_produk_tbs){ 
                    $produk = Produk::find($data_produk_tbs->id_produk);
                    $data_produk = $produk->kode_produk ." - ". $produk->nama_produk;          
                    return $data_produk;   
            })->rawColumns(['harga_produk','action','jumlah_produk'])->make(true);
        }

        $html = $htmlBuilder 
        ->addColumn(['data' => 'data_produk_tbs', 'name' => 'data_produk_tbs', 'title' => 'Produk', 'orderable' => false, 'searchable'=>false ]) 
        ->addColumn(['data' => 'harga_produk', 'name' => 'harga_produk', 'title' => 'Harga'])
        ->addColumn(['data' => 'jumlah_produk', 'name' => 'jumlah_produk', 'title' => 'Jumlah'])
        ->addColumn(['data' => 'total_harga', 'name' => 'total_harga', 'title' => 'Total'])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Hapus', 'orderable' => false, 'searchable'=>false]);

        $total_pembelian = TbsPembelian::sum('total_harga');

        return view('pembelian.create')->with(compact('html','total_pembelian'));
    }

     //PROSES TAMBAH TBS ITEM MASUK
    public function proses_tambah_tbs_pembelian(Request $request)
    { 
        $this->validate($request, [
            'id_produk'     => 'required|max:11|numeric',
            'jumlah_produk' => 'required|digits_between:1,15|numeric',
            ]);

        $session_id = session()->getId();

        $data_tbs = TbsPembelian::select('id_produk')
        ->where('id_produk', $request->id_produk)
        ->where('session_id', $session_id)
        ->count();

        $data_produk = Produk::select('nama_produk','harga_beli')->where('id', $request->id_produk)->first();
        $pesan_alert = "Produk '".$data_produk->nama_produk."' Sudah Ada, Silakan Pilih Produk Lain !";


      //JIKA PRODUK YG DIPILIH SUDAH ADA DI TBS
        if ($data_tbs > 0) {
            
            $pesan_alert = 
               '<div class="container-fluid">
                    <div class="alert-icon">
                    <i class="material-icons">warning</i>
                    </div>
                    <b>Warning : Produk "'.$data_produk->nama_produk.'" Sudah Ada, Silakan Pilih Produk Lain !</b>
                </div>';

            Session::flash("flash_notification", [
              "level"=>"warning",
              "message"=> $pesan_alert
            ]); 

            return back();
        }
        else{

           $pesan_alert = 
             '<div class="container-fluid">
                  <div class="alert-icon">
                  <i class="material-icons">check</i>
                  </div>
                  <b>Sukses : Berhasil Menambah Produk "'.$data_produk->nama_produk.'"</b>
              </div>';

            $tbsPembelian = TbsPembelian::create([
                'id_produk' =>$request->id_produk,            
                'session_id' => $session_id,
                'jumlah_produk' =>$request->jumlah_produk,
                'harga_produk' => $data_produk->harga_beli,
                'total_harga' => $data_produk->harga_beli * $request->jumlah_produk
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=> $pesan_alert
            ]);
            return back();

        }
    }


    public function proses_edit_harga(Request $request){

        $tbs_pembelian = TbsPembelian::find($request->id_tbs_pembelian);

        $tbs_pembelian->update(['harga_produk' => $request->harga_beli_baru,'total_harga' => $request->harga_beli_baru * $tbs_pembelian->jumlah_produk ]);
        $nama_produk = $tbs_pembelian->produk->nama_produk;

        $pesan_alert = 
               "<div class='container-fluid'>
                    <div class='alert-icon'>
                    <i class='material-icons'>check</i>
                    </div>
                    <b>Sukses : Berhasil Mengubah Harga Beli $nama_produk </b>
                </div>";

            Session::flash("flash_notification", [
                "level"     => "success",
                "message"   => $pesan_alert
            ]);

        return redirect()->back();

    }
    public function proses_edit_jumlah(Request $request){

        $tbs_pembelian = TbsPembelian::find($request->id_tbs_pembelian);

        $tbs_pembelian->update(['jumlah_produk' => $request->jumlah_beli_baru,'total_harga' => $request->jumlah_beli_baru * $tbs_pembelian->harga_produk ]);
        $nama_produk = $tbs_pembelian->produk->nama_produk;

        $pesan_alert = 
               "<div class='container-fluid'>
                    <div class='alert-icon'>
                    <i class='material-icons'>check</i>
                    </div>
                    <b>Sukses : Berhasil Mengubah Jumlah Beli $nama_produk </b>
                </div>";

            Session::flash("flash_notification", [
                "level"     => "success",
                "message"   => $pesan_alert
            ]);

        return redirect()->back();

    }

      //PROSES HAPUS TBS ITEM MASUK
    public function proses_hapus_tbs_pembelian($id)
    { 
        if (!TbsPembelian::destroy($id)) {
          $pesan_alert = 
               '<div class="container-fluid">
                    <div class="alert-icon">
                    <i class="material-icons">check</i>
                    </div>
                    <b>Gagal : Menghapus Produk</b>
                </div>';

            Session::flash("flash_notification", [
                "level"     => "danger",
                "message"   => $pesan_alert
            ]);
        return back();
        }
        else{
          $pesan_alert = 
               '<div class="container-fluid">
                    <div class="alert-icon">
                    <i class="material-icons">check</i>
                    </div>
                    <b>Sukses : Berhasil Menghapus Produk</b>
                </div>';

            Session::flash("flash_notification", [
                "level"     => "success",
                "message"   => $pesan_alert
            ]);
        return back();
        }
    }

        //PROSES BATAL ITEM MASUK
    public function proses_hapus_semua_tbs_pembelian()
    { 
        $session_id = session()->getId();
        $data_tbs_pembelian = TbsPembelian::where('session_id', $session_id)->delete(); 
        $pesan_alert = 
               '<div class="container-fluid">
                    <div class="alert-icon">
                    <i class="material-icons">check</i>
                    </div>
                    <b>Sukses : Berhasil Membatalkan Pembelian</b>
                </div>';

            Session::flash("flash_notification", [
                "level"     => "success",
                "message"   => $pesan_alert
            ]);
       return redirect()->route('pembelian.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
