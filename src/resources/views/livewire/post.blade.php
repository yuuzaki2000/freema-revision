        <div class="center-container">
            <div class="title-bar-container">
                <div>
                    <div style="height:50px;width:50px;">
                        <img src="{{asset('storage/profile_img/' . $product->trade->buyer->profile->image)}}" alt="ユーザー画像" style="width:100%;">
                    </div>
                    <h2>「{{$product->trade->buyer->name}}」さんとの取引画面</h2>
                </div>
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
                    @php
                        $contents = App\Models\Message::where('trade_id', $product->trade->id)->get();
                    @endphp
                    @foreach ($contents as $content)
                        @if($content->user_id == Auth::id())
                            <form action="/products/{{$product->id}}/trades/messages/{{$content->id}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div style="margin-left: 60%;">
                                    <div style="height:50px;width:50px;">
                                        <img src="{{asset('storage/profile_img/' . $product->trade->seller->profile->image)}}" alt="ユーザー画像" style="width:100%;">
                                    </div>
                                    <input type="text" style="width:800px;" name="content" value="{{$content->content}}">
                                </div>
                                @if ($content->image)
                                <div style="margin-left: 60%;">
                                    <img src="{{asset('storage/message_img/' . $content->image)}}" alt="画像メッセージ">
                                </div>
                                @endif
                                <div class="update-delete-btn" style="margin-left: 60%;font-weight:200;">
                                    <button wire:click="changeToEditable">編集</button>
                                </div>
                            </form>
                            <form class="update-delete-btn" style="margin-left: 60%;font-weight:200;" action="/products/{{$product->id}}/trades/messages/{{$content->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                    <button type="submit">削除</button>
                            </form>
                        @else
                            <div style="height:50px;width:50px;">
                                <img src="{{asset('storage/profile_img/' . $product->trade->buyer->profile->image)}}" alt="ユーザー画像" style="width:100%;">
                            </div>
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
                    <input type="text" name="content" wire:model="content" style="width:400px;" placeholder="取引メッセージを入力してください">
                    <label class="file-label">
                        画像を追加
                        <input type="file" name="file" class="file-input">
                    </label>
                    <input type="hidden" name="page" value="seller">
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
        <style> 
.center-container {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.title-bar-container {
    height: 15%;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}

.trade-complete__btn {
    background-color: #FF8282;
    color: #FFF;
    width: 20vh;
    height: 4vh;
    border-radius: 2vh;
}

.product-info-container {
    height: 20%;
    border-top: 2px solid #000;
    display: flex;
    flex-direction: row;
}

.product-name {
    font-weight: bold;
    font-size: 20px;
}

.product-info {
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    margin-left: 20px;
}

.message-container {
    height: 65%;
    border-top: 2px solid #000;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.product-img__wrapper {
    width: 50px;
}

.product-img {
    width: 100%;
}

.file-input {
    display: none;
}

.file-label {
    display: inline-block;
    padding: 10px 20px;
    background-color: blue;
    color: #FFF;
    border-radius: 4px;
    cursor: pointer;
}

.update-delete-btn {
    display: flex;
    flex-direction: row;
}

.delete-btn {
    margin-left: 15px;
}
        </style>

