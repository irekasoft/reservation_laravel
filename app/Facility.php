<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    //
    protected $guarded = [];

    public function place(){
    	return $this->belongsTo('App\Place');
    }

}
