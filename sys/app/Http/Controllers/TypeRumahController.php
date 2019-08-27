<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeRumah;
use Auth;

class TypeRumahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = TypeRumah::where('is_delete',0)->get();
        return view('typerumah.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('typerumah.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new TypeRumah();
        $data->type = $request->type;
        $data->luas_tanah = $request->luas_tanah;
        $data->luas_bangunan = $request->luas_bangunan;
        $data->keterangan = $request->keterangan;
        $data->createdby_id = Auth::user()->id;
	    $data->save();
		return redirect()->route('typerumah.index')->with('alert-success', 'Berhasil Menambahkan Data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = TypeRumah::findOrFail($id);
        return response()->json([
            'data'=>$data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = TypeRumah::where('id', $id)->get();
		return view('typerumah.edit', compact('data'));
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
        $data = TypeRumah::where('id', $id)->first();
		$data->type = $request->type;
        $data->luas_tanah = $request->luas_tanah;
        $data->luas_bangunan = $request->luas_bangunan;
        $data->keterangan = $request->keterangan;
        $data->updateby_id = Auth::user()->id;
        $data->update_time = date("Y-m-d H:i:s");
		$data->save();
		return redirect()->route('typerumah.index')->with('alert-success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = TypeRumah::where('id', $id)->first();
        foreach($data->rabmaterialtypes as $rabmaterialtype){
            $rabmaterialtype->is_delete=1;
            $rabmaterialtype->save();
        }

        foreach($data->rabpekerjaantypes as $rabpekerjaantype){
            $rabpekerjaantype->is_delete=1;
            $rabpekerjaantype->save();
        }

        // if($data->unitrumahs()->count()==0 && $data->rabmaterialtypes()->count==0 && $data->rabpekerjaantypes()->count()==0){
            $data->is_delete=1;
            $data->save();
            return redirect()->route('typerumah.index')->with('alert-success', 'Data berhasi dihapus!');
        // }else{
        //     return redirect()->route('typerumah.index')->with('alert-success', 'Data Gagal dihapus karena memiliki Relasi!');
        // }
    }
}
