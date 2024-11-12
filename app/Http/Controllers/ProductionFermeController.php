<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Environment\Console;

class ProductionFermeController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function index()
    {
        $prod = array();
        # code...
        $url = "";

        // filtre selon manager , president et le responsable d'activite 
        if ($_SESSION['profil'] == 'MANAGER' || $_SESSION['profil'] == 'PRESIDENT') {
            $url = "/ferme/produits/ferme_produits/" . $_SESSION['id_entite'];
        } else if (strpos($_SESSION['profil'], "RESPONSABLE ACTIVITES") !== false) {
            // un responsable d'activite
            // lequel?
            $chaine = $_SESSION['profil'];
            $elements = explode(' ', $chaine);
            $activite = trim(strtolower(end($elements)));
            $activite = ucfirst($activite);

            $url = "/ferme/ferme_produits/activite/" . $_SESSION['id_entite'] . "/" . $activite;
        }

        // dd($activite);
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . $url);
        // dd($request);
        if ($request->status() == 404) {
            return view('layouts.404');
        } else {
            $prod = $request->object();
            // dd($prod);
            return view('gestion.ferme.production.index', compact('prod'));
        }
    }


    public function create(Request $request)
    {
        $filename = null;
        if ($request->fichier) {

            $filename = Storage::disk('public')->put('produits', $request->fichier);
        }
        $description = null;
        if ($request->description) {
            $description = $request->description;
        }
        // dd($filename);
        $create_prod = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post(
            $this->apiUrl . "/ferme/produits/create",
            [
                "activite" => $request->activite,
                "produit" => $request->produit,
                "image" => $filename,
                "description" => $description

            ]
        );
        // dd($create_prod);

        if ($create_prod->status() == 404) {
            return view('layouts.404');
        } else {
            if ($create_prod->successful()) {
                return response()->json(['message' => 'Produit enregistré avec succés'], 200);
            } else {
                return response()->json(['message' => 'Erreur'], 200);
            }
        }
    }



    public function create_activite(Request $request)
    {

        if ($_SESSION['role'] == "ADMIN") {
            // print_r($request);
            $create_prod = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->post(
                $this->apiUrl . "/ferme/activites/create",
                [
                    "libelle" => $request->input("libelle"),
                    "ferme" => $request->input("ferme"),
                ]
            );
        } else {
            $create_prod = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->post(
                $this->apiUrl . "/ferme/activites/create",
                [
                    "libelle" => $request->activite,
                    "ferme" => $_SESSION['id_entite'],
                ]
            );
        }


        if ($create_prod->status() == 404) {
            return view('layouts.404');
        } else {
            $res  = $create_prod->object();
            if ($res) {
                $message =  "activite  ajouté avec succés";
            } else {
                $message = "Erreur lors de l'ajout de l'activite";
            }
            return response(['message' => $message], 200);
        }
    }


    public function edit($id)
    {
        $prodInfos = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/produits/" . $id);

        if ($request->status() == 404) {
            return view('layouts.404');
        } else {
            $produitList = $request->object();
            foreach ($produitList as $entities) {
                # code...
                $prodInfos['id'] = $entities->id;
                $prodInfos['produit'] = $entities->produit;
                $prodInfos['activite'] = $entities->libelle_activite;
                $prodInfos['id_activite'] = $entities->id_activite;
            }
            return view('gestion.ferme.production.edit', compact('prodInfos'));
        }
    }

    //edit produit by ferme


    public function edit_prod_by_admin($id)
    {
        $prodInfos = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/produits/" . $id);
        if ($request->status() == 404) {
            return view('layouts.404');
        } else {
            $produitList = $request->object();
            foreach ($produitList as $entities) {
                # code...
                $prodInfos['id'] = $entities->id;
                $prodInfos['produit'] = $entities->produit;
                $prodInfos['activite'] = $entities->libelle_activite;
                $prodInfos['id_activite'] = $entities->id_activite;
                $prodInfos['id_ferme'] = $entities->id_entite;
            }
            return view('gestion.ferme.edit_produit', compact('prodInfos'));
        }
    }


    public function show($id)
    {
        $prod = $this->getProdbyId($id);
        return view('gestion.ferme.production.view', compact('prod'));
    }

    public function getProdbyId($id)
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/produits/" . $id);
        if ($request->status() == 404) {
            return view('layouts.404');
        } else {
            $prodList = $request->object();
            return $prodList;
        }
    }

    public function update(Request $request)
    {

        // dd($request);

        $update_prod = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put(
            $this->apiUrl . "/ferme/produits/update/" . $request->id,
            [
                "activite" => $request->activite,
                "produit" => $request->produit,

            ]
        );
        // dd($update_prod);

        if ($update_prod->status() == 404) {
            return view('layouts.404');
        } else {
            $res  = $update_prod->object();
            if ($res) {
                $message =  "produit  modifié avec succés";
            } else {
                $message = "Erreur lors de la modification du produit";
            }
            return response(['message' => $message], 200);
        }
    }



    //activite

    public function liste_activite()
    {
        $activite = array();
        # code...
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/activites_ferme/" . $_SESSION['id_entite']);
        if ($request->status() == 404) {
            return view('layouts.404');
        } else {
            $activite = $request->object();
            // dd($prod);
            return view('gestion.ferme.activite.index', compact('activite'));
        }
    }

    public function getActivitebyId($id)
    {

        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/activites/" . $id);
        if ($request->status() == 404) {
            return view('layouts.404');
        } else {
            $activite = $request->object();
            return $activite;
        }
    }

    public function show_activite($id)
    {
        $activite = $this->getActivitebyId($id);
        return view('gestion.ferme.activite.view', compact('activite'));
    }


    public function edit_activite($id)
    {
        $activiteInfos = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/activites/" . $id);
        if ($request->status() == 404) {
            return view('layouts.404');
        } else {
            $activiteList = $request->object();

            $activiteList = $activiteList[0];
            $activiteInfos['id'] = $activiteList->id;
            $activiteInfos['libelle'] = $activiteList->libelle;


            return view('gestion.ferme.activite.edit', compact('activiteInfos'));
        }
    }

    public function edit_activite_by_admin($id)
    {
        $activiteInfos = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/activites/" . $id);
        if ($request->status() == 404) {
            return view('layouts.404');
        } else {
            $activiteList = $request->object();

            $activiteList = $activiteList[0];
            $activiteInfos['id'] = $activiteList->id;
            $activiteInfos['libelle'] = $activiteList->libelle;
            $activiteInfos['id_ferme'] = $activiteList->id_entite;

            return view('gestion.ferme.edit', compact('activiteInfos'));
        }
    }



    public function update_activite(Request $request)
    {

        // dd($request);

        $update_activite = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put(
            $this->apiUrl . "/ferme/activites/update/" . $request->id,
            [
                "libelle" => $request->activite,
                "ferme" => $_SESSION['id_entite'],

            ]
        );
        // dd($update_prod);
        if ($update_activite->status() == 404) {
            return view('layouts.404');
        } else {
            $res  = $update_activite->object();
            if ($res) {
                $message =  "activite  modifié avec succés";
            } else {
                $message = "Erreur lors de la modification de l'activite";
            }
            return response(['message' => $message], 200);
        }
    }

    //udate activite by admin


    public function update_activite_by_admin(Request $request)
    {

        // dd($request);

        $update_activite = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put(
            $this->apiUrl . "/ferme/activites/update/" . $request->id,
            [
                "libelle" => $request->activite,
                "ferme" => $request->id_ferme,

            ]
        );
        // dd($update_prod);
        if ($update_activite->status() == 404) {
            return view('layouts.404');
        } else {
            $res  = $update_activite->object();
            if ($res) {
                $message =  "activite  modifié avec succés";
            } else {
                $message = "Erreur lors de la modification de l'activite";
            }
            return response(['message' => $message], 200);
        }
    }


    //stock

    public function liste_stock()
    {
        $stock = array();
        $stock_activite = array();
        # code...
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/ferme_stocks/" . $_SESSION['id_entite']);
        if ($request->status() == 404) {
            return view('layouts.404');
        } else {
            $stock = $request->object();

            // dd($prod);

            if (strpos($_SESSION['profil'], "RESPONSABLE ACTIVITES") !== false) {
                $chaine = $_SESSION['profil'];
                $elements = explode(' ', $chaine);
                $activite = trim(strtolower(end($elements)));
                $activite = ucfirst($activite);

                foreach ($stock as $item) {
                    if ($item->libelle_activite == $activite) {
                        array_push($stock_activite, $item);
                    }
                }
                $stock = $stock_activite;
            }
            return view('gestion.ferme.stock.index', compact('stock'));
        }
    }



    public function create_stock(Request $request)
    {
        // dd($request);
        $request->quantite = (int) $request->quantite;
        $request->gros = (int) $request->gros;
        $request->detail = (int) $request->detail;
        $create_prod = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post(
            $this->apiUrl . "/ferme/stocks/create",
            [
                "produit" => $request->produit,
                "quantite" => $request->quantite,
                "unite" => $request->unite,
                "prix_en_gros" => $request->gros,
                "prix_detaillant" => $request->detail,


            ]
        );

        if ($create_prod->status() == 404) {
            return view('layouts.404');
        } else {
            $res  = $create_prod->object();

            // dd($res);
            if ($res->status == 'Stock enregistré avec succés') {
                return redirect(route('ferme.stock'));
            } else {
                $message = "Erreur lors de l'ajout du stock";
                return response(['message' => $message], 200);
            }
        }
    }
    public function edit_stock($id)
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/stocks/" . $id);
        if ($request->status() == 404) {
            return view('layouts.404');
        } else {
            $stock = $request->object();
            $stock = $stock[0];
            // dd($prod);
            return view('gestion.ferme.stock.edit', compact('stock'));
        }
    }

    //by admin edit

    public function edit_stock_by_admin($id)
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/stocks/" . $id);
        if ($request->status() == 404) {
            return view('layouts.404');
        } else {
            $stock = $request->object();
            $stock = $stock[0];
            // dd($prod);
            return view('gestion.ferme.edit_stock', compact('stock'));
        }
    }

    public function update_stock(Request $request)
    {
        // dd($request);
        $request->quantite = (int) $request->quantite;
        $request->gros = (int) $request->gros;
        $request->detail = (int) $request->detail;
        $update_stock = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put(
            $this->apiUrl . "/ferme/stocks/update/" . $request->id,
            [
                "produit" => $request->produit,
                "quantite" => $request->quantite,
                "unite" => $request->unite,
                "prix_en_gros" => $request->gros,
                "prix_detaillant" => $request->detail,


            ]
        );

        if ($update_stock->status() == 404) {
            return view('layouts.404');
        } else {
            $res  = $update_stock->object();
            // dd($res);
            if ($res->status == "Stock modifié avec succés") {
                $message =  "stock  modifié avec succés";
            } else {
                $message = "Erreur lors de la modification du stock";
            }
            return response(['message' => $message], 200);
        }
    }
}
