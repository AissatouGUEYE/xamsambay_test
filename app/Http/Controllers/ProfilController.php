<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfilController extends Controller
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
        return view('gestion.utilisateurs.profil.create');
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
        $userInfos = array();
        $entite = '';
        $pluvio = array();
        $Gpt = [];
        //
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withoutVerifying()->get($this->apiUrl . "/getentity");
        $entities = $request->object();
        //     print_r($entities);
        //     exit;


        $userToEdit = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/user/get/" . $id);

        foreach ($userToEdit->object() as $data) {
            $entite = $data->nom_typentite;
        }
        // $entite=$userToEdit[0]->nom_typentite;
        // dd($entite);
        if ($_SESSION['role'] == "FERME AGRICOLE" || $entite == "FERME AGRICOLE") {
            $userToEdit = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/user/get/" . $id);

            // dd($userToEdit->object());
            foreach ($userToEdit->object() as $data) {
                # code...
                $userInfos['id'] = $data->id;
                $userInfos['prenom'] = $data->prenom;
                $userInfos['nom'] = $data->nom;
                $userInfos['dt_naiss'] = $data->dt_naiss;
                $userInfos['fonction'] = $data->fonction;
                $userInfos['sexe'] = $data->sexe;
                $userInfos['adresse'] = $data->adresse;
                $userInfos['telephone'] = $data->telephone;
                $userInfos['email'] = $data->email;
                $userInfos['login'] = $data->login;
                // $userInfos['logo'] = $data->logo;
                $userInfos['sit_matrimonial_id'] = $data->id_sit_matrimonial;
                // $userInfos['actif'] = $data->actif;
                $userInfos['utilisateur'] = $data->id;
                $userInfos['entite'] = $data->role;
                $userInfos['localite'] = $data->localite;
                $userInfos['nom_entite'] = $data->nom_entite;
                // $userInfos['description'] = $data->description;
                $userInfos['type_entite'] = $data->id_typentite;
                $userInfos['nom_typentite'] = $data->nom_typentite;
                $userInfos['id_commune'] = $data->idcommune;
                $userInfos['departement'] = $data->departement;
                $userInfos['id_departement'] = $data->iddept;
                $userInfos['commune'] = $data->commune;
                $userInfos['id_localite'] = $data->idlocalite;
                $userInfos['region'] = $data->region;
                $userInfos['id_region'] = $data->idregion;
                $userInfos['pays'] = $data->pays;
                $userInfos['id_pays'] = $data->idpays;
                $userInfos['sit_matrimonial'] = $data->sit_matrimonial;
                $userInfos['role'] = $data->role;
                $userInfos['id_role'] = $data->id_role;
             


            }
            $userToEdit = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/showuser/" . $id);
            foreach ($userToEdit->object() as $data) {
                # code...
                $userInfos['logo'] = $data->logo;
                $userInfos['actif'] = $data->actif;
            }
            //  dd($userInfos);
            return view('gestion.ferme.profils.edit', compact('userInfos'));
        } else {
            $userToEdit = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/showuser/" . $id);

            foreach ($userToEdit->object() as $data) {
                # code...
                $userInfos['id'] = $data->id;
                $userInfos['prenom'] = $data->prenom;
                $userInfos['nom'] = $data->nom;
                $userInfos['dt_naiss'] = $data->dt_naiss;
                $userInfos['fonction'] = $data->fonction;
                $userInfos['sexe'] = $data->sexe;
                $userInfos['adresse'] = $data->adresse;
                $userInfos['telephone'] = $data->telephone;
                $userInfos['email'] = $data->email;
                $userInfos['login'] = $data->login;
                $userInfos['logo'] = $data->logo;
                $userInfos['sit_matrimonial_id'] = $data->sit_matrimonial_id;
                $userInfos['actif'] = $data->actif;
                $userInfos['utilisateur'] = $data->utilisateur;
                $userInfos['entite'] = $data->entite;
                $userInfos['localite'] = $data->localite;
                $userInfos['nom_entite'] = $data->nom_entite;
                $userInfos['description'] = $data->description;
                $userInfos['type_entite'] = $data->type_entite;
                $userInfos['nom_typentite'] = $data->nom_typentite;
                $userInfos['id_commune'] = $data->idcommune;
                $userInfos['departement'] = $data->departement;
                $userInfos['id_departement'] = $data->iddept;
                $userInfos['commune'] = $data->commune;
                $userInfos['id_localite'] = $data->idlocalite;
                $userInfos['region'] = $data->region;
                $userInfos['id_region'] = $data->idregion;
                $userInfos['pays'] = $data->pays;
                $userInfos['id_pays'] = $data->idpays;
                $userInfos['sit_matrimonial'] = $data->sit_matrimonial;
                $userInfos['role'] = $data->role;
                $userInfos['groupement'] = $data->groupement;
                $userInfos['nom_groupement'] = $data->nom_groupement;
                $userInfos['pluvio'] = $data->pluvio;
            }
            $rolesList = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/roles");

            $roles = $rolesList->object();
            $roleGpt = array();

            if ($_SESSION['role'] == "ONG") {

                // Groupement
                $GptList = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    // 'Authorization' => $_SESSION['token']
                ])->withToken($_SESSION['token'])->withoutVerifying()
                    ->get($this->apiUrl . "/entite/get/groupements/" . $_SESSION['id_entite'])->object();

                // dd($GptList[0]->OP);

                $Gpt = $GptList[0]->OP;

                foreach ($roles as $key => $value) {
                    if (str_contains($value->role, "OP") || str_contains($value->role, "UOP") || str_contains($value->role, "AUOP")) {
                        array_push($roleGpt, $value);
                    }
                }
            }

            if ($_SESSION['role'] == "ADMIN" || $_SESSION['role'] == "SUPERADMIN") {
                // Groupement

                if (in_array($userInfos['nom_typentite'], ['AUOP', 'UOP', 'OP', 'ONG', 'SUPERVISEUR', 'GERANT'])) {

                    $Gpt = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        // 'Authorization' => $_SESSION['token']
                    ])->withToken($_SESSION['token'])->withoutVerifying()
                        ->get($this->apiUrl . "/nom_groupement/OP")->object();
                }


                if ($userInfos['nom_typentite'] == "ONG") {
                    foreach ($roles as $key => $value) {
                        if (str_contains($value->role, "OP") || str_contains($value->role, "UOP") || str_contains($value->role, "AUOP")) {
                            array_push($roleGpt, $value);
                        }
                    }
                } else {
                    $roleGpt = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        // 'Authorization' => $_SESSION['token']
                    ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/roles/type_entite/" . $userInfos['nom_typentite'])->object();
                }
            }
            // https://api.mlouma.org/api/mlpluvio/reseau/idGpt
            if ($userInfos['groupement']) {
                $pluvios = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    // 'Authorization' => $_SESSION['token']
                ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/mlpluvio/reseau/" . $userInfos['groupement']);
                $pluvio = $pluvios->object();
                // dd($pluvio);
            }


            // dd($roleGpt);
            // dd($Gpt);

            return view('gestion.utilisateurs.profil.edit', compact('userInfos', 'entities', 'roleGpt', 'Gpt', 'pluvio'));
        }
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
    }
}
