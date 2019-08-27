<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use Auth;
use App\Bagian;
class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data=Karyawan::where('is_delete',0)->get();
        return view('karyawan.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bagians = Bagian::where('is_delete',0)->get();
        return view('karyawan.create',compact('bagians'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Karyawan();
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        // $data->bagian = $request->bagian;
        $data->hp_no = $request->hp_no;
        $data->keterangan = $request->keterangan;
        $data->bagian_id = $request->bagian_id;
        $data->createdby_id = Auth::user()->id;
	    $data->save();
		return redirect()->route('karyawan.index')->with('alert-success', 'Berhasil Menambahkan Data!');
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
        $data = Karyawan::where('id', $id)->get();
        $bagians = Bagian::where('is_delete',0)->get();
        return view('karyawan.edit', compact('data','bagians'));
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
        $data = Karyawan::where('id', $id)->first();
		$data->nama = $request->nama;
        $data->alamat = $request->alamat;
        // $data->bagian = $request->bagian;
        $data->hp_no = $request->no_hp;
        $data->bagian_id = $request->bagian_id;
        $data->keterangan = $request->keterangan;
        $data->updateby_id = Auth::user()->id;
		$data->save();
		return redirect()->route('karyawan.index')->with('alert-success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Karyawan::where('id', $id)->first();
		// if($data->unit_arsiteks()->count()==0 && $data->unit_marketings()->count()==0 && $data->unit_pengawases()->count()==0){
            $data->is_delete=1;
            $data->save();

            return redirect()->route('karyawan.index')->with('alert-success', 'Data berhasi dihapus!');
        // }else{
        //     return redirect()->route('karyawan.index')->with('alert-success', 'Data Gagal dihapus karena memiliki Relasi!');
        // }
    }
}
