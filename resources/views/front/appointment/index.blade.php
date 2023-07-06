@extends('front.layouts.front')
@section('title')
{{ __('admin.appointments') }}
@endsection
@section('content')

@livewire('appointments')


@endsection
