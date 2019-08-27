<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KatPekerjaan;
use App\Pekerjaan;
use Auth;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = Pekerjaan::where('is_delete',0)->get();
        return view('pekerjaan.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoripekerjaans = KatPekerjaan::all();
        return view('pekerjaan.create',compact('kategoripekerjaans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Pekerjaan();
        $data->kategori_id = $request->kategori_id;
        $data->pekerjaan = $request->pekerjaan;
        $data->satuan = $request->satuan;
        $data->std_harga = $request->std_harga;
        $data->keterangan = $request->keterangan;
        $data->createdby_id = Auth::user()->id;
	    	$data->save();
		    return redirect()->route('pekerjaan.index')->with('alert-success', 'Berhasil Menambahkan Data!');
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
        $data = Pekerjaan::where('id', $id)->get();
        $kategoripekerjaans = KatPekerjaan::all();
		    return view('pekerjaan.edit', compact('data','kategoripekerjaans'));
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
        $data = Pekerjaan::where('id', $id)->first();
        $data->kategori_id = $request->kategori_id;
        $data->pekerjaan = $request->pekerjaan;
        $data->satuan = $request->satuan;
        $data->std_harga = $request->std_harga;
        $data->keterangan = $request->keterangan;
        $data->updateby_id = Auth::user()->id;
		    $data->save();
		    return redirect()->route('pekerjaan.index')->with('alert-success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pekerjaan::where('id', $id)->first();
        $data->is_delete=1;
        $data->save();

        foreach($data->rabpekerjaantypes as $rabpekerjaantype){
            $rabpekerjaantype->is_delete=1;
            $rabpekerjaantype->save();
        }

        foreach($data->rabpekerjaanunits as $rabpekerjaanunit){
            $rabpekerjaanunit->is_delete=1;
            $rabpekerjaanunit->save();
        }

        foreach($data->progresopnammes as $progress){
            $progress->is_delete=1;
            $progress->save();
        }

		    return redirect()->route('pekerjaan.index')->with('alert-success', 'Data berhasi dihapus!');
    }
}
