 <section class="p-3 row">
    <section class="form-group col-12 col-md-6 col-lg-3 mb-3 {{ setting()->complaint?'':'d-none' }}">
        <label for="exampleFormControlTextarea1" class="mb-2">الشكوى</label>
        <textarea class="form-control"  rows="3" wire:model.defer="diagnosis.complaint"></textarea>
    </section>
    <section class="form-group col-12 col-md-6 col-lg-3 mb-3 {{ setting()->complaint?'':'d-none' }}">
        <label for="exampleFormControlTextarea1" class="mb-2">الكشف السريري</label>
        <textarea class="form-control" rows="3" wire:model.defer="diagnosis.clinical_examination"></textarea>
    </section>
    <section class="form-group col-12 col-md-6 col-lg-3 mb-3">
        <label for="exampleFormControlTextarea1" class="mb-2">{{ __('Chief complain')}}</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" wire:model.defer="diagnosis.chief_complain"></textarea>
    </section>
    <section class="form-group col-12 col-md-6 col-lg-3 mb-3">
        <label for="exampleFormControlTextarea1" class="mb-2">{{ __('Sign and symptom')}}</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" wire:model.defer="diagnosis.sign_and_symptom"></textarea>
    </section>
    <section class="form-group col-12 col-md-6 col-lg-3 mb-3">
        <label for="exampleFormControlTextarea1" class="mb-2">{{ __('Other')}}</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" wire:model.defer="diagnosis.other"></textarea>
    </section>
     <section class="form-group col-12 col-md-6 col-lg-3 mb-3">
         <label for="exampleFormControlTextarea1" class="mb-2">{{ __('Diagnose')}}</label>
         <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" wire:model.defer="diagnosis.taken"></textarea>
     </section>
     {{-- treatment --}}
     <section class="form-group col-12 col-md-6 col-lg-3 my-3">
         <label for="exampleFormControlTextarea1" class="mb-2">{{ __('Action taken')}}</label>
         <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" wire:model.defer="diagnosis.treatment"></textarea>
     </section>
     {{-- tooth --}}
     @if (doctor()->is_dentist)

         <section class="num-teeth">
             <div class="toothArray content ">
                 <img class="img-teeth" src="{{ asset('img/num.png') }}" alt="" />
                 @for ($i = 18; $i >= 11; $i--)
                     <input type="checkbox" wire:model.defer="diagnosis.tooth" id=""
                         value="{{ $i }}">
                 @endfor

                 @for ($i = 21; $i <= 28; $i++)
                     <input type="checkbox" wire:model.defer="diagnosis.tooth" id=""
                         value="{{ $i }}">
                 @endfor

                 @for ($i = 38; $i >= 31; $i--)
                     <input type="checkbox" wire:model.defer="diagnosis.tooth" id=""
                         value="{{ $i }}">
                 @endfor

                 @for ($i = 41; $i <= 48; $i++)
                     <input type="checkbox" wire:model.defer="diagnosis.tooth" id=""
                         value="{{ $i }}">
                 @endfor

         </section>
     @endif
     @if (doctor()->is_dermatologist)
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
     @endif

     {{-- period select morning or evening --}}
     <section class="form-group my-3">
         <button class="btn btn-success mt-3 w-25" wire:click="saveDiagnose">
             {{ __('Save')}}
         </button>
     </section>
 </section>
