
@extends('welcome')
@section('contenido')

    <h3 class="my-4 d-flex align-items-center justify-content-center" >PRODUCTOS</h3>
    <hr style="width: 200px; margin: auto;">

<div class="container mt-5">
<div class="row">
    <div class="col-sm-12">
        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill"/>
            </svg>
            <div class="flex-grow-1">{{ Session::get('success') }}</div> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif(Session::has('error')) 
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Error:">
                <use xlink:href="#exclamation-triangle-fill"/>
            </svg>
            <div class="flex-grow-1">{{ Session::get('error') }}</div> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
</div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        
        @foreach($productos as $producto)
        @guest
        <form>
        <div class="col">
            <div class="card shadow-sm">
                <img src="/mostrarImagen/{{$producto->ruta}}">
                <div class="card-body">
                    <h5 class="card-title">{{$producto->nombre}}</h5>
                    <p class="card-text">${{$producto->precio}}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="detallesAuto/{{$producto->id}}" class="btn btn-primary">Detalles</a>
                        </div>
                            <a class="btn btn-outline-success" href="{{ route('login') }}">Agregar al carrito</a>
                        </div>
                </div>
            </div>
        </div>
</form>
        @else
        <form method="post"  action="{{ route('carritoCompra') }}">
        <div class="col">
            <div class="card shadow-sm">
                <img src="/mostrarImagen/{{$producto->ruta}}">
                <input type="hidden" name="id" value="{{$producto->id}}">
                <input type="hidden" name="nombre" value="{{$producto->nombre}}">
                <input type="hidden" name="precio" value="{{$producto->precio}}">
                <div class="card-body">
                    <h5 class="card-title">{{$producto->nombre}}</h5>
                    <p class="card-text">${{$producto->precio}}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="detallesAuto/{{$producto->id}}" class="btn btn-primary">Detalles</a>
                        </div>
                
                            @csrf
                            <button class="btn btn-outline-success"   action="{{ route('carritoCompra') }}" method="post" type="submit" onclick="">Agregar al carrito</button>
                        </div>
                </div>
            </div>
        </div>
</form>
@endguest
        @endforeach
        <div class="row">
    
</div>
    </div>
</div>


@endsection