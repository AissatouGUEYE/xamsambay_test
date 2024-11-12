<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

// use Crypt;

class MoodleUserController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function index()
    {
        $data = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/utilisateurs-moodle", [

            'login' => 'administrateur',
            'password' => 'Aicheikh_123'

        ])->json();

        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {

            return view('gestion.moodle.utilisateurs', ['data' => $data['users']]);
        }
    }
}
