<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Departamento;
use App\DepartamentoLink;
use Illuminate\Support\Facades\Auth;

class Link extends Model
{
    //

    public function links()
    {
        return $this->hasMany(link::class);
    }

    public function linksFilhos()
	{
    	return $this->hasMany(link::class)->with('links');
	}

	 public function departamentos()
   {
   	 return $this->belongsToMany('App\DepartamentoLink','departamento_links');
   }

    public static function departamentoUsuarioLogado()
   {
   	 
   	 return Auth::user()->departamento_id;
   }

   public static function linksUsuarioLogado()
   {
   	$departamento= Link::departamentoUsuarioLogado();
   	  	 
   	return DepartamentoLink::where('departamento_id',$departamento)->with('link')->get();
   }

   public static function linksCriadoPeloUsuarioLogado()
   {
   	$user_id= Auth::user()->id;
   	  	 
   	return DepartamentoLink::where('user_id',$user_id)->with('link')->get();
   }

   public static function linksLista()
   {

   	$departamentos= Departamento::departamentosLista();
   	static $links;
   	$links = collect($links);

   	if(Auth::user()-> hasRole ( 'Admin|AdminSetor' )){
        foreach ($departamentos as $departamento) {
        $linksDoDepartamento = DepartamentoLink::where('departamento_id',$departamento->id)->get();
        
        $vazia=$linksDoDepartamento->isEmpty();
        if (!$vazia) {
        	foreach ($linksDoDepartamento as $linkDoDepartamento) {	
        		$links -> push($linkDoDepartamento);
        	}
        }
        }

       $links = $links->unique('link_id');
        //dd($links);
        return $links;
    }

    
    if(Auth::user()-> hasRole ( 'User' )){
      

    }


   }


   public static function linksGrupoMenu()
   {

        $grupos = Departamento::departamento_painel();
        static $todosLinks=[];
        $todosLinks = collect($todosLinks);
        static $linksUsuario=[];
        $linksUsuario = collect($linksUsuario);
        static $linksGrupoMenu=[];
        $linksGrupoMenu = collect($linksGrupoMenu);

        foreach ($grupos as $grupo) {
            //Departamento
            $links = $grupo->links()->get();
            //Fazer um push e juntar todos em uma unico Collection
            $todosLinks->push($links);
        }
        
        foreach ($todosLinks as $todosLink) {
            foreach ($todosLink as $link) {
                $linksUsuario->push($link);
            }
        }
        
        $uniques = $linksUsuario->unique('link_id');

        foreach ($uniques as $unique) {
            if (is_null($unique->link->link_id)) {
                $linksGrupoMenu->push($unique->link);
                //dd($unique->link->link);
            }
        }

    return($linksGrupoMenu);

    }
   
   
}
