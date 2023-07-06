<section class="main-section users">
    <x-alert></x-alert>

    <div class="container" id="data-table">
        @if($screen=='index')
        <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
            <h4 class="main-heading mb-0">{{ __('Radiology Requests')}}</h4>
        </div>
        <div class="bg-white shadow p-4 rounded-3">
            <div
                class="amountPatients-holder mb-2 d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
                <div class="btn-holders">
                    <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning py-1">
                        <i class="fa-solid fa-print"></i>
                    </button>
                </div>
            </div>

            <div class="">

                <div class="table-responsive">
                    <table id="prt-content" class="table main-table">
                        <thead>
                            <tr>
                                <th>{{ __('patient')}}</th>
                                <th>{{ __('the Doctor')}}</th>
                                <th>{{ __('section')}}</th>
                                <th>{{ __('service')}}</th>
                                <th>{{ __('admin.Status')}}</th>
                                <th>{{ __('Radiation Survey Date')}}</th>
                                <th>{{ __('Date of delivery of radiation')}}</th>
                                @scan
                                <th class="text-center not-print">{{ __('admin.managers') }}</th>
                                @endscan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $request)
                            <tr>
                                <td>{{ $request->patient?->name }}</td>
                                <td>{{ $request->doctor?->name }}</td>
                                <td>{{ $request->clinic?->name }}</td>
                                <td>{{ $request->product?->name }}</td>
                                <td>{{ __($request->status) }}</td>
                                <td>{{ $request->scanned_at }}</td>
                                <td>{{ $request->delivered_at }}</td>
                                <td class="not-print">
                                    @scan
                                    @if($request->status=='pending')
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <button class="btn btn-sm btn-danger mx-1 py-1" wire:click="show({{ $request }})">
                                            {{ __('Request Radiation')}}
                                        </button>
                                    </div>
                                    @endif
                                    @endscan
                                    @if($request->file)
                                    <a target="_blank" href="{{ display_file($request->file) }}">المرفق</a>
                                    @endif
                                    <button class="btn btn-sm btn-danger"  data-bs-toggle="modal"
                                    data-bs-target="#delete_agent{{ $request->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                    @include('front.requests.delete')
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                {{ $requests->links() }}
            </div>
        </div>
        @else
        @include('scan.requests.show')
        @endif
    </div>
</section>
