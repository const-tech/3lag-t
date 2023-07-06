<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use AhmedAlmory\JodaResources\JodaResource;
use App\Models\ScanService;
use Illuminate\Http\Request;

class ScanServiceController extends Controller
{
    use JodaResource;

    protected $rules = [
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
    ];
    public function query($query)
    {
        return $query->paginate(10);
    }
}
