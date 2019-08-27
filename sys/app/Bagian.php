<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    protected $table = 'm_bagian';
    protected $guarded = ['id'];

    public function karyawans(){
    	return $this->hasMany('App\Karyawan','bagian_id');
    }
}
