<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RabPekerjaanUnit extends Model
{
    //m_rab_pekerjaan_byunit
    protected $table = 'm_rab_pekerjaan_byunit';
    protected $guarded = ['id']; 
    public $timestamps = false;

    public function pekerjaan(){
    	return $this->belongsTo('App\Pekerjaan','pekerjaan_id');
    }
    public function unitrumah(){
    	return $this->belongsTo('App\UnitRumah','unit_id');
    }
}
