<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'parent', 'rate'];

    public function main()
    {
        return $this->belongsTo(Self::class, 'parent');
    }
    public function children()
    {
        return $this->hasMany(Self::class, 'parent');
    }
    public function patients()
    {
        return $this->hasMany(Patient::class, 'patient_group_id');
    }
}
