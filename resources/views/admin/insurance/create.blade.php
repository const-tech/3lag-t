@extends('admin.layouts.admin')
@section('title')
{{ __('admin.Add insurance') }}
@endsection
@section('content')

    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Add insurance') }}</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <b>{{ __('admin.Add insurance') }}</b>
        <hr>
        <form class="row" action="{{ route('admin.insurances.store') }}" method="POST">
            @csrf
            <div class="col-sm-6">
                <label class="main-lable" for="">{{ __('admin.name') }}</label>
                <input class="form-control" type="text" name="name">
            </div>
            <div class="col-12 mt-5 text-center">
            <button   class="btn btn-primary">{{ __('admin.Add') }}</button>

            </div>
        </form>

    </div>

@endsection
