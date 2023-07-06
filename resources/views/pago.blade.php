
@extends('welcome')
@section('contenido')

<html lang="es">
<head>
  <script 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
    crossorigin="anonymous"></script>
<!--en ese id= va el id del cliente-->
    <script src="https://www.paypal.com/sdk/js?client-id="></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body> 
    
    <!--contenido-->
    <main>
        <div class="container mt-4">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3"> 
                <div class="col-6">
                    <h4> Detalles de pago</h4>      
                    <ul class="flex border-b lg:mx-56 mt-4">
                        <li class="-mb-px mr-1">
                            <button class="btn btn-outline-success">Pagar con Tarjeta de Crédito</button>
                        </li>
</br>
                        <li class="mr-1">
                            <button class="btn btn-outline-success"><a href="{{url('/paypal/pay')}}">Pagar con Paypal</a></button>
                        </li>
                    </ul>
                </div>

                <div class="col-6"></div>
                <div class="table-responsive">
                    <table class=" table">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Subtotal</th>
                                <th></th>

                            </tr>
                        </thead>
                        
                        <tbody>
                  
                        @foreach($compras->detalle_compra as $detalle)
                            <tr>
                                
                                <td>{{$detalle->nombre}}</td>
                                <td>
                                    <span class="subtotal">${{ number_format($detalle->precio * $detalle->cantidad, 2, '.', ',') }}</span>
                                    
                                </td>
                                @endforeach
               
                            </tr>
                            
                            <tr>
                                <td colspan="2">
                                    <span class="h3 text-end" id="total">Total: </span>{{$compras->total}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

<script>


//-----------------------------------------------------------------------
        function calcularTotal() {


            // Obtener todos los elementos con la clase "subtotal"
            var subtotalElements = document.querySelectorAll('.subtotal');

            var total = 0;
            subtotalElements.forEach(function(element) {
                total += parseFloat(element.textContent.replace('$', '').replace(',', ''));
            });
            var formattedTotal = formatNumber(total, 2);

            totalElement.innerHTML = 'Total: $' + formattedTotal;

        }
        function formatNumber(number, decimals) {
            var options = {
                minimumFractionDigits: decimals,
                maximumFractionDigits: decimals
            };
            return number.toLocaleString('en-US', options);
        }

    </script>

</body>
</html>
@endsection