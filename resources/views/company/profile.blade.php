@extends('company.layouts.company')
@section('title')
    {{ __('admin.profile') }}
@endsection
@section('content')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href='{{ route('company.home') }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.profile') }}</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <b>{{ __('admin.profile') }}</b>
        <hr>
        <form class="row row-gap-24" action="{{ route('company.profile.update') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="col-md-4">
                <label for="">{{ __('admin.name') }}</label>
                <input class="form-control" type="text" name="name" value="{{ $user->name }}">
            </div>
            <div class="col-md-4">
                <label for="">{{ __('admin.email') }}</label>
                <input class="form-control" type="email" name="email" value="{{ $user->email }}">
            </div>
            <div class="col-md-4">
                <label for="">الصورة الشخصية</label>
                <input class="form-control" type="file" name="image">
            </div>
            <div class="col-md-4">

                <label for="">{{ __('admin.password') }}</label>
                <input class="form-control" type="password" name="password">
            </div>
            <div class="col-12 mt-5 text-center">
                <button class="btn btn-primary">{{ __('admin.Update') }}</button>

            </div>
        </form>

    </div>
@endsection
