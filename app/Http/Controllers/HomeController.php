<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function index()
    {
        $acteur = '';
        // Call Api Stats
        $entityInfos = array();

        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->pool(fn(Pool $pool) => [
            $pool->withoutVerifying()->get($this->apiUrl . "/stat/entite"),
            $pool->withoutVerifying()->get($this->apiUrl . "/pack/TEST"),
            $pool->withoutVerifying()->get($this->apiUrl . "/type"),

        ]);

        $entitiesList = $request[0]->object();

        $entityInfos['OP'] = $entitiesList[0];
        $entityInfos['ONG'] = $entitiesList[1];
        $entityInfos['mloumer'] = $entitiesList[2];
        $entityInfos['individuel'] = $entitiesList[3];
        $entityInfos['transporteur'] = $entitiesList[4];
        $entityInfos['financier'] = $entitiesList[5];
        $entityInfos['producteur'] = $entitiesList[6];
        $entityInfos['gerant'] = $entitiesList[7];
        $entityInfos['ferme'] = $entitiesList[8];


        // Charger les pack du profils Individuel

        $packList = array();
        // $request = Http::withHeaders([
        //     'Accept' => 'application/json',
        //     'Content-Type' => 'application/json',
        // ])->withoutVerifying()->get($this->apiUrl . "/pack/TEST");
        $packList = $request[1]->object();

        foreach ($packList as $item) {
            $desc = $item->descriptionpack;
            $desc = str_replace("[", "", $desc);
            $desc = str_replace("]", "", $desc);
            $desc = str_replace("\"", "", $desc);
            $array_desc = explode(",", $desc);
            $item->descriptionpack = $array_desc;
        }


        // charger la liste des profils
        // $request = Http::withHeaders([
        //     'Accept' => 'application/json',
        //     'Content-Type' => 'application/json',
        // ])->withoutVerifying()->get($this->apiUrl . "/type");
        $profils = $request[2]->object();


        return view('landing.index', ['stats' => $entityInfos, 'pack_default' => $packList, 'profils' => $profils, 'acteur' => $acteur]);
    }

    public function contact_expert(Request $request)
    {
        // $inputs = $request->all();
        $nom = $request->name;
        $email = $request->email;
        // $phone = $request->phone;
        $subject = $request->subject;
        $message = $request->message;

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withOptions(['verify' => false])
            ->withoutVerifying()
            ->post($this->apiUrl . "/eb/create", [
                'nom' => $nom,
                'sujet' => $subject,
                'email' => $email,
                'description' => $message,
            ]);

        // return view('test', ['response' => $response->successful()]);

        if ($response->successful()) {

            $acteur = '';
            // Call Api Stats
            $entityInfos = array();
            $request = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withoutVerifying()->get($this->apiUrl . "/stat/entite");
            $entitiesList = $request->object();

            $entityInfos['OP'] = $entitiesList[0];
            $entityInfos['ONG'] = $entitiesList[1];
            $entityInfos['mloumer'] = $entitiesList[2];
            $entityInfos['individuel'] = $entitiesList[3];
            $entityInfos['transporteur'] = $entitiesList[4];
            $entityInfos['financier'] = $entitiesList[5];


            // Charger les pack du profils Individuel

            $packList = array();
            $request = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withoutVerifying()->get($this->apiUrl . "/pack/TEST");
            $packList = $request->object();

            foreach ($packList as $item) {
                $desc = $item->descriptionpack;
                $desc = str_replace("[", "", $desc);
                $desc = str_replace("]", "", $desc);
                $desc = str_replace("\"", "", $desc);
                $array_desc = explode(",", $desc);
                $item->descriptionpack = $array_desc;
            }

            // charger la liste des profils
            $request = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withoutVerifying()->get($this->apiUrl . "/type");
            $profils = $request->object();


            return view('landing.index', ['stats' => $entityInfos, 'pack_default' => $packList, 'profils' => $profils, 'acteur' => $acteur]);
        }
    }

    public function appels_offres()
    {
        $opportunites = $this->getAllOpportunities();
        // checker ceux qui ont le statut soumis
        return view('landing.offres.index', ['opportunites' => $opportunites]);
    }

    public function details_offres($id)
    {
        $opportuniteDetails = $this->getOpportunitieById($id)->object();
        return view('landing.offres.details', ['opportunite' => $opportuniteDetails[0]]);
    }

    public function postuler_offres(Request $request)
    {
        // dd($request->all());
        $url = $this->apiUrl . "/candidat/create";
        $fileName = Storage::disk('public')->put('candidatures/' . $request->idOpportunite, $request->cv);
        $data = [
            "candidate_id" => $request->idOpportunite,
            "prenom" => $request->prenom,
            "npom" => $request->nom,
            "email" => $request->email,
            "cv" => $fileName,
            "note" => 0
        ];
        $response = $this->postuler($url, $data);

        if ($response->successful()) {
            // Songer a y ajouter un message de confirmation de candidature To Do
            // Pousser plus loin en essayant de desactiver la candidature sous pretexte que le candidat a deja postule
            return redirect(route('opportunites.offres'));
        }
        if ($response->status() == 403) {
            return redirect(route('details.offres', ['id' => $request->idOpportunite]))->with('message', 'Vous avez deja postule à cet offre');
        }

        // Creer l'utilisateur
        // Inserer les donnees retourner sur la page des offres
        // Message de Confirmation de Candidature

    }

    // Intermediary Function
    private function getAllOpportunities()
    {
        $offers = [];
        $url = $this->apiUrl . "/appeloffre";
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withOptions(['verify' => false])
            ->withoutVerifying()
            ->get($url);
        $listOffer = $response->object();

        foreach ($listOffer as $offer) {
            if ($offer->statut === 'Soumis') $offers[] = $offer;
        }
        return $offers;
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

    private function postuler($url, $data)
    {
//        $urlP = "";
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withOptions(['verify' => false])
            ->withoutVerifying()
            ->post($url, $data);
    }
}
