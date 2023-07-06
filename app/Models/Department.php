<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable=['name','parent','transferstatus','appointmentstatus','is_scan','is_lab'];

    public function main(){
        return $this->belongsTo(Self::class,'parent');
    }
    public function children(){
        return $this->hasMany(Self::class,'parent');
    }

    public function products(){
        return $this->hasMany(Department::class);
    }
}
