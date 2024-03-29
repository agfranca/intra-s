<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/


//Auth::routes();


  		// Authentication Routes...
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
        Route::post('login', 'Auth\LoginController@login');
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');

        // Registration Routes...
        Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'Auth\RegisterController@register');

        // Password Reset Routes...
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset');

        


    //Route::get('/', 'HomeController@index');
    //Route::get('/home', 'HomeController@index')->name('home');

    //Route::group(['prefix'=> 'painel'],function(){
	
    //'painel\PainelController@index')->name('painel');
    Route::get('/', 'painel\PainelController@index');	
    Route::get('/home', 'painel\PainelController@index')->name('home');


    //});

//if(Auth::check()) {
        
        //'middleware' => ['auth']

    Route::group (['middleware'=>['role:Admin', 'auth' ]], function () { 
        
        //Empresas
        Route::get('painel/empresas', 'painel\EmpresaController@index')->name('painel.empresas.index');
        Route::get('painel/empresas/create', 'painel\EmpresaController@create')->name('painel.empresas.create');
        Route::post('painel/empresas/create', 'painel\EmpresaController@store')->name('painel.empresas.store');
        Route::get('painel/empresas/{empresa}/edit', 'painel\EmpresaController@edit')->name('painel.empresas.edit');
        Route::put('painel/empresas/{empresa}', 'painel\EmpresaController@update')->name('painel.empresas.updade');
        Route::delete('painel/empresas/{empresa}', 'painel\EmpresaController@destroy')->name('painel.empresas.destroy');

        //Usuários
        Route::get('painel/usuarios', 'painel\UserController@index')->name('painel.usuarios.index');
        Route::get('painel/usuarios/create', 'painel\UserController@create')->name('painel.usuarios.create');
        Route::post('painel/usuarios/create', 'painel\UserController@store')->name('painel.usuarios.store');
        Route::delete('painel/usuarios/{usuario}', 'painel\UserController@destroy')->name('painel.usuarios.destroy');
        Route::get('painel/usuarios/{usuario}/edit', 'painel\UserController@edit')->name('painel.usuarios.edit');
        Route::put('painel/usuarios/{usuario}', 'painel\UserController@update')->name('painel.usuarios.updade');
        Route::get('painel/usuarios/habilitaradm/{usuario}', 'painel\UserController@habilitaradm')->name('painel.usuarios.habilitaradm');
        Route::get('painel/usuarios/habilitaradmsetor/{usuario}', 'painel\UserController@habilitaradmsetor')->name('painel.usuarios.habilitaradmsetor');
        Route::get('painel/usuarios/desabilitaradm/{usuario}', 'painel\UserController@desabilitaradm')->name('painel.usuarios.desabilitaradm');


        //Departamento
        Route::get('painel/departamentos', 'painel\DepartamentoController@index')->name('painel.departamentos.index');
        Route::get('painel/departamentos/create', 'painel\DepartamentoController@create')->name('painel.departamentos.create');
        Route::post('painel/departamentos/create', 'painel\DepartamentoController@store')->name('painel.departamentos.store');
        Route::get('painel/departamentos/{departamento}/edit', 'painel\DepartamentoController@edit')->name('painel.departamentos.edit');
        Route::put('painel/departamentos/{departamento}', 'painel\DepartamentoController@update')->name('painel.departamentos.updade');
        Route::delete('painel/departamentos/{departamento}', 'painel\DepartamentoController@destroy')->name('painel.departamentos.destroy');
    });

//} redirect('http://intra-s.test/login');



    Route::group (['middleware'=>['role:Admin|AdminSetor|User', 'auth']], function () { 
        
        //PAINEL
        Route::get('painel', 'painel\PainelController@index')->name('painel');
        Route::get('painel/departamento', 'DepartamentoController@index')->name('painel.departamento');
        
        //PERFIL
        Route::get('painel/perfil', 'painel\PerfilController@index')->name('perfil');
        Route::post('painel/perfil/update', 'painel\PerfilController@store')->name('perfil.update');
        Route::put('painel/perfil/update', 'painel\PerfilController@update')->name('perfil.update.dados');
		

        //NOTICIAS
        Route::get('painel/noticias', 'painel\NoticiaController@index')->name('painel.noticias.index');
        Route::get('painel/noticias/create', 'painel\NoticiaController@create')->name('painel.noticias.create');
        Route::post('painel/noticias/create', 'painel\NoticiaController@store')->name('painel.noticias.store');
        Route::get('painel/noticias/{noticia}/edit', 'painel\NoticiaController@edit')->name('painel.noticias.edit');
        Route::get('painel/noticias/{noticia}/show', 'painel\NoticiaController@show')->name('painel.noticias.show');
        Route::put('painel/noticias/{noticia}', 'painel\NoticiaController@update')->name('painel.noticias.updade');
        Route::delete('painel/noticias/{noticia}', 'painel\NoticiaController@destroy')->name('painel.noticias.destroy');


        //REDISTRIBUIR
        Route::get('painel/redistribuir/{noticia}/edit', 'painel\RedistribuirNoticiaController@edit')->name('painel.redistribuir.edit');
        Route::put('painel/redistribuir/{noticia}', 'painel\RedistribuirNoticiaController@update')->name('painel.redistribuir.updade');

        Route::get('painel/redistribuir/listar', 'painel\NoticiaController@noticiaRedirecionamento')->name('painel.redistribuir.listar');


        //BANNERS
        Route::get('painel/banners', 'painel\BannerController@index')->name('painel.banners.index');
        Route::get('painel/banners/create', 'painel\BannerController@create')->name('painel.banners.create');
        Route::post('painel/banners/create', 'painel\BannerController@store')->name('painel.banners.store');
        Route::put('painel/banners/update', 'painel\BannerController@update')->name('painel.banners.updade');

        Route::put('painel/banners/publicar', 'painel\BannerController@publicar')->name('painel.banners.publicar');

        //Route::put('painel/banners/publicar/editar', 'painel\bannerController@editarPublicar')->name('painel.banners.editarPublicar');
       
        Route::post('painel/banners/publicar/editar/{banner}','painel\BannerController@editarPublicar', function (App\Banner $banner) { return $banner;});     

        Route::put('painel/banners/publicar/editar/{banner}','painel\BannerController@updatePublicar', function (App\Banner $banner) { return $banner;})->name('painel.banners.editarPublicar');     

        //Route::put('painel/banners/{banner}/update', 'painel\BannerController@update', function (App\Banner $banner) { return $banner;});
       
        Route::delete('painel/banners/{banner}','painel\BannerController@destroy', function (App\Banner $banner) { return $banner;});


        //TAREFAS
        
        //Route::get('painel/tarefas', 'painel\TarefasController@index')->name('painel.tarefas.index');

        //Rotas de Navegação das TAREFAS
        
        //Listas RECEBIDAS
        Route::get('painel/tarefas/lista/recebidas/todas', 'painel\TarefasController@recebidasTodas')->name('painel.tarefas.recebidasTodas');
        Route::get('painel/tarefas/lista/recebidas/hoje', 'painel\TarefasController@recebidasHoje')->name('painel.tarefas.recebidasHoje');

        Route::get('painel/tarefas/lista/recebidas/estasemana', 'painel\TarefasController@recebidasEstaSemana')->name('painel.tarefas.recebidasEstaSemana');

        Route::get('painel/tarefas/lista/recebidas/estemes', 'painel\TarefasController@recebidasEsteMes')->name('painel.tarefas.recebidasEsteMes');

        Route::get('painel/tarefas/lista/recebidas/filtro/{inicio}/{fim}', 'painel\TarefasController@recebidasfiltro')->name('painel.tarefas.recebidasFiltro');




        //Listas RECEBIDAS DEPARTAMENTO
        Route::get('painel/tarefas/lista/recebidas/departamento/todas', 'painel\TarefasController@recebidasTodasDepartamento')->name('painel.tarefas.recebidasTodasDepartamento');

        Route::get('painel/tarefas/lista/recebidas/departamento/hoje', 'painel\TarefasController@recebidasHojeDepartamento')->name('painel.tarefas.recebidasHojeDepartamento');

        Route::get('painel/tarefas/lista/recebidas/departamento/estasemana', 'painel\TarefasController@recebidasEstaSemanaDepartamento')->name('painel.tarefas.recebidasEstaSemanaDepartamento');

        Route::get('painel/tarefas/lista/recebidas/departamento/estemes', 'painel\TarefasController@recebidasEsteMesDepartamento')->name('painel.tarefas.recebidasEsteMesDepartamento');

        Route::get('painel/tarefas/lista/recebidas/departamento/filtro/{inicio}/{fim}', 'painel\TarefasController@recebidasfiltroDepartamento')->name('painel.tarefas.recebidasFiltroDepartamento');





        
        //Listas ENVIADAS
        Route::get('painel/tarefas/lista/enviadas/todas', 'painel\TarefasController@enviadasTodas')->name('painel.tarefas.enviadasTodas');
        
        Route::get('painel/tarefas/lista/enviadas/hoje', 'painel\TarefasController@enviadasHoje')->name('painel.tarefas.enviadasHoje');

        Route::get('painel/tarefas/lista/enviadas/estasemana', 'painel\TarefasController@enviadasEstaSemana')->name('painel.tarefas.enviadasEstaSemana');

        Route::get('painel/tarefas/lista/enviadas/estemes', 'painel\TarefasController@enviadasEsteMes')->name('painel.tarefas.enviadasEsteMes');

        Route::get('painel/tarefas/lista/enviadas/filtro/{inicio}/{fim}', 'painel\TarefasController@enviadasfiltro')->name('painel.tarefas.enviadsFiltro');



        
        //Listas ENVIADAS DEPARTAMENTO
        Route::get('painel/tarefas/lista/enviadas/departamento/todas', 'painel\TarefasController@enviadasTodasDepartamento')->name('painel.tarefas.enviadasTodasDepartamento');
        
        Route::get('painel/tarefas/lista/enviadas/departamento/hoje', 'painel\TarefasController@enviadasHojeDepartamento')->name('painel.tarefas.enviadasHojeDepartamento');

        Route::get('painel/tarefas/lista/enviadas/departamento/estasemana', 'painel\TarefasController@enviadasEstaSemanaDepartamento')->name('painel.tarefas.enviadasEstaSemanaDepartamento');

        Route::get('painel/tarefas/lista/enviadas/departamento/estemes', 'painel\TarefasController@enviadasEsteMesDepartamento')->name('painel.tarefas.enviadasEsteMesDepartamento');

        Route::get('painel/tarefas/lista/enviadas/departamento/filtro/{inicio}/{fim}', 'painel\TarefasController@enviadasfiltroDepartamento')->name('painel.tarefas.enviadsFiltroDepartamento');




        
        //ANEXO

        Route::get('painel/tarefas/{idTarefa}/anexos', 'painel\TarefasController@anexos')->name('painel.tarefas.anexos');
        Route::post('painel/tarefas/adicionaranexos/', 'painel\TarefasController@adicionarAnexos')->name('painel.tarefas.adicionar.anexos');


        Route::post('painel/tarefas/excluiranexos/', 'painel\TarefasController@excluirAnexos')->name('painel.tarefas.exluir.anexos');

        Route::get('painel/tarefas/excluiranexos/', 'painel\TarefasController@excluirAnexos')->name('painel.tarefas.exluir.anexos');


        //Adicionar TAREFAS
        Route::get('painel/tarefas/create', 'painel\TarefasController@create')->name('painel.tarefas.create');
        Route::post('painel/tarefas/store', 'painel\TarefasController@store')->name('painel.tarefas.store');

        //Editar TAREFAS
        //Route::get('painel/tarefas/edit/{idTarefa}','painel\TarefasController@edit');
        Route::get('painel/tarefas/edit/{idTarefa}/{tipo}','painel\TarefasController@edit');

        Route::post('painel/tarefas/update', 'painel\TarefasController@update')->name('painel.tarefas.update');
    
        //Excluir TAREFAS

        Route::get('painel/tarefas/delete/{idTarefa}','painel\TarefasController@destroy');

        //Restaurar TAREFAS

        Route::get('painel/tarefas/restory/{idTarefa}','painel\TarefasController@recuperar');

        //Conteudo da caixa de seleção de TAREFAS

        Route::get('painel/tarefas/get-usuarios/{idDepartamento}','painel\UserController@getUsuarios');

        Route::get('update-status/{idTarefa}/{status}','painel\TarefasController@uptadeStatus');

        Route::get('update-status-projeto/{idProjeto}/{status}','painel\TarefasController@uptadeStatusProjeto');


            ///{idTarefa}/{status}


        //COMENTÁRIOS TAREFAS
        
        Route::get('painel/tarefas/comentarios/{idTarefa}','painel\TarefasController@comentario');

        Route::post('painel/tarefas/comentarios', 'painel\TarefasController@comentariocreate')->name('painel.tarefas.comentarios.create');

        Route::get('/painel/tarefas/comentarios/delete/{comentario}', 'painel\TarefasController@comentariodestroy')->name('painel.tarefas.comentariodestroy');

        Route::get('painel/tarefas/comentarios/editar/{comentario}', 'painel\TarefasController@comentarioedit')->name('painel.tarefas.comentarioedit');

        Route::put('painel/tarefas/comentarios/update', 'painel\TarefasController@comentarioupdate')->name('painel.tarefas.comentarios.update');


        //KANBAN TAREFAS RECEBIDAS

        Route::get('painel/tarefas/kanban/recebidas/todas', 'painel\TarefasController@kanbanRecebidasTodas')->name('painel.tarefas.kanban.recebidas.todas');


        Route::get('painel/tarefas/kanban/recebidas/hoje', 'painel\TarefasController@kanbanRecebidasHoje')->name('painel.tarefas.kanban.recebidasHoje');

        Route::get('painel/tarefas/kanban/recebidas/estasemana', 'painel\TarefasController@kanbanRecebidasEstaSemana')->name('painel.tarefas.kanban.recebidasEstaSemana');

        Route::get('painel/tarefas/kanban/recebidas/estemes', 'painel\TarefasController@kanbanRecebidasEsteMes')->name('painel.tarefas.kanban.recebidasEsteMes');

        Route::get('painel/tarefas/kanban/recebidas/filtro/{inicio}/{fim}', 'painel\TarefasController@recebidasfiltrokanban')->name('painel.tarefas.recebidasFiltroKanban');





        //KANBAN TAREFAS RECEBIDAS DEPARTAMENTO

        Route::get('painel/tarefas/kanban/recebidas/departamento/todas', 'painel\TarefasController@kanbanRecebidasTodasDepartamento')->name('painel.tarefas.kanban.recebidas.todas.Departamento');


        Route::get('painel/tarefas/kanban/recebidas/departamento/hoje', 'painel\TarefasController@kanbanRecebidasHojeDepartamento')->name('painel.tarefas.kanban.recebidasHoje.Departamento');

        Route::get('painel/tarefas/kanban/recebidas/departamento/estasemana', 'painel\TarefasController@kanbanRecebidasEstaSemanaDepartamento')->name('painel.tarefas.kanban.recebidasEstaSemana.Departamento');

        Route::get('painel/tarefas/kanban/recebidas/departamento/estemes', 'painel\TarefasController@kanbanRecebidasEsteMesDepartamento')->name('painel.tarefas.kanban.recebidasEsteMes.Departamento');

        Route::get('painel/tarefas/kanban/recebidas/departamento/filtro/{inicio}/{fim}', 'painel\TarefasController@recebidasfiltrokanbanDepartamento')->name('painel.tarefas.recebidasFiltroKanban.Departamento');






        //KANBAN TAREFAS ENVIADAS

        Route::get('painel/tarefas/kanban/enviadas/todas', 'painel\TarefasController@kanbanEnviadasTodas')->name('painel.tarefas.kanban.enviadas.todas');

        Route::get('painel/tarefas/kanban/enviadas/hoje', 'painel\TarefasController@kanbanEnviadasHoje')->name('painel.tarefas.kanban.enviadasHoje');

        Route::get('painel/tarefas/kanban/enviadas/estasemana', 'painel\TarefasController@kanbanEnviadasEstaSemana')->name('painel.tarefas.kanban.enviadasEstaSemana');

        Route::get('painel/tarefas/kanban/enviadas/estemes', 'painel\TarefasController@kanbanEnviadasEsteMes')->name('painel.tarefas.kanban.enviadasEsteMes');


        Route::get('painel/tarefas/kanban/enviadas/filtro/{inicio}/{fim}', 'painel\TarefasController@enviadasfiltrokanban')->name('painel.tarefas.enviadasFiltroKanban');




        //KANBAN TAREFAS ENVIADAS DEPARTAMENTO

        Route::get('painel/tarefas/kanban/enviadas/departamento/todas', 'painel\TarefasController@kanbanEnviadasTodasDepartamento')->name('painel.tarefas.kanban.enviadas.todas.Departamento');

        Route::get('painel/tarefas/kanban/enviadas/departamento/hoje', 'painel\TarefasController@kanbanEnviadasHojeDepartamento')->name('painel.tarefas.kanban.enviadasHoje.Departamento');

        Route::get('painel/tarefas/kanban/enviadas/departamento/estasemana', 'painel\TarefasController@kanbanEnviadasEstaSemanaDepartamento')->name('painel.tarefas.kanban.enviadasEstaSemana.Departamento');

        Route::get('painel/tarefas/kanban/enviadas/departamento/estemes', 'painel\TarefasController@kanbanEnviadasEsteMesDepartamento')->name('painel.tarefas.kanban.enviadasEsteMes.Departamento');


        Route::get('painel/tarefas/kanban/enviadas/departamento/filtro/{inicio}/{fim}', 'painel\TarefasController@enviadasfiltrokanbanDepartamento')->name('painel.tarefas.enviadasFiltroKanban.Departamento');




        
        //HISTORICO TAREFA

        Route::get('/painel/tarefas/historico/{id}', 'painel\TarefasController@historico')->name('painel.tarefas.historicotarefas');

        //TAREFAS EXCLUIDAS
        Route::get('/painel/tarefas/excluidas', 'painel\TarefasController@exibirTarefasApagadasTodas')->name('painel.tarefas.exibirTarefasApagadasTodas');

        Route::get('painel/tarefas/excluidas/filtro/{inicio}/{fim}', 'painel\TarefasController@exibirTarefasApagadasFiltro')->name('painel.tarefas.apagadasFiltro');


        Route::get('painel/tarefas/excluidas/hoje', 'painel\TarefasController@exibirTarefasApagadasHoje')->name('painel.tarefas.excluidasHoje');


        //TAREFAS ENCAMINHAR

        Route::get('painel/tarefas/encaminhar/{tarefa}', 'painel\TarefasController@encaminharTarefaRecebida')->name('painel.tarefas.encaminhar');

        Route::post('painel/tarefas/encaminhar/update', 'painel\TarefasController@encaminharUpdate')->name('painel.tarefas.encaminharupdate');


        //TAREFAS CALENDARIO
        Route::get('painel/tarefas/calendario', 'painel\TarefasController@calendario')->name('painel.tarefas.calendario');

        Route::get('painel/tarefas/departamento/calendario', 'painel\TarefasController@calendarioDepartamento')->name('painel.tarefas.calendarioDepartamento');

        
        Route::get('painel/tarefas/calendariodados', 'painel\TarefasController@calendarioDados')->name('painel.tarefas.calendarioDados');

        Route::get('painel/tarefas/calendariodados/departamento', 'painel\TarefasController@calendarioDadosDepartamento')->name('painel.tarefas.calendarioDadosDepartamento');


        Route::get('painel/tarefas/calendariodadostarefasenviadas', 'painel\TarefasController@calendarioDadosTarefasEnviadas')->name('painel.tarefas.calendarioDados2');

        //LINKS

         Route::get('painel/links', 'painel\LinkController@index')->name('painel.links.index');
         Route::get('painel/links/create', 'painel\LinkController@create')->name('painel.links.create');
        Route::post('painel/links/create', 'painel\LinkController@store')->name('painel.links.store');
        Route::get('painel/links/{link}/edit', 'painel\LinkController@edit')->name('painel.links.edit');
        Route::delete('painel/links/{link}', 'painel\LinkController@destroy')->name('painel.links.destroy');


        //NOTIFICAÇÃO
        Route::get('painel/notificar', 'painel\NotificarController@index')->name('painel.notificar.index');
        Route::get('painel/notificar/create', 'painel\NotificarController@create')->name('painel.notificar.create'); 

        Route::post('painel/notificar/create', 'painel\NotificarController@store')->name('painel.notificar.store');

       Route::get('painel/notificar/create/{departamento}', 'painel\NotificarController@storeNCM')->name('painel.notificar.storeNCM');
       
       Route::get('painel/notificar/create/{departamento}/{projecttype}', 'painel\NotificarController@formularioprojecttype')->name('painel.notificar.formularioprojecttype');

       Route::post('painel/notificar/gravarformularioprojecttype', 'painel\NotificarController@gravarformularioprojecttype')->name('painel.notificar.gravarformularioprojecttype');
    
        Route::get('painel/notificar/tarefas/{projeto}', 'painel\NotificarController@tarefasdoprojeto')->name('painel.notificar.tarefasdoprojeto');

        Route::get('painel/notificar/tarefascomboanexo/{projeto}', 'painel\NotificarController@tarefascomboanexo')->name('painel.notificar.tarefascomboanexo');

        Route::get('painel/notificar/tarefascombocomentario/{projeto}', 'painel\NotificarController@tarefascombocomentario')->name('painel.notificar.tarefascombocomentario');

        Route::get('painel/notificar/aprovadores', 'painel\NotificarController@aprovadores')->name('painel.notificar.aprovadores');
        

    });




