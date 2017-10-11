<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;
use App\Gudang;
use Session;

class GudangController extends Controller
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
            $gudang = Gudang::all();
            return Datatables::of($gudang)
         ->addColumn('action', function($master_gudang){
                    return view('gudang._action', [
                        'model'     => $master_gudang,
                        'form_url'  => route('gudang.destroy', $master_gudang->id),
                        'edit_url'  => route('gudang.edit', $master_gudang->id),
                        'confirm_message'   => 'Yakin Mau Menghapus gudang ' . $master_gudang->name . '?'
                   
                        ]); 
                })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'nama_gudang', 'name' => 'nama_gudang', 'title' => 'Nama'])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable'=>false]);

        return view('gudang.index')->with(compact('html'));


    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('gudang.create');
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
            'nama_gudang'   => 'required|unique:gudangs,nama_gudang',
           
            
            ]);

         $gudang = Gudang::create([ 
            'nama_gudang' =>$request->nama_gudang]);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>" <b>BERHASIL:</b> Menambah gudang <b>$request->nama_gudang </b>"
            ]);

        return redirect()->route('gudang.index');
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

         $gudang = Gudang::find($id);
       

        return view('gudang.edit')->with(compact('gudang'));
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
          
            'nama_gudang'     => 'required|unique:gudangs,nama_gudang,'.$id, 
          
            ]);

         // update user
         $gudang = Gudang::find($id)->update([
                'nama_gudang'  => $request->nama_gudang
            ]);

 
    

         Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"BERHASIL:</b> Mengubah gudang $request->nama_gudang"
            ]);

        return redirect()->route('gudang.index');
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
        $gudang = Gudang::find($id);
  

        // jika gagal hapus
        if (!Gudang::destroy($id)) {
            // redirect back
            return redirect()->back();
        }else{
            Session::flash("flash_notification", [
                "level"     => "success",
                "message"   => "gudang ". $gudang->nama_gudang ." Berhasil Di Hapus"
            ]);
        return redirect()->route('gudang.index');
        }
    }
}
