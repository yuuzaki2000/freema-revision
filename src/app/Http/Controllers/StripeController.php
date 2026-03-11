<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PurchaseRequest;
use App\Models\Trade;
use App\Models\Product;


class StripeController extends Controller
{
    //
    public function index(){
        return view('stripe_index');
    }

    public function checkout(PurchaseRequest $request){
        $purchase = new Purchase();
        $purchase->user_id = Auth::id();
        $purchase->product_id = $request->product_id;
        $purchase->payment_method = $request->payment_method;
        $purchase->post_code = $request->post_code;
        $purchase->address = $request->address;
        $purchase->building = $request->building;
        $purchase->save();


        Stripe::setApiKey(config('stripe.sk'));

        $session = Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => [
                            'name' => $purchase->product->name,
                        ],
                        'unit_amount' => $purchase->product->price,
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('index'),
        ]);

        $product = Product::find($request->product_id);

        Trade::create([
            'product_id' => $request->product_id,
            'buyer_id' => Auth::id(),
            'seller_id' => $product->listing->user_id,
            'status' => 'negotiating'
        ]);
        

        return redirect()->away($session->url);
    }

    public function success(){
        return view('stripe_success');
    }
}
