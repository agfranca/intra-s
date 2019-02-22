
  <nav  style="background-color:#FFF" class="navbar navbar-expand-md fixed-top navbar-light">
    <div  class="container-fluid">
      <a class="navbar-brand" href="#">
        <img class="mx-auto" src="{{$img->dirname}}/{{$img->basename}}" width="100"> </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div style="font-weight:bold" class="d-flex flex-column">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">Tarefas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Pesquisas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Documentos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Configurações</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Webmail</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> Logout </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('painel') }}">Painel</a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="fa fa-fw fa-2x fa-birthday-cake"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="fa fa-user fa-fw fa-2x"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="fa fa-fw fa-2x fa-id-badge"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>