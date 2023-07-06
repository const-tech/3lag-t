<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diagnose extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'tooth' => 'json',
        'body' => 'json',
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function appoint()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }
    public function dr()
    {
        return $this->belongsTo(User::class, 'dr_id', 'id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
