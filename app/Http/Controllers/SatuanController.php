<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;
use App\Satuan;
use Session;


class SatuanController extends Controller
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
            $satuan = Satuan::all();
            return Datatables::of($satuan)
         ->addColumn('action', function($master_satuan){
                    return view('satuan._action', [
                        'model'     => $master_satuan,
                        'form_url'  => route('satuan.destroy', $master_satuan->id),
                        'edit_url'  => route('satuan.edit', $master_satuan->id),
                        'confirm_message'   => 'Yakin Mau Menghapus satuan ' . $master_satuan->name . '?'
                   
                        ]); 
                })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'nama_satuan', 'name' => 'nama_satuan', 'title' => 'Nama'])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable'=>false]);

        return view('satuan.index')->with(compact('html'));


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view ('satuan.create');
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
            'nama_satuan'   => 'required|unique:satuans,nama_satuan',
           
            
            ]);

         $user_baru = Satuan::create([ 
            'nama_satuan' =>$request->nama_satuan]);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>" <b>BERHASIL:</b> Menambah Satuan <b>$request->nama_satuan </b>"
            ]);

        return redirect()->route('satuan.index');
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
          $satuan = Satuan::find($id);
       

        return view('satuan.edit')->with(compact('satuan'));
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
          
            'nama_satuan'     => 'required|unique:satuans,nama_satuan,'.$id, 
          
            ]);

         // update user
         $satuan = Satuan::find($id)->update([
                'nama_satuan'  => $request->nama_satuan
            ]);

 
    

         Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"BERHASIL:</b> Mengubah Satuan $request->nama_satuan"
            ]);

        return redirect()->route('satuan.index');
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
        $satuan = Satuan::find($id);
  

        // jika gagal hapus
        if (!Satuan::destroy($id)) {
            // redirect back
            return redirect()->back();
        }else{
            Session::flash("flash_notification", [
                "level"     => "success",
                "message"   => "Satuan ". $satuan->nama_satuan ." Berhasil Di Hapus"
            ]);
        return redirect()->route('satuan.index');
    }

    }
}
