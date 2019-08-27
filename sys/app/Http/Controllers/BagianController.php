<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bagian;
use Auth;
class BagianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/bagian/create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bagians = Bagian::where('is_delete',0)->get();
        return view('bagian.create',compact('bagians'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bagian = new Bagian;
        $bagian->nama = $request->nama;
        $bagian->keterangan = $request->keterangan;
        $bagian->createdby_id = Auth::user()->id;
        $bagian->save();
        return redirect('/bagian/create');
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
        $bagian = Bagian::find($id);
        if($bagian!=null){
            return view('bagian.edit',compact('bagian'));
        }
        return redirect('/bagian/create');
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
        $bagian = Bagian::find($id);
        if($bagian!=null){
            $bagian->nama = $request->nama;
            $bagian->keterangan = $request->keterangan;
            $bagian->createdby_id = Auth::user()->id;
            $bagian->save();
        }
        return redirect('/bagian/create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bagian = Bagian::find($id);
        if($bagian!=null){
            $bagian->is_delete = 1;
            $bagian->save();

            foreach($bagian->karyawans as $karyawan){
                $karyawan->is_delete = 1;
                $karyawan->save();
                foreach($karyawan->unit_arsiteks as $unit_arsitek){
                    $unit_arsitek->arsitek_id = null;
                    $unit_arsitek->save();
                }

                foreach($karyawan->unit_marketings as $unit_marketing){
                    $unit_marketing->marketing_id = null;
                    $unit_marketing->save();
                }

                foreach($karyawan->unit_pengawases as $unit_pengawas){
                    $unit_pengawas->pengawas_id = null;
                    $unit_pengawas->save();
                }
            }
        }
        return redirect('/bagian/create');
    }
}
