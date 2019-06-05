@extends('painel.layout')
@section('header')
<section class="content-header">
      <h1>
        Tarefas
        <small> - Encaminhar Tarefas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li class="active">Tarefas</li>
      </ol>
</section>
@stop
@section('content')
  @include('painel.partes.mensagens-usuarios')
  <div class="box box-info">
    
    <!-- /.box-header -->
    <div class="box-body">
    {!! Form::open(['route' => 'painel.tarefas.encaminharupdate','method' => 'POST','class'=>'form-group']) !!} 
                
    <input name="id" type="hidden" value="{{ $tarefa->id}}">
    

                @role('Admin|AdminSetor')
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

                {!! Form::label('colaborador', 'Encaminhar Para:') !!}

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
              
              {!! Form::submit('Encaminhar', ['class' => 'btn btn-primary']); !!}
            </form>
            <a href="javascript:history.back()" class="btn btn-default">Fechar</a>

    
    </div>
   <!-- /.box-body -->
  </div>
@stop