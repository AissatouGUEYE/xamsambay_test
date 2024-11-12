<?php

namespace App\Providers;

use Facade\FlareClient\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

class CampagneActifProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // //
        // $req =  Http::withoutVerifying()->get("https://api.mlouma.org/api/campagnes/actif");
        // if ($req) {
        //     # code...
        //     $campagne  = (array)$req->object();

        // } else {
        //     # code...
        //     $campagne = ["Erreur lors du chargement des données"];
        // }
        // view()->share('campagne_actif', $campagne[0]);

    }
}
