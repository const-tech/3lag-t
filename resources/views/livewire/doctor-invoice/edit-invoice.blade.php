<section class="main-section home">

    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading">{{ __('admin.Add invoice') }}</h4>
        <div class="addNvoice-content bg-white p-4 shadow">
            <div class="tip">
                <p class="tip-text text-danger"> هناك نسبة {{ setting()->tax_rate }}% ضريبة علي الفاتورة </p>

                <div
                    class="main-container mb-4 d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-center">
                    <div class="right-side w-75 ms-3 mb-4 mb-md-0">
                        <div class="info-box d-flex flex-column flex-md-row mb-3">
                            <div class="inp-container ms-2 w-100">
                                <label for=""
                                    class="small-label">{{ __('admin.Patient file number or ID number') }}</label>
                                <input type="text" wire:model="patient_key" class="form-control w-100"
                                    wire:keyup='get_patient' />
                            </div>
                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.patient') }}</label>
                                <input type="text" value="{{ $patient->name }}" readonly id=""
                                    class="form-control w-100" />
                            </div>
                            @can('رؤية جوال المريض')
                                <div class="inp-container ms-2 w-100">
                                    <label for="" class="small-label">{{ __('admin.phone') }}</label>
                                    <input type="tel" value="{{ $patient->phone }}" readonly id=""
                                        class="form-control w-100" />
                                </div>
                            @endcan
                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="" class="small-label">{{ __('admin.Date') }}</label>
                                <input type="date" id="" class="form-control w-100" wire:model="date" />
                            </div>
                        </div>
                        <div class="info-box d-flex flex-column flex-md-row mb-3">
                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.Status') }}</label>
                                <select wire:model="status" id="" class="main-select w-100">
                                    <option value="">{{ __('admin.Status') }}</option>
                                    <option value="pending">{{ __('admin.pending') }}</option>
                                    <option value="Paid">{{ __('admin.Paid') }}</option>
                                    <option value="Unpaid">{{ __('admin.Unpaid') }}</option>
                                    <option value="cancelled">{{ __('admin.Cancelled') }}</option>
                                    <option value="Partially Paid">{{ __('Partially Paid') }}</option>
                                    {{-- <option value="يue">{{ __('admin.Overdue') }}</option> --}}
                                </select>
                            </div>
                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.Clinic') }}</label>
                                <select wire:model="department_id" id="" class="main-select w-100">
                                    <option value="">
                                        {{ __('admin.Choose Clinic') }}
                                    </option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.dr') }}</label>
                                <select wire:model="dr_id" id="" class="main-select w-100">
                                    <option value="">{{ __('admin.dr') }}</option>
                                    @foreach ($doctors as $dr)
                                        <option value="{{ $dr->id }}">{{ $dr->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="inp-container ms-2 w-100">
                <label for="" class="small-label">{{ __('admin.Period') }}</label>
                <select name="" id="" class="main-select w-100">
                  <option value="">{{ __('admin.Period') }}</option>
                  <option value="">{{ __('admin.morning') }}</option>
                  <option value="">{{ __('admin.evening') }}</option>
                </select>
              </div> --}}
                        </div>
                        <div class="info-box d-flex flex-column flex-md-row">

                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.product') }}</label>
                                <select wire:model="product_id" id="" class="main-select w-100"
                                    wire:change='add_product'>
                                    <option value="">{{ __('admin.product') }}</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="left-side w-25">
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.amount') }}: </span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="amount" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.Total with tax') }}: </span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="total" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.tax') }}: </span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="tax" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.discount') }}:</span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="discount" />
                        </div>



                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.rest') }} : </span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="rest" />
                        </div>
                    </div>
                </div>
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
                                    <td>{{ $item['department'] }}</td>
                                    <td>{{ $item['product_name'] }}</td>
                                    <td>{{ $item['price'] }}</td>
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
                <div class="Thetext-area w-100">
                    <textarea wire:model.defer="notes" id="" class="form-control w-100 p-2"
                        placeholder="{{ __('admin.notes') }}"></textarea>
                </div>
                <div class="submitBtn-holder text-center mt-3">
                    <button wire:click='submit' class="btn btn-success">
                        {{ __('admin.Save') }}
                    </button>
                </div>

            </div>
        </div>
    </div>
</section>
