<?php

use Illuminate\Database\Seeder;
use App\TypeRumah;
class TypeRumahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<5;$i++){
    		$data = new TypeRumah;
    		$data->type = "Type ".($i+1);
    		$data->luas_tanah = rand(0,15000);
    		$data->luas_bangunan = rand(0,15000);
    		$data->keterangan = "OK Generated";
    		$data->createdby_id = 1;
    		$data->save();
    	}
    }
}
