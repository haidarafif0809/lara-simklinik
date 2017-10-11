<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;
use App\Suplier;
use Session;

class SuplierController extends Controller
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
            $suplier = suplier::all();
            return Datatables::of($suplier)
         ->addColumn('action', function($master_suplier){
                    return view('suplier._action', [
                        'model'     => $master_suplier,
                        'form_url'  => route('suplier.destroy', $master_suplier->id),
                        'edit_url'  => route('suplier.edit', $master_suplier->id),
                        'confirm_message'   => 'Yakin Mau Menghapus suplier ' . $master_suplier->name . '?'
                   
                        ]); 
                })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'nama_suplier', 'name' => 'nama_suplier', 'title' => 'Nama'])    
        ->addColumn(['data' => 'alamat_suplier', 'name' => 'alamat_suplier', 'title' => 'Alamat'])   
         ->addColumn(['data' => 'no_telp_suplier', 'name' => 'no_telp_suplier', 'title' => 'No Telp'])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable'=>false]);

        return view('suplier.index')->with(compact('html'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

         return view ('suplier.create');
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
            'nama_suplier'   => 'required|unique:supliers,nama_suplier',
           
            
            ]);

         $suplier = Suplier::create([ 
            'nama_suplier' =>$request->nama_suplier,
            'alamat_suplier' => $request->alamat_suplier,
            'no_telp_suplier' => $request->no_telp_suplier]);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>" <b>BERHASIL:</b> Menambah suplier <b>$request->nama_suplier </b>"
            ]);

        return redirect()->route('suplier.index');
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

          $suplier = Suplier::find($id);
       

        return view('suplier.edit')->with(compact('suplier'));
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
          
            'nama_suplier'     => 'required|unique:supliers,nama_suplier,'.$id, 
          
            ]);

         // update user
         $suplier = Suplier::find($id)->update([
                'nama_suplier'  => $request->nama_suplier,
            'alamat_suplier' => $request->alamat_suplier,
            'no_telp_suplier' => $request->no_telp_suplier
            ]);

 
    

         Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"BERHASIL:</b> Mengubah suplier $request->nama_suplier"
            ]);

        return redirect()->route('suplier.index');
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
        $suplier = Suplier::find($id);
  

        // jika gagal hapus
        if (!Suplier::destroy($id)) {
            // redirect back
            return redirect()->back();
        }else{
            Session::flash("flash_notification", [
                "level"     => "success",
                "message"   => "suplier ". $suplier->nama_suplier ." Berhasil Di Hapus"
            ]);
        return redirect()->route('suplier.index');
        }
    }
}
