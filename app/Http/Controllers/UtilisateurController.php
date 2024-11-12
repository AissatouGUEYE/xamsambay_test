<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UtilisateurController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }


    public function index()
    {
        // dd($_SESSION['role']);

        $roles = $this->getRole();
        $users = array();
        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {
            # code...
            $request = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/user");
        } elseif ($_SESSION['role'] === "ONG") {
            # code...
            $request = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/showuser/entite/' . $_SESSION['id_entite']);
        }



        $users = $request->object();
        return view('gestion.utilisateurs.profil.liste', compact('roles', 'users'));
    }

    public function create()
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/roles/');

        $roles = $request->object();
        // dd($roles);

        return view('gestion.utilisateurs.profil.create', compact('roles'));
    }

    public function show($id)
    {
        $user = $this->getUserbyId($id);
        return view('gestion.utilisateurs.profil.view', compact('user'));
    }

    public function profil()
    {
        $userAuth = Auth::user();
        // dd($userAuth);
        $user = $this->getUserbyId($userAuth->id);
        $sms = 0;
        $appel = 0;
        $idProfil = $_SESSION['id'];
        // https://api.mlouma.org/api/abonnement/profil/80

        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/abonnement/profil/" . $idProfil);
        $abonnementList = $request->object();

        foreach ($abonnementList as $key => $item) {
            $sms += $item->nb_sms_restant;
            $appel += $item->nb_sec_voice_restant;
        }
        return view('gestion.user.index', ['user' => $user, 'sms' => $sms, 'appel' => $appel]);
    }

    public function filter(Request $request)
    {
        $inputs = $request->all();
        $sexe = $inputs['users-list-verified'];
        $role = $inputs['users-list-role'];
        $statut = $inputs['users-list-status'];

        $token = strval($_SESSION['token']);
        $url = $this->apiUrl . "/search/" . $sexe . "/" . $role . "/" . $statut;
        $users = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->get($url);
        $users = $request->object();

        $roles = $this->getRole();
        return view('gestion.utilisateurs.profil.liste', ['roles' => $roles, 'users' => $users]);
    }

    //
    public function getEntities()
    {
        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {
            $request = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withoutVerifying()->get($this->apiUrl . '/getentity');
        } elseif ($_SESSION['role'] === "ONG") {
            # code...
            $request = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/showuser/entite/' . $_SESSION['id_entite']);
        }
        $entitiesList = $request->object();
        return view('gestion.utilisateurs.role.create', compact('entitiesList'));
    }
    public function getEntity()
    {

        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {  # code...
            $request = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withoutVerifying()->get($this->apiUrl . '/getentity');
        } elseif ($_SESSION['role'] === "ONG" || $_SESSION['role'] === "FERME AGRICOLE") {
            $request = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/showuser/entite/' . $_SESSION['id_entite']);
        }
        $entitiesList = $request->object();
        return view('gestion.utilisateurs.role.liste', compact('entitiesList'));
    }

    public function getEntityToEdit($id)
    {
        $entityInfos = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withoutVerifying()->get($this->apiUrl . "/getentity/" . $id);
        $entitiesList = $request->object();
        foreach ($entitiesList as $entities) {
            # code...
            $entityInfos['id'] = $entities->id_entite;
            $entityInfos['type_entite'] = $entities->id_type_entite;
            $entityInfos['nom_entite'] = $entities->nom_entite;
            $entityInfos['nom_typentite'] = $entities->nom_type_entite;
            $entityInfos['description'] = $entities->description;
        }
        return view('gestion.utilisateurs.role.edit', compact('entityInfos'));
    }


    public function getEntityDetails($id)
    {
        $entityInfos = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withoutVerifying()->get($this->apiUrl . "/getentity/" . $id);
        $entitiesList = $request->object();
        foreach ($entitiesList as $entities) {
            # code...
            // dd($entities);
            $entityInfos['id'] = $entities->id_entite;
            $entityInfos['type_entite'] = $entities->id_type_entite;
            $entityInfos['nom_entite'] = $entities->nom_entite;
            $entityInfos['nom_typentite'] = $entities->nom_type_entite;
            $entityInfos['description'] = $entities->description;
            $entityInfos['created_at'] = "";
        }
        return view('gestion.utilisateurs.role.view', compact('entityInfos'));
    }


    public function getRole()
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/gettypent');
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
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/showuser/" . $id);
        $entitiesList = $request->object();
        return $entitiesList;
    }

    public function changeAvatar(Request $request)
    {

        if ($request->avatar) {
            $id = $request->id;
            // $user = $this->getUserbyId($id);
            $name = Storage::disk('public')->put('avatars', $request->avatar);
            $userAuth = User::find($id);
            $userAuth->logo = $name;
            $response = $userAuth->update();

            // $response ;

            if ($response) {
                if ($_SESSION['role'] === "FERME AGRICOLE")
                    return redirect(route('user.ferme.profil'));
                return redirect()->action([UtilisateurController::class, 'profil']);
                // $user = $this->getUserbyId($id);
                // return redirect()->intended(route('user.profil', ['user' => $user]));
            }
        }

        // utiliser from et recuperer le file
        // store it to public storage
        //update name logo and save
    }

    public function resetAvatar($id)
    {
        $userAuth = User::find($id);
        $userAuth->logo = '';
        $response = $userAuth->update();

        // $response ;
        if ($response) {
            return redirect()->action([UtilisateurController::class, 'profil']);
            // $user = $this->getUserbyId($id);
            // dd($user);
            // return redirect()->intended(route('user.profil', ['user' => $user]));
        }
    }

    public function get_user_count()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()
            ->get($this->apiUrl . "/nombre/null/null/null/null/null/null/null/null/null/null");
        if ($response->status() == 200) {
            # code...
            return $response->object();
        }
    }
}
