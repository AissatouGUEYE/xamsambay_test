<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;

class AllUserMiddleware
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {

            $apiAuth = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withoutVerifying()->post($this->apiUrl . '/logweb', array("login" => Auth::user()->login));
//            dd($apiAuth);
            if ($apiAuth->status() == 200) {
                $_SESSION['token'] = $apiAuth->object()->token;
                $_SESSION['role_user'] = "";
                // dd( Auth::user()->id);
                $userData = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withoutVerifying()->withToken($_SESSION['token'])->get($this->apiUrl . '/showuser/' . Auth::user()->id);

//                dd($userData->object());
                if ($userData->status() == 200) {
                    foreach ($userData->object() as $data) {
                        # code...
                        $_SESSION['id'] = $data->id;
                        $_SESSION['prenom'] = $data->prenom;
                        $_SESSION['nom'] = $data->nom;
                        $_SESSION['fonction'] = $data->fonction;
                        $_SESSION['sexe'] = $data->sexe;
                        $_SESSION['adresse'] = $data->adresse;
                        $_SESSION['telephone'] = $data->telephone;
                        $_SESSION['email'] = $data->email;
                        $_SESSION['login'] = $data->login;
                        $_SESSION['actif'] = $data->actif;
                        $_SESSION['id_utilisateur'] = $data->utilisateur;
                        $_SESSION['id_entite'] = $data->entite;
                        $_SESSION['ferme'] = 1;
                        $_SESSION['localite'] = $data->localite;
                        $_SESSION['nom_entite'] = $data->nom_entite;
                        $_SESSION['type_entite'] = $data->type_entite;
                        $_SESSION['nom_type_entite'] = $data->nom_typentite;
                        $_SESSION['role'] = $data->nom_typentite;
                        $_SESSION['departement'] = $data->departement;
                        $_SESSION['region'] = $data->region;
                        $_SESSION['commune'] = $data->commune;
                        $_SESSION['id_commune'] = $data->idcommune;

                        $_SESSION['sit_matrimonial'] = $data->sit_matrimonial;
                        $data->id_pluvio ? $_SESSION['id_pluvio'] = $data->id_pluvio : null;

                        if ($data->role != null) {
                            $_SESSION['role_user'] = $data->role;
                        }
                        if ($data->groupement != null) {
                            $_SESSION['groupement'] = $data->groupement;
                        }
                        if ($data->nom_groupement != null) {
                            $_SESSION['nomGroupement'] = $data->nom_groupement;
                        }


                        if ($data->union_groupement != null) {
                            $_SESSION['union_groupement'] = $data->union_groupement;
                        }
                        if ($data->nom_union_groupement != null) {
                            $_SESSION['nom_union_groupement'] = $data->nom_union_groupement;
                        }
                        if ($data->AUOP != null) {
                            $_SESSION['AUOP'] = $data->AUOP;
                        }
                        if ($data->nom_AUOP != null) {
                            $_SESSION['nom_AUOP'] = $data->nom_AUOP;
                        }


                        if ($data->groupement != null && (in_array($data->nom_typentite, ['ONG', 'AUOP', 'UOP', 'OP']))) {
                            $nomGrpt = explode(" ", $data->role)[1];
                            // dd($nomGrpt);
                            if (in_array($nomGrpt, ['AUOP'])) {
                                $_SESSION['role'] = $nomGrpt;
                                $_SESSION['nom_entite'] = $data->nom_AUOP;
                            } elseif (in_array($nomGrpt, ['UOP'])) {

                                $_SESSION['role'] = $nomGrpt;
                                $_SESSION['nom_entite'] = $data->nom_union_groupement;
                            } elseif (in_array($nomGrpt, ['OP'])) {

                                $_SESSION['role'] = $nomGrpt;
                                $_SESSION['nom_entite'] = $data->nom_groupement;
                            }
                        }
                    }

                    $idProfil = $_SESSION['id'];
                    $req = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/abonnementprofil/" . $idProfil);


                    if ($req->status() == 200) {
                        $abonnementList = $req->object();
                        // dd($abonnementList);
                        $sms = 0;
                        $appel = 0;
                        $stats = 0;
                        // $packs = 0;
                        foreach ($abonnementList as $key => $item) {

                            if ($item->status != 0) {
                                $sms += $item->nb_sms_restant;
                                $appel += $item->nb_sec_voice_restant;
                            }
                            if ($item->type_pack != "DEFAUT") {
                                $stats++;
                            }
                        }
                        $_SESSION['sms'] = $sms;
                        $_SESSION['appels'] = $appel;
                        $_SESSION['stats'] = $stats;
                    }

                    $req_role = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/user/profil/" . $idProfil);
                    if ($req_role->status() == 200) {
                        foreach ($req_role->object() as $data) {
                            $_SESSION['profil'] = $data->role;
                        }
                    }
                    if (in_array($_SESSION['role'], ["SUPERADMIN", "ADMIN"])) {
                        if ($_SESSION['role'] != "ADMIN") {
                            $_SESSION['menu'] = 0;
                        } else {
                            if (strtoupper($_SESSION['nom_entite']) == 'ADMIN') {
                                $_SESSION['menu'] = 0;
                            }
                            if (strtoupper($_SESSION['nom_entite']) == 'MARK & COM') {
                                $_SESSION['menu'] = 20;
                            }
                            if (strtoupper($_SESSION['nom_entite']) == 'AD FINANCE') {
                                $_SESSION['menu'] = 21;
                            }
                            if (strtoupper($_SESSION['nom_entite']) == 'BUSINESS DEV') {
                                $_SESSION['menu'] = 22;
                            }
                        }
                    } elseif (in_array($_SESSION['role'], ["OP"])) {
                        $_SESSION['menu'] = 1;
                    } elseif ($_SESSION['role'] === "ONG") {
                        $_SESSION['menu'] = 2;
                    } elseif ($_SESSION['role'] === "FINANCIER") {
                        $_SESSION['menu'] = 3;
                    } elseif ($_SESSION['role'] === "INDIVIDUEL") {
                        $_SESSION['menu'] = 4;
                    } elseif ($_SESSION['role'] === "ASSURANCE") {
                        $_SESSION['menu'] = 5;
                    } elseif ($_SESSION['role'] === "INTERPROFESSION") {
                        $_SESSION['menu'] = 6;
                    } elseif ($_SESSION['role'] === "PRODUCTEUR") {
                        $_SESSION['menu'] = 7;
                    } elseif ($_SESSION['role'] === "SERVICE_ETATIQUE") {
                        $_SESSION['menu'] = 8;
                    } elseif ($_SESSION['role'] === "SERVICE_TRANSPORT") {
                        $_SESSION['menu'] = 9;
                    } elseif ($_SESSION['role'] === "ACHETEUR") {
                        $_SESSION['menu'] = 10;
                    } elseif ($_SESSION['role'] === "FERME AGRICOLE") {
                        $_SESSION['menu'] = 11;
                        $user_ferme = Http::withHeaders([
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            // 'Authorization' => $_SESSION['token']
                        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/user/get/' . Auth::user()->id);
                        if ($user_ferme->status() == 200) {
                            foreach ($user_ferme->object() as $data) {
                                $_SESSION['profil'] = $data->role;
                            }

                            if ($_SESSION['profil'] == "PRESIDENT" || $_SESSION['profil'] == "MANAGER") {
                                $_SESSION['menu'] = 11;
                            } elseif (strpos($_SESSION['profil'], "RESPONSABLE ACTIVITES") !== false) {
                                $_SESSION['menu'] = 12;
                            }
                            // elseif ($_SESSION['profil'] == "RESPONSABLE ACTIVITES") {
                            //     $_SESSION['menu'] = 12;
                            // }
                            elseif ($_SESSION['profil'] == "COMPTABLE") {
                                $_SESSION['menu'] = 13;
                            } elseif ($_SESSION['profil'] == "RESPONSABLE COMMERCIAL") {
                                $_SESSION['menu'] = 14;
                            } else {
                                $_SESSION['menu'] = 12;
                            }
                        }
                    } elseif ($_SESSION['role'] === "MLOUMER") {
                        $_SESSION['menu'] = 15;
                    } elseif ($_SESSION['role'] === "FOURNISSEUR_INTRANT") {
                        $_SESSION['menu'] = 16;
                        if ($_SESSION['nom_entite'] === "FIA") $_SESSION['menu'] = 24;
                    } elseif (in_array($_SESSION['role'], ["UOP", "AUOP"])) {
                        $_SESSION['menu'] = 17;
                    } elseif (in_array($_SESSION['role'], ["GERANT"])) {
                        $_SESSION['menu'] = 18;
                    } elseif (in_array($_SESSION['role'], ["SUPERVISEUR"])) {
                        $_SESSION['menu'] = 19;
                    } elseif (in_array($_SESSION['role'], ["VENDEUR"])) {
                        $_SESSION['menu'] = 23;
                    } elseif (in_array($_SESSION['role'], ["COMMISSION_CESSION"])) {
                        $_SESSION['menu'] = 25;
                    } else {
                        return response('UnAuthorized 2', 302);
                    }
                } else {
                    // return response('UnAuthorized', 302);
                    echo '<script type="text/JavaScript"> location.reload(); </script>';
                }
                return $next($request);
            } else {
                if ($apiAuth->status() == 403) {
                    return redirect('/403');
                } elseif ($apiAuth->status() == 404) {
                    return redirect('/404');
                } else {
                    return redirect('/404');
                }
                // return redirect(route('login'));
                // return redirect('login')->with('message', 'Compte inactif! Veuillez contacter un administrateur');
            }
        } else {
            // $_SESSION['origin_route'] = $request->path();
            $path = Crypt::encryptString($request->path());
            return redirect(route('login', ['path' => $path]));
        }
    }
}
