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


{!! Form::open(['route' => ['painel.noticias.updade',$noticia],'method' => 'PUT','class'=>'form-horizontal', 'enctype'=>'multipart/form-data']) !!}

<div class="col-md-8">
  <div class="box box-info">
              <div class="box-body">
                
                {!! Form::label('titulo', 'Título', array('class' => 'control-label' )) !!}
                <div class="form-group">
                  <div class="col-sm-12">
                    {!! Form::text('titulo', $noticia->titulo, ['placeholder' => 'Cadastre o Tttulo da Matéria','class' => 'form-control', 'required']) !!}
                  </div>
                </div>
                
                {!! Form::label('noticia', 'Noticia', array('class' => 'control-label' )) !!}
                <div class="form-group">
                  <div class="col-sm-12">
                    {!! Form::textarea('noticia', $noticia->noticia, ['placeholder' => 'Cadastre sua Notícia ','class' => 'form-control','required']) !!}
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
  </div>
</div>

<!-- Incluir o JStree aqui -->
@include('painel.noticias.partes.departamentos-empresas-imagem-destaque-editar')
@include('painel.noticias.partes.departamentos-empresas-editar')

{!! Form::close() !!}


{{-- Editor de texto nos campo Text Área --}}
{{-- <script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script> --}}
<script src="{{asset('/ckeditor/ckeditor.js')}}"></script>

<script>
    CKEDITOR.replace( 'noticia' );
</script>

                



@stop