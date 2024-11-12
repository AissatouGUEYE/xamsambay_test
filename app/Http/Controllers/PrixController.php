<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PrixController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function index()
    {
        $unites = [];
        $cat_produits = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/catproduit")->json();

        $produits = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/produit")->json();

        $campagnes = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/campagnes/actif")->json();

        $varietes = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/variete")->json();

        $unite_generales = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite")->json();

//        dd($unite_generales);
        foreach ($unite_generales as $unite_generale) {
            if ($unite_generale['type_unite'] === "quantite") $unites[] = $unite_generale;
        }


        $marches = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/market")->json();

        $prix = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/prix")->json();

        // return $prix;

        $groupements = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/groupements")->json();
        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {
            return view('services.prix_du_marche.prix.index', [
                'prix' => $prix, 'produits' => $produits, 'varietes' => $varietes, 'unites' => $unites,
                'campagnes' => $campagnes, 'marches' => $marches, 'cat_produits' => $cat_produits, "groupements" => $groupements
            ]);
        } else {
            $groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/entite/groupements/" . $_SESSION['id_entite'])->json();
            return view('services.prix_du_marche.prix.index', ['prix' => $prix, 'groupements' => $groupements, 'prix' => $prix, 'produits' => $produits, 'varietes' => $varietes, 'unites' => $unites,
                'campagnes' => $campagnes, 'marches' => $marches, 'cat_produits' => $cat_produits]);
        }
    }

    public function create()
    {
        $cat_produits = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/catproduit")->json();

        $produits = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/produit")->json();

        // return $producteurs;
        $campagnes = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/mlcampagne")->json();

        $varietes = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/variete")->json();

        $unites = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite")->json();

        $marches = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/market")->json();

        return view('services.prix_du_marche.prix.index', [
            'produits' => $produits, 'varietes' => $varietes, 'unites' => $unites,
            'campagnes' => $campagnes, 'marches' => $marches, 'cat_produits' => $cat_produits
        ]);
    }

    public function store(Request $request)
    {
        $token = strval($_SESSION['token']);
        $url = $this->apiUrl . "/prix/create";

        $date = str_replace('/', '-', $request->input('date'));
        $date = date('Y-m-d', strtotime($date));

        $varieties = $request->input('variete');
        $retailPrices = $request->input('prix_detaillant');
        $wholesalePrices = $request->input('prix_en_gros');

        $data = [];

        for ($i = 0; $i < count($varieties); $i++) {
            $variete = $varieties[$i];
            $prix_detaillant = $retailPrices[$i];
            $prix_en_gros = $wholesalePrices[$i];

            if(($prix_detaillant != null) || ($prix_en_gros != null)) {

                $data[] = [
                    'profil' => $_SESSION['id'],
                    'produit' => $request->input('produit'),
                    'variete' => $variete,
                    'unite' => $request->input('unite'),
                    'market' => $request->input('market'),
                    'date' => $date,
                    'prix_detaillant' => $prix_detaillant,
                    'prix_en_gros' => $prix_en_gros
                ];

            }

        }

        for ($i = 0; $i < count($data); $i++) {
            Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($token)->withoutVerifying()->post($url, $data[$i]);
        }

        return redirect('/prix-du-marche/prix');
    }

    public function modifier($id)
    {
        $prix = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/prix/" . $id);

        $cat_produits = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/catproduit")->json();

        $produits = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/produit")->json();

        $campagnes = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/mlcampagne")->json();

        $varietes = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/variete")->json();

        $unites = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite")->json();

        $marches = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/market")->json();


        // return $campagnes;
        return view('services.prix_du_marche.admin.edit', [
            'prix' => $prix, 'produits' => $produits, 'varietes' => $varietes, 'unites' => $unites,
            'campagnes' => $campagnes, 'marches' => $marches, 'cat_produits' => $cat_produits
        ]);
    }

    public function edit(Request $request)
    {
        $token = strval($_SESSION['token']);
        $id = $request->id;
        $url = $this->apiUrl . "/prix/update/" . $id;

        $date = str_replace('/', '-', $request->date);
        $date = date('Y-m-d', strtotime($date));

        if (isset($request->variete)) {

            $variete = $request->variete;
        } else {

            $variete = null;
        }

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->put($url, [
            'profil' => $_SESSION['id'],
            'produit' => $request->produit,
            'variete' => $request->variete,
            'unite' => $request->unite,
            'market' => $request->market,
            'date' => $date,
            // 'campagne' => $request->campagne,
            'prix_detaillant' => $request->prix_detaillant,
            'prix_en_gros' => $request->prix_en_gros

        ]);

        return redirect('/prix-du-marche/prix');
    }

    public function delete($id)
    {
        $token = strval($_SESSION['token']);
        $url = $this->apiUrl . "/prix/delete/" . $id;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->delete($url);

        return redirect('/prix-du-marche/prix');
    }

    public function make_push($id)
    {
        $prix = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/prix/" . $id);
        $prix = $prix->object();
        return view('services.prix_du_marche.prix.push_sms', compact("prix"));
    }

    public function sms(Request $request)
    {

        if ($request->message && $request->id_produit && $request->region) {
            # code...
            $sms = $request->message;
            $produit = $request->id_produit;
            $region = $request->region;
            $data = [
                "alerte" => "Prix",
                "message" => $sms,
                "id_utilisateur" => $_SESSION['id_utilisateur'],
                "id_collecte" => "null",
                "id_pluvio" => "null"
            ];
            $req = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()
                ->post($this->apiUrl . "/sms/envoi/null/null/null/" . $region . "/null/null/null/null/null/" . $produit, $data);
            // dd($req->object());
            if ($req->status() == 200) {
                # code...
                $message = "Prix diffuser avec succés";
                $status = 200;
            } else {
                $message = "Diffusion échouée. Veuillez contacter l'administrateur";
                $status = 500;
            }

        }
        return response(["message" => $message, "status" => $status]);
    }

    public function push_history()
    {
        # code...

        $hist_prix_sms = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/sms/stat_sms_prix/5");
        $hist_prix_sms = $hist_prix_sms->object();
        // print_r($hist_prix_sms[0]->sms);
        // $hist_prix_sms2 = Http::withHeaders([
        //     'Accept' => 'application/json',
        //     'Content-Type' => 'application/json',
        // ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/sms/all_stat_sms");
        // $hist_prix_sms2 = $hist_prix_sms2->object();
        return view("services.prix_du_marche.prix.diffusion-hist", compact("hist_prix_sms"));

    }

    public function history_details($message, $date)
    {

        # code...
        $data = [
            "sms" => Str::replaceFirst('_', '/', $message),
            "date" => $date
        ];
        // dd($data['sms']);
        $smss = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/sms_date/5", $data);
        $smss = $smss->object();
        return view("services.prix_du_marche.prix.sms-details-hist", compact("smss"));


    }
}
