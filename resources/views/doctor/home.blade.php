@extends('doctor.layouts.index')
@section('title')
{{ __('admin.home') }}
@endsection
@section('content')
    @livewire('doctor-home')
@endsection