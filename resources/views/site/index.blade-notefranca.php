@extends('site.layout')


@section('L1C1')

<img class="img-fluid mx-auto d-block" src="{{$avatar->dirname}}/{{$avatar->basename}}">
<h4 class="text-center">Olá, {{$usuario}}</h4>
<div  style="background-color: #929292; padding-bottom: 1px;padding-top: 5px;color: #fff; margin-top:35px;">
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
<div class="carousel slide" data-ride="carousel" stile="padding-top=-10" id="carousel1">
                  <div class="carousel-inner" role="listbox">
                    <div class="carousel-item">
                      <img src="{{$banner1->dirname}}/{{$banner1->basename}}" class="img-fluid" atl="first slide">
                    </div>
                    <div class="carousel-item active">
                      <img src="{{$banner2->dirname}}/{{$banner2->basename}}" class="img-fluid"  data-holder-rendered="true">
                    </div>
                    <div class="carousel-item">
                      <img src="{{$banner3->dirname}}/{{$banner3->basename}}" class="img-fluid" data-holder-rendered="true">
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carousel1" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
                  <a class="carousel-control-next" href="#carousel1" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
</div>
<div  style="background-color: #929292; padding-bottom: 1px;padding-top: 5px;color: #fff; margin-top: 10px; margin-bottom: 10px;">
<h5 style="padding-left: 5px;">Suas Tarefas</h5>
</div>

<div class="container">

<div  class="row">
  <div class="col-7">
    <p style="margin-bottom: 2px;">Criação da Identidade Visual Projeto Palco</p>
  </div>
  <div style="margin-right: 3px;" class="col-2">
    24.03.2018
  </div>
  <div class="col">
    <div style="margin-top: 4px" class="progress">
      <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> 50%</div>
    </div>
  </div>
</div>


<div  class="row">
  <div class="col-7">
    <p style="margin-bottom: 2px;">Banners Evento 70 Anos</p>
  </div>
  <div style="margin-right: 3px;" class="col-2">
    28.03.2018
  </div>
  <div class="col">
    <div style="margin-top: 4px" class="progress">
      <div class="progress-bar" role="progressbar" style="width: 30%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> 30%</div>
    </div>
  </div>
</div>


<div  class="row">
  <div class="col-7">
    <p style="margin-bottom: 2px;">Revista Fecomércio #20</p>
  </div>
  <div style="margin-right: 3px;" class="col-2">
    21.03.2018
  </div>
  <div class="col">
    <div style="margin-top: 4px" class="progress">
      <div class="progress-bar bg-danger" role="progressbar" style="width: 80%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> 80%</div>
    </div>
  </div>
</div>


<div  class="row">
  <div class="col-7">
    <p style="margin-bottom: 2px;">Capa Livro 70 Anos</p>
  </div>
  <div style="margin-right: 3px;" class="col-2">
    01.04.2018
  </div>
  <div class="col">
    <div style="margin-top: 4px" class="progress">
      <div class="progress-bar bg-warning" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> 0%</div>
    </div>
  </div>
</div>


<div  class="row">
  <div class="col-7">
    <p style="margin-bottom: 2px;">Painéis Senac Móvel</p>
  </div>
  <div style="margin-right: 3px;" class="col-2">
    01.04.2018
  </div>
  <div class="col">
    <div style="margin-top: 4px" class="progress">
      <div class="progress-bar" role="progressbar" style="width: 10%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> 10%</div>
    </div>
  </div>
</div>


<div  class="row">
  <div class="col-7">
    <p style="margin-bottom: 2px;">Painéis Sesc Atalaia</p>
  </div>
  <div style="margin-right: 3px;" class="col-2">
    20.03.2018
  </div>
  <div class="col">
    <div style="margin-top: 4px" class="progress">
      <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> 100%</div>
    </div>
  </div>
</div>



</div>

@stop

@section('L1C3')  
<div  style="background-color: #929292; padding-bottom: 1px;padding-top: 5px;color: #fff">
<h5 class="text-center">Suas Notícias</h5>
</div>
<ul class="list-unstyled text-justify"> @forelse ($noticiasdousuario as $noticias)
<li style="font-size: small; text-align: left; color: #809ea9;">
  <a class="nav-link" href=" {{$noticias->url}} " target="_blank">{{$noticias->titulo}}</a>
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
