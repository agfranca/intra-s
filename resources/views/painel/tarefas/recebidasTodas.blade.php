@extends('painel.layout')
@section('header')
<section class="content-header">
      <h1>
        Tarefas
        <small> - Tarefas do Usuário</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li class="active">Tarefas</li>
      </ol>
</section>
@stop
@section('content')
  @include('painel.partes.mensagens-usuarios')
  <div class="box box-info">
    @include('painel.tarefas.partes.menuHorizontal')
    <!-- /.box-header -->
    <div class="box-body">
      @include('painel.tarefas.partes.resumo')
      @include('painel.tarefas.partes.lista')
    </div>
    {{-- MODAL Adicionar Tarefas --}}
    @include('painel.tarefas.partes.modalAdicionarTarefa')

    {{-- @include('painel.tarefas.partes.modalEditarTarefa') --}}
    {{-- @include('painel.tarefas.partes.modalAdicionarAnexo') --}}    
    <!-- /.box-body -->
  </div>
@stop