@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Painel
        
      </h1>
      <ol class="breadcrumb">
        <li class="active">Painel</li>
        
      </ol>
    </section>
@stop


@section('content')

<div class="row">

  @if( Auth::user()-> hasRole ( 'Admin' ))


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5</font></font></h3>

              <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Novas Notícias</font></font></p>
            </div>
            <div class="icon">
              <i class="fa fa-newspaper-o"></i>
            </div>
            <a href="#" class="small-box-footer"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
              Mais informações </font></font><i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">9 </font></font><sup style="font-size: 20px"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></sup></h3>

              <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Novas Tarefas</font></font></p>
            </div>
            <div class="icon">
              <i class="fa fa-flag-o"></i>
            </div>
            <a href="#" class="small-box-footer"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
              Mais informações </font></font><i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4</font></font></h3>

              <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Novas Mensagens</font></font></p>
            </div>
            <div class="icon">
              <i class="fa fa-envelope-o"></i>
            </div>
            <a href="#" class="small-box-footer"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
              Mais informações </font></font><i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5</font></font></h3>

              <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Novas Pesquisas</font></font></p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
              Mais informações </font></font><i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
  @endif
@if( Auth::user()-> hasRole ( 'User|AdminSetor' ))


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$noticiastotal}} </font></font></h3>

              <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Notícias</font></font></p>
            </div>
            <div class="icon">
              <i class="fa fa-newspaper-o"></i>
            </div>
            <a href="{{ route('painel.noticias.index') }}" class="small-box-footer"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
              Mais informações </font></font><i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$tarefastotal}} </font></font><sup style="font-size: 20px"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></sup></h3>

              <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tarefas</font></font></p>
            </div>
            <div class="icon">
              <i class="fa fa-flag-o"></i>
            </div>
            <a href="{{ route('painel.tarefas.recebidasTodas') }}" class="small-box-footer"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
              Mais informações </font></font><i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$bannerstotal}}</font></font></h3>

              <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Banners</font></font></p>
            </div>
            <div class="icon">
              <i class="fa fa-picture-o"></i>
            </div>
            <a href="{{ route('painel.banners.index') }}" class="small-box-footer"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
              Mais informações </font></font><i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
  @endif

@stop