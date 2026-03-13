<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\Product;
use App\Models\Listing;
use App\Models\Purchase;
use App\Http\Requests\AddressRequest;
use App\Models\User;
use App\Models\Trade;
use App\Models\Message;



class ProfileController extends Controller
{
    //
    public function index(Request $request){

        $trades = Trade::where(function($q) {
                            $q->where('buyer_id', Auth::id())
                                ->orWhere('seller_id', Auth::id());
                        })
                        ->with('latestMessage')
                        ->get()
                        ->sortByDesc(function($trade) {
                                        if ($trade->latestMessage && $trade->latestMessage->user_id !== Auth::id()) {
                                                return $trade->latestMessage->created_at;
                                        }
                                        return null; 
                        })
                        ->values();

        if($request->page == "buy"){
            $purchases = Purchase::where('user_id', Auth::id())->get();
            $products = collect();
            foreach($purchases as $purchase){
                $product = Product::find($purchase->product_id);
                $products->push($product);
            }
            $page = $request->page;
        }else if($request->page == "sell"){
            $listings = Listing::where('user_id', Auth::id())->get();
            $products = collect();
            foreach($listings as $listing){
                $product = Product::find($listing->product_id);
                $products->push($product);
            }
            $page = $request->page;
        }else if($request->page == "trade"){
            
            $products = $trades->map(function ($trade) {
                                    return Product::find($trade->product_id);
                                });

            $page = $request->page;
        }else{
            $products = $trades->map(function ($trade) {
                                    return Product::find($trade->product_id);
                                });
            $page = $request->page;
        }


        $total_message_count = 0;

        if ($products->count() > 0){
            foreach($products as $product){
                if($product->trade){
                        $last_my_message = Message::where('trade_id', $product->trade->id)
                                        ->where('user_id', Auth::id())
                                        ->latest()
                                        ->first();
                        if($last_my_message){
                            $message_count = Message::where('trade_id', $product->trade->id)
                                        ->where('user_id', '!=', Auth::id())
                                        ->orderBy('created_at', 'desc')
                                        ->where('id', '>', $last_my_message->id)
                                        ->count();
                            $total_message_count += $message_count;
                        }
                }else{
                        $message_count = 0;
                }
            }
        }else{
        }

        $profile = Profile::where('user_id', Auth::id())->first();

        return view('mypage', compact('products', 'page', 'profile', 'total_message_count'));
    }

    public function configure(){
        $userId = Auth::id();
        $profile = Profile::where('user_id', Auth::id())->first();

        if(empty($profile)){
            $data = [
            'userId' => $userId,
            'profileId' => null,
            ];

        }else{
            $data = [
            'userId' => $userId,
            'profileId' => $profile->id,
            ];
        }
        
        return view('profile_update', $data);
    }

    public function store(Request $request){

        $profile = new Profile();
        $profile->image = $request->image;
        $profile->user_id = $request->user_id;
        $profile->post_code = $request->post_code;
        $profile->address = $request->address;
        $profile->building = $request->building;
        $profile->save();

        return redirect('/login');
    }

    public function update(Request $request){
        $profile = Profile::where('user_id', $request->user_id)->first();
        $profile->update($request->all());
        return redirect('/mypage');
    }

    public function getAddressChangeView($item_id){
        $product = Product::find($item_id);
        $profile = Profile::where('user_id', Auth::id())->first();
        $data = [
            'product' => $product,
            'post_code' => $profile->post_code,
            'address' => $profile->address,
            'building' => $profile->building,
        ];

        return view('address_change', $data);
    }

    public function sendAddress(Request $request, $item_id){
        $product = Product::find($item_id);
        $data = [
            'product' => $product,
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building' => $request->building,
        ];
        return view('purchase', $data);
    }
}
