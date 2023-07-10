mostremos aqui
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/estilos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>
    <header>
        <div class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a href="#" class="navbar-brand">
                    <strong>Tienda Online</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <form>
                    <button type="submit" action="#" class="btn btn-primary">Anaconda</button>
                </form>
                <form action="{{ route('cerrarSesion') }}" method="POST" >
                    @csrf
                    <button type="submit" class="btn btn-primary">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </header>
    <div class="container mt-4">
        <h2>PRODUCTOS</h2>
        <p></p>
        <a href="{{ url('/create') }}" class="btn btn-primary">Agregar</a>
        <p></p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Activo</th>
                    <th scope="col">Kilometraje</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Disponibilidad</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->modelo }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->precio }}</td>
                    <td>{{ $producto->activo }}</td>
                    <td>{{ $producto->kilometraje }}</td>
                    <td>{{ $producto->ruta }}</td>
                    <td>{{ $producto->disponibilidad }}</td>
                    <td>
                        <form action="{{ route('update.form', $producto->id) }}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-editar" style="background-color: orange;">
                                <i class="bi bi-pencil text-white"></i>
                            </button>
                        </form>

                        <form action="{{ route('eliminar', ['id' => $producto->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-eliminar" style="background-color: red;" onclick="return confirm('¿Deseas eliminar el producto?')">
                                <i class="bi bi-trash text-white"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var inputImagenes = document.querySelectorAll(".input-imagen");

            for (var i = 0; i < inputImagenes.length; i++) {
                inputImagenes[i].addEventListener("change", function(event) {
                    var input = event.target;
                    var imagenProducto = input.parentNode.parentNode.querySelector(".imagen-producto");

                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            imagenProducto.src = e.target.result;
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                });
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-Pv4/1Ez7Fw+lz6w5uRggnXkcdF4xKx0SY9R62vzK8Iy3eI+JJjQHNK9TsCCzVQ1+" crossorigin="anonymous"></script>
</body>

</html>