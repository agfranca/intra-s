<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redistribuir_Noticia extends Model
{
    

//Ligações
     public function usuario()
    {
      return $this->belongsTo('App\User','user_id');
    }
}
