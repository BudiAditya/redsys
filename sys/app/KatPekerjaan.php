<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KatPekerjaan extends Model
{
    protected $table = 'm_kategori_pekerjaan';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function pekerjaans(){
    	return $this->hasMany('App\Pekerjaan','kategori_id');
    }
}
