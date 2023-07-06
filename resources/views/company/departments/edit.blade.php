@extends('company.layouts.company')
@section('title')
{{ __('admin.Edit department') }}
@endsection
@section('content')

    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href='{{ route('company.home') }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Edit department') }}</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <b>{{ __('admin.Edit department') }}</b>
        <hr>
        <form class="row" action="{{ route('company.departments.update',$department) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-sm-6">
                <label class="main-lable" for="">{{ __('admin.name') }}</label>
                <input class="main-select w-100" type="text" name="name" value="{{ $department->name }}">
            </div>
            <div class="col-sm-6">
            <label class="main-lable" for="">{{ __('admin.sub of') }}</label>
            <select class="main-select w-100" name="parent" id="">
            <option value="">{{ __('admin.Choose the department') }}</option>
            @foreach ($main_departments as $depart)
                <option {{ $department->parent==$depart->id?'selected':'' }} value="{{ $depart->id }}">{{ $depart->name }}</option>
            @endforeach
            </select>
            </div>
            <div class="col-sm-6">
                <label class="main-lable" for="">{{ __('lab')}}</label>
                <input class="" type="checkbox" name="is_lab" {{ $department->is_lab?'checked':'' }}>
            </div>
            <div class="col-sm-6">
                <label class="main-lable" for="">{{ __("scan")}}</label>
                <input class="" type="checkbox" name="is_scan" {{ $department->is_scan?'checked':'' }}>
            </div>

            <div class="col-12 mt-5 text-center">
            <button   class="btn btn-primary">{{ __('admin.Update') }}</button>
            </div>
        </form>

    </div>

@endsection
