<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    protected $table = 'm_pekerjaan';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function kategori_pekerjaan(){
    	return $this->belongsTo('App\KatPekerjaan','kategori_id');
    }

    public function rabpekerjaanunits(){
    	return $this->hasMany('App\RabPekerjaanUnit','pekerjaan_id');
    }

    public function rabpekerjaantypes(){
    	return $this->hasMany('App\RabPekerjaanType','pekerjaan_id');
    }

    public function progresopnammes(){
        return $this->hasMany('App\ProgresOpname','pekerjaan_id');
    }
}
