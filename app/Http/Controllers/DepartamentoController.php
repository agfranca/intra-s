<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Departamento;
use App\Empresa;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $empresasN0 = Empresa::empresasfilhos(Empresa::empresaraiz()->id); 
      //$empresasN1 =Empresa::listarempresas(Empresa::empresasfilhos(Empresa::empresaraiz()->id));
       //$teste=Empresa::listarempresas2(Empresa::empresaraiz());
       // $teste=Empresa::listarempresas2(Empresa::listarempresa(4));


            //retorna o id do departamento do usuario logado
            $departamentos_id = Auth::user()->departamento_id;

            //Retorna o departamento do usuário logado
              $departamento_usuario = DB::table('departamentos')->where('id',$departamentos_id)->first();
        
            //Retorna o id da empresa do usuario logado
            $empresa_id = $departamento_usuario->empresa_id;  
            
        //Lista as Empresas da empresa do Usuario Logado
        $teste=Empresa::listarempresas2(Empresa::listarempresa($empresa_id));
       
       //dd($teste);
       return view('painel.noticias.departamento', compact('teste'));
       /* foreach ($empresasN1 as $empresa ) {
        echo "{$empresa->nome} <br>";
               
               $empresasN2 = Empresa::empresasfilhos($empresa->id); 
               foreach ($empresasN2 as $empresa ) { 
                $id=$empresa->id;
                echo "{$empresa->nome} <br>";

                        $empresasN3 = Empresa::empresasfilhos($empresa->id); 
                        foreach ($empresasN3 as $empresa ) { 
                        $id=$empresa->id;
                        echo "{$empresa->nome} <br>";
                        }

               }
        }*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

//Pega as Empresas
        $empresas = Empresa::all();
        //Lista as Empresas
        foreach ($empresas as $empresa ) {
            //Nível 0
            //Testa se a Empresa é Raiz Pai
            if (is_null($empresa->empresa_pai)) {
                echo "{$empresa->nome} <br>";
                //pegar o departamentos da empresa pai 
                $idpai= $empresa->id;
                $departamentospai = Departamento::where('empresa_id',"{$idpai}")->get();
               //lista os departamentos da empresa Pai
                foreach ($departamentospai as $departamentopai) {
                    echo "&nbsp&nbsp{$departamentopai->nome} <br>";
                }
                    //Nível 1
                    //Pega as empresas Filho do Raiz Pai
                    $empresasfilhos = $empresa->empresas()->get();
                    //Lista as empresas filhos do pai    
                    foreach ($empresasfilhos as $empresafilho ) {
                        echo "&nbsp<i> {$empresafilho->nome}</i> <br>";
                        //pegar o departamentos da empresa filha 
                        $idfilho= $empresafilho->id;
                        $departamentosfilho = Departamento::where('empresa_id',"{$idfilho}")->get();
                       //lista os departamentos da empresa Pai
                        foreach ($departamentosfilho as $departamentofilho) {
                            echo "&nbsp&nbsp&nbsp{$departamentofilho->nome} <br>";
                        }

                    //Nível 2
                    //Pega as empresas Filho do Raiz Pai
                            $empresasnetos = Empresa::empresasfilhos($idfilho);
                            foreach ($empresasnetos as $empresaneto ) {
                                echo "&nbsp<i> {$empresaneto->nome}</i> <br>";
                                //pegar o departamentos da empresa filha 
                                $idneto= $empresaneto->id;
                                $departamentosneto = Departamento::where('empresa_id',"{$idneto}")->get();
                               //lista os departamentos da empresa Pai
                                foreach ($departamentosneto as $departamentoneto) {
                                    echo "&nbsp&nbsp&nbsp{$departamentoneto->nome} <br>";
                                }
                            }
                    }
            }
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
}
