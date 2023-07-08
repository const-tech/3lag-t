<?php

namespace App\Http\Livewire\Patients;

use App\Models\Appointment;
use App\Models\PackageDay;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;

class PackageDays extends Component
{
    public $patient_package, $patient, $days = [], $times = [], $reservedTimes = [];

    protected $listeners = ['refreshComponent' => '$refresh'];

    protected function rules()
    {
        return [
            'days.*.appointment_date' => 'nullable',
            'days.*.appointment_time' => 'nullable',
            'days.*.session_time' => 'nullable',
        ];
    }

    public function mount()
    {
        $count_package_days = PackageDay::where('patient_id', $this->patient->id)->where('patient_package_id', $this->patient_package->id)->count();

        $count = $this->patient_package->dayes_period - $count_package_days;
        for ($i = 0; $i < $count; $i++) {
            $this->days[] = [
                'times' => [],
                'day' => '',
                'appointment_date' => '',
                'appointment_time' => '',
                'session_time' => '',
                'patient_id' => $this->patient->id,
                'patient_package_id' => $this->patient_package->id,
            ];
        }
    }

    public function addDay()
    {
        $this->days[] = [
            'times' => [],
            'day' => '',
            'appointment_date' => '',
            'appointment_time' => '',
            'session_time' => '',
            'patient_id' => $this->patient->id,
            'patient_package_id' => $this->patient_package->id,
        ];
    }

    public function removeDay($index)
    {
        unset($this->days[$index]);
        $this->days = array_values($this->days);
    }

    public function presence(PackageDay $package_day)
    {
        $package_day->update(['attend_at' => now(), 'status' => 'confirmed']);

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم تحضير المريض بنجاح']);

        $this->emit('refreshComponent');
    }

    public function notPresence(PackageDay $package_day)
    {
        $package_day->update(['status' => 'cancelled']);

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم إلغاء حضور المريض بنجاح']);

        $this->emit('refreshComponent');
    }

    public function cancelled(PackageDay $package_day)
    {
        $package_day->update(['status' => 'cancelled']);

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم إلغاء الموعد بنجاح']);

        $this->emit('refreshComponent');
    }

    public function getTimes($index, $date)
    {
        $this->days[$index]['times'] = [];
        // get only hour from time type
        $from_morning = Carbon::parse(setting('from_morning'))->format('H');
        $to_morning = Carbon::parse(setting('to_morning'))->format('H');
        $this->reservedTimes = [];

        $this->days[$index]['times'] = [];
        for ($i = $from_morning; $i < $to_morning; $i++) {
            $this->days[$index]['times'][] = $i . ':00';
            $this->days[$index]['times'][] = $i . ':30';
        }
        $this->reservedTimes = Appointment::where('appointment_date', $date)
            ->where('appointment_time', '>=', $from_morning)
            ->where('appointment_time', '<=', $to_morning)
            ->pluck('appointment_time')->toArray();

        $this->days[$index]['day'] = Carbon::parse($date)->isoFormat('dddd');
    }

    public function saveDays()
    {
        $this->validate();

        foreach ($this->days as $day) {
            if ($day['appointment_date'] && $day['appointment_time']) {
                // check if there is an appointment with the same date and time
                $appointment = Appointment::where('appointment_date', $day['appointment_date'])
                    ->where('appointment_time', $day['appointment_time'])
                    ->first();
                if ($appointment) {
                    $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'هناك موعد بهذا التاريخ والوقت']);
                    return;
                }

                Appointment::create([
                    'appointment_date' => $day['appointment_date'],
                    'appointment_time' => $day['appointment_time'],
                    'patient_id' => $day['patient_id'],
                    'employee_id' => auth()->id(),
                    'doctor_id' => $this->patient_package->invoice->dr->id,
                    'clinic_id' => $this->patient_package->invoice->dr->department_id,
                    'appointment_status' => 'pending',
                    'appointment_number' => Str::random(10),
                    'patient_package_id' => $day['patient_package_id'],
                ]);

                PackageDay::create([
                    'patient_id' => $day['patient_id'],
                    'patient_package_id' => $day['patient_package_id'],
                    'appointment_date' => $day['appointment_date'],
                    'appointment_time' => $day['appointment_time'],
                    'session_time' => $day['session_time'],
                ]);
            }
        }

        session()->flash('success', __('Saved successfully'));
        return redirect()->route('appointments.index');
    }

    public function render()
    {
        $package_days = PackageDay::where('patient_id', $this->patient->id)->where('patient_package_id', $this->patient_package->id)->get();

        return view('livewire.patients.package-days', compact('package_days'));
    }
}
