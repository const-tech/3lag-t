@extends('front.layouts.front')
@section('title')
    {{ __('admin.treasury-account') }}
@endsection
@section('content')
@livewire('reports.treasury-account')

@endsection
