<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Departamento_Noticia extends Model
{

//Ligações
  public function usuario()
    {
      return $this->belongsTo('App\User','user_id');
    }

    public function redistribuir_noticia()
    {
      return $this->belongsTo('App\Redistribuir_Noticia','redistribuir_noticias_id');
    }

  public function noticia()
    {
      return $this->belongsTo('App\Noticia','noticia_id');
    }

//-x-x-x-x-x-x-x-x-x-x-x-x-x-x

//Funções
    
    public static function noticiasdodepartamento($id)
   {
   		$todasnoticias = Departamento_Noticia::where('departamento_id',$id)->get();
   		//dd($todasnoticias);
   		return $todasnoticias; 
   }

    
    public static function noticiasdousuario($id)
   {
      $todasnoticias = Departamento_Noticia::where('user_id',$id)->get();
      //dd($todasnoticias);
      return $todasnoticias; 
   }


    
}
