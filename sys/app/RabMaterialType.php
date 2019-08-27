<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RabMaterialType extends Model
{
    //
    public $timestamps = false;
    protected $table = 'm_rab_material_bytype';
    protected $guarded = ['id']; 

    public function typerumah(){
    	return $this->belongsTo('App\TypeRumah','type_id');
    }

    public function material(){
    	return $this->belongsTo('App\Material','material_id');
    }
}
