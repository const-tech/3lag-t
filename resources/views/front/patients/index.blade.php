@extends('front.layouts.front')
@section('title')
{{ __("patients") }}
@endsection
@section('content')
@include('front.unpaidInvoicePop')
@livewire('patients.patients')

@endsection