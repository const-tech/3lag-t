@extends('front.layouts.front')
@section('title')
    {{ __("invoices") }}
@endsection
@section('content')
@livewire('invoices.invoices',['invoices'=>$invoices])

@endsection