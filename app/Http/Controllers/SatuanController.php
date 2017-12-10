<?php

namespace App\Http\Controllers;

use App\Satuan;
use Illuminate\Http\Request;
use Session;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return $satuan = Satuan::paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('satuan.create');
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
            'nama_satuan' => 'required|unique:satuans,nama_satuan',

        ]);

        $user_baru = Satuan::create([
            'nama_satuan' => $request->nama_satuan]);

        Session::flash("flash_notification", [
            "level"   => "success",
            "message" => " <b>BERHASIL:</b> Menambah Satuan <b>$request->nama_satuan </b>",
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
        return $satuan = Satuan::find($id);
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

            'nama_satuan' => 'required|unique:satuans,nama_satuan,' . $id,

        ]);

        // update user
        $satuan = Satuan::find($id)->update([
            'nama_satuan' => $request->nama_satuan,
        ]);

        if ($satuan) {
            return response(200);
        } else {
            return response(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // jika gagal hapus
        if (!Satuan::destroy($id)) {
            return response(500);
        } else {
            return response(200);
        }

    }
}
