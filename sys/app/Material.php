<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'm_material';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function rabmaterialtypes(){
    	return $this->hasMany('App\RabMaterialType','material_id');
    }

    public function kategori_material(){
    	return $this->belongsTo('App\KatMaterial','kategori_id');
    }

    public function rabmaterialunits(){
    	return $this->hasMany('App\RabMaterialUnit','material_id');
    }

    public function pakaimaterials(){
        return $this->hasMany('App\PakaiMaterial','material_id');
    }
    public function supplier(){
        return $this->belongsTo('App\Supplier','supplier_id');
    }

    public function items(){
        return $this->hasMany('App\Item','material_id');
    }
}
