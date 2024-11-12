<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EcoulementIntrantController extends Controller
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
        // Get List Of Ecoulement by id ROP
        // Todo Recuperer la liste des ecoulement effectuees par le ROP
        $idProfil = $_SESSION['id'];
        $ecoulements = [];
        if (in_array($_SESSION['role'], ['ADMIN', 'SUPERADMIN', 'SERVICE_ETATIQUE'])) {
            $ecoulements = $this->getALlEcoulementList();
        } elseif ($_SESSION['role'] == "OP") {
            $ecoulements = $this->getEcoulementListForOP($idProfil);
//            $ecoulements = $this->getALlEcoulementList();
        }
//        dd($ecoulements);
        return view('gestion.ecoulements.index', [
            'ecoulements' => $ecoulements
        ]);
    }

    public function create()
    {
        $producteurs = [];
        $groupement = $_SESSION['groupement'];
        $idProfil = $_SESSION['id'];
        $unites = $this->getUniteQuantity();
        $ebList = $this->getValidateEBForProfil($idProfil);
        $receptionsList = $this->getReceptionValid($idProfil);
        $producteurs = $this->getProducteurByGrp($groupement);
//        dd($receptionsList);
        return view('gestion.ecoulements.create',
            [
                'unites' => $unites,
                'ebList' => $ebList,
                'producteurs' => $producteurs,
                "receptions" => $receptionsList
            ]
        );
    }

    public function store(Request $request)
    {
        $prenomProd = "";
        $nomProd = "";
        $telephoneProd = "";
        $date = DateTime::createFromFormat('d/m/Y', $request->date_livraison);
        $url = $this->apiUrl . "/hist_distributions/create";
        if ($request->producteur) {
            $prodList = explode("/", $request->producteur);
            $idProd = trim(explode(":", $prodList[0])[1], " ");
            $telephoneProd = trim(explode(":", $prodList[1])[1], " ");
            $prenomProd = trim(explode(":", $prodList[2])[1], " ");
            $nomProd = trim(explode(":", $prodList[3])[1], " ");
        }
        $data = [
            "profil" => $_SESSION['id'],
            "qte_reçue" => $request->quantite,
            "unite" => $request->unite,
            "reception" => $request->reception,//$request->idreception
            "eb" => $request->ebesoin,
            "id_prod" => (int)$idProd,
            "date" => $date->format('Y-m-d H:i:s'),
            "tel_prod" => $telephoneProd,
            "nom_prod" => $nomProd,
            "prenom_prod" => $prenomProd
        ];
//        dd($data);
        $response = $this->createDistribution($url, $data);
        if ($response->successful()) {
            return redirect(route('ecoulements.index'));
        }

        return null;
    }

    /**
     * Display the specified resource.
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param  $id
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
     * @param $id
     */
    public function destroy($id)
    {
        //
    }

    protected function getALlEcoulementList()
    {
        $url = $this->apiUrl . "/hist_distributions";
        return $this->getApiRequest($url);

    }

    protected function getEcoulementListForOP($idProfil)
    {
        $url = $this->apiUrl . "/hist_distributions/profil/" . $idProfil;
        return $this->getApiRequest($url);

    }

    protected function getValidateEBForProfil($idProfil)
    {
//        https://api.mlouma.org/api/eb/traites/profil/{id_profil}
        $url = $this->apiUrl . "/eb/traites/profil/" . $idProfil;
        return $this->getApiRequest($url);
    }

    protected function getReceptionValid($idProfil)
    {
        $url = $this->apiUrl . "/receptions/resp_op/" . $idProfil;
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


    protected function createDistribution($url, $data)
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post($url, $data);
    }

    protected function getProducteurByGrp($groupement)
    {
        $url = $this->apiUrl . "/groupements/membres/" . $groupement;
        return $this->getApiRequest($url);

    }


    private function getApiRequest($url)
    {
        return Http::withHeaders([
            'Accept' => 'application / json',
            'Content-Type' => 'application / json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($url)->object();
    }


    private function getApiRequestWithoutToken($url)
    {
        return Http::withHeaders([
            'Accept' => 'application / json',
            'Content-Type' => 'application / json',
        ])->withoutVerifying()->get($url)->object();
    }
}
