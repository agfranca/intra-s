<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\Departamento;

class Projecttype extends Model
{
     public function departamento()
    {
        return $this->belongsTo('App\Departamento');
    }

    public function projecttypecombo()
    {
        return $this->belongsTo('App\Projecttypecombo','id','projecttype_id' );
    }

}
