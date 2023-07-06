<section class="ClidocReport main-section pt-5">
    <div class="container">
        <div class="d-flex mb-3">
            <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
        </div>
        <h4 class="main-heading"> {{ __('admin.Clinics and doctor bills reports') }}</h4>
        <div class="Cli&doc-report-content bg-white p-4 rounded-2 shadow">
            <div class="left-holder d-flex justify-content-end m-sm-0">
                <button class="btn btn-sm btn-outline-warning ms-2" id="btn-prt-content">
                    <i class="fa-solid fa-print"></i>
                    <span>{{ __('admin.print') }}</span>
                </button>
                <button class="btn btn-sm btn-outline-info" wire:click='export()'>
                    <i class="fa-solid fa-file-excel"></i>
                    <span>{{ __('admin.Export') }} Excel</span>
                </button>
                <button class="btn btn-sm btn-outline-info" wire:click='export("pdf")'>
                    <i class="fa-solid fa-print"></i>
                    <span>pdf</span>
                </button>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="duration-from" class="report-name mt-3 mb-2">{{ __('admin.from') }}</label>
                        <input type="date" class="form-control" wire:model="from" id="duration-from" />
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="duration-to" class="report-name mt-3 mb-2">{{ __('admin.to') }}</label>
                        <input type="date" class="form-control" wire:model="to" id="duration-to" />
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="pay-way" class="report-name mt-3 mb-2">{{ __('admin.Payment method') }}</label>
                        <select class="main-select w-100 pay-way" id="pay-way" wire:model="paid">
                            {{-- <option value="">غير محدد</option> --}}
                            <option value="">{{ __('admin.All') }}</option>
                            <option value="cash">{{ __('admin.cash') }}</option>
                            <option value="card">{{ __('admin.card') }}</option>
                            <option value="visa">فيزا</option>
                            <option value="mastercard">ماستركارد</option>
                            <option value="bank">تحويل بنكي</option>
                            <option value="tmara">تمارا</option>
                        </select>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="Clinic-type" class="report-name mt-3 mb-2">{{ __('admin.Clinic') }}
                        </label>
                        <select class="main-select w-100 Clinic-type" id="Clinic-type" wire:model="department_id">
                            {{-- <option value="">{{ __('admin.Clinic') }}</option> --}}
                            <option value="">{{ __('admin.All') }}</option>
                            @foreach ($departments as $department)
                            <option value="{{ __($department->id) }}">{{ __($department->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="the-doctor" class="report-name mt-3 mb-2">{{ __('admin.dr') }}</label>
                        <select class="main-select w-100 the-doctor" id="the-doctor" wire:model="dr_id">
                            <option value="">{{ __('admin.All') }}</option>
                            @foreach ($doctors as $dr)
                            <option value="{{ $dr->id }}">{{ $dr->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="the-doctor" class="report-name mt-3 mb-2">{{ __('admin.Status') }}</label>
                        <select class="main-select w-100 the-doctor" id="the-doctor" wire:model="status">
                            <option value="">{{ __('admin.All') }}</option>
                            <option value="Paid">{{ __('admin.Paid') }}</option>
                            <option value="Unpaid">{{ __('admin.Unpaid') }}</option>
                            <option value="retrieved">{{ __('admin.retrieved') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="box-info w-100 h-100 d-flex align-items-end justify-content-center">
                        <button type="submit" class="sec-btn-gre w-75 mt-4 mt-lg-0">
                            {{ __('admin.Show') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div id="prt-content">
            <x-header-invoice></x-header-invoice>
            @if (count($invoices) > 0)
            <div class="table-responsive">
                <table class="table main-table" id="data-table">
                    <thead>
                        <tr>
                            <th>{{ __('admin.Date') }}</th>
                            <th>{{ __('admin.Invoice no.') }}</th>
                            <th>{{ __('admin.dr') }}</th>
                            <th>{{ __('admin.patient') }}</th>
                            <th>{{ __('admin.amount') }}</th>
                            <th>{{ __('admin.tax') }}</th>
                            <th>{{ __('admin.Total') }}</th>
                            <th>{{ __('admin.paid') }}</th>
                            <th>{{ __('admin.rest') }}</th>
                            <th>{{ __('admin.Status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                            <td>{{ $invoice->id }}</td>
                            <td>{{ $invoice->dr?->name }}</td>
                            <td>{{ $invoice->patient?->name }}</td>
                            <td>{{ $invoice->amount - $invoice->discount - $invoice->offers_discount }}</td>
                            <td>{{ $invoice->tax }}</td>
                            <td>{{ $invoice->total }}</td>
                            <td>{{ $invoice->paid }}</td>
                            <td>{{ $invoice->rest }}</td>
                            <td>{{ __($invoice->status) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td>{{ __('admin.Sorry, there are no results') }}</td>
                        </tr>
                        @endforelse
                        <tr>
                            <td>{{ __('admin.Sum') }}</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>{{ $all_invoices->sum('amount') - $all_invoices->sum('discount') - $all_invoices->sum('offers_discount') }}</td>
                            <td>{{ $all_invoices->sum('tax') }}</td>
                            <td>{{ $all_invoices->sum('total') }}</td>
                            <td>{{ $all_invoices->Where('status','Paid')->sum('paid') + $all_invoices->Where('status','Partially Paid')->sum('paid') }}</td>
                            {{-- <td>{{ $all_invoices->sum('paid') }}</td> --}}
                            <td>{{ $all_invoices->sum('rest') }}</td>
                        </tr>
                    </tbody>
                </table>
                {{ $invoices->links() }}
            </div>
            @endif
        </div>
    </div>
</section>
