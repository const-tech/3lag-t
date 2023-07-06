<section class="main-section users">
	<x-alert></x-alert>
	<div class="container">
		<h4 class="main-heading">{{ __('admin.departments') }}</h4>
		<div class="section-content bg-white shadow rounded-3 p-4">
			@include('front.departments.add_or_update')
			@if (auth()->user()->type == 'company')
			<div class="d-flex align-items-center flex-wrap justify-content-end mb-2">
				<button class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#add_or_update">
					{{ __('admin.Add department') }}
					<i class="icon fa-solid fa-plus me-1"></i>
				</button>
			</div>
			@endif
			<div class="table-responsive">
				<table class="table main-table">
					<thead>
						<tr>
							<th>#</th>
							<th>{{ __('admin.name') }}</th>
							<th class="text-center">{{ __('admin.managers') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($departments as $department)
						<tr>
							<td>{{ $department->id }}</td>
							<td>{{ $department->name }}</td>
							<td>
								<div class="d-flex align-items-center justify-content-center gap-1">
									<button data-bs-toggle="modal" data-bs-target="#add_or_update"
										class="btn btn-sm btn-info text-white ms-1"
										wire:click='edit({{ $department }})'>
										<i class="fa-solid fa-pen-to-square"></i>
									</button>
									<a class="btn btn-danger btn-sm space-noWrap"
										href="{{ route('front.invoices.index', ['department_id' => $department->id]) }}">
										{{ __('admin.invoices') }}
										<i class="fa fa-file-invoice-dollar"></i>
									</a>
									@if (auth()->user()->type == 'company')
									<button class="btn btn-sm btn-danger" data-bs-toggle="modal"
										data-bs-target="#delete_agent{{ $department->id }}">
										<i class="fa-solid fa-trash-can"></i>
									</button>
									@endif

								</div>
							</td>
						</tr>
						@if (auth()->user()->type == 'company')
						@include('front.departments.delete')
						@endif
						@endforeach

					</tbody>
				</table>
			</div>
		</div>
		<!-- All Modal -->
		<!-- Modal repeat -->

	</div>
</section>