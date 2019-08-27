<?php

use Illuminate\Database\Seeder;
use App\Customer;
class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i=0;$i<5;$i++){
    		$data = new Customer;
    		$data->nama = "Customer ".($i+1);
    		$data->alamat = "Kota ".($i+1);
    		$data->id_card = rand(0,15000);
    		$data->hp_no = rand(0,15000);
    		$data->keterangan = "OK Generated";
    		$data->createdby_id = 1;
            $data->save();
    	}
    }
}
