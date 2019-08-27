<?php

use Illuminate\Database\Seeder;
use App\RabMaterialUnit;

class RABMaterialUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<5;$i++){
    		$rabmaterialunit = new RabMaterialUnit;
            $rabmaterialunit->unit_id = rand(1,3);
            $rabmaterialunit->material_id = rand(1,5);


            $rabmaterialunit->qty = rand(1,1000);
            $rabmaterialunit->price = rand(1,1000);
            $rabmaterialunit->createdby_id = 1;
            $rabmaterialunit->save();
    	}
    }
}
