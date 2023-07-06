@extends('front.layouts.front')
@section('title')
{{ __('admin.Transferred patients') }}
@endsection
@section('content')

    <livewire:appointments :transferred="true"/>


@endsection
