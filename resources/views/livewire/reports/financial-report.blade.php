<section class="Financial-report main-section py-5">
    <div class="container">
        <div class="d-flex mb-3">
            <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
        </div>
        <h4 class="main-heading"> {{ __('admin.General financial report') }}</h4>
        <div class="blocks-data">
            <div class="row g-3 mb-4">
                <div class="col-md-6 col-lg-3">
                    <div class="states-box box-1">
                        <div class="data-icon">
                            <span class="num-1">{{ App\Models\Invoice::where('status', 'Paid')->count() }}</span>
                            <i class="fa-solid fa-money-bill-transfer icon-1"></i>
                        </div>
                        <div class="text">
                            <a
                                href="{{ route('front.invoices.index', ['status' => 'Paid']) }}">{{ __('Paid invoices') }}</a>
                        </div>
                        <div class="prog-box">
                            <div class="prog">
                                <span class="prog-1"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="states-box">
                        <div class="data-icon">
                            <span class="num-2">{{ App\Models\Invoice::where('status', 'Unpaid')->count() }}</span>
                            <i class="fa-solid fa-money-bill-trend-up icon-2"></i>
                        </div>
                        <div class="text">
                            <a
                                href="{{ route('front.invoices.index', ['status' => 'Unpaid']) }}">{{ __('All outstanding invoices') }}</a>
                        </div>
                        <div class="prog-box">
                            <div class="prog">
                                <span class="prog-2"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="states-box">
                        <div class="data-icon">
                            <span class="num-3">{{ App\Models\Expense::count() }}</span>
                            <i class="fa-solid fa-file-invoice-dollar icon-3"></i>
                        </div>
                        <div class="text">
                            <a href="{{ route('front.expenses.index') }}">{{ __('All Expenses') }}</a>
                        </div>
                        <div class="prog-box">
                            <div class="prog">
                                <span class="prog-3"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="states-box">
                        <div class="data-icon">
                            <span class="num-4">{{ App\Models\Purchase::count() }}</span>
                            <i class="fa-solid fa-basket-shopping icon-4"></i>
                        </div>
                        <div class="text">
                            <a href="{{ route('front.purchases.index') }}">{{ __('All Purchases') }}</a>
                        </div>
                        <div class="prog-box">
                            <div class="prog">
                                <span class="prog-4"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="Financial-report-content bg-white p-4 rounded-2 shadow">
            <div class="about-finan-report d-flex flex-wrap align-items-start justify-content-between">
                <form action=""
                    class="right-holder d-flex flex-wrap flex-sm-nowrap flex-sm-row align-items-center mb-2 mb-lg-0 justify-content-center">
                    <div class="duration-from d-flex align-items-center justify-content-center me-2">
                        <label for="date-from" class="fild-name ms-2">{{ __('admin.from') }}</label>
                        <input type="date" class="date-from form-control mb-2 mb-sm-0" id="date-from"
                            wire:model="from" />
                    </div>
                    <div class="duration-to d-flex align-items-center justify-content-center me-2">
                        <label for="date-to" class="fild-name ms-2">{{ __('admin.to') }}</label>
                        <input type="date" class="date-to form-control mb-3 mb-sm-0" id="date-to"
                            wire:model="to" />
                    </div>
                    <button type="button" class="sec-btn-gre w-75 mb-2 mb-sm-0 me-sm-2 me-0 w-50">
                        <span class="ms-1">{{ __('admin.Show') }}</span>
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </form>
                <div class="left-holder d-flex justify-content-center justify-content-sm-start m-auto m-sm-0">
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
            <div id="prt-content">
                <x-header-invoice></x-header-invoice>
                <div class="table-responsive mt-4 w-50 sw-100">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th></th>

                                <th colspan="2" class="text-end">{{ __('category') }}</th>
                                <th colspan="2">{{ __('amount') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (in_array('paid_invoices', $type))
                                <tr>
                                    <td><input type="checkbox" wire:model="type" value="paid_invoices"></td>
                                    <td colspan="2" class="text-end">{{ __('Total paid invoices') }}</td>
                                    <td colspan="2">{{ $paid_invoices }}</td>
                                </tr>
                            @endif

                            @if (in_array('partially_paid', $type))
                                <tr>
                                    <td><input type="checkbox" wire:model="type" value="partially_paid"></td>
                                    <td colspan="2" class="text-end">{{ __('Partially Paid') }}</td>
                                    <td colspan="2">{{ $partially_paid }}
                                    </td>
                                </tr>
                            @endif

                            @if (in_array('unpaid_invoices', $type))
                                <tr>
                                    <td><input type="checkbox" wire:model="type" value="unpaid_invoices"></td>
                                    <td colspan="2" class="text-end">{{ __('Set of outstanding invoices') }}</td>
                                    <td colspan="2">{{ $unpaid_invoices }}
                                    </td>
                                </tr>
                            @endif

                            @if (in_array('retrieved_invoices', $type))
                                <tr>
                                    <td><input type="checkbox" wire:model="type" value="retrieved_invoices"></td>
                                    <td colspan="2" class="text-end">فواتير مسترجعة بالكامل</td>
                                    <td colspan="2">{{ $retrieved_invoices }}
                                    </td>
                                </tr>
                            @endif

                            @if (in_array('tax', $type))
                                <tr>
                                    <td><input type="checkbox" wire:model="type" value="tax"></td>
                                    <td colspan="2" class="text-end">{{ __('value added tax') }}</td>
                                    <td colspan="2">{{ $tax }}</td>
                                </tr>
                            @endif

                            @if (in_array('expenses', $type))
                                <tr>
                                    <td><input type="checkbox" wire:model="type" value="expenses"></td>
                                    <td colspan="2" class="text-end">{{ __('Expenses') }}</td>
                                    <td colspan="2">{{ $expenses }}</td>
                                </tr>
                            @endif

                            @if (in_array('purchases', $type))
                                <tr>
                                    <td><input type="checkbox" wire:model="type" value="purchases"></td>
                                    <td colspan="2" class="text-end">{{ __('Purchases') }}</td>
                                    <td colspan="2">{{ $purchases }}</td>
                                </tr>
                            @endif


                            @if (in_array('cash', $type))
                                <tr>
                                    <td><input type="checkbox" wire:model="type" value="cash"></td>
                                    <td colspan="2" class="text-end">{{ __('cash') }}</td>
                                    <td colspan="2">{{ $cash }}</td>
                                </tr>
                            @endif

                            @if (in_array('card', $type))
                                <tr>
                                    <td><input type="checkbox" wire:model="type" value="card"></td>
                                    <td colspan="2" class="text-end">{{ __('card') }}</td>
                                    <td colspan="2">{{ $card }}</td>
                                </tr>
                            @endif

                            @if (in_array('bank', $type))
                                <tr>
                                    <td><input type="checkbox" wire:model="type" value="bank"></td>
                                    <td colspan="2" class="text-end">تحويل بنكي</td>
                                    <td colspan="2">{{ $bank }}</td>
                                </tr>
                            @endif

                            @if (in_array('visa', $type))
                                <tr>
                                    <td><input type="checkbox" wire:model="type" value="visa"></td>
                                    <td colspan="2" class="text-end">فيزا</td>
                                    <td colspan="2">{{ $visa }}</td>
                                </tr>
                            @endif

                            @if (in_array('mastercard', $type))
                                <tr>
                                    <td><input type="checkbox" wire:model="type" value="mastercard"></td>
                                    <td colspan="2" class="text-end">ماستر كارد</td>
                                    <td colspan="2">{{ $mastercard }}</td>
                                </tr>
                            @endif

                            @if (in_array('unpaid', $type))
                                <tr>
                                    <td><input type="checkbox" wire:model="type" value="unpaid"></td>
                                    <td colspan="2" class="text-end">{{ __('carry over') }}</td>
                                    <td colspan="2">{{ $unpaid_invoices }}
                                    </td>
                                </tr>
                            @endif

                            <tr>
                                <td colspan="2" class="text-end pe-5">{{ __('Final Total Without Time') }}</td>
                                <td colspan="2" class="text-center">
                                    {{ $paid_invoices }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
