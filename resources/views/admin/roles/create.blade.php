@extends('admin.layouts.admin')
@section('title')
{{ __('admin.Add group') }}
@endsection
@section('content')

    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Add group') }}</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
<b>{{ __('admin.Add group') }}</b>
<hr>
        <form class=" row" action="{{ route('admin.roles.store') }}" method="POST">
            @csrf

                <div class="col-12">
                    <div class="row">
                    <div class="col-md-4 mb-3">
                    <div class="form-group ">
                        <p class="mb-2">{{ __('admin.name') }}</p>
                        <div class="d-flex">
                            <input type="text" class=" form-control" name="name">
                        </div>
                    </div>
                </div>
                    </div>
                </div>
                @foreach ($permission as $value)
                    <div class="col-xs-6 col-md-4 col-lg-3">

                        <label class="">
                            <input type="checkbox" name='permissions[]'
                                value="{{ $value->id }}">
                            {{ $value->name }}</label>
                    </div>
                @endforeach

                <div class="col-md-12 mt-3 d-flex justify-content-end ">
                    <button class="btn btn-primary btn-sm px-3">{{ __('Save')}}</button>
                </div>

        </form>


    </div>

@endsection
