@extends('doctor.layouts.index')
@section('title')
    {{ __('admin.invoices') }}
@endsection
@section('content')
    <div class="container">
        <h4 class="main-heading mb-4">{{ __('Invoices')}}</h4>
        @livewire('doctor-invoice.invoices')
    </div>
@endsection
