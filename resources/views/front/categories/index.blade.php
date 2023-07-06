@extends('front.layouts.front')
@section('title')
    {{ __('admin.categories') }}
@endsection
@section('content')
@livewire('categories')


@endsection