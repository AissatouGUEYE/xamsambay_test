<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;



class FermeController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function liste_ferme()
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/entitetype/21");

        if ($request->status() == 404) {
            return view('layout.404');
        } else {
            $entite = $request->object();

            return view('gestion.ferme.liste', compact('entite'));
        }
    }

    public function details_ferme($id)
    {

        $_SESSION['ferme'] = $id;
        $nom = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/getentity/" . $id);
        if ($request->status() == 404) {
            return view('layout.404');
        }
        $nom = $request->object();
        $stats = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme_stat_data/" . $id . "/2022");
        $stats = $request->object();

        $activite = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/activites_ferme/" . $id);
        $activite = $request->object();

        $prod = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/produits/ferme_produits/" . $id);
        $prod = $request->object();

        $stock = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/ferme_stocks/" . $id);
        $stock = $request->object();

        $eb = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/ferme_eb/" . $id);
        $eb = $request->object();

        $vente = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/ferme_ventes/" . $id);
        $vente = $request->object();

        $request_dec = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/ferme_decaissements/" . $id);
        $decaissement = $request_dec->object();


        return view('gestion.ferme.details', compact('nom', 'stats', 'activite', 'prod', 'id', 'stock', 'eb', 'vente', 'decaissement'));
    }

    public function index()
    {
        //  dd($_SESSION['profil']);


        $roles = $this->getRole();
        $users = array();
        if ($_SESSION['role'] === "FERME AGRICOLE") {
            # code...

            $request = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/entite/users/' . $_SESSION['id_entite']);

            if ($request->status() == 404) {
                return view('layout.404');
            } else {
                $users = $request->object();
                return view('gestion.ferme.profils.liste', compact('roles', 'users'));
            }
        }
    }

    public function createUserByAdmin($id)
    {
        // dd($id);

        return view('gestion.ferme.createFermeUser', compact('id'));
    }

    public function store_ferme(Request $request)
    {
        $create_ferme = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post(
            $this->apiUrl . "/entite/create",
            [
                "nom_entite" => $request->nomFerme,
                "description" => $request->descriptionFerme,
                "type_entite" => 21,
                "date_debut"=>$request->date_debut==null ?null: $request->date_debut,
                "duree"=>$request->duree==null ?null: $request->duree,
                "localite" => $request->localite

            ]
        );

        if ($create_ferme->status() == 404) {
            return view('layout.404');
        } else {
            $res  = $create_ferme->object();
            // dd($res);
            if ($res->status == 'Entité enregistré avec succés') {
                $message =  "Ferme créé avec succés";
            } else {
                $message = "Erreur lors de la création de la ferme";
            }
            return response(['message' => $message], 200);
        }
    }

    public function store_ferme_list(Request $request)
    {

        if (!$request->glist) {
            return response(['message' => "Erreur survenue lors du chargement du fichier!"], 404);
        } else {
            # code...


            $this->validate($request, ['glist' => 'required|file|mimes:xls,xlsx']);

            set_time_limit(600);

            $the_file = $request->file('glist');


            try {
                $spreadsheet = IOFactory::load($the_file->getRealPath());
                $sheet        = $spreadsheet->getActiveSheet();
                $row_limit    = $sheet->getHighestDataRow();
                $column_limit = $sheet->getHighestDataColumn();
                $row_range    = range(2, $row_limit);
                $column_range = range('J', $column_limit);
                $startcount = 0;
                $data = array();
                foreach ($row_range as $row) {

                    if ($sheet->getCell('A' . $row)->getValue()) {
                        $data[] = [
                            "nom_entite" => $sheet->getCell('A' . $row)->getValue(),
                            "description" => $sheet->getCell('B' . $row)->getValue(),
                            "type_entite" => 21,
                            "localite" => 24633
                        ];
                    } else {

                        break;
                    }
                }

                for ($i = 0; $i < count($data); $i++) {
                    $create_ferme = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ])->withToken($_SESSION['token'])->withoutVerifying()->post(
                        $this->apiUrl . "/entite/create",
                        $data[$i]
                    );
                    if ($create_ferme->successful()) {

                        $startcount++;
                    } else
                        break;
                }
            } catch (Exception $e) {
                return response(['message' => "Erreur survenue lors du chargement du fichier!"], 404);
                //throw $th;
            }

            return response(['message' => "Liste ajoutée avec succés. Nbr Total de ligne:" . $sheet->getHighestDataRow() . "Nb lignes insérées: " . $startcount], 200);
        }
    }

    public function store(Request $request)
    {
        // dd($request);
        $email = null;
        if ($request->email)
            $email = $request->email;

        $create_user = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post(
            $this->apiUrl . "/register",
            [
                "prenom" => $request->prenom,
                "nom" => $request->nom,
                "fonction" => $request->fonction,
                "sexe" => $request->sexe,
                "telephone" => $request->telephone,
                "login" => $request->login,
                "password" => $request->password,
                "email" => $email,
                "localite" => $request->localite,
                "entite" => $_SESSION['id_entite'],
                "role" => $request->entite,
            ]
        );
        if ($create_user->status() == 404) {
            return view('layouts.404');
        } else {
            $res  = $create_user->object();
            // dd($res);
            if ($res) {
                $message =  "Utilisateur créé avec succés";
            } else {
                $message = "Erreur lors de la création de l'utilisateur";
            }
            return response(['message' => $message], 200);
        }
    }

    public function store_by_admin(Request $request)
    {
        //  dd($request);

        //je dois y ajouter l'id entite correspondante
        $create_user = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post(
            $this->apiUrl . "/register",
            [
                "prenom" => $request->prenom,
                "nom" => $request->nom,
                "fonction" => $request->fonction,
                "sexe" => $request->sexe,
                "telephone" => $request->telephone,
                "login" => $request->login,
                "password" => $request->password,
                "email" => $request->email,
                "localite" => $request->localite,
                "entite" => $request->entite,
                "role" => $request->entite_f,
            ]
        );

        if ($create_user->status() == 404) {
            return view('layouts.404');
        } else {
            $res  = $create_user->object();
            // dd($res);
            if ($res) {
                $message =  "Utilisateur créé avec succés";
            } else {
                $message = "Erreur lors de la création de l'utilisateur";
            }
            return response(['message' => $message], 200);
        }
    }

    public function profil()
    {
        $userAuth = Auth::user();
        // dd($userAuth);
        $user = $this->getUserbyId($userAuth->id);
        $userFerme = $this->getUserFermebyId($userAuth->id);
        return view('gestion.ferme.profils.view', compact('user', 'userFerme'));
    }





    public function create()
    {
        return view('gestion.ferme.profils.create');
    }

    public function add_role()
    {
        return view('gestion.ferme.role.create');
    }

    public function show($id)
    {
        $user = $this->getUserbyId($id);
        $userFerme = $this->getUserFermebyId($id);
        return view('gestion.ferme.profils.view', compact('user', 'userFerme'));
    }
    //

    public function getEntity()
    {

        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {  # code...
            $request = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withoutVerifying()->get($this->apiUrl . '/getentity');
        } elseif ($_SESSION['role'] === "ONG") {
            $request = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/showuser/entite/' . $_SESSION['id_entite']);
        } elseif ($_SESSION['role'] === "FERME AGRICOLE") {
            $request = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/showuser/entite/' . $_SESSION['id_entite']);
        }
        $entitiesList = $request->object();
        return view('gestion.utilisateurs.role.liste', compact('entitiesList'));
    }


    public function edit_ferme($id)
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/getentity/" . $id);

        $ferme = $request->object();
        $ferme = $ferme[0];

        return view('gestion.ferme.edit_ferme', compact('ferme'));
    }

    public function update_ferme(Request $request)
    {


        $create_ferme = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put(
            $this->apiUrl . "/editentity/" . $request->id,
            [
                "nom_entite" => $request->nomFerme,
                "description" => $request->descriptionFerme,
                "type_entite" => 21,
                "date_debut"=>$request->date_debut,
                "duree"=>$request->duree,
                "localite" => null

            ]
        );
        if ($create_ferme->status() == 404) {
            return view('layout.404');
        } else {
            $res  = $create_ferme->object();
            $message =  "Ferme modifié avec succés";

            // if ($res->status == 'Entité modifié avec succés') {
            //     $message =  "Ferme créé avec succés";
            // } else {
            //     $message = "Erreur lors de la modification de la ferme";
            // }
            return response(['message' => $message], 200);
        }
    }





    public function getRole()
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/gettypent");
        $roleList = $request->object();
        return $roleList;
    }

    public function getUsers()
    {
        $usersList = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => $_SESSION['token']
        ])->withoutVerifying()->get($this->apiUrl . "/user");

        $usersList = $request->object();

        return $usersList;
    }
    public function getUserbyId($id)
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/user/get/" . $id);
        $entitiesList = $request->object();
        return $entitiesList;
    }
    public function getUserFermebyId($id)
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/showuser/" . $id);
        $entitiesList = $request->object();
        return $entitiesList;
    }

    public function delete_ferme($id)
    {
        $delete_ferme = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->delete($this->apiUrl . "/deletent/" . $id);
        $res  = $delete_ferme->object();

        if ($res == 'Ferme supprimé avec succés') {
            $message =  "Ferme supprimé avec succés";
        } else {
            $message = "Erreur lors de la suppression de la ferme";
        }
        return response(['message' => $message], 200);
    }





    public function edit(Request $request)
    {
        $user_edit = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put(
            $this->apiUrl . "/utilisateur/updateferme/$request->utilisateur",
            [
                "prenom" => $request->prenom,
                "nom" => $request->nom,
                "fonction" => $request->fonction,
                "sexe" => $request->sexe,
                "telephone" => $request->telephone,
                "login" => $request->login,
                "email" => $request->email,
                "localite" => $request->localite,
                "entite" => $_SESSION['id_entite'],
                "role" => $request->entite,
            ]
        );

        $res  = $user_edit->object();
        // dd($res->status);
        if ($res->status == 'Utilisateur modifier avec succés') {
            return redirect(route('ferme'));
        } else {

            $message = "Erreur lors de la modification de l'utilisateur";
            return response(['message' => $message], 200);
        }
    }
}
