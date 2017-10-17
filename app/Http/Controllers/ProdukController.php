<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;
use App\Produk;
use Session;

class ProdukController extends Controller
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
            $produk = produk::with(['satuan','kategori']);
            return Datatables::of($produk)
         ->addColumn('action', function($master_produk){
                    return view('produk._action', [
                        'model'     => $master_produk,
                        'form_url'  => route('produk.destroy', $master_produk->id),
                        'edit_url'  => route('produk.edit', $master_produk->id),
                        'confirm_message'   => 'Yakin Mau Menghapus produk ' . $master_produk->name . '?'
                   
                        ]); 
                })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'kode_produk', 'name' => 'kode_produk', 'title' => 'Kode'])
        ->addColumn(['data' => 'nama_produk', 'name' => 'nama_produk', 'title' => 'Nama'])
     
        ->addColumn(['data' => 'kategori.nama_kategori', 'name' => 'kategori', 'title' => 'Tipe Kategori']) 
        ->addColumn(['data' => 'harga_beli', 'name' => 'harga_beli', 'title' => 'Harga Beli']) 
        ->addColumn(['data' => 'harga_jual_1', 'name' => 'harga_jual_1', 'title' => 'Harga Jual 1']) 
        ->addColumn(['data' => 'harga_jual_2', 'name' => 'harga_jual_2', 'title' => 'Harga Jual 2'])
        ->addColumn(['data' => 'harga_jual_3', 'name' => 'harga_jual_3', 'title' => 'Harga Jual 3'])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable'=>false]);

        return view('produk.index')->with(compact('html'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

              return view ('produk.create');
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
            'nama_produk'   => 'required|unique:produks,nama_produk',
            'kode_produk'   => 'required|unique:produks,kode_produk',
            'harga_jual_1' => 'required',
            'kategori' => 'required',
            'tipe_produk' => 'required',
            'satuan' => 'required'
           
            
            ]);

         $produk = Produk::create($request->all());

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>" <b>BERHASIL:</b> Menambah produk <b>$request->nama_produk </b>"
            ]);

        return redirect()->route('produk.index');
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

        $produk = Produk::find($id);
       

        return view('produk.edit')->with(compact('produk'));
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
            'nama_produk'   => 'required|unique:produks,nama_produk,'.$id,
            'kode_produk'   => 'required|unique:produks,kode_produk,'.$id,
            'harga_jual_1' => 'required',
            'kategori' => 'required',
            'tipe_produk' => 'required' ,
            'satuan' => 'required' 
          
            ]);

         // update user
         $produk = Produk::find($id)->update($request->all());

 
    

         Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"BERHASIL:</b> Mengubah produk $request->nama_produk"
            ]);

        return redirect()->route('produk.index');
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

             // hapus 
        $produk = Produk::find($id);
  

        // jika gagal hapus
        if (!Produk::destroy($id)) {
            // redirect back
            return redirect()->back();
        }else{
            Session::flash("flash_notification", [
                "level"     => "success",
                "message"   => "Produk ". $produk->nama_produk ." Berhasil Di Hapus"
            ]);
        return redirect()->route('produk.index');
        }
    }
}
