@extends('doctor.layouts.index')
@section('title')
{{ __('admin.report') }}
@endsection
@section('content')
    @livewire('doctor-report')
@endsection