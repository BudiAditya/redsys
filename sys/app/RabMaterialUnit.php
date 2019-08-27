<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RabMaterialUnit extends Model
{
    //
    protected $table = 'm_rab_material_byunit';
    protected $guarded = ['id','unit_id']; 
    public $timestamps = false;

    public function unitrumah(){
    	return $this->belongsTo('App\UnitRumah','unit_id');
    }
    public function material(){
    	return $this->belongsTo('App\Material','material_id');
    }
}
