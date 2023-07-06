@extends('admin.layouts.admin')
@section('title')
{{ __('admin.Edit city') }}
@endsection
@section('content')

<nav aria-label="breadcrumb ">
	<ol class="breadcrumb bg-light p-3">
		<a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
		<li class="breadcrumb-item active" aria-current="page">{{ __('admin.Edit city') }}</li>
	</ol>
</nav>
<div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
	<b>{{ __('admin.Edit city') }}</b>
	<hr>
	<form class="row" action="{{ route('admin.cities.update',$city) }}" method="POST">
		@csrf
		@method('PUT')
		<div class="col-md-4">
			<label class="main-lable" for="">{{ __('admin.name') }}</label>
			<input class="form-control" type="text" name="name" value="{{ $city->name }}">
		</div>

		<div class="col-12 text-center mt-5">
			<button class="btn btn-primary">{{ __('admin.Update') }}</button>
		</div>
	</form>

</div>

@endsection