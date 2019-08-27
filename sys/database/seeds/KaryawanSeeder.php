<?php

use Illuminate\Database\Seeder;
use App\Karyawan;
class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$dataArray = ["Pengawas","Arsitek","Marketing"];
        for($i=0;$i<5;$i++){
    		$data = new Karyawan;
    		$data->nama = "Karyawan ".($i+1);
    		$data->alamat = "Kota ".($i+1);
    		$data->bagian_id = 1;
    		$data->hp_no = rand(0,15000);
    		$data->keterangan = "OK Generated";
    		$data->createdby_id = 1;
    		$data->save();
    	}

    }
}
