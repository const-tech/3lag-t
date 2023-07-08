@extends('front.layouts.front')
@section('title', 'أيام الباكدج | ' . $patient->name)

@section('content')
    @livewire('patients.package-days', ['patient' => $patient, 'patient_package' => $patient_package], key($patient->id))
@endsection
