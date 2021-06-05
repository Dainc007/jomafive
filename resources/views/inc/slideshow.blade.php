<div id="demo" class="py-3 carousel slide mx-auto" data-ride="carousel" data-interval="5000" style="max-width:700px;">
  <!-- The slideshow -->
  <div class="carousel-inner">

    <ol class="carousel-indicators">
      <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
      <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
      <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
    </ol>

    <div class="carousel-item">
      <img class="rounded img-fluid  d-block mx-auto" src="{{ asset('images/slideshow/2.jpg') }}">
    </div>
    <div class="carousel-item">
      <img class="rounded img-fluid d-block mx-auto" src="{{ asset('images/slideshow/1.jpg') }}">
    </div>

    <div class="carousel-item active">
      <img class=" rounded img-fluid d-block mx-auto" src="{{ asset('images/slideshow/3.jpg') }}">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>