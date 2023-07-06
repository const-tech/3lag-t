@extends('front.layouts.front')

@section('title')
    {{ __('admin.Invoice Bonds') }}
@endsection
@section('content')
    @livewire('invoices.bonds', ['invoice' => $invoice])
@endsection
