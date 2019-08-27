<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\UnitRumah;
use App\ProgresOpname;
use App\Pekerjaan;
use App\RabPekerjaanUnit;
class OpnameMasterController extends Controller
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
        $opnamemasters = ProgresOpname::where('is_delete',0)->get()->unique('unit_id');
        return view('opnamemaster.index',compact('opnamemasters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unitrumahs = UnitRumah::where('is_delete',0)->get();
        $pekerjaans = Pekerjaan::where('is_delete',0)->get();
        return view('opnamemaster.create',compact('unitrumahs','pekerjaans'));
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
            "rabopnames" => "required|array",
            "rabopnames.*.pekerjaan_id" => "required|distinct|exists:m_pekerjaan,id",
            "rabopnames.*.persentase" => "required|numeric|min:0|max:100",
            "rabopnames.*.price" => "required|numeric|min:0",
            "tanggal" => "required|date",
        ];

        $arr_messages = [
            "unit_id.required" => "Mohon memilih Unit",
            "unit_id.exists" => "Unit tidak terdaftar",
            "tanggal.required" => "Tanggal harap diisi",
            "tanggal.date" => "Format tanggal kurang sesuai",
            "rabopnames.required" => "Mohon memilih RAB material",
            "rabopnames.*.material_id.required" => "Material harap dipilih",
            "rabopnames.*.material_id.distinct" => "Material duplikasi",
            "rabopnames.*.material_id.exists" => "Material tidak terdaftar",

            "rabopnames.*.persentase.required" => "Persentase harap diisi",
            "rabopnames.*.persentase.numeric" => "Persentase harap berupa angka",
            "rabopnames.*.persentase.min" => "Persentase minimal :min",
            "rabopnames.*.persentase.max" => "Persentase maksimal :max",

            "rabopnames.*.price.required" => "Harga harap diisi",
            "rabopnames.*.price.numeric" => "Harga harap berupa angka",
            "rabopnames.*.price.min" => "Harga minimal :min",
        ];

        $validator = Validator::make($request->all(), $arr_validator, $arr_messages);

        // if data not valid
        if($validator->fails())
            return response()->json(["success" => 0, "errors" => $validator->getMessageBag()->toArray()]);

        foreach($request->rabopnames as $rabopname){

            $progresOpname = new ProgresOpname;
            $progresOpname->tgl_progress = date('Y-m-d',strtotime($request->tanggal));
            $progresOpname->unit_id = $request->unit_id;
            $progresOpname->pekerjaan_id = $rabopname['pekerjaan_id'];
            $progresOpname->persentase = $rabopname['persentase'];        

            $progresOpname->price = $rabopname['price'];
            // $rabmaterialunit->keterangan = $request->keterangan;

            $progresOpname->createdby_id = Auth::user()->id;
            $progresOpname->save();
        }
        return response()->json(["success" => 1, 'alert-success'=> 'Data Opname Master berhasi disimpan!']);
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
        $opnamemasters = RabPekerjaanUnit::with(['pekerjaan.kategori_pekerjaan'])->where('unit_id',$unitrumah->id)->where('is_delete',0)->get();
        return response()->json([
            'data'=>$opnamemasters,
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
        $opnamemaster = ProgresOpname::findOrFail($id);
        $unitrumahs = UnitRumah::where('is_delete',0)->get();
        $pekerjaans = Pekerjaan::where('is_delete',0)->get();
        return view('opnamemaster.edit',compact('opnamemaster','unitrumahs','pekerjaans'));
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
            "rabopnames" => "required|array",
            "rabopnames.*.pekerjaan_id" => "required|distinct|exists:m_pekerjaan,id",
            "rabopnames.*.persentase" => "required|numeric|min:0|max:100",
            "rabopnames.*.price" => "required|numeric|min:0",
            "rabopnames.*.tanggal" => "required|date",
        ];

        $arr_messages = [
            "unit_id.required" => "Mohon memilih Unit",
            "unit_id.exists" => "Unit tidak terdaftar",
            "tanggal.required" => "Tanggal harap diisi",
            "tanggal.date" => "Format tanggal kurang sesuai",
            "rabopnames.required" => "Mohon memilih RAB material",
            "rabopnames.*.material_id.required" => "Material harap dipilih",
            "rabopnames.*.material_id.distinct" => "Material duplikasi",
            "rabopnames.*.material_id.exists" => "Material tidak terdaftar",

            "rabopnames.*.persentase.required" => "Persentase harap diisi",
            "rabopnames.*.persentase.numeric" => "Persentase harap berupa angka",
            "rabopnames.*.persentase.min" => "Persentase minimal :min",
            "rabopnames.*.persentase.max" => "Persentase maksimal :max",

            "rabopnames.*.price.required" => "Harga harap diisi",
            "rabopnames.*.price.numeric" => "Harga harap berupa angka",
            "rabopnames.*.price.min" => "Harga minimal :min",

            "rabopnames.*.tanggal.required" => "Tanggal harap diisi",
            "rabopnames.*.tanggal.date" => "Format Tanggal kurang sesuai",
        ];

        $validator = Validator::make($request->all(), $arr_validator, $arr_messages);

        // if data not valid
        if($validator->fails())
            return response()->json(["success" => 0, "errors" => $validator->getMessageBag()->toArray()]);
        ProgresOpname::where('unit_id',$id)->delete();
        //
        // $opnamemaster = OpnameMaster::findOrFail($id);
        // $opnamemaster->tanggal = date('Y-m-d',strtotime($request->tanggal));
        // $opnamemaster->no_bukti = $request->no_bukti;
        // $opnamemaster->unit_id = $request->unit_id;
        // $opnamemaster->keterangan = $request->keterangan;
        // $opnamemaster->updateby_id = Auth::user()->id;
        // $opnamemaster->update_time = date('Y-m-d H:i:s');
        // $opnamemaster->save();

        foreach($request->rabopnames as $rabopname){

            $progresOpname = new ProgresOpname;
            $progresOpname->tgl_progress = date('Y-m-d',strtotime($request->tanggal));
            $progresOpname->unit_id = $request->unit_id;
            $progresOpname->pekerjaan_id = $rabopname['pekerjaan_id'];
            $progresOpname->persentase = $rabopname['persentase'];        

            $progresOpname->price = $rabopname['price'];
            // $rabmaterialunit->keterangan = $request->keterangan;

            $progresOpname->updateby_id = Auth::user()->id;
            $progresOpname->update_time = date('Y-m-d H:i:s');
            $progresOpname->save();
        }

        return response()->json(["success" => 1, 'alert-success'=> 'Data Opname Master berhasi disimpan!']);
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
        ProgresOpname::where('unit_id',$unitrumah->id)->update(['is_delete',1]);
        // $opnamemaster->delete();
        return redirect()->route('opnamemaster.index')->with('alert-success', 'Data Opname Master berhasi dihapus!');
    }

    public function show2($id)
    {
        $unitrumah = UnitRumah::findOrFail($id);
        $opnamemasters = ProgresOpname::with(['pekerjaan.kategori_pekerjaan'])->where('unit_id',$unitrumah->id)->get();
        return response()->json([
            'data'=>$opnamemasters,
        ]);
    }

}
