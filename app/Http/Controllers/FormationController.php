<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormationController extends Controller
{
    //
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }
}
