<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KatMaterial;
use Auth;

class KatMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data=KatMaterial::where('is_delete',0)->get();
        return view('katmaterial.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('katmaterial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new KatMaterial();
        $data->kategori = $request->kategori;
        $data->keterangan = $request->keterangan;
        $data->createdby_id = Auth::user()->id;
	    	$data->save();
		    return redirect()->route('katmaterial.index')->with('alert-success', 'Berhasil Menambahkan Data!');
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
        $data = KatMaterial::where('id', $id)->get();
		    return view('katmaterial.edit', compact('data'));
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
        $data = KatMaterial::where('id', $id)->first();
		    $data->kategori = $request->kategori;
        $data->keterangan = $request->keterangan;
        $data->updateby_id = Auth::user()->id;
		    $data->save();
		    return redirect()->route('katmaterial.index')->with('alert-success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = KatMaterial::where('id', $id)->first();
        foreach($data->materials as $material){
            foreach($material->rabmaterialtypes as $rabmaterialtype){
                $rabmaterialtype->is_delete=1;
                $rabmaterialtype->save();
            }

            foreach($material->rabmaterialunits as $rabmaterialunit){
                $rabmaterialunit->is_delete=1;
                $rabmaterialunit->save();
            }

            foreach($material->pakaimaterials as $pakaimaterial){
                $pakaimaterial->is_delete=1;
                $pakaimaterial->save();
            }
            $material->is_delete = 1;
            $material->save();
        }
        // if($data->materials()->count()==0){
            $data->is_delete=1;
            $data->save();
            return redirect()->route('katmaterial.index')->with('alert-success', 'Data berhasil dihapus!');
        // }else{
        //     return redirect()->route('katmaterial.index')->with('alert-success', 'Data Gagal dihapus karena memiliki Relasi!');
        // }
    }
}
