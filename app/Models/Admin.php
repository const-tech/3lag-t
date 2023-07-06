<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'users';
    // query where type , dr
    public static function query()
    {
        return parent::query()->where('type','admin');
    }
}
