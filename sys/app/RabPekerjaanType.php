<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RabPekerjaanType extends Model
{
    //
    protected $table = 'm_rab_pekerjaan_bytype';
    protected $guarded = ['id']; 
    public $timestamps = false;

    public function pekerjaan(){
    	return $this->belongsTo('App\Pekerjaan','pekerjaan_id');
    }

    public function typerumah(){
    	return $this->belongsTo('App\TypeRumah','type_id');
    }
}
