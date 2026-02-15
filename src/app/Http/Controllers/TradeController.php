<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Trade;
use App\Models\Message;
use App\Models\Listing;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MessageRequest;
use App\Notifications\TradeNotification;

class TradeController extends Controller
{
    //
    public function index($item_id){
        $product = Product::find($item_id);
        $trade = $product->trade;


        if($trade->status == "negotiating"){
            return redirect("/products/{$item_id}/trades/{$trade->id}");
        }else{
            return redirect("/products/{$item_id}/trades/{$trade->id}#modal");
        }
        
    }

    public function getDetail($item_id, $trade_id){
        $trade = Trade::find($trade_id);
        if($trade->buyer->id == Auth::id()){
            $side_trades = Trade::where('buyer_id', Auth::id())->get();
            $product = Product::find($item_id);
            $contents = Message::all();
            return view('trade_chat_buyer', compact('product', 'contents', 'side_trades'));
        }else if(Trade::find($trade_id)->seller->id == Auth::id()){
            $side_trades = Trade::where('seller_id', Auth::id())->get();
            $product = Product::find($item_id);
            $contents = Message::all();
            return view('trade_chat_seller', compact('product', 'contents','side_trades'));
        }else{
        }
    }

    public function sendMessage(MessageRequest $request, $item_id){

        if($request->page == 'buyer'){
            $trade = Trade::where('product_id', $item_id)->where('buyer_id', Auth::id())->first();
        }else if($request->page == 'seller'){
            $trade = Trade::where('product_id', $item_id)->where('seller_id', Auth::id())->first();
        }else{
            $trade = null;
        }

        $data = $request->only(['content']);
        //選択した画像をstorage/message_imgに保存
        $file = $request->file('file');
        $product = Product::find($item_id);
        $trade = $product->trade;
        if($file !== null){
            $file_name = $file->getClientOriginalName(); 
            $file->storeAs('public/message_img', $file_name);
            $data['image'] = $file_name;

            Message::create([
                'trade_id' => $trade->id,
                'user_id' => Auth::id(),
                'content' => $request->input('content'),
                'image' => $data['image'],
            ]);
        }else{
            Message::create([
                'trade_id' => $trade->id,
                'user_id' => Auth::id(),
                'content' => $request->input('content'),
                'image' => null,
            ]);
        }

        return redirect("/products/{$item_id}/trades/{$trade->id}");
    }

    public function complete(Request $request, $item_id){

        $trade = Trade::where('product_id', $item_id)->where('buyer_id', Auth::id())->first();
        $trade->update(['status' => "completed"]);

        $product = Product::find($item_id);

        $trade->seller->notify(new TradeNotification($product));

        return redirect("/products/{$item_id}/trades/{$trade->id}#modal");
    }

    public function update(Request $request, $item_id, $message_id){
        $message = Message::find($message_id);
        /*
        $message->update(['content' => '資料を直ちにいただきたい']);  */

        return redirect("/products/{$item_id}/trades/{$message->trade_id}");
    }

    public function delete(Request $request, $item_id, $message_id){
        $message = Message::find($message_id);
        $message->delete();
        return redirect("/products/{$item_id}/trades/{$message->trade_id}");
    }
}
