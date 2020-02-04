@extends('painel.layout')

@section('header')


<!-- Include jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<link rel="stylesheet" href="/bootstrap-datepicker-1.9.0/css/bootstrap-datepicker3.css"/>
<script type="text/javascript" src="/bootstrap-datepicker-1.9.0/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript" src="/bootstrap-datepicker-1.9.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>


<section class="content-header">
      <h1>
        Notificação
        <small> - Cadastrar Notificação</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li><a href={{ route('painel.notificar.index') }}><i class="fa fa-id-card-o"></i> Notificação</a></li>
        <li class="active">Cadastrar Notificação</li>
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



{!! Form::open(['route' => 'painel.notificar.gravarformularioprojecttype','method' => 'POST','class'=>'form-horizontal']) !!}
<div class="col-md-12">
  <div class="box box-info">
      <div class="box-body">
      <input type="hidden" name="user_id" value={{$user->id}} >
      <input type="hidden" name="departamento" value={{$departamento}} >
      <input type="hidden" name="projecttype" value={{$projecttype}} >
      {{-- campo que envia o link de retorno --}}
      <input type="hidden" name="voltar" value="{{ url()->previous() }}">          

<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Nome</label>  
  <div class="col-md-6">
  <input id="textinput" name="nome" type="text" placeholder="Digite o Nome do Projeto" class="form-control input-md" required="">
  </div>

  <label class="col-md-1 control-label" for="descricao">Data</label>
  <div class="col-md-3">                     
    <div id="test"> 
      <input type="text" name="data" class="form-control" required>
    </div>
  </div>
  </div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-2 control-label" for="descricao">Descrição</label>
  <div class="col-md-10">                     
    <textarea class="form-control" id="descricao" name="descricao">Descreva o Projeto, faça um pequeno Briefing.</textarea>
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-2 control-label" for="descricao">Objetivo</label>
  <div class="col-md-10">                     
    <textarea class="form-control" id="objetivo" name="objetivo">Descreva o objetivo do Projeto.</textarea>
  </div>
</div>

{{-- Configuração do campo data --}} 
<script type="text/javascript">
$('#test input').datepicker({
  format:"dd/mm/yyyy",
  startDate:"+4d",
  language:"pt-BR",
  daysOfWeekHighlighted:"0,6",
  autoclose:true,
  todayHighlight:true
});  
</script>



{{-- Editor de texto nos campo Text Área --}}
<script src="{{asset('/ckeditor/ckeditor.js')}}"></script>

<script>
    CKEDITOR.replace( 'descricao' );
</script>

  </div>

<div class="box-footer">
  <div class=text-right>
        {!! Form::submit('Cadastrar', ['class' => 'btn btn-primary']); !!}
  </div>      
</div>
</div>


{!! Form::close() !!}

@stop