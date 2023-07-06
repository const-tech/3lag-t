<?php

namespace App\Http\Livewire\DoctorPatients;

use App\Models\Patient;
use Livewire\Component;
use App\Models\Appointment;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Patients extends Component
{
    public $civil, $patient_id, $phone, $first_name, $doctor_id, $clinic_id, $appointment_duration, $transfer_mode = false;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected function rules()
    {
        return [
            'doctor_id' => 'required',
            'appointment_duration' => 'required',
            'clinic_id' => 'required',
        ];
    }
    public function transfer(Patient $patient)
    {
        if (!$patient->has_appoint_trans) {
            $data = $this->validate();
            $data['patient_id'] = $patient->id;
            $data['employee_id'] = auth()->id();
            $data['appointment_number'] = Str::random(10);
            $data['appointment_status'] = 'transferred';
            $data['appointment_status'] = 'transferred';
            $data['appointment_time'] = date('H:i');
            $data['appointment_date'] = date('Y-m-d');
            Appointment::create($data);
            $this->reset();
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('The patient has been successfully transferred')]);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('The patient is already transferred')]);
        }
    }
    public function delete(Patient $patient)
    {
        if ($patient->image) {
            delete_file($patient->image);
        }

        $patient->invoices()->delete();
        $patient->diagnoses()->delete();
        $patient->files()->delete();
        $patient->appointments()->delete();
        $patient->scanRequests()->delete();
        $patient->labRequests()->delete();

        $patient->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Successfully deleted')]);
    }

    public function mount()
    {
    }
    public function render()
    {
        $waiting = \App\Models\Appointment::where('doctor_id', $this->doctor_id)
            ->waiting()
            ->count() + 1;
        $patients = Patient::with(['country', 'user'])->where(function ($q) {
            if ($this->patient_id) {
                $q->where('id', $this->patient_id);
            }
            if ($this->civil) {
                $q->where('civil', 'LIKE', "%$this->civil%");
            }
            if ($this->phone) {
                $q->where('phone', 'LIKE', "%$this->phone%");
            }
            if ($this->first_name) {
                $q->where('first_name', 'LIKE', "%$this->first_name%");

            }
        })->latest()->paginate(10);
        return view('livewire.doctor-patients.patients', compact('patients', 'waiting'));
    }
}
