@extends('admin.layouts.admin')
@section('title')
{{ __('admin.Edit lab') }}
@endsection
@section('content')

<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-light p-3">
        <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
        <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Edit lab') }}</li>
    </ol>
</nav>
<div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
    <b>{{ __('admin.Edit lab') }}</b>
    <hr>
    <form class="row" action="{{ route('admin.labs.update',$lab) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="col-sm-6">
            <label class="main-lable" for="">{{ __('admin.name') }}</label>
            <input class="main-select w-100" type="text" name="name" value="{{ $lab->name }}">
        </div>



        <div class="col-12 mt-5 text-center">
            <button class="btn btn-primary">{{ __('admin.Update') }}</button>
        </div>
    </form>

</div>

@endsection