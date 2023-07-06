<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'notes', 'employee_id', 'doctor_id', 'clinic_id', 'appointment_number', 'appointment_type', 'appointment_status', 'appointment_reason', 'appointment_note', 'appointment_time', 'appointment_date', 'appointment_duration', 'attended_at', 'review', 'appointment_id'];
    // patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    // employee
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }
    // doctor
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }
    // clinic
    public function clinic()
    {
        return $this->belongsTo(Department::class, 'clinic_id', 'id');
    }
    // scope examined
    public function scopeExamined($query)
    {
        return $query
            ->where('appointment_status', 'examined');
    }
    // scope not examined
    public function scopeNotExamined($query)
    {
        return $query
            ->where('appointment_status', '<>', 'examined');
    }
    // transferred
    public function scopeTransferred($query)
    {
        return $query
            ->where('appointment_status', 'transferred');
    }
    // scope not transferred
    public function scopeNotTransferred($query)
    {
        return $query
            ->where('appointment_status', '<>', 'transferred');
    }
    // scope pending
    public function scopePending($query)
    {
        return $query
            ->where('appointment_status', 'pending');
    }
    public function scopeCancelled($query)
    {
        return $query
            ->where('appointment_status', 'cancelled');
    }
    public function scopeNotCancelled($query)
    {
        return $query
            ->where('appointment_status', '<>', 'cancelled');
    }
    // scope today
    public function scopeToday($query)
    {
        return $query->whereDate('appointment_date', date('Y-m-d'));
    }
    // scope waiting
    public function scopeWaiting($query)
    {
        return $query
            ->pending()
            ->whereNull('appointment_date')
            ->whereNull('appointment_time');
    }
    // not waiting
    public function scopeNotWaiting($query)
    {
        return $query
            ->whereNotNull('appointment_date')
            ->whereNotNull('appointment_time');
    }
    // scope this hour
    public function scopeThisHour($query)
    {
        return $query
            ->notExamined()
            ->notTransferred()
            ->whereDate('appointment_date', date('Y-m-d'))
            ->where('appointment_time', '>=', Carbon::now()->format('H:i:s'))
            ->where('appointment_time', '<=', Carbon::now()->addHour()->format('H:i:s'));
    }

    public function diagnos()
    {
        return $this->hasOne(Diagnose::class, 'appointment_id');
    }
    public function child()
    {
        return $this->hasOne(Appointment::class, 'appointment_id');
    }
    public function parent()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function reviewParent()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }
}
