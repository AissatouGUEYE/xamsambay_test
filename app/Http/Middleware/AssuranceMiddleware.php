<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
class AssuranceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {

            $apiAuth = Http::withHeaders([
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            // 'Authorization' => $_SESSION['token']
                        ])->withoutVerifying()->post('https://api.mlouma.org/api/logweb',array("login"=>Auth::user()->login));
            if($apiAuth->status() == 200){
                $_SESSION['token']= $apiAuth->object()->token;
                $userData = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withoutVerifying()->withToken($_SESSION['token'])->get('https://api.mlouma.org/api/showuser/'.Auth::user()->id);
                if($userData->status() == 200){
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
                            $_SESSION['localite'] = $data->localite;
                            $_SESSION['nom_entite'] = $data->nom_entite;
                            $_SESSION['type_entite'] = $data->type_entite;
                            $_SESSION['role'] = $data->nom_typentite;
                            $_SESSION['departement'] = $data->departement;
                            $_SESSION['region'] = $data->pays;
                            $_SESSION['commune'] = $data->sit_matrimonial;
                            $_SESSION['menu'] = 1;

                            session()->put(['role' => $data->nom_typentite]);

                    } 
                    if ( $_SESSION['role'] === "ASSURANCE"  ) {
                        # code...
                        return $next($request);

                    } else{
                                return response('UnAuthorized',302);
                    }
            //             // return redirect('/405'.$userData->object()->id)   ;                
                }else{
                        return redirect('/406')   ;                
                }
            // }else{
            //     return $next($request);
            // }
            
        }

    }else{
        return redirect('/login')   ;                
    }
}
}
