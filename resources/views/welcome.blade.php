
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
    <link href="css/estilos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
<header>
    
        <div class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a href="{{route('/')}}" class="navbar-brand">
                    <strong>Tienda Online</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false"
                aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarHeader">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                            <a href="{{route('productos')}}" class="nav-link active">Catalogo</a>
                      </li>  

                      <li class="nav-item">
                            <a href="#seccion-final" class="nav-link">Contacto</a>
                      </li> 

                    </ul>
                     
                        @guest
                        <a href="{{route('login')}}" class="btn btn-primary btn-sm me-2">
                        <i class="fas fa-shopping-cart"></i> Carrito <span id="num_cart" class="badge " style="padding: 0.25rem 0.5rem; border: 2px solid #fff;">0</span>
                        </a>
                        <a href="{{route('login')}}" action="{{route('inicioSesion')}}"class="btn btn-success btn-sm">
                            <i class="fas fa-user"></i> Ingresar
                        </a>
                        @else
                        <a href="{{route('compraUsuario')}}" class="btn btn-primary btn-sm me-2">
                            <i class="fas fa-shopping-cart"></i> Carrito <span class="badge" style="padding: 0.25rem 0.5rem; border: 2px solid #fff;">{{ Auth::check() ? App\Models\compra::where('id_usuario', Auth::user()->id)->count() : 0 }}</span>

                        </a>
                        @csrf
                        <div class="dropdown">
                            <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="btn_session" data-bs-toggle="dropdown" aria-expanded="false" style="font-weight: 300; font-size: 14px;">
                                <i class="fas fa-user"> {{ Auth::user()->usuario }}</i> &nbsp;
                            </button>
                            @csrf
                            <ul class="dropdown-menu" aria-labelledby="btn_session">

                                <form action="{{ route('cerrarSesion') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Cerrar sesión</button>
                                </form>                               
                            </ul>
                        </div>

                        @endguest
                </div>
            </div>
        </div>
        
</header>
    <main>
    @yield('contenido')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-gP9vPdpybyUeUrOk7fjykw3WmnA57JABdK0jjTQQyzMf5GQfxzOJdyO9bhOfi7Dr" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</body>
</html>
