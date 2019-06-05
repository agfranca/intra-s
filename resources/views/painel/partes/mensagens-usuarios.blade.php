@notify_css

@if(session()->has('errors'))

  <div class="alert alert-danger alert-dismissible fade in">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i> Atenção!</h4>
    <p>{{session('errors')}}</p>
  </div>

  @elseif(session()->has('sucess'))


  <div class="alert alert-success alert-dismissible fade in">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Atenção!</h4>
    <p>{{session('sucess')}}</p>
  </div>

@endif

<script type="text/javascript">

if (sessionStorage.getItem("sucess")) {

alert("OLA");

    setTimeout(function() {
      $(document).find(".alert").fadeOut(1000, function ()).remove();
    }, 3000);
    
  $(".alert").fadeOut(1000, function ());

}
</script>

@notify_js 
@notify_render


