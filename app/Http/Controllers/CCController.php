<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CCController extends Controller
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
        $id = $this->getTypeEntite();

        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/entitetype/' . $id);


        if ($request->status() == 200) {
            $users = $request->object();
            // dd($users);
            return view('gestion.utilisateurs.cc.index', compact('users'));
        } else {
            return view('layout.404');
        }
    }

    public function create()
    {
        //
        return view('gestion.utilisateurs.cc.create');
    }

    public function store(Request $request)
    {
        // init error message
        $errmsg = '';
        // Check if pseudo and message have been entered

        if ($request->nom == '') {
            $errmsg .= 'Veuillez renseigner le nom de la Cc svp.';
        }

        if ($request->localite == '') {
            $errmsg .= 'Veuillez renseigner la localite  svp.';
        }

        $id = $this->getTypeEntite();

        $result = '';

        if (!$errmsg) {

            $create_cc = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->post(
                $this->apiUrl . "/entite/create",
                [
                    "nom_entite" => $request->nom,
                    "description" => $request->description == null ? null : $request->description,
                    "type_entite" => $id,
                    "date_debut" => $request->date_debut == null ? null : $request->date_debut,
                    "duree" => $request->duree == null ? null : $request->duree,
                    "localite" => $request->localite
                ]
            );

            if ($create_cc->successful()) {
                $result = ' Commission créé avec succes! ';
                return response()->json($result);
            } else {
                $errmsg = 'Erreur. Veuillez reesayer svp.';
                return response()->json($errmsg, 400);
            }
        } else {
            return response()->json($errmsg, 400);
        }
    }

    public function getLocalite($id)
    {


        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/getentity/" . $id);

        if ($request->successful()) {
            $entite = $request->object();
            return $entite[0]->id_localite;
        } else
            return -1;
    }

    public function getEntite()
    {

        // check entite fia
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/getentity");
        // dd($request);
        $id_entite = -1;
        if ($request->status() == 200) {

            $entite = $request->object();

            foreach ($entite as $item) {
                if ($item->nom_typentite == 'COMMISSION_CESSION') {
                    $id_entite = $item->type_entite;
                    return $id_entite;
                }
            }
        }
    }

    public function getTypeEntite()
    {
        // check entite fia
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/type");
        // dd($request);
        $id_type_entite = -1;
        if ($request->status() == 200) {

            $entite = $request->object();

            foreach ($entite as $item) {
                if ($item->nom_typentite == 'COMMISSION_CESSION') {
                    $id_type_entite = $item->id;
                    return $id_type_entite;
                }
            }
        }
    }

    public function getMember($id)
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/entite/users/' . $id);


        if ($request->status() == 200) {
            $users = $request->object();
            //            dd($users);
            return view('gestion.utilisateurs.cc.membre.index', compact('users', 'id'));
        } else {
            return view('layout.404');
        }
    }

    public function storeMember(Request $request)
    {
        // recuperer la localite de sa commission
        // $id_localite = $this->getLocalite($request->entite);
        // dd($id_localite);

        //        dd($request->all());

        // init error message
        $errmsg = '';
        // Check if pseudo and message have been entered
        if ($request->prenom == '') {
            $errmsg .= 'Veuillez renseigner le prenom svp.';
        }
        if ($request->nom == '') {
            $errmsg .= 'Veuillez renseigner le nom svp.';
        }

        if ($request->telephone == '') {
            $errmsg .= 'Veuillez renseigner le telephone svp.';
        }
        if ($request->email == '') {
            $errmsg .= 'Veuillez renseigner le email svp.';
        }
        if (!$request->role) {
            $errmsg .= 'Veuillez renseigner le role svp.';
        }

        if ($request->login == '') {
            $errmsg .= 'Veuillez renseigner le login svp.';
        }
        if ($request->password == '') {
            $errmsg .= 'Veuillez renseigner le mot de passe svp.';
        }
        //        $id = $this->getEntite();
        $result = '';
        if (!$errmsg) {

            $id_localite = $this->getLocalite($request->entite);
            //            dd($id_localite);

            $create_fia = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->post(
                $this->apiUrl . "/register",
                [
                    "prenom" => $request->prenom,
                    "nom" => $request->nom,
                    "fonction" => null,
                    "sexe" => null,
                    "telephone" => $request->telephone,
                    "email" => $request->email,
                    "login" => $request->login,
                    "password" => $request->password,
                    "entite" => $request->entite,
                    "localite" => $id_localite,
                    "role" => $request->role
                ]
            );
            // dd($create_fia->object()->message);
            if ($create_fia->successful()) {
                return redirect(route('get.membre.cc', ['id' => $request->entite]))->with('message', 'Compte créé avec succes! Un message lui a été envoyé.');
            } else {
                $errmsg = 'Erreur:' . $create_fia->object()->message;
                return redirect(route('get.membre.cc', ['id' => $request->entite]))->with('message', $errmsg);
            }
        } else {
            return redirect(route('get.membre.cc', ['id' => $request->entite]))->with('message', $errmsg);
        }
    }


    public function eb()
    {


        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/eb/filtre_com/null/3/null/null/null/null/' . $_SESSION['id_commune'] . '/null');

        if ($request->successful()) {
            $eb = $request->object();
            // dd($eb);
            return view('services.expression_de_besoin.cc.index', compact('eb'));      # code...

            # code...
        }
    }
}
