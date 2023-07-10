<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Exception\PayPalConnectionException;




class PaymentController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $payPalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret']
            )
        );

        $this->apiContext->setConfig($payPalConfig['settings']);
    }

    // ...

    public function payWithPayPal()
    {
        $user = Auth::user();
        $compras = $user->compra()->with('detalle_compra')->first();
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
        // $transaction->setDescription('See your IQ results');

        $callbackUrl = url('/paypal/status');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);
        try {
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }

 

// ...

public function payPalStatus(Request $request)
{
    $paymentId = $request->input('paymentId');
    $payerId = $request->input('PayerID');
    $token = $request->input('token');

    if (!$paymentId || !$payerId || !$token) {
        $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
        return redirect('/paypal/failed')->with(compact('status'));
    }

    try {
        $payment = Payment::get($paymentId, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() === 'approved') {
            $transaction = $result->getTransactions()[0];
            $relatedResources = $transaction->getRelatedResources();
            $sale = $relatedResources[0]->getSale();
            // Aquí puedes acceder a las propiedades de $sale según tus necesidades, pero no hay una función getTransactionFee() disponible

            $status = 'Gracias! El pago a través de PayPal se ha realizado correctamente.';
            return redirect('/pago')->with(compact('status'));
        }
    } catch (PayPalConnectionException $ex) {
        $status = 'Lo sentimos! Hubo un problema con el pago a través de PayPal.';
        return redirect('/pago')->with(compact('status'));
    }

    $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
    return redirect('/pago')->with(compact('status'));
}

}
