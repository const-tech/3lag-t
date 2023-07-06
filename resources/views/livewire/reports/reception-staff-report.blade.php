<section class="Financial-report main-section pt-5">
	<div class="container">
    <div class="d-flex mb-3">
            <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
        </div>
		<h4 class="main-heading"> {{ __('admin.Reception staff report') }}</h4>
		<div class="Financial-report-content bg-white p-4 rounded-2 shadow">
			<div class="d-flex flex-wrap justify-content-between align-items-end mb-3 gap-3">
				<div class="form-group mb-2 mb-md-0 gap-3">
					<label for="" class="small-label mb-2"> {{ __('employee')}}</label>
					<select wire:model="key" id="" class=" main-select">
						<option value="">{{ __('Select an Employee')}}</option>
						@foreach ($receptions as $reception)
						<option value="{{ $reception->id }}">{{ $reception->name }}</option>
						@endforeach
					</select>
					<div class="row mt-3">
						<div class="col-md-6">
							<div class="form-group">
								<label for="" class="small-label mb-2">{{ __('admin.from') }}</label>
								<input type="date" class="form-control" wire:model="from">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="" class="small-label mb-2">{{ __('admin.to') }}</label>
								<input type="date" class="form-control" wire:model="to">
							</div>
						</div>
					</div>

				</div>

				<div class="about-finan-report d-flex flex-wrap align-items-start justify-content-between ">
					<div class="left-holder d-flex justify-content-center justify-content-sm-start m-auto m-sm-0">
						<button class="btn btn-sm btn-outline-warning ms-2" id="btn-prt-content">
							<i class="fa-solid fa-print"></i>
							<span>{{ __('admin.print') }}</span>
						</button>
						<button class="btn btn-sm btn-outline-info" id="export-btn">
							<i class="fa-solid fa-file-excel"></i>
							<span>{{ __('admin.Export') }} Excel</span>
						</button>
					</div>
				</div>
			</div>
			<div id="prt-content">
				<x-header-invoice></x-header-invoice>

				<div class="table-responsive">
					<table class="table main-table">
						<thead>
							<tr>
								<th>#</th>
								<th>{{ __('employee')}}</th>
								<th>{{ __('Patient registration')}}</th>
								<th>{{ __('Visitor reservations')}}</th>
								<th>{{ __('Number of invoices paid')}}</th>
								<th>{{ __('Number of outstanding invoices')}}</th>
								<th>فواتير تمارا</th>
								<th>فواتير تابي</th>
								<th>{{ __('cash')}}</th>
								<th>{{ __('card')}}</th>
								<th>تحويل بنكي</th>
								<th>فيزا</th>
								<th>ماستركارد</th>
								<th>إجمالي تمارا</th>
								<th>إجمالي تابي</th>
								<th>{{ __("Add appointments")}}</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $user)
							<tr>
								<td>{{ $loop->index+1 }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->patients_count }}</td>
								<td>{{ $user->num_of_visitors }}</td>
								<td><a
										href="{{ route('front.invoices.index',['employee_id'=>$user->id,'status'=>'Paid','from'=>$from,'to'=>$to]) }}">{{
										$user->employee_invoices->where('status','Paid')->count() }}</a></td>
								<td><a
										href="{{ route('front.invoices.index',['employee_id'=>$user->id,'status'=>'Unpaid','from'=>$from,'to'=>$to]) }}">{{
										$user->employee_invoices->where('status','Unpaid')->count() }}</a></td>
								<td><a
										href="{{ route('front.invoices.index',['employee_id'=>$user->id,'status'=>'paid','tmara'=>true,'from'=>$from,'to'=>$to]) }}">{{
										$user->employee_invoices->where('installment_company',1)->count() }}</a></td>
								<td><a
										href="{{ route('front.invoices.index',['employee_id'=>$user->id,'status'=>'tab','from'=>$from,'to'=>$to]) }}">{{
										$user->employee_invoices->where('tab',1)->count() }}</a></td>
								<td>{{ $user->employee_invoices->where('installment_company',0)->sum('cash') }}</td>
								<td>{{ $user->employee_invoices->where('installment_company',0)->sum('card') }}</td>
								<td>{{ $user->employee_invoices->where('installment_company',0)->sum('bank') }}</td>
								<td>{{ $user->employee_invoices->where('installment_company',0)->sum('visa') }}</td>
								<td>{{ $user->employee_invoices->where('installment_company',0)->sum('mastercard') }}</td>
								<td>{{ $user->employee_invoices->where('installment_company',1)->sum('total') }}</td>
								<td>{{ $user->employee_invoices->where('tab',1)->sum('total') }}</td>
								<td>{{ $user->employee_appointments_count }}</td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
