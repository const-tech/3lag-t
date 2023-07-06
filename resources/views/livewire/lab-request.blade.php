<section class="main-section users">
    <x-alert></x-alert>

    <div class="container" id="data-table">
        @if($screen=='index')
        <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
            <h4 class="main-heading mb-0">{{ __('Lap Requests')}}</h4>
        </div>
        <div class="bg-white shadow p-4 rounded-3">
            <div
                class="amountPatients-holder d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
                <div class="btn-holders mb-2">
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
                                @lab
                                <th class="text-center not-print">{{ __('admin.managers') }}</th>
                                @endlab
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
                                <td class="not-print">
                                    @lab
                                    @if($request->status=='pending')
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <button class="btn btn-sm btn-danger mx-1 py-1" wire:click="show({{ $request }})">
                                            {{ __('Lab Order')}}
                                        </button>
                                    </div>
                                    @endif
                                    @endlab
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
        @include('lab.requests.show')
        @endif
    </div>
</section>
