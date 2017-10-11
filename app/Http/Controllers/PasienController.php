<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;
use App\Pasien;
use Session;


class PasienController extends Controller
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
            $pasien = Pasien::all();
            return Datatables::of($pasien)
         ->addColumn('action', function($master_pasien){
                    return view('pasien._action', [
                        'model'     => $master_pasien,
                        'form_url'  => route('pasien.destroy', $master_pasien->id),
                        'edit_url'  => route('pasien.edit', $master_pasien->id),
                        'confirm_message'   => 'Yakin Mau Menghapus pasien ' . $master_pasien->name . '?'
                   
                        ]); 
                })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'nama_pasien', 'name' => 'nama_pasien', 'title' => 'Nama'])
         ->addColumn(['data' => 'jenis_kelamin', 'name' => 'jenis_kelamin', 'title' => 'Jenis Kelamin'])
          ->addColumn(['data' => 'alamat_pasien', 'name' => 'alamat_pasien', 'title' => 'Alamat'])
           ->addColumn(['data' => 'no_telp_pasien', 'name' => 'no_telp_pasien', 'title' => 'No Telp'])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable'=>false]);

        return view('pasien.index')->with(compact('html'));


    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

                return view ('pasien.create');
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

          //

          // // proses tambah user
         $this->validate($request, [
            'nama_pasien'   => 'required|unique:pasiens,nama_pasien',
           
            
            ]);

         $pasien = Pasien::create($request->all());

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>" <b>BERHASIL:</b> Menambah pasien <b>$request->nama_pasien </b>"
            ]);

        return redirect()->route('pasien.index');
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

        $pasien = Pasien::find($id);
       

        return view('pasien.edit')->with(compact('pasien'));
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
          
            'nama_pasien'     => 'required|unique:pasiens,nama_pasien,'.$id, 
          
            ]);

         // update user
         $pasien = Pasien::find($id)->update($request->all());

 
    

         Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"BERHASIL:</b> Mengubah pasien $request->nama_pasien"
            ]);

        return redirect()->route('pasien.index');
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
        $pasien = Pasien::find($id);
  

        // jika gagal hapus
        if (!Pasien::destroy($id)) {
            // redirect back
            return redirect()->back();
        }else{
            Session::flash("flash_notification", [
                "level"     => "success",
                "message"   => "pasien ". $pasien->nama_pasien ." Berhasil Di Hapus"
            ]);
        return redirect()->route('pasien.index');
        }
    }
}
