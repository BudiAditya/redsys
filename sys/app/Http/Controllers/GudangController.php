<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Gudang;
class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=Gudang::where('is_delete',0)->get();
        return view('gudang.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gudang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gudang = new Gudang;
        $gudang->nama = $request->nama;
        $gudang->keterangan = $request->keterangan;
        $gudang->createdby_id = Auth::user()->id;
        $gudang->save();
        return redirect('/gudang');
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
        $gudang = Gudang::find($id);
        if($gudang!=null)
            return view('gudang.edit',compact('gudang'));
        else
            return redirect('/gudang');
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
        $gudang = Gudang::find($id);
        if($gudang!=null){
            $gudang->nama = $request->nama;
            $gudang->keterangan = $request->keterangan;
            $gudang->updateby_id = Auth::user()->id;
            $gudang->save();
        }
        return redirect('/gudang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gudang = Gudang::find($id);
        if($gudang!=null){
            $gudang->is_delete = 1;
            $gudang->save();
        }
        return redirect('/gudang');
    }
}
