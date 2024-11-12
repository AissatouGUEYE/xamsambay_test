<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Storage;

class AUOPController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function store(Request $request)
    {
        $token = strval($_SESSION['token']);
        // $url = "https://api.mlouma.org/api/auop/create";
        $url = $this->apiUrl . "/auop/create";

        $date_creation = str_replace('/', '-', $request->date_creation);
        $date_creation = date('Y-m-d', strtotime($date_creation));

        $filename = null;

        if ($request->ninea) {
            $filename = Storage::disk('public')->put('auop', $request->ninea);
        }


        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {

            Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($token)->withoutVerifying()->post($url, [
                'libelle' => $request->libelle,
                'date_creation' => $date_creation,
                'entite' => $request->entite,
                'localite' => $request->localite,
                'description' => $request->description,
                'ninea' => $filename


            ]);
        } elseif ($_SESSION['role'] === "ONG") {

            Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($token)->withoutVerifying()->post($url, [
                'libelle' => $request->libelle,
                'date_creation' => $date_creation,
                'entite' => $_SESSION['id_entite'],
                'localite' => $request->localite,
                'description' => $request->description,
                'ninea' => $filename


            ]);
        }

        return redirect('/groupements');
    }

    public function modifier($id)
    {
        $token = strval($_SESSION['token']);

        $op = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->get($this->apiUrl . "/auop/" . $id)->json();

        $ong = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ong")->json();

        $localites = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/localites")->json();

        // return $op;

        return view('gestion.groupements.OP.edit', ['op' => $op, 'localites' => $localites, 'ong' => $ong]);
    }

    public function edit(Request $request)
    {
        $token = strval($_SESSION['token']);
        $id = $request->id;
        // $url = "https://api.mlouma.org/api/auop/update/" . $id;
        $url = $this->apiUrl . "/auop/update/" . $id;

        $date_creation = str_replace('/', '-', $request->date_creation);
        $date_creation = date('Y-m-d', strtotime($date_creation));


        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {

            Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($token)->withoutVerifying()->put($url, [
                'libelle' => $request->libelle,
                'date_creation' => $date_creation,
                'entite' => $request->entite,
                'localite' => $request->localite,
                'description' => $request->description


            ]);
        } elseif ($_SESSION['role'] === "ONG") {

            Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($token)->withoutVerifying()->put($url, [
                'libelle' => $request->libelle,
                'date_creation' => $date_creation,
                'entite' => $_SESSION['id_entite'],
                'localite' => $request->localite,
                'description' => $request->description


            ]);
        }

        return redirect('/groupements');
    }

    public function delete($id)
    {
        $token = strval($_SESSION['token']);
        // $url = "https://api.mlouma.org/api/auop/delete/" . $id;
        $url = $this->apiUrl . "/auop/delete/" . $id;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->delete($url);

        return redirect('/groupements');
    }
}
