
    
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



    

    <div class="col-md-12">
        <div class="modal fade pg-show-modal" id="adicionaranexo" tabindex="-1" role="dialog" aria-hidden="true"> 
          <div class="modal-dialog"> 
            <div class="modal-content"> 
              <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                                     

                <h4 class="modal-title">Adicionar Anexo</h4> 
              </div>                                 

              <div class="modal-body">
              {!! csrf_field () !!}
              
                  <div class="form-group">
                        <div class="file-loading">
                            <input id="file-1" type="file" name="file" multiple class="file" data-overwrite-initial="any">
                        </div>
                    </div>

                    
              </div>  
          </div>
        </div>                                                 
    </div>
  </div>    


<script type="text/javascript">
        $("#file-1").fileinput({
            theme: 'fa',
            uploadUrl: "/painel/tarefas/adicionaranexos/",
            uploadExtraData: function() {
                return {
                    _token: $("input[name='_token']").val(),
                };
            },
            allowedFileExtensions: ['jpg', 'png', 'gif','doc','docx'],
            overwriteInitial: false,
            maxFileSize:2000,
            maxFilesNum: 10,
            slugCallback: function (filename) {
                return filename.replace('(', '_').replace(']', '_');
            }
        });
    </script>