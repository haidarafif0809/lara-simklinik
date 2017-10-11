<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Role; 
use App\Otoritas; 
use Auth;
use App\Permission;
use Session;
use App\PermissionRole;
use Laratrust;

class OtoritasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $otoritas = Role::select(['id','name','display_name','description']);
            return Datatables::of($otoritas)->addColumn('action', function($otoritas){
                return view('otoritas._action', [
                    'model'             => $otoritas,
                    'form_url'          => route('otoritas.destroy', $otoritas->id),
                    'edit_url'          => route('otoritas.edit', $otoritas->id),
                    'permission_url'          => route('otoritas.permission', $otoritas->id),
                    'confirm_message'   => 'Apakah Anda Yakin Ingin Menghapus Otoritas' .$otoritas->name. '?'
                ]);
            })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'name', 'name' => 'name', 'title' => 'Nama'])
        ->addColumn(['data' => 'display_name', 'name' => 'display_name', 'title' => 'Display Nama'])
        ->addColumn(['data' => 'description', 'name' => 'description', 'title' => 'Deskripsi'])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable' => false]);

        return view('otoritas.index')->with(compact('html'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }




    public function permission($id){

        return view('otoritas.permission');
    }
}
