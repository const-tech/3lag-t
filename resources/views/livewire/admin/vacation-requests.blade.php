<section class="main-section users">
    <x-alert></x-alert>
    <div class="container">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-light p-3">
                <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Vacation Requests')}}</li>
            </ol>
        </nav>
        <div class="bg-white rounded-3 shadow p-3">
            <div class="d-flex align-items-center flex-wrap gap-2 mt-3  mb-3">
                {{-- <div class="row"> --}}
                {{-- <div class="col-md-4"> --}}
                <div class="form-group">
                    <label for="">@lang('admin.from')</label>
                    <input type="date" wire:model='from' class="form-control">
                </div>
                <div class="form-group">
                    <label for="">@lang('admin.to')</label>
                    <input type="date" wire:model='to' class="form-control">
                </div>
                <div class="form-group">
                    <label for="">@lang('admin.User')</label>
                    <input type="text" wire:model='username' class="form-control">
                </div>
                <div class="form-group">
                    <label for="">@lang('admin.User')</label>
                    <select class="form-control" wire:model="filter_user_id" id="">
                        <option value="">الكل</option>
                        @foreach (App\Models\User::where('type','<>','admin')->get() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} -- {{ $user->vacationRequests->count() }} طلب</option>
                            @endforeach
                    </select>
                </div>
                {{-- </div> --}}
                {{-- </div> --}}
            </div>
            <div class="table-responsive">
                <table class="table table-hover" id="prt-content">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin.Date') }}</th>
                            <th>{{ __('admin.User') }}</th>
                            <th>{{ __('vacations.duration') }}</th>
                            <th>{{ __('admin.reason') }}</th>
                            <th>{{ __('admin.status') }}</th>
                            <th>{{ __('vacations.status_reason') }}</th>
                            <th>{{ __('admin.file') }}</th>
                            <th>{{ __('admin.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vacations as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->date->format('Y/m/d') }}</td>
                            <td>{{ $item->user?->name }}</td>
                            <td>@lang('vacations.' . $item->duration) {{ $item->duration == 'part' ? (' - ' . $item->duration_time . ' ساعات') : ''  }}</td>
                            <td>{{ $item->reason }}</td>
                            <td>@lang('vacations.' .$item->status)</td>
                            <td>{{ $item->status_reason }}</td>
                            <td>
                                @if($item->attachment)
                                <img src="{{ display_file($item->attachment) }}" style="width: 150px" alt="">
                                @else
                                --
                                @endif
                            </td>
                            <td>
                                @if($item->status == 'new')
                                <button class="btn btn-success btn-sm" wire:click='accept({{ $item->id }})'>موافقة</button>
                                <a data-bs-toggle="modal" data-bs-target="#reject{{ $item->id }}" class="btn btn-sm btn-danger">رفض</a>
                                <div class="modal fade" id="reject{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">



                                            <div class="modal-body">
                                                {{ __('admin.are sure of the deleting process?') }}
                                            </div>
                                            <div class="form-group p-3">
                                                <label for="">سبب الرفض</label>
                                                <textarea wire:model.defer="status_reason_input" class="form-control" id="" cols="10" rows="5"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                                                <button class="btn btn-sm  btn-success" data-bs-dismiss="modal" wire:click='reject({{ $item->id }})'>{{ __('admin.Yes') }}</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $vacations->links() }}
            </div>
        </div>
    </div>
</section>
@push('css')
@livewireStyles()
@endpush
@push('js')
@livewireScripts
@endpush
