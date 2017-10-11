<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;
use App\Kas;
use Session;



class KasController extends Controller
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
            $kas = Kas::all();
            return Datatables::of($kas)
         ->addColumn('action', function($master_kas){
                    return view('kas._action', [
                        'model'     => $master_kas,
                        'form_url'  => route('kas.destroy', $master_kas->id),
                        'edit_url'  => route('kas.edit', $master_kas->id),
                        'confirm_message'   => 'Yakin Mau Menghapus kas ' . $master_kas->name . '?'
                   
                        ]); 
                })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'kode_kas', 'name' => 'kode_kas', 'title' => 'Nama'])
        ->addColumn(['data' => 'nama_kas', 'name' => 'nama_kas', 'title' => 'Nama'])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable'=>false]);

        return view('kas.index')->with(compact('html'));


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('kas.create');
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
            'nama_kas'   => 'required|unique:kas,nama_kas',
            'kode_kas'   => 'required|unique:kas,kode_kas',
           
            
            ]);

         $kas = Kas::create($request->all());

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>" <b>BERHASIL:</b> Menambah Kas <b>$request->nama_kas </b>"
            ]);

        return redirect()->route('kas.index');
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

           $kas = Kas::find($id);
       

        return view('kas.edit')->with(compact('kas'));
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
          
            'nama_kas'     => 'required|unique:kas,nama_kas,'.$id, 
            'kode_kas'     => 'required|unique:kas,kode_kas,'.$id, 
          
            ]);

         $kas = Kas::find($id)->update( $request->all());

 
    

         Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"BERHASIL:</b> Mengubah Kas $request->nama_kas"
            ]);

        return redirect()->route('kas.index');
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
        $kas = Kas::find($id);
  

        // jika gagal hapus
        if (!Kas::destroy($id)) {
            // redirect back
            return redirect()->back();
        }else{
            Session::flash("flash_notification", [
                "level"     => "success",
                "message"   => "Kas ". $kas->nama_kas ." Berhasil Di Hapus"
            ]);
        return redirect()->route('kas.index');
        }
    }
}
