<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientFile extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function employee(){
        return $this->belongsTo(User::class,'employee_id');
    }
}
