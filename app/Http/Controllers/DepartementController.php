<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DepartementController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function store(Request $request)
    {
        $token = strval($_SESSION['token']);
        // $url = "https://api.mlouma.org/api/departements/create";
        $url = $this->apiUrl . "/departements/create";

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->post($url, [
            'region' => $request->region,
            'departement' => $request->departement

        ]);

        // return redirect('/langue');
        return redirect('/localites');
    }

    public function modifier($id)
    {
        $regions = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/regions")->json();

        $dep = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/departements/" . $id)->json();

        return view('gestion.localites.departements.edit', ['regions' => $regions, 'dep' => $dep]);
    }

    public function edit(Request $request)
    {
        $token = strval($_SESSION['token']);
        $id = $request->id;
        $url = $this->apiUrl . "/departements/update/" . $id;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->put($url, [

            'region' => $request->region,
            'departement' => $request->departement

        ]);

        return redirect('/localites');
    }

    public function delete($id)
    {
        $token = strval($_SESSION['token']);
        $url = $this->apiUrl . "/departements/delete/" . $id;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->delete($url);

        return redirect('/localites');
    }
}
