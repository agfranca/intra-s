@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Notícias
        <small> - Listagem de Noticias</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li class="active">Notícias</li>
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
            <div class="box-header">
              <h3 class="box-title">Notícias para o Usuário</h3>
                       
              <a href="{{ route('painel.noticias.create') }}" class="btn btn-primary pull-right" role="button"><i class="fa fa-plus"></i> Adicionar Notícias</a>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="noticias" class="table table-striped">
                <thead> 
                <tr>
                  <th scope="col">Notícia</th>
                  <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                  
                @foreach($noticiasdousuario as $noticia)
                	<td scope="row">
                  {{-- {!!$noticia->usuario->name!!} --}}
                    
                    @if($noticia->redistribuir_noticias_id!==Null)
                    Redistribuido por: {!!$noticia->redistribuir_noticia->usuario->name!!}<br>
                    Comentário: {!!$noticia->redistribuir_noticia->nota!!}<br>
                    @endif
                    Publicado por: {!!$noticia->usuario->name!!}
                    <br>
                    <h4>{!! $noticia->noticia->titulo!!}</h4>
                    {!! $noticia->noticia->noticia!!}
              
                  </td>

                                    		
                    <td scope="row">
                	
                  @if($noticia->user_id==Auth::user()->id)
                      <form method="GET" action="{{route('painel.noticias.edit', $noticia->noticia_id)}}" style="display: inline">
                      <button class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Editar"> <i class="fa fa-pencil"></i> </button>
                      </form>
                			

                      <form method="POST" action="{{route('painel.noticias.destroy', $noticia->noticia_id)}}" style="display: inline">
                       {{csrf_field()}} {{method_field('DELETE')}} 
                      <button class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Excluir"> <i class="fa fa-times"></i> </button>
                      </form>
                  @endif
 
                    @role('Admin|AdminSetor')
                      <form method="GET" action="{{route('painel.redistribuir.edit', $noticia->noticia_id)}}" style="display: inline">
                      <button class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Redistribuir"> <i class="fa fa-refresh"></i> </button>
                      </form>
                    @endrole

                		</td>	
                    
                	</tr>	
                @endforeach


                </tbody>
               </table>
            </div>
            <!-- /.box-body -->
          </div>


@stop