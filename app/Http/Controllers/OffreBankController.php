<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OffreBankController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    //
    public function index()
    {
        $offres = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/offrebanque")->json();

        $unites = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite/type/4")->json();

        $banques = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/entitetype/8")->json();

        // return $offres;
        return view('services.offre_de_credit.liste', compact('offres', 'unites', 'banques'));
    }

    public function create()
    {
        $unites = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite/type/4")->json();

        $banques = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/entitetype/8")->json();

        return view('services.offre_de_credit.create', compact('unites', 'banques'));
    }

    public function store(Request $request)
    {
        $token = strval($_SESSION['token']);
        $url = $this->apiUrl . "/offrebanque/create";

        $date = str_replace('/', '-', $request->date);
        $date = date('Y-m-d', strtotime($date));

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->post($url, [
            'profil' => $_SESSION['id'],
            'description' => $request->description,
            'nom' => $request->nom,
            'entite' => $request->entite,
            'plancher' => $request->plancher,
            'plafond' => $request->plafond,
            'unite' => 7,
            'date' => $date,

            'duree' => $request->duree,
            'taux' => $request->taux,
            'frais_adhesion' => $request->frais_adhesion,
            'apport_personnel' => $request->apport_personnel,
            'frais_dossier' => $request->frais_dossier,
            'frais_gestion' => $request->frais_gestion,
            'assurance' => $request->assurance,
            'garantie' => $request->garantie,

        ]);

        // return redirect('/langue');
        return redirect('/banques/offre-de-credit');
    }

    public function modifier($id)
    {
        $banques = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/entitetype/8")->json();

        $unites = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite")->json();

        $offre = Http::withoutVerifying()->withToken($_SESSION['token'])->get($this->apiUrl . "/offrebanque/" . $id);

        // return $offre;
        return view('services.offre_de_credit.edit', compact('offre', 'unites', 'banques'));
    }

    public function edit(Request $request)
    {
        $token = strval($_SESSION['token']);
        $id = $request->id;
        $url = $this->apiUrl . "/offrebanque/update/" . $id;

        $date = str_replace('/', '-', $request->date);
        $date = date('Y-m-d', strtotime($date));

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->put($url, [

            'profil' => $_SESSION['id'],
            'nom' => $request->nom,
            'description' => $request->description,
            'entite' => $request->entite,
            'plancher' => $request->plancher,
            'plafond' => $request->plafond,
            'unite' => 7,
            'date' => $date,

            'duree' => $request->duree,
            'taux' => $request->taux,
            'frais_adhesion' => $request->frais_adhesion,
            'apport_personnel' => $request->apport_personnel,
            'frais_dossier' => $request->frais_dossier,
            'frais_gestion' => $request->frais_gestion,
            'assurance' => $request->assurance,
            'garantie' => $request->garantie,

        ]);

        return redirect('/banques/offre-de-credit');
    }
}
