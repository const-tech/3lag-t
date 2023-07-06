@extends('admin.layouts.admin')
@section('title')
{{ __('admin.Diagnoses') }}
@endsection
@section('content')
<nav aria-label="breadcrumb ">
	<ol class="breadcrumb bg-light p-3">
		<a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
		<li class="breadcrumb-item active" aria-current="page">{{ __('admin.Diagnoses') }}</li>
	</ol>
</nav>
<div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
	{{-- <a href="{{ route('admin.patients.create') }}" class="btn mb-3 btn-primary">{{ __('admin.Add') }}</a> --}}
	<div class="table-responsive">
		<table class="table table-hover">
			<table class="table table-hover">
				<thead class="table-dark">
					<tr>
						<th scope="col"> {{ __('admin.patient') }}</th>
						<th scope="col">{{ __('admin.Dr') }}</th>
						<th scope="col"> {{ __('admin.Hour') }}</th>
						<th scope="col">{{ __('admin.Day') }}</th>
						<th scope="col"> {{ __('admin.Period') }}</th>
						<th scope="col">{{ __('admin.managers') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($diagnoses as $diagnose)
					<tr>
						<th scope="row">{{ $diagnose->patient->name }}</th>
						<td>{{ $diagnose->dr->name }}</td>
						<td>{{ $diagnose->time }}</td>
						<td>{{ $diagnose->day }}</td>
						<td>{{ __($diagnose->period)}}</td>
						<td>
							{{-- <a class="btn btn-info btn-sm" href="{{ route('admin.patients.edit',$patient) }}">{{
								__('admin.Update')
								}}</a> --}}
							<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
								data-bs-target="#delete_agent{{ $diagnose->id }}"><i></i>
								{{ __('admin.Delete') }}
							</button>
							@include('admin.diagnoses.delete')
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $diagnoses->links() }}
	</div>

</div>

@endsection