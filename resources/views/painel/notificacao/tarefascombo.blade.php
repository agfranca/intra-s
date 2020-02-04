@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Notificações
        <small> - Listagem de Notificações</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li class="active">Notificações</li>
      </ol>
    </section>
 
@stop

@section('content')
@include('painel.partes.mensagens-usuarios')
<div class="box box-info">
  <div class="box-header">
      <h3>Escolha uma das Tarefas:</h3>
 
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="container-fluid">
      @foreach($tarefas as $tarefa)
      <a href="/painel/tarefas/comentarios/{{ $tarefa->id}}">{{$tarefa->nome}}</a><br>
      @endforeach


                      


    </div>
  </div>
            <!-- /.box-body -->
</div>
@stop