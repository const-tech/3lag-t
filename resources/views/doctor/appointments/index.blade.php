@extends('doctor.layouts.index')
@section('title')
    {{ __('admin.Appointments') }}
@endsection
@section('content')
    <div class="container">
        <h4 class="main-heading mb-4">{{ __('Appointments')}}</h4>
        <livewire:doctor-appointments/>
    </div>
@endsection
