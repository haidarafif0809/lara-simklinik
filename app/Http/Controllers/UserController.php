<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;
use App\User;
use Session;

class UserController extends Controller
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
            $users = User::all();
            return Datatables::of($users)
         ->addColumn('action', function($master_user){
                    return view('user._action', [
                        'model'     => $master_user,
                        'form_url'  => route('user.destroy', $master_user->id),
                        'edit_url'  => route('user.edit', $master_user->id),
                        'confirm_message'   => 'Yakin Mau Menghapus User ' . $master_user->name . '?'
                   
                        ]); 
                })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'name', 'name' => 'name', 'title' => 'Nama'])
        ->addColumn(['data' => 'email', 'name' => 'email', 'title' => 'Username'])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable'=>false]);

        return view('user.index')->with(compact('html'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('user.create');
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
            'name'   => 'required',
            'email'     => 'required|unique:users,email', 
            
            ]);

         $user_baru = User::create([ 
            'name' =>$request->name,
            'email'=>$request->email,
            'password' => 'rahasia']);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>" <b>BERHASIL:</b> Menambah User <b>$request->name</b>"
            ]);

        return redirect()->route('user.index');
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

        $user = User::find($id);
       

        return view('user.edit')->with(compact('user'));
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
            'name'      => 'required',
            'email'     => 'required|unique:users,email,'.$id, 
          
            ]);

         // update user
         $user = User::where('id',$id)->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);

 
    

         Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"BERHASIL:</b> Mengubah User $request->name"
            ]);

        return redirect()->route('user.index');
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
        $user = User::find($id);
  

        // jika gagal hapus
        if (!User::destroy($id)) {
            // redirect back
            return redirect()->back();
        }else{
            Session::flash("flash_notification", [
                "level"     => "success",
                "message"   => "User ". $user->name ." Berhasil Di Hapus"
            ]);
        return redirect()->route('user.index');
        }
    }
}
