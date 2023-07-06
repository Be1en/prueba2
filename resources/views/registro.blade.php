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
            <h2>Datos del cliente</h2>
            <div class="row">
                <div class="col-sm-12 ">
                    @if(Session::has('error'))
                    <div class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2 alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('error') }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        
                    </div>
                    @endif
                </div>
            </div>
            <form class="row g-3" action="{{route('registrarCliente')}}" method="post" autocomplete="off">
                @csrf
                <div class="col-md-6">
                    <label for="nombres"><span class="text-danger">*</span> Nombres</label>
                    <input type="text" name="nombres" value="{{ old('nombres') }}" id="nombres" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="apellidos"><span class="text-danger">*</span> Apellidos</label>
                    <input type="text" name="apellidos" value="{{ old('apellidos') }}" id="apellidos" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="email"><span class="text-danger">*</span> Correo electronico</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required>
                    <span id="validaEmail" class="text-danger"></span>
                </div>
                <div class="col-md-6">
                    <label for="telefono"><span class="text-danger">*</span> Telefono</label>
                    <input type="tel" name="telefono" id="telefono" value="{{ old('telefono') }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="dni"><span class="text-danger">*</span> DNI</label>
                    <input type="text" name="dni" id="dni" value="{{ old('dni') }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="usuario"><span class="text-danger">*</span> Usuario</label>
                    <input type="text" name="usuario" id="usuario" value="{{ old('usuario') }}" class="form-control" required>
                    <span id="validaUsuario" class="text-danger"></span>
                </div>
                <div class="col-md-6">
                    <label for="password"><span class="text-danger">*</span> Contraseña</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" required>
                        <button type="button" class="btn btn-outline-secondary" id="showPasswordBtn">
                            <i class="bi bi-eye-fill" id="showPasswordIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="repassword"><span class="text-danger">*</span> Repetir contraseña</label>
                    <div class="input-group">
                        <input type="password" name="repassword" id="repassword" class="form-control" required>
                        <button type="button" class="btn btn-outline-secondary" id="showRepasswordBtn">
                            <i class="bi bi-eye-fill" id="showRepasswordIcon"></i>
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

                    document.getElementById("showRepasswordBtn").addEventListener("click", function() {
                        var repasswordInput = document.getElementById("repassword");
                        var showRepasswordIcon = document.getElementById("showRepasswordIcon");
                        if (repasswordInput.type === "password") {
                            repasswordInput.type = "text";
                            showRepasswordIcon.classList.remove("bi-eye-fill");
                            showRepasswordIcon.classList.add("bi-eye-slash-fill");
                        } else {
                            repasswordInput.type = "password";
                            showRepasswordIcon.classList.remove("bi-eye-slash-fill");
                            showRepasswordIcon.classList.add("bi-eye-fill");
                        }
                    });
                </script>

                <i><b>Nota:</b>Los campos con asteriscos con obligatorios</i>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script>
        let txtUsuario = document.getElementById('usuario')
        txtUsuario.addEventListener("blur", function() {
            existeUsuario(txtUsuario.value)
        }, false)

        let txtEmail = document.getElementById('email')
        txtEmail.addEventListener("blur", function() {
            existeEmail(txtEmail.value)
        }, false)

        function existeEmail(email) {
            let url = "clases/clienteAjax.php"
            let formData = new FormData()
            formData.append("action", "existeEmail")
            formData.append("email", email)

            fetch(url, {
                    method: 'POST',
                    body: formData
                }).then(response => response.json())
                .then(data => {

                    if (data.ok) {
                        document.getElementById('email').value = ''
                        document.getElementById('validaEmail').innerHTML = 'Email no disponible'
                    } else {
                        document.getElementById('validaEmail').innerHTML = ''
                    }
                })
        }

        function existeUsuario(usuario) {
            let url = "clases/clienteAjax.php"
            let formData = new FormData()
            formData.append("action", "existeUsuario")
            formData.append("usuario", usuario)

            fetch(url, {
                    method: 'POST',
                    body: formData
                }).then(response => response.json())
                .then(data => {

                    if (data.ok) {
                        document.getElementById('usuario').value = ''
                        document.getElementById('validaUsuario').innerHTML = 'Usuario no disponible'
                    } else {
                        document.getElementById('validaUsuario').innerHTML = ''
                    }
                })
        }
    </script>
</body>

</html>