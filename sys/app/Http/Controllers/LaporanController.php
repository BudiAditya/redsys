<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IzinOperasi;
use App\SuratJalan;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	public function __construct(){
    	$this -> middleware('auth');    	
    	//$this -> middleware('akses:2');
    } 
	 
    public function index(Request $request)
    {
        $izinOperasi = IzinOperasi::select([
            'id', 'user_id', 'kategori_id', 'kendaraan_id', 'merek_id',
            'no_pol', 'pemilik', 'alamat_pemilik', 'warna', 'tahun',
            'nochasis', 'nomesin', 'pemakai', 'alamat_pemakai', 'awal',
            'ahir', DB::raw("'Izin Operasi' as type"), 'created_at', 'updated_at'
        ]);

        $suratJalan = SuratJalan::select([
            'id', 'user_id', 'kategori_id', 'kendaraan_id', 'merek_id',
            'no_pol', 'pemilik', 'alamat_pemilik', 'warna', 'tahun',
            'nochasis', 'nomesin', 'pemakai', 'alamat_pemakai', 'awal',
            'ahir', DB::raw("'Surat Jalan' as type"), 'created_at', 'updated_at'
        ]);

        if ($request->date_min) {
            $izinOperasi->where('created_at', '>=', $request->date_min);
            $suratJalan->where('created_at', '>=', $request->date_min);
        }

        if ($request->date_max) {
            $izinOperasi->where('created_at', '<=', $request->date_max);
            $suratJalan->where('created_at', '<=', $request->date_max);
        }

        $data = $izinOperasi->union($suratJalan)->get();

        return view('laporan.index', compact('data'));
    }
}
