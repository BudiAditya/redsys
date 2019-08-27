<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyek;
use Auth;

class ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = Proyek::where('is_delete',0)->get();
        return view('proyek.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proyek.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Proyek();
        $data->entity_id = $request->entity_id;
        $data->kode = $request->kode;
        $data->nama = $request->nama;
        $data->lokasi = $request->lokasi;
        $data->owner = $request->owner;
        $data->anggaran = $request->anggaran;
        $data->tgl_mulai = date('Y-m-d',strtotime($request->tgl_mulai));
        $data->tgl_selesai = date('Y-m-d',strtotime($request->tgl_selesai));
        $data->status = $request->status;
        $data->createdby_id = Auth::user()->id;
	    	$data->save();
		    return redirect()->route('proyek.index')->with('alert-success', 'Berhasil Menambahkan Data!');
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
        $data = Proyek::where('id', $id)->get();
		    return view('proyek.edit', compact('data'));
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
        $data = Proyek::where('id', $id)->first();
        $data->entity_id = $request->entity_id;
        $data->kode = $request->kode;
        $data->nama = $request->nama;
        $data->lokasi = $request->lokasi;
        $data->owner = $request->owner;
        $data->anggaran = $request->anggaran;
        $data->tgl_mulai = date('Y-m-d',strtotime($request->tgl_mulai));
        $data->tgl_selesai = date('Y-m-d',strtotime($request->tgl_selesai));
        $data->status = $request->status;
        $data->updateby_id = Auth::user()->id;
		    $data->save();
		    return redirect()->route('proyek.index')->with('alert-success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Proyek::where('id', $id)->first();
        $data->is_delete=1;
        $data->save();
        // if($data->unitrumahs()->count()==0){
        //     $data->delete();
            return redirect()->route('proyek.index')->with('alert-success', 'Data berhasi dihapus!');
        // }else{
        //     return redirect()->route('proyek.index')->with('alert-success', 'Data Gagal dihapus karena memiliki Relasi!');
        // }
    }
}
