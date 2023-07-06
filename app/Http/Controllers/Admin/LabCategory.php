<?php

namespace App\Http\Controllers\Admin;


use AhmedAlmory\JodaResources\JodaResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LabCategory extends Controller
{
    use JodaResource;
    protected $rules = [
        'name' => 'required|string|max:255',
    ];
    public function query($query)
    {
        return $query->paginate(10);
    }
}
