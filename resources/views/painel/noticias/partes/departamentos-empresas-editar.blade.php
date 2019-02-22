
<!-- Scripts e CSS do JStree -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/themes/default/style.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/jstree.min.js"></script>


<?php
//$noticias_restore = $value2;
$noticias_restore = json_encode($value3);
//$departamento_restore = $usuario->departamento_id."D";

//var_dump($noticias_restore);
//var_dump($tree);

?>

<div class="col-md-4">
  <div class="box box-info">
    @role('Admin')
      <div class="box-body">
      <p style="text-align: left;" class="control-label text-left"> <b>Departamentos</b> </p> 
       <input type="hidden" value="{{$noticias_restore}}" name="resultado1" id="resultado1" required="">
       <input type="hidden" value="" name="resultado2" id="resultado2" required="">
      <div id="tree">
        sdasd
      </div>  
    <div id="resultado">
     
    </div>       
      </div>
    @endrole
      <div class="box-footer">
        {!! Form::submit('Editar Notícia', ['class' => 'btn btn-primary']); !!}
      </div>
  </div>






</div>




<script type="text/javascript">
//var variavel = "<?php echo $noticias_restore; ?>";
//$('input[name=resultado1]').val($noticias_restore);

$('#tree').jstree({  "checkbox" : {
      "keep_selected_style" : false
    },
    //"state": { "key":"2D"},
    "plugins": ["checkbox"],
    "core" : {
      "expand_selected_onload" :false, 
      //"check_callback": true, 
    "data" : [
       {!!$tree!!}
    ]
} }).bind("loaded.jstree", function(event, data) { 
    data.instance.open_all();
  });



$('#tree').on('loaded.jstree', treeLoaded);

function treeLoaded(event, data) {
    data.instance.select_node({!!$noticias_restore!!}); //node ids that you want to check
};





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
    
  });

//$('#tree').on('select_node.jstree',"2D");
   // $('#tree').jstree('open_all');


 /* $('#tree')
   .on('restore_state.jstree', function () {
         $('#tree').on('select_node.jstree', function (e, data) {
                 var href = data.node.a_attr.href;
                 document.location.href = href;
         });
     });*/

  
// create the instance
 // .tree();

/*if (localStorage.getItem('r')){
  $('#resultado').html(localStorage.getItem('r'));

}*/

</script>

