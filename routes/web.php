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

        


    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index')->name('home');

    //Route::group(['prefix'=> 'painel'],function(){
		
		Route::get('painel', 'painel\PainelController@index')->name('painel');
        
        Route::get('painel/departamento', 'DepartamentoController@index')->name('painel.departamento');
        
        //PERFIL
        Route::get('painel/perfil', 'painel\PerfilController@index')->name('perfil');
        Route::post('painel/perfil/update', 'painel\PerfilController@store')->name('perfil.update');


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



    Route::group (['middleware'=>['role:Admin|User', 'auth']], function () { 
        
		
		

        //Noticias
        Route::get('painel/noticias', 'painel\NoticiaController@index')->name('painel.noticias.index');
        Route::get('painel/noticias/create', 'painel\NoticiaController@create')->name('painel.noticias.create');
        Route::post('painel/noticias/create', 'painel\NoticiaController@store')->name('painel.noticias.store');
        Route::get('painel/noticias/{noticia}/edit', 'painel\NoticiaController@edit')->name('painel.noticias.edit');
        Route::put('painel/noticias/{noticia}', 'painel\NoticiaController@update')->name('painel.noticias.updade');
        Route::delete('painel/noticias/{noticia}', 'painel\NoticiaController@destroy')->name('painel.noticias.destroy');

        //Banners
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



        //Redistribuir
        Route::get('painel/redistribuir/{noticia}/edit', 'painel\RedistribuirNoticiaController@edit')->name('painel.redistribuir.edit');
        Route::put('painel/redistribuir/{noticia}', 'painel\RedistribuirNoticiaController@update')->name('painel.redistribuir.updade');

        Route::get('painel/redistribuir/listar', 'painel\NoticiaController@noticiaRedirecionamento')->name('painel.redistribuir.listar');

    });




