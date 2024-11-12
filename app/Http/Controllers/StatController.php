<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StatController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function info_climatiques()
    {
        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {

            $prev_sms = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/histallprevsms/null/null/null")->json();

            $prev_voice = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/histallprevvoice/null/null/null")->json();

            $collecte = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/histallcollecte/null/null/null")->json();
        }
        elseif ($_SESSION['role'] === "ONG") {
        
            $prev_sms = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/histallprevsms/" . $_SESSION['id_entite']. "/null/null")->json();

            $prev_voice = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/histallprevvoice/" . $_SESSION['id_entite']. "/null/null")->json();

            $collecte = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/histallcollecte/" . $_SESSION['id_entite']. "/null/null")->json();

        }
        elseif ($_SESSION['role'] === "OP") {
        
            $prev_sms = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/histallprevsms/null/" . $_SESSION['groupement']. "/null")->json();

            $prev_voice = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/histallprevvoice/null/" . $_SESSION['groupement']. "/null")->json();

            $collecte = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/histallcollecte/null/" . $_SESSION['groupement']. "/null")->json();

        }elseif ($_SESSION['role'] === "INDIVIDUEL") {
                    
            $prev_sms = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/histallprevsms/null/null/" . $_SESSION['id'])->json();

            $prev_voice = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/histallprevvoice/null/null/" . $_SESSION['id'])->json();

            $collecte = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/histallcollecte/null/null/" . $_SESSION['id'])->json();
        }

        return view('services.informations_climatiques.statistique.stat', compact('collecte', 'prev_sms', 'prev_voice'));
    }
}
