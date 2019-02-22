<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Usuario_Logado extends Model
{
    public function noticias()
    {
       //retorna o departamento do usuario logado
        $departamentos_id = Auth::user()->departamentos_id;
                
        $noticiasdousuario = DB::table('noticias')
                            ->join('departamento__noticias','noticias.id','=','departamento__noticias.noticias_id')
                            ->select('noticias.*','departamento__noticias.departamentos_id')
                            ->where('departamento__noticias.departamentos_id','=',$departamentos_id)
                            ->get();
        return $noticiasdousuario;
    }
}
