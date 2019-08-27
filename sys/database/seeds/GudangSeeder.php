<?php

use Illuminate\Database\Seeder;
use App\Gudang;
class GudangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<3;$i++){
        	$gudang = new Gudang;
        	$gudang->nama = "Gudang ".($i+1);
        	$gudang->keterangan = "Gudang Generated";
        	$gudang->createdby_id = 1;
        	$gudang->save();
        }
    }
}
