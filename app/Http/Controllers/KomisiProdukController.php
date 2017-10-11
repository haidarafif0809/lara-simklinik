<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;
use App\KomisiProduk;
use Session;
use Illuminate\Validation\Rule;

class KomisiProdukController extends Controller
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
            $komisi = KomisiProduk::with(['produk','petugas']);
            return Datatables::of($komisi)
         ->addColumn('action', function($master_komisi){
                    return view('komisi._action', [
                        'model'     => $master_komisi,
                        'form_url'  => route('komisi.destroy', $master_komisi->id_komisi),
                        'edit_url'  => route('komisi.edit', $master_komisi->id_komisi),
                        'confirm_message'   => 'Yakin Mau Menghapus komisi ' . $master_komisi->name . '?'
                   
                        ]); 
                })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'produk.nama_produk', 'name' => 'produk.nama_produk', 'title' => 'Produk'])
        ->addColumn(['data' => 'petugas.name', 'name' => 'petugas.name', 'title' => 'Petugas'])
        ->addColumn(['data' => 'prosentase', 'name' => 'prosentase', 'title' => 'prosentase'])
        ->addColumn(['data' => 'nominal', 'name' => 'nominal', 'title' => 'nominal'])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable'=>false]);

        return view('komisi.index')->with(compact('html'));


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('komisi.create');
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


         $this->validate($request, [
            'produk'   => ['required',
            Rule::unique('komisi_produks')->where(function ($query) use ($request) {
                return $query->where('petugas', $request->petugas);
            }) ],
            'petugas' => 'required',            
            ]);

         $komisi = KomisiProduk::create($request->all());

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>" <b>BERHASIL:</b> Menambah Komisi Produk <b> </b>"
            ]);

        return redirect()->route('komisi.index');
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

           $komisi = KomisiProduk::find($id);
       

        return view('komisi.edit')->with(compact('komisi'));
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
            'produk'   => ['required',
            Rule::unique('komisi_produks')->where(function ($query) use ($request,$id) {
                return $query->where('petugas', $request->petugas)->where('id_komisi','!=',$id);
            }) ],
            'petugas' => 'required',            
            ]);
         // update user
         $komisi = KomisiProduk::find($id)->update($request->all());

 
    

         Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"BERHASIL:</b> Mengubah komisi "
            ]);

        return redirect()->route('komisi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
           // hapus 
        $komisi = KomisiProduk::find($id);
  

        // jika gagal hapus
        if (!KomisiProduk::destroy($id)) {
            // redirect back
            return redirect()->back();
        }else{
            Session::flash("flash_notification", [
                "level"     => "success",
                "message"   => "komisi Berhasil Di Hapus"
            ]);
        return redirect()->route('komisi.index');
        }
    }
}
