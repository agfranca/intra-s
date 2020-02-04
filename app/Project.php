<?php

namespace App;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //

    public function empresa()
    {
        return $this->belongsTo('App\Empresa');
    }

 	public function departamento()
    {
        return $this->belongsTo('App\Departamento');
    }

    public function projecttype()
    {
        return $this->belongsTo('App\Projecttype');
    }


	public function tarefa()
    {
        return $this->hasMany('App\Tarefa');
    }


    public static function projetos()
   {

    $projetos= Auth::user()->project->sortByDesc('created_at');
    //dd($projetos);
    return $projetos;
   }
}
