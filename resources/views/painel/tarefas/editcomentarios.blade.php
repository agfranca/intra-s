@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Comentários
        <small> - Editar Comentário</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li><a href={{ url()->previous() }}><i class="fa fa-newspaper-o"></i> Comentários</a></li>
        <li class="active">Editar Comentário</li>
      </ol>
    </section>
@stop


@section('content')

<div class="box box-info">              
            <div class="modal-body">
                {!! Form::open(['route' => 'painel.tarefas.comentarios.update','method' => 'PUT','class'=>'form-group']) !!} 
                {{-- campo que envia o link de retorno --}}
                <input type="hidden" name="voltar" value="{{ url()->previous() }}">
                <input type="hidden" name="id" value="{{ $comentario->id }}">

                <div class="form-group">
                  <textarea title="Descrição do Comentário" class="form-control form" name="comentario" placeholder="Descrição do comentário" required>{!! $comentario->comentario !!}</textarea>
                </div>
                
            </div>

            <div class="modal-footer"> 
              {!! Form::submit('Salvar', ['class' => 'btn btn-primary']); !!}
              </form>
              <a href="javascript:history.back()" class="btn btn-default">Fechar</a>
            </div>
</div>

{{-- Editor de texto nos campo Text Área --}}
<script src="{{asset('/ckeditor/ckeditor.js')}}"></script>

<script>
    CKEDITOR.replace( 'comentario' );
</script>

@stop