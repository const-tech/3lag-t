<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScanService extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function request(){
        return $this->hasMany(ScanRequest::class,'service_id');
    }
}
