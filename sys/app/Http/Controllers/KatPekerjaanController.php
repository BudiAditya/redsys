<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KatPekerjaan;
use Auth;

class KatPekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data=KatPekerjaan::where('is_delete',0)->get();
        return view('katpekerjaan.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('katpekerjaan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new KatPekerjaan();
        $data->kategori = $request->kategori;
        $data->keterangan = $request->keterangan;
        $data->createdby_id = Auth::user()->id;
	    	$data->save();
		    return redirect()->route('katpekerjaan.index')->with('alert-success', 'Berhasil Menambahkan Data!');
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
        $data = KatPekerjaan::where('id', $id)->get();
		    return view('katpekerjaan.edit', compact('data'));
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
        $data = KatPekerjaan::where('id', $id)->first();
		    $data->kategori = $request->kategori;
        $data->keterangan = $request->keterangan;
        $data->updateby_id = Auth::user()->id;
		    $data->save();
		    return redirect()->route('katpekerjaan.index')->with('alert-success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = KatPekerjaan::where('id', $id)->first();
        foreach($data->pekerjaans as $pekerjaan){
            foreach($pekerjaan->rabpekerjaantypes as $rabpekerjaantype){
                $rabpekerjaantype->is_delete=1;
                $rabpekerjaantype->save();
            }

            foreach($pekerjaan->rabpekerjaanunits as $rabpekerjaanunit){
                $rabpekerjaanunit->is_delete=1;
                $rabpekerjaanunit->save();
            }

            foreach($pekerjaan->progresopnammes as $progress){
                $progress->is_delete=1;
                $progress->save();
            }


            $pekerjaan->is_delete = 1;
            $pekerjaan->save();
        }



        // if($data->pekerjaans()->count()==0){
            $data->is_delete=1;
            $data->save();
            return redirect()->route('katmaterial.index')->with('alert-success', 'Data berhasi dihapus!');
        // }else{
        //     return redirect()->route('katmaterial.index')->with('alert-success', 'Data Gagal dihapus karena memiliki Relasi!');
        // }
    }
}
