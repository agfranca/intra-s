<?php

namespace App\Http\Controllers\painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Departamento;
use App\Empresa;
use App\User;
use App\Project;
use App\Projecttype;
use App\Tarefa;
use App\ProjecttypeUser;
use App\Projecttypecombo;

class NotificarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
     if(Auth::user()-> hasRole ( 'Admin|AdminSetor' )){
        $departamentos = Departamento::departamento_painel();
        //dd($departamentos);
        $notificacoes = Project::projetos();
        //dd($notificacoes);
        return view('painel.notificacao.index', compact('departamentos','notificacoes'));

        }else{

            return view('painel.index');
        }
    }


    public function aprovadores()
    {
        //


     if(Auth::user()-> hasRole ( 'Admin|AdminSetor' )){

        $comaprovadores = Tarefa::where('status','Com Aprovador')
                        ->join('projecttype_users', 'tarefas.projecttype_id', '=', 'projecttype_users.projecttype_id')
                        ->where('user_id',Auth::user()->id)
                        ->get();

        $notificacoes = $comaprovadores->unique('project_id');

        return view('painel.notificacao.aprovadores', compact('notificacoes'));

        }
    }


public function tarefasdoprojeto($projeto)
    {
        //
     //dd($projeto);   
     if(Auth::user()-> hasRole ( 'Admin|AdminSetor' )){
        $projetoenviado = Project::where('id', '=', $projeto)->first();
        $tarefasdoprojeto = Tarefa::tarefasdoprojeto($projeto)->where('status','<>','Arquivado');
        
        return view('painel.notificacao.tarefasdoprojeto', compact('tarefasdoprojeto', 'projetoenviado'));

        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$tree = User::users_painel_tree();
        $id=5;
        //$projecttype= Projecttype::where('departamento_id',5)->first();
        $projecttype= Projecttype::with('departamento')->get();
        $lista = $projecttype->unique('departamento_id');
        //$tree = User::users_painel_tree();
        //dd($tree);

        $tree='{"id":"2","parent":"#","text":"FECOMERCIO SE","state":"{\"selected\": true}"},{"id":"5D","parent":"2","text":"NCM","state":"{\"selected\": false}"},';

        $projecttypes="";

        //$todos = $projecttype->departamento->get(); 
        //$tree = Empresa::empresas_painel_tree();
        return view('painel.notificacao.create', compact('tree','projecttypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function store(Request $request)
    {
       //Validaçãode dados

       //Gravação de dados
        $departamento = $request->resultado2;
        $pos = strpos($departamento,"D");
        //dd($pos);
        //dd($departamento);

        if(is_null($departamento)or($pos ===false) ){
           $request->flash();
            return redirect()
                   ->back()
                   ->with('errors', 'Selecione um depatamento.');

            //echo 'Selecione um departamento';
        }else{
            $DepartamentoPai = NULL;
            $EmpresaId = NULL;
            $Departamentotrim = trim($departamento,"D");
            $DepartamentoPai = $Departamentotrim;
            $Departamento = Departamento::where('id',$DepartamentoPai)->first();
            //dd($Departamento->empresa_id);
            $EmpresaId = $Departamento->empresa_id;
            $projecttypes = $Departamento->projecttypes;
            
            $tree='{"id":"2","parent":"#","text":"FECOMERCIO SE","state":"{\"selected\": true}"},{"id":"5D","parent":"2","text":"NCM","state":"{\"selected\": true}"},';

            return view('painel.notificacao.create', compact('tree','projecttypes'));
            }

            //dd($Departamento->projecttypes);
            
            /* Agora falta gravar as informações  
            $Departamento = new Departamento;
            $Departamento->nome = $request->get('nome');
            $Departamento->departamento_pai = $DepartamentoPai;
            $Departamento->empresa_id = $EmpresaId;
            $Departamento->save();
            */

    }


        public function storeNCM($departamento)
    {
        $Departamento = Departamento::where('id',$departamento)->first();
        $EmpresaId = $Departamento->empresa_id;
        $projecttypes = $Departamento->projecttypes;
        return view('painel.notificacao.createPasso2', compact('projecttypes','departamento'));
    }

        public function formularioprojecttype($departamento,$projecttype)
    {      
        $user=Auth::user();

        switch ($departamento) {
            //$departamento 5 é NCM
            case 5:
                switch ($projecttype) {
                    //Fotografia
                    case 1:
                        return view('painel.notificacao.formularios.fotografia',compact('departamento','projecttype','user'));
                        # code...
                        break;
                    //Filmagem
                    case 2:
                        return view('painel.notificacao.formularios.filmagem',compact('departamento','projecttype','user'));
                        # code...
                        break;
                    //Fotografia+Filmagem
                    case 3:
                        return view('painel.notificacao.formularios.fotografiafilmagem',compact('departamento','projecttype','user'));
                        //dd('Fotografia+Filmagem');
                        # code...
                        break;
                    
                    default:
                        return redirect('/painel/notificar/create/5');
                        # code...
                        break;
                }
                break;            
            default:
                # code...
                break;
        }
        
    }


    public function gravarformularioprojecttype(Request $request)
    {
         
        //dd(strtotime($request->data));
        //dd($databanco);
        //dd($request->all());
        $departamento = $request->departamento;
        $projecttype = $request->projecttype;
        $aprovadores=ProjecttypeUser::where('departamento_id',$departamento)->where('projecttype_id',$projecttype)->count();
        if ($aprovadores>0) {
        //dd('Tem Aprovador');
            //Tem Aprovado o Status da Tarefa passa a ser Com Aprovador até a Aprovação 
            //Salvar o Projeto
            //Salvar as Tarefas
        $project = new Project;
        $project->nome = $request->nome;
        $project->departamento_id = $request->departamento;
        $project->user_id = $request->user_id;
        $project->projecttype_id = $request->projecttype;
        $project->save();
            //Salvar as Tarefas
            //Verificar se a Tarefa é Combo ou Não
            $tarefascombo=Projecttypecombo::where('projecttype_id',$projecttype)->get();
            $tarefascombototal = $tarefascombo->count();
            if ($tarefascombototal>0) {
                //dd('Não Tem Aprovador e Ja Gravou o Projeto a Tarefa é Combo');  
                foreach ($tarefascombo as $tarefa) {
                    //Salvar a Tarefa
                    $projecttype=Projecttype::where('id',$tarefa->projecttype_filho)->first();
                    
                    $tarefa = new Tarefa;
                    $tarefa->nome = $projecttype->nome." - ".$request->nome;
                    $tarefa->descricao = $request->descricao;
                    //Ajustado a Data para salvar no Banco
                    $data = str_replace("/", "-", $request->data);
                    $databanco = date('Y-m-d', strtotime($data));
                    $tarefa->entrega = $databanco;
                    $tarefa->idcriadopor = $request->user_id;
                    $tarefa->project_id = $project->id;
                    $tarefa->projecttype_id = $request->projecttype;
                    $tarefa->departamento_id = $request->departamento;
                    $tarefa->status = 'Com Aprovador';
                    $tarefa->save();
                }

            }else{
            dd('Aqui');
            $projecttype=Projecttype::where('id',$projecttype)->first();
            $tarefa = new Tarefa;
            $tarefa->nome = $projecttype->nome." - ".$request->nome;
            $tarefa->descricao = $request->descricao;
            //Ajustado a Data para salvar no Banco
            $data = str_replace("/", "-", $request->data);
            $databanco = date('Y-m-d', strtotime($data));
            $tarefa->entrega = $databanco;
            $tarefa->idcriadopor = $request->user_id;
            $tarefa->project_id = $project->id;
            $tarefa->projecttype_id = $request->projecttype;
            $tarefa->departamento_id = $request->departamento;
            $tarefa->status = 'Com Aprovador';
            $tarefa->save(); 

            }        
        
        }else{
        //dd('Não Tem Aprovador');    
            //Salvar o Projeto nome
        $project = new Project;
        $project->nome = $request->nome;
        $project->departamento_id = $request->departamento;
        $project->user_id = $request->user_id;
        $project->projecttype_id = $request->projecttype;
        $project->save();
            //Salvar as Tarefas
            //Verificar se a Tarefa é Combo ou Não
            $tarefascombo=Projecttypecombo::where('projecttype_id',$projecttype)->get();
            $tarefascombototal = $tarefascombo->count();
            if ($tarefascombototal>0) {
        //dd('Não Tem Aprovador e Ja Gravou o Projeto a Tarefa é Combo');  
                foreach ($tarefascombo as $tarefa) {
                    //Salvar a Tarefa
                    $projecttype=Projecttype::where('id',$tarefa->projecttype_filho)->first();
                    
                    $tarefa = new Tarefa;
                    $tarefa->nome = $projecttype->nome." - ".$request->nome;
                    $tarefa->descricao = $request->descricao;
                    //Ajustado a Data para salvar no Banco
                    $data = str_replace("/", "-", $request->data);
                    $databanco = date('Y-m-d', strtotime($data));
                    $tarefa->entrega = $databanco;
                    $tarefa->idcriadopor = $request->user_id;
                    $tarefa->project_id = $project->id;
                    $tarefa->projecttype_id = $request->projecttype;
                    $tarefa->departamento_id = $request->departamento;
                    $tarefa->status = 'A Fazer';
                    $tarefa->save();
                }

            }else{
            $projecttype=Projecttype::where('id',$projecttype)->first();
            $tarefa = new Tarefa;
            $tarefa->nome = $projecttype->nome." - ".$request->nome;
            $tarefa->descricao = $request->descricao;
            //Ajustado a Data para salvar no Banco
            $data = str_replace("/", "-", $request->data);
            $databanco = date('Y-m-d', strtotime($data));
            $tarefa->entrega = $databanco;
            $tarefa->idcriadopor = $request->user_id;
            $tarefa->project_id = $project->id;
            $tarefa->projecttype_id = $request->projecttype;
            $tarefa->departamento_id = $request->departamento;
            $tarefa->status = 'A Fazer';
            $tarefa->save(); 

            }
        }
        

        //Mensagem para os Usuários 
        notify()->success('Notificação salva com Sucesso!','', ['timeOut' => '8000', 'progressBar'=> 'true']);
        return redirect()->route('painel.notificar.index');

    }


    /**
     * Display the specified resource.
     * gravarformularioprojecttype
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function tarefascomboanexo($id)
    {
        $projeto = Project::where('id',$id)->first();
        $tarefas = $projeto->tarefa;
        //retornar uma View com variavel $tarefas
        return view('painel.notificacao.tarefascomboanexo', compact('tarefas'));
    }

    public function tarefascombocomentario($id)
    {
        $projeto = Project::where('id',$id)->first();
        $tarefas = $projeto->tarefa;
        //retornar uma View com variavel $tarefas
        return view('painel.notificacao.tarefascombocomentario', compact('tarefas'));
    }

}
