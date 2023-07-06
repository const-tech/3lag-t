<section class="bills-section dr-main-section">
    <div class="container">
        <div class="bills-content bg-white px-4 py-3 rounded-3 shadow">
            <div class="row mb-4 g-3">
                <div class="col-12 col-md-3">
                    <div class="info-data">
                        <label for="duration-from" class="billData-name mt-3 mb-2">{{ __('admin.from') }}</label>
                        <input type="date" class="form-control" value="2022-07-12" wire:model="from"
                            id="duration-from" />
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="info-data">
                        <label for="duration-to" class="billData-name mt-3 mb-2">{{ __('admin.to') }}</label>
                        <input type="date" class="form-control" value="2024-03-03" wire:model="to"
                            id="duration-to" />
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="info-data">
                        <label for="bill-state" class="billData-name mt-3 mb-2">{{ __('admin.Status') }}</label>
                        <select class="main-select w-100 bill-state" id="bill-state" wire:model="status">
                            <option value="">{{ __('admin.All') }}</option>
                            <option value="Paid">{{ __('admin.Paid') }}</option>
                            <option value="Unpaid">{{ __('admin.Unpaid') }}</option>
                            <option value="tmara">تمارا</option>
                            <option value="Partially Paid">{{ __('Partially Paid') }}</option>
                            {{-- <option value="يue">{{ __('admin.Overdue') }}</option> --}}
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-3 d-flex align-items-end">
                    <div class="info-data w-100">
                        <button type="button" wire:click="resetForm" class="sec-btn-gre w-100">
                            {{ __('admin.Reset') }}
                        </button>
                    </div>
                </div>
            </div>
            <div
                class="buttons-option mb-2 gap-2 d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center">
                <div class="status-info d-flex flex-column flex-lg-row gap-2">
                    <div class="bg-info rounded-3 text-white px-3 py-2 ">{{ __('admin.rate') }} : {{ $rate }}
                    </div>
                    <div class="bg-info rounded-3 text-white px-3 py-2 ">{{ __('admin.salary') }} :
                        {{ doctor()->salary + $rate }}</div>
                    <div class="bg-info rounded-3 text-white px-3 py-2 ">
                        {{ __('Bills paid without taxes') }}
                        : {{ $invoices->where('status', 'Paid')->sum('total') }}</div>
                    <div class="bg-info rounded-3 text-white  px-3 py-2 ">
                        {{ __('Outstanding invoices without taxes') }}
                        : {{ $invoices->where('status', 'Unpaid')->sum('total') }}</div>
                </div>
                <div class="control-btn d-flex flex-wrap justify-content-end">
                    <button class="print-btn btn btn-sm btn-warning py-2 mx-1">
                        <i class="fa-solid fa-print"></i>
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th>{{ __('admin.Invoice no.') }}</th>
                            <th>{{ __('admin.patient') }}</th>
                            <th>{{ __('admin.dr') }}</th>
                            <th>{{ __('admin.employee') }}</th>
                            <th>{{ __('admin.Date') }}</th>
                            <th>{{ __('admin.Total') }}</th>
                            <th>{{ __('admin.rest') }}</th>
                            <th>{{ __('admin.Status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->id }}</td>
                                <td>{{ $invoice->patient->name }}</td>
                                <td>{{ $invoice->dr->name }}</td>
                                <td>{{ $invoice->employee->name }}</td>
                                <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                                <td>{{ $invoice->total }}</td>
                                <td>{{ $invoice->rest }}</td>
                                <td>{{ __($invoice->status) }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $invoices->links() }}
            </div>
        </div>
    </div>
</section>
