@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Perfil do Usuário
     </h1>
      <ol class="breadcrumb">
        <li class="active">Perfil</li>
      </ol>
</section>
@stop

@section('content')


{{-- Inicio Imagem com Dropbox --}}
<div >
    <div class="table table-striped files" id="previews">
      <div id="template" class="file-row">
        <!-- This is used as the file preview template -->
        <div>
          <span class="preview"><img name="image" data-dz-thumbnail /></span>
        </div>
        <div>
          <p class="name" data-dz-name></p> <strong class="error text-danger" data-dz-errormessage></strong>
        </div>

        <div style="display: none;">
          <p class="size" data-dz-size></p>
          <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
          </div>
        </div>
        <div style="display: none;">
          <button class="btn btn-primary start">
            <i class="glyphicon glyphicon-upload"></i>
            <span>Start</span>
          </button>

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
</div>
{{-- FIM Inicio Imagem com Dropbox --}}


{{-- Menssagens de ERRO e SUCESSO --}}

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
{{-- Menssagens de ERRO e SUCESSO --}}

{{-- Scripts e CSS --}}
      <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
      <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
{{-- Scripts e CSS --}}

<div class="box box-info">
{{-- box-info --}}
  <div class="box-header">
  {{-- box-header --}}

  {{-- Informações do Usuário --}}
    <div class="col-md-2 col-lg-2">
      <div class="profile-sidebar text-center">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic">
          
          @if(Auth::user()->arquivo_id==Null)
          <img src="/adminlte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
          @else
          <img src="{{Auth::user()->arquivo->url}}" width="160" height="160" class="img-circle" alt="User Image">
          @endif
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
          <div class="profile-usertitle text-center">
            <div class="profile-usertitle-name">
             {{ Auth::user()->name }}
            </div>
              <div class="profile-usertitle-job">
                <small> {{ Auth::user()->departamento->nome }}
                <b>{{ Auth::user()->departamento->empresa->nome }}</b></small>
                <br>
                <br>
              </div>
          </div>
              <!-- END SIDEBAR USER TITLE -->
              <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons text-center">
                
{{-- Imagem com Dropbox BOTÃO de INSERIR Imagem--}}

  <div id="actions">

    <div>
      <!-- The fileinput-button span is used to style the file input field as button -->
      <div id="inserir">
        <span class="btn btn-primary fileinput-button" name="image">
          <i class="fa fa-plus"></i>
          <span>Trocar Imagem</span>
        </span>
      </div>
    </div>

    <div class="col-md-2 col-lg-2">
      <!-- The global file processing state -->
      <span class="fileupload-process">
        <div style="background-color: #ffffff;" id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress>
          </div>
        </div>
      </span>
    </div>
    
</div>
{{-- Imagem com Dropbox BOTÃO de INSERIR Imagem--}}










                </div>
              <!-- END SIDEBAR BUTTONS -->
      </div>
    </div>
  
    <div class="col-md-10 col-lg-10">
      <div class="profile-content">
        <form class="form-horizontal">
          <fieldset>
            <!-- Text input-->
              <div  class="form-group">
                <label class="col-md-2 col-lg-2 control-label" for="textinput">Nome:</label>  
                  <div class="col-md-8 col-lg-8">
                    <input id="textinputnome" name="textinputname" type="text" placeholder="placeholder" class="form-control input-md" value="{{ Auth::user()->name}}">
                  </div>
              </div>

                <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-2 col-lg-2 control-label" for="textinput">E-mail:</label>  
                      <div class="col-md-8 col-lg-8">
                        <input id="textinputemail" name="textinputemail" type="text" placeholder="placeholder" class="form-control input-md" value="{{ Auth::user()->email }}">
                      </div>
                  </div>
                      <!-- Password input-->
                      <div class="form-group">
                        <label class="col-md-2 col-lg-2 control-label" for="passwordinput">Senha:</label>
                          <div class="col-md-8 col-lg-8">
                            <input id="passwordinput" name="passwordinput" type="password" placeholder="Digite nova Senha, caso deseje modificar." class="form-control input-md">
                          </div>
                      </div>

                        <!-- Button (Double) -->
                          <div class="form-group">
                            <div class="col-md-10 col-lg-10" >
                              <div class=text-right >
                                <button id="button1id" name="button1id" class="btn btn-success input-md">Salvar Modificações</button>
                              </div>
                            </div>
                          </div>

                        </fieldset>
                        </form>
      </div>
    </div>
  {{-- FIM Informações do Usuário --}}  
  {{-- box-header --}}  
  </div>
{{-- Fim do box-info --}} 
</div>



{{-- INICIO Java script imagem Dropbox --}}

<script type="text/javascript">


// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument

  var previewNode = document.querySelector("#template");
  previewNode.id = "";
  var previewTemplate = previewNode.parentNode.innerHTML;
  previewNode.parentNode.removeChild(previewNode);

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url:'/painel/perfil/update', // Set the url /painel/banners/create
    paramName: "file",
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    addRemoveLinks: false,
    acceptedFiles: "image/jpeg,image/png",
    previewTemplate: previewTemplate,
    maxFilesize: 1,
    dictFileTooBig:'O arquivo é muito grande. Reenvie outro arquivo com o Tamanho Máximo de 5Mb.',
    autoQueue: true, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
    headers:{
        'X-CSRF-TOKEN':'{{csrf_token()}}'
      }
  });

    
  myDropzone.on("addedfile", function(file) {

      file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
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
    window.location.reload();
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


  myDropzone.on("maxfilesexceeded", function(file) {
    alert("Imagem maior que o tamanho suportado 2MB, enviar imamgem menor.");
  });
</script>

{{-- INICIO Java script imagem Dropbox --}}
 
@stop