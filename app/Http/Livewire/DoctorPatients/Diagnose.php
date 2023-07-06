<?php

namespace App\Http\Livewire\DoctorPatients;

use Livewire\Component;

class Diagnose extends Component
{
    public $diagnose, $treatment, $taken, $tooth = [];

    public function render()
    {
        return view('livewire.doctor-patients.diagnose');
    }

    public function mount()
    {
        $this->treatment = $this->diagnose->treatment;
        $this->taken = $this->diagnose->taken;
        $this->tooth = $this->diagnose->tooth;
    }

    public function saveDiagnose()
    {
        $this->validate([
            'treatment' => 'required',
            'taken' => 'required',
            'tooth' => 'required',
        ]);

        $this->diagnose->update([
            'treatment' => $this->treatment,
            'taken' => $this->taken,
            'tooth' => $this->tooth,
        ]);

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully updated')]);
    }
}
