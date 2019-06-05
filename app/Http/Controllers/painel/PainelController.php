<?php

namespace App\Http\Controllers\painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Controllers\painel\TarefasController;
use App\Noticia;
use App\Tarefa;
use App\Banner;
class PainelController extends Controller
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
        $noticiastotal=Noticia::noticias_painel_count();
        $tarefastotal=Tarefa::tarefascount();
        $bannerstotal=Banner::baners_painel_count();
        
        //var_dump($noticiastotal);
        //echo ($noticiastotal);
        //dd($noticiastotal);

        return view('painel.index', compact('noticiastotal','tarefastotal','bannerstotal'));
    }

    public function perfil()
    {
        //return view('home');
        return view('painel\perfil');
    }

}
