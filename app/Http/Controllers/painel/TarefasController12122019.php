<?php

namespace App\Http\Controllers\painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Departamento;
use App\Tarefa;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Arquivo;
use App\Arquivo_Tarefas;
use App\Comentario;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Database\Eloquent\SoftDeletes;


//use Yoeunes\Notify\NotifyServiceProvider;


class TarefasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */





    public static function ultimastarefasrecebidas()
    {
        $hoje = Carbon::today();
        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;
        //Dados
        $tarefas = Tarefa::where('iddestino', '=', $idUsuario)
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->select('tarefas.*', 'users.name')
        ->latest()
        ->limit(4)
        ->get();
        return $tarefas;
    }



    public function recebidasTodas()
    {
        $hoje = Carbon::today();
        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;


        //Dados
        $tarefas = Tarefa::where('iddestino', '=', $idUsuario)
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->select('tarefas.*', 'users.name')
        ->get();

        //Dados
       /* $tarefas = DB::table('tarefas')
        ->where('iddestino', '=', $idUsuario)
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->select('tarefas.*', 'users.name')
        ->get();
        */

        //Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->count();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->count();
        $concluido=$tarefas->where('status', 'Concluído')->count();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();
        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje'));
           
        }elseif(Auth::user()-> hasRole ( 'Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id'); 
        
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','departamentos','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje'));
        }

    }


    public function recebidasHoje()
    {

        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;
        $hoje = Carbon::today();
        $hoje2 = Carbon::today()->addDay();
        //dd($hoje);
        
        //Dados
        $tarefas = Tarefa::where('iddestino', '=', $idUsuario)
        ->whereBetween('tarefas.created_at', [$hoje, $hoje2])
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->select('tarefas.*', 'users.name')
        ->get();
        //Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->count();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->count();
        $concluido=$tarefas->where('status', 'Concluído')->count();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();
        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje'));
           
        }elseif(Auth::user()-> hasRole ( 'Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->all(); 
        
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','departamentos','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje'));
        }

    }

        public function recebidasEstaSemana()
    {
        $hoje = Carbon::today();
        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;
        $primeiroDiaDaSemana = Carbon::now()->startOfWeek();
        $ultimoDiaDaSemana = Carbon::now()->endOfWeek();
        //->subDay()
        //Dados
        $tarefas = Tarefa::where('iddestino', '=', $idUsuario)
        ->whereBetween('tarefas.created_at', [$primeiroDiaDaSemana, $ultimoDiaDaSemana])
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->select('tarefas.*', 'users.name')
        ->get();

        //Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->count();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->count();
        $concluido=$tarefas->where('status', 'Concluído')->count();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();
        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje'));
           
        }elseif(Auth::user()-> hasRole ( 'Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->all(); 
        
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','departamentos','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje'));
        }

    }


        public function recebidasEsteMes()
    {
        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;
        $hoje = Carbon::today();
        $primeiroDiaDoMes = Carbon::now()->firstOfMonth();
        $ultimoDiaDoMes = Carbon::now()->lastOfMonth();
        //Dados
        $tarefas = Tarefa::where('iddestino', '=', $idUsuario)
        ->whereBetween('tarefas.created_at', [$primeiroDiaDoMes, $ultimoDiaDoMes])
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->select('tarefas.*', 'users.name')
        ->get();
        //Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->count();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->count();
        $concluido=$tarefas->where('status', 'Concluído')->count();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();
        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje'));
           
        }elseif(Auth::user()-> hasRole ( 'Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->all(); 
        
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','departamentos','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje'));
        }

    }

    public function recebidasfiltro($inicio, $fim)
    {

        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;
        $hoje = Carbon::today();

        //Dados
        $tarefas = Tarefa::where('iddestino', '=', $idUsuario)
        ->whereBetween('tarefas.created_at', [$inicio, $fim])
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->select('tarefas.*', 'users.name')
        ->get();


        //Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->count();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->count();
        $concluido=$tarefas->where('status', 'Concluído')->count();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();
        
        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje','inicio','fim'));
           
        }elseif(Auth::user()-> hasRole ( 'Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->all(); 
        
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','departamentos','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje','inicio','fim'));
        }
        
            

    }    

    public function enviadasTodas()
    {
        $hoje = Carbon::today();
        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;
        
        //Dados
        $tarefas = Tarefa::where('idcriadopor', '=', $idUsuario)
        ->where('iddestino', '<>', $idUsuario)
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->join('users as destino', 'tarefas.iddestino', '=', 'destino.id')
        ->select('tarefas.*', 'users.name','destino.name as destino' )
        ->get();
        
        //Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->count();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->count();
        $concluido=$tarefas->where('status', 'Concluído')->count();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();
        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje'));
           
        }elseif(Auth::user()-> hasRole ( 'Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->all(); 
        
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','departamentos','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje'));
        }

    }

    public function enviadasHoje()
    {

        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;
        $hoje = Carbon::today();
        $hoje2 = Carbon::today()->addDay();
        //dd($hoje);
        
        //Dados
        $tarefas = Tarefa::where('idcriadopor', '=', $idUsuario)
        ->where('iddestino', '<>', $idUsuario)
        ->whereBetween('tarefas.created_at', [$hoje, $hoje2])
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->join('users as destino', 'tarefas.iddestino', '=', 'destino.id')
        ->select('tarefas.*', 'users.name','destino.name as destino' )
        ->get();
        //Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->count();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->count();
        $concluido=$tarefas->where('status', 'Concluído')->count();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();
        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje'));
           
        }elseif(Auth::user()-> hasRole ('Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->all(); 
        
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','departamentos','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje'));
        }

    }

        public function enviadasEstaSemana()
    {
        $hoje = Carbon::today();
        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;
        $primeiroDiaDaSemana = Carbon::now()->startOfWeek();
        $ultimoDiaDaSemana = Carbon::now()->endOfWeek();
        //->subDay()

        //Dados
        $tarefas = Tarefa::where('idcriadopor', '=', $idUsuario)
        ->where('iddestino', '<>', $idUsuario)
        ->whereBetween('tarefas.created_at', [$primeiroDiaDaSemana, $ultimoDiaDaSemana])
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->join('users as destino', 'tarefas.iddestino', '=', 'destino.id')
        ->select('tarefas.*', 'users.name','destino.name as destino' )
        ->get();
        //Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->count();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->count();
        $concluido=$tarefas->where('status', 'Concluído')->count();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();
        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje'));
           
        }elseif(Auth::user()-> hasRole ('Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->all(); 
        
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','departamentos','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje'));
        }

    }


        public function enviadasEsteMes()
    {
        $hoje = Carbon::today();
        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;
        $hoje = Carbon::today();
        $primeiroDiaDoMes = Carbon::now()->firstOfMonth();
        $ultimoDiaDoMes = Carbon::now()->lastOfMonth();
        
        //Dados
        $tarefas = Tarefa::where('idcriadopor', '=', $idUsuario)
        ->where('iddestino', '<>', $idUsuario)
        ->whereBetween('tarefas.created_at', [$primeiroDiaDoMes, $ultimoDiaDoMes])
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->join('users as destino', 'tarefas.iddestino', '=', 'destino.id')
        ->select('tarefas.*', 'users.name','destino.name as destino' )
        ->get();
        //Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->count();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->count();
        $concluido=$tarefas->where('status', 'Concluído')->count();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();
        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje'));
           
        }elseif(Auth::user()-> hasRole ('Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->all(); 
        
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','departamentos','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje'));
        }

    }


    public function enviadasfiltro($inicio, $fim)
    {

        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;
        $hoje = Carbon::today();

        //Dados
        $tarefas = Tarefa::where('idcriadopor', '=', $idUsuario)
        ->where('iddestino', '<>', $idUsuario)
        ->whereBetween('tarefas.created_at', [$inicio, $fim])
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->join('users as destino', 'tarefas.iddestino', '=', 'destino.id')
        ->select('tarefas.*', 'users.name','destino.name as destino' )
        ->get();

        //Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->count();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->count();
        $concluido=$tarefas->where('status', 'Concluído')->count();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();
        
        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje','inicio','fim'));
           
        }elseif(Auth::user()-> hasRole ('Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->all(); 
        
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','departamentos','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje','inicio','fim'));
        }
        
            

    }  






///*************  FAZENDOOOOOOOOO A LIXEIRA  *****************////

    public function exibirTarefasApagadasTodas()
    {
        $hoje = Carbon::today();
        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;

        //Dados
        $tarefas = Tarefa::where('tarefas.idcriadopor', '=', $idUsuario)
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->join('users as destino', 'tarefas.iddestino', '=', 'destino.id')
        ->select('tarefas.*', 'users.name','destino.name as destino' )
        ->onlyTrashed()
        ->get();

        //Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->count();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->count();
        $concluido=$tarefas->where('status', 'Concluído')->count();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();
        

        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje'));
           
        }elseif(Auth::user()-> hasRole ('Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->all(); 
        
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','departamentos','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje'));
        }

    }

    public function exibirTarefasApagadasFiltro($inicio, $fim)
    {
        $hoje = Carbon::today();
        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;
        
        
        //Dados
        $tarefas = Tarefa::where('tarefas.idcriadopor', '=', $idUsuario)
        ->whereBetween('tarefas.created_at', [$inicio, $fim])
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->join('users as destino', 'tarefas.iddestino', '=', 'destino.id')
        ->select('tarefas.*', 'users.name','destino.name as destino' )
        ->onlyTrashed()
        ->get();

        //Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->count();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->count();
        $concluido=$tarefas->where('status', 'Concluído')->count();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();
        

        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            //dd('Alexandre');
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','inicio','fim','hoje'));
           
        }elseif(Auth::user()-> hasRole ('Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->all(); 
        
            return view('painel.tarefas.recebidasTodas', compact('usuariosDepartamento','departamentos','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','inicio','fim','hoje'));
        }
        
            

    }

    public function anexos($idTarefa)
    {
        //dd($idTarefa);
        $imagens = Arquivo_Tarefas::where('tarefas_id',$idTarefa)->get();
        //dd($imagens);
        
       /* $urls = [];
        
        
        foreach ($imagens as $imagem) {
            array_push($urls, url($imagem->arquivo->url));
        }

        $iPreview="";
        foreach ($urls as $imprimir){
        $iPreview .= "'$imprimir',";
        }

        $iPreviewConfig="";
        foreach ($urls as $key => $imprimir){
            $key=$key+1;
            $iPreviewConfig .= "{url:'$imprimir', size: 628782, width: \"120px\", key:$key},"; } 


*/
        $iPreview="";
        foreach ($imagens as $imagem) {
          //dd($imagem);
            $url=url($imagem->arquivo->url);
            $iPreview .= "'$url',";   
        }

        //dd($iPreview);
        
        $iPreviewConfig="";
        foreach ($imagens as $key => $imagem){
            //$key=$key+1;
            $key = $imagem->arquivo->id;
            $url=url($imagem->arquivo->url);
            $urlDelete = url('/painel/tarefas/excluiranexos/');
            //dd($urlDelete);
            //$partes = explode("/", $imagem->arquivo->extencao);
            //$extecao = $partes[1];
            $tipo="";
            $ext = ltrim( substr( $imagem->arquivo->nome, strrpos( $imagem->arquivo->nome, '.' ) ), '.' );
            
            switch ($ext) {
            case "pdf":
                $tipo="pdf";
                break;
            case "jpg":
            case "png":
                $tipo="image";
                break;
            case "doc":
            case "docx":
            case "xls":
            case "xlsx":
            case "ppt":
            case "pptx":
                $tipo="office";
                break;
            case "ai":
            case "tif":
            case "eps":
                $tipo="gdocs";
                break;
            default:
            $tipo="image";
                break;
            }


            $extra = "'_token':'{{csrf_token()}}'";
            $iPreviewConfig .= "{type:'$tipo', url:'$urlDelete', downloadUrl:'$url', width: \"120px\", key:$key,},"; 
        } 

        //dd($idTarefa);
        //dd($urls);
        //dd($iPreview);    
        //dd($iPreviewConfig);    
        return view('painel.tarefas.anexos',compact('idTarefa','iPreview','iPreviewConfig'));

    }

    public function excluiranexos(Request $request)
    {
        //$id = request()->key;
        $atualizar = $request->session()->get('_previous');

        //dd($atualizar["url"]);
            
        //$arquivo = Arquivo::where('id',request()->key)->get()->first();
        //dd($arquivo);

        //Apaga o Arquivo tabela Arquivo_Tarefas
        Arquivo_Tarefas::where('arquivos_id',request()->key)->delete();
        
        //Apaga o Arquivo tabela Arquivo
        Arquivo::where('id',request()->key)->delete();
        
        
        //Apaga o Arquivo Fisico

        //return redirect($atualizar["url"]);

        return response()->json(['deleted' => 'OK']);
        


    }




    public function adicionaranexos(Request $request)
    {

    //Recuperando o Arquivo enviado e seus atributos.
    // $arquivo = request()->file('file');
    //dd($arquivo);
     //$imgName = request()->file->getClientOriginalName();
     $url = request()->file('file')->store('public/tarefa');
     //return response()->json(['uploaded' => 'public/tarefa'.$imgName]);
     //dd($url);

     //Salvando informações da imagem no Banco 
        $arquivo = new Arquivo;
        $arquivo->nome = request()->file->getClientOriginalName();
        $arquivo->extencao = request()->file->getMimeType();
        $arquivo->url = Storage::url($url);
        $arquivo->user_id=Auth::user()->id;
        $arquivo->save();

     //Salvando arquivo na tabela arquivo_tarefas
        $arquivoTarefa = new Arquivo_Tarefas;
        $arquivoTarefa->users_id=Auth::user()->id;
        $arquivoTarefa->arquivos_id=$arquivo->id;
        $arquivoTarefa->tarefas_id=request()->idTarefa;
        $arquivoTarefa->save();
        /*
        $tarefa = Tarefa::where('id',request()->idTarefa)->get()->first();
        $tarefa->arquivo_id = $tarefaArquivo->id;
        $tarefa->save();
    */

    //Retornar Mensagem de Sucesso
        return response()->json(['uploaded' => 'public/tarefa'.$arquivo->nome]);
    
    }


    public function index()
    {
        

    }


    public function uptadeStatus($idTarefa,$status)
    {
       // dd($idTarefa);
        switch ($status) {
            case 'b1':
                $status = 'A Fazer';
                break;
            case 'b2':
                $status = 'Em Andamento';
                break;
            case 'b3':
                $status = 'Para Aprovação';
                break;
            case 'b4':
                $status = 'Concluído';
                break;
        }

        Tarefa::where('id', $idTarefa)
            ->update(['status' => $status]);

        //Mensagem para os Usuários 
        notify()->success('Status Atualizado com Sucesso!','', ['timeOut' => '8000', 'progressBar'=> 'true']);

        //Retorno a Tela Anterior que solicitou o Evento
        return redirect()
              //->route('painel.tarefas.index')
               ->back();   
              // ->with('sucess','Status Atualizado com Sucesso!');
    }

// xxxx KANBAN xxxxx

public function kanbanRecebidasTodas()
    {

        $hoje = Carbon::today();
        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;
        //Dados
        $tarefas = Tarefa::where('iddestino', '=', $idUsuario)
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->select('tarefas.*', 'users.name')
        ->get();
        
        //Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->all();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->all();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->all();
        $concluido=$tarefas->where('status', 'Concluído')->all();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->all();

        $aFazerCount=$tarefas->where('status', 'A Fazer')->count();
        $emAndamentoCount=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacaoCount=$tarefas->where('status', 'Para Aprovação')->count();
        $concluidoCount=$tarefas->where('status', 'Concluído')->count();
        $vencidasCount=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();
        

        
            return view('painel.tarefas.kanbanRecebidas', compact('tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','aFazerCount','emAndamentoCount','vencidasCount','paraAprovacaoCount','concluidoCount','idUsuario','hoje'));
           
    }





      public function kanbanRecebidasHoje()
    {

        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;
        $hoje = Carbon::today();
        $hoje2 = Carbon::today()->addDay();
        //dd($hoje);
        
        //Dados
        $tarefas = Tarefa::where('iddestino', '=', $idUsuario)
        ->whereBetween('tarefas.created_at', [$hoje, $hoje2])
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->select('tarefas.*', 'users.name')
        ->get();

//Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->all();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->all();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->all();
        $concluido=$tarefas->where('status', 'Concluído')->all();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->all();

        $aFazerCount=$tarefas->where('status', 'A Fazer')->count();
        $emAndamentoCount=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacaoCount=$tarefas->where('status', 'Para Aprovação')->count();
        $concluidoCount=$tarefas->where('status', 'Concluído')->count();
        $vencidasCount=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();
        


        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.kanbanRecebidas', compact('usuariosDepartamento','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje','aFazerCount','emAndamentoCount','vencidasCount','paraAprovacaoCount','concluidoCount','idUsuario'));
           
        }elseif(Auth::user()-> hasRole ('Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->all(); 
        
            return view('painel.tarefas.kanbanRecebidas', compact('usuariosDepartamento','departamentos','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje','aFazerCount','emAndamentoCount','vencidasCount','paraAprovacaoCount','concluidoCount','idUsuario'));
        }

    }



        public function kanbanRecebidasEstaSemana()
    {
        $hoje = Carbon::today();
        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;
        $primeiroDiaDaSemana = Carbon::now()->startOfWeek();
        $ultimoDiaDaSemana = Carbon::now()->endOfWeek();
        //->subDay()

        //Dados
        $tarefas = Tarefa::where('iddestino', '=', $idUsuario)
        ->whereBetween('tarefas.created_at', [$primeiroDiaDaSemana, $ultimoDiaDaSemana])
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->select('tarefas.*', 'users.name')
        ->get();


        //Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->all();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->all();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->all();
        $concluido=$tarefas->where('status', 'Concluído')->all();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->all();

        $aFazerCount=$tarefas->where('status', 'A Fazer')->count();
        $emAndamentoCount=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacaoCount=$tarefas->where('status', 'Para Aprovação')->count();
        $concluidoCount=$tarefas->where('status', 'Concluído')->count();
        $vencidasCount=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();

        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.kanbanRecebidas', compact('usuariosDepartamento','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje','aFazerCount','emAndamentoCount','vencidasCount','paraAprovacaoCount','concluidoCount','idUsuario'));
           
        }elseif(Auth::user()-> hasRole ('Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->all(); 
        
            return view('painel.tarefas.kanbanRecebidas', compact('usuariosDepartamento','departamentos','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje','aFazerCount','emAndamentoCount','vencidasCount','paraAprovacaoCount','concluidoCount','idUsuario'));
        }

    }


        public function kanbanRecebidasEsteMes()
    {
        $hoje = Carbon::today();
        
        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;
        $hoje = Carbon::today();
        $primeiroDiaDoMes = Carbon::now()->firstOfMonth();
        $ultimoDiaDoMes = Carbon::now()->lastOfMonth();
        
        //Dados
        $tarefas = Tarefa::where('iddestino', '=', $idUsuario)
        ->whereBetween('tarefas.created_at', [$primeiroDiaDoMes, $ultimoDiaDoMes])
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->select('tarefas.*', 'users.name')
        ->get();

        //Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->all();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->all();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->all();
        $concluido=$tarefas->where('status', 'Concluído')->all();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->all();

        $aFazerCount=$tarefas->where('status', 'A Fazer')->count();
        $emAndamentoCount=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacaoCount=$tarefas->where('status', 'Para Aprovação')->count();
        $concluidoCount=$tarefas->where('status', 'Concluído')->count();
        $vencidasCount=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();


        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.kanbanRecebidas', compact('usuariosDepartamento','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje','aFazerCount','emAndamentoCount','vencidasCount','paraAprovacaoCount','concluidoCount','idUsuario'));
           
        }elseif(Auth::user()-> hasRole ('Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->all(); 
        
            return view('painel.tarefas.kanbanRecebidas', compact('usuariosDepartamento','departamentos','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje','aFazerCount','emAndamentoCount','vencidasCount','paraAprovacaoCount','concluidoCount','idUsuario'));
        }

    }





    public function recebidasfiltrokanban($inicio, $fim)
    {

        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;
        $hoje = Carbon::today();

        //Dados
        $tarefas = Tarefa::where('iddestino', '=', $idUsuario)
        ->whereBetween('tarefas.created_at', [$inicio, $fim])
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->select('tarefas.*', 'users.name')
        ->get();



        //Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->all();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->all();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->all();
        $concluido=$tarefas->where('status', 'Concluído')->all();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->all();

        $aFazerCount=$tarefas->where('status', 'A Fazer')->count();
        $emAndamentoCount=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacaoCount=$tarefas->where('status', 'Para Aprovação')->count();
        $concluidoCount=$tarefas->where('status', 'Concluído')->count();
        $vencidasCount=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();
        
        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.kanbanRecebidas', compact('usuariosDepartamento','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje','aFazerCount','emAndamentoCount','vencidasCount','paraAprovacaoCount','concluidoCount','idUsuario','inicio','fim'));
           
        }elseif(Auth::user()-> hasRole ('Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->all(); 
        
            return view('painel.tarefas.kanbanRecebidas', compact('usuariosDepartamento','departamentos','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje','aFazerCount','emAndamentoCount','vencidasCount','paraAprovacaoCount','concluidoCount','idUsuario','inicio','fim'));
        }

        
    }  









public function kanbanEnviadasTodas()
    {


        $hoje = Carbon::today();
        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;


        //Dados
        $tarefas = Tarefa::where('idcriadopor', '=', $idUsuario)
        ->where('iddestino', '<>', $idUsuario)
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->join('users as destino', 'tarefas.iddestino', '=', 'destino.id')
        ->select('tarefas.*', 'users.name','destino.name as destino' )
        ->get();


        //Datos separados por Grupos / Colunas
        $aFazer=$tarefas->where('status', 'A Fazer')->all();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->all();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->all();
        $concluido=$tarefas->where('status', 'Concluído')->all();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->all();


        //Resumo ou Count
        $aFazerCount=$tarefas->where('status', 'A Fazer')->count();
        $emAndamentoCount=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacaoCount=$tarefas->where('status', 'Para Aprovação')->count();
        $concluidoCount=$tarefas->where('status', 'Concluído')->count();
        $vencidasCount=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();
        

        //Retorno para tela     
        return view('painel.tarefas.kanbanRecebidas', compact('tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','aFazerCount','emAndamentoCount','vencidasCount','paraAprovacaoCount','concluidoCount','idUsuario','hoje'));
           
    }





      public function kanbanEnviadasHoje()
    {

        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;
        $hoje = Carbon::today();
        $hoje2 = Carbon::today()->addDay();
        //dd($hoje);
        
        //Dados
        $tarefas = Tarefa::where('idcriadopor', '=', $idUsuario)
        ->where('iddestino', '<>', $idUsuario)
        ->whereBetween('tarefas.created_at', [$hoje, $hoje2])
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->join('users as destino', 'tarefas.iddestino', '=', 'destino.id')
        ->select('tarefas.*', 'users.name','destino.name as destino' )
        ->get();


//Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->all();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->all();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->all();
        $concluido=$tarefas->where('status', 'Concluído')->all();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->all();

        $aFazerCount=$tarefas->where('status', 'A Fazer')->count();
        $emAndamentoCount=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacaoCount=$tarefas->where('status', 'Para Aprovação')->count();
        $concluidoCount=$tarefas->where('status', 'Concluído')->count();
        $vencidasCount=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();
        


        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.kanbanRecebidas', compact('usuariosDepartamento','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje','aFazerCount','emAndamentoCount','vencidasCount','paraAprovacaoCount','concluidoCount','idUsuario'));
           
        }elseif(Auth::user()-> hasRole ('Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->all(); 
        
            return view('painel.tarefas.kanbanRecebidas', compact('usuariosDepartamento','departamentos','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje','aFazerCount','emAndamentoCount','vencidasCount','paraAprovacaoCount','concluidoCount','idUsuario'));
        }

    }



        public function kanbanEnviadasEstaSemana()
    {
        $hoje = Carbon::today();
        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;
        $primeiroDiaDaSemana = Carbon::now()->startOfWeek();
        $ultimoDiaDaSemana = Carbon::now()->endOfWeek();
        //->subDay()

        //Dados
        $tarefas = Tarefa::where('idcriadopor', '=', $idUsuario)
        ->where('iddestino', '<>', $idUsuario)
       ->whereBetween('tarefas.created_at', [$primeiroDiaDaSemana, $ultimoDiaDaSemana])
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->join('users as destino', 'tarefas.iddestino', '=', 'destino.id')
        ->select('tarefas.*', 'users.name','destino.name as destino' )
        ->get();



        //Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->all();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->all();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->all();
        $concluido=$tarefas->where('status', 'Concluído')->all();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->all();

        $aFazerCount=$tarefas->where('status', 'A Fazer')->count();
        $emAndamentoCount=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacaoCount=$tarefas->where('status', 'Para Aprovação')->count();
        $concluidoCount=$tarefas->where('status', 'Concluído')->count();
        $vencidasCount=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();

        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.kanbanRecebidas', compact('usuariosDepartamento','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje','aFazerCount','emAndamentoCount','vencidasCount','paraAprovacaoCount','concluidoCount','idUsuario'));
           
        }elseif(Auth::user()-> hasRole ('Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->all(); 
        
            return view('painel.tarefas.kanbanRecebidas', compact('usuariosDepartamento','departamentos','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje','aFazerCount','emAndamentoCount','vencidasCount','paraAprovacaoCount','concluidoCount','idUsuario'));
        }

    }


        public function kanbanEnviadasEsteMes()
    {
        $hoje = Carbon::today();

        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;
        $hoje = Carbon::today();
        $primeiroDiaDoMes = Carbon::now()->firstOfMonth();
        $ultimoDiaDoMes = Carbon::now()->lastOfMonth();
        


        //Dados
        $tarefas = Tarefa::where('idcriadopor', '=', $idUsuario)
        ->where('iddestino', '<>', $idUsuario)
        ->whereBetween('tarefas.created_at', [$primeiroDiaDoMes, $ultimoDiaDoMes])
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->join('users as destino', 'tarefas.iddestino', '=', 'destino.id')
        ->select('tarefas.*', 'users.name','destino.name as destino' )
        ->get();



        //Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->all();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->all();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->all();
        $concluido=$tarefas->where('status', 'Concluído')->all();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->all();

        $aFazerCount=$tarefas->where('status', 'A Fazer')->count();
        $emAndamentoCount=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacaoCount=$tarefas->where('status', 'Para Aprovação')->count();
        $concluidoCount=$tarefas->where('status', 'Concluído')->count();
        $vencidasCount=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();


        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.kanbanRecebidas', compact('usuariosDepartamento','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje','aFazerCount','emAndamentoCount','vencidasCount','paraAprovacaoCount','concluidoCount','idUsuario'));
           
        }elseif(Auth::user()-> hasRole ('Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->all(); 
        
            return view('painel.tarefas.kanbanRecebidas', compact('usuariosDepartamento','departamentos','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje','aFazerCount','emAndamentoCount','vencidasCount','paraAprovacaoCount','concluidoCount','idUsuario'));
        }

    }


    public function enviadasfiltrokanban($inicio, $fim)
    {

        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;
        $hoje = Carbon::today();

        //Dados
        $tarefas = Tarefa::where('idcriadopor', '=', $idUsuario)
        ->where('iddestino', '<>', $idUsuario)
        ->whereBetween('tarefas.created_at', [$inicio, $fim])
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->join('users as destino', 'tarefas.iddestino', '=', 'destino.id')
        ->select('tarefas.*', 'users.name','destino.name as destino' )
        ->get();



        //Resumo
        $aFazer=$tarefas->where('status', 'A Fazer')->all();
        $emAndamento=$tarefas->where('status', 'Em Andamento')->all();
        $paraAprovacao=$tarefas->where('status', 'Para Aprovação')->all();
        $concluido=$tarefas->where('status', 'Concluído')->all();
        $vencidas=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->all();

        $aFazerCount=$tarefas->where('status', 'A Fazer')->count();
        $emAndamentoCount=$tarefas->where('status', 'Em Andamento')->count();
        $paraAprovacaoCount=$tarefas->where('status', 'Para Aprovação')->count();
        $concluidoCount=$tarefas->where('status', 'Concluído')->count();
        $vencidasCount=$tarefas->where('entrega','<>','')->where('status','<>','Concluído')->where('entrega','<', $hoje)->count();


        
        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.kanbanRecebidas', compact('usuariosDepartamento','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje','aFazerCount','emAndamentoCount','vencidasCount','paraAprovacaoCount','concluidoCount','idUsuario','inicio','fim'));
           
        }elseif(Auth::user()-> hasRole ('Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->all(); 
        
            return view('painel.tarefas.kanbanRecebidas', compact('usuariosDepartamento','departamentos','tarefas','aFazer','emAndamento','vencidas','paraAprovacao','concluido','idUsuario','hoje','aFazerCount','emAndamentoCount','vencidasCount','paraAprovacaoCount','concluidoCount','idUsuario','inicio','fim'));
        }
        
            

    }  


    /**
  all() the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.create', compact('usuariosDepartamento'));
           
        }elseif(Auth::user()-> hasRole ('Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->all(); 
        
            return view('painel.tarefas.create', compact('usuariosDepartamento','departamentos'));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if(Auth::user()-> hasRole ( 'User')){

            //dd($request->get('voltar'));
            //return $request->all();

            $tarefa = new Tarefa;
            $tarefa->nome=$request->get('tarefa');
            $tarefa->descricao=$request->get('descricao');
            $tarefa->entrega=$request->get('entrega');
            $tarefa->prioridade=$request->get('prioridade');
            $tarefa->status='A Fazer';
            $tarefa->iddestino=$request->get('colaborador');
            $tarefa->idcriadopor=Auth::user()->id;
            $tarefa->save();

            //Mensagem para os Usuários 
        notify()->success('Tarefa Adicionada com Sucesso!','', ['timeOut' => '8000', 'progressBar'=> 'true']);


            //return URL::previous();

            return redirect($request->get('voltar'));
            //return redirect()
                   //->route('painel.tarefas.index')
              //     ->previous() 
                   //->back()   
              //     ->with('sucess','Tarefa Adicionada com Sucesso!');


            
        }elseif(Auth::user()-> hasRole ('Admin|AdminSetor')){
            
            
            $tarefa = new Tarefa;
            $tarefa->nome=$request->get('tarefa');
            $tarefa->descricao=$request->get('descricao');
            $tarefa->entrega=$request->get('entrega');
            $tarefa->prioridade=$request->get('prioridade');
            $tarefa->status='A Fazer';
            $tarefa->iddestino=$request->get('usuario');
            $tarefa->idcriadopor=Auth::user()->id;
            $tarefa->save();


            //Mensagem para os Usuários 
        notify()->success('Tarefa Adicionada com Sucesso!','', ['timeOut' => '8000', 'progressBar'=> 'true']);

            return redirect($request->get('voltar'));


/*            return redirect()
                   //->route('painel.tarefas.index') 

                   ->back()
                   ->with('sucess','Tarefa Adicionada com Sucesso!');
*/
        }
        // 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $tipo)
    {
        $tarefa = Tarefa::where('id',$id)->first();
        
        if($tipo=='recebidas'){

        
         //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.edit', compact('usuariosDepartamento','tarefa'));
           
        }elseif(Auth::user()-> hasRole ('Admin|AdminSetor')){
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name', 'id'); 
        
            return view('painel.tarefas.edit', compact('usuariosDepartamento','departamentos','tarefa'));
        }


        }

        if($tipo=='enviadas'){


        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){

         $usuariosDepartamento = Tarefa::where('id',$id)->first()->destino->departamento->user->pluck('name','id');
         //$usuariosDepartamento = Tarefa::where('id',$id)->destino->departamento->user->pluck('name','id');
            //$usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            
            return view('painel.tarefas.edit', compact('usuariosDepartamento','tarefa'));
           
        }elseif(Auth::user()-> hasRole ('Admin|AdminSetor')){

            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            
            $usuariosDepartamento = Tarefa::where('id',$id)->first()->destino()->pluck('name','id');
            
            return view('painel.tarefas.edit', compact('usuariosDepartamento','departamentos','tarefa'));
        }




        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request->voltar);
        $tarefa = Tarefa::where('id',$request->id)->first();
        if(Auth::user()-> hasRole ( 'User')){

            $tarefa->nome=$request->tarefa;
            $tarefa->descricao=$request->descricao;
            $tarefa->entrega=$request->entrega;
            $tarefa->prioridade=$request->prioridade;
            //$tarefa->status=$request->status;
            $tarefa->iddestino=$request->colaborador;
            $tarefa->idcriadopor=Auth::user()->id;
            $tarefa->save();

            //Mensagem para os Usuários 
        notify()->success('Tarefa Atualizada com Sucesso!','', ['timeOut' => '8000', 'progressBar'=> 'true']);


            //return URL::previous();

            return redirect($request->voltar);
            //return redirect()
                   //->route('painel.tarefas.index')
              //     ->previous() 
                   //->back()   
              //     ->with('sucess','Tarefa Adicionada com Sucesso!');


            
        }elseif(Auth::user()-> hasRole ('Admin|AdminSetor')){
            
            $tarefa->nome=$request->get('tarefa');
            $tarefa->descricao=$request->get('descricao');
            $tarefa->entrega=$request->get('entrega');
            $tarefa->prioridade=$request->get('prioridade');
            //$tarefa->status='A Fazer';
            $tarefa->iddestino=$request->get('usuario');
            $tarefa->idcriadopor=Auth::user()->id;
            $tarefa->save();

                //Mensagem para os Usuários 
        notify()->success('Tarefa Atualizada com Sucesso!','', ['timeOut' => '8000', 'progressBar'=> 'true']);


            //return URL::previous();

            return redirect($request->voltar);
        
        }

    }


    public function encaminharUpdate(Request $request)
    {
        //dd($request->voltar);
        $tarefa = Tarefa::where('id',$request->id)->first();
        if(Auth::user()-> hasRole ( 'User')){

            $tarefa->iddestino=$request->colaborador;
            $tarefa->save();

            //Mensagem para os Usuários 
        notify()->success('Tarefa Encaminhada com Sucesso!','', ['timeOut' => '8000', 'progressBar'=> 'true']);
        
        return redirect($request->voltar);
        
        }elseif(Auth::user()-> hasRole ('Admin|AdminSetor')){
            
            $tarefa->nome=$request->get('tarefa');
            $tarefa->descricao=$request->get('descricao');
            $tarefa->entrega=$request->get('entrega');
            $tarefa->prioridade=$request->get('prioridade');
            //$tarefa->status='A Fazer';
            $tarefa->iddestino=$request->get('usuario');
            $tarefa->idcriadopor=Auth::user()->id;
            $tarefa->save();

                //Mensagem para os Usuários 
        notify()->success('Tarefa Atualizada com Sucesso!','', ['timeOut' => '8000', 'progressBar'=> 'true']);


            //return URL::previous();

            return redirect($request->voltar);
        
        }

    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        $tarefa = Tarefa::where('id',$id)->first();
        $tarefa->delete();

        //Mensagem para os Usuários 
        notify()->success('Tarefa Apagada com Sucesso!','', ['timeOut' => '8000', 'progressBar'=> 'true']);

        return redirect()->back();

    }


    public function recuperar($id)
        {
            //dd($id);
            $tarefa = Tarefa::where('id',$id)->onlyTrashed()->first();
            $tarefa->restore();

            //Mensagem para os Usuários 
            notify()->success('Tarefa Restaurada com Sucesso!','', ['timeOut' => '8000', 'progressBar'=> 'true']);

            return redirect()->back();

        }


    public function comentario($id)
    {

    //dd($id);
     $comentarios = Comentario::where('tarefas_id', '=', $id)->orderBy('updated_at', 'DSC')->get();

    /*$comentarios = DB::table('comentarios')
    ->where('tarefas_id', '=', $id)
    ->orderBy('updated_at', 'DSC')
    ->get();*/


     return view('painel.tarefas.comentarios', compact('comentarios','id'));

    }

    public function comentariocreate(Request $request)
    {
        if(is_null($request->comentario)){
        notify()->error('Comentario não foi salvo!','', ['timeOut' => '8000', 'progressBar'=> 'true']);
        }else{
        //dd($request->comentario);
            $comentario = new Comentario;
            $comentario->tarefas_id=$request->id;
            $comentario->users_id=Auth::user()->id;
            $comentario->comentario=$request->comentario;
            $comentario->save();
        //Mensagem para os Usuários 
        notify()->success('Comentario salvo com Sucesso!','', ['timeOut' => '8000', 'progressBar'=> 'true']);
        }
        return redirect($request->voltar);


    }

    public function comentariodestroy($id)
    {
        //dd($id);
        $comentario = Comentario::where('id',$id)->first();
        $comentario->delete();

        //Mensagem para os Usuários 
        notify()->success('Comentario Apagado com Sucesso!','', ['timeOut' => '8000', 'progressBar'=> 'true']);

        return back();
        //return view('painel.tarefas.comentarios');

    }

        public function comentarioedit($id)
    {
        
        $comentario = Comentario::where('id',$id)->first();

        return view('painel.tarefas.editcomentarios', compact('comentario'));

    }


    public function comentarioupdate(Request $request)
    {
        //dd($request->id);
        $comentario = Comentario::where('id',$request->id)->first();
        $comentario->comentario=$request->comentario;
        $comentario->users_id=Auth::user()->id;
        $comentario->save();

        //Mensagem para os Usuários 
        notify()->success('Conmentário Atualizado com Sucesso!','', ['timeOut' => '8000', 'progressBar'=> 'true']);

            return redirect($request->voltar);
        
    }

    public function historico($id)
    {

        $tarefa = Tarefa::where('id',$id)->first();
        $historicos = Activity::all()->last();
        $historicodatarefa = $historicos->where('subject_type','App\Tarefa')->where('subject_id',$tarefa->id)->get();
        
        //dd($historicodatarefa);
        
        static $historicodatarefacomentario;
        $historicodatarefacomentario = collect($historicodatarefacomentario);
        
        $comentarios = Comentario::where('tarefas_id',$id)->get();
        
        //dd($comentarios);
        
        foreach($comentarios as $comentario) {
        $historicodatarefacomentario->push($historicos->where('subject_type','App\Comentario')->where('subject_id',$comentario->id)->get());        
        }

        //dd($historicodatarefacomentario);
        foreach($historicodatarefacomentario as $tarefacomentario) {
            //ddd
            foreach($tarefacomentario as $comentario2) {
            $historicodatarefa->push($comentario2);
            }    
        }

        $arquivos = Arquivo_Tarefas::where('tarefas_id',$id)->get();        
        //dd($arquivos);

        static $historicodatarefaarquivo;
        $historicodatarefaarquivo = collect($historicodatarefaarquivo);

        foreach($arquivos as $arquivo) {
        $historicodatarefaarquivo->push($historicos->where('subject_type','App\Arquivo_Tarefas')->where('subject_id',$arquivo->id)->get());
        }

        foreach($historicodatarefaarquivo as $tarefaarquivo) {
            //ddd
            foreach($tarefaarquivo as $tarefaarquivo2) {
            $historicodatarefa->push($tarefaarquivo2);
            }    
        }

        //dd($historicodatarefa);

        // Ordenar pela data de Criação das Atividades
        $historicodatarefa = $historicodatarefa->sortByDesc('created_at');
        //dd($historicodatarefa);

        return view('painel.tarefas.historicoTarefa', compact('historicodatarefa'));

    }


    public function encaminharTarefaRecebida($id)
    {

        $tarefa = Tarefa::where('id',$id)->first();
        

        if(Auth::user()-> hasRole ( 'User')){

            //Usuarios do seu Setor.        
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            //Abrir tela com USuarios para trocar
            return view('painel.tarefas.encaminhar', compact('usuariosDepartamento','tarefa'));

        }elseif(Auth::user()-> hasRole ('Admin|AdminSetor')){

            //Departamentos e Usuario das empresas que vc consegue visualizar
            $departamentos = Departamento::departamento_painel()->pluck('nome', 'id');
            $departamentos->prepend('Escolha um Departamento', '0');
            $usuariosDepartamento = Auth::user()->departamento->user->pluck('name','id');
            //Abrir tela com Departamentos e Usuarios para trocar
            return view('painel.tarefas.encaminhar', compact('usuariosDepartamento','tarefa','departamentos'));
        }


    }


    public function calendario()
    {
        return view('painel.tarefas.calendario');

    }




    public function calendarioDados()
    {
        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;

        //Dados
        $tarefas = Tarefa::where('iddestino', '=', $idUsuario)
        ->select('nome as title', 'entrega as start', 'descricao','id','prioridade')
        ->get();
        
        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            return response()->json($tarefas);
        }elseif(Auth::user()-> hasRole ( 'Admin|AdminSetor')){
            return response()->json($tarefas);
        }
    }

// ************************** AJUSTANDO em 22/07/2019 ******************************

    public function calendarioDadosTarefasRecebidas()
    {
        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;

        //Dados
        $tarefas = Tarefa::where('iddestino', '=', $idUsuario)
        ->select('nome as title', 'entrega as start', 'descricao','id','prioridade')
        ->get();
        
        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            return response()->json($tarefas);
        }elseif(Auth::user()-> hasRole ( 'Admin|AdminSetor')){
            return response()->json($tarefas);
        }
    }

    public function calendarioDadosTarefasEnviadas()
    {
        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;

        //Dados
        $tarefas = Tarefa::where('idcriadopor', '=', $idUsuario)
        ->where('iddestino', '<>', $idUsuario)
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->join('users as destino', 'tarefas.iddestino', '=', 'destino.id')
        ->select('tarefas.nome as title', 'tarefas.entrega as start', 'tarefas.descricao','tarefas.id','tarefas.prioridade', 'users.name','destino.name as destino' )
        ->get();

        //Dados para Modal Adicionar e retorno para View com as variaveis
        if(Auth::user()-> hasRole ( 'User')){
            return response()->json($tarefas);
        }elseif(Auth::user()-> hasRole ( 'Admin|AdminSetor')){
            return response()->json($tarefas);
        }
    }

}
