<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Auth\OAuthTokenCredential;
use \Illuminate\Support\Facades\Config;
use PayPal\Rest\ApiContext;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use Illuminate\Support\Facades\Auth;
use PayPal\Api\Sale;
use Carbon\Carbon;

class PagoController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $paypalConfig = config('services.paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $paypalConfig['client_id'],
                $paypalConfig['secret']
            )
        );

        $this->apiContext->setConfig($paypalConfig['settings']);
    }

    public function createPayment()
    {
        $user = Auth::user();
        $compras = $user->compra()->with('detalle_compra')->where('status', 'PENDING')->first();

        //dd($compras);
        $total=0;
        foreach($compras->detalle_compra as $compra){
            $total = $total+$compra->precio*($compra->cantidad);
        }
        $compras->total=$total;

            

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($total);
        $amount->setCurrency('USD');

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $callbackUrl = route('paypal.status');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function executePayment(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
    
        if (!$paymentId || !$payerId) {
            // Error: Parámetros de pago inválidos
            return redirect('/pago')->with('error', 'Lo sentimos, ha ocurrido un error en el pago.');
        }
    
        $payment = Payment::get($paymentId, $this->apiContext);
    
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);
    
        try {
            $result = $payment->execute($execution, $this->apiContext);
            // Pago exitoso

            $transactions = $result->getTransactions();
            $relatedResources = $transactions[0]->getRelatedResources();
            $sale = $relatedResources[0]->getSale();
            $transactionId = $sale->getId();
        

            $user = Auth::user();
            $compras = $user->compra()->with('detalle_compra')->where('status', 'PENDING')->first();

            //dd($compras);
            $total=0;
            foreach($compras->detalle_compra as $compra){
                $total = $total+$compra->precio*($compra->cantidad);
            }
            $compra = $user->compra()->where('status', 'PENDING')->first();
            if ($compra && $compra->status !== 'COMPLETED') {
                // Marcar el pago como completado y guardar la información adicional
                $compra->status = 'COMPLETED';
                $compra->id_transaccion = $transactionId;
                // Obtener la fecha y hora actual
                $fechaPago = Carbon::now();
                $compra->fecha = $fechaPago->format('Y-m-d H:i:s');
                
                $compra->total=$total;
                // Obtener el email del pagador
                $payerEmail = $result->payer->payer_info->email;
                $compra->email = $payerEmail;
                
                $compra->save();
            }

    
            // Obtener el total y las compras actualizadas para mostrar en la página
            $user = Auth::user();
            $compras = $user->compra()->with('detalle_compra')->first();
            if ($compras && $compras->detalle_compra->isNotEmpty()) {
                $total = 0;
                foreach ($compras->detalle_compra as $compra) {
                    $total += $compra->precio * $compra->cantidad;
                }
                $compras->total = $total;
            } else {
                $compras = null;
            }
    
            return redirect('/pago')->with(['compras' => $compras, 'success' => '¡Compra realizada exitosamente!']);
        } catch (\Exception $e) {
            // Error en el pago
            //dd($e);
            return redirect('/pago')->with('error', 'Lo sentimos, ha ocurrido un error en el pago.');
        }
    }
    public function compraUsuario()
    {
        $user = Auth::user();
        $compras = $user->compra()->with('detalle_compra')->where('status', 'PENDING')->first();
        if ($compras && $compras->detalle_compra->isNotEmpty()) {
            $total = 0;
            foreach($compras->detalle_compra as $compra) {
                $total += $compra->precio * $compra->cantidad;
            }
            $compras->total = $total;
        } else {
            $compras = null;
        }
        return view('pago', compact('compras'));
    }

}
