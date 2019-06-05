<?php

namespace App\Http\Controllers\painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Empresa;
use App\Departamento;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $departamentoModel;

    public function __construct(Departamento $departamento)
    {
        $this->departamentoModel = $departamento;
    }




    public function index()
    {
        
         if(Auth::user()-> hasRole ( 'Admin' )){

        $todosusuarios = User::users_painel();
        
        return view('painel.usuarios.index', compact('todosusuarios'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tree = User::users_painel_tree();
        return view('painel.usuarios.create', compact('tree'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Fazer Camada de Validação

        
        $departamento = $request->resultado2;
        
        $pos = strpos($departamento,"D");

        if($pos ===false){
           $request->flash();
            return redirect()
                   ->back()
                   ->with('errors', 'Selecione um departamento. Os usuário são lotados em Departamentos.');

            //echo 'Selecione um departamento';
        }else{
            
            $departamentotrim = trim($departamento,"D"); 
            $user = new User;
            $user->name = $request->get('nome');
            $user->email = $request->get('email');
            $user->password = bcrypt($request->get('password'));
            $user->departamento_id = $departamentotrim;
            $user->save();
            $user->assignRole('User');

            return redirect()
                   ->route('painel.usuarios.index')   
                   ->with('sucess','Usuário adicionado com Sucesso!');
        }
        //Remove a letra D enviada na seleção do Departamento
        
        //dd($departamentotrim);
        //Captura todos os campos enviados pelo formulario
        //return $request->all();
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
  
    public function habilitaradm(User $usuario)
    {
        //dd($usuario);
        $habilitaradm = User::habilitaradm($usuario);
        return back();
     
    }


    public function habilitaradmsetor(User $usuario)
    {
        //dd($usuario);
        $habilitaradm = User::habilitaradmsetor($usuario);
        return back();
     
    }


    public function desabilitaradm(User $usuario)
    {
        $desabilitaradm = User::desabilitaradm($usuario);
        return back();  
     
    }


    public function edit(User $usuario)
    {
        $tree = User::users_painel_tree();
        return view('painel.usuarios.edit',compact('usuario','tree'));  
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $usuario, Request $request)
    {
         //Fazer Camada de Validação

        
        $departamento = $request->resultado2;
        //dd($departamento);
        
        $pos = strpos($departamento,"D");

        if($pos ===false){
           $request->flash();
            return redirect()
                   ->back()
                   ->with('errors', 'Selecione um departamento. Os usuário são lotados em Departamentos.');

            //echo 'Selecione um departamento';
        }else{
            
            $departamentotrim = trim($departamento,"D"); 
            //$user = new User;
            $usuario->name = $request->get('nome');
            $usuario->email = $request->get('email');
            if (!is_null($request->get('password'))) {
            $usuario->password = bcrypt($request->get('password'));    
            }
            $usuario->departamento_id = $departamentotrim;
            $usuario->save();

            return redirect()
                   ->route('painel.usuarios.index')   
                   ->with('sucess','Usuário atualizado com Sucesso!');
        }
        //Remove a letra D enviada na seleção do Departamento
        
        //dd($departamentotrim);
        //Captura todos os campos enviados pelo formulario
        //return $request->all();
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        $usuario->delete();

        return redirect()
               ->route('painel.usuarios.index')   
               ->with('sucess','Usuário apagado com Sucesso!');
        
    }

    public function getUsuarios($idDepartamento)
    {
        $vazio = [];
        if ($idDepartamento==0) {
            return response()->json($vazio);
        }
        //dd("ALEXANDRE");
        $departamento = $this->departamentoModel->find($idDepartamento);
        $usuarios = $departamento->user()->getQuery()->get(['id', 'name']);
        //return response::json($usuarios);
        return response()->json($usuarios);
    }
}
