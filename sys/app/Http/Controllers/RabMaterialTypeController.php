<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RabMaterialType;
use App\TypeRumah;
use App\Material;
use Auth;
use Validator;
class RabMaterialTypeController extends Controller
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
        $rabmaterialtypes = RabMaterialType::where('is_delete',0)->get()->unique('type_id');
        return view('rabmaterialtype.index',compact('rabmaterialtypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typerumahs = TypeRumah::where('is_delete',0)->get();
        $materials = Material::where('is_delete',0)->get();
        return view('rabmaterialtype.create',compact('typerumahs','materials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rabmaterialtype = new RabMaterialType;
        $rabmaterialtype->type_id = $request->type_id;
        $rabmaterialtype->material_id = $request->material_id;
        $rabmaterialtype->qty = $request->qty;
        $rabmaterialtype->price = $request->price;
        $rabmaterialtype->createdby_id = Auth::user()->id;
        $rabmaterialtype->save();
        return redirect()->route('rabmaterialtype.index')->with('alert-success', 'Berhasil Menambahkan Data RAB Material Type Rumah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $typerumah = TypeRumah::findOrFail($id);
        $rabmaterialtype = RabMaterialType::with(['material.kategori_material'])->where('type_id',$unitrumah->typerumah->id)->where('is_delete',0)->get();
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
        $rabmaterialtype = RabMaterialType::findOrFail($id);
        $typerumahs = TypeRumah::where('is_delete',0)->get();
        $materials = Material::where('is_delete',0)->get();
        return view('rabmaterialtype.edit',compact('rabmaterialtype','typerumahs','materials'));
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
        
        $rabmaterialtype = RabMaterialType::where('type_id',$id)->where('is_delete',0)->get();
        foreach($rabmaterialtype as $rabmaterial){
            $rabmaterial->is_delete=1;
            $rabmaterial->save();
        }        

        foreach($request->rabmaterials as $rabmaterial){
            $rabmaterialunit = RabMaterialType::where('type_id',$id)->where('material_id',$rabmaterial['material_id'])->first();
            if($rabmaterialunit!=null){
                $rabmaterialunit->qty = $rabmaterial['qty'];
                $rabmaterialunit->price = $rabmaterial['price'];
                $rabmaterialunit->updateby_id = Auth::user()->id;
                $rabmaterialunit->update_time = date("Y-m-d H:i:s");
                $rabmaterialunit->is_delete=0;
                $rabmaterialunit->save();
            }else{
                $rabmaterialunit = new RabMaterialType;
                $rabmaterialunit->type_id = $id;
                $rabmaterialunit->material_id = $rabmaterial['material_id'];
                $rabmaterialunit->qty = $rabmaterial['qty'];
                $rabmaterialunit->price = $rabmaterial['price'];
                $rabmaterialunit->updateby_id = Auth::user()->id;
                $rabmaterialunit->update_time = date("Y-m-d H:i:s");
                $rabmaterialunit->save();
            }
        }
        return response()->json(["success" => 1, 'alert-success'=> 'Berhasil Menambahkan Data RAB Material Type Rumah!']);

        // $rabmaterialtype = RabMaterialType::findOrFail($id);
        // $rabmaterialtype->type_id = $request->type_id;
        // $rabmaterialtype->material_id = $request->material_id;
        // $rabmaterialtype->qty = $request->qty;
        // $rabmaterialtype->price = $request->price;
        // $rabmaterialtype->updateby_id = Auth::user()->id;
        // $rabmaterialtype->update_time = date("Y-m-d H:i:s");
        // $rabmaterialtype->save();
        // return redirect()->route('rabmaterialtype.index')->with('alert-success', 'Berhasil Mengubah Data RAB Material Type Rumah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rabmaterialtype = RabMaterialType::findOrFail($id);
        $rabmaterialtype->is_delete=1;
        $rabmaterialtype->save();
        return redirect()->route('rabmaterialtype.index')->with('alert-success', 'Data RAB Material Type Rumah berhasi dihapus!');
    }

    public function show2($id)
    {
        $typerumah = TypeRumah::findOrFail($id);
        $rabmaterialtype = RabMaterialType::with(['material.kategori_material'])->where('type_id',$typerumah->id)->where('is_delete',0)->get();
        return response()->json([
            'data'=>$rabmaterialtype,
        ]);
    }


    public function getMaterial($id)
    {
        $option = '<option>-- Pilih Material --</option>';
        if($id != '')
        {
            $exist = RabMaterialType::where('type_id',$id)->where('is_delete',0)->get('material_id');
            $material = Material::select('id','kode','nama_brg')->whereNotIn('id',$exist)->where('is_delete',0)->get();
            foreach ($material as $mat) {
                $option .= "<option value='".$mat->id."'>".$mat->kode."-".$mat->nama_brg."</option>";
            }
            echo json_encode($material);
        }
        
    }

    public function getMaterialCurrent($matid,$typeid)
    {
        //dd($matid);
        $option = '<option>-- Pilih Material --</option>';
        if($matid != null)
        {
            $exist = RabMaterialType::where('type_id',$typeid)->where('is_delete',0)->get('material_id');
            $material = Material::select('id','kode','nama_brg')->whereNotIn('id',$exist)->orWhere('id',$matid)->where('is_delete',0)->get();
            foreach ($material as $mat) {
                $option .= "<option value='".$mat->id."'>".$mat->kode."-".$mat->nama_brg."</option>";
            }
            echo json_encode($material);
        }else{
            dd($matid);
            $exist = RabMaterialType::where('type_id',$typeid)->where('is_delete',0)->get('material_id');
            $material = Material::select('id','kode','nama_brg')->whereNotIn('id',$exist)->where('is_delete',0)->get();
            foreach ($material as $mat) {
                $option .= "<option value='".$mat->id."'>".$mat->kode."-".$mat->nama_brg."</option>";
            }
            echo json_encode($material);
        }
    }
    public function getRabMaterialType($id){
        $type = TypeRumah::find($id);
        if($type!=null){
            return view('rabmaterialtype.show',compact('type'));
        }
        return redirect('/rabmaterialtype');
    }
}
