<?php

namespace App\Http\Livewire\Patients;

use App\Models\Patient;
use Livewire\Component;
use App\Models\Appointment;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Patients extends Component
{
    public $civil, $patient_id, $phone, $doctor_id, $clinic_id, $appointment_duration, $transfer_mode = false, $trans_patient, $waiting, $filter_visit, $first_name;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    // public function mount(Patient $patient)
    // {
    //     $this->trans_patient= $patient;
    // }

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

        $data = $this->validate();

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

    public function render()
    {
        $this->waiting = \App\Models\Appointment::where('doctor_id', $this->doctor_id)
            ->Transferred()
            ->count() + 1;
        $patients = Patient::with(['country', 'user', 'invoices'])->where(function ($q) {
            if ($this->patient_id) {
                $q->where('id', $this->patient_id);
            }
            if ($this->civil) {
                $q->where('civil', 'LIKE', "%$this->civil%");
            }
            if ($this->phone) {
                $q->where('phone', 'LIKE', "%$this->phone%");
            }
            if (request('toDay')) {
                $q->where('created_at', toDay());
            }
            if (request('saudi') == true) {
                $q->where('country_id', 1);
            }
            if (request('saudi') == 'false') {
                $q->where('country_id', '<>', 1);
            }
            if ($this->filter_visit) {
                $q->where('visitor', true);
            }
            if ($this->first_name) {
                $q->where('first_name', 'LIKE', "%$this->first_name%");
            }
        })->latest()->paginate(10);
        return view('livewire.patients.patients', compact('patients'));
    }
}
