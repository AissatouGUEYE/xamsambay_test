<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductionController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function index()
    {
        // $token =
        // "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvYXBpLm1sb3VtYS5jb21cL2FwaVwvbG9naW4iLCJpYXQiOjE3MDU5MjE3NjksImV4cCI6MTcwNTkyNTM2OSwibmJmIjoxNzA1OTIxNzY5LCJqdGkiOiJXTzJuTklDc0daTk5wZUJPIiwic3ViIjo5ODA4LCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.QyFQbshSsboLvJOCYVkr2aWcM26Nanjr3sK7gv3w9Z4";

        // $panier = Http::withHeaders([
        //     'Accept' => 'application/json',
        //     'Content-Type' => 'application/json',
        // ])->withToken($_SESSION['token'])->withoutVerifying()
        // ->post("http://localhost:8001/api/receptions/create"
        // , [
        //     // 'eb' => 46,
        //     // 'profil' => 399,
        //     'distribution' => 10,
        //     'id_cc' => 1787,
        //     'qte_reçue' => 20000,
        //     'unite_cc' => 2,
        //     'nom_prod' => 2,
        //     'prenom_prod' => 100,
        // ]
        // )->json();

        // return $panier;

        // $panier = Http::withHeaders([
        //     'Accept' => 'application/json',
        //     'Content-Type' => 'application/json',
        // ])->withToken($_SESSION['token'])->withoutVerifying()
        // ->post("http://localhost:8001/api/distributions/create"
        // , [
        //     'commission' => 82,
        //     'id_fia' => 1779,
        //     'type_intrant' => 1,
        //     'produit' => 4,
        //     'variete' => 10,
        //     'qte_notifiee' => 1000,
        //     'unite' => 2,
        // ]
        // )->json();

        // return $panier;

        // $result = $panier[0]["contacts"];
        // $result = json_decode($result, true);
        // return $result["called"];

        // $call = Http::withHeaders([
        //     'Accept' => 'application/json',
        //     'Content-Type' => 'application/json',
        // ])->withToken($_SESSION['token'])->withoutVerifying()->get("http://localhost:8001/api/izicab/user")->json();

        // return $call;

        // $call = Http::withHeaders([
        //     'Accept' => 'application/json',
        //     'Content-Type' => 'application/json',
        // ])->withToken($_SESSION['token'])->withoutVerifying()->get("http://localhost:8001/api/hist_distributions")->json();

        // return $call;



        if ($_SESSION['role'] === "OP") {

            $productions = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()
              ->get($this->apiUrl . "/production/entite/reseau/null/" . $_SESSION['groupement'] . "/null/null/null")->json();

            $campagnes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/campagnes/actif")->json();

            $varietes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/variete")->json();

            $unites = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite/type/1")->json();

            $sols = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/sols/entite/reseau/null/" . $_SESSION['groupement'] . "/null/null/null")->json();

            $producteurs = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/groupements/membres/" . $_SESSION['groupement'])->json();

            return view('gestion.productions.liste', compact('productions','producteurs', 'campagnes', 'varietes', 'unites', 'sols'));

        } elseif ($_SESSION['role'] === "AUOP") {

            $productions = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()
              ->get($this->apiUrl . "/production/entite/reseau/null/null/null/" . $_SESSION['AUOP'] . "/null")->json();

            $union_groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/auop/union_groupements/" . $_SESSION['AUOP'])->json();

            $groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/auop/groupements/" . $_SESSION['AUOP'])->json();

            $campagnes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/campagnes/actif")->json();

            $varietes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/variete")->json();

            $unites = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite/type/1")->json();

            $sols = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/sols/entite/reseau/null/null/null/" . $_SESSION['AUOP'] . "/null")->json();

            return view('gestion.productions.liste', compact('union_groupements', 'productions', 'campagnes', 'varietes', 'unites', 'sols', 'groupements'));

        } elseif ($_SESSION['role'] === "UOP") {

            $productions = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()
              ->get($this->apiUrl . "/production/entite/reseau/null/null/" . $_SESSION['union_groupement'] . "/null/null")->json();

            $groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/union/groupements/" . $_SESSION['union_groupement'])->json();

            $campagnes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/campagnes/actif")->json();

            $varietes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/variete")->json();

            $unites = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite/type/1")->json();

            $sols = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/sols/entite/reseau/null/null/" . $_SESSION['union_groupement'] . "/null/null")->json();

            return view('gestion.productions.liste', compact('groupements', 'productions', 'campagnes', 'varietes', 'unites', 'sols', 'groupements'));

        } elseif ($_SESSION['role'] === "ONG") {

            $productions = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()
              ->get($this->apiUrl . "/production/entite/reseau/" . $_SESSION['id_entite'] . "/null/null/null/null")->json();

            $groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/entite/groupements/" . $_SESSION['id_entite'])->json();

            $campagnes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/campagnes/actif")->json();

            $varietes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/variete")->json();

            $unites = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite/type/1")->json();

            $sols = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/sols/entite/reseau/" . $_SESSION['id_entite'] . "/null/null/null/null")->json();

            return view('gestion.productions.liste', compact('groupements', 'productions', 'campagnes', 'varietes', 'unites', 'sols', 'groupements'));

        } elseif ($_SESSION['role'] === "INDIVIDUEL"){

            $productions = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()
              ->get($this->apiUrl . "/production/entite/reseau/null/null/null/null/" . $_SESSION['id'])->json();

            $campagnes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/campagnes/actif")->json();

            $varietes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/variete")->json();

            $unites = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite/type/1")->json();

            $sols = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/sols/entite/reseau/null/null/null/null/" . $_SESSION['id'])->json();

            return view('gestion.productions.liste', compact('productions', 'campagnes', 'varietes', 'unites', 'sols'));

        } elseif ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN"){

            $productions = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/production")->json();

            $campagnes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/campagnes/actif")->json();

            $varietes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/variete")->json();

            $unites = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite/type/1")->json();

            $sols = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/sols")->json();

            $groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/groupements")->json();
            // return $groupements;
            return view('gestion.productions.liste', compact('productions', 'groupements', 'campagnes', 'varietes', 'unites', 'sols'));

        } else {

            $campagnes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/campagnes/actif")->json();

            $varietes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/variete")->json();

            $unites = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite/type/1")->json();

            $sols = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/sols")->json();

            $productions = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/production")->json();

            $groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/groupements")->json();

            return view('gestion.productions.liste', compact('productions', 'groupements', 'campagnes', 'varietes', 'unites', 'sols'));

        }

    }


    public function aggregation()
    {
        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {

            $groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/groupements")->json();

            $my_array = [];
            // $groupements = json_decode($groupements, true);

            foreach($groupements as $row) {

                $id = $row['id_groupement'];

                $libelle = $row['libelle'];

                $produits = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/produit")->json();

                $product_array = [];
                if (is_array($produits)) {
                    foreach($produits as $row) {
                        // return $produits;

                        if(is_array($row) && isset($row['id']) && isset($row['produit'])) {
                            $id_produit = $row['id'];
                            $produit = $row['produit'];
                            // your code here


                            $quantite = Http::withHeaders([
                                'Accept' => 'application/json',
                                'Content-Type' => 'application/json',
                            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/production/aggregation/null/".$id."/null/".$id_produit."/null")->json();

                            // return $quantite;
                            // return $quantite[0]['quantite_totale'];
                            // if($quantite[0]['quantite_totale'] != 0)
                            if(is_array($quantite) && isset($quantite[0]['quantite_totale']) && $quantite[0]['quantite_totale'] != 0)
                            {
                                $data  = [$produit=>$quantite];

                                $value = array_push($product_array, $data);
                            }
                            // else {
                            //     $data  = [$produit=>1000];

                            //     $value = array_push($product_array, $data);
                            // }
                        }
                    }
                }

                $data2  = [$libelle=>$product_array];

                $value = array_push($my_array, $data2);

            }

            return view('gestion.productions.aggregation', compact('my_array'));

        }
        elseif ($_SESSION['role'] === "ONG") {

            $groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/entite/groupements/" . $_SESSION['id_entite'])->json();

            $my_array = [];

            foreach($groupements as $row) {

                $id = $row['id_groupement'];

                $libelle = $row['libelle'];

                $produits = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/produit")->json();

                $product_array = [];
                if (is_array($produits)) {
                    foreach($produits as $row) {
                        // return $produits;

                        if(is_array($row) && isset($row['id']) && isset($row['produit'])) {
                            $id_produit = $row['id'];
                            $produit = $row['produit'];
                            // your code here


                            $quantite = Http::withHeaders([
                                'Accept' => 'application/json',
                                'Content-Type' => 'application/json',
                            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/production/aggregation/null/".$id."/null/".$id_produit."/null")->json();

                            // return $quantite;
                            // return $quantite[0]['quantite_totale'];
                            // if($quantite[0]['quantite_totale'] != 0)
                            if(is_array($quantite) && isset($quantite[0]['quantite_totale']) && $quantite[0]['quantite_totale'] != 0)
                            {
                                $data  = [$produit=>$quantite];

                                $value = array_push($product_array, $data);
                            }
                            // else {
                            //     $data  = [$produit=>1000];

                            //     $value = array_push($product_array, $data);
                            // }
                        }
                    }
                }

                $data2  = [$libelle=>$product_array];

                $value = array_push($my_array, $data2);

            }

            return view('gestion.productions.aggregation', compact('my_array'));
        }
        elseif ($_SESSION['role'] === "AUOP") {

            $groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/auop/groupements/" . $_SESSION['AUOP'])->json();

            $my_array = [];

            foreach($groupements as $row) {

                $id = $row['id_groupement'];

                $libelle = $row['libelle'];

                $produits = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/produit")->json();

                $product_array = [];
                if (is_array($produits)) {
                    foreach($produits as $row) {
                        // return $produits;

                        if(is_array($row) && isset($row['id']) && isset($row['produit'])) {
                            $id_produit = $row['id'];
                            $produit = $row['produit'];
                            // your code here


                            $quantite = Http::withHeaders([
                                'Accept' => 'application/json',
                                'Content-Type' => 'application/json',
                            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/production/aggregation/null/".$id."/null/".$id_produit."/null")->json();

                            // return $quantite;
                            // return $quantite[0]['quantite_totale'];
                            // if($quantite[0]['quantite_totale'] != 0)
                            if(is_array($quantite) && isset($quantite[0]['quantite_totale']) && $quantite[0]['quantite_totale'] != 0)
                            {
                                $data  = [$produit=>$quantite];

                                $value = array_push($product_array, $data);
                            }
                            // else {
                            //     $data  = [$produit=>1000];

                            //     $value = array_push($product_array, $data);
                            // }
                        }
                    }
                }

                $data2  = [$libelle=>$product_array];

                $value = array_push($my_array, $data2);

            }

            return view('gestion.productions.aggregation', compact('my_array'));
        }
        elseif ($_SESSION['role'] === "UOP") {

            $groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/union/groupements/" . $_SESSION['union_groupement'])->json();

            $my_array = [];

            foreach($groupements as $row) {

                $id = $row['id_groupement'];

                $libelle = $row['libelle'];

                $produits = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/produit")->json();

                $product_array = [];
                if (is_array($produits)) {
                    foreach($produits as $row) {
                        // return $produits;

                        if(is_array($row) && isset($row['id']) && isset($row['produit'])) {
                            $id_produit = $row['id'];
                            $produit = $row['produit'];
                            // your code here


                            $quantite = Http::withHeaders([
                                'Accept' => 'application/json',
                                'Content-Type' => 'application/json',
                            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/production/aggregation/null/".$id."/null/".$id_produit."/null")->json();

                            // return $quantite;
                            // return $quantite[0]['quantite_totale'];
                            // if($quantite[0]['quantite_totale'] != 0)
                            if(is_array($quantite) && isset($quantite[0]['quantite_totale']) && $quantite[0]['quantite_totale'] != 0)
                            {
                                $data  = [$produit=>$quantite];

                                $value = array_push($product_array, $data);
                            }
                            // else {
                            //     $data  = [$produit=>1000];

                            //     $value = array_push($product_array, $data);
                            // }
                        }
                    }
                }

                $data2  = [$libelle=>$product_array];

                $value = array_push($my_array, $data2);

            }

            return view('gestion.productions.aggregation', compact('my_array'));
        }

    }


    public function zone_aggregation()
    {

        $zones = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/zones")->json();

        // $quantite = Http::withHeaders([
        //     'Accept' => 'application/json',
        //     'Content-Type' => 'application/json',
        // ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/production/aggregation/7/null/null/1/null")->json();

        // return $quantite;

        $my_array = [];

        // $groupements = json_decode($groupements, true);

        foreach($zones as $row) {

            $id = $row['id'];

            $designation = $row['designation'];

            $produits = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/produit")->json();

            $product_array = [];
            if (is_array($produits)) {
                foreach($produits as $row) {
                    // return $produits;

                    if(is_array($row) && isset($row['id']) && isset($row['produit'])) {
                        $id_produit = $row['id'];
                        $produit = $row['produit'];
                        // your code here


                        $quantite = Http::withHeaders([
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/production/aggregation/".$id."/null/null/".$id_produit."/null")->json();

                        // return $quantite;
                        // return $quantite[0]['quantite_totale'];
                        // if($quantite[0]['quantite_totale'] != 0)
                        if(is_array($quantite) && isset($quantite[0]['quantite_totale']) && $quantite[0]['quantite_totale'] != 0)
                        {
                            $data  = [$produit=>$quantite];

                            $value = array_push($product_array, $data);
                        }
                        // else {
                        //     $data  = [$produit=>1000];

                        //     $value = array_push($product_array, $data);
                        // }
                    }
                }
            }

            $data2  = [$designation=>$product_array];

            $value = array_push($my_array, $data2);

        }

        // return $my_array;
        return view('gestion.productions.aggregation', compact('my_array'));


    }

    // public function create()
    // {
    //     $campagnes = Http::withHeaders([
    //         'Accept' => 'application/json',
    //         'Content-Type' => 'application/json',
    //     ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/campagnes/actif")->json();

    //     $varietes = Http::withHeaders([
    //         'Accept' => 'application/json',
    //         'Content-Type' => 'application/json',
    //     ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/variete")->json();

    //     $unites = Http::withHeaders([
    //         'Accept' => 'application/json',
    //         'Content-Type' => 'application/json',
    //     ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite")->json();

    //     $sols = Http::withHeaders([
    //         'Accept' => 'application/json',
    //         'Content-Type' => 'application/json',
    //     ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/sols")->json();

    //     if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {

    //         $producteurs = Http::withHeaders([
    //             'Accept' => 'application/json',
    //             'Content-Type' => 'application/json',
    //         ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/producteurs")->json();

    //         return view('gestion.productions.admin.create', ['campagnes' => $campagnes, 'varietes' => $varietes, 'unites' => $unites, 'sols' => $sols, 'producteurs' => $producteurs]);
    //     } elseif ($_SESSION['role'] === "OP") {

    //         $producteurs = Http::withHeaders([
    //             'Accept' => 'application/json',
    //             'Content-Type' => 'application/json',
    //         ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/showuser/entite/" . $_SESSION['id_entite'])->json();

    //         return view('gestion.productions.admin.create', ['campagnes' => $campagnes, 'varietes' => $varietes, 'unites' => $unites, 'sols' => $sols, 'producteurs' => $producteurs]);
    //     } else {

    //         return view('gestion.productions.create', ['campagnes' => $campagnes, 'varietes' => $varietes, 'unites' => $unites, 'sols' => $sols]);
    //     }
    // }

    public function store(Request $request)
    {
        $token = strval($_SESSION['token']);
        $url = $this->apiUrl . "/production/create";



        if (isset($request->variete)) {

            $variete = $request->variete;
        } else {

            $variete = null;
        }

        if ($_SESSION['role'] === "OP" || $_SESSION['role'] === "UOP" || $_SESSION['role'] === "AUOP") {

            Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($token)->withoutVerifying()->post($url, [
                'profil' => $request->profil,
                'qte' => $request->quantite,
                'unite' => $request->unite,
                'variete' => $variete,
                'produit' => $request->produit,
                'campagne_production' => $request->campagne,
                'sol' => $request->sol,
                'surface_emblavee' => $request->surface_emblavee,
                'unite_surf_emblavee' => $request->unite_surf_embl
            ]);
        } elseif ($_SESSION['role'] === "INDIVIDUEL") {

            Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($token)->withoutVerifying()->post($url, [
                'profil' => $_SESSION['id'],
                'qte' => $request->quantite,
                'unite' => $request->unite,
                'variete' => $variete,
                'produit' => $request->produit,
                'campagne_production' => $request->campagne,
                'sol' => $request->sol,
                'surface_emblavee' => $request->surface_emblavee,
                'unite_surf_emblavee' => $request->unite_surf_embl
            ]);
        }

        return redirect('/productions');
    }

    public function modifier($id)
    {
        $production = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/production/" . $id)->json();

        $campagnes = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/campagnes/actif")->json();

        $varietes = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/variete")->json();

        $unites = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite/type/1")->json();

        $sols = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/sols")->json();

        return view('gestion.productions.edit', ['production' => $production, 'campagnes' => $campagnes, 'varietes' => $varietes, 'unites' => $unites, 'sols' => $sols]);

    }

    public function edit(Request $request)
    {
        $token = strval($_SESSION['token']);
        $id = $request->id;
        $url = $this->apiUrl . "/production/update/" . $id;


        if (isset($request->variete)) {

            $variete = $request->variete;
        } else {

            $variete = null;
        }

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->put($url, [

            'profil' => $request->profil,
            'qte' => $request->quantite,
            'unite' => $request->unite,
            'variete' => $variete,
            'produit' => $request->produit,
            'campagne_production' => $request->campagne,
            'sol' => $request->sol,
            'surface_emblavee' => $request->surface_emblavee,
            'unite_surf_emblavee' => $request->unite_surf_embl

        ]);

        return redirect('/productions');
    }

    // public function delete($id)
    // {
    //     $token = strval($_SESSION['token']);
    //     $url = $this->apiUrl . "/production/delete/" . $id;

    //     Http::withHeaders([
    //         'Accept' => 'application/json',
    //         'Content-Type' => 'application/json',
    //     ])->withToken($token)->withoutVerifying()->delete($url);

    //     return redirect('/productions');
    // }



    public function filter(Request $request)
    {
        $inputs = $request->all();

        $grp_filter = $inputs['grp-list'];


        $token = strval($_SESSION['token']);
        $url = $this->apiUrl . "/production/entite/reseau/null/" . $grp_filter . "/null/null/null";


        if ($grp_filter != null && $grp_filter != 'null') {

            $grp_filter_infos = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($token)->withoutVerifying()->get($this->apiUrl . "/groupements/" . $grp_filter)->json();

            // return $grp_filter_infos;

            $grp_filter_libelle = $grp_filter_infos[0]['libelle'];
            $grp_filter_id = $grp_filter_infos[0]['id_groupement'];
        } else {
            // return 'dafa null';
            $grp_filter_infos = null;

            $grp_filter_libelle = null;

            $grp_filter_id = null;
        }

        $productions = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($url)->json();



        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {

            $groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/groupements")->json();

            $campagnes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/campagnes/actif")->json();

            $varietes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/variete")->json();

            $unites = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite/type/1")->json();

            $sols = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/sols")->json();

            return view('gestion.productions.liste', compact('grp_filter_id', 'grp_filter_libelle', 'groupements', 'productions', 'campagnes', 'varietes', 'unites', 'sols'));

        } elseif ($_SESSION['role'] === "ONG") {

            $groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/entite/groupements/" . $_SESSION['id_entite'])->json();

            $campagnes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/campagnes/actif")->json();

            $varietes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/variete")->json();

            $unites = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite/type/1")->json();

            $sols = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/sols")->json();

            return view('gestion.productions.liste', compact('grp_filter_id', 'grp_filter_libelle', 'groupements', 'productions', 'campagnes', 'varietes', 'unites', 'sols'));

        } elseif ($_SESSION['role'] === "AUOP") {

            $groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/auop/groupements/" . $_SESSION['AUOP'])->json();

            $union_groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/auop/union_groupements/" . $_SESSION['AUOP'])->json();

            $campagnes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/campagnes/actif")->json();

            $varietes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/variete")->json();

            $unites = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite/type/1")->json();

            $sols = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/sols")->json();

            return view('gestion.productions.liste', compact('grp_filter_id', 'grp_filter_libelle', 'groupements', 'union_groupements', 'productions', 'campagnes', 'varietes', 'unites', 'sols'));

        } elseif ($_SESSION['role'] === "UOP") {

            $groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/union/groupements/" . $_SESSION['union_groupement'])->json();

            $campagnes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/campagnes/actif")->json();

            $varietes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/variete")->json();

            $unites = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite/type/1")->json();

            $sols = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/sols")->json();

            return view('gestion.productions.liste', compact('grp_filter_id', 'grp_filter_libelle', 'groupements', 'productions', 'campagnes', 'varietes', 'unites', 'sols'));

        } else {

            $groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/groupements")->json();

            $campagnes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/campagnes/actif")->json();

            $varietes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/variete")->json();

            $unites = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite/type/1")->json();

            $sols = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/sols")->json();

            return view('gestion.productions.liste', compact('grp_filter_id', 'grp_filter_libelle', 'productions', 'groupements', 'campagnes', 'varietes', 'unites', 'sols'));

        }
    }
}
