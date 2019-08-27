<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pekerja extends Model
{
    protected $table = 'm_pekerja';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function unitrumahs(){
    	return $this->hasMany('App\UnitRumah','pekerja_id');
    }
}
