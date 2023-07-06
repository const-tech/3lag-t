<div>


    <div class="modal fade" id="show{{ $diagnose->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> -->


                <div class="modal-body">
                    <div class="row row-gap-24">
                        <div class="col-12">
                            <label for="diagnosis" class="option-name mb-2">{{ __('admin.Diagnose') }}
                                :</label>
                            <textarea class="w-100 form-control" wire:model="taken" id="diagnosis">{{ $diagnose->taken }}</textarea>
                        </div>
                        <div class="col-12">
                            <label for="action-taken" class="option-name mb-2">{{ __('admin.Action taken') }} :</label>
                            <textarea class="w-100 form-control" wire:model="treatment" id="action-taken">{{ $diagnose->treatment }}</textarea>
                        </div>
                        @if ($diagnose->tooth)
                            <div class="col-12">
                                <label for="action-taken" class="option-name mb-2">{{ __('admin.Tooth') }}
                                    :</label>
                                <textarea class="w-100 form-control" wire:model="tooth" id="action-taken">
                                @if (is_array($diagnose->tooth))
@foreach ($diagnose->tooth as $tooth)
{{ $tooth . ',' }}
@endforeach
@else
{{ $diagnose->tooth }}
@endif
                            </textarea>
                            </div>
                        @endif
                        @if ($diagnose->body)
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="content-section p-3">
                                    <div class="header mb-3">
                                        <div class="row">
                                            <div class="col-6 px-0">
                                                <div class="right-side text-start">
                                                    <img src="{{ asset('img/human/right_side.png') }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-6 px-0">
                                                <div class="left-side">
                                                    <img src="{{ asset('img/human/left_side.png') }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="body">
                                        <div class="row">
                                            <div class="col-6 ">
                                                <div class="body-front text-start">
                                                    <img src="{{ asset('img/human/body-back.png') }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-6 ">
                                                <div class="body-back">
                                                    <img src="{{ asset('img/human/body-front.png') }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="line">
                                    <div class="inputs_holder d-flex aling-items-center gap-2 mb-2">


                                        @for ($i = 1; $i < 8; $i++)
                                            <div class="inp_holder text-center">
                                                <!-- <label for="" class="small-label">{{ $i }}</label> -->
                                                <input type="text"
                                                    value="{{ isset($diagnose->body[$i]) ? $diagnose->body[$i] : '' }}"
                                                    disabled class="inp-blue form-control">
                                            </div>
                                        @endfor

                                    </div>
                                    <div class="inputs_holder d-flex aling-items-center gap-2 mb-2">
                                        @for ($i = 8; $i < 15; $i++)
                                            <div class="inp_holder text-center">
                                                <!-- <label for="" class="small-label">{{ $i }}</label> -->
                                                <input type="text" disabled
                                                    value="{{ isset($diagnose->body[$i]) ? $diagnose->body[$i] : '' }}"
                                                    class="inp-blue form-control">
                                            </div>
                                        @endfor
                                    </div>
                                    <div class="inputs_holder d-flex aling-items-center gap-2 mb-2">
                                        @for ($i = 15; $i < 22; $i++)
                                            <div class="inp_holder text-center">
                                                <!-- <label for="" class="small-label">{{ $i }}</label> -->
                                                <input type="text" disabled
                                                    value="{{ isset($diagnose->body[$i]) ? $diagnose->body[$i] : '' }}"
                                                    class="inp-blue form-control">
                                            </div>
                                        @endfor
                                    </div>
                                    <div class="inputs_holder d-flex aling-items-center gap-2 mb-2">
                                        @for ($i = 22; $i < 29; $i++)
                                            <div class="inp_holder text-center">
                                                <!-- <label for="" class="small-label">{{ $i }}</label> -->
                                                <input type="text" disabled
                                                    value="{{ isset($diagnose->body[$i]) ? $diagnose->body[$i] : '' }}"
                                                    class="inp-blue form-control">
                                            </div>
                                        @endfor
                                    </div>

                                    <div class="inputs_holder d-flex aling-items-center gap-2 mb-2">
                                        @for ($i = 29; $i < 36; $i++)
                                            <div class="inp_holder text-center">
                                                <!-- <label for="" class="small-label">{{ $i }}</label> -->
                                                <input type="text" disabled
                                                    value="{{ isset($diagnose->body[$i]) ? $diagnose->body[$i] : '' }}"
                                                    class="inp-blue form-control">
                                            </div>
                                        @endfor
                                    </div>

                                    <div class="inputs_holder d-flex aling-items-center gap-2 mb-2">
                                        @for ($i = 36; $i < 39; $i++)
                                            <div class="inp_holder text-center">
                                                <!-- <label for="" class="small-label">{{ $i }}</label> -->
                                                <input type="text" disabled
                                                    value="{{ isset($diagnose->body[$i]) ? $diagnose->body[$i] : '' }}"
                                                    class="inp-blue form-control">
                                            </div>
                                        @endfor
                                    </div>

                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger"
                        data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                    <button class="btn btn-sm   btn-success" data-bs-dismiss="modal"
                        wire:click='saveDiagnose'>حفظ</button>
                </div>

            </div>

        </div>
    </div>

</div>
