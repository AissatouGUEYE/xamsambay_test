<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

class ReseauServiceProvider extends ServiceProvider
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
        //

         # code...
        //  $reseaux = Http::withHeaders([
        //     'Accept' => 'application/json',
        //     'Content-Type' => 'application/json',
        //     // 'Authorization' => $_SESSION['token']
        // ])->withToken($_SESSION['token'])->withoutVerifying()->get('https://api.mlouma.org/api/groupements');
        // $reseaux = $reseaux->object();
        // view()->share('reseaux', $reseaux);

    }
}
