<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class MenuServiceProvider extends ServiceProvider
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
        $menuItem = [];
        $menuRessource = file_get_contents(base_path('resources/json/userMenu.json'));
        $menuData = json_decode($menuRessource);
        foreach ($menuData as $menu) {
            # code...
            $menuJson = file_get_contents(base_path($menu[0]->path));
            $menuData = json_decode($menuJson);
            array_push($menuItem, $menuData);
        }

        // share all menuData to all the views
        View::share('menuData', $menuItem);
    }
}
