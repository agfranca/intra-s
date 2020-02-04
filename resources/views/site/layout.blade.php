<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{config ('app.name', 'Intra-S')}}| Site</title>
  @include('site.partes.css')

</head>

<body>
<style type="text/css">
  html {
  font-size: 1rem;
}
h1,h2,h3,h4,h5,h6{
 font-size: 1rem; 
}
#noticias img{
  width: 100%;
}
</style>

<section class="menu">
    @include('site.partes.menu2')
</section>

<section class="linha1">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-2">
          @yield('L1C1')
      </div>
    
      <div class="col-md-8">
          @yield('L1C2')
      </div>
      
      <div id="noticias" class="col-md-2">
          @yield('L1C3')
      </div>
    </div>
  </div>
</section>

<section class="linha2">
  <div class="container-fluid px-4 py-3">
    <div class="row">
      <div style="background-color: #e6fffa" class="col mx-1 rounded">
          @yield('L2C1')
      </div>
    
      <div style="background-color: #FFF" class="col mx-1 rounded">
          @yield('L2C2')
      </div>
      
      <div style="background-color: #FFF" class="col mx-1 rounded">
          @yield('L2C3')
      </div>
    </div>
  </div>
</section>
<div id="Rodapé" style="margin-bottom: 50px;">

</div>
@include('site.partes.scripts')
</body>

</html>