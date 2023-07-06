<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function main(){
        return $this->belongsTo(Self::class,'parent');
    }
    public function kids(){
        return $this->hasMany(Self::class,'parent');
    }
    public function expenses(){
        return $this->hasMany(Expense::class,'category_id');
    }
}
