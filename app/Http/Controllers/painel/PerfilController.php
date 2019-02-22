<?php

namespace App\Http\Controllers\painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Arquivo;
use App\User;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
    return view('painel.usuarios.perfil');
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
    

    //Recuperando o Arquivo enviado e seus atributos.
     $arquivo = request()->file('file');
     $file['nome'] = $arquivo->getClientOriginalName();
     $file['extencao'] = $arquivo->getMimeType();
     $url = $arquivo->store('public/perfil');
     $file['url'] = Storage::url($url);

    //Salvando informações da imagem no Banco 
     $ArquivoBanco = new Arquivo;
     $ArquivoBanco->nome = $file['nome'];
     $ArquivoBanco->extencao = $file['extencao'];
     $ArquivoBanco->url = $file['url'];
     $ArquivoBanco->user_id=Auth::user()->id;
     $ArquivoBanco->save();

    //Trocar a imagem do usuário logado
    $perfilImagem = User::where('id',Auth::user()->id)->get()->first();
    $perfilImagem->arquivo_id = $ArquivoBanco->id;
    $perfilImagem->save();
    /*return redirect()
        ->route('perfil')   
        ->with('sucess','Imagem Atualizado com Sucesso!');*/
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
