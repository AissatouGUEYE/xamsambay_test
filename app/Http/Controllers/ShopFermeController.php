<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ShopFermeController extends Controller
{

    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function index()
    {
        // afficher sa boutique

        $item = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/boutique/ferme/" . $_SESSION['id_entite'])->json();

        // dd($item);
        if (count($item)>=1) {
            $item = $item[0];
            $yes = 1;
        }
        else
        $yes=0;
       
        return view('gestion.ferme.shop.index', compact('item','yes'));
    }

    public function listeProduits($id)
    {

        $page = 0;
        $data_shop = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/boutique/produits/" . $id)->json();

        if (count($data_shop) % 6 == 0) {
            $page = count($data_shop) / 6;
        } else {
            $page = (count($data_shop) / 6) + 1;
        }
        if (count($data_shop) < 6) {
            $limit = count($data_shop);
        } else $limit = 6;

        $data = [];
        $j = 0;
        for ($i = 0; $i < $limit; $i++) {
            $data[$j] = $data_shop[$i];
            $j++;
        }
        $page = (int)$page;
        return view('gestion.ferme.shop.produits', compact('data', 'id', 'page'));
    }

    public function addProduitToShop($id)
    {
        $shops = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/boutique/" . $id)->json();
        // dd($shops[0]);
        $shops = $shops[0];

        return view('gestion.ferme.shop.produits.create', compact('shops'));
    }

    public function edit($id)
    {
        $shops = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/boutique/" . $id)->json();
        // dd($shops[0]);
        $shops = $shops[0];
        return view('gestion.ferme.shop.edit', compact('shops'));
    }

    public function update(Request $request)
    {
        $filename = null;
        if ($request->fichier) {
            $filename = Storage::disk('public')->put('boutiques', $request->fichier);
        } else {
            $filename = $request->image;
        }
        $update_shop = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put(
            $this->apiUrl . "/boutique/update/" . $request->id,
            [
                "nom" => $request->nom,
                "localite" => $request->localite,
                "logo" => $filename,
                "description" => $request->desc_boutique,
                "is_ferme"=>$_SESSION['id_entite']

            ]
        );
        $res  = $update_shop->object();
        if ($res) {
            $message =  "Boutique  modifié avec succés";
        } else {
            $message = "Erreur lors de la modification de la boutique";
        }
        return response(['message' => $message], 200);
    }

    public function create(Request $request)
    {
        // dd($request);
        $filename = null;
        if ($request->fichier) {
            $filename = Storage::disk('public')->put('boutiques', $request->fichier);
        }

        $create_shop = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post($this->apiUrl . "/boutique/create", [

            'nom' => $request->name_boutique,
            'localite' => $request->localite,
            "logo" => $filename,
            "description" => $request->desc_boutique,
            "is_ferme" => $_SESSION['id_entite']
        ]);
        $res  = $create_shop->object();
        if ($res) {
            $message =  "Boutique ajoutée avec succés";
        } else {
            $message = "Erreur lors de l'ajout de la boutique";
        }
        return response(['message' => $message], 200);
    }

    public function addProduit(Request $request)
    {
        dd($request);
        $add_prod_shop = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post($this->apiUrl . "/boutique/produits/ajouter/" . $request->id_boutique . "/null/" . $request->produit, [

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

    public function editProduitToShop($id)
    {
        $shops = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/boutique/produits/show/" . $id)->json();

        // return view('gestion.boutiques.produits.liste', ['data' => $data]);
        $shops = $shops[0];
        return view('gestion.ferme.shop.produits.edit', compact('shops'));
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

}
