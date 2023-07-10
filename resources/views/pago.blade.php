
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
    @if(\Session::has('error'))
        <div class="alert alert-danger">{{ \Session::get('error') }}</div>
        {{ \Session::forget('error') }}
    @endif
    @if(\Session::has('success'))
        <div class="alert alert-success">{{ \Session::get('success') }}</div>
        {{ \Session::forget('success') }}
    @endif
    <!--contenido-->
    <main>
        <div class="container mt-4">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3"> 
                <div class="col-6">
                    <h4> Detalles de pago</h4>      
                    <ul class="flex border-b lg:mx-56 mt-4">
                        <li class="-mb-px mr-1">
                            @if($compras && count($compras->detalle_compra) > 0)
                            <button class="btn btn-outline-success">Pagar con Tarjeta de Crédito</button>
                            @else
                                <button class="btn btn-outline-success" disabled>Pagar con Tarjeta de Crédito</button>
                            @endif  
                        </li>
</br>
                        <li class="mr-1">
                            @if($compras && count($compras->detalle_compra) > 0)
                                <button class="btn btn-outline-success"><a href="{{url('/paypal/pay')}}">Pagar con Paypal</a></button>
                            @else
                                <button class="btn btn-outline-success" disabled>Pagar con Paypal</button>
                            @endif                        
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
                        @if($compras && count($compras->detalle_compra) > 0)
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
                                    <span class="h3 text-end" id="total">Total: </span>
                                    <span class="h3 text-end">      ${{ number_format($compras->total, 2, '.', ',') }}</span>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td colspan="5">
                                    <p style="font-weight: bold; font-size: smaller; text-align: center;">La lista de compras está vacía.</p>
                                </td>

                            </tr>
                            @endif
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