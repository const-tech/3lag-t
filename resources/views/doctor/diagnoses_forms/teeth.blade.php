<section class="num-teeth">
    <div class="toothArray content ">
        <img class="img-teeth" src="{{ asset('img/num.png') }}" alt="" />
        @for ($i = 18; $i >= 11; $i--)
            <input type="checkbox" wire:model.defer="diagnosis.tooth" id="" value="{{ $i }}">
        @endfor

        @for ($i = 21; $i <= 28; $i++)
            <input type="checkbox" wire:model.defer="diagnosis.tooth" id="" value="{{ $i }}">
        @endfor

        @for ($i = 38; $i >= 31; $i--)
            <input type="checkbox" wire:model.defer="diagnosis.tooth" id="" value="{{ $i }}">
        @endfor

        @for ($i = 41; $i <= 48; $i++)
            <input type="checkbox" wire:model.defer="diagnosis.tooth" id="" value="{{ $i }}">
        @endfor

</section>
