<?php

namespace App\Http\Controllers\painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Departamento;
use App\Empresa;
use App\User;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if(Auth::user()-> hasRole ( 'Admin' )){
        $departamentos = Departamento::departamento_painel();
        
        return view('painel.departamentos.index', compact('departamentos'));

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
        $tree = User::users_painel_tree();
        //$tree = Empresa::empresas_painel_tree();
        return view('painel.departamentos.create', compact('tree'));
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

        //dd($departamento);
        
        if(is_null($departamento)){
           $request->flash();
            return redirect()
                   ->back()
                   ->with('errors', 'Selecione uma empresa para o depatamento.');

            //echo 'Selecione um departamento';
        }else{
            $DepartamentoPai = NULL;
            $EmpresaId = NULL;

            $pos = strpos($departamento,"D");
            if($pos ===false){
            $EmpresaId = $request->get('resultado2');
            }else{
            $Departamentotrim = trim($departamento,"D");
            $DepartamentoPai = $Departamentotrim;
            $Departamento = Departamento::where('id',$DepartamentoPai)->first();
            //dd($Departamento->empresa_id);
            $EmpresaId = $Departamento->empresa_id;
            }

            //dd($EmpresaId);
            
            $Departamento = new Departamento;
            $Departamento->nome = $request->get('nome');
            $Departamento->departamento_pai = $DepartamentoPai;
            $Departamento->empresa_id = $EmpresaId;
            $Departamento->save();
            return redirect()
                   ->route('painel.departamentos.index')   
                   ->with('sucess','Departamento Adicionado com Sucesso!');
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
    public function edit(Departamento $departamento)
    {
        //dd($empresa);
        //$tree = Empresa::empresas_painel_tree();
        $tree = User::users_painel_tree();
        return view('painel.departamentos.edit',compact('departamento','tree'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departamento $departamento)
    {
                    //Validaçãode dados


        //Gravação de dados
       // $departamento = $request->resultado2;

        //dd($request->get('nome'));
           

            //****************  07/05/2019 ************************
            //Gravação de dados
            $departamentoSelecionado = $request->get('resultado2');
            $DepartamentoPai = NULL;
            $EmpresaId = NULL;

            //dd($departamentoSelecionado);

            $pos = strpos($departamentoSelecionado,"D");
            if($pos ===false){
            $EmpresaId = $departamentoSelecionado;
            }else{
            $Departamentotrim = trim($departamentoSelecionado,"D");
            $DepartamentoPai = $Departamentotrim;
            $Departamento = Departamento::where('id',$DepartamentoPai)->first();
            //dd($Departamento->empresa_id);
            $EmpresaId = $Departamento->empresa_id;
            }


            //dd($Departamento);

            //dd($departamento->nome);
            //dd($EmpresaId);
            //dd($DepartamentoPai);
            //***** 07/05/2019 ********
            $departamento->nome = $request->get('nome');
            $departamento->empresa_id = $EmpresaId;
            $departamento->departamento_pai = $DepartamentoPai;
            $departamento->save();
            return redirect()
                   ->route('painel.departamentos.index')   
                   ->with('sucess','Departamento Atualizado com Sucesso!');
        



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departamento $departamento)
    {
         $departamento->delete();

        return redirect()
               ->route('painel.departamentos.index')   
               ->with('sucess','Departamentos apagado com Sucesso!');
        
    }


}
