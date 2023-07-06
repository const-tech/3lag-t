<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $appends = ['net'];


    public function getNetAttribute(){
        return  $this->amount - $this->tax_value;
    }

}
