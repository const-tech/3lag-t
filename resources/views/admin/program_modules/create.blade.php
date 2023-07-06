@extends('admin.layouts.admin')
@section('title')
    أضف موديول
@endsection
@section('content')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">أضف موديول</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <b>أضف موديول</b>
        <hr>
        <form class="row " action="{{ route('admin.program_modules.store') }}" method="POST">
            @csrf
            <div class="col-md-6">
                <label class="main-lable" for="">{{ __('admin.name') }}</label>
                <input class="form-control" type="text" value="{{ old('name') }}" name="name">
            </div>
            <div class="col-md-6">
                <label class="main-lable" for="">{{ __('admin.price') }}</label>
                <input class="form-control" type="text" value="{{ old('price') }}" name="price">
            </div>
            <div class="col-md-12">
                <label class="main-lable" for="">المميزات</label>
                <textarea class="form-control" type="text" name="features" rows="5"> {{ old('features') }} </textarea>
            </div>
            <div class="col-12  mt-5 text-center">

                <button class="btn btn-primary">{{ __('admin.Add') }}</button>
            </div>
        </form>

    </div>
@endsection
