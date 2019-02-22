<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Empresa;

class Departamento extends Model
{
   
   public function noticias()
   {
   	 return $this->belongsToMany('App\Noticia','departamento__noticias');
   }

    public function banners()
   {
     return $this->belongsToMany('App\Banner_Departamento');
   }

public function empresa()
    {
        return $this->belongsTo('App\Empresa');

    }

    public function user()
    {
        return $this->hasMany('App\User');
    }


    public static function departamentos()
    {
       
      $tudo= Empresa::with('empresas')->find(2);

      return $tudo; 

     /* $empresa = App\Models\Empresa();
      $empresa->with('empresas')->find(1);*/
    }


    public static function departamento_painel()
    {
      //retorna o departamento do usuario logado
        $departamento_id = Auth::user()->departamento_id;
        //dd($departamento_id);
        $empresa_id = Departamento::where('id',$departamento_id)->get()->first(); 
        //dd($empresa_id);
        //retorna o objeto empresa do usuario logado
        $empresa = Empresa::where('id',$empresa_id->empresa_id)->get()->first();   
        //dd($empresa);
        //retorna os departamentos da empresa
        $departamentos = $empresa->departamentos;
        //dd($departamentos);
        $filhos = Empresa::empresasfilhos($empresa->id);
        //dd($filhos);
        if (!is_null($filhos)) {

            static $departamentosfilhos=[];
            $departamentosfilhos = collect($departamentosfilhos);

            foreach ($filhos as $filho) {
                $departamentosfilhos = $filho->departamentos;
                //dd($departamentosfilhos);
            }
            $todosdepartamentos = $departamentos->merge($departamentosfilhos);
            return $todosdepartamentos;
        }
         $todosdepartamentos = $departamentos;   
        //dd($todosdepartamentos);
        return $todosdepartamentos;
    }
}
