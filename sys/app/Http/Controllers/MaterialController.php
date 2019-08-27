<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KatMaterial;
use App\Material;
use Auth;
use App\Supplier;
class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = Material::where('is_delete',0)->get();
        return view('material.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategorimaterials = KatMaterial::where('is_delete',0)->get();
        $suppliers = Supplier::where('is_delete',0)->get();
        return view('material.create',compact('kategorimaterials','suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('image')) {
            $image = $request->file('image');

            $file_name = time(). rand(1111, 9999) . '.' .$image->getClientOriginalExtension();

            // $save_Path = 'images/'.$file_name;
            //$save_Path = public_path('images/'.$file_name);

            //Image::make($image->getRealPath())->resize(300, 236)->save($save_Path);
            $image->move('images',$file_name);
        } else {
            $file_name = null;
        }


        $data = new Material();
        $data->kode = $request->kode;
        $data->kategori_id = $request->kategori_id;
        $data->nama_brg = $request->nama_brg;
        //$data->ukuran = $request->ukuran;
        $data->satuan = $request->satuan;
        $data->harga = $request->harga;
        $data->keterangan = $request->keterangan;
        //$data->is_stock = $request->is_stock;
        $data->supplier_id = $request->supplier_id;
        $data->material_pic = $file_name;

        $data->createdby_id = Auth::user()->id;
        $data->save();
        return redirect()->route('material.index')->with('alert-success', 'Berhasil Menambahkan Data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Material::with('supplier')->findOrFail($id);
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
        $data = Material::findOrFail($id);
        $kategorimaterials = KatMaterial::where('is_delete',0)->get();
        $suppliers = Supplier::where('is_delete',0)->get();
        return view('material.edit', compact('data','kategorimaterials','suppliers'));
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
        if ($request->file('image')) {
            $image = $request->file('image');

            $file_name = time(). rand(1111, 9999) . '.' .$image->getClientOriginalExtension();

            // $save_Path = 'images/'.$file_name;
            //$save_Path = public_path('images/'.$file_name);

            //Image::make($image->getRealPath())->resize(300, 236)->save($save_Path);

            $image->move('images',$file_name);
        } else {
            $file_name = null;
        }


        $data = Material::where('id', $id)->first();
		$data->kode = $request->kode;
        $data->kategori_id = $request->kategori_id;
        $data->nama_brg = $request->nama_brg;
        //$data->ukuran = $request->ukuran;
        $data->satuan = $request->satuan;
        $data->harga = $request->harga;
        $data->keterangan = $request->keterangan;
        //$data->is_stock = $request->is_stock;
        $data->supplier_id = $request->supplier_id;

        if($file_name!=null)
            $data->material_pic = $file_name;

        $data->updateby_id = Auth::user()->id;
		    $data->save();
		    return redirect()->route('material.index')->with('alert-success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Material::where('id', $id)->first();
        $data->is_delete=1;
        $data->save();

        foreach($data->rabmaterialtypes as $rabmaterialtype){
            $rabmaterialtype->is_delete=1;
            $rabmaterialtype->save();
        }

        foreach($data->rabmaterialunits as $rabmaterialunit){
            $rabmaterialunit->is_delete=1;
            $rabmaterialunit->save();
        }

        foreach($data->pakaimaterials as $pakaimaterial){
            $pakaimaterial->is_delete=1;
            $pakaimaterial->save();
        }

		// if($data->rabmaterialtypes()->count()==0){
  //           $data->delete();
            return redirect()->route('material.index')->with('alert-success', 'Data berhasi dihapus!');
        // }else{
        //     return redirect()->route('material.index')->with('alert-success', 'Data Gagal dihapus karena memiliki Relasi!');
        // }
    }
}
