<section class="main-section users">
    <!-- @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-warning">{{$error}}</div>
    @endforeach
    @endif -->
    <x-alert></x-alert>
    @include('front.expenses.add_or_update')
    <div class="container">
    <div class="d-flex mb-3">
            <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
        </div>
        <h4 class="main-heading">{{ __('admin.Expenses') }}</h4>
        <div class="section-content bg-white rounded-3 shadow p-4">
            <div class="d-flex align-items-center flex-wrap gap-1 mt-3 justify-content-between mb-2">
                <a href="{{ route('front.categories.index') }}" class="btn btn-sm btn-primary" >
                {{ __('admin.categories') }}
                </a>
                <div class="d-flex align-items-center flex-wrap gap-1 justify-content-end ">
                    <button   class="btn-main-sm" data-bs-toggle="modal"
                    data-bs-target="#add_or_update" >
                        {{ __('admin.Add expense') }}
                        <i class="icon fa-solid fa-plus me-1"></i>
                    </button>
                    <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning">
                            <i class="fa-solid fa-print"></i>
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table main-table" id="prt-content">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin.name') }}</th>
                            <th>{{ __('admin.Date') }}</th>
                            <th>{{ __('admin.Main category') }}</th>
                            <th>{{ __('admin.Subcategory') }}</th>
                            <th>{{ __('admin.amount') }}</th>
                            <th>{{ __('admin.notes') }}</th>
                            <th class="text-center not-print">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $expense)
                        <tr>
                            <td>{{ $expense->id }}</td>
                            <td>{{ $expense->name }}</td>
                            <td>{{ $expense->created_at->format('Y-m-d') }}</td>
                            <td>{{ $expense->category->main->name }}</td>
                            <td>{{ $expense->category->name }}</td>
                            <td>{{ $expense->amount }}</td>
                            <td>{{ $expense->notes }}</td>
                            <td class="not-print">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <button data-bs-toggle="modal"
                                    data-bs-target="#add_or_update"  class="btn btn-sm btn-info text-white" wire:click='edit({{ $expense }})'>
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger"  data-bs-toggle="modal"
                                    data-bs-target="#delete_agent{{ $expense->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @include('front.expenses.delete')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
