<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PluvioController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function map()
    {

        $initialMarkers =[];

        $regions = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/regions")->json();

        $groupements = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/groupements")->json();

        $pluvios = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/mlpluvio")->json();

        // return $pluvios;
        $nb_pluvios = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/mlpluviocount")->json();

        // return $pluvios;

        foreach ($pluvios as $row) {

            $longitude = $row['longitude'];
            $latitude = $row['latitude'];
            $name = $row['localite'];
            $id_region = $row['id_region'];
            $region = $row['region'];
            $id_departement = $row['id_departement'];
            $departement = $row['departement'];
            $id_commune = $row['id_commune'];
            $commune = $row['commune'];
            $id_localite = $row['id_localite'];
            $localite = $row['localite'];
            $id_groupement = $row['id_groupement'];
            $groupement = $row['libelle'];
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
                    'id_groupement' => $id_groupement,
                    'groupement' => $groupement
    
                ];
    
                $value = array_push($initialMarkers, $data);
            }
            
        }
        return view('services.cartographie.pluvio', compact('initialMarkers', 'regions', 'groupements', 'nb_pluvios'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $create_pluvio = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post(
            $this->apiUrl . "/mlpluvio/create",
            [
                "profil" => $request->gerant,
                "reseau" => $request->reseau,
                "localite" => $request->localite,
                "latitude" => $request->latitude,
                "longitude" => $request->longitude

            ]
        );
        $res  = $create_pluvio->object();
        if ($res) {
            $message =  "Pluvio ajouté avec succés";
        } else {
            $message = "Erreur lors de l'ajout  du pluvio";
        }
        return response(['message' => $message], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $pluvio_to_edit = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/mlpluvio/" . $id);
        $res  = (array)($pluvio_to_edit->object())[0];
        if ($res) {
            $message =  "Pluvio créé avec succés";
        } else {
            $message = "Erreur lors de la création du gerant";
        }
        return response($res, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //
        // print_r(["profil" => $request->gerant,
        // "reseau" => $request->reseau,
        // "localite" =>$request->localite]);
        //  exit;
        $update_gerant = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put($this->apiUrl . "/mlpluvio/update/" . $id, [
            'profil' => $request->gerant,
            'reseau' => $request->reseau,
            'localite' => $request->localite,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);
        $res  = $update_gerant->object();
        if ($res) {
            $message =  "Pluvio modifié avec succés";
        } else {
            $message = "Erreur lors de la modification du pluvio";
        }
        return response(['message' => $message], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $delete_gerant = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->delete($this->apiUrl . "/mlpluvio/delete/" . $id);
        $res  = $delete_gerant->object();
        if ($res) {
            $message =  "Pluvio supprimé avec succés";
        } else {
            $message = "Erreur lors de la suppression du Pluvio";
        }
        return response(['message' => $message], 200);
    }
}
