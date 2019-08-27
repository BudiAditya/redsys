<?php

use Illuminate\Database\Seeder;
use App\RabPekerjaanType;
class RABPekerjaanTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<5;$i++){
    		$rabmaterialtype = new RabPekerjaanType;
	        $rabmaterialtype->type_id = rand(1,4);
	        $rabmaterialtype->pekerjaan_id = rand(1,4);
	        $rabmaterialtype->qty = 1;
	        $rabmaterialtype->price = rand(1,1500);
	        $rabmaterialtype->createdby_id = 1;
	        $rabmaterialtype->save();
    	}
    }
}
