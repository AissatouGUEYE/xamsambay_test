<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CollecteController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  Todo Proposer une methode sur API regroupant les 2 API de sorte que
        //  Todo la liste des pluies sera accompagnees du cumul et des nombre d jr
        $collecte_data = array();
        $collected = array();
        $collectes = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/mlcollecte");
        $collectes = ($collectes->object());
        foreach ($collectes as $key => $value) {
            # code...
            // print_r($value->pluvio);

            $collecte_pluvio = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()
                ->get($this->apiUrl . "/mlcollecte/pluvio/" . $value->id_pluvio . "/" . $value->date_pluie);
            $collecte_pluvio = (array)$collecte_pluvio->object();

            // foreach ($collecte_pluvio as $key => $cp) {
            //     # code...
            //     array_push($collected,$cp->quantite);
            // }

            // $cumul =  array_sum($collected);
            $id = $value->id;
            $cumul = $collecte_pluvio['cumul'];
            $datep = date('d-m-Y', strtotime($value->date_pluie));
            $gestionnaire = $value->prenom . ' ' . $value->nom;
            $phenom = $value->nom_phenomene;
            $qte = $value->quantite;
            $total_jp = $collecte_pluvio['count'];
            $pluvio = $value->pluvio;
            $id_pluvio = $value->id_pluvio;
            $entite = $value->nom_entite;
            $groupement = $value->nom_groupement;
            $etat = $value->supprimer;

            $collected = [
                'id' => $id,
                'date' => $datep,
                'gestionnaire' => $gestionnaire,
                'phenom' => $phenom,
                'qte' => $qte,
                'total_jp' => $total_jp,
                'cumul' => $cumul,
                'pluvio' => $pluvio,
                "id_pluvio" => $id_pluvio,
                'groupement' => $groupement,
                'entite' => $entite,
                "etat" => $etat
            ];
            array_push($collecte_data, $collected);
        }
        $pluvios = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/mlpluvio");
        $pluvios = (array)($pluvios->object());

        $ops = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/groupements");
        $ops = (array)($ops->object());

        // dd($ops);

        $phenomenes = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/phenomene");
        $phenomenes = ($phenomenes->object());
        // dd($phenomenes);
        return view('services.informations_climatiques.collecte.index',
            compact('pluvios', 'collecte_data', 'ops', 'phenomenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //


        if (!empty($request)) {

            $data = [
                'datep' => date('Y-m-d', strtotime(str_replace('/', '-', $request->date))),
                'quantite' => intval($request->qte),
                'ml_phenomene' => intval($request->phenomene),
                // 'ml_campagne' => 6,
                // 'reseau' => $request->reseau,
                'pluvio' => isset($_SESSION['id_pluvio']) ? intval($_SESSION['id_pluvio']) : intval($request->pluvio),
                'profil' => $_SESSION['id']

                // "quantite": 100,
                // "datep": "30-01-2023",
                // "profil": 365,
                // "ml_phenomene": 1,
                // "pluvio": 54
            ];
            // dd($data);
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->post($this->apiUrl . "/sms/collecte", $data);
        }
        return response(['data' => $response->object(), 'message' => 'it works'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put($this->apiUrl . "/mlcollecte/actif/" . $id);

        return response(['message' => 'it s working'], 200);
    }
    // public function get_collecte_hist(Request $request)
    // {
    //     # code...
    // }

    // public function stream()
    // {


    // }
    public function send_collecte_sms($id)
    {


        $smsCollecte = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/sms_collecte/" . $id);
        $smsCollecte = $smsCollecte->object();

        $collecte = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/mlcollecte/" . $id);
        $collecte = $collecte->object();
        // dd($collecte);

        $collecte_pluvio = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()
            ->get($this->apiUrl . "/mlcollecte/pluvio/" . $collecte[0]->id_pluvio . "/" . $collecte[0]->date_pluie);
        $collecte_pluvio = $collecte_pluvio->object();
        // $collectes = Http::withHeaders([
        //     'Accept' => 'application/json',
        //     'Content-Type' => 'application/json',
        // ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/collecte_pluvio/" .$id_pluvio) ;
        // $collectes = $collectes->object();


        // $collected_pluvio_data = [];
        // foreach ($collectes as $key => $value) {
        //     # code...
        //     // print_r($value->pluvio);

        //     $collecte_pluvio = Http::withHeaders([
        //         'Accept' => 'application/json',
        //         'Content-Type' => 'application/json',
        //     ])->withToken($_SESSION['token'])->withoutVerifying()
        //     ->get($this->apiUrl . "/mlcollecte/pluvio/" . $value->id_pluvio . "/" . $value->date_pluie);
        //     $collecte_pluvio = (array) $collecte_pluvio->object();

        // foreach ($collecte_pluvio as $key => $cp) {
        //     # code...
        //     array_push($collected,$cp->quantite);
        // }

        // $cumul =  array_sum($collected);
        // $id = $value->id;
        // $cumul = $collecte_pluvio['cumul'];
        // $datep = date('d-m-Y', strtotime($value->date_pluie));
        // $gestionnaire = $value->prenom . ' ' . $value->nom;
        // $phenom =  $value->nom_phenomene;
        // $qte = $value->quantite;
        // $total_jp = $collecte_pluvio['count'];
        // $pluvio = $value->pluvio;
        // $id_pluvio = $value->id_pluvio;
        // $etat = $value->etat;


        //     $collected = [
        //     'id' => $id,
        //     'date' => $datep,
        //     'gestionnaire' => $gestionnaire,
        //     'phenom' => $phenom,
        //     'qte' => $qte,
        //     'total_jp' => $total_jp,
        //     'cumul' => $cumul,
        //     'pluvio' => $pluvio,
        //     "id_pluvio"=>$id_pluvio,
        //     "etat" => $etat

        // ];
        //     array_push($collected_pluvio_data, $collected);
        // }
        // $collected  = $collected_pluvio_data;

        // $producteurs = Http::withHeaders([
        //     'Accept' => 'application/json',
        //     'Content-Type' => 'application/json',
        // ])->withToken($_SESSION['token'])->withoutVerifying()
        // ->get($this->apiUrl . "/campagne/producteur/" . $id_pluvio);
        // $producteurs = count($producteurs->object());
        // dd($collected);
        return view("services.informations_climatiques.collecte.sms-collecte", compact("smsCollecte", "collecte", "collecte_pluvio"));

    }

    public function send(Request $request)
    {
        $data = [
            "alerte" => "Collecte",
            "id_utilisateur" => $_SESSION["id_utilisateur"],
            "id_pluvio" => $request->pluvio,
            "id_collecte" => $request->input("collecte"),
            "message" => $request->input("message"),
        ];

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post($this->apiUrl . "/sms/envoi/null/null/null/null/null/null/null/null/null/null", $data);

        // dd($response->object());
        if ($response->status() == 200) {

            $message = "Information diffusée avec succés";
        } else {
            $message = "Erreur survenue lors de la diffusion";
        }
        return response(["message" => $message, "status" => $response->status()], 200);
    }
}
