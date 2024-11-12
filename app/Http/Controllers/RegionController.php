<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegionController extends Controller
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

        // return $langues;
        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {
            return view('gestion.localites.regions.listeregionsadmin', compact('regions', 'regions'));
        } else {
            return view('gestion.localites.regions.listeregions', compact('regions', 'regions'));
        }
    }

    public function create()
    {
        return view('gestion.localites.regions.create');
    }

    public function store(Request $request)
    {
        $token = strval($_SESSION['token']);
        $url = $this->apiUrl . "/regions/create";

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->post($url, [
            'region' => $request->region,
            'pays' => $request->pays

        ]);

        // return redirect('/langue');
        return redirect('/localites');
    }

    public function modifier($id)
    {
        $region = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/regions/" . $id)->json();

        return view('gestion.localites.regions.edit', compact('region', 'region'));
    }

    public function edit(Request $request)
    {
        $token = strval($_SESSION['token']);
        $id = $request->id;
        $url = $this->apiUrl . "/regions/update/" . $id;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->put($url, [

            'region' => $request->region,
            'pays' => $request->pays

        ]);

        return redirect('/localites');
    }

    public function delete($id)
    {
        $token = strval($_SESSION['token']);
        $url = $this->apiUrl . "/regions/delete/" . $id;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->delete($url);

        return redirect('/localites');
    }
}
