<?php

namespace App\Http\Controllers;

use App\Suplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {

        return $suplier = Suplier::paginate(10);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('suplier.create');
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
            'nama_suplier' => 'required|unique:supliers,nama_suplier',

        ]);

        $suplier = Suplier::create([
            'nama_suplier'    => $request->nama_suplier,
            'alamat_suplier'  => $request->alamat_suplier,
            'no_telp_suplier' => $request->no_telp_suplier]);

        return $suplier;
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
        return $suplier = Suplier::find($id);

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

            'nama_suplier' => 'required|unique:supliers,nama_suplier,' . $id,

        ]);

        // update user
        $suplier = Suplier::find($id)->update([
            'nama_suplier'    => $request->nama_suplier,
            'alamat_suplier'  => $request->alamat_suplier,
            'no_telp_suplier' => $request->no_telp_suplier,
        ]);

        if ($suplier) {
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
        if (!Suplier::destroy($id)) {

            return response(500);
        } else {
            return response(200);
        }
    }
}
