<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class AgenceController extends Controller
{
    //

    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function index($banque, $nom_banque)
    {

        $agences = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/agences/liste/".$banque)->json();

        // return $agences;
        return view('gestion.banques.agences.index', compact('agences', 'banque', 'nom_banque'));
    }


    public function store($banque, $nom_banque, Request $request)
    {
        $agences = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/agences/liste/".$banque)->json();

        $token = strval($_SESSION['token']);
        $url = $this->apiUrl . "/agences/create";

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->post($url, [
            'banque' => $banque,
            'telephone' => $request->telephone,
            'localite' => $request->localite,
            'adresse' => $request->adresse,

        ]);

        return redirect('/banques/liste/agences/' . $banque . '/' . $nom_banque);

    }


    public function modifier($banque, $nom_banque, $id)
    {
        $agence = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/agences/" . $id)->json();

        // return $agence;

        return view('gestion.banques.agences.edit', compact('agence', 'banque', 'nom_banque'));
    }

    public function edit($banque, $nom_banque, Request $request)
    {
        $token = strval($_SESSION['token']);
        $id = $request->id;
        // $url = "https://api.mlouma.org/api/editentity/" . $id;
        $url = $this->apiUrl . "/agences/update/" . $id;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->put($url, [

            'banque' => $banque,
            'localite' => $request->localite,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,

        ]);

        return redirect('/banques/liste/agences/' . $banque . '/' . $nom_banque);
    }
}
