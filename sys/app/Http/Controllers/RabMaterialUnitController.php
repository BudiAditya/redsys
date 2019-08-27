<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RabMaterialUnit;
use App\UnitRumah;
use App\Material;
use App\RabMaterialType;
use App\PakaiMaterial;
use Auth;
use Validator;
class RabMaterialUnitController extends Controller
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
        $rabmaterialunits = RabMaterialUnit::where('is_delete',0)->get()->unique('unit_id');
        return view('rabmaterialunit.index',compact('rabmaterialunits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rabmaterialunits = RabMaterialUnit::where('is_delete',0)->groupBy('unit_id')->pluck('unit_id','unit_id')->toArray();
        
        $unitrumahs = UnitRumah::whereNotIn('id',$rabmaterialunits)->where('is_delete',0)->where('status_progress',0)->get();
        
        $materials = Material::where('is_delete',0)->get();
        return view('rabmaterialunit.create',compact('unitrumahs','materials'));
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
            "rabmaterials" => "required|array",
            "rabmaterials.*.material_id" => "required|distinct|exists:m_material,id",
            "rabmaterials.*.qty" => "required|numeric|min:0",
            "rabmaterials.*.price" => "required|numeric|min:0",
        ];

        $arr_messages = [
        	"unit_id.required" => "Mohon memilih Unit",
        	"unit_id.exists" => "Unit tidak terdaftar",
            "rabmaterials.required" => "Mohon memilih RAB material",
            "rabmaterials.*.material_id.required" => "Material harap dipilih",
            "rabmaterials.*.material_id.distinct" => "Material duplikasi",
            "rabmaterials.*.material_id.exists" => "Material tidak terdaftar",

            "rabmaterials.*.qty.required" => "Qty harap diisi",
            "rabmaterials.*.qty.numeric" => "Qty harap berupa angka",
            "rabmaterials.*.qty.min" => "Qty minimal :min",

            "rabmaterials.*.price.required" => "Harga harap diisi",
            "rabmaterials.*.price.numeric" => "Harga harap berupa angka",
            "rabmaterials.*.price.min" => "Harga minimal :min",
        ];

        $validator = Validator::make($request->all(), $arr_validator, $arr_messages);

        // if data not valid
        if($validator->fails())
        	return response()->json(["success" => 0, "errors" => $validator->getMessageBag()->toArray()]);

        foreach($request->rabmaterials as $rabmaterial){
            $rabmaterialunit = new RabMaterialUnit;
            $rabmaterialunit->unit_id = $request->unit_id;
            $rabmaterialunit->material_id = $rabmaterial['material_id'];
            $rabmaterialunit->qty = $rabmaterial['qty'];
            $rabmaterialunit->price = $rabmaterial['price'];
            $rabmaterialunit->createdby_id = Auth::user()->id;
            $rabmaterialunit->save();
        }
        return response()->json(["success" => 1, 'alert-success'=> 'Berhasil Menambahkan Data RAB Material Unit Rumah!']);
        // redirect()->route('rabmaterialunit.index')->with('alert-success', 'Berhasil Menambahkan Data RAB Material Unit Rumah!');
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
        $rabmaterialtype = RabMaterialType::with(['material.kategori_material'])->where('is_delete',0)->where('type_id',$unitrumah->typerumah->id)->where('is_delete',0)->get();
        return response()->json([
            'data'=>$rabmaterialtype,
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
        $rabmaterialunit = RabMaterialUnit::findOrFail($id);
        $unitrumahs = UnitRumah::where('is_delete',0)->get();
        $materials = Material::where('is_delete',0)->get();
        return view('rabmaterialunit.edit',compact('rabmaterialunit','unitrumahs','materials'));
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
            "rabmaterials" => "required|array",
            "rabmaterials.*.material_id" => "required|distinct|exists:m_material,id",
            "rabmaterials.*.qty" => "required|numeric|min:0",
            "rabmaterials.*.price" => "required|numeric|min:0",
        ];

        $arr_messages = [
            "rabmaterials.required" => "Mohon memilih RAB material",
            "rabmaterials.*.material_id.required" => "Material harap dipilih",
            "rabmaterials.*.material_id.distinct" => "Material duplikasi",
            "rabmaterials.*.material_id.exists" => "Material tidak terdaftar",

            "rabmaterials.*.qty.required" => "Qty harap diisi",
            "rabmaterials.*.qty.numeric" => "Qty harap berupa angka",
            "rabmaterials.*.qty.min" => "Qty minimal :min",

            "rabmaterials.*.price.required" => "Harga harap diisi",
            "rabmaterials.*.price.numeric" => "Harga harap berupa angka",
            "rabmaterials.*.price.min" => "Harga minimal :min",
        ];

        $validator = Validator::make($request->all(), $arr_validator, $arr_messages);

        // if data not valid
        if($validator->fails())
        	return response()->json(["success" => 0, "errors" => $validator->getMessageBag()->toArray()]);

        $rabmaterialunit = RabMaterialUnit::where('unit_id',$id)->where('is_delete',0)->get();
        foreach($rabmaterialunit as $rabmaterial){
            $rabmaterial->is_delete=1;
            $rabmaterial->save();
        } 
        
        foreach($request->rabmaterials as $rabmaterial){
            $rabmaterialunit = RabMaterialUnit::where('unit_id',$id)->where('material_id',$rabmaterial['material_id'])->first();
            if($rabmaterialunit!=null){
                $rabmaterialunit->qty = $rabmaterial['qty'];
                $rabmaterialunit->price = $rabmaterial['price'];
                $rabmaterialunit->updateby_id = Auth::user()->id;
                $rabmaterialunit->update_time = date("Y-m-d H:i:s");
                $rabmaterialunit->is_delete=0;
                $rabmaterialunit->save();
            }else{
                $rabmaterialunit = new RabMaterialUnit;
                $rabmaterialunit->unit_id = $id;
                $rabmaterialunit->material_id = $rabmaterial['material_id'];
                $rabmaterialunit->qty = $rabmaterial['qty'];
                $rabmaterialunit->price = $rabmaterial['price'];
                $rabmaterialunit->updateby_id = Auth::user()->id;
                $rabmaterialunit->update_time = date("Y-m-d H:i:s");
                $rabmaterialunit->save();
            }
        }
        return response()->json(["success" => 1, 'alert-success'=> 'Berhasil Menambahkan Data RAB Material Unit Rumah!']);

        // return redirect()->route('rabmaterialunit.index')->with('alert-success', 'Berhasil Menambahkan Data RAB Material Unit Rumah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rabmaterialunit = RabMaterialUnit::findOrFail($id);
        $rabmaterialunit->is_delete=1;
        $rabmaterialunit->save();
        return redirect()->route('rabmaterialunit.index')->with('alert-success', 'Data RAB Material Unit Rumah berhasi dihapus!');
    }

    public function show2($id)
    {
        $unitrumah = UnitRumah::findOrFail($id);
        $rabmaterialtype = RabMaterialUnit::with(['material.kategori_material'])->where('unit_id',$unitrumah->id)->where('is_delete',0)->get();
        return response()->json([
            'data'=>$rabmaterialtype,
        ]);
    }

    public function destroy2($id)
    {
        $rabmaterialunit = RabMaterialUnit::where('unit_id',$id)->where('is_delete',0)->get();
        foreach($rabmaterialunit as $rabmaterial){
            $rabmaterial->is_delete=1;
            $rabmaterial->save();
        } 

        $pakaimaterials = PakaiMaterial::where('unit_id',$id)->where('is_delete',0)->get();
        foreach($pakaimaterials as $pakaimaterial){
            $pakaimaterial->is_delete=1;
            $pakaimaterial->save();
        } 

        return redirect()->route('rabmaterialunit.index')->with('alert-success', 'Data RAB Material Unit Rumah berhasi dihapus!');
    }
}
