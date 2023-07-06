<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use AhmedAlmory\JodaResources\JodaResource;

class UserManualController extends Controller
{
    use JodaResource;

    public $rules = [
        'question' => 'required',
        'answer' => 'required',
        'question_en' => 'nullable',
        'answer_en' => 'nullable',
    ];

    public function query($query)
    {
        return $query->paginate(10);
    }
}
