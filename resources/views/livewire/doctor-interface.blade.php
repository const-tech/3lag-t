<div class="getHeightContainer bg-white p-3 rounded-2 shadow">
    <x-alert></x-alert>
    <div class="row">
        <div class="col-lg-3 col-xl-2 ps-0" wire:poll.30000ms>
            <p class="mb-2">{{ __('patients') }} :</p>
            @if ($patient && $patient->packages->count() > 0)
            @foreach ($patient->packages as $item)
            <div class="box-plan">
                <button wire:click="selectPackage({{ $item->id }})" class="name btn">{{ $item->package->title
                    }}</button>
            </div>
            @endforeach

            @endif
            <ul class="list-unstyled main-nav-tap mb-3">
                <li class="nav-item" wire:click='$set("patients_screen","transfers")'>
                    <a href="#" class="nav-link active cursor-auto">
                        {{ __('Converters') }}
                        {{ doctor()->appointments()->Transferred()->doesntHave('diagnos')->count() }}
                    </a>
                </li>
            </ul>
            <div class=" main-tab-content">
                <ul class=" d-flex flex-wrap gap-2">
                    @forelse(doctor()->appointments()->Transferred()->doesntHave('diagnos')->get() as $appointment)
                    <li class="right-b color-gr">
                        <a href="#" wire:click="selectPatient({{ $appointment->id }})">
                            {{ $appointment->patient->name }} <br> {{ $appointment->appointment_date }} |
                            {{ date('g:iA', strtotime($appointment->appointment_time)) }}</a>
                    </li>
                    <hr>
                    @empty
                    <li class="color-gr">{{ __('There is no') }}</li>
                    @endforelse
                </ul>
            </div>
            <ul class="mt-3 list-unstyled mb-0">
                <li class="nav-item alt-bg-color" wire:click='$set("patients_screen","today")'>
                    <a href="#" class="nav-link text-white cursor-auto">
                        {{ __('Today appointments') }}
                        {{ $today_appointments->count() }}
                    </a>
                </li>
            </ul>
            <div class=" main-tab-content">
                <ul class="{{ $patients_screen == 'today' ? '' : '' }}">
                    @forelse($today_appointments as $appointment)
                    <li class="right-b alt-text-color"><a href="#" class="alt-text-color"
                            wire:click="selectPatient({{ $appointment->id }})">
                            {{ $appointment->patient->name }} <br> {{ $appointment->appointment_date }} |
                            {{ date('g:iA', strtotime($appointment->appointment_time)) }}
                            <br>
                            {{ __('Attended at') }} {{ $appointment->attended_at }}
                        </a>

                    </li>
                    @empty
                    <li class="alt-text-color">{{ __('There is no') }}</li>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="col-lg-9 col-xl-10 mt-3 mt-lg-0">
            <div class="d-flex mb-1 align-items-center justify-content-between">
                <div class="d-flex mb-1 align-items-center gap-1 justify-content-between flex-fill">
                    <p class="mb-0">
                        <b class="text-main-color">{{ __('Patient name') }} : </b>
                        {{ $patient->name ?? null }}
                        @if ($patient_package)
                            -
                        <b class="text-main-color">اسم الخطة : </b> {{ $patient_package->package->title }}
                        @endif
                        @if ($session_no)
                        جلسة {{ $session_no }}
                        @endif
                    </p>

                    @if ($patient)
                    <div class="mb-0">
                        <button type="submit" wire:click="endSession" class="btn btn-sm btn-info me-2">
                            {{ __('End Session') }}
                        </button>
                    </div>
                    @endif

                    @if ($patient->sugar ?? null or $patient->pressure ?? null or $patient->is_pregnant ?? null)
                    <div class="alert alert-danger d-flex align-items-center mb-0 py-2 ps-3 pe-2 me-2" role="alert">
                        <svg class="bi flex-shrink-0 ms-2 resize-svg-Bo" role="img" aria-label="Warning:">
                            <path
                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg>
                        <div>
                            {{ __('The patient suffers from') }} :
                            @if ($patient->sugar)
                            <span>{{ __('diabetes') }},</span>
                            @endif
                            @if ($patient->pressure)
                            <span>{{ __('high blood pressure') }}, </span>
                            @endif
                            @if ($patient->is_pregnant)
                            <span>{{ __('pregnant') }}</span>
                            @endif
                        </div>
                    </div>
                    @endif
                    @if ($patient)
                    <div class="flex-end">
                        <a target="_blank" class="btn btn-sm btn-info" href="{{ route('doctor.invoices.index',['patient'=>$patient->id]) }}">فواتير المريض</a>
                    </div>
                    @endif
                </div>
                {{-- @if ($patient)
                <div class="btn-holder">
                    <button class="btn-main-sm blue-color" wire:click="examine_patient">كشف حاله</button>
                </div>
                @endif --}}

            </div>
            @if ($patient && $patient->packages->count() > 0 && $patient_package)
            <div class="taps-holder mb-3">
                <ul class="nav nav-pills mb-3 flex-wrap gap-2">
                    @for ($i = 1; $i <= $patient_package->dayes_period; $i++)
                        <li class="nav-item">
                            @php
                            $diagnose = \App\Models\Diagnose::where('patient_id', $this->patient->id)
                            ->where('patient_package_id', $patient_package->id)
                            ->where('session_no', $i)
                            ->first();

                            @endphp
                            <button wire:click="selectSession({{ $patient_package->id }}, {{ $i }})"
                                class="nav-link text-center {{ $diagnose ? 'bg-gray' : 'bg-green' }}">
                                جلسة {{ $i }}
                            </button>
                        </li>
                        @endfor
                </ul>
            </div>
            @endif
            <div>
                {{-- alert success --}}
                @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
            </div>
            @if ($patient || $examine_session == true)


<<<<<<< HEAD
            @if ($patient_package && !$session_no)
            <div class="alert alert-danger">يجب تحديد الجلسة أولاً</div>
=======
                @if ($patient_package && !$session_no)
                    <div class="alert alert-danger">يجب تحديد الجلسة أولاً</div>
                @else
                    <ul class="nav nav-pills main-nav-tap mb-3" style="flex-wrap: wrap !important;">
                        <li class="nav-item" wire:click="$set('screen','current')">
                            <a href="#" class="nav-link {{ $screen == 'current' ? 'active' : '' }}">
                                {{ __('current diagnosis') }}
                            </a>
                        </li>
                        <li class="nav-item" wire:click="$set('screen','invoice')">
                            <a href="#" class="nav-link {{ $screen == 'invoice' ? 'active' : '' }}">
                                {{ __('Issuance of invoice') }}
                            </a>
                        </li>
                        <li class="nav-item" wire:click="$set('screen','data')">
                            <a href="#" class="nav-link {{ $screen == 'data' ? 'active' : '' }}">
                                {{ __('Patient data') }}
                            </a>
                        </li>
                        <li class="nav-item" wire:click="$set('screen','prev')">
                            <a href="#" class="nav-link  {{ $screen == 'prev' ? 'active' : '' }}">
                                {{ __('previous diagnoses') }}
                            </a>
                        </li>
                        <li class="nav-item" wire:click="$set('screen','trans')">
                            <a href="#" class="nav-link {{ $screen == 'trans' ? 'active' : '' }}  ">
                                {{ __('Transfer of the patient') }}
                            </a>
                        </li>

                        @if (env('PHARMACY_ENABLED', false))
                            <li class="nav-item" wire:click="$set('screen','pharmacy')">
                                <a href="#" class="nav-link {{ $screen == 'pharmacy' ? 'active' : '' }}  ">
                                    {{ __('dispensing medicines') }}
                                </a>
                            </li>
                        @endif
                        <li class="nav-item" wire:click="$set('screen','review')">
                            <a href="#" class="nav-link {{ $screen == 'review' ? 'active' : '' }}">
                                مراجعة
                            </a>
                        </li>

                        <li class="nav-item" wire:click="$set('screen','scan')">
                            <a href="#" class="nav-link {{ $screen == 'scan' ? 'active' : '' }}  ">
                                الأشعة
                            </a>
                        </li>
                        <li class="nav-item" wire:click="$set('screen','lab')">
                            <a href="#" class="nav-link {{ $screen == 'lab' ? 'active' : '' }}  ">
                                المختبر
                            </a>
                        </li>

                    </ul>

                    <div class=" main-tab-content">
                        @include('doctor.interfaces.' . $screen)
                    </div>
                @endif
>>>>>>> 715298f1c137f5263c243d42ae7dc537397f1828
            @else
            <ul class="nav nav-pills main-nav-tap mb-3" style="flex-wrap: wrap !important;">
                <li class="nav-item" wire:click="$set('screen','current')">
                    <a href="#" class="nav-link {{ $screen == 'current' ? 'active' : '' }}">
                        {{ __('current diagnosis') }}
                    </a>
                </li>
                <li class="nav-item" wire:click="$set('screen','invoice')">
                    <a href="#" class="nav-link {{ $screen == 'invoice' ? 'active' : '' }}">
                        {{ __('Issuance of invoice') }}
                    </a>
                </li>
                <li class="nav-item" wire:click="$set('screen','data')">
                    <a href="#" class="nav-link {{ $screen == 'data' ? 'active' : '' }}">
                        {{ __('Patient data') }}
                    </a>
                </li>
                <li class="nav-item" wire:click="$set('screen','prev')">
                    <a href="#" class="nav-link  {{ $screen == 'prev' ? 'active' : '' }}">
                        {{ __('previous diagnoses') }}
                    </a>
                </li>
                <li class="nav-item" wire:click="$set('screen','trans')">
                    <a href="#" class="nav-link {{ $screen == 'trans' ? 'active' : '' }}  ">
                        {{ __('Transfer of the patient') }}
                    </a>
                </li>

                @if (env('PHARMACY_ENABLED', false))
                <li class="nav-item" wire:click="$set('screen','pharmacy')">
                    <a href="#" class="nav-link {{ $screen == 'pharmacy' ? 'active' : '' }}  ">
                        {{ __('dispensing medicines') }}
                    </a>
                </li>
                @endif
                <li class="nav-item" wire:click="$set('screen','review')">
                    <a href="#" class="nav-link {{ $screen == 'review' ? 'active' : '' }}">
                        مراجعة
                    </a>
                </li>

            </ul>

            <div class=" main-tab-content">
                @include('doctor.interfaces.' . $screen)
            </div>
            @endif
            @else
            <div class="alert alert-danger">{{ __('Please click on the patients name') }}</div>
            @endif

        </div>
    </div>
</div>
