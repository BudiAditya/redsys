<?php

use Illuminate\Database\Seeder;
use App\RabPekerjaanUnit;
class RABPekerjaanUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         for($i=0;$i<5;$i++){
    		$rabmaterialunit = new RabPekerjaanUnit;
            $rabmaterialunit->unit_id = rand(1,3);
            $rabmaterialunit->pekerjaan_id = rand(1,5);
            $rabmaterialunit->qty = 1;
            $rabmaterialunit->price = rand(1,1000);
            $rabmaterialunit->createdby_id = 1;
            $rabmaterialunit->save();
    	}
    }
}
