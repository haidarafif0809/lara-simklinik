<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;
use App\KasMutasi;
use Session;
use App\TransaksiKas;


class KasMutasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 public function index(Request $request, Builder $htmlBuilder)
    {
        //


         if ($request->ajax()) {
            # code...
            $kas_mutasi = KasMutasi::with(['dari_kas','ke_kas']);
            return Datatables::of($kas_mutasi)
         ->addColumn('action', function($master_kas_mutasi){
                    return view('kas_mutasi._action', [
                        'model'     => $master_kas_mutasi,
                        'form_url'  => route('kas_mutasi.destroy', $master_kas_mutasi->id),
                        'edit_url'  => route('kas_mutasi.edit', $master_kas_mutasi->id),
                        'confirm_message'   => 'Yakin Mau Menghapus kas mutasi ' . $master_kas_mutasi->no_faktur . '?'
                   
                        ]); 
                })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'no_faktur', 'name' => 'no_faktur', 'title' => 'No Faktur'])
        ->addColumn(['data' => 'dari_kas.nama_kas', 'name' => 'dari_kas.nama_kas', 'title' => 'Dari Kas'])
        ->addColumn(['data' => 'ke_kas.nama_kas', 'name' => 'ke_kas.nama_kas', 'title' => 'Ke Kas'])
      
        ->addColumn(['data' => 'jumlah', 'name' => 'jumlah', 'title' => 'Jumlah'])
        ->addColumn(['data' => 'keterangan', 'name' => 'jumlah', 'title' => 'Keterangan'])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable'=>false]);

        return view('kas_mutasi.index')->with(compact('html'));


    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

          return view('kas_mutasi.create');
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

         // // proses tambah user
         $this->validate($request, [
            'dari_kas'   => 'required',
            'ke_kas'   => 'required',
            'jumlah'   => 'required|numeric',
            'keterangan'   => 'max:150', 
            
            ]);


         $no_faktur = KasMutasi::no_faktur();
 
         $kas = KasMutasi::create(['no_faktur' => $no_faktur,'dari_kas' => $request->dari_kas,'ke_kas' => $request->ke_kas,'jumlah' => $request->jumlah,'keterangan' => $request->keterangan]);

         //kas keluar 
         TransaksiKas::create(['no_faktur' => $no_faktur,'jenis_transaksi'=>'kas_mutasi' ,'jumlah_keluar' => $request->jumlah,'kas' => $request->dari_kas] ); 
         //kas masuk
         TransaksiKas::create(['no_faktur' => $no_faktur,'jenis_transaksi'=>'kas_mutasi' ,'jumlah_masuk' => $request->jumlah,'kas' => $request->ke_kas] );

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>" <b>BERHASIL:</b> Memutasikan Kas Sejumlah $request->jumlah  </b>"
            ]);

        return redirect()->route('kas_mutasi.index');
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


        $kas_mutasi = KasMutasi::find($id);
       

        return view('kas_mutasi.edit')->with(compact('kas_mutasi'));
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


         $this->validate($request, [
            'dari_kas'   => 'required',
            'ke_kas'   => 'required',
            'jumlah'   => 'required|numeric',
            'keterangan'   => 'max:150', 
            
            ]);
         $kas = KasMutasi::find($id)->update(['dari_kas' => $request->dari_kas,'ke_kas' => $request->ke_kas,'jumlah' => $request->jumlah,'keterangan' => $request->keterangan]);

         $kas_mutasi = KasMutasi::find($id);


        TransaksiKas::where('no_faktur' , $kas_mutasi->no_faktur)->where('jumlah_masuk','>',0)->update(['jumlah_masuk' => $request->jumlah,'kas' => $request->ke_kas] );
        TransaksiKas::where('no_faktur' , $kas_mutasi->no_faktur)->where('jumlah_keluar','>',0)->update(['jumlah_keluar' => $request->jumlah,'kas' => $request->dari_kas] );
    

         Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"BERHASIL:</b> Mengubah Kas Mutasi $kas_mutasi->no_faktur"
            ]);

        return redirect()->route('kas_mutasi.index');
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


          $kas = KasMutasi::find($id);
          
          TransaksiKas::where('no_faktur',$kas->no_faktur())->delete();
  

        // jika gagal hapus
        if (!KasMutasi::destroy($id)) {
            // redirect back
            return redirect()->back();
        }else{
            Session::flash("flash_notification", [
                "level"     => "success",
                "message"   => "Kas Mutasi ". $kas->no_faktur ." Berhasil Di Hapus"
            ]);
        return redirect()->route('kas_mutasi.index');
        }
    }
}
