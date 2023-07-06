@extends('front.layouts.front')
@section('title')
    {{ __('admin.Add invoice') }}
@endsection
@section('content')
    @livewire('invoices.add-invoices')

@endsection