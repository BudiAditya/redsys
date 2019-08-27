<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    protected $table = 'm_proyek';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function unitrumahs(){
    	return $this->hasMany('App\UnitRumah','proyek_id');
    }
}
