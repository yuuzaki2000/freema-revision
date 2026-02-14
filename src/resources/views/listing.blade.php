@extends('layouts.app_slim')

@section('css')
<link rel="stylesheet" href="{{asset('css/listing.css')}}">
@livewireStyles
@endsection

@section('content')
<div>
    <livewire:listing-cover />
    @livewireScripts
</div>    
@endsection