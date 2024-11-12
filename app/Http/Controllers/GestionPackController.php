<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class GestionPackController extends Controller
{

    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    //
    public function offres() //$profil
    {
        // charger la liste des profils
        $acteur = 'INDIVIDUEL';

        // $userAuth = Auth::user();
        // if (isset($userAuth)) {
        //     # code...
        // }

        $packLists = array();
        $packXeweul = array();
        $packConfort = array();
        $packPrestige = array();

        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/pack/" . $acteur);
        $packList = $request->object();

        $green_api = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/greenapi_packs");

        $green_api = $green_api->object();

        // return $pack;

        foreach ($packList as $item) {
            $desc = $item->descriptionpack;
            $desc = str_replace("[", "", $desc);
            $desc = str_replace("]", "", $desc);
            $desc = str_replace("\"", "", $desc);
            $array_desc = explode(",", $desc);
            $item->descriptionpack = $array_desc;
        }


        foreach ($packList as $item) {

            if ($item->type_pack == 'KHEWEUL') {
                array_push($packXeweul, $item);
            }
            if ($item->type_pack == 'CONFORT') {
                array_push($packConfort, $item);
            }
            if ($item->type_pack == 'PRESTIGE') {
                array_push($packPrestige, $item);
            }
        }
        array_push($packLists, $packXeweul, $packConfort, $packPrestige);


        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/type");
        $profils = $request->object();

        // return view('landing.pack.index', ['profils' => $profils, 'acteur' => $acteur]);
        return view('landing.pack.index', ['acteur' => $acteur, 'profils' => $profils, 'packs' => $packList, 'packList' => $packLists, 'green_api' => $green_api]);
    }


    public function offresByActeur($acteur) //$profil
    {

        // Charger les pack du profils choisi

        // $packList = array();
        $packLists = array();
        $packXeweul = array();
        $packConfort = array();
        $packPrestige = array();

        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/pack/" . $acteur);
        $packList = $request->object();


        foreach ($packList as $item) {
            $desc = $item->descriptionpack;
            $desc = str_replace("[", "", $desc);
            $desc = str_replace("]", "", $desc);
            $desc = str_replace("\"", "", $desc);
            $array_desc = explode(",", $desc);
            $item->descriptionpack = $array_desc;
        }


        // charger la liste des profils
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/type");
        $profils = $request->object();


        foreach ($packList as $item) {

            if ($item->type_pack == 'KHEWEUL') {
                array_push($packXeweul, $item);
            }
            if ($item->type_pack == 'CONFORT') {
                array_push($packConfort, $item);
            }
            if ($item->type_pack == 'PRESTIGE') {
                array_push($packPrestige, $item);
            }
        }
        array_push($packLists, $packXeweul, $packConfort, $packPrestige);


        // return view('landing.pack.index', ['acteur' => $acteur, 'profils' => $profils, 'packs' => $packList]);
        return view('landing.pack.index', ['acteur' => $acteur, 'profils' => $profils, 'packs' => $packList, 'packList' => $packLists]);
    }

    public function offresByProfile(Request $request)
    {
        $acteur = $request->acteur;

        // Charger les pack du profils choisi

        // $packList = array();
        $packLists = array();
        $packXeweul = array();
        $packConfort = array();
        $packPrestige = array();

        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/pack/" . $acteur);

        $packList = $request->object();


        foreach ($packList as $item) {
            $desc = $item->descriptionpack;
            $desc = str_replace("[", "", $desc);
            $desc = str_replace("]", "", $desc);
            $desc = str_replace("\"", "", $desc);
            $array_desc = explode(",", $desc);
            $item->descriptionpack = $array_desc;
        }


        // charger la liste des profils
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/type");

        $profils = $request->object();


        foreach ($packList as $item) {

            if ($item->type_pack == 'KHEWEUL') {
                array_push($packXeweul, $item);
            }
            if ($item->type_pack == 'CONFORT') {
                array_push($packConfort, $item);
            }
            if ($item->type_pack == 'PRESTIGE') {
                array_push($packPrestige, $item);
            }
        }

        array_push($packLists, $packXeweul, $packConfort, $packPrestige);


        // return view('landing.pack.index', ['acteur' => $acteur, 'profils' => $profils, 'packs' => $packList]);
        return view('landing.pack.index', ['acteur' => $acteur, 'profils' => $profils, 'packs' => $packList, 'packList' => $packLists]);
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
}
