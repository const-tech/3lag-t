@extends('front.layouts.front')
@section('title')
    {{ __('admin.Edit patient') }}
@endsection
@section('content')
    @livewire('patients.edit-patient' ,['patient'=>$patient])

    @push('js')
    <script src="{{ asset('js/add-patinet.js') }}"></script>
    @endpush
@endsection