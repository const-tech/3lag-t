<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectDoctorForTransfer extends Component
{
    public $doctor_id;
    public $clinic_id;
    public $waiting;
    public function render()
    {
        return view('livewire.select-doctor-for-transfer');
    }
    public function updatedDoctorId()
    {
        $this->waiting = \App\Models\Appointment::where('doctor_id', $this->doctor_id)
            ->waiting()
            ->count() + 1;
    }
}
