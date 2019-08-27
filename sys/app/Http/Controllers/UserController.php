<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Level;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data = User::whereNotIn('level_id', [1, 5])->get();
		$data = User::all();
        return view('user.index', compact('data'));
    }

    public function create()
    {
        $data = Level::all();
        return view('user.add', compact('data'));
    }


	public function store(Request $req)
    {
        
            $simpan=new User;
		    $simpan->level_id = $req->input('level_id');
            $simpan->name = $req -> input('name');
            $simpan->email = $req ->input('email');
            $simpan->password = hash::make($req->input('password'));
		    $simpan->status_aktif = $req -> input('status_aktif');
            $simpan->save();
		return redirect()->route('user.index')->with('alert-success', 'Berhasil Menambahkan Data!');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        $level = Level::whereNotIn('id', [1, 5])->get();
        return view('user.edit', compact('data', 'level'));
    }

    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);
        $input = $request->all();
        $data->update($input);
        return redirect()->route('user.index')->with('alert-success', 'Berhasil Update Data!');
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return redirect()->route('user.index')->with('alert-success', 'Berhasil Hapus Data!');
    }
}
