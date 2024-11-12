<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class SoilAnalysisController extends Controller
{
    protected $apiUrl;
    protected $apiRfh;
    private $apiRfhKey;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
        $this->apiRfh = "https://ruralfarmershub.com";
        $this->apiRfhKey = "1438dac560c573f1e95fbfd245db812e86327a52";
    }


    public function index()
    {
        $idProfil = $_SESSION['id'];
        $response = $this->get_greenapi_abon($idProfil);

        $suscribe = $response['suscribe'];
        $pack_id = $response['pack_id'];

        $champs = $this->getChampsForProfil($idProfil);
        $typeAbonnement = $this->getTypeSuscribe();

        // $suscribe = 1;
        // $pack_id = 1;
        // dd($pack_id);
        return view('services.soilAnalysis.index', ["suscribe" => $suscribe, "pack_id" => $pack_id, 'champs' => $champs, "typeAbonnement" => $typeAbonnement]);
    }

    public function get_greenapi_abon($idProfil)
    {
        $suscribe = 0;
        $pack_id = null;

        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/greenapi_inscriptions/" . $idProfil . "/packs");

        $abonnementList = $request->object();

        foreach ($abonnementList as $abonnement) {
            foreach ($abonnement->pack->services as $service) {
                if (strtolower($service->service) === 'analyse du sol') {
                    $suscribe = 1;
                    $pack_id = $abonnement->pack->id;
                    break 2;
                }
            }
        }

        if ($suscribe == 1) {
            $today = Carbon::now();
            if ($abonnement->date_prochain_paiement > $today) {
                $suscribe = 2;
            }
        }

        return ['suscribe' => $suscribe, 'pack_id' => $pack_id];
    }


    public function createFarm()
    {
        $getCropUrl = $this->apiRfh . "/api-v1/farm/get-crops";
        $cropsResult = Http::get($getCropUrl)->object();
        $crops = $cropsResult->data;
        return view('services.soilAnalysis.farm.create', ["crops" => $crops]);
    }

    public function storeFarm(Request $request)
    {

        $urlRFH = $this->apiRfh . "/api-v1/farm/upload-farm";
        $urlCreateFarm = $this->apiUrl . "/champs/create";
        $idProfil = $_SESSION['id'];

        $validated = $request->validate([
            "lat1" => "required|string",
            "long1" => "required|string",
            "lat2" => "required|string",
            "long2" => "required|string",
            "lat3" => "required|string",
            "long3" => "required|string",
            "lat4" => "required|string",
            "long4" => "required|string",
            "libelle" => 'required|string',
            "produitData" => "required|string",
            "rendement" => "required|string"
        ]);

        $produitData = explode("/", $validated['produitData']);
        $idProduit = $produitData[0];
        $nomProduit = $produitData[1];

        $coordinates = $validated["lat1"] . ":" . $validated["long1"] . ",";
        $coordinates .= $validated["lat2"] . ":" . $validated["long2"] . ",";
        $coordinates .= $validated["lat3"] . ":" . $validated["long3"] . ",";
        $coordinates .= $validated["lat4"] . ":" . $validated["long4"];

        $jsonCcoordinates = json_encode($coordinates);

        // Store on RFH API

        $createRfhFarm = Http::asForm()
            ->post($urlRFH, [
                'api_key' => $this->apiRfhKey,
                "coordinates" => $coordinates
            ])->object();

        // Check Results
        //        "status": "success",
        //  "farm_id": "66cf3597054b0",
        //  "farm_size_formatted": "0.1306444ha"

        if ($createRfhFarm->status === "success") {
            // Store on MLouma API
            $createFarm = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])
                ->withOptions(['verify' => false])
                ->withoutVerifying()
                ->post($urlCreateFarm, [
                    "id_farm" => $createRfhFarm->farm_id,
                    'profil' => $idProfil,
                    "coordonnees" => $jsonCcoordinates,
                    "libelle" => $validated['libelle'],
                    'surface' => $createRfhFarm->farm_size_formatted,
                    'idProduit' => $idProduit,
                    'produit' => $nomProduit,
                    'rendement' => (int)$validated['rendement']
                ]);
            // dd($createFarm->object());
            if ($createFarm->successful()) {
                return redirect(route('soil.analysis'));
            }
        }
    }

    public function suscribeService(Request $request)
    {
        $request->validate([
            'forfait' => 'string|min:1'
        ]);

        $user_id = $_SESSION['id'];
        $date = date('Y-m-d H:i:s');
        $date = strtotime($date);
        $ref = 'ref-' . $this->generateRandomString(5) . $date;

        $command_name = "Analyse_Sol";

        $url = route('suscribe.validation', ['forfait' => $request->forfait]);
        $success_url = $url . '?success=1&reference=' . $ref;
        $cancel_url = $url;

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->post($this->apiUrl . "/paytech", [
                "item_name" => $command_name,
                "item_price" =>   100,
                "command_name" =>  $user_id . ' ' . $command_name,
                "item_id" => 6,
                "ref_command" => $ref,
                "env" => 'test',
                "success_url" => $success_url,
                "cancel_url" => $cancel_url
            ]);

        if ($response->successful()) {
            $paytech = $response->object();
            // dd($paytech);
            if ($paytech->success != -1) {
                return redirect($paytech->redirect_url);
            } else {
                return $paytech;
            }
        }

        //Passer par l'interface de paiement avant de proceder a la creation de l'abonnement

        $forfait = $request->forfait;
        $typeAbonnement = $this->getAbonnementById($forfait);
        $data = [
            'pack' => null,
            'nb_sms_restant' => 0,
            'nb_sec_voice_restant' => 0,
            'reference' => null,
            'effectif' => null,
        ];
        $data['type_abonnement'] = $request->forfait;
        $data['profil'] = $_SESSION['id'];
        $data['status'] = true;
        $data['service'] = $typeAbonnement[0]->service;
        $date = Carbon::now();
        $data['date_expiration'] = $date->addDays($typeAbonnement[0]->duree)->toDateTimeString();

        $response = $this->newAbonnement($data);
        if ($response->successful()) {
            return redirect(route('soil.analysis'));
        }
    }

    public function validation($id)
    {
        $souscris = false;
        $tarif = 1;
        $payer = false;
        $abonnementId = null;
        $abonnement = null;
        $idProfil = $_SESSION['id'];
        $pack = null;
        $nb_sms_restant = 0;
        $nb_sec_voice_restant = 0;
        $effectif = (isset($_GET['effectif'])) ? $_GET['effectif'] : 1;
        $ref = '';
        $statut = false;

        // Recuperer le pack a partir de l'acteur

        // $packList = $this->getPackByProfil($acteur);

        // suivant la liste des pack chosir le bon

        // foreach ($packList as $packItem) {

        //     if ($packItem->id == $id) {
        //         $pack = $packItem;
        //     }
        // }
        // checker si le parametre succes est passe
        // Si oui
        // Verifier si c'est a 1 si oui
        // Mettre a jour la table abonnement
        if (isset($_GET['success'])) {
            if ($_GET['success'] == 1 && isset($_GET['reference'])) {
                $ref = $_GET['reference'];

                // dd($eff);
                // if ($pack->canal === 'SMS') {
                //     $nb_sms_restant = $pack->nombre;
                // } else {
                //     $nb_sec_voice_restant = $pack->nombre;
                // }

                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withToken($_SESSION['token'])
                    ->withOptions(['verify' => false])
                    ->withoutVerifying()
                    ->post($this->apiUrl . "/abonnement/create", [
                        'pack' => $pack,
                        'profil' => $idProfil,
                        'reference' => $ref,
                        'status' => true,
                        'type_abonnement' => $id,
                        'service'=> 6
                    ]);

                // recuperer liste abonnement
                if ($response->successful()) {

                    $abonnementList = $this->getAbonnementList($idProfil);

                    //Update table Abonnement
                    foreach ($abonnementList as $value) {
                        if ($value->id_pack == $id) {
                            $abonnement = $value;
                        }
                    }

                    $response = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        // 'Authorization' => $_SESSION['token']
                    ])->withToken($_SESSION['token'])
                        ->withOptions(['verify' => false])
                        ->withoutVerifying()
                        ->put($this->apiUrl . "/abonnement/payer/" . $abonnement->id_abonnement);
                    // $message = $response->object()->message;
                    if ($response->successful()) {
                        return redirect(route('packs.validation', ['id' => $id, 'acteur' => '$acteur']));
                    }
                }
            }
        } elseif (isset($_GET['renew']) && isset($_GET['reference'])) {
            #Renouvellement Pack
            $ref = $_GET['reference'];
            // dd($ref);
            // $eff = $_GET['effectif'];
            $idAbonnement = $_GET['renew'];
            // dd($ref);
            #...
            $request = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/" . "abonnement/" . $idAbonnement);
            $abonnementArr = $request->object();
            $abonnement  = $abonnementArr[0];
            // dd($abonnement);

            $request = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withoutVerifying()->get($this->apiUrl . "/pack");
            $packList = $request->object();

            foreach ($packList as $item) {
                if ($item->id == $abonnement->id_pack) {
                    $pack = $item;
                }
            }
            // https://api.mlouma.org/api/abonnement/75/ref-UQIP123
            # Renouveller le Pack API... idAbonnement & New Ref

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/" . "abonnement/" . $idAbonnement . "/" . $ref);

            # Si ok retourner vers validation
            if ($response->successful()) {
                return redirect(route('packs.validation', ['id' => $id, 'acteur' => '$acteur']));
            }
        }

        $packList = $this->getPackByProfil('$acteur');

        foreach ($packList as $packItem) {
            if ($packItem->id == $id) {
                $pack = $packItem;
            }
        }

        $abonnementList = $this->getAbonnementList($idProfil);
        foreach ($abonnementList as $value) {
            if (!$souscris && $value->id_pack == $pack->id) {
                $souscris = true;
                $payer = $value->payer;
                $abonnementId = $value->id_abonnement;
                $effectif = $value->effectif;
                $tarif = $value->pricing * $effectif;
                $abonnement = $value;
            }
        }

        // Recuperer la liste des produits
        $productList = $this->getProduit();
        // recuperer liste des marches
        $marketList = $this->getMarkets();
        // recuperer liste des cours
        $stuffList = $this->getStuff();

        // dd($abonnementId);
        $modules = $this->getServiceAbonnement($abonnementId);
        // dd($modules);

        //songer a faire une redirection et faire un clean de l'url
        return view('gestion.packs.validation', ['pack' => $pack, 'souscris' => $souscris, 'payer' => $payer, 'idAbonnement' => $abonnementId, 'effectif' => $effectif, 'tarif' => $tarif, 'produits' => $productList, 'markets' => $marketList, 'cours' => $stuffList, 'abonnement' => $abonnement, 'modules' => $modules]);
    }

    public function generateRandomString($length = 25)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function analyseFarm($id)
    {
        $urlAnalyse = $this->apiRfh . "/api-v1/crop-watch/get-soil-composition";
        $depth = "0-20";
        $farm = $this->getFarmById($id);
        // dd($farm);
        //Todo In Comment the real Code for doing Soil Analysis
        $analyseFarm = Http::asForm()
            ->post($urlAnalyse, [
                'api_key' => $this->apiRfhKey,
                "farm_id" => $farm[0]->id_farm,
                "depth" => $depth
            ])->object();

        // dd($analyseFarm->object());
        if ($analyseFarm->status === "success") {
            $result = $analyseFarm->data;
            // $result = $analyseFarm;
            $save = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])
                ->withOptions(['verify' => false])
                ->withoutVerifying()
                ->post($this->apiUrl . "/analyses/create", [
                    "champ" => $id,
                    "resultat" => json_encode($result)
                ]);
            return view('services.soilAnalysis.farm.resultAnalyse', ["result" => $result]);
        } else {
            return redirect(route('soil.analysis'))->with('message2', $analyseFarm->message);
        }
        //Todo End In Comment the real Code for doing Soil Analysis


        // $result = (object)[
        //     "depth" => "0-20",
        //     "clay" => 30,
        //     "silt" => 13,
        //     "sand" => 55,
        //     "organic_matter" => 17.2,
        //     "salinity" => 0,
        //     "carbon_content" => 48.4,
        //     "ph_level" => 4.6,
        //     "effective_cec" => 11.2,
        //     "nitrogen" => 1.5,
        //     "phosphorus" => 8,
        //     "potassium" => 43.7,
        //     "sulphur" => 11.2,
        //     "alumunium" => 108.9,
        //     "magnesium" => 17.2,
        //     "calcium" => 120.5,
        //     "zinc" => 3.1,
        //     "stone" => 0.2,
        //     "bulk_density" => 1.3
        // ];
        return view('services.soilAnalysis.farm.resultAnalyse', ["result" => $result]);
    }
    public function analyseFarmWithRecommendation($id)
    {
        $urlAnalyseWithRecommendation = $this->apiRfh . "/api-v1/crop-watch/get-fertlizer-wiz";
        $depth = "0-20";
        $farm = $this->getFarmById($id);
        $crop_id = $farm[0]->idProduit;
        $yield = $farm[0]->rendement;
        $url = "https://ruralfarmershub.com/api-v1/crop-watch/get-fertilzer-wiz?api_key=" . $this->apiRfhKey . "&farm_id=" . $farm[0]->id_farm . "&depth=" . $depth . "&crop_id=" . $crop_id . "&yield=" . $yield;

        $analyseFarm = Http::get($url)->object();
        // dd($analyseFarm->object());
        if ($analyseFarm->status === "success") {
            // $result = $analyseFarm->data;
            $result = $analyseFarm;
            $save = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])
                ->withOptions(['verify' => false])
                ->withoutVerifying()
                ->post($this->apiUrl . "/analyses/create", [
                    "champ" => $id,
                    "resultat" => json_encode($result)
                ]);
            return view('services.soilAnalysis.farm.resultAnalyse', ["result" => $result]);
        } else {
            return redirect(route('soil.analysis'))->with('message2', $analyseFarm->message);
        }
        //Todo End In Comment the real Code for doing Soil Analysis


        // $result = (object)[
        //     "depth" => "0-20",
        //     "clay" => 30,
        //     "silt" => 13,
        //     "sand" => 55,
        //     "organic_matter" => 17.2,
        //     "salinity" => 0,
        //     "carbon_content" => 48.4,
        //     "ph_level" => 4.6,
        //     "effective_cec" => 11.2,
        //     "nitrogen" => 1.5,
        //     "phosphorus" => 8,
        //     "potassium" => 43.7,
        //     "sulphur" => 11.2,
        //     "alumunium" => 108.9,
        //     "magnesium" => 17.2,
        //     "calcium" => 120.5,
        //     "zinc" => 3.1,
        //     "stone" => 0.2,
        //     "bulk_density" => 1.3
        // ];
        return view('services.soilAnalysis.farm.resultAnalyse', ["result" => $result]);
    }

    public function logAnalyseFarm($idFarm)
    {
        $urlLog = $this->apiUrl . "/analyses/champ/" . $idFarm;
        $logs = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->get($urlLog)->object();
        foreach ($logs as $log) {
            $log->resultat = json_decode($log->resultat);
            $log->coordonnees = json_decode($log->coordonnees);
        }
        //        dd($logs);
        return view('services.soilAnalysis.farm.logAnalysis', ["logs" => $logs]);
    }

    private function getChampsForProfil($idProfil)
    {
        $urlGetFarm4Profil = $this->apiUrl . "/champs/profil/" . $idProfil;
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->get($urlGetFarm4Profil)->object();
    }

    private function getTypeSuscribe()
    {
        $urlTypeSuscribe = $this->apiUrl . "/type_abonnement";
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->get($urlTypeSuscribe)->object();
    }

    private function getAbonnementById($forfait)
    {
        $urlTypeSuscribe = $this->apiUrl . "/type_abonnement/" . $forfait;
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->get($urlTypeSuscribe)->object();
    }

    private function newAbonnement(array $data)
    {
        $urlSuscribe = $this->apiUrl . "/abonnement/create";
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->post($urlSuscribe, $data);
    }

    private function getIfAbonnement4ProfilExist()
    {
        $url = $this->apiUrl . "/abonnementprofil/" . $_SESSION['id'];
        $today = Carbon::now();
        $listAbonnement = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->get($url)->object();

        foreach ($listAbonnement as $abonnement) {
            if ($abonnement->date_expiration > $today) {
                return true;
            }
        }
        return false;
    }

    private function getFarmById($id)
    {
        $url = $this->apiUrl . "/champs/" . $id;
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->get($url)->object();
    }
}
