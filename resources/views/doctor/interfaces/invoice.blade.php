<section>
    @include('doctor.interfaces.add_product')
    <div class="main-container mb-4 d-flex flex-column flex-md-row align-items-start  justify-content-center">
        <div class="right-side w-75 ms-3 mb-4 mb-md-0">
            <div class="info-box d-flex flex-column">


                @if ($patient && $patient->group)
                    <div class="alert alert-warning">
                        هذا المريض ينتمي إلى المجموعة (<strong>{{ $patient->group->name }}</strong>) و المجموعة لها نسبة
                        خصم
                        (<strong>{{ $patient->group->rate }} %</strong>)
                    </div>
                @endif


                <div class="inp-container ms-0 ms-md-2 w-100 mb-4">
                    <label for="" class="small-label">نوع الفاتورة</label>
                    <select wire:model="type" id="" class="main-select w-100">
                        <option value="">اختر</option>
                        <option value="service">خدمة</option>
                        <option value="package">باكدج</option>
                    </select>
                </div>
                @if ($type)
                    @if ($type == 'service')
                        <p>{{ __('You can choose services or search by number') }}</p>
                        <div class="inp-container w-100 mb-3">
                            <label for="" class="small-label">{{ __('category') }}</label>
                            <select wire:model="selected_department_id" class="main-select w-100">
                                <option value="">{{ __('Choose department') }}</option>
                                @foreach ($departments ?? [] as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="inp-container ms-0 ms-md-2 w-100">
                            <label for="" class="small-label">{{ __('admin.Date') }}</label>
                            <input type="date" id="" class="form-control w-100" wire:model="date" />
                        </div>

                        <div class="inp-container w-100 mb-3">
                            <label for="" class="small-label">{{ __('service') }}</label>
                            <select wire:model="product_id" class="main-select w-100" wire:change='add_product'>
                                <option value="">{{ __('Choose the service') }}</option>
                                @foreach (\App\Models\Product::query()->where('department_id', $selected_department_id)->get() as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex align-items-end gap-2 mb-3">
                            <div class="inp-container w-100">
                                <label for="" class="small-label">{{ __('Service number search') }}</label>
                                <input type="number" wire:model='product_id' class="form-control"
                                    wire:keyup='add_product'>
                            </div>
                            <div class="inp-container d-flex w-100 gap-2">
                                <a target="_blank" href="{{ route('front.products.index') }}"
                                    class="btn btn-sm btn-primary">{{ __('products') }}</a>
                                <a data-bs-toggle="modal" data-bs-target="#add_product"
                                    class="btn btn-sm btn-success">{{ __('admin.Add product') }}</a>
                            </div>
                        </div>
                    @else
                        <div class="inp-container ms-2 w-100">
                            <label for="" class="small-label">الباكدج</label>
                            <select wire:model="package_id" id="" class="main-select w-100">
                                <option value="">اختر الباكدج</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                @endif

                <div class="inp-container d-flex align-items-center mb-3 w-100">
                    <label for="split"
                        class="small-label ms-2 form-check-label">{{ __('admin.split bill') }}</label>
                    <input type="checkbox" wire:model="split" id="split" class="form-check-input mt-0">
                </div>
                <div class="inp-container d-flex flex-column w-100 {{ $split ? '' : 'd-none' }}">
                    <label for="split" class="small-label mb-2">{{ __('admin.splits number') }}</label>
                    <input type="number" wire:model="split_number" id="" wire:keyup='computeForAll'
                        class="w-100 form-control">
                </div>
            </div>
        </div>
        <div class="left-side w-50 sw-100">
            <div class="output-box d-flex flex- align-items-center justify-content-end mb-2">
                <span class="a_word ms-2"> {{ __('admin.amount') }} : </span>
                <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                    wire:model="amount" />
            </div>
            <div class="output-box d-flex align-items-center justify-content-end mb-2">
                <span class="a_word ms-2"> {{ __('Discount Offers') }} :</span>
                <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                    wire:model="offers_discount" />
            </div>
            <div class="output-box d-flex align-items-center justify-content-end mb-2">
                <span class="a_word ms-2 space-noWrap"> {{ __('Amount after discount of offers') }} :</span>
                <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                    wire:model="amount_after_offers_discount" />
            </div>


            @if ($patient && $patient->group)
                <div class="output-box d-flex align-items-center justify-content-end mb-2">
                    <label for="" class="small-label">المجموعة</label>
                    <input type="text" value="{{ $patient ? $patient->group->name : '' }}" readonly id=""
                        class="form-control w-50" />
                </div>
                <div class="output-box d-flex align-items-center justify-content-end mb-2">
                    <span class="a_word ms-2"> {{ __('admin.discount') }}:</span>
                    <input type="text" readonly placeholder="0" class="text-center form-control w-50"
                        wire:model="discount" wire:keyup="calculateNet" />
                </div>
            @endif


            <div class="output-box d-flex align-items-center justify-content-end mb-2">
                <span class="a_word ms-2"> {{ __('admin.tax') }} : </span>
                <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                    wire:model="tax" />
            </div>
            <div class="output-box d-flex align-items-center justify-content-end mb-2">
                <span class="a_word ms-2 space-noWrap"> {{ __('admin.Total with tax') }} : </span>
                <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                    wire:model="total" />
            </div>

            {{-- @can('خصم الفاتورة')
            <div class="output-box d-flex align-items-center justify-content-end mb-2">
                <span class="a_word ms-2"> {{ __('admin.discount') }} :</span>
            <input type="text" placeholder="0" class="text-center form-control w-50" wire:model="discount" wire:keyup='computeForAll' />
        </div>
        @endcan --}}


            <div class="output-box d-flex align-items-center justify-content-end mb-2 {{ $split ? '' : 'd-none' }}">
                <span class="a_word ms-2"> {{ __('admin.total after split') }} : </span>
                <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                    wire:model="total_after_split" />
            </div>



        </div>
    </div>
    @if ($type && $type == 'service')
        <div class="table-responsive mt-4">
            <table class="table main-table">
                <thead>
                    <tr>
                        <th>{{ __('admin.department') }}</th>
                        <th>{{ __('admin.product') }}</th>
                        <th>{{ __('admin.price') }}</th>
                        <th>{{ __('admin.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $key => $item)
                        <tr>
                            <td>{{ __($item['department']) }}</td>
                            <td>{{ $item['product_name'] }}</td>
                            @can('خصم الفاتورة')
                                <td><input type="number" wire:model="items.{{ $key }}.price" id=""
                                        wire:keyup='changeItemTotal({{ $key }})'></td>
                            @else
                                <td>{{ $item['price'] }}</td>
                            @endcan
                            <td>
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <button class="btn btn-sm btn-danger"
                                        wire:click="delete_item({{ $key }})">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if ($packagee && $package_id != '')
        <div class="table-responsive ">
            <table class="table main-table">
                <thead>
                    <tr>
                        <th>{{ __('admin.name') }}</th>
                        <th>{{ __('admin.price') }}</th>
                        <th>{{ __('admin.actions') }}</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $packagee->title }}</td>
                        <td><input type="number" value="{{ $packagee->total }}" class="form-control"
                                id="" disabled></td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center gap-1">
                                <button class="btn btn-sm btn-danger" wire:click="deletePackage()">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    @endif
    <div class="The-text-area w-100">
        <textarea wire:model.defer="notes" id="" class="form-control w-100 p-2"
            placeholder="{{ __('admin.notes') }}"></textarea>
    </div>
    <div class="submitBtn-holder text-center mt-3">
        <button wire:click='addInvoice' class="btn btn-success w-25">
            {{ __('admin.Save') }}
        </button>
    </div>
</section>
