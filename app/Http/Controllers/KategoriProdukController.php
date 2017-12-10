<?php

namespace App\Http\Controllers;

use App\KategoriProduk;
use Illuminate\Http\Request;
use Session;
use Yajra\DataTables\Datatables;
use Yajra\DataTables\Html\Builder;

class KategoriProdukController extends Controller
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
            $kategori = KategoriProduk::all();
            return Datatables::of($kategori)
                ->addColumn('action', function ($master_kategori) {
                    return view('kategori._action', [
                        'model'           => $master_kategori,
                        'form_url'        => route('kategori.destroy', $master_kategori->id),
                        'edit_url'        => route('kategori.edit', $master_kategori->id),
                        'confirm_message' => 'Yakin Mau Menghapus kategori ' . $master_kategori->name . '?',

                    ]);
                })->make(true);
        }
        $html = $htmlBuilder
            ->addColumn(['data' => 'nama_kategori', 'name' => 'nama_kategori', 'title' => 'Nama'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable' => false]);

        return view('kategori.index')->with(compact('html'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('kategori.create');
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
            'nama_kategori' => 'required|unique:kategori_produks,nama_kategori',

        ]);

        $user_baru = KategoriProduk::create([
            'nama_kategori' => $request->nama_kategori]);

        Session::flash("flash_notification", [
            "level"   => "success",
            "message" => " <b>BERHASIL:</b> Menambah Kategori Produk <b>$request->nama_kategori </b>",
        ]);

        return redirect()->route('kategori.index');
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
        return $kategori = KategoriProduk::find($id);

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

        $kategori = KategoriProduk::find($id);

        return view('kategori.edit')->with(compact('kategori'));
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

            'nama_kategori' => 'required|unique:kategori_produks,nama_kategori,' . $id,

        ]);

        // update user
        $kategori = KategoriProduk::find($id)->update([
            'nama_kategori' => $request->nama_kategori,
        ]);
        if ($kategori) {
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
        if (!KategoriProduk::destroy($id)) {
            // redirect back
            return response(500);
        } else {
            return response(200);
        }
    }
}
