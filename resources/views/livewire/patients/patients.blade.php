<section class="main-section users">
    <x-alert></x-alert>

    <div class="container" id="data-table">

        <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
            <h4 class="main-heading mb-0">{{ __('admin.patients') }}</h4>
        </div>
        <div class="bg-white shadow p-4 rounded-3">
            <div class="amountPatients-holder gap-2 d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
                <div class="d-flex flex-column flex-md-row">
                    <div class="py-2 px-3 bg-info rounded text-white ">
                        {{ __('Saudi patients') }} : {{ App\Models\Patient::where('country_id', 1)->count() }}
                    </div>
                    <div class="py-2 px-3 bg-info rounded text-white mx-0 my-2 my-md-0 mx-md-2">
                        {{ __('Non-Saudi Patients') }} : {{ App\Models\Patient::where('country_id', '<>', 1)->count() }}
                    </div>
                    <div class="py-2 px-3 bg-info rounded text-white" style="cursor: pointer" wire:click='$toggle("filter_visit")'>
                        {{ __('Registered Visitor') }} : {{ App\Models\Patient::where('visitor', 1)->count() }}
                    </div>
                </div>
                <div class="btn-holders">
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="{{ __('Visitor registrars are those who have made reservations over the phone or via the website and their data is completed when they attend the clinic') }}">
                        <i class="fa-solid fa-question"></i>
                    </button>
                    <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning py-1">
                        <i class="fa-solid fa-print"></i>
                    </button>
                </div>
            </div>

            <div class="">
                <div class="row my-3">
                    <div class="col-md-10 d-flex flex-column flex-md-row gap-2 px-0">
                        <div dir="ltr" class="input-group mb-2 mb-md-0">
                            <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                                {{ __('admin.Search') }}
                            </button>
                            <input dir="rtl" type="text" class="form-control" wire:model='civil' placeholder=" {{ __('admin.ID number search') }}" />
                        </div>

                        <div dir="ltr" class="input-group mb-2 mb-md-0">
                            <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                                {{ __('admin.Search') }}
                            </button>
                            <input dir="rtl" type="text" class="form-control" wire:model='phone' placeholder="{{ __('admin.Mobile number search') }}" />
                        </div>

                        <div dir="ltr" class="input-group mb-2 mb-md-0">
                            <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                                {{ __('admin.Search') }}
                            </button>
                            <input dir="rtl" type="text" class="form-control" wire:model='patient_id' placeholder="  {{ __('admin.Search by medical number') }}" />
                        </div>
                        <div dir="ltr" class="input-group ms-2 mb-2 mb-md-0">
                            <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                                {{ __('admin.Search') }}
                            </button>
                            <input dir="rtl" type="text" class="form-control" wire:model='first_name' placeholder="  {{ __('admin.Search by firstname') }}" />
                        </div>
                    </div>
                    @can('اضافة مريض')
                    <div class="col-md-2 d-flex align-items-end justify-content-end px-0">
                        <div class="addBtn-holder ">
                            <a href="{{ route('front.patients.create') }}" class="btn-main-sm">
                                {{ __('admin.Add patient') }}
                                <i class="icon fa-solid fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    @endcan
                </div>
                <div class="table-responsive">
                    <table id="prt-content" class="table main-table">
                        <thead>
                            <tr>
                                <th>{{ __('admin.Medical number') }}</th>
                                <th>{{ __('admin.name') }}</th>
                                <th>{{ __('admin.Country') }}</th>
                                @can('رؤية جوال المريض')
                                <th>{{ __('admin.phone') }}</th>
                                @endcan
                                @if(in_array(setting()->age_or_gender, ['sex', 'all']))
                                <th>{{ __('Gender') }}</th>
                                @endif
                                @if(in_array(setting()->age_or_gender, ['age', 'all']))
                                <th>{{ __('Age type') }}</th>
                                @endif
                                <th>{{ __('admin.Civil number') }}</th>
                                <th>{{ __('Unpaid bills') }}</th>
                                <th>{{ __('Partially Paid') }}</th>
                                <th>{{ __('admin.Last modified by') }}</th>
                                <th class="text-center not-print">{{ __('admin.managers') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $patient)
                            <tr>
                                <td>{{ $patient->id }}</td>
                                <td>{{ $patient->name }}</td>
                                <td>{{ $patient->country?->name ?? null }}</td>
                                @can('رؤية جوال المريض')
                                <td>{{ $patient->phone }}</td>
                                @endcan
                                @if(in_array(setting()->age_or_gender, ['sex', 'all']))
                                <th>{{ __($patient->gender) }}</th>
                                @endif
                                @if(in_array(setting()->age_or_gender, ['age', 'all']))
                                <th>{{ __($patient->age_type) }}</th>
                                @endif
                                <td>{{ $patient->civil }}</td>
                                <td>
                                    <a href="{{ route('front.invoices.index', ['patient_id' => $patient->id, 'status' => 'Unpaid']) }}" class="btn btn-sm btn-outline-secondary">
                                        {{ $patient->invoices()->unpaid()->count() }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('front.invoices.index', ['patient_id' => $patient->id, 'status' => 'Partially Paid']) }}" class="btn btn-sm btn-outline-secondary">
                                        {{ $patient->invoices()->PartiallyPaid()->count() }}
                                    </a>
                                </td>
                                <td>{{ $patient->user?->name }}</td>
                                <td class="not-print">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <!--btn  Modal repeat-->
                                        <a href="{{ route('front.patients.show', $patient) }}" class="btn btn-sm btn-purple py-1">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @can('تحويل مريض')
                                        <button type="button" wire:click="transfer({{ $patient }})" class="btn btn-sm btn-primary py-1">
                                            <i class="fa fa-repeat"></i>
                                        </button>
                                        @endcan
                                        @can('تعديل مريض')
                                        <a href="{{ route('front.patients.edit', $patient) }}" class="btn btn-sm btn-info text-white py-1">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        @endcan
                                        @can('حذف مريض')
                                        <button class="btn btn-sm btn-danger py-1" data-bs-toggle="modal" data-bs-target="#delete_agent{{ $patient->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @include('front.patients.delete')
                            @endforeach

                        </tbody>
                    </table>
                </div>
                {{ $patients->links() }}
                <!-- All Modal -->
                <!-- Modal repeat -->
            </div>
        </div>
        @include('front.patients.transfer')
        @push('js')
        <script>
            window.livewire.on('trans_modal', function() {
                var myModal = new bootstrap.Modal(document.getElementById("trans"), {});
                myModal.show();
            })

        </script>
        @endpush

    </div>
</section>
