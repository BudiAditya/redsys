<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeRumah extends Model
{
    protected $table = 'm_typerumah';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function unitrumahs(){
    	return $this->hasMany('App\UnitRumah','type_id');
    }

    public function rabmaterialtypes(){
    	return $this->hasMany('App\RabMaterialType','type_id');
    }

    public function rabpekerjaantypes(){
    	return $this->hasMany('App\RabPekerjaanType','type_id');
    }
}
