<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    public function records()
    {
      return $this->belongsTo('App\Record');
    }
}
