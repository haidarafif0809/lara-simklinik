<?php

namespace App\Http\Controllers;

use App\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return Poli::paginate(10);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('poli.create');
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
            'nama_poli' => 'required|unique:polis,nama_poli',

        ]);

        $poli = Poli::create([
            'nama_poli' => $request->nama_poli]);
        return $poli;
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

        return Poli::find($id);
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

            'nama_poli' => 'required|unique:polis,nama_poli,' . $id,

        ]);

        $poli = Poli::find($id)->update([
            'nama_poli' => $request->nama_poli,
        ]);

        if ($poli) {
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
        if (!Poli::destroy($id)) {
            return response(500);
        } else {

            return response(200);
        }
    }
}
