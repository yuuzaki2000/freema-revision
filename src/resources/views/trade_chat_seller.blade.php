@extends('layouts.trade')

@section('css')
<link rel="stylesheet" href="{{asset('css/trade_chat.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@livewireStyles
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
        <livewire:post :product="$product" :contents="$contents" :side_trades="$side_trades" :partner="$product->trade->buyer"/>
        <div class="modal" id="modal">
            <a href="#!" class="modal-overlay"></a>
            <div class="modal__inner">
                <div class="modal__content">
                    <div class="modal-container">
                        <livewire:count :partner="$product->trade->buyer" :product="$product"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@livewireScripts
@endsection

