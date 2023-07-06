<section class="patinet-report main-section pt-5">
    <div class="container">
        <div class="d-flex mb-3">
            <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
        </div>
        <h4 class="main-heading">{{ __('admin.Purchases report') }}</h4>
        <div class="treasuryAccount-content bg-white p-4 rounded-2 shadow">
            <div class="row">
                <div class="left-holder d-flex justify-content-end m-sm-0">
                    <button class="btn btn-sm btn-outline-info" id="export-btn">
                        <i class="fa-solid fa-file-excel"></i>
                        <span>{{ __('admin.Export') }} Excel</span>
                    </button>
                </div>
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
            <!-- <hr> -->
            <div class="table-responsive mt-3">
                <table class="table main-table" id="data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin.name') }}</th>
                            <th>{{ __('admin.Date') }}</th>
                            <th>{{ __('admin.amount') }}</th>
                            <th>{{ __('admin.Taxes included') }}</th>
                            <th>{{ __('Tax rate') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($purchases as $purchase)
                            <tr>
                                <td>{{ $purchase->id }}</td>
                                <td>{{ $purchase->name }}</td>
                                <td>{{ $purchase->date ? $purchase->date : $purchase->created_at->format('Y-m-d') }}
                                </td>
                                <td>{{ $purchase->amount }}</td>
                                <td>{{ $purchase->tax ? __('Yes') : __('No') }}</td>
                                <td>{{ $purchase->tax ? $purchase->tax_value : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12">{{ __('admin.Sorry, there are no results') }}</td>
                            </tr>
                        @endforelse
                        @if ($purchases->count() > 0)
                            <tr>
                                <td>{{ __('department.tax_total') }}</td>
                                <td>{{ $purchases->sum('tax_value') }}</td>
                                <td>{{ __('department.net_sum') }}</td>
                                <td>{{ $purchases->sum('net') }}</td>
                                <td>{{ __('department.total_sum') }}</td>
                                <td>{{ $purchases->sum('amount') }}</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
                {{ $purchases->links() }}
            </div>
        </div>
    </div>
</section>
