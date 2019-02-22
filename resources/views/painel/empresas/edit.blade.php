@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Empresa
        <small> - Editar Empresa</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li><a href={{ route('painel.empresas.index') }}><i class="fa fa-briefcase"></i> Empresa</a></li>
        <li class="active">Editar Empresa</li>
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

{!! Form::open(['route' =>['painel.empresas.updade',$empresa],'method' => 'PUT','class'=>'form-horizontal']) !!}
<div class="col-md-8">
  <div class="box box-info">
              <div class="box-body">
                
                {!! Form::label('nome', 'Empresa', array('class' => 'control-label' )) !!}
                <div class="form-group">
                  <div class="col-sm-12">
                    {!! Form::text('nome', $empresa->nome, ['placeholder' => 'Editar a Empresa','class' => 'form-control', 'required']) !!}
                  </div>
                </div>
               
              </div>
              
            
  </div>
</div>

<!-- INcluir o JStree aqui -->
@include('painel.empresas.partes.empresas-editar')

{!! Form::close() !!}
@stop