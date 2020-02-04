@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Notificação
        <small> - Cadastrar Notificação</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li><a href={{ route('painel.notificar.index') }}><i class="fa fa-id-card-o"></i> Notificação</a></li>
        <li class="active">Cadastrar Notificação</li>
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

{!! Form::open(['route' => 'painel.notificar.store','method' => 'POST','class'=>'form-horizontal']) !!}
<div class="col-md-8">
  <div class="box box-info">
              <div class="box-body">
                
                {!! Form::label('nome', 'Notificação', array('class' => 'control-label' )) !!}
                <div class="form-group">
                  <div class="col-sm-12">
                    {!! Form::text('nome', '', ['placeholder' => 'Cadastre a Notificação','class' => 'form-control', 'required']) !!}
                    {!! $projecttypes !!}
                  </div>
                </div>
               
              </div>           
  </div>
</div>

<!-- INcluir o JStree aqui -->

@include('painel.notificacao.partes.empresas')

{!! Form::close() !!}


@stop