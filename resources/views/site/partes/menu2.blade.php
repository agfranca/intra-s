
  <nav class="navbar navbar-default">
  <div style="background-color:#2b77b5; padding-top: 10px; padding-bottom: 10px; color:#fff" class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">
        <img src="{{$img->dirname}}/{{$img->basename}}" width="100" style="margin-top: -18px;"> </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
      <ul class="nav navbar-nav">
          <li><a href="#" style="color:#fff">Tarefas</a></li>
          <li><a href="#" style="color:#fff">Webmail</a></li>
          <li><a href="#" style="color:#fff">Sistemas</a></li>
      </ul>
      {{-- @php
      //Data em Portugues removi pois não achei necessario 
       date_default_timezone_set('America/Sao_Paulo');
       $data = new DateTime();
       $formatter = new IntlDateFormatter('pt_BR',
                                    IntlDateFormatter::FULL,
                                    IntlDateFormatter::NONE,
                                    'America/Sao_Paulo',          
                                    IntlDateFormatter::GREGORIAN);
       echo $formatter->format($data);
       @endphp --}}
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a style="color:#fff; font-size: x-small;" class="nav-link" href="{{ route('painel') }}">Abrir Painel</a>
        </li>
        <li>
          <a style="color:#fff; font-size: x-small;" class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"> Sair </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
        </li>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>