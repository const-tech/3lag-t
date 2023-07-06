<section class="main-section users">

    <div class="container">
        <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
            <h4 class="main-heading mb-0">{{ __('admin.patients') }}</h4>
        </div>
        <div class="bg-white shadow p-4 rounded-3">
            <div class="amountPatients-holder d-flex flex-column flex-md-row justify-content-start gap-2">
                <div class="py-2 px-3 bg-info rounded text-white">
                    {{ __('Saudi patients')}} : {{ App\Models\Patient::where('country_id',1)->count() }}
                </div>
                <div class="py-2 px-3 bg-info rounded text-white">
                    {{ __("non-Saudi patients")}}: {{ App\Models\Patient::where('country_id','<>',1)->count() }}
                </div>
                <a class="py-2 px-3 bg-info rounded text-white">
                    {{ __('Registered guest')}} : {{ App\Models\Patient::where('visitor',1)->count() }}
                </a>
            </div>

            <div class="row my-3">
                <div class="col-md-10 d-flex flex-column flex-md-row">
                    <div dir="ltr" class="input-group ms-2 mb-2 mb-md-0">
                        <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                            {{ __('admin.Search') }}
                        </button>
                        <input dir="rtl" type="text" class="form-control" wire:model='civil' placeholder=" {{ __('admin.ID number search') }}" />
                    </div>

                    <div dir="ltr" class="input-group ms-2 mb-2 mb-md-0">
                        <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                            {{ __('admin.Search') }}
                        </button>
                        <input dir="rtl" type="text" class="form-control" wire:model='phone' placeholder="{{ __('admin.Mobile number search') }}" />
                    </div>

                    <div dir="ltr" class="input-group ms-2 mb-2 mb-md-0">
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

                <div class="col-md-2 d-flex align-items-end justify-content-end">
                    <div class="addBtn-holder ">
                        <a href="{{ route('front.patients.create') }}" class="btn-main-sm">
                            {{ __('admin.Add patient') }}
                            <i class="icon fa-solid fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th>{{ __('admin.Medical number') }}</th>
                            <th>{{ __('admin.name') }}</th>
                            <th>{{ __('admin.Country') }}</th>
                            @can('رؤية جوال المريض')
                            <th>{{ __('admin.phone') }}</th>
                            @endcan
                            <th>{{ __('admin.Civil number') }}</th>
                            <th>{{ __('admin.Last modified by') }}</th>
                            <th class="text-center">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patients as $patient)
                        <tr>
                            <td>{{ $patient->id }}</td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->country?->name }}</td>
                            @can('رؤية جوال المريض')
                            <td>{{ $patient->phone }}</td>
                            @endcan
                            <td>{{ $patient->civil }}</td>
                            <td>{{ $patient->user?->name }}</td>
                            <td>
                                @can('عرض الملف الشخصي للمريض')
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <!--btn  Modal repeat-->
                                    <a href="{{ route('doctor.patients.show',$patient) }}" class="btn btn-sm btn-purple py-2">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                                @endcan
                            </td>
                        </tr>
                        @include('front.patients.delete')
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- All Modal -->
            <!-- Modal repeat -->

        </div>
    </div>
</section>
