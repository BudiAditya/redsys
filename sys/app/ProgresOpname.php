<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgresOpname extends Model
{
    //
    public $timestamps = false;
    protected $table = 't_progres_opnames';
    protected $guarded = ['id']; 

    public function pekerjaan(){
    	return $this->belongsTo('App\Pekerjaan','pekerjaan_id');
    }

    public function unitrumah(){
    	return $this->belongsTo('App\UnitRumah','unit_id');
    }
}
