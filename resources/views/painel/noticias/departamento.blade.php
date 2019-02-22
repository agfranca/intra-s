@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Notícias
        <small> - Listagem de Noticias</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Painel</a></li>
        <li class="active">Notícias</li>
      </ol>
    </section>
@stop

@section('content')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/themes/default/style.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/jstree.min.js"></script>

<div class="box">
  <div class="box-header">
    <h3 class="box-title">Notícias para o Usuário</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div id="tree">
    </div>
    <div id="result">
    </div>     
  </div>
  <!-- /.box-body -->
</div>


<script type="text/javascript">
$('#tree').jstree({  "checkbox" : {
      "keep_selected_style" : false
    },
    "plugins" : [ "checkbox" ],
    'core' : {
    'data' : [
       {!!$teste!!}
    ]


} });

</script>




@stop