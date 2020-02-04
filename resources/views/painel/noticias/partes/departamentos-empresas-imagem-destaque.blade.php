<div class="col-md-4">
  <div class="box box-info">
    @role('Admin|AdminSetor')
      <div class="box-body">
    
        <p style="text-align: left;" class="control-label text-left"> <b>Imagem Destaque</b> </p>
        


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <style type="text/css">
          input[type='file'] {
          display: none
          }
        </style>
          <label class="btn btn-primary" for='imgInp'>Selecionar um arquivo</label>
          <input type='file' id="imgInp" name="file"/>
          <img class="img-responsive" id="blah" src="#" alt=" miniatura da sua imagem" style="margin-top: 10px" />
        

      </div>
    @endrole

      <script>
      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
          }
            reader.readAsDataURL(input.files[0]);
        }
      }

      $("#imgInp").change(function() {
          readURL(this);
      });
      
      </script>


     </div>
</div>