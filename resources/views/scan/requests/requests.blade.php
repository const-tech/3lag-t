@extends('scan.layouts.index')
@section('title')
{{ __('Radiology Requests')}}
@endsection
@section('content')
    @livewire('scan-request')
@endsection
