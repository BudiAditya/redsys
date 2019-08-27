<?php

use Illuminate\Database\Seeder;
use App\Supplier;
class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i=0;$i<5;$i++){
    		$supplier = new Supplier;
    		$supplier->nama = "Supplier ".($i+1);
    		$supplier->alamat = "Alamat Supplier ".($i+1);
    		$supplier->keterangan = "Supplier Generated";
    		$supplier->createdby_id = 1;
    		$supplier->save();

    	}
    }
}
