<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Omnipay\Omnipay;

class PaypalController extends Controller
{
    private $geteway;

    public function __construct()
    {
        $this->geteway = Omnipay::create('PayPal_Rest');
        $this->geteway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->geteway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->geteway->setTestMode(true);
    }

    public function paypal()
    {
        if (Session::has('order_id')) {

            return view('new_website.payment.paypal');
        } else {
            return redirect('cart/show');
        }
    }

    public function pay(Request $request)
    {
        try {
            $paypal_amount = round(Session::get('grand_total'), '2');
            $response = $this->geteway->purchase(array(
                'amount' => $paypal_amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('error'),
            ))->send();
            if ($response->isRedirect()) {
                $response->redirect();
            } else {
                return $response->getMessage();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function success(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {

            $transaction = $this->geteway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();
            if ($response->isSuccessful()) {
                $arr = $response->getData();
                $payment = new Payment();
                $payment->order_id = Session::get('order_id');
                $payment->user_id = Auth::id();
                $payment->payment_id = $arr['id'];
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr['payer']['payer_info']['email'];
                $payment->amount = $arr['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr['state'];
                $payment->save();

                ////////// Update Order Status
                ///
                $order_id = Session::get('order_id');
                //////// Update Order Status To Paid
                ///
                Order::where('id',$order_id)->update(['order_status'=>'paid']);
                // empty The Cart
                Cart::where('user_id',Auth::id())->delete();
                return view('new_website.payment.success');
//                return "Payment Is Success. Your Transation Is" . $arr['id'];
            } else {
                return $response->getMessage();
            }
        } else {
            return "Payment Declined";
        }
    }

    public function errorPayment()
    {

        return view('new_website.payment.fail');
    }
}
