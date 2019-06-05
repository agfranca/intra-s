<?php

namespace App\Http\Controllers\painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Banner;
use App\User;
use App\Arquivo;
use App\Noticia;
use App\Departamento;
use App\Banner_Departamento;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    


    public function index()
    {
        if(Auth::user()-> hasRole ( 'Admin|User|AdminSetor' )){
        //dd('estou aqui');
        $bannersdousuario = Banner::banners_painel();
        $tree = User::users_painel_tree();
        //$tree = Departamento::departamento_painel();
        //dd($bannersdousuario);

        

        return view('painel.banners.index', compact('tree','bannersdousuario'));

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
        return view('painel.banners.create', compact('tree'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
     //Recuperando o Arquivo enviado e seus atributos.
     $arquivo = request()->file('file');
     $file['nome'] = $arquivo->getClientOriginalName();
     $file['extencao'] = $arquivo->getMimeType();
     $url = $arquivo->store('public/banner');
     $file['url'] = Storage::url($url);

     //Salvando informações da imagem no Banco 
      $bannerArquivo = new Arquivo;
        $bannerArquivo->nome = $file['nome'];
        $bannerArquivo->extencao = $file['extencao'];
        $bannerArquivo->url = $file['url'];
        $bannerArquivo->user_id=Auth::user()->id;
      $bannerArquivo->save();

     //Salvando o Banner
      $banner = new Banner;
          $banner->titulo = $bannerArquivo->nome;
          $banner->arquivo_id = $bannerArquivo->id;
          $banner->user_id=Auth::user()->id;
          $banner->publicado="N";
          
      $banner->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('Estou no Show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
    //adasds
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
      //dd($request->id);
      //dd($request->titulonovo);
      $id = $request->id;
      
      $banner = Banner::where('id',$id)->get()->first();
      $banner->titulo = $request->titulonovo;
      $banner->save();
            return redirect()
                   ->route('painel.banners.index')   
                   ->with('sucess','Banner Atualizado com Sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Banner $banner)
    {
        $url = $banner->arquivo->url;
        $url2= str_replace('storage', 'public',$url);
        //dd($url2);

        //Apagar o Arquivo Fisico    
        //Storage::delete( $banner->arquivo->url);
        Storage::delete($url2);
          
        //Apagar a linha do Arquivo no Banco
        $arquivo = Arquivo::where('id', $banner->arquivo->id)->first();
        $arquivo->delete();


        //Apagar a Distribuição

        $bannerDepartamentos = Banner_Departamento::where('banner_id',$banner->id)->get();
        foreach ($bannerDepartamentos as $bannerDepartamento) {
           $bannerDepartamento->delete();
        }



        //Apagar o Banner no Banco
         $banner->delete();

        //Retornar Mensagem
        return redirect()
        ->route('painel.banners.index')   
        ->with('sucess','Banner apagado com Sucesso!');
        
    }


    public function publicar(Request $request)
    {
    //dd('Estou Aqui');
    //$id_banner = $request->banner_id;
         // dd($id_banner);

      //falta Validar Noticias e Departamentos
      if(Auth::user()-> hasRole ( 'Admin|AdminSetor')){
        //Verificar se foi escolhido algum departamento
        $departamento = $request->resultado2;
        //dd($departamento);
        if (Auth::user()-> hasRole ( 'Admin')) {
        $pos = strpos($departamento,"D");
        }else{
         $pos = $departamento; 
        }
        if($pos===false){
         $request->flash();
         return redirect()
         ->back()
         ->with('errors', 'Selecione um departamento. As Notícias são vinculadas aos Departamentos.');
          }elseif(is_null($pos)){
              $request->flash();
              return redirect()
              ->back()
              ->with('errors', 'Selecione um departamento. As Notícias são vinculadas aos Departamentos.');
          }else{
        //Quando um departamento por Escolhido


          //Separa os departamentos das empresas
          $departamento2 = explode(",", $departamento);
          
          //dd($departamento2);
          //Cria o Campo para Departamento Filho
          static $departamentosfilhos=[];
          $departamentosfilhos = collect($departamentosfilhos);
        
          //Departamentos escolhidos 
          foreach ($departamento2 as $departamentofiltrado) {
            
            if (!is_numeric($departamentofiltrado)) {
              $departamentotrim = trim($departamentofiltrado,"D");
              $departamentosfilhos->push($departamentotrim);
            }elseif(Auth::user()-> hasRole ( 'AdminSetor')){
              $departamentosfilhos->push($departamentofiltrado);
            }
          }
        
          //dd($departamentosfilhos);
          
          //Cria e Salva o Banner_Departamento
          foreach ($departamentosfilhos as $departamento) {
                   // dd($departamento);
            $banner_departamento = new Banner_Departamento;
            
            $banner_departamento -> departamento_id = $departamento;
                    //dd($departamento_noticia -> departamento_id);
            $banner_departamento -> banner_id = $request->banner_id;

            $banner_departamento_id = Departamento::where('id',$departamento)->get()->first();
                    //dd($banner_departamento_id);
                    //dd($banner_departamento_id->empresa_id);
            $banner_departamento -> empresa_id = $banner_departamento_id->empresa_id;
                    //dd($departamento_noticia -> noticia_id);
            $banner_departamento -> save();
          }

        //Mudar o Status de Publicado para S
        $banner_id = $request-> banner_id;
        //dd($banner_id);
        $banner = Banner::where('id',$banner_id)->get()->first();
        //dd($banner->publicado);
        $banner-> publicado = 'S';
        $banner->save();

        //Redirecionar para tela Index banner e passar a menssagem 
      return redirect()
      ->route('painel.banners.index')   
      ->with('sucess','Banner Publicado com Sucesso!');

    }
      }

      if(Auth::user()-> hasRole ( 'User')){

        //dd($request-> banner_id);
        //Criando e Salvando o Departamento
        $banner_departamento = new Banner_Departamento;
        $banner_departamento -> departamento_id = Auth::user()->departamento_id;
        $banner_departamento -> banner_id = $request-> banner_id;
        $departamento_usuario = Auth::user()->departamento_id;
        $departamento = Departamento::where('id',$departamento_usuario)->get()->first();
        $banner_departamento -> empresa_id = $departamento->empresa_id;
        $banner_departamento -> save();
        
        //Banner
        //Mudar o Status de Publicado para S
        $banner_id = $request-> banner_id;
        //dd($banner_id);
        $banner = Banner::where('id',$banner_id)->get()->first();
        //dd($banner->publicado);
        $banner-> publicado = 'S';
        $banner->save();

        //Redirecionar para tela Index banner e passar a menssagem 
        return redirect()
        ->route('painel.banners.index')   
        ->with('sucess','Banner Publicado com Sucesso!');
      }

    }





public function editarPublicar(Banner $banner)
    {

      //dd($banner->id);

      $tree = User::users_painel_tree();
      $bannersdousuario = Banner::banners_painel();
      $bannerEditar = $banner;
        
      $banner_departamento_lista_restore = Banner_Departamento::where('banner_id',$banner->id)->get();
        //dd($noticia->id);
        $value = $banner_departamento_lista_restore->implode('departamento_id',',');
        $value2 = explode(",", $value);
        if(Auth::user()-> hasRole ( 'Admin')){
        foreach ($value2 as $id => $item) {
            $value3[$id]= $item.'D';
        }
        $banners_restore = json_encode($value3);
        }elseif (Auth::user()-> hasRole ( 'AdminSetor')) {
          $banners_restore=json_encode($value2);
        }
       //dd($banners_restore);
       // dd($departamento_noticias_lista_restore);   
        return view('painel.banners.publicar.editar',compact('bannersdousuario','banners_restore','tree','bannerEditar')); 

    }

    

 public function updatePublicar(Request $request, Banner $banner)
    {
//Fazer validacao de dados 

//Atualizando dados da Publicação

    //Pegando a Lista de departamento Antiga enviada para edição
        $departamento_a = $request->resultado1;
        //Transformando o Texto Json em Array
        $departamento_anterior = json_decode($departamento_a);
        //dd($departamento_anterior);
        
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
          //dd($departamento_anterior);
          
            
          //dd($departamento_atual);
          //dd(array_count_values($departamento_atual));




        //Verificando o que tem que remover
        $departamento_remover = array_diff ( $departamento_anterior , $departamento_atual);

        //Verificando o que tem que adicionar
        $departamento_adicionar = array_diff ( $departamento_atual , $departamento_anterior);

        

//Testando para saber o que fazer adicionar, remover ou somente reditrecionar 


//REMOVEU TUDO vai despublicar


      //if (is_array($departamento_atual)) {   
       //  if ($departamento_atual[0]==""){
     // if (array_count_values($departamento_atual)==NULL){
        $contar=0;
        foreach ($departamento_atual as $temconteudo ) {
          if ($temconteudo!="") {
          $contar=$contar+1;  
          }  
        }
  //dd($contar);


        if ($contar==0) {
//Só remove e não Adiociona
          //dd('Alexandre');
          foreach ($departamento_remover as $departamento) {
               // dd($departamento);
                $banner_id = $banner->id;
                $departamento_id = substr($departamento,0,-1);
                //dd( $departamento_id);

                $remover = Banner_Departamento::where('departamento_id',$departamento_id)
                                                ->where('banner_id',$banner_id)
                                                ->get()
                                                ->first();
                //dd($remover);
                $remover->delete();
          }
          //dd('Alexandre');
          $banner->publicado = 'N';
          $banner->save();
          
          //Menssagem ao Usuario
            return redirect()
                   ->route('painel.banners.index')   
                   ->with('sucess','Banner disponível para Publicação!');
         
        }


//Redirecionar pois não houve mudança
        if (array_count_values($departamento_remover)==NULL AND array_count_values($departamento_adicionar)==NULL) {

           
            //echo "Não tenho o que fazer";
            return redirect()
                   ->route('painel.banners.index')   
                   ->with('sucess','Nenhuma Modificação Foi Realizada!');
        }else{

        if (array_count_values($departamento_remover)<>NULL AND array_count_values($departamento_adicionar)==NULL) {

//Só remove e não Adiociona
          
          foreach ($departamento_remover as $departamento) {
               // dd($departamento);
                $banner_id = $banner->id;
                $departamento_id = substr($departamento,0,-1);
                //dd( $departamento_id);

                $remover = Banner_Departamento::where('departamento_id',$departamento_id)
                                                ->where('banner_id',$banner_id)
                                                ->get()
                                                ->first();
                //dd($remover);
                $remover->delete();
            }

            //Menssagem ao Usuario
            return redirect()
                   ->route('painel.banners.index')   
                   ->with('sucess','Departamento Removido com Sucesso!');
         
                        
        }else{
        
        if (array_count_values($departamento_remover)==NULL AND array_count_values($departamento_adicionar)<>NULL) {
//Só Adiciona e não Remove

          foreach ($departamento_adicionar as $departamento) {
               // dd($departamento);
                $banner_id = $banner->id;
                $departamento_id = substr($departamento,0,-1);
                //dd( $departamento_id);
                $banner_departamento = new Banner_Departamento;

                $banner_departamento -> departamento_id = $departamento_id;
                //dd($departamento_noticia -> departamento_id);
                $banner_departamento -> banner_id = $banner_id;
                $empresa_departamento_id = Departamento::where('id',$departamento)->get()->first();
                //dd($empresa_departamento_id);
                //dd($empresa_departamento_id->empresa_id);
                $banner_departamento -> empresa_id = $empresa_departamento_id->empresa_id;
                //dd($departamento_noticia -> noticia_id);
                $banner_departamento -> save();

               
            }

            return redirect()
                   ->route('painel.banners.index')   
                   ->with('sucess','Departamento Adicionado com Sucesso!');

           
        }else{  


        if (array_count_values($departamento_remover)<>NULL AND array_count_values($departamento_adicionar)<>NULL) {

// Remove e Adiciona ao mesmo tempo

          //REMOVER
          foreach ($departamento_remover as $departamento) {
               // dd($departamento);
                $banner_id = $banner->id;
                $departamento_id = substr($departamento,0,-1);
                //dd( $departamento_id);

                $remover = Banner_Departamento::where('departamento_id',$departamento_id)
                                                ->where('banner_id',$banner_id)
                                                ->get()
                                                ->first();
                //dd($remover);
                $remover->delete();
            }

          //ADICIONAR

          foreach ($departamento_adicionar as $departamento) {
               // dd($departamento);
                $banner_id = $banner->id;
                $departamento_id = substr($departamento,0,-1);
                //dd( $departamento_id);
                $banner_departamento = new Banner_Departamento;

                $banner_departamento -> departamento_id = $departamento_id;
                //dd($departamento_noticia -> departamento_id);
                $banner_departamento -> banner_id = $banner_id;
                $empresa_departamento_id = Departamento::where('id',$departamento)->get()->first();
                //dd($empresa_departamento_id);
                //dd($empresa_departamento_id->empresa_id);
                $banner_departamento -> empresa_id = $empresa_departamento_id->empresa_id;
                //dd($departamento_noticia -> noticia_id);
                $banner_departamento -> save();

               
            }  

          //Menssagem ao Usuario
            return redirect()
                   ->route('painel.banners.index')   
                   ->with('sucess','Publicação atualizada com Sucesso!');
         


        } 
          
        }
      }

      }  
    }







}