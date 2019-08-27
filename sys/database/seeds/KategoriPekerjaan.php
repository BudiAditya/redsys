<?php

use Illuminate\Database\Seeder;
use App\KatPekerjaan;
class KategoriPekerjaan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<5;$i++){
        	$data = new KatPekerjaan;
        	$data->kategori = "Kat Pekerjaan ".($i+1);
        	$data->keterangan = "Ok Generated";
        	$data->save();
        }
    }
}
