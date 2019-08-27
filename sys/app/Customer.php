<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'm_customer';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function unitrumahs(){
    	return $this->hasMany('App\UnitRumah','customer_id');
    }
}
