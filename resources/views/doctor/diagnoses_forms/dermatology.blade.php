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
                    <input type="text" wire:model.defer="diagnosis.body.{{ $i }}"
                        class="inp-blue form-control">
                </div>
            @endfor

        </div>
        <div class="inputs_holder d-flex aling-items-center gap-2 mb-2">
            @for ($i = 8; $i < 15; $i++)
                <div class="inp_holder text-center">
                    <input type="text" wire:model.defer="diagnosis.body.{{ $i }}"
                        class="inp-blue form-control">
                </div>
            @endfor
        </div>
        <div class="inputs_holder d-flex aling-items-center gap-2 mb-2">
            @for ($i = 15; $i < 22; $i++)
                <div class="inp_holder text-center">
                    <input type="text" wire:model.defer="diagnosis.body.{{ $i }}"
                        class="inp-blue form-control">
                </div>
            @endfor
        </div>
        <div class="inputs_holder d-flex aling-items-center gap-2 mb-2">
            @for ($i = 22; $i < 29; $i++)
                <div class="inp_holder text-center">
                    <input type="text" wire:model.defer="diagnosis.body.{{ $i }}"
                        class="inp-blue form-control">
                </div>
            @endfor
        </div>
        <div class="inputs_holder d-flex aling-items-center gap-2 mb-2">
            @for ($i = 29; $i < 36; $i++)
                <div class="inp_holder text-center">
                    <input type="text" wire:model.defer="diagnosis.body.{{ $i }}"
                        class="inp-blue form-control">
                </div>
            @endfor
        </div>
        <div class="inputs_holder d-flex aling-items-center gap-2 mb-2">
            @for ($i = 36; $i < 39; $i++)
                <div class="inp_holder text-center">
                    <input type="text" wire:model.defer="diagnosis.body.{{ $i }}"
                        class="inp-blue form-control">
                </div>
            @endfor
        </div>
    </div>
</div>
