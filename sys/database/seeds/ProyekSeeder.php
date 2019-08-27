<?php

use Illuminate\Database\Seeder;
use App\Proyek;
class ProyekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i=0;$i<5;$i++){
    		$data = new Proyek;
    		$data->entity_id = ($i+1);
    		$data->kode = "Kode ".($i+1);

    		$data->nama = "Proyek ".($i+1);
    		$data->lokasi = "Lokasi ".($i+1);

    		$data->owner = "Owner ".($i+1);
    		$data->anggaran = ($i+1);

    		$data->tgl_mulai = date('Y-m-d');
    		$data->tgl_selesai = date('Y-m-d');


    		// $data->id_card = rand(0,15000);
    		// $data->hp_no = rand(0,15000);
    		// $data->keterangan = "OK Generated";
    		$data->createdby_id = 1;
            $data->save();
    	}
    }
}
