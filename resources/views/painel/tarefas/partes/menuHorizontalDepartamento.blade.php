
  <div class="box-header" style="padding-bottom: 0px;">
{{-- XXXXXX Variaveis XXXXXXXX--}}
@php
use Carbon\Carbon;
$hoje = Carbon::today()->format('Y-m-d');
$urlhoje = "painel/tarefas/excluidas/filtro/".$hoje."/".$hoje;


$primeiroDiaDaSemana = Carbon::now()->startOfWeek()->subDays(1)->format('Y-m-d');
$ultimoDiaDaSemana = Carbon::now()->endOfWeek()->subDays(1)->format('Y-m-d');
$urlsemana = "painel/tarefas/excluidas/filtro/".$primeiroDiaDaSemana."/".$ultimoDiaDaSemana; 

$primeiroDiaDoMes = Carbon::now()->firstOfMonth()->format('Y-m-d');
$ultimoDiaDoMes = Carbon::now()->lastOfMonth()->format('Y-m-d');  
$urlmes = "painel/tarefas/excluidas/filtro/".$primeiroDiaDoMes."/".$ultimoDiaDoMes;
@endphp

{{-- XXXXXX FIM DAS Variaveis XXXXXXXX--}}

    {{-- XXXXXX LISTA XXXXXXXX--}}


    <div  id="filtroLista" style=" {{request()->is('painel/tarefas/lista*')?'display:""':'display: none;'}}"> 

   <a class="btn btn-primary pull-right" href={{route('painel.tarefas.create') }}> <i class="fa fa-plus"></i></a>



    <div class="text-left col-md-8">
      <div class="btn-group btn-group-sm" id="filtrotarefa" data-pg-name="filtrotarefa"> 
        <button type="button" class="btn btn-default {{request()->is('painel/tarefas/lista/recebidas/departamento*')?'active':''}}"> <a href={{ route('painel.tarefas.recebidasTodasDepartamento') }}>Recebidas</a></button>

        <button type="button" class="btn btn-default {{request()->is('painel/tarefas/lista/enviadas/departamento*')?'active':''}}"> <a href={{ route('painel.tarefas.enviadasTodasDepartamento') }}>Enviadas</a></button>

{{-- 
        <button type="button" class="btn btn-default {{request()->is('painel/tarefas/excluidas*')?'active':''}}"> <a href={{ route('painel.tarefas.exibirTarefasApagadasTodas') }}>Apagadas</a></button>

 --}}
        
    </div>

      <div class="btn-group btn-group-xs" id="filtrotemporecebidas" data-pg-name="filtrotarefa2" style=" {{request()->is('painel/tarefas/lista/recebidas/departamento*')?'display:""':'display: none;'}}"> 
            
            <button type="button" class="btn btn-default {{request()->is('painel/tarefas/lista/recebidas/departamento/hoje*')?'active':''}}"> <a href={{ route('painel.tarefas.recebidasHojeDepartamento') }}>Hoje</a></button>

            <button type="button" class="btn btn-default {{request()->is('painel/tarefas/lista/recebidas/departamento/estasemana*')?'active':''}}"> <a href={{ route('painel.tarefas.recebidasEstaSemanaDepartamento') }}>Esta Semana</a></button>

            <button type="button" class="btn btn-default  {{request()->is('painel/tarefas/lista/recebidas/departamento/estemes*')?'active':''}}"> <a href={{ route('painel.tarefas.recebidasEsteMesDepartamento') }}>Este Mês</a></button>

            <button type="button" class="btn btn-default {{request()->is('painel/tarefas/lista/recebidas/departamento/todas*')?'active':''}}"> <a href={{ route('painel.tarefas.recebidasTodasDepartamento') }}>Todas</a></button>
      </div>

      <div class="btn-group btn-group-xs" id="filtrotempoenviadas" data-pg-name="filtrotarefa2" style=" {{request()->is('painel/tarefas/lista/enviadas/departamento*')?'display:""':'display: none;'}}"> 
            
            <button type="button" class="btn btn-default {{request()->is('painel/tarefas/lista/enviadas/departamento/hoje*')?'active':''}}"> <a href={{ route('painel.tarefas.enviadasHojeDepartamento') }}>Hoje</a></button>

            <button type="button" class="btn btn-default {{request()->is('painel/tarefas/lista/enviadas/departamento/estasemana*')?'active':''}}"> <a href={{ route('painel.tarefas.enviadasEstaSemanaDepartamento') }}>Esta Semana</a></button>

            <button type="button" class="btn btn-default  {{request()->is('painel/tarefas/lista/enviadas/departamento/estemes*')?'active':''}}"> <a href={{ route('painel.tarefas.enviadasEsteMesDepartamento') }}>Este Mês</a></button>

            <button type="button" class="btn btn-default {{request()->is('painel/tarefas/lista/enviadas/departamento/todas*')?'active':''}}"> <a href={{ route('painel.tarefas.enviadasTodasDepartamento') }}>Todas</a></button>
      </div>
      
      <div class="btn-group btn-group-xs" id="tipovisualizacao" data-pg-name="tipovisualizacao"> 
            <button type="button" class="btn btn-default {{request()->is('painel/tarefas/lista*')?'active':''}}"><a href={{ route('painel.tarefas.recebidasTodasDepartamento') }}>Lista</a></button>             
            <button type="button" class="btn btn-default {{request()->is('painel/tarefas/kanban*')?'active':''}}"><a href={{ route('painel.tarefas.kanban.recebidas.todas.Departamento') }}>Kanban</a></button>
            <button type="button" class="btn btn-default {{request()->is('/painel/tarefas/departamento/calendario*')?'active':''}}"><a href={{ route('painel.tarefas.calendarioDepartamento') }}>Calendário</a></button>
            
      </div>

    </div>


<!-- Date range -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  @if(isset($inicio))
                    @php
                    $datafiltro = date("d/m/Y", strtotime($inicio))."-".date("d/m/Y", strtotime($fim));
                  @endphp 
                    <input style="margin-right: 5px;" type="text" class="form-control pull-right" id="inputfiltrolista" value={!!$datafiltro!!}>
                  @else
                    <input style="margin-right: 5px;" type="text" class="form-control pull-right" id="inputfiltrolista" value=" ">
                  @endif
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

    </div>
    {{-- XXXXXX FIM DA LISTA XXXXXXXX--}}





    {{-- XXXXXXX KANBAN XXXXXXX--}}

    <div  id="filtroKanban" style=" {{request()->is('painel/tarefas/kanban*')?'display:""':'display: none;'}}"> 

   <a class="btn btn-primary pull-right" href={{route('painel.tarefas.create') }}> <i class="fa fa-plus"></i> Adicionar</a>


    <div class="text-left col-md-8">
      <div class="btn-group btn-group-xs btn-group-sm" id="filtrotarefa" data-pg-name="filtrotarefa"> 
        <button type="button" class="btn btn-default {{request()->is('painel/tarefas/kanban/recebidas/departamento*')?'active':''}}"> <a href={{ route('painel.tarefas.kanban.recebidas.todas.Departamento') }}>Recebidas</a></button>

        <button type="button" class="btn btn-default {{request()->is('painel/tarefas/kanban/enviadas/departamento*')?'active':''}}"> <a href={{ route('painel.tarefas.kanban.enviadas.todas.Departamento') }}>Enviadas</a></button>
      </div>

    {{-- XXXXXXX KANBAN RECEBIDAS XXXXXXX--}}

      <div class="btn-group btn-group-xs" id="filtrotemporecebidas" data-pg-name="filtrotarefa2" style=" {{request()->is('painel/tarefas/kanban/recebidas/departamento*')?'display:""':'display: none;'}}"> 
            
            <button type="button" class="btn btn-default {{request()->is('painel/tarefas/kanban/recebidas/departamento/hoje*')?'active':''}}"> <a href={{ route('painel.tarefas.kanban.recebidasHoje.Departamento') }}>Hoje</a></button>

            <button type="button" class="btn btn-default {{request()->is('painel/tarefas/kanban/recebidas/departamento/estasemana*')?'active':''}}"> <a href={{ route('painel.tarefas.kanban.recebidasEstaSemana.Departamento') }}>Esta Semana</a></button>

            <button type="button" class="btn btn-default  {{request()->is('painel/tarefas/kanban/recebidas/departamento/estemes*')?'active':''}}"> <a href={{ route('painel.tarefas.kanban.recebidasEsteMes.Departamento') }}>Este Mês</a></button>

            <button type="button" class="btn btn-default {{request()->is('painel/tarefas/kanban/recebidas/departamento/todas*')?'active':''}}"> <a href={{ route('painel.tarefas.kanban.recebidas.todas.Departamento') }}>Todas</a></button>
      </div>

    {{-- XXXXXXX KANBAN ENVIADAS XXXXXXX--}}
      <div class="btn-group btn-group-xs" id="filtrotempoenviadas" data-pg-name="filtrotarefa2" style=" {{request()->is('painel/tarefas/kanban/enviadas/departamento*')?'display:""':'display: none;'}}"> 
            
            <button type="button" class="btn btn-default {{request()->is('painel/tarefas/kanban/enviadas/departamento/hoje*')?'active':''}}"> <a href={{ route('painel.tarefas.kanban.enviadasHoje.Departamento') }}>Hoje</a></button>

            <button type="button" class="btn btn-default {{request()->is('painel/tarefas/kanban/enviadas/departamento/estasemana*')?'active':''}}"> <a href={{ route('painel.tarefas.kanban.enviadasEstaSemana.Departamento') }}>Esta Semana</a></button>

            <button type="button" class="btn btn-default  {{request()->is('painel/tarefas/kanban/enviadas/departamento/estemes*')?'active':''}}"> <a href={{ route('painel.tarefas.kanban.enviadasEsteMes.Departamento') }}>Este Mês</a></button>

            <button type="button" class="btn btn-default {{request()->is('painel/tarefas/kanban/enviadas/departamento/todas*')?'active':''}}"> <a href={{ route('painel.tarefas.kanban.enviadas.todas.Departamento') }}>Todas</a></button>
      </div>
      
      <div class="btn-group btn-group-xs" id="tipovisualizacao" data-pg-name="tipovisualizacao"> 
            <button type="button" class="btn btn-default {{request()->is('painel/tarefas/lista*')?'active':''}}"><a href={{ route('painel.tarefas.recebidasTodasDepartamento') }}>Lista</a></button>             
            <button type="button" class="btn btn-default {{request()->is('painel/tarefas/kanban*')?'active':''}}"><a href={{ route('painel.tarefas.kanban.recebidas.todas.Departamento') }}>Kanban</a></button>
            <button type="button" class="btn btn-default {{request()->is('/painel/tarefas/departamento/calendario*')?'active':''}}"><a href={{ route('painel.tarefas.calendarioDepartamento') }}>Calendário</a></button>
            
      </div>


    </div>







<!-- Date range -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  @if(isset($inicio))
                  @php
                  $datafiltro = date("d/m/Y", strtotime($inicio))."-".date("d/m/Y", strtotime($fim));
                  @endphp 
                  <input style="margin-right: 5px;" type="text" class="form-control pull-right" id="inputfiltrokanban" value={!!$datafiltro!!}>
                  @else
                  <input style="margin-right: 5px;" type="text" class="form-control pull-right" id="inputfiltrokanban" value="">
                  @endif
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->



    </div>
{{-- XXXXXX FIM DO KANBAN XXXXXXXX--}}

{{-- XXXXXX INICIO APAGADAS XXXXXXXX--}}

    <div  id="filtroApagadosGeral" style=" {{request()->is('painel/tarefas/excluidas*')?'display:""':'display: none;'}}"> 

   <a class="btn btn-primary pull-right" href={{route('painel.tarefas.create') }}> <i class="fa fa-plus"></i> Adicionar</a>



    <div class="text-left col-md-8">
      <div class="btn-group btn-group-sm" id="filtrotarefa" data-pg-name="filtrotarefa"> 
        <button type="button" class="btn btn-default {{request()->is('painel/tarefas/lista/recebidas*')?'active':''}}"> <a href={{ route('painel.tarefas.recebidasTodas') }}>Recebidas</a></button>

        <button type="button" class="btn btn-default {{request()->is('painel/tarefas/lista/enviadas*')?'active':''}}"> <a href={{ route('painel.tarefas.enviadasTodas') }}>Enviadas</a></button>

        <button type="button" class="btn btn-default {{request()->is('painel/tarefas/excluidas*')?'active':''}}"> <a href={{ route('painel.tarefas.exibirTarefasApagadasTodas') }}>Apagadas</a></button>


        
    </div>

      <div class="btn-group btn-group-xs" id="filtrotemporecebidas" data-pg-name="filtrotarefa2" style=" {{request()->is('painel/tarefas/excluidas*')?'display:""':'display: none;'}}"> 
            
            <button type="button" class="btn btn-default {{request()->is('painel/tarefas/excluidas/hoje*')?'active':''}}"> <a href="<?php echo url($urlhoje); ?>">Hoje</a></button>

            <button type="button" class="btn btn-default {{request()->is('painel/tarefas/lista/recebidas/estasemana*')?'active':''}}"> <a href=<?php echo url($urlsemana); ?>>Esta Semana</a></button>

            <button type="button" class="btn btn-default  {{request()->is('painel/tarefas/lista/recebidas/estemes*')?'active':''}}"> <a href=<?php echo url($urlmes); ?>>Este Mês</a></button>
      </div>

    </div>


<!-- Date range -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  @if(isset($inicio))
                    @php
                    $datafiltro = date("d/m/Y", strtotime($inicio))."-".date("d/m/Y", strtotime($fim));
                  @endphp 
                    <input style="margin-right: 5px;" type="text" class="form-control pull-right" id="inputfiltroexcluidas" value={!!$datafiltro!!}>
                  @else
                    <input style="margin-right: 5px;" type="text" class="form-control pull-right" id="inputfiltroexcluidas" value=" ">
                  @endif
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

    </div>
    
{{-- XXXXXX FIM APAGADAS XXXXXXXX--}}















  </div>



<!-- date-range-picker -->

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<!-- Page script -->
<script>

   $('#inputfiltrolista, #inputfiltrokanban,#inputfiltroexcluidas').daterangepicker ({
    autoUpdateInput: false,

     "locale": {
       "format": "DD/MM/YYYY",
        "separator": " - ",
        "applyLabel": "Filtrar",
        "cancelLabel": "Cancelar",
        "fromLabel": "From",
        "toLabel": "To",
        "customRangeLabel": "Custom",
        "daysOfWeek": [
            "Dom",
            "Seg",
            "Ter",
            "Qua",
            "Qui",
            "Sex",
            "Sab"
        ],
        "monthNames": [
            "Janeiro",
            "Fevereiro",
            "Março",
            "Abril",
            "Maio",
            "Junho",
            "Julho",
            "Agosto",
            "Setembro",
            "Outubro",
            "Novembro",
            "Dezembro"
        ],
    },

    });



    $('input[id="inputfiltrolista"]').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
          
          var url_atual = window.location.href;

          if(url_atual.match(/recebidas/)){
            //alert('string recebidas encontrada '+picker.startDate.format('DD/MM/YYYY'));
            window.location.replace("/painel/tarefas/lista/recebidas/filtro/"+picker.startDate.format('YYYY-MM-DD')+"/"+picker.endDate.format('YYYY-MM-DD')); 
          };

          if(url_atual.match(/enviadas/)){
            // alert('string Enviadas encontrada');
            window.location.replace("/painel/tarefas/lista/enviadas/filtro/"+picker.startDate.format('YYYY-MM-DD')+"/"+picker.endDate.format('YYYY-MM-DD')); 
          };
      });


    $('input[id="inputfiltroexcluidas"]').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
          
          var url_atual = window.location.href;

          if(url_atual.match(/excluidas/)){
            //alert('string recebidas encontrada '+picker.startDate.format('DD/MM/YYYY'));
            window.location.replace("/painel/tarefas/excluidas/filtro/"+picker.startDate.format('YYYY-MM-DD')+"/"+picker.endDate.format('YYYY-MM-DD')); 
          };
      });



    $('input[id="inputfiltrokanban"]').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
          
          var url_atual = window.location.href;

          if(url_atual.match(/recebidas/)){
            //alert('string recebidas encontrada '+picker.startDate.format('DD/MM/YYYY'));
            window.location.replace("/painel/tarefas/kanban/recebidas/filtro/"+picker.startDate.format('YYYY-MM-DD')+"/"+picker.endDate.format('YYYY-MM-DD')); 
          };

          if(url_atual.match(/enviadas/)){
            // alert('string Enviadas encontrada');
            window.location.replace("/painel/tarefas/kanban/enviadas/filtro/"+picker.startDate.format('YYYY-MM-DD')+"/"+picker.endDate.format('YYYY-MM-DD')); 
          };
      });


</script>




    {{-- XXXXXXX CALENDÁRIO XXXXXXX--}}

    <div  id="filtroKanban" style=" {{request()->is('painel/tarefas/departamento/calendario*')?'display:""':'display: none;'}}"> 

    <div class="text-left col-md-8">
      
      <div class="btn-group btn-group-xs" id="tipovisualizacao" data-pg-name="tipovisualizacao"> 
            <button type="button" class="btn btn-default {{request()->is('painel/tarefas/departamento/lista*')?'active':''}}"><a href={{ route('painel.tarefas.recebidasTodasDepartamento') }}>Lista</a></button>             
            <button type="button" class="btn btn-default {{request()->is('painel/tarefas/departamento/kanban*')?'active':''}}"><a href={{ route('painel.tarefas.kanban.recebidas.todas.Departamento') }}>Kanban</a></button>
            <button type="button" class="btn btn-default {{request()->is('/painel/tarefas/departamento/calendario*')?'active':''}}"><a href={{ route('painel.tarefas.calendarioDepartamento') }}>Calendário</a></button>
            
      </div>
  </div>
</div>






