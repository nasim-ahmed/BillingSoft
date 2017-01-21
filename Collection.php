<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
     public function records()
    {
    	return $this->belongsToMany('App\Record');
    }

  
}
