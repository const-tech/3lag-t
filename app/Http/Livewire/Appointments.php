<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Department;
use App\Models\Appointment;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Appointments extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $date, $dr, $period, $department, $transferred, $search, $appointment_status, $note;
    public $transfer_mode = false, $trans_patient, $waiting, $clinic_id, $doctor_id, $appointment_duration;
    public function mount($transferred = false)
    {
        $this->transferred = $transferred;
    }
    public function presence(Appointment $appointment)
    {
        $appointment->update(['attended_at' => now()]);
    }
    public function notPresence(Appointment $appointment)
    {
        $appointment->update(['appointment_status' => 'cancelled']);
    }
    public function render()
    {
        $this->waiting = Appointment::where('doctor_id', $this->doctor_id)
            ->Transferred()
            ->count() + 1;
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
            if ($this->appointment_status) {
                if ($this->appointment_status == 'review') {
                    $q->where('review', true);
                } else {
                    $q->where('appointment_status', $this->appointment_status);
                }
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
        })->orderBy('appointment_status', 'asc')->latest()->paginate(10);
        $departments = Department::all();
        $doctors = User::doctors()->where('department_id', $this->department)->get();
        return view('livewire.appointments', compact('appoints', 'departments', 'doctors'));
    }
    public function resetAll()
    {
        $this->reset('date', 'dr', 'period', 'department');
    }

    public function setNoteValue(Appointment $appointment)
    {
        $this->note = $appointment->notes;
    }
    public function saveNote(Appointment $appointment)
    {
        $appointment->update(['notes' => $this->note]);
        // $this->reset(['note']);
    }

    public function transfer(Patient $patient)
    {
        $this->trans_patient = null;
        if (!$patient->has_appoint_trans) {
            $this->trans_patient = $patient;
            $this->emit('trans_modal');
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('The patient is already transferred')]);
        }
    }
    public function submit_transfer($print = null)
    {

        $data = $this->validate([
            'doctor_id' => 'required',
            'appointment_duration' => 'required',
            'clinic_id' => 'required',
        ]);

        $data['patient_id'] = $this->trans_patient->id;
        $data['employee_id'] = auth()->id();
        $data['appointment_number'] = Str::random(10);
        $data['appointment_status'] = 'transferred';
        $data['appointment_status'] = 'transferred';
        $data['appointment_time'] = date('H:i');
        $data['appointment_date'] = date('Y-m-d');
        $appoint = Appointment::create($data);
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('The patient has been successfully transferred')]);
        if ($print) {
            return redirect()->route('front.appointment.print-transfer', ['appointment' => $appoint, 'waiting' => $this->waiting]);
        }
        $this->reset();

    }
}
