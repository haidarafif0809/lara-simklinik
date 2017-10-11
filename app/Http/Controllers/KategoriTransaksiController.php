<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;
use App\KategoriTransaksi;
use Session;

class KategoriTransaksiController extends Controller
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
            $kategori = KategoriTransaksi::all();
            return Datatables::of($kategori)
         ->addColumn('action', function($master_kategori_transaksi){
                    return view('kategori_transaksi._action', [
                        'model'     => $master_kategori_transaksi,
                        'form_url'  => route('kategori_transaksi.destroy', $master_kategori_transaksi->id),
                        'edit_url'  => route('kategori_transaksi.edit', $master_kategori_transaksi->id),
                        'confirm_message'   => 'Yakin Mau Menghapus kategori transaksi ' . $master_kategori_transaksi->name . '?'
                   
                        ]); 
                })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'nama_kategori_transaksi', 'name' => 'nama_kategori_transaksi', 'title' => 'Nama'])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable'=>false]);

        return view('kategori_transaksi.index')->with(compact('html'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //

        return view('kategori_transaksi.create');
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
            'nama_kategori_transaksi'   => 'required|unique:kategori_transaksis,nama_kategori_transaksi',
           
            
            ]);

         $kategori = KategoriTransaksi::create([ 
            'nama_kategori_transaksi' =>$request->nama_kategori_transaksi]);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>" <b>BERHASIL:</b> Menambah Kategori Transaksi <b>$request->nama_kategori_transaksi </b>"
            ]);

        return redirect()->route('kategori_transaksi.index');
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

         $kategori_transaksi = KategoriTransaksi::find($id);
       

        return view('kategori_transaksi.edit')->with(compact('kategori_transaksi'));
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
          
            'nama_kategori_transaksi'     => 'required|unique:kategori_transaksis,nama_kategori_transaksi,'.$id, 
          
            ]);

         // update user
         $kategori = KategoriTransaksi::find($id)->update([
                'nama_kategori_transaksi'  => $request->nama_kategori_transaksi
            ]);

 
    

         Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"BERHASIL:</b> Mengubah kategori $request->nama_kategori_transaksi"
            ]);

        return redirect()->route('kategori_transaksi.index');
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

          $kategori = KategoriTransaksi::find($id);
  

        // jika gagal hapus
        if (!KategoriTransaksi::destroy($id)) {
            // redirect back
            return redirect()->back();
        }else{
            Session::flash("flash_notification", [
                "level"     => "success",
                "message"   => "kategori ". $kategori->nama_kategori_transaksi ." Berhasil Di Hapus"
            ]);
        return redirect()->route('kategori_transaksi.index');
        }
    }
}
