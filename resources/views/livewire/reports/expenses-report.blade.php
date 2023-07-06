<section class="patinet-report main-section pt-5">
    <div class="container">
    <div class="d-flex mb-3">
            <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
        </div>
        <h4 class="main-heading">{{ __('admin.Expense report') }}</h4>
        <div class="treasuryAccount-content bg-white p-4 rounded-2 shadow">
            <div class="left-holder d-flex justify-content-end m-sm-0">
                <button class="btn btn-sm btn-outline-info" id="export-btn">
                    <i class="fa-solid fa-file-excel"></i>
                    <span>{{ __('admin.Export') }} Excel</span>
                </button>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="duration-from" class="report-name mt-3 mb-2">{{ __('admin.from') }}</label>
                        <input type="date" class="form-control" value="2022-07-12" wire:model="from" id="duration-from" />
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="duration-to" class="report-name mt-3 mb-2">{{ __('admin.to') }}</label>
                        <input type="date" class="form-control" value="2024-03-03" wire:model="to" id="duration-to" />
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="pay-way" class="report-name mt-3 mb-2">{{ __('admin.category') }}</label>
                        <select class="main-select w-100 pay-way" id="pay-way" wire:model="category">
                            <option value="">{{ __('admin.All') }}</option>
                            @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table main-table" id="data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin.name') }}</th>
                            <th>{{ __('admin.category') }}</th>
                            <th>{{ __('admin.amount') }}</th>
                            <th>{{ __('admin.Date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($expenses as $expense)
                        <tr>
                            <td>{{ $expense->id }}</td>
                            <td>{{ $expense->name }}</td>
                            <td>{{ $expense->category?->name }}</td>
                            <td>{{ $expense->amount }}</td>
                            <td>{{ $expense->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">{{ __('admin.Sorry, there are no results') }}</td>
                        </tr>
                        @endforelse
                        @if ($expenses->count()>0)
                        <tr>
                            <td>{{ __('admin.Sum') }}</td>
                            <td></td>
                            <td></td>
                            <td>{{ $expenses?->sum('amount')}}</td>
                            <td></td>
                        </tr>
                        @endif

                    </tbody>
                </table>
                {{ $expenses->links() }}
            </div>
        </div>
    </div>
</section>
