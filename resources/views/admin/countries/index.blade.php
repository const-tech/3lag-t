@extends('admin.layouts.admin')
@section('title')
{{ __('admin.countries') }}
@endsection
@section('content')
<nav aria-label="breadcrumb ">
	<ol class="breadcrumb bg-light p-3">
		<a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
		<li class="breadcrumb-item active" aria-current="page">{{ __('admin.countries') }}</li>
	</ol>
</nav>
<div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
	<a href="{{ route('admin.countries.create') }}" class="btn btn-primary mb-2">{{ __('admin.Add') }}</a>
	<table class="table table-hover">
		<thead class="table-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">{{ __('admin.name') }}</th>
				<th scope="col">{{ __('admin.managers') }}</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($countries as $country)
			<tr>
				<th scope="row">{{ $loop->index + 1 }}</th>
				<td>{{ $country->name }}</td>
				<td>
					<a class="btn btn-info btn-sm" href="{{ route('admin.countries.edit',$country) }}">{{
						__('admin.Update') }}</a>
					<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
						data-bs-target="#delete_agent{{ $country->id }}"><i></i>
						{{ __('admin.Delete') }}
					</button>
					@include('admin.countries.delete')
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{ $countries->links() }}

</div>

@endsection