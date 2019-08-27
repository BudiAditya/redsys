<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RabPekerjaanUnit;
use App\UnitRumah;
use App\Pekerjaan;
use App\RabPekerjaanType;
use App\ProgresOpname;
use Auth;
use Validator;
class RabPekerjaanUnitController extends Controller
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
        $rabpekerjaanunits = RabPekerjaanUnit::where('is_delete',0)->get()->unique('unit_id');
        return view('rabpekerjaanunit.index',compact('rabpekerjaanunits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rabpekerjaanunits = RabPekerjaanUnit::where('is_delete',0)->groupBy('unit_id')->pluck('unit_id','unit_id')->toArray();
        
        $unitrumahs = UnitRumah::whereNotIn('id',$rabpekerjaanunits)->where('is_delete',0)->get();
        // $unitrumahs = UnitRumah::all();
        $pekerjaans = Pekerjaan::all();
        return view('rabpekerjaanunit.create',compact('unitrumahs','pekerjaans'));
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
            "rabpekerjaans" => "required|array",
            "rabpekerjaans.*.pekerjaan_id" => "required|distinct|exists:m_pekerjaan,id",
            // "rabpekerjaans.*.qty" => "required|numeric|min:0",
            "rabpekerjaans.*.price" => "required|numeric|min:0",
        ];

        $arr_messages = [
            "unit_id.required" => "Mohon memilih Unit",
            "unit_id.exists" => "Unit tidak terdaftar",

            "rabpekerjaans.required" => "Mohon memilih RAB pekerjaan",
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

        foreach($request->rabpekerjaans as $rabpekerjaan){
            $rabmaterialunit = new RabPekerjaanUnit;
            $rabmaterialunit->unit_id = $request->unit_id;
            $rabmaterialunit->pekerjaan_id = $rabpekerjaan['pekerjaan_id'];
            $rabmaterialunit->qty = 1;
            $rabmaterialunit->price = $rabpekerjaan['price'];
            $rabmaterialunit->createdby_id = Auth::user()->id;
            $rabmaterialunit->save();
        }
        return response()->json(["success" => 1, 'alert-success'=> 'Berhasil Menambahkan Data RAB Pekerjaan Unit Rumah!']);
        // return redirect()->route('rabpekerjaanunit.index')->with('alert-success', 'Berhasil Menambahkan Data RAB Pekerjaan Unit Rumah!');
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
        $rabpekerjaantype = RabPekerjaanType::with(['pekerjaan.kategori_pekerjaan'])->where('type_id',$unitrumah->typerumah->id)->where('is_delete',0)->get();
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
        $rabpekerjaanunit = RabPekerjaanUnit::findOrFail($id);
        $unitrumahs = UnitRumah::where('is_delete',0)->get();
        $pekerjaans = Pekerjaan::where('is_delete',0)->get();
        return view('rabpekerjaanunit.edit',compact('rabpekerjaanunit','unitrumahs','pekerjaans'));
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

        $rabpekerjaanunits = RabPekerjaanUnit::where('unit_id',$id)->where('is_delete',0)->get();
        foreach($rabpekerjaanunits as $rabpekerjaanunit){
            $rabpekerjaanunit->is_delete=1;
            $rabpekerjaanunit->save();
        }
        foreach($request->rabpekerjaans as $rabpekerjaanunit2){
            $rabpekerjaanunit3 = RabPekerjaanUnit::where('unit_id',$id)->where('pekerjaan_id',$rabpekerjaanunit2['pekerjaan_id'])->first();
            if($rabpekerjaanunit3!=null){
                $rabpekerjaanunit3->qty = 1;
                $rabpekerjaanunit3->price = $rabpekerjaanunit2['price'];
                $rabpekerjaanunit3->updateby_id = Auth::user()->id;
                $rabpekerjaanunit3->update_time = date("Y-m-d H:i:s");
                $rabpekerjaanunit3->is_delete=0;
                $rabpekerjaanunit3->save();
            }else{
                $rabpekerjaanunit3 = new RabPekerjaanUnit;
                $rabpekerjaanunit3->unit_id = $id;
                $rabpekerjaanunit3->pekerjaan_id = $rabpekerjaanunit2['pekerjaan_id'];
                $rabpekerjaanunit3->qty = 1;
                $rabpekerjaanunit3->price = $rabpekerjaanunit2['price'];
                $rabpekerjaanunit3->updateby_id = Auth::user()->id;
                $rabpekerjaanunit3->update_time = date("Y-m-d H:i:s");
                $rabpekerjaanunit3->save();
            }
        }
        return response()->json(["success" => 1, 'alert-success'=> 'Berhasil Merubah Data RAB Pekerjaan Unit Rumah!']);
        // return redirect()->route('rabpekerjaanunit.index')->with('alert-success', 'Berhasil Merubah Data RAB Pekerjaan Unit Rumah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rabpekerjaanunit = RabPekerjaanUnit::findOrFail($id);
        $rabpekerjaanunit->is_delete=1;
        $rabpekerjaanunit->save();
        return redirect()->route('rabpekerjaanunit.index')->with('alert-success', 'Data RAB Pekerjaan Unit Rumah berhasi dihapus!');
    }

    public function show2($id)
    {
        $unitrumah = UnitRumah::findOrFail($id);
        $rabpekerjaantype = RabPekerjaanUnit::with(['pekerjaan.kategori_pekerjaan'])->where('unit_id',$unitrumah->id)->where('is_delete',0)->get();
        return response()->json([
            'data'=>$rabpekerjaantype,
        ]);
    }

    public function destroy2($id)
    {
        $rabpekerjaanunits = RabPekerjaanUnit::where('unit_id',$id)->where('is_delete',0)->get();
        foreach($rabpekerjaanunits as $rabpekerjaan){
            $rabpekerjaan->is_delete=1;
            $rabpekerjaan->save();
        } 

        $progresss = ProgresOpname::where('unit_id',$id)->where('is_delete',0)->get();
        foreach($progresss as $progress){
            $progress->is_delete=1;
            $progress->save();
        } 

        // RabPekerjaanUnit::where('unit_id',$id)->delete();
        // ProgresOpname::where('unit_id',$id)->delete();
        return redirect()->route('rabpekerjaanunit.index')->with('alert-success', 'Data RAB Pekerjaan Unit Rumah berhasi dihapus!');
    }
}
