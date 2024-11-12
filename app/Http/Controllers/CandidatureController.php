<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class CandidatureController extends Controller
{
    //
    protected $apiUrl;


    public function __construct()
    {
        // Initier le service de check Api des opportunites
        $this->apiUrl = config('app.api_url');
    }

    public function index()
    {
        // Recuperer la liste des opportunites
        $opportunites = $this->getAllOpportunities();
        $opportunites = $opportunites->object();
//        dd($opportunites);
        return view('gestion.opportunites.index', ['opportunites' => $opportunites]);
    }

    public function create()
    {
        // Creation d'un nouveau appels d'offres
        return view('gestion.opportunites.create');
    }

    public function store(Request $request)
    {
        $url = $this->apiUrl . '/appeloffre/create';
        $fileName = Storage::disk('public')->put('opportunite', $request->filepdf);
//        $pdfFilename = asset('storage/' . $fileName);
        $entreprise = in_array($_SESSION['role'], ['ADMIN', 'SUPERADMIN']) ? 1 : $_SESSION['id_entite'];
        $data = [
            'entreprise_id' => $entreprise,
            'secteur_id' => 1,
            'poste' => $request->poste,
            'libelle' => $request->libelle,
            'description' => $request->description,
            'location' => $request->location,
            'status' => "Soumis", // Cloture est l'autre option
            'contexte' => $request->contexte,
            'criteres' => $request->criteres,
            'lien' => $fileName,
            'type' => $request->offreType
        ];

        try {
            $response = $this->createOffer($url, $data);
        } catch (Exception $e) {
            return back()->withErrors("Erreur survenue de la creation de l'opportunite (API)");
        }
        if ($response->successful()) {
            return redirect(route('opportunites.index'));
        } else {
            return back()->withErrors('Erreur survenue lors du chargement du formulaire!');
        }
    }


    public function cloture($id)
    {
        // Get Element by Id
        $url = $this->apiUrl . '/appeloffre/update/' . $id;
        $opportunite = $this->getOpportunitieById($id)->object();
        $opportunite = $opportunite[0];
        $data = [
            'entreprise_id' => $opportunite->id_entreprise,
            'secteur_id' => $opportunite->id_secteur,
            'poste' => $opportunite->poste,
            'libelle' => $opportunite->libelle,
            'description' => $opportunite->description,
            'location' => $opportunite->location,
            'status' => "Cloture", // Soumis est l'autre option
            'contexte' => $opportunite->contexte,
            'criteres' => $opportunite->criteres,
            'lien' => $opportunite->lien,
            'type' => $opportunite->type
        ];
        // Change Statut
        try {
            $response = $this->createOffer($url, $data);
        } catch (Exception $e) {
            return back()->withErrors("Erreur survenue de l'api Update Call ");
        }
        if ($response->successful()) {
            return redirect(route('opportunites.index'));
        } else {
            return back()->withErrors('Erreur survenue lors du chargement du formulaire de mise a jour!');
        }
    }

    public function update($id)
    {
//      UPDATE  Offer TODO
    }

    public function details_offres($id)
    {
        $offre = $this->getOpportunitieById($id)->object()[0];
        $candidats = $this->getCandidatForOffer($id);
//        dd($candidats);
        // Checker la liste des candidats qui ont postules
        // Retourner les candidats qui n'ont pas ete rejetes
        return view('gestion.opportunites.details', [
            "offre" => $offre,
            "candidats" => $candidats
        ]);
    }

    public function rejetCandidature($email, $libelle)
    {
        // Send A mail Notification to Candidat
        // Todo Send A mail to a user for inform him that we will not continues with his apply
    }


    // Intermediate function

    private function createOffer($url, $data)
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->post($url, $data);

    }

    private function getAllOpportunities()
    {
        $url = $this->apiUrl . "/appeloffre";
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->get($url);
    }

    private function getOpportunitieById($id)
    {
        $url = $this->apiUrl . "/appeloffre/" . $id;
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withOptions(['verify' => false])
            ->withoutVerifying()
            ->get($url);
    }

    private function getCandidatForOffer($id)
    {
        $arr = [];
        $url = $this->apiUrl . "/candidat/" . $id;
        $arr = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->get($url)
            ->object();
//        dd($arr);
        return $arr;
    }
}
