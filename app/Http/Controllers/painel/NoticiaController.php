<?php

namespace App\Http\Controllers\painel;


/*use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Noticia;

use App\User;
use App\Departamento;
use App\Empresa;
use App\Departamento_Noticia;
use Illuminate\Auth\Access\Gate;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
*/

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Noticia;
use App\Departamento_Noticia;
use App\Departamento;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;
use App\Arquivo;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
         
            if(Auth::user()-> hasRole ( 'Admin|User|AdminSetor')){
            $noticiasdousuario = Noticia::noticias_painel();
                        
            //dd($noticiasdousuario);
            //$noticiasdousuario = collect($todasnoticias);
            return view('painel.noticias.index', compact('noticiasdousuario'));
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
        return view('painel.noticias.create', compact('tree'));
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
                   ->with('errors', 'Selecione um departamento. As Notícias são vinculadas em Departamentos.');

            //echo 'Selecione um departamento';
        }else{



            //Recuperando o Arquivo da Imagem enviado e seus atributos.
             $arquivo = request()->file('file');
            //Se tiver arquivo
            if ($arquivo) {
             
                $file['nome'] = $arquivo->getClientOriginalName();
                $file['extencao'] = $arquivo->getMimeType();
                $url = $arquivo->store('public/noticia');
                $file['url'] = Storage::url($url);

                //Salvando informações da imagem no Banco 
                $ArquivoBanco = new Arquivo;
                $ArquivoBanco->nome = $file['nome'];
                $ArquivoBanco->extencao = $file['extencao'];
                $ArquivoBanco->url = $file['url'];
                $ArquivoBanco->user_id=Auth::user()->id;
                $ArquivoBanco->save();
            }
          
           //Cria e Salva a Noticia
             $noticia = new Noticia;
             $noticia->noticia=$request->get('noticia');
             $noticia->titulo=$request->get('titulo');
             $noticia->publicado='N';
             $noticia->user_id=Auth::user()->id;
             if ($arquivo) {
             $noticia->arquivo_id = $ArquivoBanco->id;
             }
             $noticia->save();

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
                $departamento_noticia = new Departamento_Noticia;
                $departamento_noticia -> departamento_id = $departamento;
                //dd($departamento_noticia -> departamento_id);
                $departamento_noticia -> noticia_id = $noticia->id;
                $empresa_departamento_id = Departamento::where('id',$departamento)->get()->first();
                //dd($empresa_departamento_id);
                //dd($empresa_departamento_id->empresa_id);
                $departamento_noticia -> empresa_id = $empresa_departamento_id->empresa_id;

                $departamento_noticia -> user_id = Auth::user()->id;
                //dd($departamento_noticia -> noticia_id);
                $departamento_noticia -> save();
            }
            
            //Redireciona e notifica o Usuário
            return redirect()
                   ->route('painel.noticias.index')   
                   ->with('sucess','Notícia adicionado com Sucesso!');

    }    

    }else{

    //Quando for usuário, libarar somente a noticia para seu departamento

            //Recuperando o Arquivo enviado e seus atributos.
             $arquivo = request()->file('file');
             $file['nome'] = $arquivo->getClientOriginalName();
             $file['extencao'] = $arquivo->getMimeType();
             $url = $arquivo->store('public/noticia');
             $file['url'] = Storage::url($url);

            //Salvando informações da imagem no Banco 
            $ArquivoBanco = new Arquivo;
            $ArquivoBanco->nome = $file['nome'];
            $ArquivoBanco->extencao = $file['extencao'];
            $ArquivoBanco->url = $file['url'];
            $ArquivoBanco->user_id=Auth::user()->id;
            $ArquivoBanco->save();
           
           //Cria e Salva a Noticia
             $noticia = new Noticia;
             $noticia->noticia=$request->get('noticia');
             $noticia->titulo=$request->get('titulo');
             $noticia->publicado='N';
             $noticia->user_id=Auth::user()->id;
             if ($arquivo) {
             $noticia->arquivo_id = $ArquivoBanco->id;
             }
             $noticia->save();

            
     
            //Salva o Departamento da noticia
             $departamento_noticia = new Departamento_Noticia;
             $departamento_noticia -> departamento_id = Auth::user()->departamento_id;
             $departamento_noticia -> noticia_id = $noticia->id;
             $departamento_usuario = Auth::user()->departamento_id;
             $departamento = Departamento::where('id',$departamento_usuario)->get()->first(); 
             $departamento_noticia -> empresa_id = $departamento->empresa_id;
             $departamento_noticia -> user_id = Auth::user()->id;
             $departamento_noticia -> save();

            //Redireciona e notifica o Usuário
            return redirect()
                   ->route('painel.noticias.index')   
                   ->with('sucess','Notícia adicionado com Sucesso!');

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
        $noticia = Noticia::where('id',$id)->get()->first();

         return view('painel.noticias.show',compact('noticia'));
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
        //dd($departamento_noticias_lista_restore);
        $value = $departamento_noticias_lista_restore->implode('departamento_id',',');
        $value2 = explode(",", $value);
        //dd($value2);
        if(Auth::user()-> hasRole ( 'Admin' )){
        foreach ($value2 as $id => $item) {
            $value3[$id]= $item.'D';
        }
        }else{
            $value3=$value2;
        }
       //dd($value3);
       // dd($departamento_noticias_lista_restore);   

        return view('painel.noticias.edit',compact('noticia','value3','tree')); 
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
        //Recuperando o Arquivo da Imagem enviado e seus atributos.
             $arquivo = request()->file('file');
             //dd($arquivo);
            //Se tiver arquivo
            if ($arquivo) {
                $file['nome'] = $arquivo->getClientOriginalName();
                $file['extencao'] = $arquivo->getMimeType();
                $url = $arquivo->store('public/noticia');
                $file['url'] = Storage::url($url);

        //Salvando informações da imagem no Banco 
                $ArquivoBanco = new Arquivo;
                $ArquivoBanco->nome = $file['nome'];
                $ArquivoBanco->extencao = $file['extencao'];
                $ArquivoBanco->url = $file['url'];
                $ArquivoBanco->user_id=Auth::user()->id;
                $ArquivoBanco->save();
            }

        //Fim do Salvamento da Imagem

        //Atualizando dados da noticia
             $noticia->noticia = $request->get('noticia');
             $noticia->titulo = $request->get('titulo');
             $noticia->user_id = Auth::user()->id;
             if ($arquivo) {
             $noticia->arquivo_id = $ArquivoBanco->id;
             }
             //dd("estou aqui!!!");
             $noticia->save();




    $admin =  Auth::user()-> hasRole ( 'Admin|AdminSetor' );
    if ($admin) {    

        //Pegando a Lista de departamento Antiga enviada para edição
        $departamento_a = $request->resultado1;
        //Transformando o Texto Json em Array
        $departamento_anterior = json_decode($departamento_a);
        //Pegando a lista de departamento selecionada apos edição
        $departamento = $request->resultado2;
        //transformando em um Array
        $departamento2 = explode(",", $departamento);
        //dd($departamento2);
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
                   ->with('sucess','Noticia atualizada com Sucesso!');
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
                //dd( $departamento_id);

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
                //dd($departamento_noticia -> noticia_id);
                $departamento_noticia -> user_id = Auth::user()->id;
                //dd("estou aqui");
                $departamento_noticia -> save();

               
            }

        }

        }
        
        }

            return redirect()
                   ->route('painel.noticias.index')   
                   ->with('sucess','Noticia atualizada com Sucesso!');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Noticia $noticia)
    {
        $noticia_id = $noticia->id;
        //dd($noticia_id);
        $remover = Departamento_Noticia::where('noticia_id', $noticia_id)->get();
        //dd($remover);
        foreach ($remover as $remov) {
            $remov->delete();
        }

        $noticia->delete();

        return redirect()
               ->route('painel.noticias.index')   
               ->with('sucess','Notícia apagada com Sucesso!');
    }


    public function noticiaRedirecionamento()
    {

       $noticias = Noticia::noticias_painel();

       dd($noticias);

        $noticias = DB::table ("noticias")
            -> select ("noticias.id","noticias.user_id");
        
        $redistribuidos = DB::table ("redistribuir__noticias")
            -> select ("redistribuir__noticias.id","redistribuir__noticias.user_id")
            -> unionAll ($noticias)
        -> get();

        return $redistribuidos;
    }

}
