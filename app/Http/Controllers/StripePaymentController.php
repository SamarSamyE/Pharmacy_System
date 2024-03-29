<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class StripePaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function stripe(Order $order)
    {
        // $order = Order::where('id',6)->first();
       // 4242 4242 4242 4242
        return view('stripe',compact("order"));
    }

    public function stripePost(Request $request,Order $order)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" =>$order->price,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
        ]);
        $order->update([
            'status' => 'Confirmed'
        ]);
        Session::flash('success', 'Payment successful!');

        return back();


    }


}

