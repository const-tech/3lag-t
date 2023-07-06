@extends('admin.layouts.admin')
@section('title')
{{ __('admin.departments') }}
@endsection
@section('content')
<nav aria-label="breadcrumb ">
	<ol class="breadcrumb bg-light p-3">
		<a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
		<li class="breadcrumb-item active" aria-current="page">{{ __('admin.departments') }}</li>
	</ol>
</nav>
<div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
	@if (auth()->user()->type == 'company')
	<a href="{{ route('admin.departments.create') }}" class="btn mb-3 btn-primary">{{ __('admin.Add') }}</a>
	@endif
	<table class="table table-hover">
		<thead class="table-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">{{ __('admin.name') }}</th>
				<th scope="col">{{ __('admin.managers') }}</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($departments as $department)
			<tr>
				<td>{{ $loop->index + 1 }}</td>
				<td>{{ $department->name }}</td>
				<td>
					<a class="btn btn-info btn-sm" href="{{ route('admin.departments.edit', $department) }}">{{
						__('admin.Update') }}</a>
					<a class="btn btn-danger btn-sm"
						href="{{ route('admin.invoices.index', ['department_id' => $department->id]) }}">
						{{ __('admin.') }}
						<i class="fa fa-file-invoice-dollar"></i>
					</a>
					@if (auth()->user()->type == 'company')
					<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
						data-bs-target="#delete_agent{{ $department->id }}"><i></i>
						{{ __('admin.Delete') }}
					</button>
					@include('admin.departments.delete')
					@endif
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{ $departments->links() }}
</div>
@endsection
