@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/profile_update.css')}}">
@livewireStyles
@endsection

@section('content')
<div>
    <livewire:profile-cover userId="{{$userId}}" profileId="{{$profileId}}" />
    @livewireScripts
</div>
@endsection