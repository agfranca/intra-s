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
  @include('painel.partes.mensagens-usuarios')

  <div class="box box-info">
    @include('painel.tarefas.partes.menuHorizontal')
    <!-- /.box-header -->
    <div class="box-body">

<style type="text/css">
.backto{background:#039; padding:12px 0; color:#fff}
.backto a{color:#FFF; text-decoration:none}
.cards-row{padding-top:40px; padding-bottom:20px; background:#eee}
.thumbnail{padding:0; border-radius:0; border:none; box-shadow:0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12)}
.thumbnail>img{width:100%; display:block}
.thumbnail h3{font-size:26px}
.thumbnail h3,.card-description{margin:0; padding:1px 0; border-bottom:solid 1px #eee; text-align:justify}
.thumbnail p{padding-top:2px; font-size:15px}
.thumbnail .btn{border-radius:0; box-shadow:0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12); font-size:20px}
.main-header{
   background-image: linear-gradient(#004b8d, #1d65a3, #004b8d);
}
</style>

<link href="/dragula/dist/dragula.css" rel="stylesheet" type="text/css">
<link href="/dragula/example/alexandre.css" rel="stylesheet" type="text/css">  

<div id="kaban">

  <div id="scroller">
    <div id="boards">
      
      <div class="board" id="board1">

        <header>A Fazer ({{$aFazerCount}})</header>
        <div class="cards" id="b1">

            @foreach($aFazer as $recebida)

            <div id="{{ $recebida->id}}" class="thumbnail card">
           
           {{-- Botão Editar e Excluir --}}

           @if (strstr(url()->current(), 'recebidas'))

              @if($recebida->idcriadopor == $recebida->iddestino)
              
                  <span style="position: absolute; right: 33px; opacity: .8;" class="badge">
                  <a href="/painel/tarefas/edit/{{ $recebida->id}}/recebidas">
                  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></span>

                  <span style="position: absolute; right: 4px; opacity: .8;" class="badge">
                  <a href="/painel/tarefas/delete/{{ $recebida->id}}">
                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></span>
              @else

                <span style="position: absolute; right: 4px; opacity: .8;" class="badge">
                  <a href="/painel/tarefas/encaminhar/{{ $recebida->id}}">
                  <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span></a></span>

              @endif


           @elseif (strstr(url()->current(), 'enviadas'))

                <span style="position: absolute; right: 33px; opacity: .8;" class="badge">
                <a href="/painel/tarefas/edit/{{ $recebida->id}}/recebidas">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></span>

                <span style="position: absolute; right: 4px; opacity: .8;" class="badge">
                <a href="/painel/tarefas/delete/{{ $recebida->id}}">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></span>

           @endif


            {{-- Campos Ocultos para bloqueios na boards concluido --}}
                <input type="hidden" id="criador"  value="{{ $recebida->idcriadopor}}">
                <input type="hidden" id="destino"  value="{{ $recebida->iddestino}}">

                @php
                  $imgurltag="";
                  $imgAnexo = DB::table('arquivo__tarefas')
                    ->select('arquivos_id')
                    ->where('tarefas_id', '=', $recebida->id)
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
                      <a href="/painel/tarefas/{{ $recebida->id}}/anexos">
                      <img src={{$imgurltag}}>
                      </a>
                     
                @php
                      }
                }
                }
                @endphp

                  <h4>{{$recebida->nome}}</h4>

                {{-- Data de Prioridade --}}
                @switch($recebida->prioridade)
                    @case('Baixa')
                        <span class="label label-success" data-toggle="tooltip" data-placement="top" title="Prioridade">{{$recebida->prioridade}}</span>
                        @break

                    @case('Normal')
                        <span class="label label-info" data-toggle="tooltip" data-placement="top" title="Prioridade">{{$recebida->prioridade}}</span>
                        @break
                    
                    @case('Alta')
                        <span class="label label-danger" data-toggle="tooltip" data-placement="top" title="Prioridade">{{$recebida->prioridade}}</span>
                        @break

                @endswitch


                {{-- Data de Entrega --}}   
                @if((!is_null($recebida->entrega))and($recebida->entrega > $hoje))
                <span class="label label-primary" data-toggle="tooltip" data-placement="top" title="Data de Entrega">{{Carbon\Carbon::parse($recebida->entrega)->format('d/m/Y')}}</span>
                @elseif ((!is_null($recebida->entrega))and($recebida->entrega < $hoje))
                <span class="label label-danger" data-toggle="tooltip" data-placement="top" title="Data de Entrega (Atrasado)">{{Carbon\Carbon::parse($recebida->entrega)->format('d/m/Y')}}</span>
                @endif



                {{-- Variaveis Anexos e Comentarios --}}
                @php

                     $anexoscount = DB::table('arquivo__tarefas')
                    ->where('tarefas_id', '=', $recebida->id)
                    ->count();

                    $comentarioscount = DB::table('comentarios')
                    ->where('tarefas_id', '=', $recebida->id)
                    ->count();

                @endphp
                
                {{-- Resposável --}}

                <span class="label label-warning" data-toggle="tooltip" data-placement="top" title="Responsável">{{request()->is('painel/tarefas/kanban/recebidas/*') ? $recebida->name : $recebida->destino }}</span>

                <br>
                {{-- Anexos --}}
                <span class="label label-default" data-toggle="tooltip" data-placement="top" title="Anexos">
                <a href="/painel/tarefas/{{ $recebida->id}}/anexos">
                <span class="glyphicon glyphicon-paperclip" aria-hidden="true" ><b style="padding-left: 2px;">{{$anexoscount}}</b></span>
                </a>
                </span>
                 
                
                {{-- Comentários --}}
                <span style="margin-left: 4px;" class="label label-default" data-toggle="tooltip" data-placement="top" title="Comentários">
                <a href="/painel/tarefas/comentarios/{{ $recebida->id}}">
                  <span class="glyphicon glyphicon-comment" aria-hidden="true"><b style="padding-left: 2px;">{{$comentarioscount}}</b></span></a>
                </span>


                {{-- Histórico --}}
                <span style="margin-left: 4px;" class="label label-default" data-toggle="tooltip" data-placement="top" title="Histórico">
                <a href="/painel/tarefas/historico/{{ $recebida->id}}">
                  <span class="glyphicon glyphicon-list-alt" aria-hidden="true"><b style="padding-left: 2px;"></b></span></a>
                </span>



             </div>

            @endforeach
          
        </div>
      </div>
      
      <div class="board" id="board2">
        <header>Em Andamento ({{$emAndamentoCount}}) </header>
        <div class="cards" id="b2">



            @foreach($emAndamento as $recebida)

            <div id="{{$recebida->id}}" class="thumbnail card">

              {{-- Botão Editar --}}

           @if (strstr(url()->current(), 'recebidas'))

              @if($recebida->idcriadopor == $recebida->iddestino)
              
                  <span style="position: absolute; right: 33px; opacity: .8;" class="badge">
                  <a href="/painel/tarefas/edit/{{ $recebida->id}}/recebidas">
                  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></span>

                  <span style="position: absolute; right: 4px; opacity: .8;" class="badge">
                  <a href="/painel/tarefas/delete/{{ $recebida->id}}">
                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></span>
                @else

                <span style="position: absolute; right: 4px; opacity: .8;" class="badge">
                  <a href="/painel/tarefas/encaminhar/{{ $recebida->id}}">
                  <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span></a></span>

              @endif


           @elseif (strstr(url()->current(), 'enviadas'))

                <span style="position: absolute; right: 33px; opacity: .8;" class="badge">
                <a href="/painel/tarefas/edit/{{ $recebida->id}}/recebidas">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></span>

                <span style="position: absolute; right: 4px; opacity: .8;" class="badge">
                <a href="/painel/tarefas/delete/{{ $recebida->id}}">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></span>

           @endif


                <input type="hidden" id="criador"  value="{{ $recebida->idcriadopor}}">
                <input type="hidden" id="destino"  value="{{ $recebida->iddestino}}">

                @php
                  $imgurltag="";
                  $imgAnexo = DB::table('arquivo__tarefas')
                    ->select('arquivos_id')
                    ->where('tarefas_id', '=', $recebida->id)
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
                      <a href="/painel/tarefas/{{ $recebida->id}}/anexos">
                      <img src={{$imgurltag}}>
                      </a>
                @php
                      }
                }
                }
                @endphp

                  <h4>{{$recebida->nome}}</h4>

                {{-- Data de Prioridade --}}
                @switch($recebida->prioridade)
                    @case('Baixa')
                        <span class="label label-success" data-toggle="tooltip" data-placement="top" title="Prioridade">{{$recebida->prioridade}}</span>
                        @break

                    @case('Normal')
                        <span class="label label-info" data-toggle="tooltip" data-placement="top" title="Prioridade">{{$recebida->prioridade}}</span>
                        @break
                    
                    @case('Alta')
                        <span class="label label-danger" data-toggle="tooltip" data-placement="top" title="Prioridade">{{$recebida->prioridade}}</span>
                        @break

                @endswitch


                {{-- Data de Entrega --}}   
                @if((!is_null($recebida->entrega))and($recebida->entrega > $hoje))
                <span class="label label-primary" data-toggle="tooltip" data-placement="top" title="Data de Entrega">{{Carbon\Carbon::parse($recebida->entrega)->format('d/m/Y')}}</span>
                @elseif ((!is_null($recebida->entrega))and($recebida->entrega < $hoje))
                <span class="label label-danger" data-toggle="tooltip" data-placement="top" title="Data de Entrega (Atrasado)">{{Carbon\Carbon::parse($recebida->entrega)->format('d/m/Y')}}</span>
                @endif


                {{-- Variaveis Anexos e Comentarios --}}
                @php

                     $anexoscount = DB::table('arquivo__tarefas')
                    ->where('tarefas_id', '=', $recebida->id)
                    ->count();

                    $comentarioscount = DB::table('comentarios')
                    ->where('tarefas_id', '=', $recebida->id)
                    ->count();

                @endphp
                
                {{-- Resposável --}}    

                <span class="label label-warning" data-toggle="tooltip" data-placement="top" title="Responsável">{{request()->is('painel/tarefas/kanban/recebidas/*') ? $recebida->name : $recebida->destino }}</span>

                <br>
                {{-- Anexos --}}
                <span class="label label-default" data-toggle="tooltip" data-placement="top" title="Anexos">
                <a href="/painel/tarefas/{{ $recebida->id}}/anexos">
                <span class="glyphicon glyphicon-paperclip" aria-hidden="true" ><b style="padding-left: 2px;">{{$anexoscount}}</b></span>
                </a>
                </span>
                 
                
                {{-- Comentários --}}
                <span style="margin-left: 4px;" class="label label-default" data-toggle="tooltip" data-placement="top" title="Comentários">
                <a href="/painel/tarefas/comentarios/{{ $recebida->id}}">
                  <span class="glyphicon glyphicon-comment" aria-hidden="true"><b style="padding-left: 2px;">{{$comentarioscount}}</b></span></a>
                </span>

                {{-- Histórico --}}
                <span style="margin-left: 4px;" class="label label-default" data-toggle="tooltip" data-placement="top" title="Histórico">
                <a href="/painel/tarefas/historico/{{ $recebida->id}}">
                  <span class="glyphicon glyphicon-list-alt" aria-hidden="true"><b style="padding-left: 2px;"></b></span></a>
                </span>

             </div>

            @endforeach

          



        </div>
      </div>
      
      <div class="board" id="board3">
        <header>Para Aprovação ({{$paraAprovacaoCount}})</header>
        <div class="cards" id="b3">
          
            @foreach($paraAprovacao as $recebida)
            <div id="{{ $recebida->id}}" class="thumbnail card">


              {{-- Botão Editar --}}

           @if (strstr(url()->current(), 'recebidas'))

              @if($recebida->idcriadopor == $recebida->iddestino)
              
                  <span style="position: absolute; right: 33px; opacity: .8;" class="badge">
                  <a href="/painel/tarefas/edit/{{ $recebida->id}}/recebidas">
                  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></span>

                  <span style="position: absolute; right: 4px; opacity: .8;" class="badge">
                  <a href="/painel/tarefas/delete/{{ $recebida->id}}">
                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></span>
             @else

                <span style="position: absolute; right: 4px; opacity: .8;" class="badge">
                  <a href="/painel/tarefas/encaminhar/{{ $recebida->id}}">
                  <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span></a></span>

              @endif


           @elseif (strstr(url()->current(), 'enviadas'))

                <span style="position: absolute; right: 33px; opacity: .8;" class="badge">
                <a href="/painel/tarefas/edit/{{ $recebida->id}}/recebidas">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></span>

                <span style="position: absolute; right: 4px; opacity: .8;" class="badge">
                <a href="/painel/tarefas/delete/{{ $recebida->id}}">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></span>

           @endif


                <input type="hidden" id="criador"  value="{{ $recebida->idcriadopor}}">
                <input type="hidden" id="destino"  value="{{ $recebida->iddestino}}">

                @php
                  $imgurltag="";
                  $imgAnexo = DB::table('arquivo__tarefas')
                    ->select('arquivos_id')
                    ->where('tarefas_id', '=', $recebida->id)
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
                      <a href="/painel/tarefas/{{ $recebida->id}}/anexos">
                      <img src={{$imgurltag}}>
                      </a>
                     
                @php
                      }
                }
                }
                @endphp

                  <h4>{{$recebida->nome}}</h4>

                {{-- Data de Prioridade --}}
                @switch($recebida->prioridade)
                    @case('Baixa')
                        <span class="label label-success" data-toggle="tooltip" data-placement="top" title="Prioridade">{{$recebida->prioridade}}</span>
                        @break

                    @case('Normal')
                        <span class="label label-info" data-toggle="tooltip" data-placement="top" title="Prioridade">{{$recebida->prioridade}}</span>
                        @break
                    
                    @case('Alta')
                        <span class="label label-danger" data-toggle="tooltip" data-placement="top" title="Prioridade">{{$recebida->prioridade}}</span>
                        @break

                @endswitch


                {{-- Data de Entrega --}}   
                @if((!is_null($recebida->entrega))and($recebida->entrega > $hoje))
                <span class="label label-primary" data-toggle="tooltip" data-placement="top" title="Data de Entrega">{{Carbon\Carbon::parse($recebida->entrega)->format('d/m/Y')}}</span>
                @elseif ((!is_null($recebida->entrega))and($recebida->entrega < $hoje))
                <span class="label label-danger" data-toggle="tooltip" data-placement="top" title="Data de Entrega (Atrasado)">{{Carbon\Carbon::parse($recebida->entrega)->format('d/m/Y')}}</span>
                @endif


                {{-- Variaveis Anexos e Comentarios --}}
                @php

                     $anexoscount = DB::table('arquivo__tarefas')
                    ->where('tarefas_id', '=', $recebida->id)
                    ->count();

                    $comentarioscount = DB::table('comentarios')
                    ->where('tarefas_id', '=', $recebida->id)
                    ->count();

                @endphp
                
                {{-- Resposável --}}    

                <span class="label label-warning" data-toggle="tooltip" data-placement="top" title="Responsável">{{request()->is('painel/tarefas/kanban/recebidas/*') ? $recebida->name : $recebida->destino }}</span>

                <br>
                {{-- Anexos --}}
                <span class="label label-default" data-toggle="tooltip" data-placement="top" title="Anexos">
                <a href="/painel/tarefas/{{ $recebida->id}}/anexos">
                <span class="glyphicon glyphicon-paperclip" aria-hidden="true" ><b style="padding-left: 2px;">{{$anexoscount}}</b></span>
                </a>
                </span>
                 
                
                {{-- Comentários --}}
                <span style="margin-left: 4px;" class="label label-default" data-toggle="tooltip" data-placement="top" title="Comentários">
                <a href="/painel/tarefas/comentarios/{{ $recebida->id}}">
                  <span class="glyphicon glyphicon-comment" aria-hidden="true"><b style="padding-left: 2px;">{{$comentarioscount}}</b></span></a>
                </span>

                {{-- Histórico --}}
                <span style="margin-left: 4px;" class="label label-default" data-toggle="tooltip" data-placement="top" title="Histórico">
                <a href="/painel/tarefas/historico/{{ $recebida->id}}">
                  <span class="glyphicon glyphicon-list-alt" aria-hidden="true"><b style="padding-left: 2px;"></b></span></a>
                </span>

             </div>
             @endforeach


        </div>
      </div>

      <div class="board" id="board4">
        <header>Concluído ({{$concluidoCount}})</header>
        <div class="cards" id="b4">
            
             @foreach($concluido as $recebida)

            <div id="{{ $recebida->id}}"  criador = "{{ $recebida->idcriadopor}}" destino = "{{ $recebida->iddestino}}"  class="thumbnail card">


                {{-- Botão Editar --}}

           @if (strstr(url()->current(), 'recebidas'))

              @if($recebida->idcriadopor == $recebida->iddestino)
              
                  <span style="position: absolute; right: 33px; opacity: .8;" class="badge">
                  <a href="/painel/tarefas/edit/{{ $recebida->id}}/recebidas">
                  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></span>

                  <span style="position: absolute; right: 4px; opacity: .8;" class="badge">
                  <a href="/painel/tarefas/delete/{{ $recebida->id}}">
                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></span>
             @else

                <span style="position: absolute; right: 4px; opacity: .8;" class="badge">
                  <a href="/painel/tarefas/encaminhar/{{ $recebida->id}}">
                  <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span></a></span>

              @endif


           @elseif (strstr(url()->current(), 'enviadas'))

                <span style="position: absolute; right: 33px; opacity: .8;" class="badge">
                <a href="/painel/tarefas/edit/{{ $recebida->id}}/recebidas">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></span>

                <span style="position: absolute; right: 4px; opacity: .8;" class="badge">
                <a href="/painel/tarefas/delete/{{ $recebida->id}}">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></span>

           @endif


                <input type="hidden" id="criador"  value="{{ $recebida->idcriadopor}}">
                <input type="hidden" id="destino"  value="{{ $recebida->iddestino}}">

                @php
                  $imgurltag="";
                  $imgAnexo = DB::table('arquivo__tarefas')
                    ->select('arquivos_id')
                    ->where('tarefas_id', '=', $recebida->id)
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
                      <a href="/painel/tarefas/{{ $recebida->id}}/anexos">
                      <img src={{$imgurltag}}>
                      </a>
                     
                @php
                      }
                }
                }
                @endphp

                  <h4>{{$recebida->nome}}</h4>

                {{-- Data de Prioridade --}}
                @switch($recebida->prioridade)
                    @case('Baixa')
                        <span class="label label-success" data-toggle="tooltip" data-placement="top" title="Prioridade">{{$recebida->prioridade}}</span>
                        @break

                    @case('Normal')
                        <span class="label label-info" data-toggle="tooltip" data-placement="top" title="Prioridade">{{$recebida->prioridade}}</span>
                        @break
                    
                    @case('Alta')
                        <span class="label label-danger" data-toggle="tooltip" data-placement="top" title="Prioridade">{{$recebida->prioridade}}</span>
                        @break

                @endswitch


                {{-- Data de Entrega --}}   
                @if((!is_null($recebida->entrega))and($recebida->entrega > $hoje))
                <span class="label label-primary" data-toggle="tooltip" data-placement="top" title="Data de Entrega">{{Carbon\Carbon::parse($recebida->entrega)->format('d/m/Y')}}</span>
                @elseif ((!is_null($recebida->entrega))and($recebida->entrega < $hoje))
                <span class="label label-danger" data-toggle="tooltip" data-placement="top" title="Data de Entrega (Atrasado)">{{Carbon\Carbon::parse($recebida->entrega)->format('d/m/Y')}}</span>
                @endif


                {{-- Variaveis Anexos e Comentarios --}}
                @php

                     $anexoscount = DB::table('arquivo__tarefas')
                    ->where('tarefas_id', '=', $recebida->id)
                    ->count();

                    $comentarioscount = DB::table('comentarios')
                    ->where('tarefas_id', '=', $recebida->id)
                    ->count();

                @endphp
                
                {{-- Resposável --}} 

                <span class="label label-warning" data-toggle="tooltip" data-placement="top" title="Responsável">{{request()->is('painel/tarefas/kanban/recebidas/*') ? $recebida->name : $recebida->destino }}</span>
              
                <br>
                {{-- Anexos --}}
                <span class="label label-default" data-toggle="tooltip" data-placement="top" title="Anexos">
                <a href="/painel/tarefas/{{ $recebida->id}}/anexos">
                <span class="glyphicon glyphicon-paperclip" aria-hidden="true" ><b style="padding-left: 2px;">{{$anexoscount}}</b></span>
                </a>
                </span>
                 
                
                {{-- Comentários --}}
                <span style="margin-left: 4px;" class="label label-default" data-toggle="tooltip" data-placement="top" title="Comentários">
                <a href="/painel/tarefas/comentarios/{{ $recebida->id}}">
                  <span class="glyphicon glyphicon-comment" aria-hidden="true"><b style="padding-left: 2px;">{{$comentarioscount}}</b></span></a>
                </span>

                {{-- Histórico --}}
                <span style="margin-left: 4px;" class="label label-default" data-toggle="tooltip" data-placement="top" title="Histórico">
                <a href="/painel/tarefas/historico/{{ $recebida->id}}">
                  <span class="glyphicon glyphicon-list-alt" aria-hidden="true"><b style="padding-left: 2px;"></b></span></a>
                </span>

             </div>
             @endforeach

        </div>
      </div>
  
    </div>
  </div>
</div>
  <script src='/dragula/dist/dragula.js'></script>

@if (strstr(url()->current(), 'recebidas'))
<script src='/dragula/example/recebidas.js'></script>
@elseif (strstr(url()->current(), 'enviadas'))
<script src='/dragula/example/enviadas.js'></script>
@endif


{{--   <script src='/dragula/example/alexandre.js'></script> --}}
  {{-- <script src='/dragula/example/example.min.js'></script>
 --}}
@stop