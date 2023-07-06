@extends('front.layouts.front')
@section('title')
    {{ __('admin.createGuests') }}
@endsection
@section('content')
@livewire('create-guests')

@endsection
