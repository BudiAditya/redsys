<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = "levels";

    protected $fillable = ['levels'];
    public $timestamps = false;

    public function user(){
    	return $this->hasMany(User::class);
    }
}
