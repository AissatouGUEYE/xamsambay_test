<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class IntrantDistributionController extends Controller
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
        $distributions = [];
        $idProfil = $_SESSION['id'];
        if (in_array($_SESSION['role'], ['ADMIN', 'SUPERADMIN', 'SERVICE_ETATIQUE'])) {
            // Profil Admin -- Or SERVICE_ETATIQUE // Display Option not Right Action Access
            $distributions = $this->getAllDistributions();
        } else {
            //   Profile FIA: When FIA display his Distribution List
            if ($_SESSION['nom_entite'] == 'FIA') $distributions = $this->getDistributionsForFIA($idProfil);
            //  Profile CC when CC have to Validate the Distribution
            if ($_SESSION['nom_type_entite'] == 'COMMISSION_CESSION') {
                $distributions = $this->getDistributionsForCC($_SESSION['id_entite']);
            }
        }
        //    dd($distributions);
        return view('gestion.distributions.index', [
            'distributions' => $distributions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        $idProfil = $_SESSION['id'];
        $produitList = $this->getProductList();
        $produits = [];
        foreach ($produitList as $item) {
            if (in_array($item->cat_produit, ['Intrants', 'Céréales', 'Légumineuses', 'Oléagineuses'])) {
                $produits[] = $item;
            }
        }
        $unites = $this->getUniteQuantity();
        $ccList = $this->getListOfCCForFIA();
        $typeIntrant = $this->getIntrant();
        return view('gestion.distributions.create', [
            "produits" => $produits,
            "unites" => $unites,
            "cc" => $ccList,
            "intrants" => $typeIntrant
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {

        $date = DateTime::createFromFormat('d/m/Y', $request->date_livraison);
        //     qte_notifiee = FIA
        // qte_placee = CC
        $idFia = $_SESSION['id'];
        $url = $this->apiUrl . "/distributions/create";
        $data = [
            "produit" => $request->produit,
            "qte_notifiee" => $request->quantite,
            "unite" => $request->unite,
            "date_livraison" => $date->format('Y-m-d H:i:s'),
            "id_fia" => $idFia,
            "commission" => $request->ccession,
            "type_intrant" => $request->type_intrant
        ];

        $response = $this->createDistribution($url, $data);
        if ($response->successful()) {
            return redirect(route('distributions.index'))->with('message', $response->object()->status);
        }

        return null;
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
        $distribution = $this->getDistribution($id);
        $distribution = $distribution[0];
        return view('gestion.distributions.valider_cc', compact('distribution'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     */


    public function update(Request $request)
    {
        // dd($request->all());

        // init error message
        $errmsg = '';
        $filename = '';

        // Check if pseudo and message have been entered
        if ($request->date_reception == null) {
            $errmsg .= 'Veuillez renseigner la date de reception svp.';
        }
        if ($request->fichier == null) {
            $errmsg .= 'Veuillez renseigner le justificatif svp.';
        }

        if ($request->qte_placee == '') {
            $errmsg .= 'Veuillez renseigner la quantite recue svp.';
        }
        $result = '';
        if (!$errmsg) {

            $filename = Storage::disk('public')->put('justificatif_distribution', $request->fichier);
            $update_ditribution = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->put(
                $this->apiUrl . "/distributions/update/" . $request->id,
                [
                    "date_reception" => $request->date_reception,
                    "qte_placee" => $request->qte_placee,
                    "stock" => $request->qte_placee,
                    "id_cc" => $_SESSION['id'],
                    "justificatif" => $filename

                ]
            );
            // dd($update_ditribution->object());
            if ($update_ditribution->successful()) {
                $result = 'Validation réussie !';
                return response()->json($result);
            } else {
                $errmsg = 'Erreur. Veuillez reesayer svp.';
                return response()->json($errmsg, 400);
            }
        } else {
            return response()->json($errmsg, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     */
    public function destroy($id)
    {
        //
    }

    protected function getAllDistributions()
    {
        $url = $this->apiUrl . "/distributions";
        return $this->getApiRequest($url);
    }

    protected function getDistribution($id)
    {

        $url = $this->apiUrl . "/distributions/" . $id;
        return $this->getApiRequest($url);
    }

    protected function getDistributionsForFIA($id)
    {
        $url = $this->apiUrl . "/distributions/fia/" . $id;
        return $this->getApiRequest($url);
    }

    protected function getDistributionsForCC($id)
    {
        $url = $this->apiUrl . "/distributions/commission/" . $id;
        return $this->getApiRequest($url);
    }

    protected function getProductList()
    {
        $url = $this->apiUrl . "/produit";
        return $this->getApiRequestWithoutToken($url);
    }

    protected function getIntrant()
    {
        $url = $this->apiUrl . "/intrants/types";
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

    protected function getListOfCCForFIA()
    {
        //        https://api.mlouma.org/api/commissions/fia/{id_fia}
        $idProfil = $_SESSION['id'];
        $url = $this->apiUrl . "/commissions/fia/" . $idProfil;
        return $this->getApiRequest($url);
    }

    protected function createDistribution($url, $data)
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post($url, $data);
    }

    private function getApiRequest($url)
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($url)->object();
    }


    private function getApiRequestWithoutToken($url)
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($url)->object();
    }
}
