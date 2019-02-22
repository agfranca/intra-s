<?php

namespace App\Http\Controllers\painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Empresa;
use App\User;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
         if(Auth::user()-> hasRole ( 'Admin' )){

             $empresa = Empresa::empresa_user_logado();
             $todasempresas = Empresa::empresas_painel($empresa);

        
        return view('painel.empresas.index', compact('todasempresas'));

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
        $tree = Empresa::empresas_painel_tree();
        return view('painel.empresas.create', compact('tree'));
        
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

       // dd($departamento);
        
        if(is_null($departamento)){
           $request->flash();
            return redirect()
                   ->back()
                   ->with('errors', 'Selecione uma empresa a ser subordinada.');

            //echo 'Selecione um departamento';
        }else{

         $Empresa = new Empresa;
            $Empresa->nome = $request->get('nome');
            $Empresa->empresa_pai = $request->get('resultado2');
            $Empresa->save();
            return redirect()
                   ->route('painel.empresas.index')   
                   ->with('sucess','Empresa Adicionado com Sucesso!');
        }

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
    public function edit(Empresa $empresa)
    {
        //dd($empresa);
        $tree = Empresa::empresas_painel_tree();
        return view('painel.empresas.edit',compact('empresa','tree'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
            //Validaçãode dados


        //Gravação de dados
       // $departamento = $request->resultado2;

       // dd($departamento);
            $empresa->nome = $request->get('nome');
            $empresa->empresa_pai = $request->get('resultado2');
            $empresa->save();
            return redirect()
                   ->route('painel.empresas.index')   
                   ->with('sucess','Empresa Atualizada com Sucesso!');
        


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();

        return redirect()
               ->route('painel.empresas.index')   
               ->with('sucess','Empresa apagada com Sucesso!');
        
    }
}
