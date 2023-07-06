@extends('front.layouts.front')
@section('title')
    {{ __('admin.Salaries') }}
@endsection
@section('content')
@livewire('salaries')

@endsection