@extends('doctor.layouts.index')
@section('title')
{{ __('Appointments')}}
@endsection
@section('content')

    <livewire:doctor-appointments-info />


@endsection
