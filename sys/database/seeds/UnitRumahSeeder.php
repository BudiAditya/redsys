<?php

use Illuminate\Database\Seeder;
use App\UnitRumah;
class UnitRumahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<3;$i++){
        	$data = new UnitRumah;
	        $data->type_id = rand(1,4);
	        $data->alamat = "Alamat ".($i+1);
	        $data->proyek_id = rand(1,4);
	        
	        $data->luas_bangunan = rand(0,1500);
	        $data->luas_tanah = rand(0,1500);

	        $data->status_pekerjaan = rand(0,1);
	        $data->status_progress = rand(0,1);
	        $data->customer_id = rand(1,4);
	        
	        $data->mulai_bangun = date('Y-m-d');
	        $data->selesai_bangun = date('Y-m-d');
	        $data->tst_kunci = date('Y-m-d');
	        
	        $data->keterangan = "GENERATED OK";

	        $data->pekerja_id = rand(1,4);
	        $data->arsitek_id = rand(1,4);
	        $data->pengawas_id = rand(1,4);
	        $data->marketing_id = rand(1,4);
	        $data->save();
        }
    }
}
