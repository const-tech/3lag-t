<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class DoctorAppointmentsInfo extends Component
{
    public $from, $to, $appointment_duration = 'all';

    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereBetween('created_at', [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where('created_at', '>=', $this->from);
        } elseif ($this->to) {
            $query->where('created_at', '<=', $this->to);
        } else {
            $query;
        }
    }
    public function render()
    {
        $morningTimesCount = 0;
        $eveningTimesCount = 0;
        $timesCount = 0;

        // $appointments = Appointment::where('appointment_status','pending')->get();
        $appointments = Appointment::where(function ($query) {
            $this->between($query);
        })->where(function ($q) {
            $q->where('clinic_id', doctor()->department_id);
            $q->where('doctor_id', doctor()->id);
        })->latest()->get();

        $currentAppointments = Appointment::whereBetween(
            'appointment_time',
            [now()->subMinutes(30)->format('H:i'), now()->format('H:i')]
        )->get();


        $times = [];
        // get only hour from time type
        $from_morning = Carbon::parse(setting()->from_morning)->format('H');
        $to_morning = Carbon::parse(setting()->to_morning)->format('H');
        $from_evening = Carbon::parse(setting()->from_evening)->format('H');
        $to_evening = Carbon::parse(setting()->to_evening)->format('H');
        $reservedTimes = [];
        if ($this->appointment_duration == 'morning' or $this->appointment_duration == 'all') {
            for ($i = $from_morning; $i < $to_morning; $i++) {
                $times[] = $i . ':00';
                $times[] = $i . ':30';
                $morningTimesCount += 2;
            }

            $timesCount += $morningTimesCount;
        }
        if ($this->appointment_duration == 'evening' or $this->appointment_duration == 'all') {

            for ($i = $from_evening; $i < $to_evening; $i++) {
                $times[] = $i . ':00';
                $times[] = $i . ':30';
                $eveningTimesCount += 2;
            }

            $timesCount += $eveningTimesCount;
        }

        $availableTimes = ($timesCount * 7) - $appointments->count();
        return view('livewire.doctor-appointments-info', compact('appointments', 'currentAppointments', 'times', 'availableTimes'));
    }
}
