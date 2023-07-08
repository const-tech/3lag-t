<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientPackage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function days()
    {
        return $this->hasMany(PackageDay::class);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
