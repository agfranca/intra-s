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
                       // //$status->all();
                       // $total = $status->count();

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
                      @endphp

                      <button type="button" class="btn {{$cor}} btn-xs"><a style="color: black"  href="/painel/notificar/tarefas/{{$notificacao->id}}">{{$conteudobutao}}</a></button>

                      {{-- RETIREI o Conteudo DAQUI --}}

                    </td>
                    <td>{{ $notificacao -> nome}}</td>
                    <td>{{ $notificacao->projecttype->nome}}</td>
                    <td>{{ $notificacao->departamento->nome}}</td>
                    {{-- <td>{{ $usuario -> email}}</td>
                    <td>{{ $usuario->departamento->nome}}</td> --}}
                    <td>{{ $notificacao->departamento->empresa->nome}}</td> 
                    {{-- <td>{{ $usuario -> departamento_id}}</td> --}}
                    

                    <td>
                      
                      {{-- REtireo o conteudo daqui --}}


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