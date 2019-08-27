<?php

use Illuminate\Database\Seeder;
use App\KatMaterial;
class KategoriMaterial extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<5;$i++){
        	$data = new KatMaterial;
        	$data->kategori = "Kat Material ".($i+1);
        	$data->keterangan = "Ok Generated";
        	$data->save();
        }
        // $table->string('kategori',50);
        //     $table->string('keterangan',255)->nullable();
    }
}
