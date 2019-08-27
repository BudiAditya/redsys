<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\UnitRumah;
use App\PakaiMaterial;
use App\Material;
use App\RabMaterialUnit;
use Validator;
use App\Item;
use DB;
class PakaiMaterialMasterController extends Controller
{
    public function __construct(){
        $this -> middleware('auth');        
        //$this -> middleware('akses:2');
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pakaimaterialmasters = PakaiMaterial::where('is_delete',0)->get()->unique('unit_id');
        return view('pakaimaterialmaster.index',compact('pakaimaterialmasters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rabmaterialunits = RabMaterialUnit::where('is_delete',0)->get()->unique('unit_id')->pluck("unit_id")->toArray();
        $unitrumahs = UnitRumah::whereIn('id',$rabmaterialunits)->where('is_delete',0)->get();
        $materials = Material::where('is_delete',0)->get();
        return view('pakaimaterialmaster.create',compact('unitrumahs','materials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arr_validator = [
            "unit_id" => "required|exists:m_unitrumah,id",
            "rabpakaimaterials" => "required|array",
            "rabpakaimaterials.*.material_id" => "required|distinct|exists:m_material,id",
            "rabpakaimaterials.*.qty" => "required|numeric|min:0",
            "rabpakaimaterials.*.price" => "required|numeric|min:0",
            "tanggal" => "required|date",
        ];

        $arr_messages = [
            "unit_id.required" => "Mohon memilih Unit",
            "unit_id.exists" => "Unit tidak terdaftar",
            "tanggal.required" => "Tanggal harap diisi",
            "tanggal.date" => "Format tanggal kurang sesuai",
            "rabpakaimaterials.required" => "Mohon memilih RAB material",
            "rabpakaimaterials.*.material_id.required" => "Material harap dipilih",
            "rabpakaimaterials.*.material_id.distinct" => "Material duplikasi",
            "rabpakaimaterials.*.material_id.exists" => "Material tidak terdaftar",

            "rabpakaimaterials.*.qty.required" => "Qty harap diisi",
            "rabpakaimaterials.*.qty.numeric" => "Qty harap berupa angka",
            "rabpakaimaterials.*.qty.min" => "Qty minimal :min",

            "rabpakaimaterials.*.price.required" => "Harga harap diisi",
            "rabpakaimaterials.*.price.numeric" => "Harga harap berupa angka",
            "rabpakaimaterials.*.price.min" => "Harga minimal :min",
        ];

        $validator = Validator::make($request->all(), $arr_validator, $arr_messages);

        // if data not valid
        if($validator->fails())
            return response()->json(["success" => 0, "errors" => $validator->getMessageBag()->toArray()]);

        DB::beginTransaction();
        foreach($request->rabpakaimaterials as $rabpakaimaterial){
            $rabmaterialunit = new PakaiMaterial;
            $rabmaterialunit->tgl_pakai = date('Y-m-d',strtotime($request->tanggal));
            $rabmaterialunit->unit_id = $request->unit_id;
            $rabmaterialunit->material_id = $rabpakaimaterial['material_id'];

            $material = Material::find($rabpakaimaterial['material_id']);
            if($material!=null){

                //Gagal Qty > total yg tersedia
                if($rabpakaimaterial['qty'] > ($material->items->sum('qty')- PakaiMaterial::where('material_id',$material->id)->sum('qty'))){
                    DB::rollBack();
                    return response()->json(["success" => 0, "errors" => ["sisa_stok"=>"Qty > Sisa Item ".$material->nama_brg.", Sisa : <b>".($material->items->sum('qty')- PakaiMaterial::where('material_id',$material->id)->sum('qty'))."</b> tidak mencukupi"]]);
                }
                $rabmaterialunit->qty = $rabpakaimaterial['qty'];        

                $rabmaterialunit->price = $rabpakaimaterial['price'];
                // $rabmaterialunit->keterangan = $request->keterangan;

                $rabmaterialunit->createdby_id = Auth::user()->id;
                $rabmaterialunit->save();                
            }
            else{
                DB::rollBack();
                return response()->json(["success" => 0, "errors" => ["sisa_stok"=>"Material tidak ditemukan"]]);
            }
        }
        DB::commit();
        return response()->json(["success" => 1, 'alert-success'=> 'Berhasil Menambahkan Data RAB Material Unit Rumah!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unitrumah = UnitRumah::findOrFail($id);
        $rabmaterialunit = RabMaterialUnit::with(['material.kategori_material'])->where('unit_id',$unitrumah->id)->where('is_delete',0)->get();
        return response()->json([
            'data'=>$rabmaterialunit,
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
        $pakaimaterialmaster = PakaiMaterial::findOrFail($id);
        $unitrumahs = UnitRumah::where('is_delete',0)->get();
        $materials = Material::where('is_delete',0)->get();
        return view('pakaimaterialmaster.edit',compact('pakaimaterialmaster','unitrumahs','materials'));
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
        $arr_validator = [
            "unit_id" => "required|exists:m_unitrumah,id",
            "rabpakaimaterials" => "required|array",
            "rabpakaimaterials.*.material_id" => "required|exists:m_material,id",
            "rabpakaimaterials.*.qty" => "required|numeric|min:0",
            "rabpakaimaterials.*.price" => "required|numeric|min:0",
            "rabpakaimaterials.*.tanggal" => "required|date",
        ];

        $arr_messages = [
            "unit_id.required" => "Mohon memilih Unit",
            "unit_id.exists" => "Unit tidak terdaftar",
            "rabpakaimaterials.*.tanggal.required" => "Tanggal harap diisi",
            "rabpakaimaterials.*.tanggal.date" => "Format tanggal kurang sesuai",
            "rabpakaimaterials.required" => "Mohon memilih RAB material",
            "rabpakaimaterials.*.material_id.required" => "Material harap dipilih",
            // "rabpakaimaterials.*.material_id.distinct" => "Material duplikasi",
            "rabpakaimaterials.*.material_id.exists" => "Material tidak terdaftar",

            "rabpakaimaterials.*.qty.required" => "Qty harap diisi",
            "rabpakaimaterials.*.qty.numeric" => "Qty harap berupa angka",
            "rabpakaimaterials.*.qty.min" => "Qty minimal :min",

            "rabpakaimaterials.*.price.required" => "Harga harap diisi",
            "rabpakaimaterials.*.price.numeric" => "Harga harap berupa angka",
            "rabpakaimaterials.*.price.min" => "Harga minimal :min",
        ];

        $validator = Validator::make($request->all(), $arr_validator, $arr_messages);

        // if data not valid
        if($validator->fails())
            return response()->json(["success" => 0, "errors" => $validator->getMessageBag()->toArray()]);

        DB::beginTransaction();
        $pakaimaterial = PakaiMaterial::where('unit_id',$id)->delete();
        foreach($request->rabpakaimaterials as $rabpakaimaterial){
            $rabmaterialunit = new PakaiMaterial;
            $rabmaterialunit->tgl_pakai = date('Y-m-d',strtotime($rabpakaimaterial['tanggal']));
            $rabmaterialunit->unit_id = $request->unit_id;
            $rabmaterialunit->material_id = $rabpakaimaterial['material_id'];

            $material = Material::find($rabpakaimaterial['material_id']);
            if($material!=null){

                //Gagal Qty > total yg tersedia
                if($rabpakaimaterial['qty'] > ($material->items->sum('qty')- PakaiMaterial::where('material_id',$material->id)->sum('qty'))){
                    DB::rollBack();
                    return response()->json(["success" => 0, "errors" => ["sisa_stok"=>"Qty > Sisa Item ".$material->nama_brg.", Sisa : <b>".($material->items->sum('qty')- PakaiMaterial::where('material_id',$material->id)->sum('qty'))."</b> tidak mencukupi"]]);
                }
                $rabmaterialunit->qty = $rabpakaimaterial['qty'];
                
                $rabmaterialunit->price = $rabpakaimaterial['price'];

                // $pakaimaterialmaster->keterangan = $request->keterangan;
                $rabmaterialunit->updateby_id = Auth::user()->id;
                $rabmaterialunit->update_time = date('Y-m-d H:i:s');

                // $rabmaterialunit->createdby_id = Auth::user()->id;
                $rabmaterialunit->save();
            }
        }
        DB::commit();
        return response()->json(["success" => 1, 'alert-success'=> 'Berhasil Merubah Data Pemakaian!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unitrumah = UnitRumah::findOrFail($id);
        PakaiMaterial::where('unit_id',$unitrumah->id)->update(['is_delete',1]);
        
        return redirect()->route('pakaimaterialmaster.index')->with('alert-success', 'Data Pakai Material berhasi dihapus!');
    }

    public function show2($id)
    {
        $unitrumah = UnitRumah::findOrFail($id);
        $rabmaterialunit = PakaiMaterial::with(['material.kategori_material'])->where('unit_id',$unitrumah->id)->where('is_delete',0)->get();
        return response()->json([
            'data'=>$rabmaterialunit,
        ]);
    }
}
