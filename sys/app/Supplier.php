<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'm_supplier';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function materials(){
        return $this->hasMany('App\Material','supplier_id');
    }
    public function items(){
    	return $this->hasMany('App\Item','supplier_id');
    }
}
