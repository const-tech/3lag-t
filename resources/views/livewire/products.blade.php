<section class="main-section users">
    <x-alert></x-alert>
    @include('front.products.add_or_update')
    <div class="container">
        <h4 class="main-heading">{{ __('admin.products') }}</h4>
        <div class="bg-white rounded-3 shadow p-3">
            <div class="d-flex align-items-center flex-wrap gap-2 mt-3 justify-content-between mb-3">

                <select class="main-select w-25" wire:model="filter_by_department" id="">
                    <option value="">{{ __('admin.Choose the department') }}</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>

                <div class="btn-holder-option d-flex">
                    <button class="btn-main-sm ms-1" data-bs-toggle="modal" data-bs-target="#add_or_update">
                        {{ __('admin.Add product') }}
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
                            <th>{{ __('service number') }}</th>
                            <th>{{ __('admin.name') }}</th>
                            <th>{{ __('admin.department') }}</th>
                            <th>{{ __('admin.price') }}</th>
                            <th class="text-center not-print">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->department->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td class="not-print">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <a href="{{ route('front.products_report', ['product' => $product->id]) }}"
                                            class="btn btn-sm trans-btn text-white space-noWrap">{{ __('admin.financial report') }}</a>
                                        <button data-bs-toggle="modal" data-bs-target="#add_or_update"
                                            class="btn btn-sm btn-info text-white"
                                            wire:click='edit({{ $product }})'>
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete_agent{{ $product->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @include('front.products.delete')
                        @endforeach

                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div>
</section>
