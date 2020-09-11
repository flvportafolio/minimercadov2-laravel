@extends('layouts.web')
@section('main')

<main role="main" class="container">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{asset('img/1.jpg')}}" class="d-block w-100" alt="tienda-interior-1">
      </div>
      <div class="carousel-item">
        <img src="{{asset('img/2.jpg')}}" class="d-block w-100" alt="tienda-interior-2">
      </div>
      <div class="carousel-item">
        <img src="{{asset('img/3.jpg')}}" class="d-block w-100" alt="tienda-interior-3">
      </div>
      <div class="carousel-item">
        <img src="{{asset('img/4.jpg')}}" class="d-block w-100" alt="tienda-interior-4">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <nav class="nav py-3 justify-content-center">
    '.$cats_items.'
  </nav>
  <h3>Productos recientemente agregados</h3>
  <section class="pt-4">
    '.$item_ultimosprod.'        
  </section>
</main>
@endsection