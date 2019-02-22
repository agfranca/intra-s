<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Empresa extends Model
{
     public function noticias()
   {
   	// return  $this->hasMany('App\Noticia','departamento__noticias');
   	  return $this->belongsToMany('App\Noticia','departamento__noticias');
 
   	 // return $this->belongsToMany('App\Noticia','departamento__noticias');
   }


   public function departamentos()
    {
        return $this->hasMany('App\Departamento');
    }

    public static function empresa_user_logado()
    {
         //retorna o departamento do usuario logado
        $departamento_id = Auth::user()->departamento_id;
        //dd($departamento_id);
        $empresa_id = Departamento::where('id',$departamento_id)->get()->first(); 
        //dd($empresa_id);
        //retorna o objeto empresa do usuario logado
        $empresa = Empresa::where('id',$empresa_id->empresa_id)->get()->first();

        return $empresa;
    }


    public static function empresas_painel(Empresa $empresa)
    {
        static $count;
        static $todasempresas=[];
        $todasempresas = collect($todasempresas);
        $todasempresas -> push($empresa);
        $count++;

        //dd($todasempresas);
        //retorna as empresas filhos da empresa enviada
        $filhos = Empresa::empresasfilhos($empresa->id);
        //dd($filhos);
        foreach ($filhos as $filho) {
            $netos = Empresa::empresas_painel($filho);
            $count--;
        }
       if ($count==1) {
        return $todasempresas;
       }
    
    }


   public function empresapai()

    {
      return $this->belongsTo("App\Empresa", "empresa_pai");
    }


   	public static function empresasfilhos($id)
    {
     $filhos = Empresa::where('empresa_pai',"{$id}")->get();

     return $filhos;
    } 

    public static function empresaraiz()
    {
     $raiz = Empresa::where('empresa_pai',Null)->get()->first();

     return $raiz;
    }

    public static function listarempresa($id)
    {
     $raiz = Empresa::where('id',$id)->get()->first();

     return $raiz;
    }

    public static function listarempresas($empresas)
    {
    	//Nivel1
    	foreach ($empresas as $empresa ) { 
        	echo "{$empresa->nome} <br>";
        	//Nível2	
        	$empresasN2 = Empresa::empresasfilhos($empresa->id);
        	foreach ($empresasN2 as $empresa ) { 
        	echo "{$empresa->nome} <br>";
        		//Nível3
        		$empresasN3 = Empresa::empresasfilhos($empresa->id);
        		foreach ($empresasN3 as $empresa ) { 
        		echo "{$empresa->nome} <br>";
        		}

        	}

        }
    }




public static function listarempresas2($empresas)
    {
    	//(empty($empresas->empresa_pai)) ? "#" : "$empresas->empresa_pai" ; 
    	static $count;
    	$json_str = '{"id":"", "parent":"", "text": ""}';
    	$myObj =json_decode($json_str);
    	$myObj->id = "{$empresas->id}" ; 
		$myObj->parent = ($count==0) ? "#" : "$empresas->empresa_pai" ; 
		$myObj->text = "{$empresas->nome}" ; 
		static $myJSON;
		$myJSON.= json_encode ($myObj).",";
		

		
		static $count;
		$count++;
		//echo "inicio-$count ";
		//echo "$myJSON,";
		$myJSON2[$count] = json_encode ($myObj);

    	$filhos = Empresa::empresasfilhos($empresas->id);
    	foreach ($filhos as $empresa ) { 
        	Empresa::listarempresas2($empresa);
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



    public static function empresas_painel_tree()
    {

        //retorna o id do departamento do usuario logado
        $departamentos_id = Auth::user()->departamento_id;

        //Retorna o departamento do usuário logado
        $departamento_usuario = DB::table('departamentos')->where('id',$departamentos_id)->first();
        
        //Retorna o id da empresa do usuario logado
        $empresa_id = $departamento_usuario->empresa_id;  
        //dd($empresa_id);
        //retorna o objeto empresa do usuario logado
        $empresa = Empresa::where('id',$empresa_id)->get()->first();   
        //dd($empresa);
        //Lista as Empresas da empresa do Usuario Logado
        $teste=Empresa::listarempresas2($empresa);

       //dd($teste);
        return $teste;

     }   


public static function listarempresasdepartamentos($empresas)
    {
        //(empty($empresas->empresa_pai)) ? "#" : "$empresas->empresa_pai" ; 
        static $count;
        $json_str = '{"id":"", "parent":"", "text": ""}';
        $myObj =json_decode($json_str);
        $myObj->id = "{$empresas->id}" ; 
        $myObj->parent = ($count==0) ? "#" : "$empresas->empresa_pai" ; 
        $myObj->text = "{$empresas->nome}" ;
        
        $myObj->state ='{"selected": true}';
        static $myJSON;
        $myJSON.= json_encode ($myObj).",";
        
        $departamentos = $empresas->departamentos;
        //dd($departamentos);
        foreach ($departamentos as $departamento ) {
            $myObj->id = "{$departamento->id}"."D" ; 
            $myObj->parent = "$departamento->empresa_id" ; 
            $myObj->text = "{$departamento->nome}" ;
            $myObj->state ='{"selected": false}'; 
            $myJSON.= json_encode ($myObj).",";
        }
        
        //dd($myJSON);


        static $count;
        $count++;
        //echo "inicio-$count ";
        //echo "$myJSON,";
        $myJSON2[$count] = json_encode ($myObj);

        $filhos = Empresa::empresasfilhos($empresas->id);
        //dd($filhos);
        foreach ($filhos as $empresa ) { 
            Empresa::listarempresasdepartamentos($empresa);
            $count--;
            //echo "meio-$count ";
        }
       
       //echo "final-$count ";
       if ($count==1) {
        //Ultimo a ser preocessado.
        //echo "$myJSON";
        //dd($myJSON);
        return $myJSON;
       }
       

    }






public static function listarempresasdepartamentoseditar($empresas)
    {
        //(empty($empresas->empresa_pai)) ? "#" : "$empresas->empresa_pai" ; 
        static $count;
        $json_str = '{"id":"", "parent":"", "text": ""}';
        $myObj =json_decode($json_str);
        $myObj->id = "{$empresas->id}" ; 
        $myObj->parent = ($count==0) ? "#" : "$empresas->empresa_pai" ; 
        $myObj->text = "{$empresas->nome}" ; 
        static $myJSON;
        $myJSON.= json_encode ($myObj).",";
        
        $departamentos = $empresas->departamentos;
        //dd($departamentos);
        foreach ($departamentos as $departamento ) {
            $myObj->id = "{$departamento->id}"."D" ; 
            $myObj->parent = "$departamento->empresa_id" ; 
            $myObj->text = "{$departamento->nome}" ; 
            $myJSON.= json_encode ($myObj).",";
        }
        
        //dd($myJSON);


        static $count;
        $count++;
        //echo "inicio-$count ";
        //echo "$myJSON,";
        $myJSON2[$count] = json_encode ($myObj);

        $filhos = Empresa::empresasfilhos($empresas->id);
        //dd($filhos);
        foreach ($filhos as $empresa ) { 
            Empresa::listarempresasdepartamentos($empresa);
            $count--;
            //echo "meio-$count ";
        }
       
       //echo "final-$count ";
       if ($count==1) {
        //Ultimo a ser preocessado.
        //echo "$myJSON";
        //dd($myJSON);
        return $myJSON;
       }
       

    }











}