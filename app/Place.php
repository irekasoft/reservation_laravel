<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    //
    protected $guarded = [];

    public function facilities(){
    	return $this->hasMany('App\Facility');
    }

}
