<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data=Customer::where('is_delete',0)->get();
        return view('customer.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Customer();
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->id_card = $request->id_card;
        $data->hp_no = $request->hp_no;
        $data->keterangan = $request->keterangan;
        $data->createdby_id = Auth::user()->id;
	    	$data->save();
		    return redirect()->route('customer.index')->with('alert-success', 'Berhasil Menambahkan Data!');
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
        $data = Customer::where('id', $id)->get();
		    return view('customer.edit', compact('data'));
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
        $data = Customer::where('id', $id)->first();
		    $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->id_card = $request->id_card;
        $data->hp_no = $request->no_hp;
        $data->keterangan = $request->keterangan;
        $data->updateby_id = Auth::user()->id;
		    $data->save();
		    return redirect()->route('customer.index')->with('alert-success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Customer::where('id', $id)->first();
        // if($data->unitrumahs()->count()==0){
            $data->is_delete=1;
            $data->save();
            return redirect()->route('customer.index')->with('alert-success', 'Data berhasi dihapus!');
        // }else{
        //     return redirect()->route('customer.index')->with('alert-success', 'Data Gagal dihapus karena memiliki Relasi!');
        // }
    }
}
