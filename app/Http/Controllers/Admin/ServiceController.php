<?php

namespace App\Http\Controllers\Admin;

use AhmedAlmory\JodaResources\JodaResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use JodaResource;

    protected $rules = [
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'category_id' => 'required|numeric',
    ];

    public function query($query)
    {
        return $query->paginate(10);
    }
}
