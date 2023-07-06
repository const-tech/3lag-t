<?php

namespace App\Http\Controllers\Front;

use AhmedAlmory\JodaResources\JodaResource;
use App\Http\Controllers\Controller;
use App\Models\Diagnose;
use Illuminate\Http\Request;

class DiagnoseController extends Controller
{
    use JodaResource;
    public function query($query)
    {
        return $query->with(['appoint','dr'])->latest()->paginate(10);
    }
}
