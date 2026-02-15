@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/mypage.css')}}">
@endsection

@section('content')
<div>
    <div class="upper">
        @isset($profile)
        <div>
            <img src="{{asset('storage/profile_img/' . $profile->image)}}" alt="プロフィール画像">
        </div>
        @endisset
        <h2>{{$profile->user->name}}</h2>
        @php
            $stars = App\Models\Star::where('user_id', $profile->user_id)->get();
            $stars_count = $stars->count();
            if($stars){
                $star_point = round($stars->pluck('point')->avg());
            }else{
                $star_point = 0;
            }
            
        @endphp
        <div class="stars">
            @if ($star_point < 1)
                <div></div>
            @else
                @for ($i = 1; $i <= 5; $i++)
                    <span class="{{$i <= $star_point ? 'filled' : ''}}">★</span>
                @endfor   
            @endif
        </div>
        <a href="/mypage/profile" class="skt-btn">プロフィールを編集</a>
    </div>
    <div class="bottom">
        <form action="/mypage" method="get" class="exhibition">
            <input type="hidden" name="page" value="sell">
            <button type="submit" class="exhibition-btn">出品した商品</button>
        </form>
        <form action="/mypage" method="get" class="purchase">
            <input type="hidden" name="page" value="buy">
            <button type="submit" class="purchase-btn">購入した商品</button>
        </form>
        <form action="/mypage" method="get" class="purchase">
            <input type="hidden" name="page" value="trade">
            <button type="submit" class="purchase-btn">取引中の商品</button>
            {{--
            @php
                if(){
                    $message_count = App\Models\Trade::where('seller_id', Auth::id())->get()->count();
                }else if(){
                    $message_count = App\Models\Trade::where('buyer_id', Auth::id())->get()->count();
                }else{
                    $message_count = 0;
                }
            @endphp  --}}
            @php
                $message_count = App\Models\Trade::where('seller_id', Auth::id())->get()->count();
            @endphp
            @if ($message_count)
                <div class="icon-wrapper">
                    <span class="badge">{{$message_count}}</span>
                </div>
            @else
                <div><p></p></div>
            @endif
        </form>
    </div>
    <div class="container">
        @php
            $particularProducts = $products->sortBy('created_at');
            //変更要
        @endphp
        <ul class="group">
                @if ($products->count() > 0)
                @foreach ($products as $product)
                    @php
                        if($product->trade){
                            $message_count = App\Models\Message::where('trade_id', $product->trade->id)
                                        ->whereHas('trade', function ($query) {
                                                $query->where('seller_id', Auth::id());
                                        })->count();
                        }else{
                            $message_count = 0;
                        }
                    @endphp
                    <li class="compartment">
                        <form action="/products/{{$product->id}}/trades" class="item" method="GET">
                            @csrf
                                    @if ($message_count)
                                        <div class="icon-wrapper">
                                            <span class="badge">{{$message_count}}</span>
                                        </div>
                                    @else
                                        <div><p></p></div>
                                    @endif
                                <button type="submit"><img src="{{asset($product->image)}}" alt="商品画像" width="100%"></button>
                                <div class="product-info">
                                    <p>{{$product->name}}</p>
                                </div>
                        </form>
                    </li>
                @endforeach
                @endif
        </ul>
    </div>
</div>
@endsection