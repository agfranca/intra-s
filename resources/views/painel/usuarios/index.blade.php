@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Usuários
        <small> - Listagem de Usuários</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li class="active">Usuários</li>
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

<div class="box box-info">
            <div class="box-header">
                           
              <a href="{{ route('painel.usuarios.create') }}" class="btn btn-primary pull-right" role="button"><i class="fa fa-plus"></i> Adicionar Usuário</a>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="noticias" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Usuário</th>
                  <th>E-mail</th>
                  <th>Departamento</th>
                  <th>Empresa</th>
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody>

                
                @foreach($todosusuarios as $usuario)
                  <tr>
                    <td>{{ $usuario -> name}}</td>
                    <td>{{ $usuario -> email}}</td>
                    <td>{{ $usuario->departamento->nome}}</td>
                    <td>{{ $usuario->departamento->empresa->nome}}</td>
                    {{-- <td>{{ $usuario -> departamento_id}}</td> --}}
                    
                    <td>
                       <form method="GET" action="{{route('painel.usuarios.edit', $usuario)}}" style="display: inline">
                      <button class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Editar"> <i class="fa fa-pencil"></i> </button>
                      </form>

                      <form method="POST" action="{{route('painel.usuarios.destroy', $usuario)}}" style="display: inline">
                       {{csrf_field()}} {{method_field('DELETE')}} 
                      <button class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Excluir"> <i class="fa fa-times"></i> </button>
                      </form>

                      @role('Admin')
                      @if($usuario->hasRole('Admin'))

                      <form method="GET" action="{{route('painel.usuarios.desabilitaradm', $usuario)}}" style="display: inline">
                      <button class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Desabilitar como Administrador Empresa"> <i class="fa fa-black-tie"></i> </button>
                      </form>
                      @else
                      
                      <form method="GET" action="{{route('painel.usuarios.habilitaradm', $usuario)}}" style="display: inline">
                      <button class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Habilitar como Administrador Empresa"> <i class="fa fa-black-tie"></i> </button>
                      </form>
                      @endif

                      @if($usuario->hasRole('AdminSetor'))                      

                      <form method="GET" action="{{route('painel.usuarios.desabilitaradm', $usuario)}}" style="display: inline">
                      <button class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Habilitar como Administrador do Setor"> <i class="fa fa-sitemap"></i> </button>
                      </form>
                      @else
                      <form method="GET" action="{{route('painel.usuarios.habilitaradmsetor', $usuario)}}" style="display: inline">
                      <button class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Habilitar como Administrador do Setor"> <i class="fa fa-sitemap"></i> </button>
                      </form>
                      @endif
                      @endrole

                      @role('AdminSetor')
                      @if($usuario->hasRole('AdminSetor'))                      
                      <form method="GET" action="{{route('painel.usuarios.desabilitaradm', $usuario)}}" style="display: inline">
                      <button class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Habilitar como Administrador do Setor"> <i class="fa fa-sitemap"></i> </button>
                      </form>
                      @else
                      <form method="GET" action="{{route('painel.usuarios.habilitaradmsetor', $usuario)}}" style="display: inline">
                      <button class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Habilitar como Administrador do Setor"> <i class="fa fa-sitemap"></i> </button>
                      </form>
                      @endif
                      @endrole
                    </td> 
                    
                  </tr> 
                @endforeach

                </tbody>
               </table>
            </div>
            <!-- /.box-body -->
          </div>





@stop