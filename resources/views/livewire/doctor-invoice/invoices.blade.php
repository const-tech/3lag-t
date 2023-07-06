<section class="bills-section dr-main-section">
    <div class="container">
        <div class="bills-content bg-white px-4 py-3 rounded-3 shadow">
            <div class="row mb-4">
                <div class="col-12 col-md-3">
                    <div class="info-data">
                        <label for="duration-from" class="billData-name mt-3 mb-2">{{ __('admin.from') }}</label>
                        <input type="date" class="form-control" value="2022-07-12" wire:model="from" id="duration-from" />
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="info-data">
                        <label for="duration-to" class="billData-name mt-3 mb-2">{{ __('admin.to') }}</label>
                        <input type="date" class="form-control" value="2024-03-03" wire:model="to" id="duration-to" />
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
                            <th>{{ __('admin.Status') }}</th>
                            <th>{{ __('admin.Total with tax') }}</th>
                            <th>{{ __('Qr') }}</th>
                            <th class="not-print">{{ __('admin.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->id }}</td>
                            <td>{{ $invoice->patient->name }}</td>
                            <td>{{ $invoice->dr?->name }}</td>
                            <td>{{ $invoice->employee->name }}</td>
                            <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                            <td>{{ $invoice->total - $invoice->tax }}</td>
                            <td>{{ __($invoice->status) }}</td>
                            <td>{{ $invoice->total }}</td>
                            <td>
                                <div class="table-qr">{!! $invoice->qr() !!}</div>
                            </td>
                            <td class="not-print">
                                <div class="d-flex gap-1 h-100 w-100">
                                    <!--btn  Modal repeat-->
                                    <a href="{{ route('doctor.invoices.show', $invoice) }}" class="btn btn-sm btn-purple ">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    @can('تعديل الفواتير')
                                    <a href="{{ route('doctor.invoices.edit', $invoice) }}" class="btn btn-sm btn-info">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    @endcan

                                    @can('حذف الفواتير')
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_agent{{ $invoice->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @include('front.invoice.delete')
                        @endforeach

                    </tbody>
                </table>
                {{ $invoices->links() }}
            </div>
        </div>
    </div>
</section>
