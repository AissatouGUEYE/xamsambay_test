<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class MarketController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    //
    public function index()
    {
        $marches = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/market")->json();

        // return $marches;

        $type_marches = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/type_market")->json();

        return view('gestion.market.liste', compact('marches', 'type_marches'));
    }

    public function map()
    {

        $initialMarkers =[];

        $regions = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/regions")->json();

        $type_marches = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/type_market")->json();



        $marches = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/market")->json();

        $nb_marches = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/marketcount")->json();

        // return $nb_marches;
        // $marches = json_decode($marches, true);

        foreach ($marches as $row) {

            $longitude = $row['longitude'];
            $latitude = $row['latitude'];
            $name = $row['market'];
            $id_region = $row['id_region'];
            $region = $row['region'];
            $id_departement = $row['id_departement'];
            $departement = $row['departement'];
            $id_commune = $row['id_commune'];
            $commune = $row['commune'];
            $id_localite = $row['id_localite'];
            $localite = $row['localite'];
            $id_type_market = $row['id_type_market'];
            $type_market = $row['type_market'];
            // return $name;

            if (($longitude !== null) && ($latitude !== null)){
                $data = [
                    'position' => [
                        'lat' => $latitude,
                        'lng' => $longitude
                    ],
                    'draggable' => false,
                    'name' => $name,
                    'id_region' => $id_region,
                    'region' => $region,
                    'id_departement' => $id_departement,
                    'departement' => $departement,
                    'id_commune' => $id_commune,
                    'commune' => $commune,
                    'id_localite' => $id_localite,
                    'localite' => $localite,
                    'id_type_market' => $id_type_market,
                    'type_market' => $type_market

                ];

                $value = array_push($initialMarkers, $data);
            }
        }
        return view('services.cartographie.market', compact('initialMarkers', 'regions', 'type_marches', 'nb_marches'));
    }

    public function store(Request $request)
    {
        $token = strval($_SESSION['token']);
        $url = $this->apiUrl . "/market/create";

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->post($url, [
            'market' => $request->market,
            'code_market' => $request->code,
            'jour_louma' => $request->market_day,
            'localite' => $request->localite,
            'type_market' => $request->type_market,
            "latitude" => $request->latitude,
            "longitude" => $request->longitude
        ]);

        return redirect('/prix-du-marche/marches');
    }

    public function modifier($id)
    {
        $market = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/market/" . $id);

        $type_marches = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/type_market")->json();

        return view('gestion.market.edit', compact('market', 'type_marches'));
    }

    public function edit(Request $request)
    {
        $token = strval($_SESSION['token']);
        $id = $request->id;
        
        $url = $this->apiUrl . "/market/update/" . $id;

        // return $url;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->put($url, [

            'market' => $request->market,
            'localite' => $request->localite,
            'type_market' => $request->type_market,
            'code_market' => $request->code,
            'jour_louma' => $request->market_day,
            "latitude" => $request->latitude,
            "longitude" => $request->longitude


        ]);

        return redirect('/prix-du-marche/marches');
    }
}
