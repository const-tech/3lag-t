@extends('front.layouts.front')
@section('title')
    {{ __('admin.Expenses') }}
@endsection
@section('content')
@livewire('expenses')


@endsection