<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Appointment;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class CreateGuests extends Component
{
    public $civil, $first_name, $gender, $phone, $doctor_id, $clinic_id, $appointment_time, $appointment, $appointment_date, $appointment_duration, $insurance_id;
    use WithFileUploads;

    protected function rules()
    {
        return [
            'civil' => 'nullable|numeric|digits:10|unique:patients,civil',
            'first_name' => 'required',
            'phone' => 'required|unique:patients,phone',
            'gender' => 'required|in:male,female',
            'doctor_id' => 'nullable',
            'clinic_id' => 'nullable',
            'appointment_time' => 'nullable',
            'appointment_date' => 'nullable',
        ];
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $data = $this->validate();
        // $patient =  Patient::create($data);
        $patient = new Patient();
        $patient->civil = $this->civil ? $this->civil : '-';
        $patient->first_name = $this->first_name;
        $patient->phone = $this->phone;
        $patient->gender = $this->gender;
        $patient->visitor = 1;
        $patient->user_id = auth()->id();
        $patient->save();

        $this->appointment['doctor_id'] = $this->doctor_id;
        $this->appointment['clinic_id'] = $this->clinic_id;
        $this->appointment['appointment_date'] = $this->appointment_date;
        $this->appointment['appointment_time'] = $this->appointment_time;
        $this->appointment['appointment_duration'] = $this->appointment_duration;
        $this->appointment['appointment_status'] = 'pending';
        $this->appointment['employee_id'] = auth()->user()->id;
        $this->appointment['patient_id'] = $patient->id;
        $this->appointment['appointment_number'] = Str::random(10);
        Appointment::query()->create($this->appointment);
        return redirect()->route('front.appointments.index')->with('success', __('Successfully added'));
    }
    public function updatedInsurance()
    {
        $this->insurance_id = null;
    }
    public function render()
    {
        $times = [];
        // get only hour from time type
        $from_morning = Carbon::parse(setting()->from_morning)->format('H');
        $to_morning = Carbon::parse(setting()->to_morning)->format('H');
        $from_evening = Carbon::parse(setting()->from_evening)->format('H');
        $to_evening = Carbon::parse(setting()->to_evening)->format('H');
        $reservedTimes = [];
        if ($this->appointment_duration == 'morning') {
            $times = [];
            for ($i = $from_morning; $i < $to_morning; $i++) {
                $times[] = $i . ':00';
                $times[] = $i . ':30';
            }
            $reservedTimes = Appointment::where('appointment_date', $this->appointment_date)
                ->whereBetween('appointment_time', [(int) $from_morning, (int) $to_morning])
                ->pluck('appointment_time')->toArray();
            // dd($from_morning, $to_morning, $reservedTimes, $this->appointment_date);
        } elseif ($this->appointment_duration == 'evening') {
            $times = [];

            if ($from_evening < $to_evening) {
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
            }


            // $reservedTimes = Appointment::where('appointment_date', $this->appointment_date)
            //     ->where('appointment_time', '>=', $from_evening)
            //     ->where('appointment_time', '<=', $to_evening)
            //     ->pluck('appointment_time')->toArray();
            $reservedTimes = Appointment::where('appointment_date', $this->appointment_date)
                ->whereBetween('appointment_time', [(int) $from_evening, (int) $to_evening])
                ->pluck('appointment_time')->toArray();
        }
        return view('livewire.create-guests', compact('reservedTimes', 'times'));
    }
}

// ->where('appointment_time', '>=', $from_morning)
// ->where('appointment_time', '<=', $to_morning)
// ->pluck('appointment_time')->toArray();
