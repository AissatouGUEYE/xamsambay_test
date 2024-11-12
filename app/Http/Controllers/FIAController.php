<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\ImportGerant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Illuminate\Http\Response;

class FIAController extends Controller
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

        $id = $this->getEntite();

        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/entite/users/' . $id);


        if ($request->status() == 200) {
            $users = $request->object();
            // dd($users);
            return view('gestion.utilisateurs.fia.index', compact('users'));
        } else {
            return view('layout.404');
        }
    }

    public function create()
    {
        //
        return view('gestion.utilisateurs.fia.create');
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
                if ($item->nom_entite == 'FIA') {
                    $id_entite = $item->id;
                    return $id_entite;
                }
            }
        }
    }

    public function store(Request $request)
    {

        // dd($request);

        // init error message
        $errmsg = '';
        // Check if pseudo and message have been entered
        if ($request->prenom == '') {
            $errmsg .= 'Veuillez renseigner le prenom du FIA svp.';
        }
        if ($request->nom == '') {
            $errmsg .= 'Veuillez renseigner le nom du FIA svp.';
        }

        if ($request->telephone == '') {
            $errmsg .= 'Veuillez renseigner le telephone du FIA svp.';
        }
        if ($request->email == '') {
            $errmsg .= 'Veuillez renseigner le email du FIA svp.';
        }

        if ($request->login == '') {
            $errmsg .= 'Veuillez renseigner le login du FIA svp.';
        }
        if ($request->password == '') {
            $errmsg .= 'Veuillez renseigner le mot de passe svp.';
        }
        $id = $this->getEntite();

        $result = '';

        if (!$errmsg) {

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
                    "entite" => $id,
                    "localite" => 24644,
                    "role" => 2
                ]
            );

            if ($create_fia->successful()) {
                $result = ' Compte créé avec succes! Un message lui a été envoyé.';
            } else {
                $errmsg = 'Erreur. Veuillez reesayer svp.';
                return response()->json($errmsg, 400);
            }
        } else {    
            return response()->json($errmsg, 400);
        }
        return response()->json($result);
    }

    public function storeRattachement(Request $request)
    {

        // dd($request->id);

        // init error message
        $errmsg = '';
        // Check if pseudo and message have been entered
        if (count($request->services) == 0) {
            $errmsg .= 'Veuillez renseigner au moins une commune svp.';
        }


        $result = '';

        if (!$errmsg) {

            foreach ($request->services as $key => $value) {
                // dd($value);
                // echo "Clé: " . $key . ", Valeur: " . $value . "<br>";

                $create_fia = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withToken($_SESSION['token'])->withoutVerifying()->post(
                    $this->apiUrl . "/fia_communes/create",
                    [
                        "fia" => intval($request->id),
                        "commune" => intval($value),

                    ]
                );
            }
            // dd($create_fia);

            if ($create_fia->successful()) {
                return redirect(route('get.fia.communes', ['id' => $request->id]))->with('message', 'Rattachement(s) réussi(s)! Un message lui a été envoyé.');
            } else {
                return redirect(route('get.fia.communes', ['id' => $request->id]))->with('message', 'Erreur. Veuillez reesayer svp.');
            }
        } else {
            return redirect(route('get.fia.communes', ['id' => $request->id]))->with('message', '' . $errmsg);
        }
    }

    public function storeRattachementIntrants(Request $request)
    {

        // init error message
        $errmsg = '';

        if ($request->type_intrant == '') {
            $errmsg .= "Veuillez renseigner le type d'intrant svp.";
        }
        if ($request->type_intrant == '1' || $request->type_intrant == '2') {
            if (count($request->produits) == 0) {
                $errmsg .= 'Veuillez renseigner au moins un produit svp.';
            }
        }
        $result = '';

        if (!$errmsg) {

            if ($request->type_intrant == '1' || $request->type_intrant == '2') {
                foreach ($request->produits as $key => $value) {
                    $create_fia = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ])->withToken($_SESSION['token'])->withoutVerifying()->post(
                        $this->apiUrl . "/fia_prod_intrant/create",
                        [
                            "fia" => intval($request->id),
                            "produit" => intval($value),
                            "type_intrant" => intval($request->type_intrant)

                        ]
                    );
                }
            } else {
                $create_fia = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withToken($_SESSION['token'])->withoutVerifying()->post(
                    $this->apiUrl . "/fia_prod_intrant/create",
                    [
                        "fia" => intval($request->id),
                        "produit" => null,
                        "type_intrant" => intval($request->type_intrant)

                    ]
                );
            }
            // dd($create_fia);

            if ($create_fia->successful()) {
                $message = '';
                return redirect(route('get.fia.intrants', ['id' => $request->id]))->with('message', 'Rattachement(s) réussi(s)! Un message lui a été envoyé.');
            } else {
                return redirect(route('get.fia.intrants', ['id' => $request->id]))->with('message', 'Erreur. Veuillez reesayer svp.');
            }
        } else {
            return redirect(route('get.fia.intrants', ['id' => $request->id]))->with('message', '' . $errmsg);
        }
    }

    public function listeCommune($id)
    {

        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/fia_communes/fia/' . $id);




        if ($request->status() == 200) {
            $users = $request->object();
            // dd($users);
            return view('gestion.utilisateurs.fia.rattachement.liste', compact('users', 'id'));
        } else {
            return view('layouts.404');
        }
    }

    public function listeIntrants($id)
    {

        $request_liste = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/fia_prod_intrant/fia/' . $id);


        if ($request_liste->status() == 200) {
            $intrants = $request_liste->object();

            // dd($users);
            return view('gestion.utilisateurs.fia.rattachement_intrants.index', compact('intrants', 'id'));
        } else {
            return view('layouts.404');
        }
    }

    public function rattachement()
    {

        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/fia_communes/fia/' . $_SESSION['id']);
        if ($request->status() == 200) {
            $users = $request->object();
            // dd($users);
            return view('gestion.utilisateurs.fia.rattachement.liste', compact('users'));
        } else {
            return view('layouts.404');
        }
    }

    public function rattachementIntrant()
    {

        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/fia_prod_intrant/fia/' . $_SESSION['id']);
        if ($request->status() == 200) {
            $intrants = $request->object();
            // dd($users);
            return view('gestion.utilisateurs.fia.rattachement_intrants.index', compact('intrants'));
        } else {
            return view('layouts.404');
        }
    }

    public function createRattachement($id)
    {

        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/communes');


        if ($request->status() == 200) {
            $communes = $request->object();
            // dd($users);
            return view('gestion.utilisateurs.fia.rattachement.create', compact('communes', 'id'));
        } else {
            return view('layouts.404');
        }
    }

    public function createRattachementIntrants($id)
    {

        $request_produits = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/produit');

        $request_intrants = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/intrants/types');



        if ($request_produits->status() == 200 && $request_intrants->status() == 200) {
            $produits = $request_produits->object();
            $intrants = $request_intrants->object();

            // dd($users);
            return view('gestion.utilisateurs.fia.rattachement_intrants.create', compact('produits', 'intrants', 'id'));
        } else {
            return view('layouts.404');
        }
    }
}
