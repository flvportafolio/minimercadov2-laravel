<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Página no Disponible</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
    body 
    { 
        background: linear-gradient(to right, #667db6, #0082c8, #0082c8, #667db6);
    }
    .error-template 
    {
      padding: 60px 15px;
      text-align: center;
    }
    .error-actions
    {
        margin-top:15px;
        margin-bottom:15px;
    }
    .error-actions .btn 
    { 
        margin-right:10px; 
    }
    </style>
</head>
<body>
        
  <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <br><br><br>
                <h1>
                    Oops!
                </h1>
                <h2>
                    <span class="text-white">405</span> Ruta Invalida
                </h2>
                <br>
                <div class="error-details text-white">
                    Disculpa, al parecer has ingresado a una ruta que no existe.
                </div>
                <div class="error-details text-warning pt-3">
                  <h5>{{ $exception->getMessage() }}</h5>
                </div>
                
            </div>
        </div>
    </div>
  </div>

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>