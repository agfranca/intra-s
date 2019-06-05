<?php

namespace App\Http\Controllers\painel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\Noticia;
use App\Departamento_Noticia;
use App\Redistribuir_Noticia;
use App\Departamento;

class RedistribuirNoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit(Noticia $noticia)
    {
     $tree = User::users_painel_tree();

        $departamento_noticias_lista_restore = Departamento_Noticia::where('noticia_id',$noticia->id)->get();
        //dd($noticia->id);
        
        $value = $departamento_noticias_lista_restore->implode('departamento_id',',');
        $value2 = explode(",", $value);

        if(Auth::user()-> hasRole ( 'Admin' )){
        foreach ($value2 as $id => $item) {
            $value3[$id]= $item.'D';
        }
        }else{
            $value3=$value2;
        }



       //dd($value3);
       // dd($departamento_noticias_lista_restore);   

        return view('painel.noticias.redistribuir',compact('noticia','value3','tree'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Noticia $noticia)
    {
        //Fazer validacao de dados 

              //Atualizando dados da Redistribuir Noticia
             //Cria e Salva Redistribuir Noticia
             $redistribuir = new Redistribuir_Noticia;
             $redistribuir->nota = $request->get('comentario');
             $redistribuir->user_id = Auth::user()->id;
             $redistribuir->noticia_id = $noticia->id;
             $redistribuir->save();

            
        //Pegando a Lista de departamento Antiga enviada para edição
        $departamento_a = $request->resultado1;
        //Transformando o Texto Json em Array
        $departamento_anterior = json_decode($departamento_a);
        //Pegando a lista de departamento selecionada apos edição
        $departamento = $request->resultado2;
        //transformando em um Array
        $departamento2 = explode(",", $departamento);
        //Removendo as Empresas, deixando somente os departamentos
        foreach ($departamento2 as $id => $departamento3) {
            if (!is_numeric($departamento3)) {
                $departamento_atual[$id] =$departamento3;
            }
        }
        
        if (Auth::user()-> hasRole ( 'AdminSetor' )) {
            $departamento_atual=$departamento2;
        }


        //dd($departamento_anterior);
        //dd($departamento_atual);
       // $departamento_remover = $departamento_anterior->diff($departamento_atual);
        //Verificando o que tem que remover
        $departamento_remover = array_diff ( $departamento_anterior , $departamento_atual);
        //Verificando o que tem que adicionar
        $departamento_adicionar = array_diff ( $departamento_atual , $departamento_anterior);
        //dd($departamento_adicionar);
        //Testando para saber o que fazer adicionar, remover ou somente reditrecionar 
        if (array_count_values($departamento_remover)==NULL AND array_count_values($departamento_adicionar)==NULL) {
           //Redirecionar pois não houve mudança
            //echo "Não tenho o que fazer";
            return redirect()
                   ->route('painel.noticias.index')   
                   ->with('sucess','Notícia Distribuída com Sucesso!');
        }else{

        if (array_count_values($departamento_remover)<>NULL) {
            echo "Tenho o que Remover";
            foreach ($departamento_remover as $departamento) {
               // dd($departamento);
                $noticia_id = $noticia->id;
                if (Auth::user()-> hasRole ( 'Admin' )) {
                $departamento_id = substr($departamento,0,-1);
                }

                if (Auth::user()-> hasRole ( 'AdminSetor' )) {
                $departamento_id = $departamento;
                }

                $remover = Departamento_Noticia::where('departamento_id',$departamento_id)
                                                ->where('noticia_id',$noticia_id)
                                                ->get()
                                                ->first();
                //dd($remover);
                $remover->delete();
            }
        }
        
        if (array_count_values($departamento_adicionar)<>NULL) {
            //echo "Tenho o que Adicionar";


            foreach ($departamento_adicionar as $departamento) {
               // dd($departamento);
                $noticia_id = $noticia->id;
                if (Auth::user()-> hasRole ( 'Admin' )) {
                $departamento_id = substr($departamento,0,-1);
                }

                if (Auth::user()-> hasRole ( 'AdminSetor' )) {
                $departamento_id = $departamento;
                }
                //dd( $departamento_id);
                $departamento_noticia = new Departamento_Noticia;

                $departamento_noticia -> departamento_id = $departamento_id;
                //dd($departamento_noticia -> departamento_id);
                $departamento_noticia -> noticia_id = $noticia_id;
                $empresa_departamento_id = Departamento::where('id',$departamento)->get()->first();
                //dd($empresa_departamento_id);
                //dd($empresa_departamento_id->empresa_id);
                $departamento_noticia -> empresa_id = $empresa_departamento_id->empresa_id;
                $departamento_noticia -> user_id = Auth::user()->id;
                //dd($departamento_noticia -> noticia_id);


                //Salvar o ID da redistribuição na tabela do Departamento_noticia
                $departamento_noticia -> redistribuir_noticias_id = $redistribuir->id;


                $departamento_noticia -> save();

               
            }



        }
        
            return redirect()
                   ->route('painel.noticias.index')   
                   ->with('sucess','Notícia Distribuída com Sucesso!');

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
        //
    }
}
