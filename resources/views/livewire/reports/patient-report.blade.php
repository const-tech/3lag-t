<section class="patinet-report main-section pt-5">
    <div class="container">
    <div class="d-flex mb-3">
            <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
        </div>
        <h4 class="main-heading">{{ __('Patients invoice account') }}</h4>
        <div class="treasuryAccount-content bg-white p-4 rounded-2 shadow">
            <div class="row">
                <div class="left-holder d-flex justify-content-end m-sm-0">
                    <button class="btn btn-sm btn-outline-info" id="export-btn">
                        <i class="fa-solid fa-file-excel"></i>
                        <span>{{ __('admin.Export') }} Excel</span>
                    </button>
                </div>
                <div class="col-12 col-md-4">
                    <div class="box-info">
                        <label for="patient-id"
                            class="report-name mt-3 mb-2 small-label">{{ __('Patient File Number/ID Number') }}</label>
                        <input type="text" wire:keyup='get_patient' wire:model="patient_key"
                            class="form-control patient-id" id="patient-id" />
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="box-info">
                        <label for="patient-name"
                            class="report-name mt-3 mb-2 small-label">{{ __('patient name') }}</label>
                        <input type="text" class="patient-name form-control" id="patient-name"
                            value="{{ $patient ? $patient->first_name : '' }}" />
                    </div>
                </div>
                @can('رؤية جوال المريض')
                    <div class="col-12 col-md-4">
                        <div class="box-info">
                            <label for="phone-number"
                                class="report-name mt-3 mb-2 small-label">{{ __('mobile number') }}</label>
                            <input type="text" class="phone-number form-control" id="phone-number"
                                value="{{ $patient ? $patient->phone : '' }}" />
                        </div>
                    </div>
                @endcan
                <div class="col-12 col-md-4">
                    <div class="box-info">
                        <label for="duration-from" class="report-name mt-3 mb-2 small-label">{{ __('form') }}</label>
                        <input type="date" class="form-control" value="2022-07-12" wire:model="from"
                            id="duration-from" />
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="box-info">
                        <label for="duration-to" class="small-label report-name mt-3 mb-2">{{ __('to') }}</label>
                        <input type="date" class="form-control" value="2024-03-03" wire:model="to"
                            id="duration-to" />
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="box-info">
                        <label for="pay-way"
                            class="report-name mt-3 mb-2 small-label">{{ __('payment method') }}</label>
                        <select class="main-select w-100 pay-way" id="pay-way" wire:model="pay_way">
                            <option value="">{{ __('admin.All') }}</option>
                            <option value="cash">{{ __('cash') }}</option>
                            <option value="card">{{ __('Card/Visa Card') }}</option>
                            <option value="bank">تحويل بنكي</option>
                            <option value="visa">فيزا</option>
                            <option value="mastercard">ماستركارد</option>
                        </select>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="box-info">
                        <label for="Clinic-type" class="report-name mt-3 mb-2 small-label">{{ __('Clinic') }}
                        </label>
                        <select class="main-select w-100 Clinic-type" id="Clinic-type" wire:model="Clinic_type">
                            <option value="">{{ __('admin.All') }}</option>
                            @foreach ($departments as $dr)
                                <option value="{{ $dr->id }}">{{ $dr->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="box-info">
                        <label for="the-doctor"
                            class="report-name mt-3 mb-2 small-label">{{ __('the Doctor') }}</label>
                        <select class="main-select w-100 the-doctor" id="the-doctor" wire:model="doctor">
                            <option value="">{{ __('admin.All') }}</option>
                            @foreach ($doctors as $dr)
                                <option value="{{ $dr->id }}">{{ $dr->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-ms-6 col-md-6">
                        <div class="box-info">
                            <label for="duration-to"
                                class="small-label report-name mt-3 mb-2">{{ __('Total paid invoices') }}</label>
                            <input type="text" class="form-control"
                                value="{{ $patient ? $patient->invoices->where('status', 'Paid')->sum('total') : '' }}"
                                readonly />
                        </div>
                    </div>
                    <div class="col-12 col-ms-6 col-md-6">
                        <div class="box-info">
                            <label for="duration-to"
                                class="small-label report-name mt-3 mb-2">{{ __('Total unpaid invoices') }}</label></label>
                            <input type="text" class="form-control"
                                value="{{ $patient ? $patient->invoices->where('status', 'Unpaid')->sum('total') : '' }}"
                                readonly />
                        </div>
                    </div>
                </div>

            </div>
            <!-- <hr> -->
            @if (count($invoices) > 0)
                <div class="table-responsive mt-3">
                    <table class="table main-table" id="data-table">
                        <thead>
                            <tr>
                                <th>{{ __('admin.Invoice no.') }}</th>
                                <th>{{ __('admin.patient') }}</th>
                                <th>{{ __('admin.dr') }}</th>
                                <th>{{ __('admin.department') }}</th>
                                <th>{{ __('admin.Date') }}</th>
                                <th>{{ __('admin.amount') }}</th>
                                <th>{{ __('admin.tax') }}</th>
                                <th>{{ __('admin.Total') }}</th>
                                <th>{{ __('admin.Status') }}</th>
                                <th>{{ __('admin.Total with tax') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->patient->name }}</td>
                                    <td>{{ $invoice->dr ? $invoice->dr->name : 'لا يوجد' }}</td>
                                    <td>{{ $invoice->department ? $invoice->department->name : 'لا يوجد' }}</td>
                                    <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $invoice->amount }}</td>
                                    <td>{{ $invoice->tax }}</td>
                                    <td>{{ $invoice->total }}</td>
                                    <td>{{ __($invoice->status) }}</td>
                                    <td>{{ $invoice->total + $invoice->tax }}</td>
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
                                <td>-</td>
                                <td>{{ $invoices->sum('amount') }}</td>
                                <td>{{ $invoices->sum('tax') }}</td>
                                <td>{{ $invoices->sum('total') }}</td>
                                <td>-</td>
                                <td>{{ $invoices->sum('total') + $invoices->sum('tax') }}</td>
                            </tr>

                        </tbody>
                    </table>
                    {{ count($invoices) > 0 ? $invoices->links() : '' }}
                </div>
            @endif
        </div>
    </div>
</section>
