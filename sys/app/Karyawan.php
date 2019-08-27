<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'm_karyawan';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function unit_arsiteks(){
        return $this->hasMany('App\UnitRumah','arsitek_id');
    }

    public function unit_marketings(){
        return $this->hasMany('App\UnitRumah','marketing_id');
    }

    public function unit_pengawases(){
        return $this->hasMany('App\UnitRumah','pengawas_id');
    }
    public function bagian(){
        return $this->belongsTo('App\Bagian','bagian_id');
    }
}
