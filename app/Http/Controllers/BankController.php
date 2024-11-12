<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BankController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function index()
    {
        $banques = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/banques")->json();

        return view('gestion.banques.liste', compact('banques'));
    }

    public function store(Request $request)
    {
        $token = strval($_SESSION['token']);
        // $url = "https://api.mlouma.org/api/entite/create";
        $url = $this->apiUrl . "/entite/create";

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->post($url, [
            'description' => $request->description,
            'nom_entite' => $request->nom_entite,
            'type_entite' => 8,
            'localite' => $request->localite,

        ]);

        // return redirect('/langue');
        return redirect('/banques/liste');
    }

    public function modifier($id)
    {
        $banque = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/getentity/" . $id)->json();
        // return $banque;
        return view('gestion.banques.edit', compact('banque'));
    }

    public function edit(Request $request)
    {
        $token = strval($_SESSION['token']);
        $id = $request->id;
        // $url = "https://api.mlouma.org/api/editentity/" . $id;
        $url = $this->apiUrl . "/editentity/" . $id;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->put($url, [

            'description' => $request->description,
            'nom_entite' => $request->nom_entite,
            'localite' => $request->localite,

        ]);

        return redirect('/banques/liste');
    }
}
