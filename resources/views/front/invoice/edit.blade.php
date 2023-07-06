@extends('front.layouts.front')
@section('title')
    {{ __('admin.Edit invoice') }}
@endsection
@section('content')
    @livewire('invoices.edit-invoice',['invoice'=>$invoice])

@endsection