<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TacheFermeController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function index()
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme_taches/" . $_SESSION['id_entite']);



        if (($request->status() == 200)) {
            // liste user
            $user_request = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/entite/users/' . $_SESSION['id_entite']);
            if (($request->status() == 200)) {
                $users = $user_request->object();
                $taches = $request->object();
                return view('gestion.ferme.tache.index', compact('users', 'taches'));
            } else {
                return view('layout.404');
            }
        } else
            return view('layout.404');
    }

    public function create(Request $request)
    {

       

        $filename=null;
        if ($request->fichier) {
           
            $filename = Storage::disk('public')->put('taches', $request->fichier);
        }

        $create_tache = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post(
            $this->apiUrl . "/ferme/taches/create",
            [
                "nom" => $request->nom,
                "assignateur" => $_SESSION['id'],
                "assigne" => $request->assigne,
                "date_debut" => $request->date_debut,
                "fin_prev"=> $request->fin_prev,
                "date_fin" => $request->date_fin,
                "justificatif"=>$filename,
                "description"=>$request->description

            ]
        );
        // dd($create_tache->successful());

        if ($create_tache->successful()) {
            return response()->json(['message' => 'Reussie'], 200);
            # code...
        } else
            return response()->json(['message' => 'Echec'], 404);
    }

    public function edit($id)
    {

        $tache_request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/ferme/taches/' . $id);
        if (($tache_request->status() == 200)) {
            $user_request = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/entite/users/' . $_SESSION['id_entite']);
            if ($user_request->status() == 200) {
                $tache = $tache_request->object();
                $users = $user_request->object();
                $tache = $tache[0];
                return view('gestion.ferme.tache.edit', compact('tache', 'users'));
                # code...
            } else {
                return view('layout.404');
            }
        } else {
            return view('layout.404');
        }
    }

    public function update(Request $request)
    {
        // dd($request);
        $filename=null;
        if ($request->fichier) {
           
            $filename = Storage::disk('public')->put('taches', $request->fichier);
        }
      

        $create_tache = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put(
            $this->apiUrl . "/ferme/taches/update/" . $request->id,
            [
                "nom" => $request->nom,
                "assignateur" => $_SESSION['id'],
                "assigne" => $request->assigne,
                "date_debut" => $request->date_debut,
                "date_fin" => $request->date_fin,
                "fin_prev"=> $request->fin_prev,
                "statut" => $request->statut,
                "description"=>$request->description,
                "justificatif"=>$filename

            ]
        );

        if ($create_tache->successful()) {
            return response()->json(['message' => 'Reussie'], 200);
            # code...
        } else
            return response()->json(['message' => 'Echec'], 404);
    }
}
