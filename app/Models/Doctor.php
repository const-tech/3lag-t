<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'users';
    // query where type , dr
    public static function query()
    {
        return parent::query()->where('type','dr');
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class,'doctor_id','id');
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class,'dr_id','id');
    }
    // department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
