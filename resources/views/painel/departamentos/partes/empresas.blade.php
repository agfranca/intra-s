
<!-- Scripts e CSS do JStree -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/themes/default/style.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/jstree.min.js"></script>


<div class="col-md-4">
  <div class="box box-info">
      <div class="box-body">
      <p style="text-align: left;" class="control-label text-left"> <b>Subordinado a</b> </p> 
       <input type="hidden" value="" name="resultado2" id="resultado2" required="">
      <div id="tree">
        sdasd
      </div>  
    <div id="resultado">
     
    </div>       
      </div>

      <div class="box-footer">
        {!! Form::submit('Cadastrar Empresa', ['class' => 'btn btn-primary']); !!}
      </div>
  </div>
</div>



<script type="text/javascript">
$('#tree').jstree({  "checkbox" : {
      "keep_selected_style" : false
    },
    "plugins" : [ ],
    'core' : {
    'data' : [
       {!!$tree!!}
    ]
} }).bind("loaded.jstree", function(event, data) { 
    data.instance.open_all();
  });


   $('#tree')
  .on('changed.jstree', function (e, data) {
    var i, j, r = [];
    for(i = 0, j = data.selected.length; i < j; i++) {
      r.push(data.instance.get_node(data.selected[i]).id);
      //var id = data.selected[0].id
    }
    //$('#resultado').html(r);
    $('input[name=resultado2]').val(r);
    // window.localStorage.setItem('r', r);
    // var resultado = window.localStorage.getItem('r');
    
  })
// create the instance
 // .tree();

/*if (localStorage.getItem('r')){
  $('#resultado').html(localStorage.getItem('r'));

}*/

</script>

