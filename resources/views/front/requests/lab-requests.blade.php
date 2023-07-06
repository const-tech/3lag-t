@extends('front.layouts.front')
@section('title')
{{ __('Lap Requests')}}
@endsection
@section('content')
    @livewire('lab-request')
@endsection
