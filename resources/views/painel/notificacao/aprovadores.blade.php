@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Notificações
        <small> - Listagem de Notificações Aguardando Aprovação</small>
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
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
<div style="padding-top: 5px;" class="container-fluid">
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

            <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
            
                
    <script type="text/javascript">
        $(document).ready( function () {
        $('#table_id').DataTable({
          
           "language": {
          "sEmptyTable": "Nenhum registro encontrado",
          "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "_MENU_ resultados por página",
          "sLoadingRecords": "Carregando...",
          "sProcessing": "Processando...",
          "sZeroRecords": "Nenhum registro encontrado",
          "sSearch": "Pesquisar",
          "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
            },
          "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
            }
          }
        }); } );


  </script>

            <table style="font-size: 10pt" id="table_id" class="display compact">
            <thead>
            <tr>

                  <th style='width: 2%;'>Id</th>
                  <th style='width: 28%;'>Notificação</th>
                  <th style='width: 40%;'>Descrição</th>
                  <th style='width: 8%;'>Tipo</th>
                  <th style='width: 22%;'>Ações</th>
            </tr>
            </thead>
            <tbody>
    
             @foreach($notificacoes as $notificacao)
                  <tr>
                    <td>{{ $notificacao -> id}}</td>
                    <td>{{ $notificacao -> nome}}</td>
                    <td>{!! $notificacao->descricao!!}</td>
                    <td>{{ $notificacao->projecttype->nome}}</td>
                    
                    <td>
                      
                      <a class="btn btn-xs btn-success"  title="Aprovar" href="/update-status-projeto/{{$notificacao->project_id}}/A Fazer"><i class="glyphicon glyphicon-ok"></i></a>

                      <a class="btn btn-xs btn-danger" title="Devolver" href="/update-status-projeto/{{$notificacao->project_id}}/Devolvida"><i class="fa fa-reply"></i></a>
                     

                      @php
                      $tarefas = DB::table('tarefas')
                                ->where('project_id', '=', $notificacao->project_id)
                                ->get();
                      $anexoscount =0;
                      $comentarioscount =0;
                      foreach ($tarefas as $tarefa) {

                      $anexoscountar = DB::table('arquivo__tarefas')
                        ->where('tarefas_id', '=', $tarefa->id)
                        ->count();
                      $anexoscount = $anexoscount+$anexoscountar;  
 
                      $comentarioscountar = DB::table('comentarios')
                      ->where('tarefas_id', '=', $tarefa->id)
                      ->whereNull('deleted_at')
                      ->count();
                      $comentarioscount = $comentarioscount+$comentarioscountar;
                      }

                    @endphp

                     @if ($notificacao->projecttype->combo ==0)
                      
                      <a class="btn btn-default btn-sm" href="/painel/tarefas/{{ $tarefa->id}}/anexos"><span class="glyphicon glyphicon-paperclip" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Adicionar Anexos"><b style="padding-left: 2px;">{{$anexoscount}}</b></span></a>

                      <a class="btn btn-default btn-sm" href="/painel/tarefas/comentarios/{{ $tarefa->id}}"><span class="glyphicon glyphicon-comment" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Comentários"><b style="padding-left: 2px;">{{$comentarioscount}}</b></span></a>
                      
                    @else
                      
                        <a class="btn btn-default btn-sm" href="/painel/notificar/tarefas/{{$notificacao->project_id}}"><span class="glyphicon glyphicon-paperclip" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Adicionar Anexos"><b style="padding-left: 2px;">{{$anexoscount}}</b></span></a>

                        <a class="btn btn-default btn-sm" href="/painel/notificar/tarefas/{{$notificacao->project_id}}"><span class="glyphicon glyphicon-comment" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Comentários"><b style="padding-left: 2px;">{{$comentarioscount}}</b></span></a>
                    @endif


                    </td>   
                  </tr>
                @endforeach
            </tbody>
            </table>
        </div>
            </div>
            <!-- /.box-body -->
          </div>
@stop