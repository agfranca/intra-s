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


  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.2/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.2/js/plugins/piexif.min.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.2/js/plugins/sortable.min.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.2/js/plugins/purify.min.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.2/js/fileinput.min.js"></script>
<!-- following theme script is needed to use the Font Awesome 5.x theme (`fas`) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.2/themes/fas/theme.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.2/js/locales/pt-BR.js"></script>

<style type="text/css">
  .modal-content {
  height:500px;
  overflow:auto;
}
</style>





 
<div class="box box-info">
 <div class="box-body">

                  {!! csrf_field () !!}
              
               <div class="form-group">
                        <div class="file-loading">
                            <input id="file-1" type="file" name="file" multiple class="file" data-overwrite-initial="any">
                            <input type="hidden" id="idTarefa" name="idTarefa" value="10">

                        </div>
                    </div>
                    <button type="button" class="btn btn-aviso btn-modify pull-right" onclick="goBack()"><i class="glyphicon glyphicon-arrow-up"></i> Voltar</button>
                    {{-- <a class = "btn btn-aviso btn-modify pull-right" href="javascript:history.back()"> <i class="glyphicon glyphicon-arrow-up"></i> Voltar</a> --}}
  </div>

<?php print $iPreviewConfig;?>




</div>


<script type="text/javascript">

//Função Javascript que retorna a página anterior e atualiza. 
function goBack() {
    window.location.replace(document.referrer);
}



    
        $("#file-1").fileinput({
            theme: 'fa',
            uploadUrl: "/painel/tarefas/adicionaranexos",
            uploadExtraData: function() {
                var idTarefa = "<?php print $idTarefa; ?>";
                return {
                    _token: $("input[name='_token']").val(),
                    idTarefa,
                };
            },
            deleteExtraData: function() {
                return {
                    _token: $("input[name='_token']").val()
                };
            },
            allowedFileExtensions: ['jpg', 'png', 'gif','doc','pdf'],
            initialPreviewFileType: 'image',
            overwriteInitial: true,
            uploadAsync: true,
            maxFileSize:6000,
            maxFilesNum: 10,
            initialPreviewAsData: true,
            initialPreview:[<?php print $iPreview;?>],
            initialPreviewConfig:[<?php print $iPreviewConfig;?>],
            browseLabel: "Anexar Arquivo",
            removeLabel : "Excluir Todos",
            uploadLabel : "Enviar Todos" ,
            msgSelected : "{n} arquivos selecionados",    
            
        }); 


        $("#file-1").on ( 'filebatchuploadcomplete' , function ( ) {

            location.reload(true);

        });

       
        $("#file-1").on ( 'filedeleted' , function ( ) {

            location.reload(true);

        });

        
        
    
</script>




@stop