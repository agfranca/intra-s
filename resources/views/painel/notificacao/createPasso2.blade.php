@extends('painel.layout')

@section('header')

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){

      $('select[name=tipo]').change(function () {

        var tipoescolhido = $(this).val();
        var departamento = "<?php print $departamento; ?>";
        window.location.href = "/painel/notificar/create/"+departamento+"/"+tipoescolhido;
      });
    });
</script>




{!! Form::open(['route' => 'painel.notificar.store','method' => 'POST','class'=>'form-horizontal']) !!}
<div class="col-md-12">
  <div class="box box-info">
              <div class="box-body">
                <div class="form-group"> 
                  <div class="col-sm-12">
                    <label class="control-label" for="formInput146">Tipo:</label>                                             
                    <select id="formInput146" class="form-control" name="tipo">  <option>Escolha um Item</option>
                      @foreach($projecttypes as $projecttype) 
                        <option value={!!$projecttype->id!!}>{!!$projecttype->nome!!}</option>
                      @endforeach
                    </select>
                  </div>
                  </div>
              </div>           
  </div>
</div>

{!! Form::close() !!}



@stop