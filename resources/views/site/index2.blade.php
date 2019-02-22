<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{config ('app.name', 'Intra-S')}}| Painel</title>
  @include('site.partes.css')

</head>

<body class="">
  
  <section class="sidebar">
    @include('site.partes.menu')
  </section>
  <div class="py-2">
    <div class="fluid">
      <div class="row">
        <div class="col-md-4">
          <img class="img-fluid d-block" src="https://pingendo.com/assets/photos/wireframe/photo-1.jpg">
          <h1 class="text-center">Olá, {{$usuario}}</h1>
          <!-- <img class="img-fluid d-block" src="{{$img->dirname}}/{{$img->basename}}"> -->
        </div>
        <div class="col-md-6 p-0">
          <div class="container-fluid m-0">
            <div class="row">
              <div class="col-md-12 p-0">
                <div class="carousel slide" data-ride="carousel" stile="padding-top=-10" id="carousel1">
                  <div class="carousel-inner" role="listbox">
                    <div class="carousel-item">
                      <img class="d-block img-fluid w-100 h-50 p-0 m-0" src="https://pingendo.github.io/templates/sections/assets/gallery_restaurant_1.jpg" atl="first slide">
                      <div class="carousel-caption">
                        <h3>Dining room</h3>
                        <p>Good architecture, better food</p>
                      </div>
                    </div>
                    <div class="carousel-item active">
                      <img class="d-block img-fluid w-100 h-50 p-0 m-0" src="https://pingendo.github.io/templates/sections/assets/gallery_restaurant_2.jpg" data-holder-rendered="true">
                      <div class="carousel-caption">
                        <h3>Cigar room</h3>
                        <p>Enjoy our fine selection</p>
                      </div>
                    </div>
                    <div class="carousel-item">
                      <img src="https://pingendo.github.io/templates/sections/assets/gallery_restaurant_3.jpg" class="d-block img-fluid w-100 h-50 p-0 m-0" data-holder-rendered="true">
                      <div class="carousel-caption">
                        <h3>Relax area</h3>
                        <p>Take the time to chill</p>
                      </div>
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carousel1" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
                  <a class="carousel-control-next" href="#carousel1" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <h1 class="text-center">Pesquisa</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="py-2">
    <div class="fluid">
      <div class="row">
        <div class="col-md-4 bg-light">
          <h1 class="text-center">Notícias</h1>
          <ul class=""> @forelse ($noticiasdousuario as $noticias)
            <li>
              <a class="nav-link" href=" {{$noticias->url}} " target="_blank">{{$noticias->titulo}} </a>
            </li> @empty
            <p> Nenhuma Noticia Cadastrada </p> @endforelse </ul>
        </div>
        <div class="col-md-6">
          <h1 class="text-center">Gerenciamento de Tarefas</h1>
        </div>
        <div class="col-md-2">
          <h1 class="">Documentos</h1>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>

</html>