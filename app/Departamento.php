<?php

namespace App;
use App\User;
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
        
        if (Auth::user()-> hasRole ( 'AdminSetor')) {
          $todosdepartamentos = Departamento::listardepartamentoefilhosview($empresa_id);
            //dd($todosdepartamentos);
          return $todosdepartamentos;
        }        
        //dd($empresa_id->nome);
        //retorna o objeto empresa do usuario logado
        $empresa = Empresa::where('id',$empresa_id->empresa_id)->get()->first();   
        //dd($empresa->nome);
        //retorna os departamentos da empresa
        $departamentos = $empresa->departamentos;
        //dd($departamentos);
        $filhos = Empresa::empresasfilhos($empresa->id);
        //dd($filhos);

        static $departamentosfilhos=[];
        $departamentosfilhos = collect($departamentosfilhos);

        if (!is_null($filhos)) {
            
            foreach ($filhos as $filho) {
                $departamentosfilhos = $departamentosfilhos->merge($filho->departamentos);
                //dd($departamentosfilhos);
            }
            //dd($departamentosfilhos);
            //dd($departamentos);
            $todosdepartamentos = $departamentos->merge($departamentosfilhos);
            //dd($todosdepartamentos);
            return $todosdepartamentos;
        }
         $todosdepartamentos = $departamentos;   
        //dd($todosdepartamentos);
        return $todosdepartamentos;
    }


    public static function listardepartamentoefilhos($departamento)
    {
        static $count;
        $json_str = '{"id":"", "parent":"", "text": ""}';
        $myObj =json_decode($json_str);
        $myObj->id = "{$departamento->id}" ; 
        $myObj->parent = ($count==0) ? "#" : "$departamento->departamento_pai" ; 
        $myObj->text = "{$departamento->nome}" ;
        $myObj->state ='{"selected": true}';

        static $myJSON;
        $myJSON.= json_encode ($myObj).",";
        
        static $count;
        $count++;        

        $filhos = Departamento::where('departamento_pai',$departamento->id)->get();
      foreach ($filhos as $departamento ) { 
          Departamento::listardepartamentoefilhos($departamento);
          $count--;
      //echo "meio-$count ";
        }
       
       //echo "final-$count ";
       if ($count==1) {
        //Ultimo a ser preocessado.
        //echo "$myJSON";
        return $myJSON;
       }

    }

    public static function listardepartamentoefilhosview($departamento)
    {
        //dd($departamento->id);
        static $myJSON;
        $myJSON = collect($myJSON);
        $myJSON->push($departamento);
        //dd($myJSON);
        static $count;
        $count++;        

        $filhos = Departamento::where('departamento_pai',$departamento->id)->get();
      foreach ($filhos as $departamento2 ) { 
          Departamento::listardepartamentoefilhosview($departamento2);
          $count--;
      //echo "meio-$count ";
        }
       
       //echo "final-$count ";
       if ($count==1) {
        //Ultimo a ser preocessado.
        //echo "$myJSON";
        //dd('Alexandre');
        //dd($myJSON);
        return $myJSON;
       }

    }

}
