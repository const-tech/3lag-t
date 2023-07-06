@extends('doctor.layouts.index')
@section('title')
    {{ __("patients") }}
@endsection
@section('content')
@livewire('doctor-patients.patients')

@endsection