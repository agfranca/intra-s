@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Notícias
        <small> - Cadastrar Notícias</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li><a href={{ route('painel.noticias.index') }}><i class="fa fa-newspaper-o"></i> Notícia</a></li>
        <li class="active">Cadastrar Notícias</li>
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

{{-- Scripts e CSS --}}
 
<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
 
{{-- Scripts e CSS --}}

{{-- 

{!! Form::open(['route' => 'painel.noticias.store','method' => 'POST','class'=>'form-horizontal']) !!}

 {!! Form::open(['action' => 'painel\NoticiaController@store','method' => 'POST','class'=>'form-horizontal dropzone','enctype'=>"multipart/form-data"]) !!}
 
 --}}


{{-- 
<form action="{{route('painel.noticias.store')}}" method="post" enctype="multipart/form-data">
    <input type="file" name="image">
    ...
 --}}
{{-- </form>

<form action="{{route('painel.noticias.store')}}" class="dropzone" id="dropzoneFrom" >
            </form>
 --}}
         {{-- 
            <div align="center">
                <button type="button" class="btn btn-info" id="submit-all"> Upload</button>
            </div>

class="dropzone" id="my-dropzone"

 --}}

<form method="post" action="{{route('painel.noticias.store')}}"
                  enctype="multipart/form-data" >
                {{ csrf_field() }}

<div class="col-md-8">
  <div class="box box-info">
              <div class="box-body">


                  {!! Form::label('titulo', 'Título', array('class' => 'control-label' )) !!}
                <div class="form-group">
                  <div class="col-sm-12">
                    {!! Form::text('titulo', '', ['placeholder' => 'Cadastre o Tttulo da Matéria','class' => 'form-control', 'required']) !!}
                  </div>
                </div>

                                
                {!! Form::label('noticia', 'Noticia', array('class' => 'control-label' )) !!}
                <div class="form-group">
                  <div class="col-sm-12">
                    {!! Form::textarea('noticia', '', ['placeholder' => 'Cadastre sua Notícia ','class' => 'form-control','required']) !!}
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
  </div>
</div>

<!-- INcluir o JStree aqui -->
@include('painel.noticias.partes.departamentos-empresas-imagem-destaque')
@include('painel.noticias.partes.departamentos-empresas')
{!! Form::close() !!}


{{-- Editor de texto nos campo Text Área --}}
<script src="{{asset('/ckeditor/ckeditor.js')}}"></script>

<script>
    CKEDITOR.replace( 'noticia' );
</script>

@stop