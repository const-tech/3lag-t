<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Appointment;
use Illuminate\Support\Str;

class AppointmentForm extends Component
{
    public $appointment, $appointment_id, $patient, $doctor_id, $patient_id, $clinic_id, $appointment_date, $appointment_time, $appointment_status, $appointment_duration, $patient_key, $review, $notes;

    public function rules()
    {
        return [
            'patient' => 'required',
            'doctor_id' => 'nullable',
            'clinic_id' => 'nullable',
            'appointment_date' => 'nullable',
            'appointment_time' => 'nullable',
            'appointment_duration' => 'nullable',
            'appointment_status' => 'nullable',
            'review' => 'nullable',
            'notes' => 'nullable'
        ];
    }
    public function get_patient()
    {
        $this->patient = Patient::where('phone', $this->patient_key)->orWhere('civil', $this->patient_key)->orWhere('id', $this->patient_key)->first();
        if ($this->patient) {
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Patient data has been retrieved successfully')]);
            if ($this->patient->invoices()->unpaid()->count() > 0) {
                $this->emit('unpaid');
            }
            if ($this->patient->invoices()->partiallyPaid()->count() > 0) {
                $this->emit('partiallyPaid');
            }
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('No results found')]);
        }
    }

    public function save()
    {
        // check if there is an appointment with the same doctor and patient
        $appointment = Appointment::where('doctor_id', $this->doctor_id)
            ->where('patient_id', $this->patient->id)
            ->where('appointment_status', 'pending')
            ->first();
        if ($appointment && !$this->appointment) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'هناك موعد بهذا الطبيب لهذا المريض']);
            return;
        }

        // check if there is an appointment with the same date and time
        $appointment = Appointment::where('appointment_date', $this->appointment_date)
            ->where('appointment_time', $this->appointment_time)
            ->first();
        if ($appointment && !$this->appointment) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'هناك موعد بهذا التاريخ والوقت']);
            return;
        }

        $data = $this->validate();
        unset($data['patient']);
        $data['employee_id'] = auth()->id();
        $data['patient_id'] = $this->patient->id;
        // $data['appointment_status'] = Carbon::parse($this->appointment_date)->format('Y-m-d') > today()->format('Y-m-d') ? 'confirmed' : 'pending';
        $data['appointment_status'] = $this->appointment_status;
        $data['appointment_time'] = date('H:i', strtotime($this->appointment_time));
        if ($this->appointment->id) {
            $this->appointment->update($data);
        } else {
            $data['appointment_number'] = Str::random(10);

            Appointment::create($data);
        }
        session()->flash('success', __('Saved successfully'));
        return redirect()->route('front.appointments.index');
    }

    public function mount(Appointment $appointment)
    {
        // $appointment = Appointment::find($appointment->id);
        $this->appointment = $appointment;
        $this->patient = $appointment ? $appointment->patient : null;
        $this->patient_id = $appointment ? $appointment->patient_id : null;
        $this->doctor_id = $appointment ? $appointment->doctor_id : null;
        $this->clinic_id = $appointment ? $appointment->clinic_id : null;
        $this->review = $appointment ? $appointment->review : null;
        $this->notes = $appointment ? $appointment->notes : null;
        $this->appointment_status = $appointment ? $appointment->appointment_status : null;
        $this->appointment_duration = $appointment
            ? $appointment->appointment_duration
            : (request()->has('appointment_duration') ? request()->appointment_duration : null);
        $this->appointment_date = $appointment
            ? $appointment->appointment_date
            : (request()->has('appointment_date') ? request()->appointment_date : now()->format('Y-m-d'));
        $this->appointment_time = $appointment
            ? $appointment->appointment_time
            : (request()->has('appointment_time') ? request()->appointment_time : now()->format('H:i'));
    }

    public function render()
    {
        $times = [];
        // get only hour from time type
        $from_morning = Carbon::parse(setting()->from_morning)->format('H');
        $to_morning = Carbon::parse(setting()->to_morning)->format('H');
        $from_evening = Carbon::parse(setting()->from_evening)->format('H');
        $to_evening = Carbon::parse(setting()->to_evening)->format('H');
        $doctor = User::find($this->doctor_id);
        $reservedTimes = [];
        if ($this->appointment_duration == 'morning') {
            $diffInMinutes = Carbon::parse(setting()->from_morning)->diffInMinutes(Carbon::parse(setting()->to_morning));
            if ($doctor->session_duration > 0) {
                $last_time = $diffInMinutes / $doctor->session_duration;
            } else {
                $last_time = $diffInMinutes / 30;
            }

            $start = Carbon::createFromTime($from_morning, 0, 0);
            $times = [];
            $times[] = $start->format('h:i A');
            for ($i = 1; $i < $last_time; $i++) {
                $time = $start->addMinutes($doctor ? $doctor->session_duration : 30);
                $times[] = $time->format('h:i A');
            }
            $reservedTimes = Appointment::where('appointment_date', $this->appointment_date)
                ->whereBetween('appointment_time', [(int) $from_morning, (int) $to_morning])
                ->where('doctor_id', $this->doctor_id)
                ->pluck('appointment_time')
                ->toArray();
        } elseif ($this->appointment_duration == 'evening') {
            $evening_time = Carbon::createFromFormat('H:i', setting()->to_evening);
            $midnight = Carbon::createFromTime(0, 0, 0);
            $diffInMinutes = Carbon::parse(setting()->from_evening)->diffInMinutes($evening_time->greaterThan($midnight) && $evening_time->isNextDay() ? Carbon::parse(setting()->to_evening)->addDay() : Carbon::parse(setting()->to_evening));
            if ($doctor->session_duration > 0) {
                $last_time = $diffInMinutes / $doctor->session_duration;
            } else {
                $last_time = $diffInMinutes / 30;
            }

            $start = Carbon::createFromTime($from_evening, 0, 0);
            $times = [];
            $times[] = $start->format('h:i A');
            for ($i = 1; $i < $last_time; $i++) {
                $time = $start->addMinutes($doctor ? $doctor->session_duration : 30);
                $times[] = $time->format('h:i A');
            }
            /* if ($from_evening < $to_evening) {
            for ($i = $from_evening; $i < $to_evening; $i++) {
            $times[] = $i . ':00';
            $times[] = $i . ':30';
            }
            } else {
            for ($i = $from_evening; $i <= 24; $i++) {
            $times[] = $i . ':00';
            $times[] = $i . ':30';
            }
            for ($i = 01; $i < $to_evening; $i++) {
            $times[] = $i . ':00';
            $times[] = $i . ':30';
            }
            } */
            $reservedTimes = Appointment::where('appointment_date', $this->appointment_date)
                ->whereBetween('appointment_time', [(int) $from_evening, (int) $to_evening])
                ->where('doctor_id', $this->doctor_id)
                ->pluck('appointment_time')
                ->toArray();
        }
        return view('livewire.appointment-form', compact('reservedTimes', 'times'));
    }
}
