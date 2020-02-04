@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Tarefas
        <small> - Editar Tarefas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li><a href={{ url()->previous() }}><i class="fa fa-newspaper-o"></i> Tarefas</a></li>
        <li class="active">Editar Tarefas</li>
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
                {!! Form::open(['route' => 'painel.tarefas.update','method' => 'POST','class'=>'form-group']) !!} 
                
                <input name="id" type="hidden" value="{{ $tarefa->id}}">

                <div class="form-group">
                  <label class="control-label">Tarefa:</label>
                  <input placeholder="Digite o Nome da Tarefa" name="tarefa" type="text" required class="form-control form" value="{{ $tarefa->nome}}">
                </div>
                
                <div class="form-group">
                  <label class="control-label">Descrição:</label>
                  <textarea title="Descrição da Tarefa" class="form-control form" name="descricao" placeholder="Descrição da Tarefa">{{ $tarefa->descricao}}</textarea>
                </div>
                
                
                <div style="padding-left: 0px;" class="col-md-6">
                  
                  <div class="form-group">
                  <label class="control-label">Data de Entrega:</label>

                  <input placeholder="Digite a data de Entrega" type="datetime-local" name="entrega" class="form-control form" value="{{Carbon\Carbon::parse($tarefa->entrega)->format('Y-m-d\TH:i')}}">
                </div>
                  
                  {{-- value="{{Carbon\Carbon::parse($tarefa->entrega)->format('Y-m-d h:m')}}" --}}

                </div>
                <div style="padding-right: 0px;" class="col-md-6">
                  
                  <div class="form-group"> 
                  <label class="control-label" for="formInput146">Prioridade:</label>    
                  <select id="formInput146" class="form-control" name="prioridade"> 
                    @php 
                    $ln = ["Baixa", "Normal", "Alta"];

                    foreach ($ln as $val) {
                    if($tarefa->prioridade == $val){
                    $x = "selected";
                    }else{
                    $x = "";
                    }
                    echo "<option value=\"$val\"$x>$val</option>"; 
                    }
                    @endphp
                  </select>
                </div>

                </div>  
                

                @role('Admin')
                <div style="padding-left: 0px;" class="col-md-6">
                {!! Form::label('departamento', 'Departamento:') !!}
                <select class="form-control" name="departamento">
                 @php 
                   // $ln = array($usuariosDepartamento);
                    $ln = json_decode($departamentos);
                    foreach ($ln as $key => $val) {
                    if($tarefa->iddestino == $key){
                    $x = "selected";
                    }else{
                    $x = "";
                    }
                    echo "<option value=$key $x>$val</option>"; 
                    }
                    @endphp
                  </select>
               {{--  {!! Form::select('departamento', $departamentos, null, ['class' => 'form-control']) !!} --}}
                </div>
                <div style="padding-right: 0px;" class="col-md-6">
                {!! Form::label('usuario', 'Colaborador:') !!}
               {{--  {!! Form::select('usuario', [], null, ['class' => 'form-control']) !!} --}}
                <select class="form-control" name="usuario"> 
                    @php 
                   //$lin = $usuariosDepartamento;
                   //$lin = array($usuariosDepartamento);
                    $lin = json_decode($usuariosDepartamento);
                    foreach ($lin as $key => $val) {
                    if($tarefa->iddestino == $key){
                    $x = "selected";
                    }else{
                    $x = "";
                    }
                    echo "<option value=$key $x>$val</option>"; 
                    }
                    @endphp
                  </select>
                  <br>
                </div>
                @endrole



                @role('User')
                <div class="form-group"> 

                {!! Form::label('colaborador', 'Colaborador:') !!}

                  <select class="form-control" name="colaborador"> 
                    @php 
                   // $ln = array($usuariosDepartamento);
                    $ln = json_decode($usuariosDepartamento);
                    foreach ($ln as $key => $val) {
                    if($tarefa->iddestino == $key){
                    $x = "selected";
                    }else{
                    $x = "";
                    }
                    echo "<option value=$key $x>$val</option>"; 
                    }
                    @endphp
                  </select>



                  
               </div>
               @endrole

              {{-- campo que envia o link de retorno --}}
                <input type="hidden" name="voltar" value="{{ url()->previous() }}">                

             </div>

             <div class="modal-footer"> 
              
              {!! Form::submit('Salvar', ['class' => 'btn btn-primary']); !!}
            </form>
            <button type="button" class="btn btn-default" onclick="goBack()">Fechar</button>
                           
          </div> 

<script type="text/javascript">
  function goBack() {
    window.location.replace(document.referrer);
}
  
</script>

@stop