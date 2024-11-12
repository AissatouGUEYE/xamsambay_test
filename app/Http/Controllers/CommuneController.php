<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CommuneController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function store(Request $request)
    {
        $token = strval($_SESSION['token']);
        // $url = "https://api.mlouma.org/api/communes/create";
        $url = $this->apiUrl . "/communes/create";

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->post($url, [
            'departement' => $request->departement,
            'commune' => $request->commune

        ]);

        // return redirect('/langue');
        return redirect('/localites');
    }

    public function modifier($id)
    {
        $dep = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl."/departements")->json();

        $commune = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl."/communes/" . $id)->json();

        return view('gestion.localites.communes.edit', ['commune' => $commune, 'dep' => $dep]);
    }

    public function edit(Request $request)
    {
        $token = strval($_SESSION['token']);
        $id = $request->id;
        $url = $this->apiUrl."/communes/update/" . $id;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->put($url, [

            'departement' => $request->departement,
            'commune' => $request->commune

        ]);

        return redirect('/localites');
    }

    public function delete($id)
    {
        $token = strval($_SESSION['token']);
        $url = $this->apiUrl."/communes/delete/" . $id;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->delete($url);

        return redirect('/localites');
    }
}
