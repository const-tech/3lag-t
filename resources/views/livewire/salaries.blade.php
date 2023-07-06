<section class="main-section ">
    <div class="container">
        <div class="alert alert-secondary d-none" role="alert">
            <div class="d-flex flex-column">
                <div class="mb-2">
                    سبب الخصم :
                </div>
                <div class="">
                    كمية الخصم :
                </div>
            </div>
        </div>
        @if ($screen == 'salaries')
            <h4 class="main-heading mb-4">{{ __('admin.Employee salaries') }}</h4>
            <div class="section-content p-4 shadow bg-white">
                <div
                    class="d-flex gap-3 flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-2">
                    <div class="status-info d-flex flex-column flex-md-row">
                        <div class="bg-info text-white p-2 rounded-3 mb-2 mb-md-0 ms-md-2">
                            <b>{{ __('admin.Total employee salary') }}
                            </b> {{ $users->sum('salary') }}
                        </div>
                        {{-- <div class="bg-info text-white p-2 rounded-3 mb-2 mb-md-0 ms-md-2"><b>{{ __('admin.Salaries paid') }} </b> {{ App\Models\User::TotalMonthlyIncome() }}</div> --}}
                        <div class="bg-info text-white p-2 rounded-3"><b>{{ __('admin.Financial discount') }} </b>
                            {{ $sum_discounts }}
                        </div>
                    </div>
                    <div class="holder-btn d-flex align-items-center gap-1 flex-wrap">
                        <button class="btn trans-btn btn-sm" wire:click="$set('screen','discounts')">{{ __('admin.discounts') }}</button>
                        <button class="btn trans-btn btn-sm" wire:click="$set('screen','increases')">{{ __('admin.increases') }}</button>
                        <button class="btn trans-btn btn-sm" wire:click="$set('screen','overtimes')">{{ __('admin.overtimes') }}</button>
                        <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning">
                            <i class="fa-solid fa-print"></i>
                        </button>
                    </div>
                </div>
                <div class="collect-box d-flex align-items-center justify-content-between flex-wrap mb-3">
                    <div class="info-box w-50">
                        <select id="" wire:model="filter_by_user" class="main-select w-50">
                            <option value="">{{ __('admin.users') }}</option>
                            @foreach ($all_users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="btn-holder d-flex align-items-center gap-1 flex-wrap">
                        <button class="btn btn-success btn-sm" wire:click='$set("screen","add-discount")'>{{ __('admin.Add discount') }}</button>
                        <button class="btn btn-success btn-sm" wire:click='$set("screen","add-increase")'>{{ __('admin.Add increase') }}</button>
                        <button class="btn btn-success btn-sm" wire:click='$set("screen","add-overtime")'>{{ __('admin.Add overtime') }}</button>
                    </div>
                </div>
                <div id="prt-content">
                    <x-header-invoice></x-header-invoice>
                    <div class="table-responsive">
                        <table class="table main-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('admin.Month') }}</th>
                                    <th>{{ __('admin.employee') }}</th>
                                    <th>{{ __('admin.Salary') }}</th>
                                    <th>{{ __('admin.Discount') }}</th>
                                    <th>الزياده</th>
                                    <th>{{ __('admin.rate') }}</th>
                                    <th>مبلغ التارجت</th>
                                    <th>مبلغ النسبه</th>
                                    <th>المبلغ بعد التارجت</th>
                                    <th>وقت إضافي</th>
                                    <th>{{ __('admin.Total with rate') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total_percents = 0;
                                    $total_increases = 0;
                                @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <td scope="row">{{ $loop->index + 1 }}</td>
                                        <td scope="row">{{ __('admin.Month') }} {{ now()->format('m') }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->salary }}</td>
                                        <td>{{ $user->monthly_discounts }}</td>
                                        <td>{{ $user->increases->sum('amount') }}</td>
                                        @php
                                            $total_increases += $user->increases->sum('amount');
                                            $total_percents += $user->rate;
                                        @endphp
                                        <td>{{ $user->rate }}%</td>
                                        <td>{{ $user->target }}</td>
                                        <td>{{ $user->monthly_income_from_invoices }}</td>
                                        @php
                                            $monthly_invoices = $user
                                                ->invoices()
                                                ->whereMonth('created_at', Carbon::now()->month)
                                                ->sum('total');
                                            $amount_after_target = 0;

                                        @endphp

                                        @if ($monthly_invoices >= $user->target && $user->rate_type == 'rating_after_salary')
                                            @php
                                                $amount_after_target = ($user->salary * $user->rate) / 100;
                                            @endphp
                                        @endif
                                        <td>{{ $amount_after_target }}</td>
                                        <td>{{ $user->overtimes->sum('amount') }}</td>
                                        @if ($amount_after_target > 0)
                                            <td>{{ $amount_after_target + $user->salary + $user->overtimes->sum('amount') + $user->increases->sum('amount') - $user->monthly_discounts }}
                                            </td>
                                        @else
                                            <td>{{ $user->monthly_income_from_invoices + $user->salary + $user->overtimes->sum('amount') + $user->increases->sum('amount') - $user->monthly_discounts }}
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach
                            </tbody>
                            @php
                                $total = $user->monthly_income_from_invoices + $user->salary + $user->overtimes->sum('amount') + $user->increases->sum('amount') - $user->monthly_discounts;
                            @endphp
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $user->sum('salary') }}</td>
                                    <td></td>
                                    {{-- <td>{{ $user->monthly_discounts ?  $user->sum('monthly_discounts')  : ' '}}</td> --}}
                                    <td>{{ $total_increases }}
                                    </td>
                                    <td>%{{ $total_percents }}</td>

                                </tr>
                            </tfoot>
                        </table>
                        {{ $users->links() }}
                    </div>

                </div>

                @if (count($discounts) > 0)
                    <div class="">
                        <h4>{{ __('admin.discounts') }}</h4>
                        <div class="table-responsive">
                            <table class="table main-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('admin.Month') }}</th>
                                        <th>{{ __('admin.Discount') }}</th>
                                        <th>{{ __('admin.Date') }}</th>
                                        <th>{{ __('admin.reason') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($discounts as $discount)
                                        <tr>
                                            <td scope="row">{{ $loop->index + 1 }}</td>
                                            <td scope="row">{{ __('admin.Month') }} {{ now()->format('m') }}</td>
                                            <td>{{ $discount->amount }}</td>
                                            <td>{{ $discount->date }}</td>
                                            <td>{{ $discount->reason }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $discounts->links() }}
                        </div>
                    </div>
                @else
                    @if (count($increases) > 0)
                        <div class="">
                            <h4>{{ __('admin.discounts') }}</h4>
                            <div class="table-responsive">
                                <table class="table main-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('admin.Month') }}</th>
                                            <th>{{ __('admin.Discount') }}</th>
                                            <th>{{ __('admin.Date') }}</th>
                                            <th>{{ __('admin.reason') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($increases as $increase)
                                            <tr>
                                                <td scope="row">{{ $loop->index + 1 }}</td>
                                                <td scope="row">{{ __('admin.Month') }} {{ now()->format('m') }}
                                                </td>
                                                <td>{{ $increase->amount }}</td>
                                                <td>{{ $increase->date }}</td>
                                                <td>{{ $increase->reason }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $increases->links() }}
                            </div>
                        </div>
                    @endif
                    @if (count($overtimes) > 0)
                        <div class="">
                            <h4>{{ __('admin.overtimes') }}</h4>
                            <div class="table-responsive">
                                <table class="table main-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('admin.Month') }}</th>
                                            <th>{{ __('admin.Discount') }}</th>
                                            <th>{{ __('admin.Date') }}</th>
                                            <th>{{ __('admin.reason') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($overtimes as $overtime)
                                            <tr>
                                                <td scope="row">{{ $loop->index + 1 }}</td>
                                                <td scope="row">{{ __('admin.Month') }} {{ now()->format('m') }}
                                                </td>
                                                <td>{{ $overtime->amount }}</td>
                                                <td>{{ $overtime->date }}</td>
                                                <td>{{ $overtime->reason }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $overtimes->links() }}
                            </div>
                        </div>
                    @endif
                @endif

            </div>
        @else
            @include('front.salaries.' . $screen)
        @endif
    </div>
</section>
