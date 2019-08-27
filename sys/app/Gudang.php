<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    protected $table = 'm_gudang';
    protected $guarded = ['id'];

    public function transaksiitems(){
    	return $this->hasMany('App\Gudang');
    }
}
