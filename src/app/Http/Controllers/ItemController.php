<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing;
use App\Models\User;
use App\Models\Profile;
use App\Http\Requests\ExhibitionRequest;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Favorite;
use App\Models\Comment;
use App\Models\Trade;


class ItemController extends Controller
{
    //
    public function index(Request $request) {
        $particularFavorites = Favorite::where('user_id', Auth::id())->get();

        $particularListings = Listing::where('user_id', Auth::id())->get();

        if($request->page == null){
            $products = Product::whereHas('listing', function($query){
                $query->where('user_id','!=', Auth::id());
            })->get();
            $page = $request->page;
            $keyword = "";
        }else if($request->page == "mylist"){
            $particularProducts = collect();
            if(empty($particularFavorites)){
                return;
            }else{
                foreach($particularFavorites as $particularFavorite){
                    $product = Product::find($particularFavorite->product_id);
                    $particularProducts->push($product);
                }
            }
            $page = $request->page;
            $keyword = $request->keyword;

            if($keyword !== null){
                $products = $particularProducts->filter(function ($product) use ($keyword) {
                    return strpos($product->name, $keyword) !== false;
                });
            }else{
                $products = $particularProducts;
            }
        }else if($request->page == "favorite"){
            $products = Product::all();
            $keyword = $request->keyword;

            if(empty($particularListings)){
            }else{
                foreach($particularListings as $particularListing){
                    $product = Product::find($particularListing->product_id);
                    if($product == null){
                    }else{
                        $products = Product::where('id', '!=', $product->id)->get();
                    }
                }
            }
            $page = "";
        }

        foreach($products as $product){
            $purchase = Purchase::where('product_id', $product->id)->first();
            if($purchase){
                $product['isSold'] = 'Sold';
            }else{
                $product['isSold'] = '';
            }
            
        }

        return view('index', compact('products', 'page', 'keyword'));
    }

    public function add(){
        $imageFilePath = '';
        $data = [
            'imageFilePath' => $imageFilePath,
        ];
        return view('listing', $data);
    }

    public function store(ExhibitionRequest $request){
        try{

            DB::beginTransaction();

            $product = new Product();
            $product->name = $request->name;
            $product->image = $request->image;
            $product->brand = $request->brand;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->condition = $request->condition;
            $product->save();

            $product->categories()->sync($request->input('category'));

            $productId = $product->id;

            $listing = new Listing();
            $listing->user_id = Auth::id();
            $listing->product_id = $productId;
            $listing->save();

            DB::commit();

            return redirect('/');

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'エラーが発生しました。');
        }
    }

    public function search(Request $request){
        $keyword = $request->keyword;
        $page = $request->page;
        $products = Product::where('name', 'like', "%{$keyword}%")->get();
        return view('index', compact('products', 'keyword','page'));
    }

    public function getDetail($item_id, Request $request){
        $product = Product::find($item_id);
        $categories = Category::all();
        $favorites = Favorite::where('product_id', $item_id)->get();
        $favoriteCount = $favorites->count();
        
        $comments = Comment::where('product_id', $item_id)->get();

        if(empty($request)){
            $imageUrl = 'img/white_star.png';
        }else{
            $imageUrl = $request->imageUrl;
        }

        $data = [
            'product' => $product,
            'categories' => $categories,
            'favoriteCount' => $favoriteCount,
            'comments' => $comments,
            'imageUrl' => $imageUrl,
        ];
        return view('product_detail', $data);
    }

    public function purchase($item_id){
        $product = Product::find($item_id);
        $profile = Profile::where('user_id', Auth::id())->first();
        if(!empty($profile)){
            $data = [
            'product' => $product,
            'post_code' => $profile->post_code,
            'address' => $profile->address,
            'building' => $profile->building,
            ];
        }else{
            $data = [
            'product' => $product,
            'post_code' => "",
            'address' => "",
            'building' => "",
            ];
        }

        Trade::create([
            'product_id' => $item_id,
            'buyer_id' => Auth::id(),
            'seller_id' => $product->listing->user_id,
            'status' => 'negotiating'
        ]);
        
        return view('purchase', $data);
    }
}

