@extends('lab.layouts.index')
@section('title')
{{ __('Lap Requests')}}
@endsection
@section('content')
    @livewire('lab-request')
@endsection
