
@extends('welcome')
@section('contenido')
<main>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6 order-md-1">
                    <div id="carouselImages" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img  src="/mostrarImagen/{{$producto->ruta}}" width="500" height="auto" class="d-block w-100">
                            </div>
                                <div class="carousel-item">
                                    <img src="" width="500" height="auto" class="d-block w-100">
                                </div>
                            
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-6 order-md-2">
                    <h2>{{$producto->nombre}}</h2>
                    <h2>${{$producto->precio}}</h2>
                    <h2>El kilometraje es de: {{$producto->kilometraje}}</h2>
                    <p class="lead">
                        {{$producto->descripcion}}
                    </p>
                    <div class="d-grid gap-3 col-10 mx-auto">
                        <button class="btn btn-outline-primary" type="button"onclick="addProducto({{$producto->id}},)">Agregar al carrito</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
</html>