<?php

use Illuminate\Database\Seeder;
use App\Pekerjaan;
class PekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i=0;$i<5;$i++){
    		$data = new Pekerjaan;
    		$data->kategori_id=1;
    		$data->pekerjaan = "Generate ".($i+1);
    		$data->satuan = "Kg";
    		$data->std_harga = rand(0,1000);
    		$data->keterangan = "Ok Generated";
    		$data->save();

    	}
    }
}
