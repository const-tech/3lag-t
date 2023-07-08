<?php

namespace App\Models;

use Prgayman\Zatca\Facades\Zatca;
use Illuminate\Database\Eloquent\Model;
use Prgayman\Zatca\Utilis\QrCodeOptions; // Optional
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = ['paid'];
    //    scope pending
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    public function scopePaid($query)
    {
        return $query->where('status', 'Paid');
    }
    public function scopeTab($query)
    {
        return $query->where('tab', 1);
    }
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }
    public function scopeUnpaid($query)
    {
        return $query->where('status', 'Unpaid');
    }
    public function scopePartiallyPaid($query)
    {
        return $query->where('status', 'Partially Paid');
    }
    public function scopeOverdue($query)
    {
        return $query->where('status', 'overdue');
    }
    public function scopeDue($query)
    {
        return $query->where('status', 'due');
    }
    //     FIXME :: dr not mean doctor and employee is doctor when doctor creating invoice
    public function dr()
    {
        return $this->belongsTo(User::class, 'dr_id');
    }
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function products()
    {
        return $this->hasMany(InvoiceItem::class);
    }
    public function bonds()
    {
        return $this->hasMany(InvoiceBond::class, 'invoice_id');
    }

    public function getPaidAttribute()
    {
        if ($this->installment_company) {
            return $this->total;
        }
        return $this->card + $this->cash + $this->bank;
    }

    public function qr()
    {
        $qrCodeOptions = new QrCodeOptions();
        $qrCodeOptions->format('svg');
        $qrCodeOptions->backgroundColor(255, 255, 255);
        $qrCodeOptions->color(0, 0, 0);
        $qrCodeOptions->size(125);
        $qrCodeOptions->margin(0);
        $qrCodeOptions->style('square', 0.5);
        $qrCodeOptions->eye('square');
        if (strlen(setting()->tax_no) == 15) {
            $qr = Zatca::sellerName(setting()->site_name)
                ->vatRegistrationNumber(setting()->tax_no)
                ->timestamp($this->created_at)
                ->totalWithVat($this->total)
                ->vatTotal($this->tax)
                ->toQrCode($qrCodeOptions);
            return $qr;
        }
    }
}
