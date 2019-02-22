@extends('painel.layout')

@section('header')

<section class="content-header">
      <h1>
        Banners
        <small> - Listagem de Banners</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li class="active">Banners</li>
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


<div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Banners para o Usuário</h3>
              
             {{--  <a href="{{ route('painel.banners.create') }}" class="btn btn-primary pull-right" role="button"><i class="fa fa-plus"></i> Adicionar Banner</a> --}}
            </div>









<div id="actions">

      <div class="col-lg-5">
        <!-- The global file processing state -->
      <span class="fileupload-process">
        <div style="background-color: #ffffff;" id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
        </div>
      </span>
      </div>

      <div class="col-lg-7">
        <!-- The fileinput-button span is used to style the file input field as button -->
      <div id="inserir" style="display: block;">
      <span class="btn btn-primary pull-right fileinput-button" name="image">
        <i class="fa fa-plus"></i>
        <span>Adicionar Banner</span>
      </span>
      </div>
      </div>

      
</div>

<div style="display: none;">
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
</div>



            <!-- /.box-header -->
            <div class="box-body">
              <table id="noticias" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Título</th>
                  <th>Imagem</th>
                  <th>Publicado?</th>
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                                    
                @foreach($bannersdousuario as $banner)
                	<tr>
                		<td>{{ $banner -> titulo}}</td>
                    <td><img src="{{ $banner->arquivo->url}}" alt="{{ $banner -> titulo}}" height="50" width="50"></td>
                		<!-- <td>{{ $banner -> departamento_id}}</td> -->
                		<td> {{ $banner -> publicado}} </td>
                    <td>
                		

                      <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i> </button>

                      <!-- Modal -->
                      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel">Editar o Título</h4>
                            </div>
                            <div class="modal-body">
                                {!! Form::open(['route' =>['painel.banners.updade',$banner->id],'method' => 'PUT','class'=>'form-horizontal']) !!}

                                  <div style="width: 100%" class="form-group">
                                    <input style="width: 100%" type="text" class="form-control" name="titulonovo" id="titulonovo" value="{{ $banner -> titulo}}">
                                  </div>

                                  <input type="hidden" name="id" value="{{ $banner -> id}}">

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

                              <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
</div>
                              {!! Form::close() !!}
                        </div>
                      </div>


                      @if($banner -> publicado =='N')
                          
                          <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#ModalPublicar" title="Distribuir"> Publicar </button>

                         
                        @else
                           
                          <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#ModalEditarPublicar" title="Distribuir"> Editar Publicação </button>

                          {!! Form::open(['action' => 'painel\bannerController@editarPublicar',$banner]) !!}
                          {!!Form::submit('Click Me!',['class' => 'btn btn-xs btn-success', 'data-toggle'=>'modal', 'data-target'=>'#ModalEditarPublicar'])!!}
                          {!! Form::close() !!}


                         


                
                        @endif
                           

                      
                    
                    


                     <form method="POST" action="/painel/banners/{{$banner->id}}" style="display: inline">
                       {{csrf_field()}} {{method_field('DELETE')}} 
                      <button class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Excluir"> <i class="fa fa-times"></i> </button>
                     </form> 



                      
                		</td>	
                    
                	</tr>	





<!-- Modal Publicar -->
                      <div class="modal fade" id="ModalPublicar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel">Publicar o Banner</h4>
                            </div>
                            <div style="padding:0; margin: 0" class="modal-body">
                              {!! Form::open(['route' =>['painel.banners.publicar',$banner->id],'method' => 'PUT','class'=>'form-horizontal']) !!}

                                <input type="hidden" value="" name="resultado2" id="resultado2" required="">

                                <input type="hidden" value="{{ $banner -> id}}" name="banner_id" id="banner_id" required="">

                                <!-- INcluir o JStree aqui -->
                                @include('painel.banners.partes.departamentos-empresas')     
                              {!! Form::close() !!}
                            </div>
                          </div>
                        </div>
                      </div>









<!-- Modal Editar Publicação -->
                      <div class="modal fade" id="ModalEditarPublicar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel"> Editar Publicação do Banner</h4>
                            </div>
                            <div style="padding:0; margin: 0" class="modal-body">
                              {!! Form::open(['route' =>['painel.banners.editarPublicar',$banner->id],'method' => 'PUT','class'=>'form-horizontal']) !!}
                                <!-- INcluir o JStree aqui -->
                                @include('painel.banners.partes.departamentos-empresas-editar')     
                              {!! Form::close() !!}
                            </div>
                          </div>
                        </div>
                      </div>












                @endforeach


                </tbody>
               </table>
            </div>
            <!-- /.box-body -->
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
    acceptedFiles: "image/jpeg,image/png",
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
      //document.getElementById("inserir").style.display="none";

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

</script>

@stop