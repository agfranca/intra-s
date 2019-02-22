@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Empresas
        <small> - Listagem de Empresas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li class="active">Empresas</li>
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
                                    
              <a href="{{ route('painel.empresas.create') }}" class="btn btn-primary pull-right" role="button"><i class="fa fa-plus"></i> Adicionar Empresa</a>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="noticias" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Empresa</th>
                  <th>Subordinada a</th>
                  <!-- <th>Departamento</th> -->
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                
                 @foreach($todasempresas as $empresa)
                  <tr>
                    <td>{{ $empresa->nome}}</td>
                    <td>{{$empresa->empresapai['nome']}}</td>
                                       
                    <td>
                     <form method="GET" action="{{route('painel.empresas.edit', $empresa)}}" style="display: inline">
                      <button class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Editar"> <i class="fa fa-pencil"></i> </button>
                      </form>

                      <form method="POST" action="{{route('painel.empresas.destroy', $empresa)}}" style="display: inline">
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