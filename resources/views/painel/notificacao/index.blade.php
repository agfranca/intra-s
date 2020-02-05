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
                                
              <a href="/painel/notificar/create/5" class="btn btn-primary pull-right" role="button"><i class="fa fa-plus"></i> Adicionar Notificação</a>
              
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

                  
                  <th style='width: 1%;'>Status</th>
                  <th style='width: 28%;'>Notificação</th>
                  <th style='width: 10%;'>Tipo</th>
                  <th style='width: 10%;'>Departamento</th>
                  <th style='width: 10%;'>Empresa</th>
                  <th style='width: 40%;'>Ações</th>
            </tr>
            </thead>
            <tbody>
    
             @foreach($notificacoes as $notificacao)
                  <tr>

                    <td>

                      @php
                       $status = $notificacao->tarefa->where('status','<>','Concluído');
                       //$status->all();
                       $total = $status->count();

                       $contador=0;
                       $afazer =0;
                       $paraaprovacao =0;
                       $comaprovador =0;
                       $emandamento=0;
                       $concluido=0;
                       $devolvida=0;
                       $arquivado=0;
                       $conteudobutao="";
                       $cor="";
                      //dd($status->count());
                      
                      foreach($status as $statu){
                      
                       $statustipo = $statu->status;
                        //dd($statustipo);
                       switch ($statustipo) {
                         case "A Fazer":
                          $afazer=$afazer+1;
                           break;
                           case 'Para Aprovação':
                           $paraaprovacao=$paraaprovacao+1;
                           break;
                           case 'Com Aprovador':
                           $comaprovador=$comaprovador+1;
                           break;
                           case 'Em Andamento':
                           $emandamento = $emandamento+1;
                           break;
                           case 'Concluído':
                           $concluido=$concluido+1;
                           break;
                           case 'Devolvida':
                           $devolvida=$devolvida+1;
                           break;
                           case 'Arquivado':
                           $arquivado=$arquivado+1;
                           break;
                         default:
                           # code...
                           break;
                       };
                       };
                          
                      
                      if($afazer==$total){
                        $conteudobutao="A Fazer";
                        $cor="btn-default";
                      }elseif ($paraaprovacao>=1) {
                        $conteudobutao="Para Aprovação";
                        $cor="btn-warning";
                      }elseif ($comaprovador>=1) {
                        $conteudobutao="Com Aprovador";
                        $cor="btn-danger";
                      }elseif ($devolvida>=1) {
                        $conteudobutao="Devolvida";
                        $cor="btn-danger";  
                      }elseif ($emandamento>=1) {
                        $conteudobutao="Em Andamento";
                        $cor="btn-success";
                      }elseif ($concluido==$total) {
                        $conteudobutao="Concluído";
                        $cor="btn-warning";
                      };

                      @endphp

                      <button type="button" class="btn {{$cor}} btn-xs"><a style="color: black"  href="/painel/notificar/tarefas/{{$notificacao->id}}">{{$conteudobutao}}</a></button></td>
                    <td>{{ $notificacao -> nome}}</td>
                    <td>{{ $notificacao->projecttype->nome}}</td>
                    <td>{{ $notificacao->departamento->nome}}</td>
                    {{-- <td>{{ $usuario -> email}}</td>
                    <td>{{ $usuario->departamento->nome}}</td> --}}
                    <td>{{ $notificacao->departamento->empresa->nome}}</td> 
                    {{-- <td>{{ $usuario -> departamento_id}}</td> --}}
                    
                    <td>
                      
                      <form method="GET" action="{{route('painel.departamentos.edit', $notificacao)}}" style="display: inline">
                      <button class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Editar"> <i class="fa fa-pencil"></i> </button>
                      </form>



                      @php
                      $tarefas = DB::table('tarefas')
                                ->where('project_id', '=', $notificacao->id)
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
                      
                        <a class="btn btn-default btn-sm" href="/painel/notificar/tarefas/{{$notificacao->id}}"><span class="glyphicon glyphicon-paperclip" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Adicionar Anexos"><b style="padding-left: 2px;">{{$anexoscount}}</b></span></a>

                        <a class="btn btn-default btn-sm" href="/painel/notificar/tarefas/{{$notificacao->id}}"><span class="glyphicon glyphicon-comment" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Comentários"><b style="padding-left: 2px;">{{$comentarioscount}}</b></span></a>
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