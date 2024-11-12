<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ParametrageController extends Controller
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
        $reseaux = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/groupements");
        $reseaux  = (array)($reseaux->object());
        // print_r($reseaux);
        // exit;
        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {
            $users_url = $this->apiUrl . "/user";
        } elseif (in_array($_SESSION['role'], array("ONG","OP","GERANT"))) {
            $users_url = $this->apiUrl . "/showuser/entite/" . $_SESSION['id'];
        }
        $users = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($users_url);

        $users = (array)$users->object();

        $regions = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/regions");
        $regions = ($regions->object());

        $gerants = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($users_url);
        $gerants  = (array)($gerants->object());


        $pluvios = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/mlpluvio");
        $pluvios  = (array)($pluvios->object());

        $transversaux = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/transversal");
        $transversaux  = (array)($transversaux->object());

            // dd($users);
        return view('services.informations_climatiques.parametrage.index', compact('reseaux', "users", 'regions', 'gerants', 'pluvios', 'transversaux'));
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
    public function store_reseau(Request $request)
    {
        //
        $create_reseau = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post(
            $this->apiUrl . "/mlreseau/create",
            [
                "code" => $request->code,
                "nom" => $request->intitule,
                "actif" => $request->etat,
            ]
        );
        $res  = $create_reseau->object();
        if ($res) {
            $message =  "Réseau créé avec succés";
        } else {
            $message = "Erreur lors de la création de réseau";
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
    public function edit_reseau($id)
    {
        //
        $reseau_to_edit = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/mlreseau/" . $id);
        $res  = (array)($reseau_to_edit->object());

        return response($res, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_reseau(Request $request, $id)
    {
        //
        $create_reseau = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put(
            $this->apiUrl . "/mlreseau/update/" . $id,
            [
                "code" => $request->code,
                "nom" => $request->intitule,
                // "actif" =>$request->etat,
            ]
        );
        $res  = $create_reseau->object();
        if ($res) {

            $message =  "Réseau modifiée avec succés";
        } else {

            $message = "Erreur lors de la modification du réseau";
        }
        return response(['message' => $message], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_reseau($id)
    {
        //
        $delete_reseau = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->delete($this->apiUrl . "/mlreseau/delete/" . $id);
        $res  = $delete_reseau->object();
        if ($res) {
            $message =  "Réseau supprimé avec succés";
        } else {
            $message = "Erreur lors de la suppression du réseau";
        }
        return response(['message' => $message], 200);
    }
    // public function get_pluvio($id){
    //     $pluvio = Http::withHeaders([
    //         'Accept' => 'application/json',
    //         'Content-Type' => 'application/json',
    //     ])->withToken($_SESSION['token'])->withoutVerifying()->get("https://api.mlouma.org/api/mlpluvio/reseau/".$id);


    // }
}
