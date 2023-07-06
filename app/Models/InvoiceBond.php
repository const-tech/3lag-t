<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceBond extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_id', 'amount','user_id','rest','status','payment_method'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
