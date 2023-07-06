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
<div class="row w-100 mx-auto p-3 shadow rounded-3  bg-white">

  <form action="{{ route('admin.roles.update',$role) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row ">
      <div class="col-12">
        <div class="row">
          <div class="col-md-4 mb-3">
            <div class="form-group ">
              <p for="" class="mb-2">{{ __('admin.name') }}</p>
              <div class="d-flex">
                <input type="text" class=" form-control" name="name" value="{{ $role->name }}">
              </div>
            </div>
          </div>
        </div>
      </div>
      <h6>قسم الادارة</h6>
      @foreach ($permission as $value)
      <div class="col-xs-6 col-md-4 col-lg-3">
        <label class="">
          <input type="checkbox" name='permissions[]' {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}
            value="{{ $value->id }}">
          {{ $value->name }}</label>
      </div>
      @endforeach

      <div class="col-md-12 mt-3 d-flex justify-content-end ">
        <button class="btn-main-sm">{{ __('Save')}}</button>
      </div>

    </div>
  </form>


</div>

@endsection
