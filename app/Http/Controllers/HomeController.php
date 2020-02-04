<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Noticia;
use App\Banner;
use Carbon\Carbon;
use App\Tarefa;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('home');
        $usuario = auth()->user()->name;
        $noticiasdousuario = Noticia::noticias();
         $img = Image::make('marca/intras.png');
         $avatar = Image::make('marca/avatar.png');
         $banner1 = Image::make('banner/1.jpg');
         $banner2 = Image::make('banner/2.jpg');
         $banner3 = Image::make('banner/3.jpg');
         $banner4 = Image::make('banner/4.jpg');

         $urls_banners = Banner::bannersite(); 









        $hoje = Carbon::today();
        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;

        //Dados
        $tarefas = Tarefa::where('iddestino', '=', $idUsuario)
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->select('tarefas.*', 'users.name')
        ->get();

        //Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->count();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->count();
        $concluido=$tarefas->where('status', 'Concluído')->count();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();


                  
        return view('site/index', compact('usuario','noticiasdousuario','img','avatar','banner1','banner2','banner3','banner4','urls_banners','tarefas','aFazer','emAndamento','paraAprovacao','concluido','vencidas','hoje','idUsuario'));
    }
}
