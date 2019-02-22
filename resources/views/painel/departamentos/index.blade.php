@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Departamentos
        <small> - Listagem de Departamentos</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li class="active">Departamentos</li>
      </ol>
    </section>
@stop

@section('content')

<div class="box box-info">
            <div class="box-header">
                                
              <a href="{{ route('painel.departamentos.create') }}" class="btn btn-primary pull-right" role="button"><i class="fa fa-plus"></i> Adicionar Departamento</a>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="noticias" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Departamento</th>
                  <th>Empresa</th>
                  <!-- <th>Departamento</th> -->
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody>

                
                 @foreach($departamentos as $departamento)
                  <tr>
                    <td>{{ $departamento -> nome}}</td>
                    {{-- <td>{{ $usuario -> email}}</td>
                    <td>{{ $usuario->departamento->nome}}</td> --}}
                    <td>{{ $departamento->empresa->nome}}</td> 
                    {{-- <td>{{ $usuario -> departamento_id}}</td> --}}
                    
                    <td>
                      
                      <form method="GET" action="{{route('painel.departamentos.edit', $departamento)}}" style="display: inline">
                      <button class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Editar"> <i class="fa fa-pencil"></i> </button>
                      </form>

                      <form method="POST" action="{{route('painel.departamentos.destroy', $departamento)}}" style="display: inline">
                       {{csrf_field()}} {{method_field('DELETE')}} 
                      <button class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Excluir"> <i class="fa fa-times"></i> </button>
                      </form>
                    
                    </td> 
                    
                  </tr> 
                @endforeach


                </tbody>
               </table>
            </div>
            <!-- /.box-body -->
          </div>


@stop