<div class="table-responsive">
    <table class="table main-table">
        <tr>
            <td>#</td>
            <td>{{ __('Date')}}</td>
            <td>{{ __('service')}}</td>
            <td>{{ __('employee')}}</td>
            <td>{{ __('results')}}</td>
            <td></td>
        </tr>
        @forelse($labRequests as $request)
        <tr>
            <td>{{$loop->iteration}}</td>
            {{-- <td>{{__('status.'.$request->status)}}</td>
            <td>{{$request->delivered_at ?? "لم يحدد"}}</td> --}}
            <td>{{$request->created_at->format('Y-m-d')}}</td>
            <td>{{$request->product->name}}</td>
            <td>{{ $request->doctor->name }}</td>
            <td>@if (!empty($request->file))
                <button type="button" class="btn btn-purple btn-sm ml-2" data-toggle="modal"
                    data-target="#exampleModal_show_{{ $request->id }}">
                    <i class="fa-solid fa-eye"></i>
                </button>
                @endif
            </td>
            <td>
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            @if (empty($request->file))
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal_{{ $request->id }}">
                                <i class="fa-solid fa-file-circle-plus"></i>
                            </button>
                            @endif
                            <div class="card">
                                <div class="card-body">
                                    {{-- edit model start here --}}
                                    <div wire:ignore.self class="modal fade" id="exampleModal_{{ $request->id }}"
                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <x-alert></x-alert>
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel_{{ $request->id }}">
                                                        اضافة مرفق
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true close-btn">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="fild-control mt-1">
                                                        <label for="file">اضافة مرفق</label>
                                                        <input type="file" class="form-control" name="file" id="file"
                                                            wire:model.lazy="lab_file">
                                                    </div>
                                                    <div class="fild-control mt-1">
                                                        <label for="dr_content">رسالة الفني المختص</label>
                                                        <textarea class="form-control border-1 table-bordered"
                                                            name="dr_content" id="dr_content" rows="3"
                                                            wire:model.lazy="lab_dr_content"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary close-btn"
                                                        data-dismiss="modal">اغلاق</button>
                                                    <button type="submit" wire:click.prevent="storeFileLab({{ $request }})"
                                                        class="btn btn-primary close-modal" data-dismiss="modal">{{ __('Save')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- edit model end here --}}
                                    {{-- show model start here --}}
                                    <div wire:ignore.self class="modal fade" id="exampleModal_show_{{ $request->id }}"
                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <x-alert></x-alert>
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel_{{ $request->id }}">
                                                        عرض مرفق
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true close-btn">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                        <a href="{{ asset('uploads/'.$request->file) }}" download="">
                                                            <img src="{{ asset('uploads/'.$request->file) }}"
                                                                class="w-100 h-100" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="fild-control mt-2">
                                                        <label for="dr_content">رسالة الفني المختص</label>
                                                        {{ $request->lab_content }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- show model end here --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <button class="btn btn-primary btn-sm">
                </button> --}}

            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">{{ __('There are no requests')}}</td>
        </tr>
        @endforelse
    </table>
    {{ $labRequests->links() }}
</div>
