@extends('site.layout')


@section('L1C1')


@if(Auth::user()->arquivo_id==Null)
  <img class="img-fluid mx-auto d-block" src="{{$avatar->dirname}}/{{$avatar->basename}}">
@else
  <img src="{{Auth::user()->arquivo->url}}" class=" img-fluid rounded-circle mx-auto d-block" alt="User Image">
@endif




<h4 class="text-center">Olá, {{$usuario}}</h4>
<div  style="background-color: #929292; padding-bottom: 1px;padding-top: 5px;color: #fff; margin-top:57px;">
<h5 class="text-center">Seus Documentos</h5>
</div>
<div style="background-color: #d5d5d5; margin-top: 10px; margin-bottom: 10px; padding-bottom: 5px;">
<ul style="list-style-type:none; margin:0px; padding: 0px; font-size: small;">
  <li > <a style="margin:0px; color: black; padding-bottom: 0" class="nav-link" href="#">Formulário de Horas</a></li>
  <li> <a style="margin:0px; color: black; padding-bottom: 0" class="nav-link" href="#">Pedido de Horas</a></li>
  <li><a style="margin:0px; color: black; padding-bottom: 0" class="nav-link" href="#">RCMS</a></li>
</ul>
</div>
@stop

@section('L1C2')

  <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-bottom: 10px;">
    
    <div class="carousel-inner" role="listbox">
                    <?php
                    $contador=0;
                    if (count($urls_banners)==1) {
                    ?>  
                      <div class="item active">
                          <img src= <?php echo json_encode($urls_banners[0],  JSON_UNESCAPED_SLASHES); ?> width="1000" height="250"  data-holder-rendered="true">
                      </div>
                    <?php
                    }else{
                      foreach ($urls_banners as $url) {
                      $contador=$contador+1;
                        if ($contador==1) {
                    ?>
                        <div class="item active">
                          <img src= <?php echo json_encode($url,  JSON_UNESCAPED_SLASHES); ?> width="1000" height="250"  data-holder-rendered="true">
                        </div>
                    <?php
                        }else{
                    ?>
                          <div class="item">
                          <img src= <?php echo json_encode($url,  JSON_UNESCAPED_SLASHES); ?> width="1000" height="250"  data-holder-rendered="true">
                        </div>
                    <?php
                        }
                      }
                    }
                    ?>

                  </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>


{{-- TAREFAS --}}


<div  style="background-color: #929292; padding-bottom: 1px;padding-top: 5px;color: #fff; margin-top: 0px; margin-bottom: 20px;">
<h5 style="padding-left: 5px;">Suas Tarefas</h5>
</div>

@include('painel.tarefas.partes.menuHorizontalSite')

@include('painel.tarefas.partes.resumoSite')

@include('painel.tarefas.partes.listaSite')

@stop

@section('L1C3')  
<div  style="background-color: #929292; padding-bottom: 1px;padding-top: 5px;color: #fff">
<h5 class="text-center">Suas Notícias</h5>
</div>
<ul class="list-unstyled text-justify"> @forelse ($noticiasdousuario as $noticias)
<li style="font-size: small; text-align: left; color: #809ea9;">
  {!!$noticias->noticia!!}
</li> 
<hr style="margin: 0; padding:0"> 
@empty
<p> Nenhuma Noticia Cadastrada </p> @endforelse </ul>
@stop


@section('L2C1')

@stop

@section('L2C2')

@stop

@section('L2C3')

@stop
