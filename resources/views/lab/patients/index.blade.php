@extends('lab.layouts.index')
@section('title')
    {{ __("patients") }}
@endsection
@section('content')
@livewire('patients.patients')

@endsection