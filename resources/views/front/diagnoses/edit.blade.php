<div class="modal fade" id="edit{{ $diagnose->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog ">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> -->


            <div class="modal-body">
                <div class="row row-gap-24">
                    <div class="col-12">
                        <label for="diagnosis" class="option-name mb-2">{{ __('Chief complain') }} :</label>
                        <textarea  wire:model.defer='chief_complain' class="w-100 form-control" id="diagnosis">{{ $diagnose->chief_complain }}</textarea>
                    </div>
                    <div class="col-12">
                        <label for="diagnosis" class="option-name mb-2">{{ __('Sign and symptom') }} :</label>
                        <textarea wire:model.defer='sign_and_symptom'  class="w-100 form-control" id="diagnosis">{{ $diagnose->sign_and_symptom }}</textarea>
                    </div>
                    <div class="col-12">
                        <label for="diagnosis" class="option-name mb-2">{{ __('Other') }} :</label>
                        <textarea wire:model.defer='other'  class="w-100 form-control" id="diagnosis">{{ $diagnose->other }}</textarea>
                    </div>
                    <div class="col-12">
                        <label for="diagnosis" class="option-name mb-2">{{ __('admin.Diagnose') }} :</label>
                        <textarea wire:model.defer='treatment' class="w-100 form-control" id="diagnosis">{{ $diagnose->treatment }}</textarea>
                    </div>
                    <div class="col-12">
                        <label for="action-taken" class="option-name mb-2">{{ __('admin.Action taken') }} :</label>
                        <textarea wire:model.defer='taken' class="w-100 form-control" id="action-taken">{{ $diagnose->taken }}</textarea>
                    </div>
                    @if($tooth)
                     <section class="num-teeth">
                        <div class="toothArray content ">
                            <img class="img-teeth" src="{{ asset('img/num.png') }}" alt="" />
                            @for ($i=18 ; $i>=11 ; $i--)
                            <input type="checkbox" wire:model.defer="tooth" id="" value="{{ $i }}">
                            @endfor

                            @for ($i=21 ; $i<= 28 ; $i++)
                            <input type="checkbox" wire:model.defer="tooth" id="" value="{{ $i }}">
                            @endfor

                            @for ($i=38 ; $i>= 31 ; $i--)
                            <input type="checkbox" wire:model.defer="tooth" id="" value="{{ $i }}">
                            @endfor

                            @for ($i=41 ; $i<= 48 ; $i++)
                            <input type="checkbox" wire:model.defer="tooth" id="" value="{{ $i }}">
                            @endfor

                    </section> 
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                <button class="btn btn-sm   btn-success" data-bs-dismiss="modal" wire:click='save'>{{ __('admin.Update') }}</button>
            </div>

        </div>

    </div>
</div>
