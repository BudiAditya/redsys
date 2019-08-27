<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KatMaterial extends Model
{
    protected $table = 'm_kategori_material';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function materials(){
    	return $this->hasMany('App\Material','kategori_id');
    }


}
