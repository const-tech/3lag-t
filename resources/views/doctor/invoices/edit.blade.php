@extends('doctor.layouts.index')
@section('title')
    {{ __('admin.Edit invoice') }}
@endsection
@section('content')
    @livewire('doctor-invoice.edit-invoice',['invoice'=>$invoice])
@endsection