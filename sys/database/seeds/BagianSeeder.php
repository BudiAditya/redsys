<?php

use Illuminate\Database\Seeder;
use App\Bagian;
class BagianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<3;$i++){
        	$gudang = new Bagian;
        	$gudang->nama = "Bagian ".($i+1);
        	$gudang->keterangan = "Bagian Generated";
        	$gudang->createdby_id = 1;
        	$gudang->save();
        }
    }
}
