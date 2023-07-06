<section class="ClidocReport main-section pt-5">
    <div class="container">
    <div class="d-flex mb-3">
            <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
        </div>
        <h4 class="main-heading"> تقرير شركة التقسيط</h4>
        <div class="Cli&doc-report-content bg-white p-4 rounded-2 shadow">
            <div class="left-holder d-flex justify-content-end m-sm-0">
                <button class="btn btn-sm btn-outline-warning ms-2" id="btn-prt-content">
                    <i class="fa-solid fa-print"></i>
                    <span>{{ __('admin.print') }}</span>
                </button>
                <button class="btn btn-sm btn-outline-info" id="export-btn">
                    <i class="fa-solid fa-file-excel"></i>
                    <span>{{ __('admin.Export') }} Excel</span>
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
            </div>
        </div>
        <div id="prt-content">
            <x-header-invoice></x-header-invoice>
            @if (count($invoices) > 0)
                <div class="table-responsive">
                    <table class="table main-table"id="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الشركة</th>
                                <th>المبلغ</th>
                                <th>العمولة الادارية</th>
                                <th>أقل من 2500</th>
                                <th>أكثر من 2500</th>
                                <th>صافي المبلغ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ setting()->installment_company_name }}</td>
                                    <td>{{ $invoice->total }}</td>
                                    <td>{{ $invoice->installment_company_tax }}</td>
                                    <td>{{ $invoice->installment_company_min_amount_tax }}</td>
                                    <td>{{ $invoice->installment_company_max_amount_tax }}</td>
                                    <td>{{ $invoice->installment_company_rest }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td>{{ __('admin.Sorry, there are no results') }}</td>
                                </tr>
                            @endforelse
                            <tr>
                                <td>{{ __('admin.Sum') }}</td>
                                <td>-</td>
                                <td>{{ $invoices->sum('total') }}</td>
                                <td>{{ $invoices->sum('installment_company_tax') }}</td>
                                <td>{{ $invoices->sum('installment_company_min_amount_tax') }}</td>
                                <td>{{ $invoices->sum('installment_company_max_amount_tax') }}</td>
                                <td>{{ $invoices->sum('installment_company_rest') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    {{ $invoices->links() }}
                </div>
            @endif
        </div>
    </div>
</section>
