@extends('company.layouts.company')
@section('title')
{{ __('admin.Add department') }}
@endsection
@section('content')

    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href='{{ route('company.home') }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Add department') }}</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <b>{{ __('admin.Add department') }}</b>
        <hr>
        <form class="row" action="{{ route('company.departments.store') }}" method="POST">
            @csrf
            <div class="col-sm-6">
                <label class="main-lable" for="">{{ __('admin.name') }}</label>
                <input class="form-control" type="text" name="name">
            </div>

            <div class="col-sm-6 mb-3">
                <label class="main-lable" for="">{{ __('admin.sub of') }}</label>
                <select class="main-select w-100" name="parent" id="">
                <option value="">{{ __('admin.Choose the department') }}</option>
                @foreach ($main_departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
                </select>
            </div>
            <div class="col-12">
            <div class="alert alert-primary mb-1 d-flex align-items-center" role="alert">
                {{ __('In case the section is specific to the radiation or laboratory can be determined from here')}}
            </div>
            </div>
            <div class="col-sm-6">
                <label class="main-lable" for="">{{ __('lab')}}</label>
                <input class="" type="checkbox" name="is_lab" >
            </div>
            <div class="col-sm-6">
                <label class="main-lable" for="">{{ __("scan")}}</label>
                <input class="" type="checkbox" name="is_scan" >
            </div>
            <div class="col-12 mt-5 text-center">
            <button   class="btn btn-primary">{{ __('admin.Add') }}</button>

            </div>
        </form>

    </div>

@endsection
