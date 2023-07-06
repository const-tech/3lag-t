<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class DoctorHome extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function confirm($id)
    {
        $appointment = \App\Models\Appointment::find($id);
        $appointment->appointment_status = 'confirmed';
        $appointment->save();
    }
    // cancel appointment status by id
    public function cancel($id)
    {
        $appointment = \App\Models\Appointment::find($id);
        $appointment->appointment_status = 'cancelled';
        $appointment->save();
    }
    public function render()
    {
        $appoints=doctor()->appointments()->today()->with('patient')->paginate(10);
        return view('livewire.doctor-home',compact('appoints'));
    }
}
