@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Comentários
        <small> - Adicionar Comentários</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li><a href={{ url()->previous() }}><i class="fa fa-newspaper-o"></i> Comentários</a></li>
        <li class="active">Adicionar Comentários</li>
      </ol>
    </section>
@stop


@section('content')

<style type="text/css">

  .title {
    font-size: 14px;
    font-weight:bold;
}
.komen {
    font-size:14px;
}
.geser {
    margin-left:55px;
    margin-top:5px;
}

</style>

<div class="box box-info">              
            <div class="modal-body">
                {!! Form::open(['route' => 'painel.tarefas.comentarios.create','method' => 'POST','class'=>'form-group']) !!} 
                
                <input name="id" type="hidden" value="{{$id}}">

                <input type="hidden" name="voltar" value="{{ url()->previous() }}">

                <div class="form-group">
                  <textarea title="Descrição do Comentário" class="form-control form" name="comentario" placeholder="Descrição do comentário" required></textarea>
                </div>
                
                {{-- campo que envia o link de retorno --}}
                <input type="hidden" name="voltar" value="{{ url()->previous() }}">          
            </div>

            <div class="modal-footer"> 
              {!! Form::submit('Salvar', ['class' => 'btn btn-primary']); !!}
              </form>
              <a href="javascript:history.back()" class="btn btn-default">Fechar</a>
            </div>

<div class="container">
  <div class="container">  
  <div class="row">
    @foreach($comentarios as $comentario)    
      @php
      $usuario = DB::table('users')
                ->where('id', '=', $comentario->users_id)
                ->first();
      @endphp
     <div class="media">
        <div class="media-left">
          {{-- <img src="http://fakeimg.pl/50x50" class="media-object" style="width:40px"> --}}

          @if($usuario->arquivo_id==Null)
              <img src="http://fakeimg.pl/50x50" class="media-object" style="width:40px">
              {{-- <img class="img-fluid mx-auto d-block" src="{{$avatar->dirname}}/{{$avatar->basename}}"> --}}
          @else
          @php
              $url = DB::table('arquivos')
                ->where('id', '=', $usuario->arquivo_id)
                ->first();
          @endphp
              <img src="{{$url->url}}" class="media-object rounded-circle" style="width:40px" alt="User Image">
          @endif



        </div>
        <div class="media-body">
          
          <div class="pull-left">
          <a class="btn btn-default btn-xs" href="/painel/tarefas/comentarios/editar/{{ $comentario->id}}">
          <span class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Editar Comentário"></span>
          </a>
          
          <a class="btn btn-default btn-xs" href="/painel/tarefas/comentarios/delete/{{ $comentario->id}}">
          <span class="glyphicon glyphicon-remove" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Excluir comentário"></span>
          </a>
          </div>

          <h4 style="padding-top: 5px;" class="media-heading title">&nbsp{{$usuario->name}} &nbsp<span class="label label-primary" data-toggle="tooltip" data-placement="top" title="Data de Entrega">{{Carbon\Carbon::parse($comentario->updated_at)->format('d/m/Y H:i:s')}} </span></h4>
          
          <p style="padding-top: 1px;" class="komen img-responsive">
            
              {!!$comentario->comentario!!}<br>

          </p>
        </div>
    </div>
    @endforeach
  </div>
</div>
</div>
</div>




{{-- Editor de texto nos campo Text Área --}}
<script src="{{asset('/ckeditor/ckeditor.js')}}"></script>

<script>
    CKEDITOR.replace( 'comentario' );
</script>



@stop

