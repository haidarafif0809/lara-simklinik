<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;
use App\Penjamin;
use Session;

class PenjaminController extends Controller
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
            $penjamin = Penjamin::all();
            return Datatables::of($penjamin)
         ->addColumn('action', function($master_penjamin){
                    return view('penjamin._action', [
                        'model'     => $master_penjamin,
                        'form_url'  => route('penjamin.destroy', $master_penjamin->id),
                        'edit_url'  => route('penjamin.edit', $master_penjamin->id),
                        'confirm_message'   => 'Yakin Mau Menghapus penjamin ' . $master_penjamin->name . '?'
                   
                        ]); 
                })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'nama_penjamin', 'name' => 'nama_penjamin', 'title' => 'Nama'])
        ->addColumn(['data' => 'alamat_penjamin', 'name' => 'alamat_penjamin', 'title' => 'Alamat'])
        ->addColumn(['data' => 'no_telp_penjamin', 'name' => 'no_telp_penjamin', 'title' => 'No Telp'])
         ->addColumn(['data' => 'level_harga', 'name' => 'level_harga', 'title' => 'Level Harga'])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable'=>false]);

        return view('penjamin.index')->with(compact('html'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

         return view ('penjamin.create');
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
            'nama_penjamin'   => 'required|unique:penjamins,nama_penjamin',
            'level_harga' => 'required'
           
            
            ]);

         $penjamin = Penjamin::create($request->all());

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>" <b>BERHASIL:</b> Menambah Penjamin <b>$request->nama_penjamin </b>"
            ]);

        return redirect()->route('penjamin.index');
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

         $penjamin = Penjamin::find($id);
       

        return view('penjamin.edit')->with(compact('penjamin'));
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
          
            'nama_penjamin'     => 'required|unique:penjamins,nama_penjamin,'.$id,
            'level_harga' => 'required' 
          
            ]);

         // update user
         $penjamin = Penjamin::find($id)->update($request->all());

 
    

         Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"BERHASIL:</b> Mengubah penjamin $request->nama_penjamin"
            ]);

        return redirect()->route('penjamin.index');
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
        $penjamin = Penjamin::find($id);
  

        // jika gagal hapus
        if (!Penjamin::destroy($id)) {
            // redirect back
            return redirect()->back();
        }else{
            Session::flash("flash_notification", [
                "level"     => "success",
                "message"   => "penjamin ". $penjamin->nama_penjamin ." Berhasil Di Hapus"
            ]);
        return redirect()->route('penjamin.index');
        }
    }
}
