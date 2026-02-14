@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/app_wide.css')}}">
@livewireStyles
@endsection

@section('content')
<div>
    <livewire:purchase-cover productId="{{$product->id}}" post_code="{{$post_code}}" address="{{$address}}" building="{{$building}}" />
    @livewireScripts
</div>
@endsection