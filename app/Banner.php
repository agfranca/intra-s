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

public static function ultimosbanners(){
$ultimosbanners = Banner::banners_painel()->unique('id')->take(4);
//->latest()
//$contar = $ultimosbanners->take(1);
//if($contar>1){
  //dd("FOidá");
//}


foreach ($ultimosbanners as $value) {
  # code...
}
//$ultimosbanners->limit(4)->get();
return $ultimosbanners;   
}

 public static function banners_painel()
 {
//testa se o usuario logado é Administrador
  $admin =  Auth::user()-> hasRole ( 'Admin' );
//retorna o id do departamento do usuario logado
  $departamento_id = Auth::user()->departamento_id;
//retorna o id do usuario logado
  $user = Auth::user()->id;
  
  static $todosbanners=[];
  $todosbanners = collect($todosbanners);

  if($admin == 'true') {
   //dd("É Admin");
   $todosdepartamentos = Departamento::departamento_painel();
  //dd($todosdepartamentos);
   
   foreach ($todosdepartamentos as $departamento) {
    //dd($departamento);
    $bannersdodepartamento = Banner_Departamento::bannersdodepartamento($departamento->id);
    //dd($bannersdodepartamento);
    if (!is_null($bannersdodepartamento)) {

      foreach ($bannersdodepartamento as $bannerdodepartamento) {
       $banner = Banner::where('id',$bannerdodepartamento->banner_id)->get()->first(); 
       $todosbanners->push($banner);
     }

   }
 }

//dd($user);
 //Banners não publicados do Usuario Logado
 $bannersNaoPublicado = Banner::where([['user_id',$user],['publicado','N'] ])->orderBy('updated_at', 'desc')->get()->all();

//dd($bannersNaoPublicado);

if (!is_null($bannersNaoPublicado)) {
      foreach ($bannersNaoPublicado as $bannerdousuario) {
       $todosbanners->push($bannerdousuario);
     }
   }

//dd('Quase no fim');
//dd($todosbanners);
 return $todosbanners->unique();


}else {
  //Banners dos Usuarios Não Administradores

  //Banners não publicados do Usuario Logado
 $bannersdoUsuarioNãoAdmin = Banner::where([['user_id',$user]])->orderBy('updated_at', 'desc')->get()->all();

//dd($bannersNaoPublicado);

if (!is_null($bannersdoUsuarioNãoAdmin)) {
      foreach ($bannersdoUsuarioNãoAdmin as $bannerdousuario) {
       $todosbanners->push($bannerdousuario);
     }
   }

//dd('Quase no fim');
//dd($todosbanners);
 return $todosbanners->unique();

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


  public static function baners_painel_count()
    {
      $banners=Banner::banners_painel();
      //dd($banners);
      return $banners->unique('id')->count('id');
    }



}