<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;
use App\Poli;
use Session;

class PoliController extends Controller
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
            $poli = Poli::all();
            return Datatables::of($poli)
         ->addColumn('action', function($master_poli){
                    return view('poli._action', [
                        'model'     => $master_poli,
                        'form_url'  => route('poli.destroy', $master_poli->id),
                        'edit_url'  => route('poli.edit', $master_poli->id),
                        'confirm_message'   => 'Yakin Mau Menghapus poli ' . $master_poli->name . '?'
                   
                        ]); 
                })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'nama_poli', 'name' => 'nama_poli', 'title' => 'Nama'])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable'=>false]);

        return view('poli.index')->with(compact('html'));


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

               return view ('poli.create');
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
            'nama_poli'   => 'required|unique:polis,nama_poli',
           
            
            ]);

         $poli = Poli::create([ 
            'nama_poli' =>$request->nama_poli]);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>" <b>BERHASIL:</b> Menambah Poli <b>$request->nama_poli </b>"
            ]);

        return redirect()->route('poli.index');
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

         $poli = Poli::find($id);
       

        return view('poli.edit')->with(compact('poli'));
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
          
            'nama_poli'     => 'required|unique:polis,nama_poli,'.$id, 
          
            ]);

         // update user
         $poli = Poli::find($id)->update([
                'nama_poli'  => $request->nama_poli
            ]);

 
    

         Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"BERHASIL:</b> Mengubah poli $request->nama_poli"
            ]);

        return redirect()->route('poli.index');
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
        $poli = Poli::find($id);
  

        // jika gagal hapus
        if (!Poli::destroy($id)) {
            // redirect back
            return redirect()->back();
        }else{
            Session::flash("flash_notification", [
                "level"     => "success",
                "message"   => "Poli ". $poli->nama_poli ." Berhasil Di Hapus"
            ]);
        return redirect()->route('poli.index');
        }
    }
}
