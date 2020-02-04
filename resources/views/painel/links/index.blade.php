@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Links
        <small> - Listagem de Links</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li class="active">Links</li>
      </ol>
    </section>
@stop

@section('content')

{{-- Inicio Mensagem de erro Padrão Laravel --}}

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

{{-- Fim Mensagem de erro Padrão Laravel --}}

<div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Links do Usuário</h3>
                       
              <a href="{{ route('painel.links.create') }}" class="btn btn-primary pull-right" role="button"><i class="fa fa-plus"></i> Adicionar Links</a>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="noticias" class="table table-striped">
                <thead> 
                <tr>
                  <th scope="col">Nome</th>
                  <th scope="col">Link</th>
                  <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($links as $link)
                 <tr>
                 <td scope="row">
                  {!!$link->links->nome!!}
                 </td>
                 <td scope="row">
                  {!!$link->links->link!!}
                 </td>
                 <td scope="row">
                      <button class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Editar"> <i class="fa fa-pencil"></i> {!!$link->links->id!!}</button>
                                         

                      <button class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Excluir"> <i class="fa fa-times"></i> {!!$link->id!!}</button>
                    

                 </td> 
               </tr>
                 @endforeach
                </tbody>
               </table>
            </div>
            <!-- /.box-body -->
          </div>


@stop