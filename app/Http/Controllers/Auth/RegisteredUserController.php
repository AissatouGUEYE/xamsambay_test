<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Http;

class RegisteredUserController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Ajouter les champs Localite et Entite Par defaut Mettre localite a Dakar 

        // charger la liste des profils 
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // ])->withoutVerifying()->get($this->apiUrl . "/gettypent");
        ])->withoutVerifying()->get($this->apiUrl . "/entite");
        $profils = $request->object();

        // dd($profils);

        // https://api.mlouma.org/api/localite
        // $request1 = Http::withHeaders([
        //     'Accept' => 'application/json',
        //     'Content-Type' => 'application/json',
        // ])->withoutVerifying()->get("https://api.mlouma.org/api/localite");
        // $localites = $request1->object();

        return view('auth.register', ['profils' => $profils]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {


        $fonction = $request->fonction;
        // dd($request);
        $pass = $request->password;
        $pass1 = $request->password1;
        if ($pass !== $pass1) {
            $message = 'Veuillez saisir les memes mots de passe';
            return view('auth.register', ['message' => $message]);
        }
        // Verifier si autres existe -- Tester
        if (isset($request['entite'])) {
            // si Oui verifier le type Entite (OP- ONG) 
            $type_entite = $fonction;
            $nom_entite = $request['entite'];
            $description = 'Ceci est un entite cree  par un client';
            // et Creer entite en fonction du profil (rendre inactif) 
            // retourner id Entite
            $response1 = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withoutVerifying()->post($this->apiUrl . "/entite/create", [
                'type_entite' => $type_entite,
                'nom_entite' => $nom_entite,
                'description' => $description
            ]);
            if ($response1->successful()) {
                $resp1 = $response1->object();
                // dd($resp1);
                $fonction = $resp1->id;
            }
        } else if (isset($request['ong-select'])) {
            if ($request['ong-select'] != $fonction) {
                $fonction = $request['ong-select'];
            }
        }

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withOptions(['verify' => false])
            ->withoutVerifying()
            ->post($this->apiUrl . "/register/create", [
                'prenom' => $request->username1,
                'nom' => $request->username2,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'login' => $request->login,
                'password' => $request->password,
                'localite' => 24633,
                'entite' => $fonction,
                'dt_naiss' => 'null',
                'google_id' => $request->google_id,
                'facebook_id' => $request->facebook_id,
                'oauth_type' => $request->oauth_type

            ]);

        // dd($response);

        if ($response->successful()) {
            $resp = $response->object();

            if ($request->paths != '' && $request->paths != 'dashboard') {
                $resp->paths = $request->paths;
            }

            return view('auth.confirm-register', ['response' => $resp]);
        } else {
            $message = 'Un compte avec ce mail ou ce numero a ete deja cree veuillez creer un autre compte avec un autre mail ou vous connectez';
            return view('auth.register', ['message' => $message]);
        }

        // return view('test', ['response' => $request, 'func' => $fonction]);
    }

    public function activation(Request $request)
    {
        // $inputs = $request->all();
        // dd($inputs);
        $code = $request->code;
        $codes = $request->codes;
        if ("M-" . $code === $codes) {

            # meme code valider
            # Api d'activation de compte
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withoutVerifying()->put($this->apiUrl . "/sms/actif/" . $request->idProfil);
            // dd($response);

            if ($response->successful()) {
                if (isset($request->paths)) {
                    if ($request->paths != '' && $request->paths != 'dashboard') {
                        return redirect(route('login', ['path' => $request->paths]))->with('message', 'Compte créé avec succes! Veuillez vous Connecter');
                        // return redirect('login')->with('message', 'Mot de passe renouvelé! Veuillez vous reconnecter');

                    }
                }
                // return redirect(RouteServiceProvider::HOME);
                return redirect('login')->with('message', 'Compte créé avec succes! Veuillez vous Connecter');
            }
        } else {
            $resp['code'] = $codes;
            $resp['profil'] = $request->idProfil;
            if ($request->paths != null) {
                # code...
                $resp['paths'] = $request->paths;
            }
            $resp = (object) $resp;
            return view('auth.confirm-register', ['response' => $resp, 'message' => 'Votre code est invalide veuillez saisir le bon code!']);
        }
    }
}
