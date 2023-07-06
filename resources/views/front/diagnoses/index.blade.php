@extends('front.layouts.front')
@section('title')
{{ __('admin.Diagnoses') }}
@endsection
@section('content')
@livewire('diagnoses')

@push('js')
<script src="{{ asset('js/diagnosticsPage.js') }}"></script>
@endpush
@endsection