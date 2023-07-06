@extends('front.layouts.front')
@section('title')
    {{ __('admin.Add patient') }}
@endsection
@section('content')
    @livewire('patients.add-patient')

    @push('js')
    <script src="{{ asset('js/add-patinet.js') }}"></script>
    @endpush
@endsection