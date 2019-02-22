<?php

namespace App\Http\Controllers\painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ArquivoController extends Controller
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
        
        $bannerArquivo = new Arquivo;
            //$Arquivo->nome = 'Teste';
            //$Arquivo->extencao = 'Teste';
            //$Arquivo->url = 'Teste';

  
           // $bannerArquivo->nome = $file['nome'];
           // $bannerArquivo->extencao = $file['extencao'];
           // $bannerArquivo->url = $file['url'];


            //$Arquivo->nome = $request->get($file['nome']);
            //$Arquivo->extencao = $request->get($file['extencao']);
            //$Arquivo->url = $request->get($file['url']);
        $bannerArquivo->save();











        //Carregar o arquivo
        $arquivo = request()->file('file');  
        dd($arquivo);
        //Pegar no nome da imagem
            $arquivoName = $arquivo->getClientOriginalName();
        //Pegar a extenção da imagem
            $arquivoExtensao = $arquivo->getMimeType();
        //Salvar imagem
            $photoUrl = $photo->store('public/$diretorio');


   // $file = $request->all();

   // $filePath = Storage::putFile(storage_path($diretorio), request()->file('file')  );

    //dd($request->file('file')->getMimeType());

   // $file['path'] = Storage::url($filePath);
   // $file['size'] = Storage::size($filePath);
    //$file['type'] = $request->file('file')->getMimeType();

   // return $file;

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
