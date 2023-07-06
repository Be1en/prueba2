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
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
</svg>
</head>

<body>
    <header>
        <div class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a href="{{route('/')}}" class="navbar-brand">
                    <strong>Tienda Online</strong>
                </a>
            </div>
        </div>
    </header>

    <!--contenido-->
    <main class="form-login pt-4">
    

        <div class="container text-center mt-4" style="max-width: 350px" >
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
            <h2>Iniciar sesión</h2>
            <form class="row g-3" action="{{route('inicioSesion')}}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="proceso" value="">
                <div class="form-floating">
                    <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Usuario" required>
                    <label for="usuario">Usuario</label>
                </div>
                <input type="hidden" name="proceso" value="">
                    <div class=" form-floating ">
                        <div class=" form-floating input-group">
                            <input  class="form-control "  type="password" name="password" id="password" placeholder="Contraseña" required>
                            <label for="password">Contraseña</label>
                            <button type="button" class="btn btn-outline-secondary" id="showPasswordBtn">
                                <i class="bi bi-eye-fill" id="showPasswordIcon"></i>
                                
                            </button>
                            
                        </div>
                    </div>
                

                <script>
                    document.getElementById("showPasswordBtn").addEventListener("click", function() {
                        var passwordInput = document.getElementById("password");
                        var showPasswordIcon = document.getElementById("showPasswordIcon");
                        if (passwordInput.type === "password") {
                            passwordInput.type = "text";
                            showPasswordIcon.classList.remove("bi-eye-fill");
                            showPasswordIcon.classList.add("bi-eye-slash-fill");
                        } else {
                            passwordInput.type = "password";
                            showPasswordIcon.classList.remove("bi-eye-slash-fill");
                            showPasswordIcon.classList.add("bi-eye-fill");
                        }
                    });
                </script>
                <div class="col-12">
                    <a href="#">¿Olvidaste tu contraseña?</a>
                </div>
                <div class="d-grid gap-3 col-12">
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </div>
                <hr>
                <div class="col-12">
                    ¿No tienes cuenta? <a href="{{ route('registro') }}">Regístrate aquí</a>
                </div>

            </form>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>


</body>

</html>