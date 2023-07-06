<section class="table-color main-section py-5">
    <div class="container">
        <div class="section-content bg-white shadow p-4 rounded-3">
            <div class="row g-2 mb-3">
                <div class="col-12 d-flex align-items-center">
                    <div class="status d-flex align-items-end flex-wrap gap-1">
                        <div class="box d-flex ms-2 align-content-center align-items-center">
                            <div class="color one ms-1"></div>
                            <div class="text"><b>{{ __('Available') }}:</b> {{ $availableTimes }}</div>
                        </div>
                        <div class="box d-flex ms-2 align-content-center align-items-center">
                            <div class="color two ms-1"></div>
                            <div class="text"><b>{{ __('Reserved') }}:</b>
                                {{ $appointments->where('appointment_status', 'confirmed')->count() }}</div>
                        </div>
                        <div class="box d-flex ms-2 align-content-center align-items-center">
                            <div class="color three ms-1"></div>
                            <div class="text"><b>{{ __('Present') }}:</b>
                                {{ $appointments->where('appointment_status', 'pending')->count() }}</div>
                        </div>
                        <div class="box d-flex ms-2 align-content-center align-items-center">
                            <div class="color six ms-1"></div>
                            <div class="text"><b>{{ __('Converters') }}:</b>
                                {{ $appointments->where('appointment_status', 'transferred')->count() }}</div>
                        </div>
                        <div class="box d-flex ms-2 align-content-center align-items-center">
                            <div class="color five ms-1"></div>
                            <div class="text"><b> {{ __('Attended') }}:</b>
                                {{ $appointments->where('appointment_status', 'examined')->count() }}</div>
                        </div>
                        <div class="box d-flex align-content-center align-items-center">
                            <div class="color four ms-1"></div>
                            <div class="text"><b>{{ __('did not attend') }}:</b>
                                {{ $appointments->where('appointment_status', 'cancelled')->count() }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="d-flex flex-wrap flex-sm-nowrap align-items-center gap-4">
                        <div dir="ltr" class="input-group">
                            <select wire:model="department_id" class="form-control">
                                <option value="">{{ __('Choose department') }}</option>
                                @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            <span class="input-group-text" style="font-size: .8rem;" id="basic-addon2">{{ __('Choose department') }}</span>
                        </div>
                        <div dir="ltr" class="input-group">
                            <select wire:model="doctor_id" class="form-control">
                                <option value="">{{ __('Choose doctor') }}</option>
                                @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                            <span class="input-group-text" style="font-size: .8rem;" id="basic-addon2">{{ __('Choose doctor') }}</span>
                        </div>
                        <div dir="ltr" class="input-group">
                            <input dir="rtl" type="date" class="form-control" wire:model="from">
                            <span class="input-group-text" style="font-size: .8rem;" id="basic-addon2">{{ __('from') }}</span>
                        </div>
                        <div dir="ltr" class="input-group">
                            <input dir="rtl" type="date" class="form-control" wire:model="to">
                            <span class="input-group-text" style="font-size: .8rem;" id="basic-addon2">{{ __('to') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-1">
                    <div>
                        <select name="" id="" class="form-control" wire:model="appointment_duration">
                            <option value="" disabled selected>{{ __('Choose Period') }}</option>
                            <option value="morning">{{ __('morning') }}</option>
                            @if(setting()->evening_status)
                            <option value="evening">{{ __('evening') }}</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>



            <div class="row mb-3">
                <div class="col-4 col-lg-2">
                    <table class="table main-table special-table">
                        <thead>
                            <th class="text-center">{{ __('waiting area') }}</th>
                        </thead>
                        <tbody>
                            @forelse($currentAppointments as $appointment)
                            <tr>
                                <td class="text-center bg-orange">
                                    <b>{{ $appointment->patient?->name }}</b>
                                    <br>
                                    <b>الوقت: {{ $appointment->appointment_time }}</b>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center">
                                    <b>{{ __('there is no') }}</b>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <style>
                    .table-color .bg-warning {
                        background-color: #ffc107 !important;
                    }

                </style>
                <div class="col-8 col-lg-10">
                    <div class="table-responsive">
                        <table class="table main-table special-table">
                            <thead>
                                {{-- عرض التاريخ واليوم --}}
                                <tr>


                                    <th scope="col">
                                        <div class="top_word text-center"></div>
                                        <div class="bottom_word text-center"></div>
                                    </th>


                                    @php
                                    $start_of_week = \Carbon\Carbon::now()
                                    ->startOfWeek()
                                    ->isoFormat('Y-MM-DD');

                                    $count_days = 0;

                                    if ($from && !$to) {
                                    $timestamp = strtotime($from);

                                    $count_days = (int) date('t', $timestamp) - (int) date('j', $timestamp) + 1;
                                    } elseif ($from && $to) {
                                    $start = \Carbon\Carbon::parse($from);
                                    $end = \Carbon\Carbon::parse($to);

                                    $count_days = $end->diffInDays($start) + 1;
                                    } else {
                                    $count_days = 7;
                                    }

                                    @endphp

                                    @for ($i = 0; $i < $count_days; $i++) <th scope="col">
                                        <div class="top_word text-center">
                                            {{ $from ? date('l', strtotime($from . ' +' . $i . 'day')) : date('l', strtotime($start_of_week . ' +' . $i . 'day')) }}
                                        </div>
                                        <div class="bottom_word text-center text-center">
                                            {{ $from ? date('Y-m-d', strtotime($from . ' +' . $i . 'day')) : date('Y-m-d', strtotime($start_of_week . ' +' . $i . 'day')) }}
                                        </div>
                                        </th>
                                        @endfor


                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{ var_export($from) }} --}}
                                {{-- عرض الوقت والمواعيد --}}
                                @foreach ($times as $time)
                                <tr class="fw-bolder">
                                    {{-- عرض الوقت --}}
                                    <td class="text-center text-black">
                                        <div class="top_word text-center">{{ date('H:iA', strtotime($time)) }}
                                        </div>
                                        <div class="bottom_word text-center">
                                            {{ date('H:iA', strtotime($time . ' +30 minute')) }}</div>
                                    </td>

                                    {{-- عرض المواعيد ان وجد وتعتمد  على عدد الايام --}}
                                    @for ($i = 0; $i < $count_days; $i++) @php $fromTime=date('H:i', strtotime($time)); $toTime=date('H:i', strtotime($time . '+29 minute' )); $appointment=$appointments ->whereBetween('appointment_time', [$fromTime, $toTime])
                                        ->where('appointment_date', $from ? date('Y-m-d', strtotime($from . ' +' . $i . ' day')) : date('Y-m-d', strtotime($start_of_week . '+' . $i . 'day')))
                                        ->first();

                                        $bg_class = '';

                                        if ($appointment) {
                                        switch ($appointment->appointment_status) {
                                        case 'pending':
                                        $bg_class = 'bg-warning';
                                        break;
                                        case 'confirmed':
                                        $bg_class = 'bg-success';
                                        break;
                                        case 'cancelled':
                                        $bg_class = 'bg-danger';
                                        break;
                                        case 'transferred':
                                        $bg_class = 'bg-dark';
                                        break;
                                        case 'examined':
                                        $bg_class = 'bg-primary';
                                        break;
                                        }
                                        }
                                        @endphp
                                        @if ($appointment)
                                        <td scope="row" class="text-center {{ $bg_class }}">
                                            <p class="mb-0 text-white"> {{ $appointment->patient?->name }}</p>

                                            <p class="mb-0 text-white">{{ __('Clinic') }}:
                                                {{ $appointment?->clinic?->name }}</p>

                                            <p class="mb-0 text-white">{{ __('the Doctor') }}:
                                                {{ $appointment?->doctor?->name }}<br></p>
                                            <div class="toltip-table">


                                                <a href="{{ route('front.appointments.edit', $appointment->id) }}" class="btn btn-sm btn-primary mt-2 w-fit d-block mx-auto">تعديل</a>
                                            </div>
                                        </td>
                                        @else
                                        <td scope="row" class="text-center">
                                            <div class="toltip-table">
                                                <a href="{{ route('front.appointments.create', [
                                                            'appointment_duration ' => $appointment_duration,
                                                            'appointment_date' => date('Y-m-d', strtotime($from . ' +' . $i . ' day')),
                                                            'appointment_time' => $time,
                                                        ]) }}" class="btn btn-sm btn-success px-4  w-fit d-block mx-auto">
                                                    إضافة
                                                </a>
                                            </div>
                                        </td>
                                        @endif
                                        @endfor

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
