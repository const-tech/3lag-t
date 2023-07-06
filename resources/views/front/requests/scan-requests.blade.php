@extends('front.layouts.front')
@section('title')
{{ __('Radiology Requests')}}
@endsection
@section('content')
    @livewire('scan-request')
@endsection
