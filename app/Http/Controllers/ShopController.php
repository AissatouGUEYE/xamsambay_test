<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Http;

class ShopController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function index()
    {

        $page = 0;
        $data_shop = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/boutique")->json();


        if (count($data_shop) % 6 == 0) {
            $page = count($data_shop) / 6;
        } else {
            $page = (count($data_shop) / 6) + 1;
        }
        if (count($data_shop) < 6) {
            $limit = count($data_shop);
        } else $limit = 6;

        $shops = [];
        $j = 0;
        for ($i = 0; $i < $limit; $i++) {
            $shops[$j] = $data_shop[$i];
            $j++;
        }
        $page = (int)$page;
        return view('gestion.boutiques.listeshopadmin', compact('shops', 'page'));
    }

    public function paginate($page, $items_per_page)
    {
        $data_shop = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/boutique")->json();

        $data = [];
        // on affiche seulement les shop actifs
        $j = 0;
        for ($i = 0; $i < count($data_shop); $i++) {

            if ($data_shop[$i]['status'] == 1) {
                $data[$j] = $data_shop[$i];
                $j++;
            }
        }

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

    public function paginate_prod_by_shop($page, $items_per_page, $shop)
    {
        $data = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/boutique/produits/" . $shop)->json();

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


    public function addProduitToShop($id)
    {
        $shops = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/boutique/" . $id)->json();
        // dd($shops[0]);
        $shops = $shops[0];

        return view('gestion.boutiques.produits.create', compact('shops'));
    }


    public function edit($id)
    {
        $shops = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/boutique/" . $id)->json();
        // dd($shops[0]);
        $shops = $shops[0];
        return view('gestion.boutiques.edit', compact('shops'));
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
                "is_ferme"=>0

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

    public function create()
    {
        return view('gestion.boutiques.create');
    }

    public function enregistrer(Request $request)
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
            "is_ferme"=>0
        ]);
        $res  = $create_shop->object();
        if ($res) {
            $message =  "Boutique  ajoute avec succés";
        } else {
            $message = "Erreur lors de l'ajout de la boutique";
        }
        return response(['message' => $message], 200);
    }

    public function delete($id)
    {
        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->delete($this->apiUrl . "/supprimerBoutique" . $id, [

            'login' => 'agueye',
            'password' => '0WJgW^qcSLn88&^0Vv2mm*8x'

        ]);
        return redirect('/louma-mbay/boutiques');
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


        return view('gestion.boutiques.produits.liste', compact('data', 'id', 'page'));
    }

    public function enregistrerProduit(Request $request)
    {
        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post($this->apiUrl . "/enregistrerProduit", [

            'login' => $request->login,
            'password' => $request->password,
            'name' => $request->name,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'categories' => $request->categories,
            'images' => $request->images,
            'manage_stock' => 'true',
            'stock_quantity' => $request->stock_quantity
        ]);

        return redirect('/louma-mbay/boutiques');
    }

    public function editProduct($id)
    {

        $data = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/produits/" . $id, [
            'login' => 'agueye',
            'password' => '0WJgW^qcSLn88&^0Vv2mm*8x'
        ])->json();

        return view('gestion.boutiques.produits.edit', ['product' => $data]);
    }

    public function updateProduct(Request $request)
    {
        $id = $request->id;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put($this->apiUrl . "/updateProduit/" . $id, [

            'login' => $request->login,
            'password' => $request->password,
            'name' => $request->name,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'categories' => $request->categories,
            'images' => $request->images,
            'stock_quantity' => $request->stock_quantity,
            'description' => $request->description,
            'short_description' => $request->short_description

        ]);

        return redirect('/louma-mbay/boutiques');
    }

    public function deleteProduct($id)
    {
        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->delete($this->apiUrl . "/supprimerProduit/" . $id, [

            'login' => 'agueye',
            'password' => '0WJgW^qcSLn88&^0Vv2mm*8x'

        ]);

        return redirect('/louma-mbay/boutiques');
    }
}
