<?php

namespace App\Http\Controllers\painel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Link;
use App\Empresa;
use App\Departamento;
use App\User;
use App\DepartamentoLink;


class LinkController extends Controller
{
    public function index()
    {
         
            if(Auth::user()-> hasRole ( 'Admin')){
            	
            $links = Link::linksLista();
            //$links = Departamento::departamentosLista();
            //$links = Empresa::EmpresasDepartamentosLista();
            //$links = Link::linksUsuarioLogado();
            //dd($links);
            return view('painel.links.index', compact('links'));
            }
            
            if(Auth::user()-> hasRole ( 'AdminSetor')){
            $links = Departamento::departamentosLista();	
            $links = Link::linksUsuarioLogado();
            return view('painel.links.index', compact('links'));
            }

            if(Auth::user()-> hasRole ( 'User')){
            $links = Link::linksUsuarioLogado();
            return view('painel.links.index', compact('links'));
            }


    }


     public function create()
    {
        $tree = User::users_painel_tree();
        $linksGrupoMenu  = Link::linksGrupoMenu();
        return view('painel.links.create', compact('tree','linksGrupoMenu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //falta Validar Noticias e Departamentos
     
    //testa se o usuario logado é Administrador
      $admin =  Auth::user()-> hasRole ( 'Admin|AdminSetor' );
    if ($admin) {
        //Salvar Noticia
        $departamento = $request->resultado2;
        //dd($departamento);
        $pos = strpos($departamento,"D");
        if((Auth::user()-> hasRole ( 'Admin' ))AND($pos ===false)){
           $request->flash();
            return redirect()
                   ->back()
                   ->with('errors', 'Selecione um departamento. Os Links são vinculadas a Departamentos.');
        }else{
        
            //Cria e Salva o Link
            //dd($request->get('grupo'));
             $novoLink = new Link;
             $novoLink->nome=$request->get('titulo');
             $novoLink->link=$request->get('link');
             $novoLink->link_id=$request->get('grupo');
             $novoLink->save();

             //Separa os departamentos das empresas
            $departamento2 = explode(",", $departamento);
            //dd($departamento2);
           
            static $departamentosfilhos=[];
            $departamentosfilhos = collect($departamentosfilhos);
           
            foreach ($departamento2 as $departamentofiltrado) {
                if (!is_numeric($departamentofiltrado)) {
                    $departamentotrim = trim($departamentofiltrado,"D");
                    $departamentosfilhos->push($departamentotrim);
                }

                if(Auth::user()-> hasRole ( 'AdminSetor' )){
                $departamentosfilhos->push($departamentofiltrado);
                }
            }
            
            //dd($departamentosfilhos);
            //Cria e Salva o Departamento_Noticia

            foreach ($departamentosfilhos as $departamento) {
               // dd($departamento);
                $departamentoLink = new DepartamentoLink;
                $departamentoLink -> departamento_id = $departamento;
                //dd($departamento_noticia -> departamento_id);
                $departamentoLink -> link_id = $novoLink->id;
                $departamentoLink -> user_id = Auth::user()->id;
                //dd($departamento_noticia -> noticia_id);
                $departamentoLink -> save();
            }
            
            //Redireciona e notifica o Usuário
            return redirect()
                   ->route('painel.links.index')   
                   ->with('sucess','Link adicionado com Sucesso!');

    }    

    }
}


    public function edit(Link $link)
    {
    //Editar o nome e endereço do Links, bem como os setores que esse link alcanca.
    dd('Estou no EDIT');
    }

    public function destroy(Link $link)
    {
    //Apagar Somente no alcance
    dd('Estou no Destroy');
    }

}
