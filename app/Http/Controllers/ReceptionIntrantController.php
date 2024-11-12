<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ReceptionIntrantController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receptions = [];
//        dd($_SESSION['role']);

        if ($_SESSION['role'] == "COMMISSION_CESSION") {
            $receptions = $this->getReceptionsForCC($_SESSION['id_entite']);
        } elseif ($_SESSION['role'] == "OP") {
            $receptions = $this->getReceptionsForOP($_SESSION['id']);
        } else {
            $receptions = $this->getAllReceptions();
        }
    //    dd($receptions);
        return view('gestion.receptions.index', [
            "receptions" => $receptions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $distributions = $this->getDistributionForCC($_SESSION['id_entite']);
        $ebValid = $this->getExpBesoinValid();
        $unites = $this->getUniteQuantity();
        $recepteurs = $this->getRecepteurs($_SESSION['id_commune']);

        return view("gestion.receptions.create", [
            "distributions" => $distributions,
            "ebesoin" => $ebValid,
            "recepteurs" => $recepteurs,
            "unites" => $unites
        ]);
    }

    public function validationReception($id)
    {
        $reception = $this->getReceptionById($id);
        $reception = $reception[0];
        $unites = $this->getUniteQuantity();
        return view('gestion.receptions.validate', [
            "reception" => $reception,
            "unites" => $unites
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $date = DateTime::createFromFormat('d/m/Y', $request->date_livraison);
        $besoin = null;
        $qte_desiree = null;
        $id_op = null;
        $groupement = null;

        if (isset($request->ebesoin) && $request->ebesoin != "-1" && $request->ebesoin != null) {
            $besoinList = explode("/", $request->ebesoin);
            $besoin = $besoinList[0];
            $qte_desiree = $besoinList[1];
        }

        // Prendre en compte le recepteur
        if (isset($request->recepteur) && $request->recepteur != "-1" && $request->recepteur != null) {
            $recepteurList = explode("/", $request->recepteur);
            $id_op = $recepteurList[0];
            if ($recepteurList[1] != "null") {
                $groupement = $recepteurList[1];
            }
        }

        $data = [
            "distribution" => $request->distribution,
            "eb" => $besoin,
            "id_cc" => $_SESSION['id'],
            "groupement" => $groupement, // Se baser sur ce param pour recuperer l'id op et le groupement
            "id_resp_op" => $id_op, // Se baser sur ce param pour recuperer l'id op et le groupement
            "commission" => $_SESSION['id_entite'],
            "qte_desiree" => $qte_desiree, // Le prendre de exp de besoin sinon null
            "qte_reçue" => $request->quantite,
            "unite_cc" => $request->unite,
            "date_livraison" => $date->format('Y-m-d H:i:s'),
        ];

        $url = $this->apiUrl . "/receptions/create";
        // Call Post API
        $response = $this->createReception($url, $data);
        if ($response->successful()) {
            return redirect(route('receptions.index'));
        }

        return null;
    }

    public function storeValidation(Request $request)
    {
        $filename = Storage::disk('public')->put('justificatif_reception', $request->fichier);
        $date = DateTime::createFromFormat('d/m/Y', $request->date_livraison);
        $data = [
            "qte_livree" => $request->quantite,
            "unite_op" => $request->unite,
            "date_reception" => $date->format('Y-m-d H:i:s'),
            "facture" => $filename
        ];
        $url = $this->apiUrl . "/receptions/update/" . $request->idReception;
        $response = $this->updateReception($url, $data);
        if ($response->successful()) {
            return redirect(route('receptions.index'));
        }
        return null;
    }


    /**
     * Display the specified resource.
     * @param  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     * @param  $id
     */
    public function destroy($id)
    {
    }

    protected function getDistributionForCC($idEntite)
    {
        $url = $this->apiUrl . "/distributions/commission/" . $idEntite;
        return $this->getApiRequest($url);
    }

    protected function getExpBesoinValid()
    {
        $url = $this->apiUrl . '/eb/filtre_com/null/3/1/null/null/null/' . $_SESSION['id_commune'] . '/null';
        return $this->getApiRequest($url);

    }

    protected function getUniteQuantity()
    {
        $unites = [];
        $idQuantite = 1;
        $idVolume = 2;
        $url = $this->apiUrl . "/unite/type/";
        $uniteQuantite = $this->getApiRequest($url . $idQuantite);
        $uniteVolume = $this->getApiRequest($url . $idVolume);
        foreach ($uniteQuantite as $item) {
            $unites[] = $item;
        }
        foreach ($uniteVolume as $item) {
            $unites[] = $item;
        }
        return $unites;
    }

    protected function getRecepteurs($idCommune)
    {
        $recepteurs = [];
        $urlIndiv = $this->apiUrl . "/communes/individuels/" . $idCommune;
        $urlRop = $this->apiUrl . "/communes/resp_op/" . $idCommune;
        $indivList = $this->getApiRequest($urlIndiv);
        $rOPList = $this->getApiRequest($urlRop);
        foreach ($rOPList as $item) {
            $recepteurs[] = $item;
        }
        foreach ($indivList as $item) {
            $recepteurs[] = $item;
        }

        return $recepteurs;
    }

    protected function getAllReceptions()
    {
        $url = $this->apiUrl . "/receptions";
        return $this->getApiRequest($url);
    }

    protected function getReceptionsForCC($idEntite)
    {
        $url = $this->apiUrl . "/receptions/commission/" . $idEntite;
        return $this->getApiRequest($url);
    }

    protected function getReceptionsForOP($idProfil)
    {
        $url = $this->apiUrl . "/receptions/resp_op/" . $idProfil;
        return $this->getApiRequest($url);
    }

    protected function getReceptionById($id)
    {
        $url = $this->apiUrl . "/receptions/" . $id;
        return $this->getApiRequest($url);
    }

    protected function getAllsReception()
    {

    }

    protected function createReception($url, $data)
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post($url, $data);
    }

    protected function updateReception($url, $data)
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put($url, $data);
    }

    private function getApiRequest($url)
    {
        return Http::withHeaders([
            'Accept' => 'application / json',
            'Content-Type' => 'application / json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($url)->object();
    }
}
