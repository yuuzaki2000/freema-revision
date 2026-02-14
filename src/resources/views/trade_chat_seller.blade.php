@extends('layouts.trade')

@section('css')
<link rel="stylesheet" href="{{asset('css/trade_chat.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

@section('total-container')
<div class="total-container">
    <div class="side-bar">
        <p class="side-bar-title">その他の取引</p>
        @foreach ($side_trades as $trade)
            <form action="/products/{{$trade->product->id}}/trades" method="GET">
                @csrf
                <button type="submit">取引{{$trade->id}}</button>

            </form>
        @endforeach
    </div>
    <div class="center">
        <div class="center-container">
            <div class="title-bar-container">
                <div>
                    <div style="height:50px;width:50px;">
                        <img src="{{asset('storage/profile_img/' . $product->trade->buyer->profile->image)}}" alt="ユーザー画像" style="width:100%;">
                    </div>
                    <h2>「{{$product->trade->buyer->name}}」さんとの取引画面</h2>
                </div>
                <form action="/products/{{$product->id}}/trades/{{$product->trade->id}}" method="POST">
                    @csrf
                    <button type="submit" class="trade-complete__btn">取引を完了する</button>
                </form>
            </div>
            <div class="product-info-container">
                <div style="height:130px;width:130px;">
                    <img src="{{asset($product->image)}}" alt="商品画像" style="width:100%;">
                </div>
                <div class="product-info">
                    <div class="product-name">{{$product->name}}</div>
                    <div class="product-price">{{$product->price}}円</div>
                </div>
            </div>
            <div class="message-container">
                <div class="message-group">
                    @foreach ($contents as $content)
                        @if($content->user_id == Auth::id())
                            <div style="margin-left: 60%;"><p>{{$content->content}}</p></div>
                            @if ($content->image)
                            <div style="margin-left: 60%;">
                                <img src="{{asset('storage/message_img/' . $content->image)}}" alt="画像メッセージ">
                            </div>
                            @endif
                            <div class="update-delete-btn" style="margin-left: 60%;font-weight:200;">
                                <form action="/products/{{$product->id}}/trades/messages/{{$content->id}}" method="POST">
                                @csrf
                                @method('PATCH')
                                    <button type="submit">編集</button>
                                </form>
                                <form class="delete-btn" action="/products/{{$product->id}}/trades/messages/{{$content->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                    <button type="submit">削除</button>
                                </form>
                            </div>
                        @else
                            <div><p>{{$content->content}}</p></div>
                            @if ($content->image)
                            <div>
                                <img src="{{asset('storage/message_img/' . $content->image)}}" alt="画像メッセージ">
                            </div>
                            <div class="update-delete-btn" style="font-weight:200;">
                                <form action="/products/{{$product->id}}/trades/messages/{{$content->id}}" method="POST">
                                @csrf
                                @method('PATCH')
                                    <button type="submit">編集</button>
                                </form>
                                <form class="delete-btn" action="/products/{{$product->id}}/trades/messages/{{$content->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                    <button type="submit">削除</button>
                                </form>
                            </div>
                        @endif
                        @endif
                    @endforeach
                </div>
                <form action="/products/{{$product->id}}/trades/messages" method="POST" enctype="multipart/form-data">
                @csrf
                    <input type="text" name="content" style="width:400px;" placeholder="取引メッセージを入力してください">
                    <label class="file-label">
                        画像を追加
                        <input type="file" name="file" class="file-input">
                    </label>
                    <input type="hidden" name="page" value="buyer">
                    <button type="submit"><i class="fa-regular fa-paper-plane"></i></button>
                    @error('content')
                        <div style="color:red;">{{$message}}</div>
                    @enderror
                    @error('file')
                        <div style="color:red;">{{$message}}</div>
                    @enderror
                </form>
            </div>
        </div>
        <div class="modal" id="modal">
            <a href="#!" class="modal-overlay"></a>
            <div class="modal__inner">
                <div class="modal__content">
                    <form action="/star/{{$product->trade->id}}" method="POST" class="modal-container">
                        @csrf
                        <h3>取引が完了しました</h3>
                        <p>今回の取引相手はどうでしたか？</p>
                        <select name="star_point">
                            <option value="">星の数を選択</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <input type="hidden" name="star_receiver_id" value="{{$product->trade->buyer->id}}">
                        <button type="submit" class="star__btn">送信する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

