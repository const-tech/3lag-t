<?php

namespace App\Models;

use App\Traits\EmployeeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory, EmployeeTrait;

    protected $guarded = [];
    protected $appends = [
        'total'
    ];

    public function exercises()
    {
        return $this->hasMany(PackageItem::class)->where('type', 'exercise');
    }

    public function advices()
    {
        return $this->hasMany(PackageItem::class)->where('type', 'advice');
    }

    public function getTotalAttribute()
    {
        return $this->price * $this->num_of_sessions;
    }
}
