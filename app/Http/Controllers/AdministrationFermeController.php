<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AdministrationFermeController extends Controller
{
    protected $apiUrl;
    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function index()
    {

        $demandes = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/ferme_administration/' . $_SESSION['id_entite'])->json();

        // dd($demandes);


        return view('gestion.ferme.administration.index', compact('demandes'));
    }

    public function create(Request $request)
    {
        // dd($request);
        $filename = null;
        if ($request->fichier) {

            $filename = Storage::disk('public')->put('demandes', $request->fichier);
        }

        $create_demande = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post(
            $this->apiUrl . "/ferme_administration/create",
            [
                "type" => $request->type,
                "demandeur" => $_SESSION['id'],
                "motif" => $request->motif,
                "date_debut" => $request->date_debut,
                "date_fin" => $request->date_fin,
                "justificatif" => $filename,

            ]
        );

        if ($create_demande->successful()) {
            return response()->json(['message' => 'Reussie'], 200);
            # code...
        } else
            return response()->json(['message' => 'Echec'], 404);
    }

    public function edit($id)
    {

        $demande_request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/ferme_administration/demande/' . $id);
        // dd($demande);
        $demande = $demande_request->object();
        // $demande=$demande=[0];
        // dd($demande);

        if ($_SESSION['profil'] == 'MANAGER' || $_SESSION['profil'] == 'PRESIDENT') {

            # code...
            return view('gestion.ferme.administration.comment', compact('demande'));
        } else
            return view('gestion.ferme.administration.edit', compact('demande'));
    }


    public function update(Request $request)
    {
        $filename = null;
        if ($request->fichier) {

            $filename = Storage::disk('public')->put('demandes', $request->fichier);
        }
        $update_demande = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put(
            $this->apiUrl . "/ferme_administration/update/" . $request->id,
            [
                "type" => $request->type,
                "demandeur" => $_SESSION['id'],
                "etat" => 0,
                "motif" => $request->motif,
                "date_debut" => $request->date_debut,
                "date_fin" => $request->date_fin,
                "justificatif" => $filename

            ]
        );

        if ($update_demande->successful()) {
            return response()->json(['message' => 'Reussie'], 200);
            # code...
        } else
            return response()->json(['message' => 'Echec'], 404);
    }

    public function comment(Request $request)
    {

        $update_demande = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put(
            $this->apiUrl . "/ferme_administration/commenter/" . $request->id,
            [
                "commentaire" => $request->commentaire,


            ]
        );

        if ($update_demande->successful()) {
            return response()->json(['message' => 'Reussie'], 200);
            # code...
        } else
            return response()->json(['message' => 'Echec'], 404);
    }
}
