


<div class="col-md-4">
  <div class="box box-info">
    @role('Admin|AdminSetor')
      <div class="box-body">
    
      <p style="text-align: left;" class="control-label text-left"> <b>Imagem Destaque</b> </p> 
       
      </div>
    @endrole

      <div class="box-footer">
        



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
          
          {{--  {!! Form::close() !!} --}} 

          <button data-dz-remove class="btn btn-danger delete">
            <i class="glyphicon glyphicon-trash"></i>
            <span>Delete</span>
          </button>

        </div>
      </div>
  </div>
</div>
{{-- FIM Inicio Imagem com Dropbox --}}







  {{-- Informações do Usuário --}}
    <div class="col-md-2 col-lg-2">
      <div class="profile-sidebar text-center">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic">
                    
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
          <div class="profile-usertitle text-center">
            <div class="profile-usertitle-name">
            </div>
              <div class="profile-usertitle-job">
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
          <span>Adicionar Imagem</span>
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
      </div>
  </div>
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
    parallelUploads: 1,
    uploadMultiple:false,
    maxFiles:1,
    addRemoveLinks: true,
    acceptedFiles: "image/jpeg,image/png",
    previewTemplate: previewTemplate,
    maxFilesize: 1,
    dictFileTooBig:'O arquivo é muito grande. Reenvie outro arquivo com o Tamanho Máximo de 5Mb.',
    dictMaxFilesExceeded:'Somente uma imagem de destaque será enviada.',
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.

    init: function(){   // inicio da função do botão
            var submitButton = document.querySelector('#submit-all'); //aqui entra o id do botão que criamos
            myDropzone = this;
            submitButton.addEventListener("click",function(){ // quando clicar ele envia
                myDropzone.processQueue(); // processo de enviar
            });

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