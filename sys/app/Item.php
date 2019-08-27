<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //m_item
    protected $table = 'm_item';
    protected $guarded = ['id'];

    public function gudang(){
    	return $this->belongsTo('App\Gudang');
    }

    public function supplier(){
    	return $this->belongsTo('App\Supplier','supplier_id');
    }

    public function material(){
    	return $this->belongsTo('App\Material','material_id');
    }

    public function transaksi(){
        return $this->belongsTo('App\TransaksiItem','transaski_id');
    }
}
