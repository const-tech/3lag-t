<section class="main-section py-5">
    @if($screen == 'create')
    <div class=" container">
        {{-- appointments table @dd($user) --}}
        <h4 class="main-heading mb-3">طلبات الاستئذان</h4>

        <div class="bg-white p-4 rounded-2 shadow">
            {{-- <form action="{{ route('front.profile.vacation.store') }}" method="post" enctype="multipart/form-data"> --}}
            {{-- @csrf --}}
            <x-message-admin></x-message-admin>
            <div class="row g-3">
                <div class="col-12 col-md-4 col-lg-3">
                    <label for="" class="small-label mb-2">تاريخ الاستئذان</label>
                    <input type="date" value="" wire:model.defer="date" class="form-control">
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <label for="" class="small-label">الصوره </label>
                    <input type="file" class="form-control modal-title" wire:model.defer='attachment' accept="image/jpeg,image/jpg,image/png">
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <label for="" class="small-label">وقت الاستئذان</label>
                    <select wire:model="duration" id="duration" class="form-control w-100">
                        <option value="0">وقت الاستئذان</option>

                        <option value="day">كامل الدوام</option>
                        <option value="part">جزء من الدوام</option>

                    </select>
                </div>
                @if($duration == 'part')
                <div class="col-12 col-md-4 col-lg-3">
                    <label for="" class="small-label mb-2">الوقت بالساعة</label>
                    <input type="number" wire:model.defer="duration_time" class="form-control">
                </div>
                @endif
                <div class="col-12 col-md-12 m-0">
                    <hr class="m-0 border-0 bg-transparent">
                </div>
                <div class="col-12 col-lg-6">
                    <label for="" class="small-label">سبب الاستئذان</label>
                    <textarea wire:model.defer="reason" class="form-control" id="" rows="5"></textarea>
                </div>
                <div class="col-12 col-md-12 m-0">
                    <hr class="m-0 border-0 bg-transparent">
                </div>
                <div class="col-12 col-md-12">
                    <button wire:click="submit" type="button" class="btn btn-sm btn-success px-4">{{ __('send') }}</button>
                </div>
            </div>
            {{-- </form> --}}

        </div>
    </div>
    @else
    <div class="container">
        <div>
            <button wire:click='$set("screen","create")' class="btn btn-primary btn-sm">إضافة</button>
        </div>
        <div class="table-responsive">
            <table class="table main-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('admin.Date') }}</th>
                        <th>{{ __('vacations.duration') }}</th>
                        <th>{{ __('admin.reason') }}</th>
                        <th>{{ __('admin.status') }}</th>
                        <th>{{ __('vacations.status_reason') }}</th>
                        <th>{{ __('admin.file') }}</th>
                        <th>{{ __('vacations.created') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vacations as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->date->format('Y/m/d') }}</td>
                        <td>@lang('vacations.' . $item->duration) {{ $item->duration == 'part' ? (' - ' . $item->duration_time . ' ساعات') : ''  }}</td>
                        <td>{{ $item->reason }}</td>
                        <td>@lang('vacations.' .$item->status)</td>
                        <td>{{ $item->status_reason ?? '--' }}</td>
                        <td>
                            @if($item->attachment)
                            <img src="{{ display_file($item->attachment) }}" style="width: 150px" alt="">
                            @else
                            --
                            @endif
                        </td>
                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</section>
