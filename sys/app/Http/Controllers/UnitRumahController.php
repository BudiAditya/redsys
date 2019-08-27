<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UnitRumah;
use App\TypeRumah;
use Auth;
use App\Proyek;
use App\Customer;
use App\Karyawan;
use App\Pekerja;

class UnitRumahController extends Controller
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
        $unitrumahs = UnitRumah::where('is_delete',0)->get();
        return view('unitrumah.index',compact('unitrumahs','typerumahs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typerumahs = TypeRumah::where('is_delete',0)->get();
        $proyeks = Proyek::where('is_delete',0)->where('status',1)->get();
        $pekerjas = Pekerja::where('is_delete',0)->get();
        $customers = Customer::where('is_delete',0)->get();
        $karyawans = Karyawan::where('is_delete',0)->get();
        return view('unitrumah.create',compact('typerumahs','proyeks','customers','karyawans','pekerjas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new UnitRumah;
        $data->type_id = $request->type;
        $data->alamat = $request->alamat;
        $data->proyek_id = $request->proyek_id;
        
        $data->luas_bangunan = $request->luas_bangunan;
        $data->luas_tanah = $request->luas_tanah;

        $data->status_pekerjaan = $request->status_pekerjaan;
        $data->status_progress = $request->status_progress;
        $data->customer_id = $request->customer_id;
        
        if(empty($request->mulai_bangun))
            $data->mulai_bangun = null;
        else
            $data->mulai_bangun = date('Y-m-d',strtotime($request->mulai_bangun));

        if(empty($request->selesai_bangun))
            $data->selesai_bangun = null;
        else
            $data->selesai_bangun = date('Y-m-d',strtotime($request->selesai_bangun));

        if(empty($request->tst_kunci))
            $data->tst_kunci = null;
        else
            $data->tst_kunci = date('Y-m-d',strtotime($request->tst_kunci));
        // $data->selesai_bangun = date('Y-m-d',strtotime($request->selesai_bangun));
        // $data->tst_kunci = date('Y-m-d',strtotime($request->tst_kunci));
        
        $data->keterangan = $request->keterangan;
        $data->status_beli = $request->status_beli;

        $data->pekerja_id = $request->pekerja_id;
        $data->arsitek_id = $request->arsitek_id;
        $data->pengawas_id = $request->pengawas_id;
        $data->marketing_id = $request->marketing_id;

        $data->createdby_id = Auth::user()->id;
        $data->save();
        return redirect()->route('unitrumah.index')->with('alert-success', 'Berhasil Menambahkan Data Type Rumah!');
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
        $unitrumah = UnitRumah::findOrFail($id);
        $typerumahs = TypeRumah::where('is_delete',0)->get();
        $proyeks = Proyek::where('is_delete',0)->where('status',1)->get();
        $pekerjas = Pekerja::where('is_delete',0)->get();
        $customers = Customer::where('is_delete',0)->get();
        $karyawans = Karyawan::where('is_delete',0)->get();

        return view('unitrumah.edit', compact('unitrumah','typerumahs','proyeks','customers','karyawans','pekerjas'));
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
        $data = UnitRumah::findOrFail($id);
        $data->type_id = $request->type;
        $data->alamat = $request->alamat;
        $data->proyek_id = $request->proyek_id;
        $data->luas_bangunan = $request->luas_bangunan;
        $data->luas_tanah = $request->luas_tanah;
        $data->status_pekerjaan = $request->status_pekerjaan;
        $data->status_progress = $request->status_progress;
        $data->status_beli = $request->status_beli;
        $data->customer_id = $request->customer_id;
        
        // $data->mulai_bangun = date('Y-m-d',strtotime($request->mulai_bangun));
        // $data->selesai_bangun = date('Y-m-d',strtotime($request->selesai_bangun));
        // $data->tst_kunci = date('Y-m-d',strtotime($request->tst_kunci));

        if(empty($request->mulai_bangun))
            $data->mulai_bangun = null;
        else
            $data->mulai_bangun = date('Y-m-d',strtotime($request->mulai_bangun));

        if(empty($request->selesai_bangun))
            $data->selesai_bangun = null;
        else
            $data->selesai_bangun = date('Y-m-d',strtotime($request->selesai_bangun));

        if(empty($request->tst_kunci))
            $data->tst_kunci = null;
        else
            $data->tst_kunci = date('Y-m-d',strtotime($request->tst_kunci));
        
        $data->keterangan = $request->keterangan;

        if(empty($request->marketing_id))
            $data->marketing_id = null;
        else
            $data->marketing_id = $request->marketing_id;
        // $data->marketing_id = $request->marketing_id;

        if(empty($request->arsitek_id))
            $data->arsitek_id = null;
        else
            $data->arsitek_id = $request->arsitek_id;

        if(empty($request->pengawas_id))
            $data->pengawas_id = null;
        else
            $data->pengawas_id = $request->pengawas_id;

        $data->pekerja_id = $request->pekerja_id;
        // $data->arsitek_id = $request->arsitek_id;
        // $data->pengawas_id = $request->pengawas_id;
        // $data->marketing_id = $request->marketing_id;

        $data->updateby_id = Auth::user()->id;
        $data->update_time = date("Y-m-d H:i:s");
        $data->save();
        return redirect()->route('unitrumah.index')->with('alert-success', 'Berhasil Mengubah Data Unit Rumah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = UnitRumah::findOrFail($id);
        foreach($data->rabmaterialunits as $rabmaterialunit){
            $rabmaterialunit->is_delete=1;
            $rabmaterialunit->save();
        }

        foreach($data->rabpekerjaanunits as $rabpekerjaanunit){
            $rabpekerjaanunit->is_delete=1;
            $rabpekerjaanunit->save();
        }

        // $data->rabmaterialunits()->delete();
        // $data->rabpekerjaanunits()->delete();
        $data->is_delete=1;
        $data->save();
        return redirect()->route('unitrumah.index')->with('alert-success', 'Data Unit Rumah berhasi dihapus!');
    }
}
