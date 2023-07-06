<section class="bills-section main-section pt-4">
    <x-alert></x-alert>
    @include('front.invoice.add_or_update_bonds')
    <div class="container">
        <h4 class="main-heading mb-4">{{ __('admin.Invoice Bonds' ).' '. $invoice->id }} </h4>
        <div class="bills-content bg-white p-4 rounded-2 shadow">
            <div class="bills-option&btn d-flex align-items-center flex-wrap gap-2 justify-content-end mb-1">
                <div class="control-option d-flex flex-wrap align-items-center justify-content-center">
                    <div class="print-btn btn btn-sm btn-warning " id="btn-prt-content">
                        <i class="fa-solid fa-print"></i>
                    </div>
                    <button class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#add_or_update_bonds">
                        {{ __('admin.Add bond') }}
                        <i class="icon fa-solid fa-plus me-1"></i>
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table main-table" id="prt-content">
                    <thead>
                        <tr>
                            <th>{{ __('admin.Invoice no.') }}</th>
                            <th>{{ __('employee') }}</th>
                            <th>{{ __('admin.patient') }}</th>
                            <th>{{ __('admin.dr') }}</th>
                            <th>{{ __('admin.Date') }}</th>
                            <th>{{ __('admin.amount') }}</th>
                            <th>{{ __('admin.rest') }}</th>
                            <th>طريقة الدفع</th>
                            <th>الحالة</th>
                            <th class="not-print">{{ __('admin.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bonds as $bond)
                        <tr>
                            <td>{{ $bond->invoice->id }}</td>
                            <td>{{ $bond->user->name }}</td>
                            <td>{{ $bond->invoice->patient->name }}</td>
                            <td>{{ $bond->invoice->dr ? $bond->invoice->dr->name : 'لا يوجد' }}</td>
                            <td>{{ $bond->created_at->format('Y-m-d') }}</td>
                            <td>{{ $bond->amount }}</td>
                            <td>{{ $bond->rest }}</td>
                            <td>{{ __($bond->payment_method) }}</td>
                            <td>{{ __($bond->status) }}</td>
                            <td class="not-print">
                                <div class="d-flex align-items-center justify-content-center gap-1">

                                    <button data-bs-toggle="modal" data-bs-target="#add_or_update_bonds"
                                        class="btn btn-sm btn-info text-white" wire:click='edit({{ $bond->id }})'>
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    @can('حذف الفواتير')
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" title="حذف"
                                        data-bs-target="#deleteBond{{ $bond->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @include('front.invoice.deleteBond')
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
