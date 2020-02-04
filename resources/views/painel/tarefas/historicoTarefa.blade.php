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


            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
            <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <script type="text/javascript">
				$(document).ready( function () {
				$('#table_id').DataTable({

			 "order": [[ 2, "desc" ]],
          
           "language": {
					"sEmptyTable": "Nenhum registro encontrado",
					"sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
					"sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
					"sInfoFiltered": "(Filtrados de _MAX_ registros)",
					"sInfoPostFix": "",
					"sInfoThousands": ".",
					"sLengthMenu": "_MENU_ resultados por página",
					"sLoadingRecords": "Carregando...",
					"sProcessing": "Processando...",
					"sZeroRecords": "Nenhum registro encontrado",
					"sSearch": "Pesquisar",
					"oPaginate": {
						"sNext": "Próximo",
						"sPrevious": "Anterior",
						"sFirst": "Primeiro",
						"sLast": "Último"
					  },
					"oAria": {
						"sSortAscending": ": Ordenar colunas de forma ascendente",
						"sSortDescending": ": Ordenar colunas de forma descendente"
					  }
					}
				}); } );
  </script>
  <style type="text/css">
  	img{
	  max-width: 200px;
  	}

  	iframe{
  		max-width: 200px;
  		max-height: 100px;
  		padding-bottom: 0%;
  		padding-top: 0px;
  	}

  	div.youtube-embed-wrapper{

  		padding-bottom: 0%;
  		padding-top: 0px;

  	}
  	
  	.youtube-embed-wrapper{
  		max-width: 200px;
  		max-height: 100px;
  		padding-bottom: 0%;
  		padding-top: 0px;
  	}
  </style>

  <div class="box box-info">
    <a style="margin-top: 5px; margin-bottom: 5px; margin-right: 10px;" class="btn btn-primary pull-right" href="javascript:history.back()"> Voltar</a>
    <!-- /.box-header -->

    <div class="box-body">
    
    
            <table id="table_id" class="display">
              <thead>
                <tr>
                  <th>Ação</th>
                  <th>Usuário</th>  
                  <th>Data</th>
                  <th>Detalhe</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($historicodatarefa as $historico)
                <tr>
                  <th>
                  	@switch($historico->description)
				    @case('created')
				        Criado
				        @break
				    @case('updated')
				        Atualizado
				        @break
					@endswitch


                  </th>

                  @php

                    $nome = DB::table('users')
                    ->where('id','=', $historico->causer_id)
                    ->select('name')
                    ->get();
                  @endphp

                  <th>
                  @foreach($nome as $n)
                  {{$n->name}}
                  @endforeach  
                  </th>

                  <th>{{$historico->created_at->format('d/m/Y H:i:s')}}</th>
                <th>

                	@php

                	$jsonObj = json_decode($historico->properties);
                	
                	if (isset($jsonObj->attributes->nome)) {
 						echo " Nome:<em> ". $jsonObj->attributes->nome."</em>; ";
					}

					if (isset($jsonObj->attributes->descricao)) {
 						echo " Descrição:<em> ". $jsonObj->attributes->descricao."</em>; ";
					}
					if (isset($jsonObj->attributes->entrega)) {
 						echo " Entrega:<em> ".date('d/m/Y', strtotime($jsonObj->attributes->entrega))."</em>;";
					}
					if (isset($jsonObj->attributes->anexo)) {
 						echo " Anexo:<em> ".$jsonObj->attributes->anexo."</em>;";
					}
					if (isset($jsonObj->attributes->prioridade)) {
 						echo " Prioridade:<em> ".$jsonObj->attributes->prioridade."</em>;";
					}
					if (isset($jsonObj->attributes->status)) {
 						echo " Status:<em> ".$jsonObj->attributes->status."</em>;";
					}
					if (isset($jsonObj->attributes->iddestino)) {
 						//echo " Destino:<em> ".$jsonObj->attributes->iddestino."</em>;";
 						
 						$nome = DB::table('users')
                    	->where('id','=', $jsonObj->attributes->iddestino)
                    	->select('name')
                    	->get();
                    	
                    	$destinoNome = json_decode($nome, TRUE);
                    	//var_dump($destinoNome);
                    	//dd($nome);
                    	echo " Destino:<em> ".$destinoNome[0]['name']."</em>;";
					}
					
					if (isset($jsonObj->attributes->arquivos_id)) {

 						$arquivos = DB::table('arquivos')
                    	->where('id','=', $jsonObj->attributes->arquivos_id)
                    	->get();

                    	$arquivo = json_decode($arquivos, TRUE);

 						echo " Anexos:<em> ".$arquivo[0]['nome']."</em>; ";
 						$linkantes="<a href=/painel/tarefas/";
 						$linkdepois = "/anexos>Abrir</a>";
 						echo $linkantes.$jsonObj->attributes->tarefas_id.$linkdepois;
 						//echo "<a href='/painel/tarefas/25/anexos'>Abrir</a>";
                	
					}

					if (isset($jsonObj->attributes->comentario)) {
 						echo " Comentário:<em>".$jsonObj->attributes->comentario."</em>";
					}

                	@endphp

                </th>
                </tr>
                @endforeach
              </tbody>
              
            </table>
    </div>
                          

<srcipt src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>

@stop