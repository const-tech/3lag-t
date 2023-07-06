<section class="ClidocReport main-section pt-5">
    <div class="container">
    <div class="d-flex mb-3">
            <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
        </div>
        <h4 class="main-heading"> {{ __('admin.Insurance companies report') }}</h4>
        <div class="Cli&doc-report-content bg-white p-4 rounded-2 shadow">
            <div class="left-holder d-flex justify-content-end m-sm-0">
                <div class="btn-holder">
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
            <div class="row g-3">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="box-info">
                        <label for="pay-way" class="report-name mt-3 mb-2">{{ __('admin.insurances') }}</label>
                        <select class="main-select w-100 pay-way" id="pay-way" wire:model="insurance">
                            <option value="">{{ __('admin.All') }}</option>
                            @foreach ($insurances as $insurance)
                                <option value="{{ $insurance->id }}">{{ $insurance->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5 d-flex align-items-end">
                    <div class="info d-flex w-100">
                        <div class="bg-info text-white rounded-3 px-2 py-2 ms-2">{{ __('admin.number of patients') }} :
                            {{ $selected_insurance ? $selected_insurance->patients_count : App\Models\Patient::whereNotNull('insurance_id')->count() }}
                        </div>
                        <div class="bg-info text-white rounded-3 px-2 py-2">{{ __('admin.amount') }} :
                            {{ $invoices->sum('total') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="prt-content">
            <x-header-invoice></x-header-invoice>
            @if (count($invoices) > 0)
                <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('admin.patient') }}</th>
                                <th>{{ __('admin.Date') }}</th>
                                <th>{{ __('admin.insurance') }}</th>
                                <th>{{ __('admin.Invoice no.') }}</th>
                                <th>{{ __('admin.total') }}</th>
                                <th>{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($invoices as $invoice)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $invoice->patient?->name }}</td>
                                    <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $invoice->patient?->insurance?->name }}</td>
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->total }}</td>
                                    <td>
                                        <a target="_blank" href="{{ route('front.invoices.show', $invoice) }}"
                                            class="btn btn-sm btn-purple">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        @can('حذف الفواتير')
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete_agent{{ $invoice->id }}">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                                @include('front.invoice.delete')
                            @empty
                                <tr>
                                    <td>{{ __('admin.Sorry, there are no results') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $invoices->links() }}
                </div>
            @endif
        </div>
    </div>
</section>
