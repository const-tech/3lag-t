<?php

namespace App\Http\Controllers\Admin;

use AhmedAlmory\JodaResources\JodaResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    use JodaResource;
    public function query($query)
    {
        return $query->where('appointment_date',today()->format('Y-m-d'))->latest()->paginate(10);
    }
}
