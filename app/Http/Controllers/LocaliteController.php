<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LocaliteController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function index()
    {
        $regions = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/regions")->json();

        $dep = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/departements")->json();

        $communes = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/communes")->json();

        $localites = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/localites")->json();

        // return $regions;
        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {
            return view('gestion.localites.index', ['regions' => $regions, 'dep' => $dep, 'communes' => $communes, 'localites' => $localites]);
        } else {
            return view('gestion.localites.regions.listeregions', ['regions' => $regions, 'dep' => $dep, 'communes' => $communes]);
        }
    }


    public function store(Request $request)
    {
        $token = strval($_SESSION['token']);
        $url = $this->apiUrl . "/localites/create";

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->post($url, [
            'id_commune' => $request->id_commune,
            'localite' => $request->localite

        ]);

        // return redirect('/langue');
        return redirect('/localites');
    }

    public function modifier($id)
    {
        $communes = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/communes")->json();

        $localite = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/localites/" . $id)->json();

        return view('gestion.localites.localites.edit', ['localite' => $localite, 'communes' => $communes]);
    }

    public function edit(Request $request)
    {
        $token = strval($_SESSION['token']);
        $id = $request->id;
        $url = $this->apiUrl . "/localites/update/" . $id;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->put($url, [

            'id_commune' => $request->id_commune,
            'localite' => $request->localite

        ]);

        return redirect('/localites');
    }

    public function delete($id)
    {
        $token = strval($_SESSION['token']);
        $url = $this->apiUrl . "/localites/delete/" . $id;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->delete($url);

        return redirect('/localites');
    }
}
