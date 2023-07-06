<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use AhmedAlmory\JodaResources\JodaResource;

class ProductController extends Controller
{
    use JodaResource;
    protected $rules = [
        'name' => 'required',
        'price' => 'required',
        'department_id' => 'required',
    ];

    public function query($query)
    {
        return $query->paginate(10);
    }
}
