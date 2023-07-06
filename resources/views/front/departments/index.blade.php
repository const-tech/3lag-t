@extends('front.layouts.front')
@section('title')
    {{ __('admin.departments') }}
@endsection
@section('content')

@livewire('departments')
@endsection