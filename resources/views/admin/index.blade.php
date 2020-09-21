@extends('layouts.admin')
@section('inside_main')
<h2 class="text-center py-2">Datos Estadisticos del sitio</h2>
<div class="row justify-content-center">

  <div class="col-md-3">
    <div class="card text-white bg-info mb-3">
      <div class="card-header"><h5>Total de Productos</h5></div>
      <div class="card-body">
        <h4 class="card-title text-center">{{$lista["total_productos"]}}</h4>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card text-white bg-primary mb-3">
      <div class="card-header"><h5>Total de Categorias</h5></div>
      <div class="card-body">
        <h4 class="card-title text-center">{{$lista["total_categorias"]}}</h4>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card text-white bg-secondary mb-3">
      <div class="card-header"><h5>Total de SubCategorias</h5></div>
      <div class="card-body">
        <h4 class="card-title text-center">{{$lista["total_subcategorias"]}}</h4>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card text-white bg-success mb-3">
      <div class="card-header"><h5>Total de Marcas</h5></div>
      <div class="card-body">
        <h4 class="card-title text-center">{{$lista["total_marcas"]}}</h4>
      </div>
    </div>
  </div>

</div>
<h3 class="text-center py-2">Ultimos Productos añadidos</h3>
  {!! $tabla_prod !!}
<h3 class="text-center py-2">Usuarios que Ingresaron al sistema Recientemente</h3>
  {!! $tabla_log !!}
@endsection