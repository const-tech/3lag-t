<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_id','product_id','product_name','price','discount','quantity','sub_total','department','tax','offer_id','department_id','is_lab','is_scan'];

}
