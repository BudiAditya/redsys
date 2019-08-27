<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pekerja;
use Auth;

class PekerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = Pekerja::where('is_delete',0)->get();
        return view('pekerja.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pekerja.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Pekerja();
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->hp_no = $request->hp_no;
        $data->keterangan = $request->keterangan;
        $data->createdby_id = Auth::user()->id;
        $data->status = $request->status_pekerja;
	    	$data->save();
		    return redirect()->route('pekerja.index')->with('alert-success', 'Berhasil Menambahkan Data!');
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
        $data = Pekerja::where('id', $id)->get();
		    return view('pekerja.edit', compact('data'));
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
        $data = Pekerja::where('id', $id)->first();
		    $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->hp_no = $request->hp_no;
        $data->keterangan = $request->keterangan;
        $data->status = $request->status_pekerja;
        $data->updateby_id = Auth::user()->id;
		    $data->save();
		    return redirect()->route('pekerja.index')->with('alert-success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pekerja::where('id', $id)->first();
        $data->is_delete=1;
        $data->save();
        // if($data->unitrumahs()->count()==0){
        //     $data->delete();
            return redirect()->route('pekerja.index')->with('alert-success', 'Data berhasi dihapus!');
        // }else{
        //     return redirect()->route('pekerja.index')->with('alert-success', 'Data Gagal dihapus karena memiliki Relasi!');
        // }
    }
}
