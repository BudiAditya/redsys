<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitRumah extends Model
{
    protected $table = 'm_unitrumah';
    protected $guarded = ['id']; 
    public $timestamps = false;

    public function typerumah(){
    	return $this->belongsTo('App\TypeRumah','type_id');
    }

    public function proyek(){
    	return $this->belongsTo('App\Proyek','proyek_id');
    }

    public function customer(){
    	return $this->belongsTo('App\Customer','customer_id');
    }

    public function arsitek(){
        return $this->belongsTo('App\Karyawan','arsitek_id');
    }

    public function marketing(){
        return $this->belongsTo('App\Karyawan','marketing_id');
    }

    public function pengawas(){
        return $this->belongsTo('App\Karyawan','pengawas_id');
    }

    public function pekerja(){
        return $this->belongsTo('App\Pekerja','pekerja_id');
    }

    public function rabmaterialunits(){
        return $this->hasMany('App\RabMaterialUnit','unit_id');
    }

    public function rabpekerjaanunits(){
        return $this->hasMany('App\RabPekerjaanUnit','unit_id');
    }

    public function pakaimaterials(){
        return $this->hasMany('App\PakaiMaterial','unit_id');
    }

    public function progresopnammes(){
        return $this->hasMany('App\ProgresOpname','unit_id');
    }
}
