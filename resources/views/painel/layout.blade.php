<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{config ('app.name', 'Intra-S ')}} | Painel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="/adminlte/dist/css/skins/skin-blue.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<style type="text/css">
  #MainBG_A2_Rectangle_30 {
    fill: url(#RadialGradientFill2);
  }
  .MainBG_A2_Rectangle_30 {
    position: absolute;
    overflow: visible;
    width: 1920px;
    height: 70px;
    left: 0px;
    top: 0px;
    z-index: -1;
  }
</style>

<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">


<svg class="MainBG_A2_Rectangle_30">
    <radialGradient spreadMethod="pad" id="RadialGradientFill2">
      <stop offset="0" stop-color="#1d65a3" stop-opacity="1"></stop>
      <stop offset="1" stop-color="#004b8d" stop-opacity="1"></stop>
    </radialGradient>
    <rect id="MainBG_A2_Rectangle_30" rx="0" ry="0" x="0" y="0" width="1920" height="50">
    </rect>
</svg>
 




    <!-- Logo -->
    <a style="background-color: transparent" href={{ route('home') }} class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="\adminlte\images\INTRANET2-06.png" width="49px"class="img-responsive, center-block" alt="Logo Sistema"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="\adminlte\images\INTRANET2-08.png" width="120px" class="img-responsive center-block" alt="Logo Sistema"></span>
    </a>

    <!-- Header Navbar -->
    <nav style="background-color: transparent" class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the messages -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <!-- User Image -->
                        <img src="/adminlte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <!-- Message title and timestamp -->
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <!-- The message -->
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
                <!-- /.menu -->
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <li><!-- start notification -->
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>

          <!-- Tasks Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-success">{{\App\Tarefa::tarefascount()}} </span>
              
            </a>
            <ul class="dropdown-menu">
              <li class="header">Você tem {{\App\Tarefa::tarefascount()}} Tarefas <span style="color:white">{{\Carbon\Carbon::setLocale('pt_BR')}}</span></li>
              <li>
                <!-- Inner menu: contains the tasks -->
                <ul class="menu">
                  <li><!-- Task item -->
                      @foreach (\App\Http\Controllers\painel\TarefasController::ultimastarefasrecebidas() as $tarefa)
                        <a href="{{ route('painel.tarefas.recebidasTodas') }}">
                        <p>{{\Illuminate\Support\Str::limit($tarefa->nome, 22)}}
                        <small class="pull-right"><i class="fa fa-clock-o"></i> {{$tarefa->created_at->diffForHumans()}}</small></p>
                        </a>
                      @endforeach
                  </li>
                 <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="{{ route('painel.tarefas.recebidasTodas') }}">Ver todas Tarefas</a>
              </li>
            </ul>
          </li>



          <!-- Banners Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-picture-o"></i>
              <span class="label label-warning">{{\App\Banner::baners_painel_count()}} </span>
              
            </a>
            <ul class="dropdown-menu">
              <li class="header">Você tem {{\App\Banner::baners_painel_count()}} Banners <span style="color:white">{{\Carbon\Carbon::setLocale('pt_BR')}}</span></li>
              <li>
                <!-- Inner menu: contains the tasks -->
                <ul class="menu">
                  <li><!-- Task item -->
                      @foreach (\App\Banner::ultimosbanners() as $banner)
                        <a href="{{ route('painel.banners.index') }}">
                        
                        @php
                        $bannerimagem = DB::table('arquivos')
                        ->where('id','=', $banner->arquivo_id)
                        ->select('url')
                        ->first();

                        @endphp


                        <img src="{!!$bannerimagem->url!!}" class="img-responsive" alt="User Image">

                        <p>{{\Illuminate\Support\Str::limit($banner->titulo, 22)}}
                        <small class="pull-right"><i class="fa fa-clock-o"></i> {{$banner->created_at->diffForHumans()}}</small></p>
                        </a>
                      @endforeach
                  </li>
                 <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="{{ route('painel.banners.index') }}">Ver Todos Banners</a>
              </li>
            </ul>
          </li>
          <!-- Final Banners Menu -->



          <!-- Noticias Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-newspaper-o"></i>
              <span class="label label-info">{{\App\Banner::baners_painel_count()}} </span>
              
            </a>
            <ul class="dropdown-menu">
              <li class="header">Você tem {{\App\Banner::baners_painel_count()}} Banners <span style="color:white">{{\Carbon\Carbon::setLocale('pt_BR')}}</span></li>
              <li>
                <!-- Inner menu: contains the tasks -->
                <ul class="menu">
                  <li><!-- Task item -->
                      @foreach (\App\Banner::ultimosbanners() as $banner)
                        <a href="{{ route('painel.banners.index') }}">
                        
                        @php
                        $bannerimagem = DB::table('arquivos')
                        ->where('id','=', $banner->arquivo_id)
                        ->select('url')
                        ->first();

                        @endphp


                        <img src="{!!$bannerimagem->url!!}" class="img-responsive" alt="User Image">

                        <p>{{\Illuminate\Support\Str::limit($banner->titulo, 22)}}
                        <small class="pull-right"><i class="fa fa-clock-o"></i> {{$banner->created_at->diffForHumans()}}</small></p>
                        </a>
                      @endforeach
                  </li>
                 <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="{{ route('painel.banners.index') }}">Ver Todos Banners</a>
              </li>
            </ul>
          </li>
          <!-- Final Noticias Menu -->


          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a style="padding-top: 10px; padding-bottom: 10px;"  href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              
              @if(Auth::user()->arquivo_id==Null)
                <img src="/adminlte/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              @else
                <img src="{{Auth::user()->arquivo->url}}" width="30" height="30" class="img-circle" alt="User Image">
              @endif
             <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li  class="user-header">
                @if(Auth::user()->arquivo_id==Null)
                  <img src="/adminlte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                @else
                  <img src="{{Auth::user()->arquivo->url}}" width="160" height="160" class="img-circle" alt="User Image">
                @endif
                
                <p>
                  {{ Auth::user()->name }}
                  <small>{{ Auth::user()->departamento->nome }} - <b>{{ Auth::user()->departamento->empresa->nome }}</b></small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href={{ route('perfil') }} class="btn btn-default btn-flat">Perfil do Usuário</a>
                </div>
                <div class="pull-right">
                   <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Sair
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <style type="text/css">
      /*FUNDO*/
    .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {
    background-color: #ecf0f5;
    }
    /*ITEM SELECIONADO*/
    .sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a, .skin-blue .sidebar-menu>li.menu-open>a {
    color: #000;
    background: #ecf0f5;
    }

    /*Cabeçalho*/
    .skin-blue .sidebar-menu>li.header {
    color: #4b646f;
    background: #ecf0f5;
    }

    /*ITEM SELECIONADO HOVER*/
    .skin-blue .sidebar-menu>li>a:hover {
    color: #000;
    background: #ecf0f5;
    }

    .sidebar-menu>li>a {
    padding: 12px 0px 0px 15px;
    display: block;
    }

    .skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {
    background-color: #ecf0f5;
    }

    .sidebar-menu li.header {
    padding: 10px 0px 0px 15px;
    font-size: 12px;
    }

   
    </style>

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      
      <!-- Sidebar user panel (optional) -->
      <!--
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/adminlte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
        -->
          <!-- Status -->

          <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div> -->

      <!-- search form (Optional) -->
<!-- 
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>

 -->      <!-- /.search form -->



      <!-- Sidebar Menu -->
      
      @include('painel.partes.sidebar-menu')

      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>






  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper col-md-10">
    <!-- Content Header (Page header) -->
    

    <div class="col-md-9">





<!-- BANNER -->
<div  style="margin-top: 10px;" class="box box-info" > 


<div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-bottom: 10px;">
    
    <div class="carousel-inner" role="listbox">
                    <?php
                    use App\Banner;
                    $urls_banners = Banner::bannersite();
                    $contador=0;
                    if (count($urls_banners)==1) {
                    ?>  
                      <div class="item active">
                          <img class="img-rounded" src= <?php echo json_encode($urls_banners[0],  JSON_UNESCAPED_SLASHES); ?> width="800" height="250"  data-holder-rendered="true">
                      </div>
                    <?php
                    }else{
                      foreach ($urls_banners as $url) {
                      $contador=$contador+1;
                        if ($contador==1) {
                    ?>
                        <div class="item active">
                          <img class="img-rounded" src= <?php echo json_encode($url,  JSON_UNESCAPED_SLASHES); ?> width="800" height="250"  data-holder-rendered="true">
                        </div>
                    <?php
                        }else{
                    ?>
                          <div class="item">
                          <img class="img-rounded" src= <?php echo json_encode($url,  JSON_UNESCAPED_SLASHES); ?> width="800" height="250"  data-holder-rendered="true">
                        </div>
                    <?php
                        }
                      }
                    }
                    ?>

                  </div>


    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>


        
</div>







    @yield('header')

    <!-- Main content -->
    <section class="content container-fluid">

    @yield('content')
     
    </section>
    <!-- /.content -->
  </div>
    
  <div style="background-color: red margin:0px;" class="col-md-3">

      <div  style="margin-top: 10px;" class="box box-info" >
      @php
        use App\Noticia;
        use Illuminate\Support\Str;
        $noticiasdousuario = Noticia::noticias()->take(10);
        //$sorted = $collection;  
      @endphp

        <ul style="margin-left: 5px;" class="list-unstyled text-justify"> @forelse ($noticiasdousuario as $noticias)
          <li style="font-size: small; text-align: left; color: #809ea9;">
            @if($noticias->arquivo_id)
            <img src="{!!$noticias->arquivo->url!!}" class="img-responsive" style="margin-left: -5px; margin-bottom:5px; margin-top: 1px">
            

            @endif
            <p style="font-family: Roboto; font-size: 14px; color:#004b8d">{!!$noticias->titulo!!}</p>
            {{-- {!!$noticias->noticia!!} --}}
            {!!Str::limit($noticias->noticia, 180)!!}<br>
            @php
            $database = strtotime($noticias->created_at); 
            $criado = date ('d/m/Y H:i:s', $database); 
            @endphp
            {!! $criado !!}  -<a style="margin-top: -3px; margin-left: -10px;" class="btn btn-flat" href="{{route('painel.noticias.show', $noticias->id )}}">Leia Mais</a>


          </li> 
          <hr style="margin: 0; padding:0"> 
          @empty
            <p> Nenhuma Noticia Cadastrada </p> 
          @endforelse 
        </ul>
      </div>

       
  </div>
  
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  





  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-light">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>


  



</div>
<!-- ./wrapper -->



<footer style=" bottom: 0; width: 100%; margin-left: 0px; background-color: #bbbbbb; color: white" class="main-footer">
    <!-- To the right -->

    <h6><center> Todos os direitos reservados, Núcleo de Comunicação e Marketing, Federação do Comércio de Bens, Serviços e Turismo do Estado de Sergipe, 2019.<br>
<strong>fecomercio-se.com.br • sesc-se.com.br • se.senac.br</strong></center></h6>

    <div style="margin-top: -60px;" class="pull-right hidden-xs">
      <img src="\adminlte\images\FecomercioBranca.png" width="150px"class="img-responsive, center-block">
    </div>
    <!-- Default to the left -->
   
    {{-- <strong>Copyright &copy; 2018  <a href="#">   NCM - Núcleo de Comunicação e Marketing - FECOMÉRCIO SE. </a></strong> --}} 
  </footer>



<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>


<!-- page script -->
<script>
  $(function () {
    $('#noticias').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'language'    : portugues

    })
  })



  var portugues = {
    "sEmptyTable": "Nenhum registro encontrado",
    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
    "sInfoPostFix": "",
    "sInfoThousands": ".",
    "sLengthMenu": "_MENU_ resultados por página",
    "sLoadingRecords": "Carregando...",
    "sProcessing": "Processando...",
    "sZeroRecords": "Nenhum registro encontrado",
    "sSearch": "Pesquisar",
    "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
    },
    "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
    }
}

</script>



<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>

<section>

    @yield('modal')
     
</section>
</html>