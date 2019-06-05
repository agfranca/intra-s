@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Tarefas
        <small> - Cadastrar Tarefas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li><a href={{ url()->previous() }}><i class="fa fa-newspaper-o"></i> Tarefas</a></li>
        <li class="active">Cadastrar Tarefas</li>
      </ol>
    </section>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){

      $('select[name=departamento]').change(function () {

        var idDepartamento = $(this).val();

        $.get('/painel/tarefas/get-usuarios/'+idDepartamento, function (usuarios) {
          
          $('select[name=usuario]').empty();

          $.each(usuarios, function (key, value) {
            $('select[name=usuario]').append('<option value='+ value.id +'>'+value.name+'</option>');
          });
        });
      });
    });
</script>
  





@stop

@section('content')




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

                @role('Admin|AdminSetor')
                <div style="padding-left: 0px;" class="col-md-6">
                  {!! Form::label('departamento', 'Departamento:') !!}
                  {!! Form::select('departamento', $departamentos, null, ['class' => 'form-control']) !!}
                </div>
                <div style="padding-right: 0px;" class="col-md-6">
                  {!! Form::label('usuario', 'Colaborador:') !!}
                  {!! Form::select('usuario', [], null, ['class' => 'form-control']) !!}
                <br>
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
                
                {{-- campo que envia o link de retorno --}}
                <input type="hidden" name="voltar" value="{{ url()->previous() }}">
                

             </div>
          <div class="modal-footer"> 
              {!! Form::submit('Salvar', ['class' => 'btn btn-primary']); !!}
            </form>
            <a href="javascript:history.back()" class="btn btn-default">Fechar</a>
          </div>







@stop