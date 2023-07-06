<section class="Financial-report main-section pt-5">
    <div class="container">
        <h4 class="main-heading"> {{ __('admin.Offers financial report') }}</h4>
        <div class="Financial-report-content bg-white p-4 rounded-2 shadow">
            <div class="status d-flex mb-3">
                <div class="py-2 px-3 bg-info rounded text-white ms-1"> {{ __('admin.Offer for product') }} : {{ $offer->product->name }}</div>
                <div class="py-2 px-3 bg-info rounded text-white "> {{ __('admin.Number of invoices') }} : {{ $invoices->count() }}</div>
            </div>
            <div class="about-finan-report d-flex flex-wrap align-items-start justify-content-between mb-3">
                <form action=""
                    class="right-holder d-flex flex-wrap flex-sm-nowrap flex-sm-row align-items-center mb-2 mb-lg-0 justify-content-center">
                    <div class="duration-from d-flex align-items-center justify-content-center me-2">
                        <label for="date-from" class="fild-name ms-2">{{ __('admin.from') }}</label>
                        <input type="date" class="date-from form-control mb-2 mb-sm-0" id="date-from"
                        wire:model="from"  />
                    </div>
                    <div class="duration-to d-flex align-items-center justify-content-center me-2">
                        <label for="date-to" class="fild-name ms-2">{{ __('admin.to') }}</label>
                        <input type="date" class="date-to form-control mb-3 mb-sm-0" id="date-to" wire:model="to" />
                    </div>
                    <button type="button" class="sec-btn-gre w-75 mb-2 mb-sm-0 me-sm-2 me-0 w-50">
                        <span class="ms-1">{{ __('admin.Show') }}</span>
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </form>
                <div class="left-holder d-flex justify-content-center justify-content-sm-start m-auto m-sm-0">
                    <button class="btn btn-sm btn-outline-warning ms-2" id="print-btn">
                        <i class="fa-solid fa-print"></i>
                        <span>{{ __('admin.print') }}</span>
                    </button>
                    <button class="btn btn-sm btn-outline-info" id="export-btn">
                        <i class="fa-solid fa-file-excel"></i>
                        <span>{{ __('admin.Export') }} Excel</span>
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table main-table" id="data-table">
                    <thead>
                        <tr>
                            <th>{{ __('admin.cash') }}</th>
                            <th>{{ __('admin.card') }}</th>
                            <th>{{ __('admin.paid') }}</th>
                            <th>{{ __('admin.Unpaid') }}</th>
                            <th>{{ __('admin.Without tax') }}</th>
                            <th>{{ __('admin.Total with tax') }}</th>
                            <th>{{ __('admin.tax') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $invoices->sum('cash') }}</td>
                            <td>{{ $invoices->sum('card') }}</td>
                            <td>{{ $invoices->sum('paid') }}</td>
                            <td>{{ $invoices->sum('rest') }}</td>
                            <td>{{ $invoices->sum('amount') }}</td>
                            <td>{{ $invoices->sum('total') }}</td>
                            <td>{{ $invoices->sum('tax') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
