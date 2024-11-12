<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class VenteOnlineController extends Controller
{

    protected $apiUrl;
    protected $visiteur;



    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public  function getUserId(Request $request)
    {
        // Ecrire sur un fichier texte
        Storage::disk('public')->put('filename.txt', $request->visitorId);
        return response()->json(['success' => true]);
    }
    public function index(Request $request)
    {


        // $this->client=Session::get('visitor_id');
        // dd(Session::get('visitor_id'));

        $page = 0;

        //tous les produits des boutiques
        $tab_shops = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/boutique/produits/liste/all")->json();
        $data_cat = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/catproduit")->json();
        //temoignages
        $temoignages = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/temoignages")->json();
        $message = [];

        if (count($temoignages) >= 4) {
            for ($i = 0; $i < 4; $i++) {
                $message[$i] = $temoignages[$i];
            }
        }

        if (count($tab_shops) % 8 == 0) {
            $page = count($tab_shops) / 8;
        } else {
            $page = (count($tab_shops) / 8) + 1;
        }
        if (count($tab_shops) < 8) {
            $limit = count($tab_shops);
        } else $limit = 8;

        $shops = [];
        $j = 0;
        for ($i = 0; $i < $limit; $i++) {
            $shops[$j] = $tab_shops[$i];
            $j++;
        }
        $page = (int)$page;
        return view('landing.vente.index', compact('shops', 'page', 'message', 'data_cat'));
    }

    public function nosboutiques()
    {
        $page = 0;
        $all_shop = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/boutique")->json();
        $data_shop=[];
        // on affiche seulement les shop actifs
        $j=0;
        for ($i=0; $i < count($all_shop); $i++) { 

            if ($all_shop[$i]['status']==1) {
               $data_shop[$j]=$all_shop[$i];
               $j++;
            }
            
        }
        //temoignages
        $temoignages = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/temoignages")->json();
        $message = [];

        if (count($temoignages) >= 4) {
            for ($i = 0; $i < 4; $i++) {
                $message[$i] = $temoignages[$i];
            }
        }

        if (count($data_shop) % 8 == 0) {
            $page = count($data_shop) / 8;
        } else {
            $page = (count($data_shop) / 8) + 1;
        }
        if (count($data_shop) < 8) {
            $limit = count($data_shop);
        } else $limit = 8;

        $shops = [];
        $j = 0;
        for ($i = 0; $i < $limit; $i++) {

            $shops[$j] = $data_shop[$i];
            $j++;
        }
        $page = (int)$page;
        return view('landing.vente.nosboutiques', compact('shops', 'page', 'data_shop', 'message'));
    }

    public function commande()
    {

        $commande = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/vente/showbyuser/" . $_SESSION['id_utilisateur'])->json();
        // dd($commande);
        return view('landing.vente.mesCommandes', compact('commande'));
    }
    public function commande_produit($id)
    {
        $produit = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/commande/all/showbyid/" . $id)->json();
        // dd($produit);
        return view('landing.vente.produits_commande', compact('produit'));
    }

    public function getCategorie()
    {
        $categorie = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/catproduit")->json();

        return response()->json($categorie, 200);
    }

    public function listeProduit($id)
    {
        //liste des produits d'une boutique
        $data = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/boutique/produits/" . $id)->json();
        return view('landing.vente.listeProduit', compact('data'));
    }

    public function monPanier($id)
    {
        //cette fonction prend en parametre le produit

        //verifie si le client a un panier ouvert
        // dd(Session::get('visitor_id'));
        $content = Storage::disk('public')->get('filename.txt');

        // dd($content);

        $data = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/commande/showbymac/" . $content)->json();
        // dd($data);
        //si oui
        if ($data) {
            // dd($data);
            $commande = $data[0]['id'];
            //ajouter le produit au panier d'abord
            $prod = $this->add_prod($id, $commande);

            if ($prod->successful()) {
                //afficher les produits du panier.

                return $this->panier_by_id($commande);
            }
        } else {
            // dd('pas de panier ouvert');
            // on cree une nouvelle commande pour l'user
            $commande = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withoutVerifying()->post($this->apiUrl . "/commande/create", [

                'montant' => 0,
                'adresse_mac' => $content,

            ]);
            // dd($commande);
            //ajouter le produit au panier
            if ($commande->successful()) {
                $data = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withoutVerifying()->get($this->apiUrl . "/commande/showbymac/" . $content)->json();
                if ($data) {
                    $commande = $data[0]['id'];

                    //ajouter le produit au panier d'abord
                    $prod = $this->add_prod($id, $commande);
                    if ($prod->successful()) {
                        //afficher les produits du panier.
                        return $this->panier_by_user();
                    }
                }
            }
        }
    }

    public function add_prod($boutique, $commande)
    {

        $add = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->post($this->apiUrl . "/panier/create", [

            'quantite' => 1,
            'boutique_produit' => $boutique,
            'commande' => $commande
        ]);
        // dd($add);
        return $add;
    }

    // les produits du panier
    public function panier_by_user()
    {
        $content = Storage::disk('public')->get('filename.txt');

        // dd($content);
        $somme = 0;
        $command_name = '';
        $commande_id = 0;
        $nombre = 0;

        $data = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/panier/showbymac/" . $content)->json();
        // dd($data);
        if ($data) {
            $nombre = count($data);
            $commande_id = $data[0]['id_commande'];
            foreach ($data as $value) {

                $somme += $value['quantite'] * $value['prix_produit'];
                $command_name = $command_name . $value['produit'];
            }
        }


        return view('landing.vente.panier', compact('data', 'somme', 'command_name', 'commande_id', 'nombre'));
    }

    public function update(Request $request)
    {
        // print_r($request->input("qtite"));
        // print_r($_SESSION['token']);
        // print_r($request->input("qtite"));
        $data = [

            "quantite" => $request->input("qtite"),
            "boutique_produit" => $request->input("boutique_produit"),
            "commande" => $request->input("commande"),
        ];

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->put($this->apiUrl . "/panier/update/" . $request->input("panier"), $data);

        if ($response->status() == 200) {

            $message =  "Produit modifié avec succés";
        } else {
            $message = "Erreur survenue lors de la modification";
        }
        return response(["message" => $message, "status" => $response->status()], 200);
    }

    public function forme($id)
    {
        $shop = '';
        $page = 0;
        $data = [];

        $data_shop = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/boutique/produits/" . $id)->json();
        if ($data_shop) {
            $shop = $data_shop[0]['boutique'];
            if (count($data_shop) % 6 == 0) {
                $page = count($data_shop) / 6;
            } else {
                $page = (count($data_shop) / 6) + 1;
            }

            if (count($data_shop) < 6) {
                $limit = count($data_shop);
            } else $limit = 6;


            $j = 0;
            for ($i = 0; $i < $limit; $i++) {
                $data[$j] = $data_shop[$i];
                $j++;
            }
        }
        $page = (int)$page;
        //temoignages
        $temoignages = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/temoignages")->json();
        $message = [];

        if (count($temoignages) >= 4) {
            for ($i = 0; $i < 4; $i++) {
                $message[$i] = $temoignages[$i];
            }
        }
        return view('landing.vente.listeProduit', compact('shop', 'data', 'page', 'message'));
    }


    //liste des produits selon la categorie
    public function prodByCat($id)
    {
        $cat = '';
        $page = 0;
        $prod_cat = [];
        $categorie = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/catproduit")->json();

        $tab = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/boutique/produit/categorie/" . $id)->json();
        if ($tab) {
            $cat = $tab[0]['cat_produit'];
            if (count($tab) % 6 == 0) {
                $page = count($tab) / 6;
            } else {
                $page = (count($tab) / 6) + 1;
            }
            if (count($tab) < 6) {
                $limit = count($tab);
            } else $limit = 6;


            $j = 0;
            for ($i = 0; $i < $limit; $i++) {
                $prod_cat[$j] = $tab[$i];
                $j++;
            }
            $page = (int)$page;
        }

        //temoignages
        $temoignages = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/temoignages")->json();
        $message = [];

        if (count($temoignages) >= 4) {
            for ($i = 0; $i < 4; $i++) {
                $message[$i] = $temoignages[$i];
            }
        }

        return view('landing.vente.prodByCat', compact('categorie', 'prod_cat', 'cat', 'page', 'message'));
    }

    //les produits du panier
    public function panier_by_id($id)
    {
        //    dd(session::get('visitor_id'));
        $somme = 0;
        $command_name = '';
        $commande_id = $id;
        $nombre = 0;

        $data = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/commande/showbyid/" . $id)->json();
        // dd($data);
        if ($data) {
            $nombre = count($data);
            foreach ($data as $value) {
                // dd($value['quantite']);
                $somme += $value['quantite'] * $value['prix_produit'];
                $command_name = $command_name . $value['produit'];
            }
        }


        return view('landing.vente.panier', compact('data', 'somme', 'command_name', 'commande_id', 'nombre'));
    }

    public function generateRandomString($length = 25)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    //payement de la commande
    public function payer(Request $request)
    {
        if (!$request->telephone) {
            $telephone = $_SESSION['telephone'];
        } else {
            $telephone = $request->telephone;
        }
        if ($request->livraison == 'O') {
            //payement a la livraison

            // Reference
            $date = date('Y-m-d H:i:s');
            $date = strtotime($date);
            // function de generation de key
            $ref = 'ref-' . $this->generateRandomString(5) . $date;

            //enregistrer la vente
            $vente = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->post(
                $this->apiUrl . "/vente/create",
                [

                    "commande" => $request->command_id,
                    "paiement" => 2,
                    "livraison" =>  1,
                    "localite" =>  $request->localite,
                    "valide" => 0,
                    "reference" => $ref

                ]
            );
            //update la commande
            $vente = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->put(
                $this->apiUrl . "/commande/update/" . $request->command_id,
                [

                    "montant" => $request->total,
                    "statut" => 0, //ferme
                    "client" => $_SESSION['id_utilisateur'],
                    "telephone" => $telephone

                ]
            );

            //retourne a la page avec les info de la commande et des produits du panier

            $data = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/vente/commande/" .  $request->command_id)->json();

            $content = Storage::disk('public')->get('filename.txt');

            $panier = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withoutVerifying()->get($this->apiUrl . "/commande/showbyid/" . $request->command_id)->json();
            //fermer la commande
            $commande_clos = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->put($this->apiUrl . "/commande/fermer/" . $request->command_id);

            return view('landing.vente.clos_panier', compact('data', 'panier'));
        } else {
            //on ne ferme op la commande car il peut retourner en arriere
            $livraison = null;
            $localite = $request->localite;;

            // Reference
            $date = date('Y-m-d H:i:s');
            $date = strtotime($date);
            // function de generation de key
            $ref = 'ref-' . $this->generateRandomString(5) . $date;

            $url = route('panier.vente', ['id' => $request->command_id, 'montant' => $request->total, 'telephone' => $telephone]);
            $success_url = $url . '?success=1&reference=' . $ref . '&livraison=' . $livraison . '&localite=' . $localite;
            // $cancel_url = route('panier.cancel', ['id' => $request->command_id]);
            $cancel_url = route('monPanier.produit');

            //paytech
            $payer = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->post(
                $this->apiUrl . "/paytech",
                [
                    "item_name" => $request->command_name,
                    "item_price" =>   $request->total,
                    "command_name" =>  $request->total . ' ' . $request->command_name,
                    "item_id" => $request->command_id,
                    "ref_command" => $ref,
                    "env" => 'test',
                    "success_url" => $success_url,
                    "cancel_url" => $cancel_url

                ]
            );

            if ($payer->successful()) {
                $paytech = $payer->object();
                if ($paytech->success != -1) {
                    return redirect($paytech->redirect_url);
                } else {
                    // dd($paytech);
                    return $paytech;
                }
            }
        }
    }

    public function vente($id, $montant, $telephone)
    {
        if (isset($_GET['success'])) {
            if ($_GET['success'] == 1 && isset($_GET['reference']) && isset($_GET['livraison']) && isset($_GET['localite'])) {
                $livraison = $_GET['livraison'];
                $reference = $_GET['reference'];
                $localite = $_GET['localite'];

                //enregistrer la vente
                $vente = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withToken($_SESSION['token'])->withoutVerifying()->post(
                    $this->apiUrl . "/vente/create",
                    [

                        "commande" => $id,
                        "paiement" => 1,
                        "livraison" => $livraison,
                        "localite" => $localite,
                        "valide" => 1,
                        "reference" => $reference

                    ]
                );

                if ($vente->successful()) {
                    //update montant de la commande

                    $vente = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ])->withToken($_SESSION['token'])->withoutVerifying()->put(
                        $this->apiUrl . "/commande/update/" . $id,
                        [

                            "montant" => $montant,
                            "statut" => 0,
                            "client" => $_SESSION['id_utilisateur'],
                            "telephone" => $telephone

                        ]
                    );
                    //retourne a la page avec les info de la commande et des produits du panier

                    $data = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/vente/commande/" .  $id)->json();

                    $content = Storage::disk('public')->get('filename.txt');
                    $panier = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ])->withoutVerifying()->get($this->apiUrl . "/panier/showbymac/" . $content)->json();

                    //fermer la commande
                    $commande_clos = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ])->withToken($_SESSION['token'])->withoutVerifying()->put($this->apiUrl . "/commande/fermer/" . $id);
                    return view('landing.vente.clos_panier', compact('data', 'panier'));
                }
            }
        }
    }

    public function cancel_command($id)
    {
        //pas de payement on supprime les produits du panier
        $supp_commande = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->delete($this->apiUrl . "/panier/supprimer_produit/" . $id);
        // dd($supp_commande);
        $message = 'Payement annulé , Votre commande a été cloturé ';
        return view('landing.vente.clos_panier', compact('message'));
    }

    public function pagination($page, $items_per_page)
    {

        //tous les produits des boutiques
        $tab_shop = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/boutique/produits/liste/all")->json();

        $j = 0;
        $shops = [];

        //mettre dans un tableau a partir de start jusqu'a end

        // Calculer la position de départ des données à récupérer dans la base de données
        $start = ($page - 1) * $items_per_page;

        $limit = $start + $items_per_page;
        if ($limit >= count($tab_shop)) {
            $limit = count($tab_shop);
            # code...
        }
        for ($i = $start; $i < $limit; $i++) {
            $shops[$j] = $tab_shop[$i];
            $j++;
        }
        return response()->json($shops, 200);
        // dd($shops);

        // return view('landing.vente.index', compact('shops', 'categorie'));
    }

    public function pagination_shop($page, $items_per_page, $boutique)
    {

        //tous les produits des boutiques
        $data = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/boutique/produits/" . $boutique)->json();

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

    public function pagination_cat($page, $items_per_page, $categorie)
    {

        //tous les produits des boutiques
        $data = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/boutique/produit/categorie/" . $categorie)->json();

        $j = 0;
        $shops = [];

        //mettre dans un tableau a partir de start jusqu'a end

        // Calculer la position de départ des données à récupérer dans la base de données

        $start = ($page - 1) * $items_per_page;


        $limit = $start + $items_per_page;
        // dd($limit);
        if ($limit >= count($data)) {
            $limit = count($data);
            # code...
        }
        // dd($data);
        for ($i = $start; $i < $limit; $i++) {
            $shops[$j] = $data[$i];
            $j++;
        }
        return response()->json($shops, 200);
    }

    //temoignage
    public function temoignage(Request $request)
    {
        // dd($request);

        // init error message
        $errmsg = '';
        // Check if pseudo and message have been entered
        if ($request->pseudo == '') {
            $errmsg .= '<p>Veuillez renseigner votre pseudo svp.</p>';
        }
        if ($request->message == '') {
            $errmsg .= '<p>Veuillez renseigner votre message svp.</p>';
        }

        $result = '';
        // If there are no errors, api
        if (!$errmsg) {
            $message = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withoutVerifying()->post(
                $this->apiUrl . "/temoignages/create",
                [
                    "pseudo" => $request->pseudo,
                    "commentaire" => $request->message,

                ]
            );

            $message_api = $message->object();
            // dd($message_api->message );
            $result = '<div class="alert alert-success"> Message envoye avec succes !</div>';


            // $result = '<div class="alert alert-success">Thank you for contacting us. Your message has been successfully sent. We will contact you very soon!</div>';
        } else {
            $result = '<div class="alert alert-danger">' . $errmsg . '</div>';
        }
        return $result;
    }

    // create shop by client
    public function create_shop(Request $request)
    {


        // init error message
        $errmsg = '';
        // Check if pseudo and message have been entered
        if ($request->name_boutique == '') {
            $errmsg .= '<p>Veuillez renseigner le nom de la boutique svp.</p>';
        }
        if ($request->desc_boutique == '') {
            $errmsg .= '<p>Veuillez renseigner une description de la boutique svp.</p>';
        }
        if ($request->fichier == null) {
            $errmsg .= '<p>Veuillez renseigner le logo de la boutique svp.</p>';
        }
        if ($request->localite == '') {
            $request->localite = 24633;

            // $errmsg .= '<p>Veuillez renseigner la localite svp.</p>';
        }

        $result = '';
        // If there are no errors, api
        if (!$errmsg) {
            $filename = Storage::disk('public')->put('boutiques', $request->fichier);

            $create_shop = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withoutVerifying()->post($this->apiUrl . "/boutique/create", [

                'nom' => $request->name_boutique,
                'localite' => $request->localite,
                "logo" => $filename,
                "description" => $request->desc_boutique,
            ]);


            if ($create_shop->successful()) {
                $result = '<div class="alert alert-success"> Votre demande a été bien prise en compte .Veuillez appeler notre service client pour activer votre boutique!</div>';
            } else {
                $errmsg = 'Veuillez reesayer svp.';
                $result = '<div class="alert alert-danger">' . $errmsg . '</div>';
            }
        } else {
            $result = '<div class="alert alert-danger">' . $errmsg . '</div>';
        }
        return $result;
    }

    public function comment()
    {
        return redirect()->route('shop.index');
    }
}
