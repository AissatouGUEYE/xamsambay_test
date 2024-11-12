<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CampagneMeteoController extends Controller
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
        $campagnes_meteo = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/mlcampagne");
        $campagnes_meteo = $campagnes_meteo->object();
        return view('services.informations_climatiques.campagne-meteo.index', compact('campagnes_meteo'));
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
        //
        $date_debut = str_replace('/', '-', $request->debut);
        $date_debut = date('Y-m-d', strtotime($date_debut));
        $date_fin = str_replace('/', '-', $request->fin);
        $date_fin = date('Y-m-d', strtotime($date_fin));



        $req =  Http::withoutVerifying()->withToken($_SESSION['token'])->post($this->apiUrl . "/mlcampagne/create", [

            'debut' => $date_debut,
            'fin' => $date_fin,
        ]);
        if ($req) {
            # code...
            return redirect('/information-climatique/campagne');
        } else {
            return $req;
        }
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

        $req = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/mlcampagne/" . $id);
        if ($req) {
            # code...
            $campagnes_to_edit = (array)$req->object();

            // $date_debut = str_replace('-','/',$campagnes_to_edit['debut']);
            $date_debut = date('d/m/Y', strtotime($campagnes_to_edit['debut']));
            // $date_fin = str_replace('-','/',$campagnes_to_edit['fin']);
            $date_fin = date('d/m/Y', strtotime($campagnes_to_edit['fin']));

            $res = array('id' => $campagnes_to_edit['id'], 'debut' => $date_debut, 'fin' => $date_fin, 'message' => 'OK');
        } else {
            $res = array('message' => 'Erreur lors du chargement des données');
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


        // echo "date_debut: ".$request->debut.",date fin: ".$request->fin."id: ".$id;
        // exit;
        //
        // echo ' cool' ;
        // exit;
        $date_debut = str_replace('/', '-', $request->debut);
        $date_debut = date('Y-m-d', strtotime($date_debut));
        $date_fin = str_replace('/', '-', $request->fin);
        $date_fin = date('Y-m-d', strtotime($date_fin));



        $req =  Http::withoutVerifying()->withToken($_SESSION['token'])->put($this->apiUrl . "/mlcampagne/update/" . $id, [

            'debut' => $date_debut,
            'fin' => $date_fin,
        ]);
        if ($req) {
            $message = 'Campagne modifiée avec succés';
        } else {
            $message = 'Erreur lors de la modification de la campagne';
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
        $req =  Http::withoutVerifying()->withToken($_SESSION['token'])->delete($this->apiUrl . "/mlcampagne/delete/" . $id);
        if ($req) {
            # code...
            return response(['message' => 'Campagne supprimée avec succés']);
        } else {
            # code...
            return response(['message' => 'Erreur lors de la suppression de la campagne']);
        }
    }
}
