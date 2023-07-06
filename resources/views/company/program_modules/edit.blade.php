@extends('company.layouts.company')
@section('title')
    تعديل {{ $program_module->name }}
@endsection
@section('content')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href='{{ route('company.home') }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">تعديل {{ $program_module->name }}</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <b>تعديل {{ $program_module->name }}</b>
        <hr>
        <form class="row" action="{{ route('company.program_modules.update', $program_module->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="col-md-6">
                <label class="main-lable" for="">{{ __('admin.name') }}</label>
                <input class="form-control" type="text" value="{{ $program_module->name }}" name="name">
            </div>
            <div class="col-md-6">
                <label class="main-lable" for="">{{ __('admin.price') }}</label>
                <input class="form-control" type="text" value="{{ $program_module->price }}" name="price">
            </div>
            <div class="col-md-12">
                <label class="main-lable" for="">المميزات</label>
                <textarea class="form-control" type="text" name="features" rows="5"> {{ $program_module->features }} </textarea>
            </div>

            <div class="col-12 text-center mt-5">
                <button class="btn btn-primary">{{ __('admin.Update') }}</button>
            </div>
        </form>

    </div>
@endsection
