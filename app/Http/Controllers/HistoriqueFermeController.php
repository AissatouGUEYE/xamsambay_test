<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


class HistoriqueFermeController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function index()
    {
        return view('data.historique.index');
    }
}
