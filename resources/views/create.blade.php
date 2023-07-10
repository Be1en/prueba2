Formulario de creacion
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

            </div>
        </div>
    </header>
    <!--contenido-->
    <main>
        <div class="container mt-4">
            <h2>Datos de los productos</h2>
            <div class="row">
                <div class="col-sm-12 ">
                    @if(Session::has('error'))
                    <div class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2 alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('error') }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    </div>
                    @endif
                </div>
            </div>
            <form class="row g-3" action="{{ route('admin.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <label for="nombre"><span class="text-danger"></span> Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="modelo"><span class="text-danger"></span> Modelo</label>
                    <input type="text" name="modelo" id="modelo" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="descripcion"><span class="form-label"></span>Descripción:</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                </div>
                <div class="col-md-6">
                    <label for="precio"><span class="text-danger"></span> Precio</label>
                    <input type="number" name="precio" id="precio" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="activo"><span class="text-danger"></span> Activo</label>
                    <input type="number" name="activo" id="activo" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="kilometraje"><span class="text-danger"></span> Kilometraje</label>
                    <input type="number" name="kilometraje" id="kilometraje" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="disponibilidad"><span class="text-danger"></span> Disponibilidad</label>
                    <input type="text" name="disponibilidad" id="disponibilidad" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="imagen"><span class="form-label"></span>Imagen</label>
                    <input type="file" class="form-control" id="input-imagen" name="imagen" accept="image/*" required>
                    <img id="imagen-preview" src="" style="max-width: 100px;">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary" onclick="mostrarMensaje()">Agregar</button>
                </div>
                <script>
                    function mostrarMensaje() {
                        // Mostrar mensaje de éxito
                        alert("Se agregó el producto con éxito.");
                    }
                </script>
            </form>
        </div>
    </main>
    <script>
        document.getElementById("input-imagen").addEventListener("change", function(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imageSrc = e.target.result;
                    var imagenPreview = document.getElementById("imagen-preview");
                    imagenPreview.src = imageSrc;
                };
                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
</body>