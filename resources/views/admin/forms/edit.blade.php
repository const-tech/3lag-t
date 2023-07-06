@extends('admin.layouts.admin')
@section('title')
{{ __('admin.Edit form') }}
@endsection
@section('content')

<nav aria-label="breadcrumb ">
	<ol class="breadcrumb bg-light p-3">
		<a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
		<li class="breadcrumb-item active" aria-current="page">{{ __('admin.Edit relationship') }}</li>
	</ol>
</nav>
<div class="row w-100 mx-auto p-3 shadow rounded-3  bg-white">

	<form action="{{ route('admin.forms.update',$form) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		<label for="">{{ __('admin.name') }}</label>
		<input type="text" name="name" value="{{ $form->name }}">
		<label for="">{{ __('admin.Form') }}</label>
		<input type="file" name="file" accept="application/pdf">
		<button class="btn btn-primary">{{ __('admin.Update') }}</button>
	</form>

</div>

@endsection