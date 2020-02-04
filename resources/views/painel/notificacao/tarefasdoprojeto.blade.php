@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Tarefas
        <small> - Listagem de Tarefas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li class="active">Tarefas</li>
      </ol>
    </section>
@stop

@section('content')

<div class="box box-info">
            <div class="box-header">
                                
            <h4 class="pull-left">{{$projetoenviado->nome}}</h4> 

            <button type="button" class="btn btn-aviso btn-modify pull-right" onclick="goBack()"><i class="glyphicon glyphicon-arrow-up"></i> Voltar</button>
              
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

                  
                  <th style='width: 10%;'>Status</th>
                  <th style='width: 40%;'>Nome</th>
                  <th style='width: 10%;'>Prioridade</th>
                  <th style='width: 10%;'>Entrega</th>
                  <th style='width: 30%;'>Ações</th>
            </tr>
            </thead>
            <tbody>
    
             @foreach($tarefasdoprojeto as $tarefadoprojeto)
                  <tr>
                    
                    <td>{{$tarefadoprojeto->status}}</td>
                    <td>{{ $tarefadoprojeto->nome}}</td>
                    <td>{{ $tarefadoprojeto->prioridade}}</td>
                    @php
                        $database = strtotime($tarefadoprojeto->entrega); 
                        $criado = date ('d/m/Y H:i:s', $database); 
                    @endphp
                    <td>{{ $criado}}</td> 
                   <td>

                    <div class="dropdown">
                      <button id="dLabel" class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-option-vertical" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Status"></span>
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dLabel">
                      @if($tarefadoprojeto->status == 'Devolvida')
                          <li><a href="/update-status/{{$tarefadoprojeto->id}}/A Fazer">Reapresentar</a></li>
                          
                          <li><a href="/update-status/{{$tarefadoprojeto->id}}/Arquivado">Arquivar</a></li>
                      @endif
                      @if($tarefadoprojeto->status == 'Para Aprovação')
                          <li><a href="/update-status/{{$tarefadoprojeto->id}}/A Fazer">A Fazer</a></li>
                          <li><a href="/update-status/{{$tarefadoprojeto->id}}/Concluído">Concluir</a></li>
                          <li><a href="/update-status/{{$tarefadoprojeto->id}}/Arquivado">Arquivar</a></li>
                      @endif
                      @if($tarefadoprojeto->status == 'Concluído')
                          <li><a href="/update-status/{{$tarefadoprojeto->id}}/Arquivado">Arquivar</a></li>
                      @endif
                          <li><a href="/painel/tarefas/historico/{{$tarefadoprojeto->id}}"><span class="glyphicon glyphicon-list-alt" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Histórico da Tarefa"></span>Histórico da Tarefa</a></li>

                      </ul>














                       
 @php

                      $anexoscount = DB::table('arquivo__tarefas')
                        ->where('tarefas_id', '=', $tarefadoprojeto->id)
                        ->count();
                        
 
                      $comentarioscount = DB::table('comentarios')
                      ->where('tarefas_id', '=', $tarefadoprojeto->id)
                      ->whereNull('deleted_at')
                      ->count();
                      

  @endphp
                      
                      <a class="btn btn-default btn-sm" href="/painel/tarefas/{{ $tarefadoprojeto->id}}/anexos"><span class="glyphicon glyphicon-paperclip" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Adicionar Anexos"><b style="padding-left: 2px;">{{$anexoscount}}</b></span></a>

                      <a class="btn btn-default btn-sm" href="/painel/tarefas/comentarios/{{ $tarefadoprojeto->id}}"><span class="glyphicon glyphicon-comment" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Comentários"><b style="padding-left: 2px;">{{$comentarioscount}}</b></span></a>





                    </td>   
                  </tr>
                @endforeach
            </tbody>
            </table>
        </div>
            </div>
            <!-- /.box-body -->
          </div>

<script type="text/javascript">

        //Função Javascript que retorna a página anterior e atualiza. 
        function goBack() {
            window.location.replace(document.referrer);
        }
</script>
@stop