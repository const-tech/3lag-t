<?php

namespace App\Http\Controllers\Admin;

use AhmedAlmory\JodaResources\JodaResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    use JodaResource;
    protected $rules = [
        'name' => 'required',
    ];
    public function query($query)
    {
        return $query->paginate(10);
    }
}
