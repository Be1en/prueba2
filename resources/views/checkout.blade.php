@extends('welcome')

@section('contenido')

<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>
<body>
    <main>
        <div class="container">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($compras as $compra)
                        @foreach($compra->detalle_compra as $detalle)
                        <tr>
                            <td>{{$detalle->nombre}}</td>
                            <td>{{$detalle->precio}}</td>
                            <td>
                                <div class="input-group">
                                    <input type="number" name="cantidad" value="{{$detalle->cantidad}}" data-id="{{$detalle->id}}" class="form-control input-cantidad" min="1" max="10" onkeydown="return false" onclick="updateCantidad(this)">
                                </div>
                            </td>
                            <td>
                                <span class="subtotal">${{ number_format($detalle->precio * $detalle->cantidad, 2, '.', ',') }}</span>
                            </td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm eliminar" data-bs-toggle="modal" data-bs-target="#eliminaModal" onclick="mostrarModalEliminar({{$detalle->id}})">Eliminar</a>
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">
                                <span class="h3" id="total">Total: </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-5 offset-md-7 d-grid gap-2">
                <a href="{{route('compraUsuarioPago')}}"  class="btn btn-primary btn-lg">Realizar pago</a>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminaModalLabel">Alerta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Desea eliminar el producto de la lista?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="eliminar-producto btn btn-danger"data-bs-dismiss="modal" data-detalle-id="" onclick="eliminar(this)">Eliminar</button>

                </div>
            </div>
        </div>
    </div>

    <script>
        
        function updateCantidad(input) {
            var cantidad = input.value;
            var id = input.getAttribute('data-id');
            var precio = input.parentNode.parentNode.previousElementSibling.innerHTML;
            var subtotalElement = input.parentNode.parentNode.nextElementSibling.querySelector('.subtotal');
            var totalElement = document.getElementById('total');

            // Calcular el nuevo subtotal
            var subtotal = parseFloat(precio) * parseInt(cantidad);
            var formattedSubtotal = formatNumber(subtotal, 2);

            // Actualizar el valor del subtotal
            subtotalElement.innerHTML = '$' + formattedSubtotal;

            // Obtener todos los elementos con la clase "subtotal"
            var subtotalElements = document.querySelectorAll('.subtotal');

            var total = 0;
            subtotalElements.forEach(function(element) {
                total += parseFloat(element.textContent.replace('$', '').replace(',', ''));
            });
            var formattedTotal = formatNumber(total, 2);

            totalElement.innerHTML = 'Total: $' + formattedTotal;


            




            // Obtener el token CSRF
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Realizar la solicitud AJAX al controlador
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // La solicitud se ha completado correctamente
                    console.log('Cantidad actualizada en la base de datos');
                }
            };

            xhttp.open("POST", "/actualizarCantidad", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.setRequestHeader("X-CSRF-TOKEN", token); // Incluir el token CSRF en la solicitud
            xhttp.send("id=" + id + "&cantidad=" + cantidad);
            
        }

        function formatNumber(number, decimals) {
            var options = {
                minimumFractionDigits: decimals,
                maximumFractionDigits: decimals
            };
            return number.toLocaleString('en-US', options);
        }
        //MODIFICANDO

        function updateTotals() {
            var subtotalElements = document.querySelectorAll('.subtotal');
            var totalElement = document.getElementById('total'); // SE RECUPERA EL TOTAL 

            var total = 0;
            subtotalElements.forEach(function(element) {
                total += parseFloat(element.textContent.replace('$', '').replace(',', ''));
            });

            var formattedTotal = formatNumber(total, 2);
            totalElement.innerHTML = 'Total: $' + formattedTotal;
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateTotals();

        // ACTUALIZAR TABLA COMPRAS
            


        });


        //MODIFICANDO
        function mostrarModalEliminar(id) {
            var eliminarButton = document.querySelector('.eliminar-producto');
            eliminarButton.setAttribute('data-detalle-id', id);
            $('#eliminaModal').modal('show');
        }
        
        function eliminar(button) {
            var id = button.getAttribute('data-detalle-id');
            console.log(id); // Imprime el id en la consola para verificarlo

            // Ocultar el modal
            $('#eliminaModal').modal('hide');

            // Eliminar la clase "modal-open" del elemento "body"
            document.body.classList.remove('modal-open');

            // Realizar la solicitud de eliminación mediante AJAX o redirección a la URL correspondiente
            // Puedes usar Axios, Fetch API o jQuery AJAX para enviar la solicitud DELETE

            axios.delete('/carrito/' + id)
                .then(function(response) {
                    // La eliminación fue exitosa
                    // Puedes actualizar la vista o mostrar un mensaje de éxito
                    
                    updateTotals();
                    // Recargar la página
                    location.reload();
                    // Cerrar el modal
                    $('#eliminaModal').modal('hide');

                    // Mostrar el mensaje de éxito
                    alert('Producto eliminado del carrito');
                })
                .catch(function(error) {
                    // Ocurrió un error al eliminar
                    // Puedes mostrar un mensaje de error
                    console.log(error);
                });
                location.reload();
        }


    </script>
</body>
</html>
@endsection
