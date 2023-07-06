<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabRequest extends Model
{
    use HasFactory;
    protected $guarded  = [];
    public function diagnose(){
        return $this->belongsTo(Diagnose::class,'diagnose_id');
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function doctor(){
        return $this->belongsTo(User::class,'doctor_id');
    }
    public function clinic(){
        return $this->belongsTo(Department::class,'clinic_id');
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
  
}
