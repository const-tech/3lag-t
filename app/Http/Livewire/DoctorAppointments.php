<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Appointment;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class DoctorAppointments extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $date;
    public $period, $screen = 'index', $patient_id, $clinic_id, $appointment_status, $appointment_time, $appointment_date, $appointment_duration, $doctor_id, $appointment, $patient_key, $patient, $note;

    protected function rules()
    {
        return [
            'patient' => 'required',
            'clinic_id' => 'required',
            'appointment_time' => 'required',
            'appointment_date' => 'required',
            'appointment_duration' => 'required',
        ];
    }
    public function presence(Appointment $appointment)
    {
        $appointment->update(['attended_at' => now()]);
    }
    public function notPresence(Appointment $appointment)
    {
        $appointment->update(['appointment_status' => 'cancelled']);
    }
    public function get_patient()
    {
        $this->patient = Patient::where('id', $this->patient_key)->orWhere('civil', $this->patient_key)->first();
        if ($this->patient) {
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Patient data has been retrieved successfully')]);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('No results found')]);
        }
    }

    public function edit(Appointment $appointment)
    {
        $this->patient_key = $appointment->patient_id;
        $this->get_patient();
        $this->clinic_id = $appointment->clinic_id;
        $this->appointment_time = $appointment->appointment_time;
        $this->appointment_date = $appointment->appointment_date;
        $this->appointment_duration = $appointment->appointment_duration;
        $this->appointment = $appointment;
        $this->screen = 'edit';
    }

    public function submit()
    {
        $data = $this->validate();
        unset($data['patient']);
        $data['doctor_id'] = $this->doctor_id;
        $data['patient_id'] = $this->patient->id;
        $data['employee_id'] = $this->doctor_id;
        $data['appointment_number'] = Str::random(10);
        if (($this->appointment)) {
            $this->appointment->update($data);
        } else {
            foreach ($this->appointment_time as $key => $appointment_time) {
                $Appoint = new Appointment();
                $Appoint->patient_id = $data['patient_id'];
                $Appoint->clinic_id = $data['clinic_id'];
                $Appoint->doctor_id = $data['doctor_id'];
                $Appoint->employee_id = $data['employee_id'];
                $Appoint->appointment_number = $data['appointment_number'];
                $Appoint->appointment_status = 'confirmed';
                $Appoint->appointment_duration = $data['appointment_duration'];
                $Appoint->appointment_date = $data['appointment_date'];
                $Appoint->appointment_time = $appointment_time;
                $Appoint->save();
            }
            // Appointment::create($data);
        }
        $this->reset('patient_key', 'patient', 'clinic_id', 'appointment_time', 'appointment_date', 'appointment_duration', 'appointment');
        $this->screen = 'index';
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
    }

    public function confirm($id)
    {
        $appointment = Appointment::find($id);
        $appointment->appointment_status = 'confirmed';
        $appointment->save();
    }
    // cancel appointment status by id
    public function cancel($id)
    {
        $appointment = Appointment::find($id);
        $appointment->appointment_status = 'cancelled';
        $appointment->save();
    }

    public function updatedScreen()
    {
        if ($this->screen == 'index') {
            $this->reset('patient_id', 'clinic_id', 'appointment_time', 'appointment_date', 'appointment_duration', 'appointment');
        }
    }

    public function resetData()
    {
        $this->date = null;
        $this->period = null;
        $this->resetPage();
    }

    public function mount()
    {
        $this->doctor_id = auth()->id();
    }

    public function render()
    {
        // dd('w');
        $times = [];
        // get only hour from time type
        $from_morning = Carbon::parse(setting()->from_morning)->format('H');
        $to_morning = Carbon::parse(setting()->to_morning)->format('H');
        $from_evening = Carbon::parse(setting()->from_evening)->format('H');
        $to_evening = Carbon::parse(setting()->to_evening)->format('H');
        $reservedTimes = [];
        if ($this->appointment_duration == 'morning' && $this->appointment_date != null) {
            $times = [];
            for ($i = $from_morning; $i < $to_morning; $i++) {
                $times[] = $i . ':00';
                $times[] = $i . ':30';
            }
            $reservedTimes = Appointment::where('appointment_date', $this->appointment_date)
                // ->where('appointment_time', '>=', $from_morning)
                // ->where('appointment_time', '<=', $to_morning)
                ->whereBetween('appointment_time', [(int) $from_morning, (int) $to_morning])
                ->where('clinic_id', $this->clinic_id)
                ->pluck('appointment_time')
                ->toArray();
            // dd($reservedTimes);
        } elseif ($this->appointment_duration == 'evening' && $this->appointment_date) {
            $times = [];

            for ($i = $from_evening; $i < $to_evening; $i++) {
                $times[] = $i . ':00';
                $times[] = $i . ':30';
            }
            $reservedTimes = Appointment::where('appointment_date', $this->appointment_date)
                // ->where('appointment_time', '>=', $from_evening)
                // ->where('appointment_time', '<=', $to_evening)
                ->whereBetween('appointment_time', [(int) $from_evening, (int) $to_evening])
                ->where('clinic_id', $this->clinic_id)
                ->pluck('appointment_time')
                ->toArray();
            // dd($reservedTimes);
        }
        $appoints = Appointment::where('doctor_id', auth()->id())->where(function ($q) {
            if ($this->date) {
                $q->where('appointment_date', $this->date);
            }
            if ($this->period) {
                $q->where('appointment_time', $this->period, '15:00:00');
            }
            if (request()->appointment_status) {
                $q->where('appointment_status', request()->appointment_status);
            }
            if ($this->appointment_status) {
                $q->where('appointment_status', $this->appointment_status);
            }
            if (request()->date) {
                $q->where('appointment_date', request()->date);
            }
        })->latest()->paginate(10);
        return view('livewire.doctor-appointments', compact('appoints', 'reservedTimes', 'times'));
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
}
