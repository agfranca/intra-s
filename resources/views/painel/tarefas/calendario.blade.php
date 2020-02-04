@extends('painel.layout')
@section('header')
<section class="content-header">
      <h1>
        Tarefas
        <small> - Tarefas do Usuário</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li class="active">Tarefas</li>
      </ol>

</section>
@stop


{{-- CONTEUDO --}}

  <link href='{{asset('fullcalendar-4.2.0/packages/core/main.css')}}' rel='stylesheet' />
  <link href='{{asset('fullcalendar-4.2.0/packages/daygrid/main.css')}}' rel='stylesheet' />
  <link href='{{asset('fullcalendar-4.2.0/packages/timegrid/main.css')}}' rel='stylesheet' />
  <link href='{{asset('fullcalendar-4.2.0/packages/list/main.css')}}' rel='stylesheet' />
  <script src='{{asset('fullcalendar-4.2.0/packages/core/main.js')}}'></script>
  <script src='{{asset('fullcalendar-4.2.0/packages/core/locales-all.js')}}'></script>
  <script src='{{asset('fullcalendar-4.2.0/packages/interaction/main.js')}}'></script>
  <script src='{{asset('fullcalendar-4.2.0/packages/daygrid/main.js')}}'></script>
  <script src='{{asset('fullcalendar-4.2.0/packages/timegrid/main.js')}}'></script>
  <script src='{{asset('fullcalendar-4.2.0/packages/list/main.js')}}'></script>
  <script src='{{asset('fullcalendar-4.2.0/packages/tooltip/tooltip.min.js')}}'></script>
  <script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
  <script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>
  <script src = "https://unpkg.com/popper.js"> </script>
<script src = "https://unpkg.com/tooltip.js"> </script>


<script>

  document.addEventListener('DOMContentLoaded', function() {
    var initialLocaleCode = 'pt-br';

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],

      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
   
      
      locale: initialLocaleCode,
      buttonIcons: false, // show the prev/next text
      weekNumbers: true,
      navLinks: true, // can click day/week names to navigate views
      editable: false,
      eventLimit: true, // allow "more" link when too many events
      selectable: true,
      selectHelper: true,

      events: {url:'/painel/tarefas/calendariodados'},

            eventClick:  function(info) {
            $('#modalTitle').html(info.event.title);
            $('#modalBody').html('Descrição: '+info.event.extendedProps['descricao']);
            $('#eventUrl').attr('href','/painel/tarefas/edit/'+info.event.id+'/recebidas');
            $('#fullCalModal').modal();
            console.log(info);
        }

    });

    calendar.render();


  });


</script>



@section('content')
  @include('painel.partes.mensagens-usuarios')

  <div class="box box-info">
    <div class="container-fluid">
    @include('painel.tarefas.partes.menuHorizontal')
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div id='calendar'></div>
    </div>
  </div>




@stop

@section('modal')

<div id="fullCalModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4 id="modalTitle" class="modal-title"></h4>
            </div>
            <div id="modalBody" class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                <a  class="btn btn-primary" id="eventUrl">Editar Evento</a>
            </div>
        </div>
    </div>
</div>

@stop

{{-- FIM CONTEUDO --}}