<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LangueController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function index()
    {
        $langues = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/getAlllangue")->json();

        return view('gestion.langue.liste', compact('langues'));
    }


    public function create()
    {
        return view('gestion.langue.create');
    }

    public function store(Request $request)
    {
        $token = strval($_SESSION['token']);
        $url = $this->apiUrl . "/createlangue";

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->post($url, [
            'langue' => $request->langue
        ]);

        // return redirect('/langue');
        return redirect('/langue');
    }

    public function modifier($id)
    {
        $langue = Http::withoutVerifying()->get($this->apiUrl . "/showlangue/" . $id);

        return view('gestion.langue.edit', compact('langue'));
    }

    public function edit(Request $request)
    {
        $token = strval($_SESSION['token']);
        $id = $request->id;
        $url = $this->apiUrl . "/editelangue/" . $id;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->put($url, [

            'langue' => $request->langue

        ]);

        return redirect('/langue');
    }

    public function delete($id)
    {
        $token = strval($_SESSION['token']);
        $url = $this->apiUrl . "/deletelangue/" . $id;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->delete($url);

        return redirect('/langue');
    }
}
