<div style="padding-top: 5px;" class="container-fluid">
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
            <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <script type="text/javascript">
        $(document).ready( function () {
        $('#table_id').DataTable({
          
          "order": [[ 6, "desc" ]],
          "columnDefs": [
            {
              "targets": [ 6 ],
               "visible": false
            },
            {
              "targets": [ 0 ],
               "visible": false
            },
            {
              "targets": [ 7 ],
               "searchable": false
            }
            
            ],


            "initComplete": function () {
            var api = this.api();
            $('#Concluidos').click( function () {
                api.search( 'Concluído' ).draw();
            } );

            $('#ParaAprovacao').click( function () {
                api.search( 'Para Aprovação' ).draw();
            } );

            $('#Vencidas').click( function () {
                api.search( 'Vencida' ).draw();
            } );

            $('#EmAndamento').click( function () {
                api.search( 'Em Andamento' ).draw();
            } );

            $('#AFazer').click( function () {
                api.search( 'A Fazer' ).draw();
            } );
          },



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

            <table id="table_id" class="display">
            <thead>
            <tr>
            <th>Informação</th>
            <th>Anexos</th>  
            <th>Nome</th>
            <th>Responsável</th>
            <th>Prioridade</th>
            <th>Status</th>
            <th>Data Atualização</th>
            <th>Ações</th>
            </tr>
            </thead>
            <tbody>
    
            @foreach($tarefas as $entrada)
              <tr @if ((!is_null($entrada->entrega)) and($entrada->entrega < $hoje)and($entrada->status <> 'Concluído') )
                  style="background-color: #FFDCD5"
                @endif >
                <td>
                 @if ((!is_null($entrada->entrega)) and($entrada->entrega < $hoje)and($entrada->status <> 'Concluído') )
                vencida
                @endif
                </td>
                <td>

                  @php
                  $imgurltag="";
                  $imgAnexo = DB::table('arquivo__tarefas')
                    ->select('arquivos_id')
                    ->where('tarefas_id', '=', $entrada->id)
                    ->limit(1)
                    ->get();
                  
                    foreach ($imgAnexo as $arquivos_id) {
                      $urlImg = DB::table('arquivos')
                      ->select('url')
                      ->where('id', '=', $arquivos_id->arquivos_id)
                      ->get();
                    
                    foreach ($urlImg as $urlImg2) {
                      $imgurltag = url($urlImg2->url);
                      $ext = ltrim( substr( $imgurltag, strrpos( $imgurltag, '.' ) ), '.' );
                      if ($ext == 'jpeg') {
                      @endphp
                      <a href="/painel/tarefas/{{ $entrada->id}}/anexos">
                      <img src={{$imgurltag}}  height="30" width="45">
                      </a>
                    @php
                      }else{
                      
                    @endphp
                    <a href="/painel/tarefas/{{ $entrada->id}}/anexos">
                        <img src="/storage/ico/attach.png"  height="30" width="45">
                      </a>
                    @php
                      }


                    }

                    }

                  @endphp

                  
                
                </td>
                <td>{{ $entrada->nome}}</td>
                
                <td>{{$entrada->name}} </td>
                <td>{{ $entrada->prioridade}}</td>
                <td>{{ $entrada->status}}</td>
                <td>{{ $entrada->updated_at}}</td>
                <td>

                @if (request()->is('painel/tarefas/excluidas*'))
                <a class="btn btn-default btn-sm" href="/painel/tarefas/restory/{{ $entrada->id}}"><span class="glyphicon glyphicon-repeat" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Restaurar Tarefa"></span></a>
                @else
                    <div class="dropdown">
                      <button id="dLabel" class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-option-vertical" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Status"></span>
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dLabel">
                          <li><a href="/update-status/{{$entrada->id}}/A Fazer">A Fazer</a></li>

                          <li><a href="/update-status/{{ $entrada->id}}/Em Andamento">Em Andamento</a></li>

                          <li><a href="/update-status/{{ $entrada->id}}/Para Aprovação">Para Aprovação</a></li>

                          @if ($entrada->idcriadopor == $idUsuario)
                          <li><a href="/update-status/{{ $entrada->id}}/Concluído">Concluído</a></li>
                          @endif
                      </ul>


                      @php

                      $anexoscount = DB::table('arquivo__tarefas')
                        ->where('tarefas_id', '=', $entrada->id)
                        ->count();

 
                    $comentarioscount = DB::table('comentarios')
                    ->where('tarefas_id', '=', $entrada->id)
                    ->whereNull('deleted_at')
                    ->count();

                    @endphp


                      <a class="btn btn-default btn-sm" href="/painel/tarefas/{{ $entrada->id}}/anexos"><span class="glyphicon glyphicon-paperclip" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Adicionar Anexos"><b style="padding-left: 2px;">{{$anexoscount}}</b></span></a>

                      <a class="btn btn-default btn-sm" href="/painel/tarefas/comentarios/{{ $entrada->id}}"><span class="glyphicon glyphicon-comment" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Comentários"><b style="padding-left: 2px;">{{$comentarioscount}}</b></span></a>


                      @if ($entrada->idcriadopor == $idUsuario)

                          @if (strstr(url()->current(), 'recebidas'))

                      <a class="btn btn-default btn-sm" href="/painel/tarefas/edit/{{ $entrada->id}}/recebidas"><span class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Editar Tarefa"></span></a>

                          @elseif (strstr(url()->current(), 'enviadas'))
                      
                      <a class="btn btn-default btn-sm" href="/painel/tarefas/edit/{{ $entrada->id}}/enviadas"><span class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Editar Tarefa"></span></a>
                          
                          @endif

                      <a class="btn btn-default btn-sm" href="/painel/tarefas/delete/{{ $entrada->id}}"><span class="glyphicon glyphicon-remove" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Excluir Tarefa"></span></a>
                      @else

                      <a class="btn btn-default btn-sm" href="/painel/tarefas/encaminhar/{{ $entrada->id}}"><span class="glyphicon glyphicon-transfer" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Encaminhar Tarefa"></span></a>

                      @endif

                      
                    <a class="btn btn-default btn-sm" href="/painel/tarefas/historico/{{ $entrada->id}}"><span class="glyphicon glyphicon-list-alt" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Histórico da Tarefa"></span></a>                      
                    </div>
                    


{{-- 
                      <button type="button" class="btn btn-default" data-target="#adicionaranexo" data-toggle="modal">Visualizar Anexo</button>
           --}}         

















                @endif












                </td>









              </tr>


            @endforeach

            </tbody>
            </table>
        </div>

                      

<srcipt src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
      $('select[name=departamento]').change(function () {
        var idDepartamento = $(this).val();
        $.get('tarefas/get-usuarios/'+idDepartamento, function (usuarios) {
          $('select[name=usuario]').empty();
          $.each(usuarios, function (key, value) {
            $('select[name=usuario]').append('<option value='+ value.id +'>'+value.name+'</option>');
          });
        });
      });
</script>

