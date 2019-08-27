<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\TransaksiItem;
use App\Item;
use App\Material;
use App\Gudang;
use Validator;
class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi_items = TransaksiItem::all();
        return view('pembelian.index',compact('transaksi_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materials = Material::where('is_delete',0)->get();
        $gudangs = Gudang::where('is_delete',0)->get();
        return view('pembelian.create',compact('materials','gudangs'));
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
            "pembelians" => "required|array",
            "pembelians.*.material_id" => "required|distinct|exists:m_material,id",
            "pembelians.*.qty" => "required|numeric|min:0",
            "jumlah_bayar"=>"required|numeric|min:0",
            "gudang_id"=>"required|exists:m_gudang,id",
        ];

        $arr_messages = [
            "pembelians.required" => "Mohon memilih Material",
            "pembelians.*.material_id.required" => "Material harap dipilih",
            "pembelians.*.material_id.distinct" => "Material duplikasi",
            "pembelians.*.material_id.exists" => "Material tidak terdaftar",

            "pembelians.*.qty.required" => "Qty harap diisi",
            "pembelians.*.qty.numeric" => "Qty harap berupa angka",
            "pembelians.*.qty.min" => "Qty minimal :min",

            "jumlah_bayar.required" => "Jumlah Bayar harap diisi",
            "jumlah_bayar.numeric" => "Jumlah Bayar harap berupa angka",
            "jumlah_bayar.min" => "Jumlah Bayar minimal :min",

            "gudang_id.required" => "Gudang harap dipilih",
            "gudang_id.exists" => "Gudang tidak terdaftar",
        ];

        $validator = Validator::make($request->all(), $arr_validator, $arr_messages);

        // if data not valid
        if($validator->fails())
            return response()->json(["success" => 0, "errors" => $validator->getMessageBag()->toArray()]);

        $transaksi = new TransaksiItem;
        $transaksi->jumlah_bayar = 0;
        $transaksi->createdby_id= Auth::user()->id;
        $transaksi->jumlah_bayar = $request->jumlah_bayar;
        $transaksi->gudang_id = $request->gudang_id;
        $transaksi->save();
        
        foreach($request->pembelians as $pembelian){
            $material = Material::find($pembelian['material_id']);

            $item = new Item;
            
            $item->material_id = $material->id;
            
            $item->qty = $pembelian['qty'];
            
            $item->harga = $material->harga;
            
            $item->is_stock = 1;
            
            $item->transaski_id = $transaksi->id;

            $item->createdby_id = Auth::user()->id;

            $item->save();
        }
        return response()->json(["success" => 1, 'alert-success'=> 'Berhasil Menambahkan Data Pembelian!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = TransaksiItem::find($id);
        if($transaksi!=null)
            return view('pembelian.show',compact('transaksi'));
        return redirect('/pembelianitem');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect('/pembelianitem');
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
        return redirect('/pembelianitem');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = TransaksiItem::find($id);
        if($transaksi!=null){
            $transaksi->items()->delete();
            $transaksi->delete();
        }
        return redirect('/pembelianitem');
    }
}
