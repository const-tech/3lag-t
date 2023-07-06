<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\User;
use Livewire\Component;

class Appointments extends Component
{
    public $date, $dr, $period, $department, $transferred, $search;
    public function mount($transferred = false)
    {
        $this->transferred = $transferred;
    }
    public function render()
    {
        $appoints = Appointment::where(function ($q) {
            if ($this->date) {
                $q->where('appointment_date', $this->date);
            }
            if ($this->dr) {
                $q->where('doctor_id', $this->dr);
            }
            if ($this->period) {
                $q->where('appointment_duration', $this->period);
            }
            if ($this->department) {
                $q->where('clinic_id', $this->department);
            }
            if ($this->search) {
                $q->whereHas('patient', function ($q) {
                    $q->where('first_name', 'like', '%' . $this->search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->search . '%')
                        ->orWhere('phone', 'like', '%' . $this->search . '%')
                        ->orWhere('civil', 'like', '%' . $this->search . '%')
                        ->orWhere('id', '=', $this->search);
                });
            }
            if ($this->transferred) {
                $q->Transferred();
            }
            if (request('today')) {
                $q->today();
            }
        })->latest()->paginate(10);
        $departments = Department::all();
        $doctors = User::doctors()->where('department_id', $this->department)->get();
        return view('livewire.appointments', compact('appoints', 'departments', 'doctors'));
    }
    public function resetAll()
    {
        $this->reset('date', 'dr', 'period', 'department');
    }
}
