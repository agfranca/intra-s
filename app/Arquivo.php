<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    public function banner()
   {
    //return $this->belongsTo('App\Banner');
    return $this->hasMany('App\Banner');
   }
}
