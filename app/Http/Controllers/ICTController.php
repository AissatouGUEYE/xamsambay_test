<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ICTController extends Controller
{
    protected $apiUrl;
    protected $api_ict;
    protected $apiRfh;
    private $apiRfhKey;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
        $this->api_ict = "http://carnet2champ.storekarite.com/api";

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

        return view('services.ict.index', ["suscribe" => $suscribe, "pack_id" => $pack_id, 'champs' => $champs]);
    }


    public function createFarm()
    {
        $getCropUrl = $this->apiRfh . "/api-v1/farm/get-crops";
        $cropsResult = Http::get($getCropUrl)->object();
        $crops = $cropsResult->data;
        return view('services.ict.farm.create', ["crops" => $crops]);
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
                if (strtolower($service->service) === 'Gestion des carnet de champs(ICT4DV)') {
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
}
