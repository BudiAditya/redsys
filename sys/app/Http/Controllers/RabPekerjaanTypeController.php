<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RabPekerjaanType;
use App\TypeRumah;
use App\Pekerjaan;
use Auth;
use Validator;
class RabPekerjaanTypeController extends Controller
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
        $rabpekerjaantypes = RabPekerjaanType::where('is_delete',0)->get()->unique('type_id');
        return view('rabpekerjaantype.index',compact('rabpekerjaantypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typerumahs = TypeRumah::where('is_delete',0)->get();
        $pekerjaans = Pekerjaan::where('is_delete',0)->get();
        return view('rabpekerjaantype.create',compact('typerumahs','pekerjaans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rabpekerjaantype = new RabPekerjaanType;
        $rabpekerjaantype->type_id = $request->type_id;
        $rabpekerjaantype->pekerjaan_id = $request->pekerjaan_id;
        $rabpekerjaantype->qty = 1;
        $rabpekerjaantype->price = $request->price;
        $rabpekerjaantype->createdby_id = Auth::user()->id;
        $rabpekerjaantype->save();
        return redirect()->route('rabpekerjaantype.index')->with('alert-success', 'Berhasil Menambahkan Data RAB Pekerjaan Type Rumah!');
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
        $rabpekerjaantype = RabPekerjaanType::with(['pekerjaan.kategori_pekerjaan'])->where('type_id',$typerumah->id)->where('is_delete',0)->get();
        return response()->json([
            'data'=>$rabpekerjaantype,
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
        $rabpekerjaantype = RabPekerjaanType::findOrFail($id);
        $typerumahs = TypeRumah::where('is_delete',0)->get();
        $pekerjaans = Pekerjaan::where('is_delete',0)->get();
        return view('rabpekerjaantype.edit',compact('rabpekerjaantype','typerumahs','pekerjaans'));
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
            "rabpekerjaans" => "required|array",
            "rabpekerjaans.*.pekerjaan_id" => "required|distinct|exists:m_pekerjaan,id",
            // "rabpekerjaans.*.qty" => "required|numeric|min:0",
            "rabpekerjaans.*.price" => "required|numeric|min:0",
        ];

        $arr_messages = [
            "rabpekerjaans.required" => "Mohon memilih RAB material",
            "rabpekerjaans.*.pekerjaan_id.required" => "Pekerjaan harap dipilih",
            "rabpekerjaans.*.pekerjaan_id.distinct" => "Pekerjaan duplikasi",
            "rabpekerjaans.*.pekerjaan_id.exists" => "Pekerjaan tidak terdaftar",

            // "rabpekerjaans.*.qty.required" => "Qty harap diisi",
            // "rabpekerjaans.*.qty.numeric" => "Qty harap berupa angka",
            // "rabpekerjaans.*.qty.min" => "Qty minimal :min",

            "rabpekerjaans.*.price.required" => "Harga harap diisi",
            "rabpekerjaans.*.price.numeric" => "Harga harap berupa angka",
            "rabpekerjaans.*.price.min" => "Harga minimal :min",
        ];

        $validator = Validator::make($request->all(), $arr_validator, $arr_messages);

        // if data not valid
        if($validator->fails())
            return response()->json(["success" => 0, "errors" => $validator->getMessageBag()->toArray()]);

        $rabpekerjaantypes = RabPekerjaanType::where('type_id',$id)->where('is_delete',0)->get();
        foreach($rabpekerjaantypes as $rabpekerjaantype){
            $rabpekerjaantype->is_delete=1;
            $rabpekerjaantype->save();
        } 

        foreach($request->rabpekerjaans as $rabpekerjaanunit2){
            $rabmaterialunit = RabPekerjaanType::where('type_id',$id)->where('pekerjaan_id',$rabpekerjaanunit2['pekerjaan_id'])->first();
            if($rabmaterialunit!=null){
                $rabpekerjaanunit3->qty = 1;
                $rabpekerjaanunit3->price = $rabpekerjaanunit2['price'];
                $rabpekerjaanunit3->updateby_id = Auth::user()->id;
                $rabpekerjaanunit3->update_time = date("Y-m-d H:i:s");
                $rabpekerjaanunit3->is_delete=0;
                $rabpekerjaanunit3->save();
            }else{
                $rabpekerjaanunit3 = new RabPekerjaanType;
                $rabpekerjaanunit3->type_id = $id;
                $rabpekerjaanunit3->pekerjaan_id = $rabpekerjaanunit2['pekerjaan_id'];
                $rabpekerjaanunit3->qty = 1;
                $rabpekerjaanunit3->price = $rabpekerjaanunit2['price'];
                $rabpekerjaanunit3->updateby_id = Auth::user()->id;
                $rabpekerjaanunit3->update_time = date("Y-m-d H:i:s");
                $rabpekerjaanunit3->save();
            }
        }
        return response()->json(["success" => 1, 'alert-success'=> 'Berhasil Merubah Data RAB Pekerjaan Unit Rumah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rabpekerjaantype = RabPekerjaanType::findOrFail($id);
        $rabpekerjaantype->is_delete=1;
        $rabpekerjaantype->save();
        return redirect()->route('rabpekerjaantype.index')->with('alert-success', 'Data RAB Pekerjaan Type Rumah berhasi dihapus!');
    }

    public function show2($id)
    {
        $typerumah = TypeRumah::findOrFail($id);
        $rabpekerjaantype = RabPekerjaanType::with(['pekerjaan.kategori_pekerjaan'])->where('type_id',$typerumah->id)->where('is_delete',0)->get();
        return response()->json([
            'data'=>$rabpekerjaantype,
        ]);
    }

    public function getPekerjaan($id)
    {
        // $option = '<option>-- Pilih Pekerjaan --</option>';
        if($id != '')
        {
            $exist = RabPekerjaanType::where('type_id',$id)->where('is_delete',0)->pluck('pekerjaan_id')->toArray();
            $pekerjaans = Pekerjaan::whereNotIn('id',$exist)->where('is_delete',0)->get();
            // foreach ($pekerjaans as $pekerjaan) {
            //     $option .= "<option value='".$pekerjaan->id."'>".$pekerjaan->pekerjaan."</option>";
            // }
            echo json_encode($pekerjaans);
        }
        
    }

    public function getPekerjaanCurrent($pekid,$typeid)
    {
        //dd($matid);
        // $option = '<option>-- Pilih Pekerjaan --</option>';
        if($pekid != null)
        {
            $exist = RabPekerjaanType::where('type_id',$typeid)->where('is_delete',0)->where('pekerjaan_id','!=',$pekid)->pluck('pekerjaan_id')->toArray();
            // echo "$pekid <br/>";
            // echo json_encode($exist);
            $pekerjaans = Pekerjaan::whereNotIn('id',$exist)->where('is_delete',0)->get();
            // foreach ($material as $mat) {
            //     $option .= "<option value='".$mat->id."'>".$mat->kode."-".$mat->nama_brg."</option>";
            // }
            echo json_encode($pekerjaans);
        }else{
            // dd($matid);
            $exist = RabPekerjaanType::where('type_id',$typeid)->where('is_delete',0)->pluck('pekerjaan_id')->toArray();
            $pekerjaans = Pekerjaan::whereNotIn('id',$exist)->where('is_delete',0)->get();
            // $exist = RabMaterialType::where('type_id',$typeid)->get('material_id');
            // $material = Material::select('id','kode','nama_brg')->whereNotIn('id',$exist)->get();
            // foreach ($material as $mat) {
            //     $option .= "<option value='".$mat->id."'>".$mat->kode."-".$mat->nama_brg."</option>";
            // }
            echo json_encode($pekerjaans);
        }
    }
}
