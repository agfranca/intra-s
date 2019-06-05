@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Usuários
        <small> - Cadastrar Usuários</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li><a href={{ route('painel.usuarios.index') }}><i class="fa fa-users"></i> Usuário</a></li>
        <li class="active">Cadastrar Usuário</li>
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

{!! Form::open(['route' => 'painel.usuarios.store','method' => 'POST','class'=>'form-horizontal']) !!}
<div class="col-md-8">
  <div class="box box-info">
              <div class="box-body">
                
                {!! Form::label('nome', 'Usuário', array('class' => 'control-label')) !!}
                <div class="form-group">
                  <div class="col-sm-12">
                    {!! Form::text('nome', '', ['placeholder' => 'Cadastre o Usuário','class' => 'form-control', 'required']) !!}
                  </div>
                </div>
                
                {!! Form::label('email', 'E-Mail', array('class' => 'control-label' )) !!}
                <div class="form-group">
                  <div class="col-sm-12">
                    {!! Form::email('email', '', ['placeholder' => 'Cadastre seu e-mail','class' => 'form-control','required']) !!}
                  </div>
                </div>


             {!! Form::label('password', 'Senha', array('class' => 'control-label' )) !!}
                <div class="form-group">
                  <div class="col-sm-12">
                    {!! Form::password('password', ['placeholder' => 'Cadastre sua senha','class' => 'form-control','required']) !!}
                  </div>
                </div>

            </div>
            <!-- /.box-body -->
  </div>
</div>

<!-- INcluir o JStree aqui -->
@include('painel.usuarios.partes.departamentos-empresas')

{!! Form::close() !!}

@stop