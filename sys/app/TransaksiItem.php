<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiItem extends Model
{
    //
    protected $table = 'm_transaksi';
    protected $guarded = ['id'];

    public function items(){
    	return $this->hasMany('App\Item','transaski_id');
    }
    public function gudang(){
    	return $this->belongsTo('App\Gudang');
    }
}
