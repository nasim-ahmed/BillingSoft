<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    
  
	public function payments()
	{
       return $this->hasMany('App\Payment');

	}
	public function collections()
	{
		return $this->hasMany('App\Collection');
	}
}