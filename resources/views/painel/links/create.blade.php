@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Links
        <small> - Cadastrar Links</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li><a href={{ route('painel.links.index') }}><i class="fa fa-newspaper-o"></i> Link</a></li>
        <li class="active">Cadastrar Links</li>
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

<form method="post" action="{{route('painel.links.store')}}"
                  enctype="multipart/form-data" >
                {{ csrf_field() }}

<div class="col-md-8">
  <div class="box box-info">
              <div class="box-body">


                  {!! Form::label('titulo', 'Título', array('class' => 'control-label' )) !!}
                <div class="form-group">
                  <div class="col-sm-12">
                    {!! Form::text('titulo', '', ['placeholder' => 'Cadastre o Título do Link','class' => 'form-control', 'required']) !!}
                  </div>
                </div>

                                
                {!! Form::label('link', 'Link', array('class' => 'control-label' )) !!}
                <div class="form-group">
                  <div class="col-sm-12">
                    {!! Form::text('link', '', ['placeholder' => 'Cadastre seu Link ','class' => 'form-control','required']) !!}
                  </div>
                </div>

                                
                <label class="control-label" for="formInput146">Grupo</label>                                   
                <div class="form-group">
                  <div class="col-sm-12">

                    <select id="formInput146" class="form-control" name="grupo"> 
                      <option></option>
                      @foreach ($linksGrupoMenu as $link)
                        <option value={{ $link->id }}>{{ $link->nome }}</option>
                      @endforeach                                                 
                    </select>

  
                    
                  </div>
                </div>

                
              </div>
              <!-- /.box-body -->
  </div>
</div>

<!-- INcluir o JStree aqui -->
@include('painel.links.partes.departamentos-empresas')
{!! Form::close() !!}

@stop