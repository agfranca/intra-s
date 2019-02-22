
  <nav  class="navbar navbar-expand-md fixed-top navbar-light">
    <div style="background-color:#2b77b5; color:#fff" class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="{{$img->dirname}}/{{$img->basename}}" width="100"> </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="container-fluid">
          <div class="d-flex">
          <div class="d-flex justify-content-start">
            <ul class="navbar-nav mr-auto">
              <li style="padding-right: 25px" class="nav-item">
                <a style="color:#fff" class="nav-link" href="#">Tarefas</a>
              </li>
              <li style="padding-right: 25px" class="nav-item">
                <a style="color:#fff" class="nav-link" href="#">Webmail</a>
              </li>
              <li style="padding-right: 25px" class="nav-item">
                <a style="color:#fff" class="nav-link" href="#">Sistemas</a>
              </li>
            </ul>  
          </div>
          <div class="d-flex ml-auto">

            <div class="d-flex align-items-end flex-column">
          <div style="font-weight:bold">
            <?php
            setlocale(LC_TIME, 'pt_BR', 'ptb', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            date_default_timezone_set('America/Sao_Paulo');
            //$date = date('D, Y-m-d H:i');
            //strftime('%A, %d de %B de %Y', strtotime('today'));
            $data = strftime( '%A, %d/%m/%Y', strtotime('today')); 
            echo ucwords($data);
            ?>
          </div>
          <div>
            <ul class="navbar-nav">            
            <li class="nav-item float-right">
              <a style="color:#fff; font-size: x-small;" class="nav-link" href="{{ route('painel') }}">Abrir Painel</a>
            </li>
                     
            <li class="nav-item">
              <a style="color:#fff; font-size: x-small;" class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> Sair </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
            </li>

          </ul>
        </div>
      </div>
        </div>
       
        </div>
        
      </div>
    </div>
  </nav>

