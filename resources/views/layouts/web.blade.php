<!doctype html>
<html lang="es">
  <head>      
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{asset('favicon.ico')}}" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Tiendas SC</title>
    <style>
      footer
      {
        color: #fff
      }
      hr
      {         
        border: 1px solid #0791e6;
        width:80%;
        text-align:left;
        margin-left:0        
      }
    </style>
  </head>
  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a class="navbar-brand" href="#"><img src="{{asset('favicon.ico')}}" width="32px" height="32px" alt="logo"> Tiendas SC</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navprincipal" aria-controls="navprincipal" aria-expanded="true" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse collapse justify-content-md-center" id="navprincipal" style="">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="javascript:void(0)">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?ruta=producto">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?ruta=marca">Marcas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?ruta=contactanos">Contáctanos</a>
          </li>
        </ul>
       
      </div>
    </nav>
    <!-- End Navigation -->
    <!-- Main Section -->
      @yield('main')
    <!--End Main-->
    <!-- Footer -->
    <footer class="container-fluid pt-2 bg-dark">
      <div class="row">
        <div class="col-md-4 pb-3">
          <h5 class="col-md-12">General</h5>
          <hr>          
          <li class="col-md-12"><a target="_blank" href="?ruta=acerca" class="text-light">Acerca de Tiendas SC</a></li>
          <li class="col-md-12"><a target="_blank" href="?ruta=contactanos" class="text-light">Contáctanos</a></li>
          <li class="col-md-12">Horario de Atención:</li> 
          <p class="col-md-12 text-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lun - Vier / 9:00 am - 7:00 pm</p>
        </div>

        <div class="col-md-4 pb-3">
          <h5 class="col-md-12">Preguntas Frecuentes</h5>
          <hr>          
          <li class="col-md-12"><a target="_blank" href="?ruta=terminos" class="text-light">Términos y Condiciones</a></li>
          <li class="col-md-12"><a target="_blank" href="?ruta=cookies" class="text-light">Política de Cookies</a></li>
          <li class="col-md-12"><a target="_blank" href="?ruta=privacidad" class="text-light">Política de Privacidad</a></li> 
        </div>

        <div class="col-md-4 pb-3">
          <h5 class="col-md-12">Contacto</h5>
          <hr>
          <div class="col-md-12 pb-2">
            <img src="{{asset('img/whatsapp.png')}}" alt="WhatsApp">
            <a draggable="false" class="pl-2 text-light phone-up" href="https://wa.me/59176543210">(+591) 76543210</a>          
          </div>
          <div class="col-md-12 pb-2">
            <img src="{{asset('img/gmail.png')}}" alt="Correo">
            <a draggable="false" class="pl-2 text-light email-up" href="mailto:correo@gmail.com">correo@gmail.com</a>
          </div>
          <div class="col-md-12">
            <img src="{{asset('img/map-marker.png')}} " alt="ubicacion">
            <span class="pl-2 text-light"><img src="https://www.countryflags.io/bo/shiny/24.png" alt="BO"> Bolivia</span>
          </div>                         
        </div>
      </div>
      <div class="row">
          <p class="col-md-12 mt-4 text-center">Tiendas SC ©2020, Desarrollado por Estudiantes de la UPDS. | Laravel v{{ Illuminate\Foundation\Application::VERSION }}</p>
      </div>
    </footer>
    <!-- End Footer -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>