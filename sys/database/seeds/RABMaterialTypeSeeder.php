<?php

use Illuminate\Database\Seeder;
use App\RabMaterialType;
class RABMaterialTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i=0;$i<5;$i++){
    		$rabmaterialtype = new RabMaterialType;
	        $rabmaterialtype->type_id = rand(1,4);
	        $rabmaterialtype->material_id = rand(1,4);
	        $rabmaterialtype->qty = rand(1,1500);
	        $rabmaterialtype->price = rand(1,1500);
	        $rabmaterialtype->createdby_id = 1;
	        $rabmaterialtype->save();
    	}
    }
}
