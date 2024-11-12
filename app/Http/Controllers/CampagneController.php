<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CampagneController extends Controller
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

        // return $langues;
        return view('gestion.campagnes.liste', compact('langues', 'langues'));
    }

    // public function create()
    // {
    //     return view('gestion.langue.create');
    // }

    // public function store(Request $request)
    // {
    //     $token = strval($_SESSION['token']);
    //     $url = "https://api.mlouma.org/api/createlangue";

    //     Http::withHeaders([
    //         'Accept' => 'application/json',
    //         'Content-Type' => 'application/json',
    //     ])->withToken($token)->withoutVerifying()->post($url, [
    //         'langue' => $request->langue
    //     ]);

    //     // return redirect('https://xamsambay.mlouma.org/langue');
    //     return redirect('https://xamsambay.mlouma.org/langue');
    // }

    // public function modifier($id)
    // {
    //     $langue = Http::withoutVerifying()->get("https://api.mlouma.org/api/showlangue/" . $id);

    //     return view('gestion.langue.edit', compact('langue', 'langue'));
    // }

    // public function edit(Request $request)
    // {
    //     $token = strval($_SESSION['token']);
    //     $id = $request->id;
    //     $url = "https://api.mlouma.org/api/editelangue/" . $id;

    //     Http::withHeaders([
    //         'Accept' => 'application/json',
    //         'Content-Type' => 'application/json',
    //     ])->withToken($token)->withoutVerifying()->put($url, [

    //         'langue' => $request->langue

    //     ]);

    //     return redirect('https://xamsambay.mlouma.org/langue');
    // }

    // public function delete($id)
    // {
    //     $token = strval($_SESSION['token']);
    //     $url = "https://api.mlouma.org/api/deletelangue/" . $id;

    //     Http::withHeaders([
    //         'Accept' => 'application/json',
    //         'Content-Type' => 'application/json',
    //     ])->withToken($token)->withoutVerifying()->delete($url);

    //     return redirect('https://xamsambay.mlouma.org/langue');
    // }

    // public function getRole()
    // {
    //     $request = Http::withHeaders([
    //         'Accept' => 'application/json',
    //         'Content-Type' => 'application/json',
    //         'Authorization' => $_SESSION['token']
    //     ])->withToken($_SESSION['token'])->withoutVerifying()->get('https://api.mlouma.org/api/gettypent');
    //     $roleList = $request->object();
    //     return $roleList;
    // }
}
