<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{

    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function addProduitToShop(Request $request)
    {
        // dd($request);
        $add_prod_shop = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post($this->apiUrl . "/boutique/produits/ajouter/" . $request->id_boutique . "/" . $request->produit ."/null", [

            "stock" => $request->stock_quantity,
            "unite_stock" => $request->unite_stock,
            "prix" => $request->regular_price,
            "unite_prix" => $request->unite_prix,
            "variete" => $request->variete,


        ]);
        $res  = $add_prod_shop->object();
        if ($res) {
            $message =  "Produit  ajouteé avec succés";
        } else {
            $message = "Erreur lors de l'ajout du produit";
        }
        return response(['message' => $message], 200);
    }


    public function updateProduitToShop(Request $request)
    {
        // dd($request);
        $add_prod_shop = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put($this->apiUrl . "/boutique/produits/update/" . $request->id_boutique_produit, [

            "stock" => $request->stock_quantity,
            "unite_stock" => $request->unite_stock,
            "prix" => $request->regular_price,
            "unite_prix" => $request->unite_prix


        ]);
        $res  = $add_prod_shop->object();
        if ($res) {
            $message =  "Produit  modifié avec succés";
        } else {
            $message = "Erreur lors de la modification du produit";
        }
        return response(['message' => $message], 200);
    }

    // return redirect('/louma-mbay/produits');

    public function AddProductFromApi()
    {
        // Créez un tableau associatif pour stocker les correspondances
        $correspondance_boutique = array();
        $correspondance_prod = array();
        $correspondance_prod = [
            7710 => 1,
            7704 => 2,
            7698 => 3,
            7685 => 4,
            7681 => 5,
            7677 => 6,
            7675 => 7,
            7673 => 8,
            7671 => 9,
            7669 => 10,
            7668 => 11,
            7666 => 12,
            7664 => 13,
            7661 => 14,
            7659 => 15,
            7657 => 16,
            7650 => 17,
            7648 => 18,
            7645 => 19,
            7643 => 20,
            7638 => 21,
            7636 => 22,
            7634 => 23,
            7630 => 24,
            7627 => 25,
            7625 => 26,
            7622 => 27,
            7620 => 28,
            7617 => 29,
            7615 => 30,
            7611 => 31,
            7609 => 32,
            7606 => 33,
            7603 => 34,
            7599 => 35,
            7597 => 36,
            7595 => 37,
            7593 => 38,
            7531 => 39,
            7529 => 40,
            7527 => 41,
            7520 => 42,
            7517 => 43,
            7515 => 44,
            7513 => 45,
            7511 => 46,
            7508 => 47,
            7504 => 48,
            7497 => 49,
            7467 => 50,
            7466 => 51,
            7454 => 52,
            7449 => 53,
            7446 => 54,
            7438 => 55,
            7425 => 56,
            7423 => 57,
            7422 => 58,
            7420 => 59,
            7418 => 60,
            7414 => 61,
            7413 => 62,
            7401 => 63,
            7398 => 64,
            7397 => 65,
            7365 => 66,
            7348 => 67,
            7306 => 68,
            7304 => 69,
            7302 => 70,
            7299 => 71,
            7297 => 72,
            7212 => 73,
            7168 => 74,
            7166 => 75,
            7157 => 76,
            7152 => 77,
            7146 => 78,
            7145 => 79,
            7141 => 80,
            7137 => 81,
            7136 => 82,
            7132 => 83,
            7119 => 84,
            7106 => 85,
            7102 => 86,
            7053 => 87,
            7047 => 88,
            7045 => 89,
            7034 => 90,
            7022 => 91,
            7021 => 92,
            7006 => 93,
            6999 => 94,
            6976 => 95,
            6804 => 96,
            6681 => 97,
            6678 => 98,
            6675 => 99,
            6672 => 100,
            6669 => 101,
            6593 => 102,
            6591 => 103,
            6588 => 104,
            6586 => 105,
            6584 => 106,
            6538 => 107,
            6535 => 108,
            2769 => 109,
        ];

        // // produit 
        // $data_prod = Http::withHeaders([
        //     'Accept' => 'application/json',
        //     'Content-Type' => 'application/json',
        // ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/produits")->json();
        // // dd($data_prod[87]);

        // for ($i = 1; $i < count($data_prod); $i++) {
        //     // on insere chaque tuple
        //     if (count($data_prod[$i]['images']) == 0) {
        //         $image = null;
        //     } else {
        //         if ($i == 87) {
        //             $image = $data_prod[$i]['images'][1]['src'];
        //         } else
        //             $image = $data_prod[$i]['images'][0]['src'];
        //     }

        //     $add_prod = Http::withHeaders([
        //         'Accept' => 'application/json',
        //         'Content-Type' => 'application/json',
        //     ])->withToken($_SESSION['token'])->withoutVerifying()->post($this->apiUrl . "/produit/create", [

        //         'produit' => $data_prod[$i]['name'],
        //         'cat_produit' => 3,

        //         'image' => $image,
        //         'description' => null,
        //     ]);
        //     // Après avoir inséré le produit, récupérez l'ID du produit  dans votre base de données
        //     $db_prod_id = $i;

        //     // Stockez la correspondance entre l'ID de l'API et l'ID de la base de données
        //     $correspondance_prod[$data_prod[$i]['id']] = $db_prod_id;
        // }
        // dd($correspondance_prod);
        //boutique
        // Récupérez les données de l'API pour les boutiques
        $data_boutiques = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/boutiques")->json();

        // Parcourez les données des boutiques et insérez-les dans votre base de données
        for ($i = 0; $i < count($data_boutiques); $i++) {
            // Insérez la boutique dans la base de données
            $add_boutique = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->post($this->apiUrl . "/boutique/create", [
                'nom' => $data_boutiques[$i]['vendor_shop_name'],
                'localite' => 24633,
                'logo' => $data_boutiques[$i]['vendor_shop_logo'],
                'description' => null,
            ]);

            // Après avoir inséré la boutique, récupérez l'ID de la boutique dans votre base de données
            $db_boutique_id = $i + 1;

            //la liste de ses produits 
            $data_shop = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/boutiques/produits/" . $data_boutiques[$i]['vendor_id'])->json();

            //on parcourt et on insere
            for ($j = 0; $j < count($data_shop); $j++) {
                // je fais la correspondance de l'id-prod
                if (isset($correspondance_prod[$data_shop[$j]['id']]) && ($data_shop[$j]['stock_quantity'] >0) ) {
                    $id_prod = $correspondance_prod[$data_shop[$j]['id']];
                    // dd($id_prod);

                    $add_prod_shop = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ])->withToken($_SESSION['token'])->withoutVerifying()->post($this->apiUrl . "/boutique/produits/ajouter/" . $db_boutique_id . "/" . $id_prod, [

                        "stock" => intval($data_shop[$j]['stock_quantity']),
                        "unite_stock" => 7,
                        "prix" => intval($data_shop[$j]['price']),
                        "unite_prix" => 7,
                        "variete" => null,
                    ]);
                }
            }
        }


        dd('yep');
        //boutique_produit


    }


    public function addProduct(Request $request)
    {

        $filename = null;
        if ($request->fichier) {
            $filename = Storage::disk('public')->put('produits', $request->fichier);
        }
        $add_prod = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post($this->apiUrl . "/produit/create", [

            'produit' => $request->name_produit,
            'cat_produit' => $request->cat_produit,
            'image' => $filename,
            'description' => null,
        ]);


        $res  = $add_prod->object();
        return $res;
    }


    public function index()
    {
        $page = 0;
        $data_prod = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/produit")->json();
        if (count($data_prod) % 6 == 0) {
            $page = count($data_prod) / 6;
        } else {
            $page = (count($data_prod) / 6) + 1;
        }
        if (count($data_prod) < 6) {
            $limit = count($data_prod);
        } else $limit = 6;

        $data = [];
        $j = 0;
        for ($i = 0; $i < $limit; $i++) {
            $data[$j] = $data_prod[$i];
            $j++;
        }
        $page = (int)$page;
        // return view('gestion.boutiques.produits.liste', ['data' => $data]);
        return view('gestion.produits.listeprod', compact('data', 'page','data_prod'));
    }

    public function paginate($page, $items_per_page)
    {
        $data = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/produit")->json();

        $j = 0;
        $shops = [];

        //mettre dans un tableau a partir de start jusqu'a end

        // Calculer la position de départ des données à récupérer dans la base de données
        $start = ($page - 1) * $items_per_page;

        $limit = $start + $items_per_page;
        if ($limit >= count($data)) {
            $limit = count($data);
            # code...
        }
        for ($i = $start; $i < $limit; $i++) {
            $shops[$j] = $data[$i];
            $j++;
        }
        return response()->json($shops, 200);
    }

    public function create()
    {
        return view('gestion.produits.create');
    }

    public function edit($id)
    {

        $data = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/produit/" . $id)->json();
        $data = $data[0];
        // dd($data);
        return view('gestion.produits.edit', compact('data'));
    }

    public function updateProduit(Request $request)
    {
        // dd($request);
        $filename = null;
        if ($request->fichier) {
            $filename = Storage::disk('public')->put('produits', $request->fichier);
        } else {
            $filename = $request->image;
        }
        // dd($filename);
        $id = $request->id;

        $update_prod = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put($this->apiUrl . "/produit/update/" . $id, [

            'produit' => $request->name_produit,
            'cat_produit' => $request->cat_produit,
            'image' => $filename,
            'description' => null,

        ]);
        $res  = $update_prod->object();
        // dd($res);
        if ($res) {
            $message =  "Produit modifie avec succés";
            // return redirect('/louma-mbay/produits');
        } else {
            $message = "Erreur lors de la modification du produit";
        }
        return response(['message' => $message], 200);

        // return redirect('/louma-mbay/produits');
        // return redirect('/louma-mbay/produits');
    }

    public function delete($id)
    {
        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->delete($this->apiUrl . "/supprimerProduit/" . $id, [

            'login' => 'agueye',
            'password' => '0WJgW^qcSLn88&^0Vv2mm*8x'

        ]);

        // return redirect('/louma-mbay/produits');
        return redirect('/louma-mbay/produits');
    }

    // public function auth()
    // {
    //     // return Auth::user()->password;
    //     return $_SESSION['password'];
    // }




    public function map()
    {

        $initialMarkers = [];

        $regions = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/regions")->json();


        $stocks = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/boutique/produits/liste/all")->json();

        $nb_stocks = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/countstock")->json();

        // return $nb_stocks;

        foreach ($stocks as $row) {

            $longitude = $row['longitude'];
            $latitude = $row['latitude'];
            $id_cat_produit = $row['id_cat_produit'];
            $cat_produit = $row['cat_produit'];
            $id_produit = $row['id_produit'];
            $produit = $row['produit'];
            $id_variete = $row['id_variete'];
            $variete = $row['variete'];
            $stock = $row['stock'];
            $unite_stock = $row['unite_stock'];
            $prix = $row['prix'];
            $unite_prix = $row['unite_prix'];
            $id_region = $row['id_region'];
            $region = $row['region'];
            $id_departement = $row['id_departement'];
            $departement = $row['departement'];
            $id_commune = $row['id_commune'];
            $commune = $row['commune'];
            $id_localite = $row['id_localite'];
            $localite = $row['localite'];

            if (($longitude !== null) && ($latitude !== null)) {

                $data = [
                    'position' => [
                        'lat' => $latitude,
                        'lng' => $longitude
                    ],
                    'draggable' => false,
                    'id_region' => $id_region,
                    'region' => $region,
                    'id_departement' => $id_departement,
                    'departement' => $departement,
                    'id_commune' => $id_commune,
                    'commune' => $commune,
                    'id_localite' => $id_localite,
                    'localite' => $localite,
                    'id_cat_produit' => $id_cat_produit,
                    'cat_produit' => $cat_produit,
                    'id_produit' => $id_produit,
                    'produit' => $produit,
                    'id_variete' => $id_variete,
                    'variete' => $variete,
                    'stock' => $stock,
                    'unite_stock' => $unite_stock,
                    'prix' => $prix,
                    'unite_prix' => $unite_prix,

                ];

                $value = array_push($initialMarkers, $data);
            }
        }
        return view('services.cartographie.stock', compact('initialMarkers', 'regions', 'nb_stocks'));
    }
    public function editProduitToShop($id)
    {
        $shops = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/boutique/produits/show/" . $id)->json();

        // return view('gestion.boutiques.produits.liste', ['data' => $data]);
        $shops = $shops[0];
        return view('gestion.boutiques.produits.edit', compact('shops'));
    }
}
