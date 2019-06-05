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
  <div class="box-header" style="padding-bottom: 0px;">

    <button type="button" class="btn btn-primary pull-right" name="Adicionar" data-target="#adicionartarefas" data-toggle="modal"><i class="fa fa-plus"></i> Adicionar Tarefas</button>

    <div class="text-left col-md-9">
      <div class="btn-group btn-group-sm" id="filtrotarefa" data-pg-name="filtrotarefa"> 
        <button type="button" class="btn btn-default active">Entradas</button>                         
        <button type="button" class="btn btn-default">Saídas</button>
        <button type="button" class="btn btn-default">Entradas Vencidas</button>
        <button type="button" class="btn btn-default">Saídas Vencidas</button>
        <button type="button" class="btn btn-default">Arquivadas</button>
      </div>

      <div class="btn-group btn-group-xs" id="filtrotarefa2" data-pg-name="filtrotarefa2"> 
            <button type="button" class="btn btn-default">Hoje</button>                     
            <button type="button" class="btn btn-default">Esta Semana</button>
            <button type="button" class="btn btn-default active">Todas</button>
      </div>
      
      <div class="btn-group btn-group-xs" id="tipovisualizacao" data-pg-name="tipovisualizacao"> 
            <button type="button" class="btn btn-default active">Lista</button>             
            <button type="button" class="btn btn-default">Kanban</button>
      </div>

    </div>

  </div>


  <!-- /.box-header -->
  <div class="box-body">

    <div class="container-fluid">
      <div class="col-md-12">
        <div class="col-md-12 bg-primary">
          <div class="col-md-1">
            <p class="text-center"></p> 
          </div>
          <div class="col-md-2">
            <h3 class="text-center">{{$aFazer}}</h3> 
            <p class="text-center">A Fazer</p> 
          </div>
          <div class="col-md-2">
            <h3 class="text-center">{{$emAndamento}}</h3> 
            <p class="text-center">Em Andamento</p> 
          </div>
          <div class="col-md-2">
            <h3 class="text-center">{{$vencidas}}</h3> 
            <p class="text-center">Vencidas</p>
          </div>
          <div class="col-md-2">
            <h3 class="text-center">{{$paraAprovacao}}</h3> 
            <p class="text-center">Para Aprovação</p>
          </div>
          <div class="col-md-2">
            <h3 class="text-center">{{$concluido}}</h3> 
            <p class="text-center">Concluídos</p>
          </div>                                          
        </div>
      </div>
        
        <div style="padding-top: 5px;" class="col-md-12">
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

            
            <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

            <script type="text/javascript">
            $(document).ready( function () {
            $('#table_id').DataTable({

              "order": [[ 4, "desc" ]],
              "columnDefs": [
                    {
                      "targets": [ 4 ],
                       "visible": false
                    }
                  ],

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
            <th>Nome</th>
            <th>Criado Por</th>
            <th>Prioridade</th>
            <th>Status</th>
            <th>Data Atualização</th>
            <th>Ações</th>
            </tr>
            </thead>
            <tbody>
  
            @foreach($tarefas as $entrada)
              <tr>
                <td>{{ $entrada->nome}}</td>
                <td>{{ $entrada->name}}</td>
                <td>{{ $entrada->prioridade}}</td>
                <td>{{ $entrada->status}}</td>
                <td>{{ $entrada->updated_at}}</td>
                <td>

                    <div class="dropdown">
                      <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Status
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dLabel">
                          <li><a href="tarefas/update-status/{{ $entrada->id}}/A Fazer">A Fazer</a></li>

                          <li><a href="tarefas/update-status/{{ $entrada->id}}/Em Andamento">Em Andamento</a></li>

                          <li><a href="tarefas/update-status/{{ $entrada->id}}/Para Aprovação">Para Aprovação</a></li>

                          @if ($entrada->idcriadopor == $idUsuario)
                          <li><a href="tarefas/update-status/{{ $entrada->id}}/Concluído">Concluído</a></li>
                          @endif
                      </ul>
                                     
                    </div>

                </td>
              </tr>
            @endforeach
            </tbody>
            </table>
















            
            
        </div>                                  
      </div>

      <div class="col-md-12">
        <div class="modal fade pg-show-modal" id="adicionartarefas" tabindex="-1" role="dialog" aria-hidden="true"> 
          <div class="modal-dialog"> 
            <div class="modal-content"> 
              <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                                     

                <h4 class="modal-title">Cadastrar Tarefas</h4> 
              </div>                                 

              <div class="modal-body">
                {!! Form::open(['route' => 'painel.tarefas.store','method' => 'POST','class'=>'form-group']) !!} 

                <div class="form-group">
                  <input placeholder="Digite o Nome da Tarefa" name="tarefa" type="text" required class="form-control form">
                </div>
                
                <div class="form-group">
                  <textarea title="Descrição da Tarefa" class="form-control form" name="descricao" placeholder="Descrição da Tarefa"></textarea>
                </div>
                
                
                <div style="padding-left: 0px;" class="col-md-6">
                  
                  <div class="form-group">
                  <label class="control-label">Data de Entrega:</label>

                  <input placeholder="Digite a data de Entrega" type="date" name="entrega" class="form-control form">
                </div>

                </div>
                <div style="padding-right: 0px;" class="col-md-6">
                  
                  <div class="form-group"> 
                  <label class="control-label" for="formInput146">Prioridade:</label>                                             

                  <select id="formInput146" class="form-control" name="prioridade"> 
                    <option>Baixa</option>                                                 

                    <option>Normal</option>                                                 

                    <option>Alta</option>                                                 
                  </select>
                </div>

                </div>  
                

                @role('Admin')
                <div style="padding-left: 0px;" class="col-md-6">
                {!! Form::label('departamento', 'Departamento:') !!}
                {!! Form::select('departamento', $departamentos, null, ['class' => 'form-control']) !!}
                </div>
                <div style="padding-right: 0px;" class="col-md-6">
                {!! Form::label('usuario', 'Colaborador:') !!}
                {!! Form::select('usuario', [], null, ['class' => 'form-control']) !!}
                </div>
                @endrole
                @role('User')
                <div class="form-group"> 

                {!! Form::label('colaborador', 'Colaborador:') !!}
                {!! Form::select('colaborador', $usuariosDepartamento, null, ['class' => 'form-control']) !!}

                  {{-- <label class="control-label" for="formInput192">Colaborador:</label>     

                  <select id="formInput192" class="form-control" name='colaborador'>
                   @foreach($usuariosDepartamento as $usuario)
                   <option>{{$usuario->name}}</option>
                   @endforeach                 
                 </select> --}}
               </div>
               @endrole

                

             </div>
             <div class="modal-footer"> 
              {!! Form::submit('Salvar', ['class' => 'btn btn-primary']); !!}
            </form>
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>               
          </div> 
        </div>
      </div>                                                 
    </div>
  </div>        

<!-- /.box-body -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
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

</div>
</div>





@stop