@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Banners
        <small> - Cadastrar Banners</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li><a href={{ route('painel.banners.index') }}><i class="fa fa-picture-o"></i> Banners</a></li>
        <li class="active">Cadastrar Banner</li>
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


<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">

{!! Form::open(['route' => 'painel.empresas.store','method' => 'POST','class'=>'form-horizontal']) !!}
<div style="float: left;" class="col-md-8">
  <div class="box box-info">
              <div class="box-body">
                
                {!! Form::label('titulo', 'Título', array('class' => 'control-label' )) !!}
                <div class="form-group">
                  <div class="col-sm-12">
                    {!! Form::text('titulo', '', ['placeholder' => 'Título do Banner','class' => 'form-control', 'required']) !!}
                  </div>
                </div>
              </div>
</div>
</div>

<!-- INcluir o JStree aqui -->
@include('painel.empresas.partes.empresas')

{!! Form::close() !!}



{{-- <script type="text/javascript">
  new Dropzone('.dropzone',{

      url: '/painel/banners/create',
      dictDefaultMessage:'Arrastar as fotos para aqui.',
      headers:{
        'X-CSRF-TOKEN':'{{csrf_token()}}'
      }

  });

  Dropzone.autoDiscover=false;
</script>
 --}}

 <style type="text/css">
   html, body {
    height: 100%;
    }
    #actions {
    margin: 2em 0;
    }
    /* Mimic table appearance */
    div.table {
    display: table;
    }
    div.table .file-row {
    display: table-row;
    }
    div.table .file-row > div {
    display: table-cell;
    vertical-align: top;
    border-top: 1px solid #ddd;
    padding: 8px;
    }
    div.table .file-row:nth-child(odd) {
    background: #f9f9f9;
    }
    /* The total progress gets shown by event listeners */
    #total-progress {
    opacity: 0;
    transition: opacity 0.3s linear;
    }
    /* Hide the progress bar when finished */
    #previews .file-row.dz-success .progress {
    opacity: 0;
    transition: opacity 0.3s linear;
    }
    /* Hide the delete button initially */
    #previews .file-row .delete {
    display: none;
    }
    /* Hide the start and cancel buttons and show the delete button */
    #previews .file-row.dz-success .start,
    #previews .file-row.dz-success .cancel {
    display: none;
    }
    #previews .file-row.dz-success .delete {
    display: block;
    }
 </style>


<div id="actions" class="row">


      <div class="col-lg-7">
        <!-- The fileinput-button span is used to style the file input field as button -->
      <div id="inserir" style="display: block;">
      <span class="btn btn-success fileinput-button" name="image">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Add files...</span>
      </span>
      </div>
      </div>

      <div class="col-lg-5">
        <!-- The global file processing state -->
      <span class="fileupload-process">
        <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
        </div>
      </span>
      </div>
    </div>


    <div class="table table-striped files" id="previews">
      <div id="template" class="file-row">
        <!-- This is used as the file preview template -->
        <div>
          <span class="preview"><img name="image" data-dz-thumbnail /></span>
        </div>
        <div>
          <p class="name" data-dz-name></p>
          <strong class="error text-danger" data-dz-errormessage></strong>
        </div>


        <div>
          <p class="name" data-dz-remove></p>
          <strong class="error text-danger" data-dz-errormessage></strong>
        </div>



        <div>
          <p class="size" data-dz-size></p>
          <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
          </div>
        </div>
        <div>
          <button class="btn btn-primary start">
            <i class="glyphicon glyphicon-upload"></i>
            <span>Start</span>
          </button>

          
          {{-- {!! Form::open(['route' => 'painel.banners.destroy','method' => 'delete','class'=>'form-horizontal']) !!}
          @isset($photoUrl)
          {{"Cheio"}} 
          @endisset

          @empty($photoUrl)
           {{"Vazio"}}
          @endempty --}}
          
          {!! Form::hidden('photoUrl', '$photoUrl') !!}
          
          <button data-dz-remove class="btn btn-warning cancel" onclick="exibirBtnInserir();">
            <i class="glyphicon glyphicon-ban-circle"></i>
            <span>Cancel</span>
          </button>
          
          <input class="btn btn-primary start" type="submit" value="Submit">
          
          {!! Form::close() !!}

          <button data-dz-remove class="btn btn-danger delete">
            <i class="glyphicon glyphicon-trash"></i>
            <span>Delete</span>
          </button>

        </div>
      </div>
</div>








<script type="text/javascript">
  
// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template");
  previewNode.id = "";
  var previewTemplate = previewNode.parentNode.innerHTML;
  previewNode.parentNode.removeChild(previewNode);

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: '/painel/banners/create', // Set the url
    paramName: "file",

    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    addRemoveLinks: true,
    previewTemplate: previewTemplate,
    maxFilesize: 2,
    autoQueue: true, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
    headers:{
        'X-CSRF-TOKEN':'{{csrf_token()}}'
      }
  });
  
  myDropzone.on("addedfile", function(file) {
      //Esconder o Botão Inserir
      document.getElementById("inserir").style.display="none";

      // Hookup the start button
      file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
  });


  function exibirBtnInserir()
    {
        document.getElementById("inserir").style.display="block";
        
    }



myDropzone.on("removedfile", function(file) {
 
 
 document.getElementById("inserir").style.display="block";
 
 

 //console.log(photoUrl);
 //alert($photoUrl);   

});




  
  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
  });
  
  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1";
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
  });
  
  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0";
  });
  
  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
  };
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true);
  };

</script>

@stop