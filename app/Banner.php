<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Banner;
use App\Banner_Departamento;


class Banner extends Model
{


public function arquivo()
   {
    return $this->belongsTo('App\Arquivo');
    //return $this->hasMany('App\Arquivo');
   }



 public static function banners_painel()
 {

//testa se o usuario logado é Administrador
  $admin =  Auth::user()-> hasRole ( 'Admin' );
//retorna o id do departamento do usuario logado
  $departamento_id = Auth::user()->departamento_id;


  if($admin == 'true') {

   $todosdepartamentos = Departamento::departamento_painel();
    //dd($todosdepartamentos);
   
   static $todosbanners=[];
   $todosbanners = collect($todosbanners);
   
   foreach ($todosdepartamentos as $departamento) {
              //dd($departamento);
    $bannersdodepartamento = Banner_Departamento::bannersdodepartamento($departamento->id);
            //dd($noticiasdodepartamento);
    if (!is_null($bannersdodepartamento)) {

      foreach ($bannersdodepartamento as $bannerdodepartamento) {
       $banner = Banner::where('id',$bannerdodepartamento->banner_id)->get()->first(); 
       $todosbanners->push($banner);
     }

   }
 }
//dd($todosbanners);
 return $todosbanners->unique();


}else {
            //Quando estiver Logado o Usuário
            //Retorna as Noticias do Usuario
            //Falta verificar -----  
            //$bannersdousuario = Banner_Departamento::bannersdodepartamento($departamento_id);
            //dd($bannersdousuario);
            //return $bannersdousuario; 

/*
            static $todosbanners=[];
            $todosbanners = collect($todosbanners);

            $bannersdodepartamento = Banner_Departamento::bannersdodepartamento($departamento_id);
            //dd($noticiasdodepartamento);
            if (!is_null($bannersdodepartamento)) {
              foreach ($bannersdodepartamento as $bannerdodepartamento) {
              $banner = Banner::where('id',$bannerdodepartamento->banner_id)->get()->first(); 
              $todosbanners->push($banner);
              }
            }


            dd($todosbanners);

*/


            //listar os banner cadastrados pelo usuario  

 $user = Auth::user()->id;

 $bannersNaoPublicado = Banner::where([['user_id',$user]])->orderBy('id', 'desc')->get()->all();
//dd($bannersNaoPublicado);
 return $bannersNaoPublicado;







         }


}
//Fazendo esse 19/09/2018
public static function bannersite()
   {
    
     //retorna o id do departamento do usuario logado
      $departamentos_id = Auth::user()->departamento_id;

    //Retorna o departamento do usuário logado
      $departamento = Departamento::where('id',$departamentos_id)->get()->first();
      
    //Retorna as Noticias do departamento do Usuario Logado
    //$banners= $departamento->banners;
    
      $banners_site=Banner_Departamento::where('departamento_id',$departamento->id)->latest()->limit(5)->get();

    static $urls=[];
    $urls = collect($urls);

    foreach ($banners_site as $banner) {
      $img = Banner::where('id',$banner->banner_id)->get()->first();
      //$url = str_slug($img->arquivo->url);
      $url = $img->arquivo->url;
      $urls->push($url);
    }

    //dd($urls);
    return $urls;

  }


}