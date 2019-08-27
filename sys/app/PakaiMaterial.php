<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PakaiMaterial extends Model
{
    public $timestamps = false;
    protected $table = 't_pakai_materials';
    protected $guarded = ['id']; 

    public function material(){
    	return $this->belongsTo('App\Material','material_id');
    }

    public function unitrumah(){
    	return $this->belongsTo('App\UnitRumah','unit_id');
    }
}
