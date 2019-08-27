<?php

use Illuminate\Database\Seeder;
use App\Material;
class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$satuan = ["KG","CM"];
    	for($i=0;$i<5;$i++){
    		$data = new Material;
    		$data->kode = "Kode ".($i+1);
	        $data->kategori_id = rand(1,5);
	        $data->nama_brg = "Material ".($i+1);
	        // $data->ukuran = rand(0,1000);
	        $data->satuan = $satuan[rand(0,1)];
	        $data->harga = rand(0,1000);
	        $data->keterangan = "OK Generated";
	        // $data->is_stock = 1;
	        $data->save();
    	}
        
    }
}
