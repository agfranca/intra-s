<?php

namespace App;
//Use testados
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;


//Verificar necessidade de uso
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Noticia;
use App\User;
use App\Departamento;
use App\Empresa;
use App\Departamento_Noticia;
use Illuminate\Auth\Access\Gate;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Noticia extends Model
{
  public function departamentos()
   {
   	 return $this->belongsToMany('App\Departamento','departamento__noticias');
   }

  public function usuario()
    {
      return $this->belongsTo('App\User','user_id');
    }

  //
   public static function noticias()
   {
   	 //retorna o departamento do usuario logado
        $departamentos_id = Auth::user()->departamento_id;
        //Retorna as Noticias do Usuario logado        
        $noticias = DB::table('noticias')
                            ->join('departamento__noticias','noticias.id','=','departamento__noticias.noticia_id')
                            ->select('noticias.*','departamento__noticias.departamento_id')
                            ->where('departamento__noticias.departamento_id','=',$departamentos_id)
                            ->get();
        return $noticias;
   }

   public static function noticias_site()
   {
   	 //retorna o id do departamento do usuario logado
     	$departamentos_id = Auth::user()->departamento_id;

    //Retorna o departamento do usuário logado
    	$departamento = Departamento::where('id',$departamentos_id)->get()->first();

    //Retorna as Noticias do departamento do Usuario Logado
    	$noticias= $departamento->noticias;
		
		return $noticias;
   }


   public static function noticias_painel()
   {
   	 //testa se o usuario logado é Administrador
      $admin =  Auth::user()-> hasRole ( 'Admin' );

     //retorna o id do departamento do usuario logado
      $departamentos_id = Auth::user()->departamento_id;

      //retorna o id do usuario logado
      $user_id = Auth::user()->id;

    //Retorna o departamento do usuário logado
      $departamento = Departamento::where('id',$departamentos_id)->get()->first();

    //Retorna as Noticias do departamento do Usuario Logado
      $todasnoticias= $departamento->noticias;

      static $listarnoticias=[];
      $listarnoticias = collect($listarnoticias);             



         if($admin == 'true') {

            $todosdepartamentos = Departamento::departamento_painel();
            //dd($todosdepartamentos);
            static $todasnoticias=[];
            $todasnoticias = collect($todasnoticias);

            static $noticiasagrupadas=[];
            $noticiasagrupadas = collect($noticiasagrupadas);

            static $noticiasredirecionadas=[];
            $noticiasredirecionadas = collect($noticiasredirecionadas);

            static $listarnoticias=[];
            $listarnoticias = collect($listarnoticias);

            foreach ($todosdepartamentos as $departamento) {
              //dd($departamento);
              $noticiasdodepartamento = Departamento_Noticia::noticiasdodepartamento($departamento->id);
              //dd($noticiasdodepartamento);
              
              $todasnoticias->push($noticiasdodepartamento);
              //$todasnoticias->merge($noticiasdodepartamento);

              //*****Comentei dia 13/09/2018 mudando para conseguir pegar quem redestribuiu

              /*if (!is_null($noticiasdodepartamento)) {

                foreach ($noticiasdodepartamento as $noticiadodepartamento) {
                 
                 $noticia = Noticia::where('id',$noticiadodepartamento->noticia_id)->get()->first();

                 $todasnoticias->push($noticia);
                 //dd($todasnoticias);
                }
              }*/
              //*****Temina AQUI!!!!!!!



            }
    



          foreach ($todasnoticias as $noticia) {
          foreach ($noticia as $listar) {
            if ($listar->redistribuir_noticias_id == Null){
            $noticiasagrupadas->push($listar);              
            } else{
            $listarnoticias->push($listar);  
            }
            //$listarnoticias->push($listar);
          }
        }
        $noticiasagrupadas=$noticiasagrupadas->unique("noticia_id");
        //Pensar melhor esta Junção

        foreach ($noticiasagrupadas as $noticia) {
          $listarnoticias->push($noticia);
        }


            } else {
            //Retorna as Noticias do departamento do Usuario Logado
            //Falta verificar -----  

             $noticiasdousuario = Departamento_Noticia::noticiasdousuario($user_id); 
             return $noticiasdousuario;
             /* $noticiasdodepartamento = Departamento_Noticia::noticiasdodepartamento($departamento->id);
              return $noticiasdodepartamento;*/ 

         }
         
        //dd($listarnoticias);
         return $listarnoticias;
         
   }






//EXEMPLOS   

            //retorna o id do departamento do usuario logado
           // $departamentos_id = Auth::user()->departamento_id;

            //Retorna o objeto departamento do usuário logado
           // $departamento = Departamento::where('id',$departamentos_id)->get()->first();

            //Retorna o id da empresa do usuario logado
            //$empresa_id = $departamento->empresa_id;

            //Retorna o objeto empresa do usuário logado
            //$empresa = Empresa::where('id',$empresa_id)->get()->first();

            //Retorna todas as Empresas abaixo da empresas do usuario

            // $todasempresas = Empresa::empresas_painel($empresa);

            //Retorna as Noticias da empresa do Usuario Logado
           // $noticias= $empresa->noticias;

            //------------------xxx------------------xxx----------------------










//TESTES XXXXXXXXXXXXXX



   public function noticias_admin_logado()
        {
            

            
            return view('painel.noticias.departamento', compact('noticias'));
        }



public function noticias_usuario_logado()
        {
            //testa se o usuario logado é Administrador
            $admin =  Auth::user()-> hasRole ( 'Admin' );
            
            //retorna o id do departamento do usuario logado
            $departamentos_id = Auth::user()->departamento_id;

            //Retorna o departamento do usuário logado
            $departamento = Departamento::where('id',$departamentos_id)->get()->first();

             //Retorna as Noticias do departamento do Usuario Logado
            $noticias= $departamento->noticias;

             
            return view('painel.noticias.departamento', compact('noticias'));
        }


public function testes()
        {
            //testa se o usuario logado é Administrador
            $admin =  Auth::user()-> hasRole ( 'Admin' );
            
            //retorna o id do departamento do usuario logado
            $departamentos_id = Auth::user()->departamento_id;

            //Retorna o departamento do usuário logado
              $departamento_usuario = DB::table('departamentos')->where('id',$departamentos_id)->first();

            //Retorna o id da empresa do usuario logado
              $empresa_id = $departamento_usuario->empresa_id;  



            //Retorna o departamento do usuário logado
              $departamento = Departamento::where('id',$departamentos_id)->get()->first();

            //Retorna as Noticias do departamento do Usuario Logado
               $uia= $departamento->noticias;

          

           dd($uia);




            return view('painel.noticias.departamento');
        }






}
