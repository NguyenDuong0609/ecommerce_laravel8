<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Mail\OrderPaid;
use NunoMaduro\Collision\Provider;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
    public function getExpressCheckout($orderId)
    {

        $checkoutData = $this->checkoutData($orderId);

        $provider = new ExpressCheckout();

        $response = $provider->setExpressCheckout($checkoutData);

        return redirect($response['paypal_link']);
    }

    private function checkoutData($orderId){

        $cartItems = array_map( function($item){
            return [
                'name' => $item['name'],
                'price' => $item['price'],
                'qty' => $item['qty'],
            ];
        }, Cart::content()->toarray());

        $checkoutData = [
            'items' => $cartItems,
            'return_url' => route('paypal.success', $orderId),
            'cancel_url' => route('paypal.cancel'),
            'invoice_id' => uniqid(),
            'invoice_description'=> 'Order description',
            'total' => Cart::total()
        ];

        return $checkoutData;
    }

    public function cancelPage()
    {

    }

    public function getExpressCheckoutSuccess(Request $request, $orderId)
    {
        $token = $request->get('token');
        $payerId = $request->get('PayerID');
        $provider = new ExpressCheckout();
        $checkoutData = $this->checkoutData($orderId);

        $response = $provider->getExpressCheckoutDetails($token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

            //Perfom transaction on Paypal
            dd($payerId);
            $payment_status = $provider->doExpressCheckoutPayment($checkoutData, $token, $payerId);

            dd($payment_status);

            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];

            if(in_array($status, ['Completed', 'Processed'])) {
                $order = Order::find($orderId);
                $order->is_paid = 1;
                $order->status = $status;

                $order->save();

                // send mail

                Mail::to($order->user->email)->send(new OrderPaid($order));

                Cart::destroy();

                return redirect('/')->withMessage('Payment successful!');
            }
        }

        return redirect('/')->withError('Payment UnSuccessful! Something went wrong!');
    }
}
