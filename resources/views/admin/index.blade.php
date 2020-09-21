<!doctype html>
<html lang="es">
  <head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">            
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">    
    <title>Panel de Administración</title>
    <link href="vista/img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <style>
    .dropdown-item:hover
    {
      background:gray;
    }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Tiendas SC • <span class="h5 text-info">{{$_SESSION["UsuarioRegistrado"]["alias"]}}</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <nav id="sidebarMenu" class="col-md-2 d-md-block bg-light collapse">
          <div class="pt-3">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active font-weight-bold" href="?ruta=home">Menu Principal</a>
              </li>                           
              <li class="nav-item py-2">
                <a class="nav-link text-dark" href="?ruta=producto">Productos</a>
              </li>
              <li class="nav-item py-2">
                <a class="nav-link text-dark" href="?ruta=categoria">Categorias</a>
              </li>
              <li class="nav-item py-2">
                <a class="nav-link text-dark" href="?ruta=subcategoria">Subcategorias</a>
              </li>
              <li class="nav-item py-2">
                <a class="nav-link text-dark" href="?ruta=marca">Marcas</a>
              </li> 
              <li class="nav-item py-2">
                <a class="nav-link text-dark" href="?ruta=usuario">Usuarios</a>
              </li>
              <li class="nav-item btn-group dropright py-2">
                <a class="nav-link text-dark dropdown-toggle" href="#" data-toggle="dropdown"> Más </a>
                <div class="dropdown-menu bg-light">                                    
                  <a href="?ruta=cargo" class="dropdown-item text-dark">Cargos</a>
                  <a href="?ruta=logeo" class="dropdown-item text-dark">Logeos</a>
                </div>
              </li>
              <li class="nav-item py-2">
                <a class="nav-link text-danger" href="{{route('logout')}}">Salir</a>
              </li>              
            </ul>          
          </div>
        </nav>

        <main role="main" class="col-md-10" style="overflow-y: auto; height:600px;">
          <h2 class="text-center py-2">Datos Estadisticos del sitio</h2>
          <div class="row justify-content-center">

            <div class="col-md-3">
              <div class="card text-white bg-info mb-3">
                <div class="card-header"><h5>Total de Productos</h5></div>
                <div class="card-body">
                  <h4 class="card-title text-center">'.$lista["total_productos"].'</h4>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card text-white bg-primary mb-3">
                <div class="card-header"><h5>Total de Categorias</h5></div>
                <div class="card-body">
                  <h4 class="card-title text-center">'.$lista["total_categorias"].'</h4>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card text-white bg-secondary mb-3">
                <div class="card-header"><h5>Total de SubCategorias</h5></div>
                <div class="card-body">
                  <h4 class="card-title text-center">'.$lista["total_subcategorias"].'</h4>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card text-white bg-success mb-3">
                <div class="card-header"><h5>Total de Marcas</h5></div>
                <div class="card-body">
                  <h4 class="card-title text-center">'.$lista["total_marcas"].'</h4>
                </div>
              </div>
            </div>

          </div>
          <h3 class="text-center py-2">Ultimos Productos añadidos</h3>
            '.$tabla_prod.'
          <h3 class="text-center py-2">Usuarios que Ingresaron al sistema Recientemente</h3>
            '.$tabla_log.'
        </main>
      </div>
    </div>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>