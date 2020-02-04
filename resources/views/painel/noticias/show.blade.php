@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Notícias
        <small> - Visualizar Notícias</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li><a href={{ route('painel.noticias.index') }}><i class="fa fa-newspaper-o"></i> Notícia</a></li>
        <li class="active">Visualizar Notícias</li>
      </ol>
    </section>
@stop

@section('content')

@if(session()->has('errors'))

<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon fa fa-ban"></i> Atenção!</h4>
  <p>{{session('errors')}}</p>
</div>

@elseif(session()->has('sucess'))

<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon fa fa-check"></i> Atenção!</h4>
  <p>{{session('sucess')}}</p>
</div>

@endif

<h2>{{$noticia->titulo}}</h2><br>
@if($noticia->arquivo_id)
<img src="{!!$noticia->arquivo->url!!}" class="img-responsive" style="margin-bottom: 2px">
@endif
<div class="text-justify">
{!!$noticia->noticia!!}
</div>
                



@stop