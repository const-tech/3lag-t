<?php

namespace App\Http\Controllers\Front;

use AhmedAlmory\JodaResources\JodaResource;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    use JodaResource;

    public function query($query)
    {
        return $query->where(function ($q) {
            if (request()->from) {
                $q->whereDate('created_at', '>=', request()->from);
            }
        })
            ->where(function ($q) {
                if (request()->to) {
                    $q->whereDate('created_at', '<=', request()->to);
                }
            });
    }

    public function bonds(Invoice $invoice)
    {
        return view('front.invoice.bonds', compact('invoice'));
    }
}
