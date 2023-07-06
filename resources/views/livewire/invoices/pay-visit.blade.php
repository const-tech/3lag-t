<section class="bills-section main-section pt-4" wire:poll.30000ms>
    <div class="container">
        <h4 class="main-heading">{{ __('admin.Pay a visit') }}</h4>
        <div class="bills-content bg-white p-4 rounded-2 shadow">
            <div class="btn-holder mb-2 text-start">
                <button type="button" class="btn btn-outline-secondary btn-sm rounded-circle"
                    data-bs-custom-class="custom-tooltip" data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-title="{{ __('When the patient is discharged from the diagnosis at the doctor and the services are invoiced to be followed up by the accounting department') }}">
                    <i class="fa-solid fa-question"></i>
                </button>
                <button class="print-btn btn btn-sm btn-warning" id="btn-prt-content">
                    <i class="fa-solid fa-print"></i>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table main-table" id="prt-content">
                    <thead>
                        <tr>
                            <th>{{ __('admin.Invoice no.') }}</th>
                            <th>{{ __('admin.patient') }}</th>
                            <th>{{ __('admin.dr') }}</th>
                            <th>{{ __('admin.employee') }}</th>
                            <th>{{ __('admin.Date') }}</th>
                            <th>{{ __('admin.amount') }}</th>
                            <th>{{ __('admin.tax') }}</th>
                            <th>{{ __('admin.Total with tax') }}</th>
                            <th>{{ __('admin.Status') }}</th>
                            <th class="not-print">{{ __('admin.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->id }}</td>
                                <td>{{ $invoice->patient->name }}</td>
                                <td>{{ $invoice->dr ? $invoice->dr->name : 'لا يوجد' }}</td>
                                <td>{{ $invoice->employee->name }}</td>
                                <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                                <td>{{ $invoice->amount }}</td>
                                <td>{{ $invoice->tax }}</td>
                                <td>{{ $invoice->total }}</td>
                                <td>{{ __($invoice->status) }}</td>
                                <td class="not-print">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <!--btn  Modal repeat-->
                                        <a href="{{ route('front.invoices.show', $invoice) }}"
                                            class="btn btn-sm btn-purple">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('front.invoices.edit', ['invoice' => $invoice, 'tasdeed' => 'tasdeed']) }}"
                                            class="btn btn-sm btn-info text-white">
                                            {{ __('admin.payment') }}
                                        </a>
                                        @can('حذف الفواتير')
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete_agent{{ $invoice->id }}">
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
