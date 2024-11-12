<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class EBController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function indexSe()
    {

        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/eb/filtrer/null/3/1/null/null/null');

        if ($request->successful()) {
            $eb = $request->object();
            return view('services.expression_de_besoin.se.index',compact('eb'));      # code...
        }
    }

    public function index()
    {
        $cours = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/cours")->json();


        $cat_produits = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/catproduit")->json();

        $produits = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/produit")->json();

        $varietes = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/variete")->json();

        $unites = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite/type/1")->json();

        $unite_monnaie = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite/type/4")->json();

        $type_eb = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/type_eb")->json();


        $type_intrants = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/intrants/types")->json();

        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {
            $eb = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/eb/all")->json();
        } else {
            $eb = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/eb/non_traites")->json();
        }

        $groupements = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/groupements")->json();

        $formations = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/formations")->json();

        $offres = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/offrebanque")->json();

        $type_engrais = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/engrais/types")->json();

        $intrants = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/produit/categorie/4")->json();

        $type_semences = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/semences/types")->json();

        $type_assurances = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/assurances/types")->json();

        $departements = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/departements")->json();

        $zones = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/zones")->json();


        // return $eb;

        return view('services.expression_de_besoin.liste', compact(
            'zones',
            'departements',
            'type_assurances',
            'groupements',
            'type_engrais',
            'type_semences',
            'type_intrants',
            'cours',
            'eb',
            'type_eb',
            'cat_produits',
            'produits',
            'varietes',
            'unites',
            'formations',
            'offres',
            'intrants',
            'unite_monnaie'
        ));
    }


    public function show($id)
    {
        // $message = session('message');

        $eb = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/eb/show/" . $id)->json();

        // return $eb;
        $unites = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite/type/1")->json();

        $unite_monnaie = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite/type/4")->json();

        return view('services.expression_de_besoin.detail', compact('eb', 'unites', 'unite_monnaie'));
    }


    // public function create(Request $request)
    // {
    //     $type_eb = $request->type_eb;

    //     if ($type_eb = 2) {

    //         $offres = Http::withHeaders([
    //             'Accept' => 'application/json',
    //             'Content-Type' => 'application/json',
    //         ])->withToken($_SESSION['token'])->withoutVerifying()->get("https://api.mlouma.org/api/offrebanque")->json();

    //         // return $offres;
    //         return view('services.expression_de_besoin.offrebanque', compact('offres'));
    //     }
    //     else {
    //         $type_eb_infos = Http::withHeaders([
    //             'Accept' => 'application/json',
    //             'Content-Type' => 'application/json',
    //         ])->withToken($_SESSION['token'])->withoutVerifying()->get("https://api.mlouma.org/api/type_eb/". $type_eb)->json();
    //             // return $type_eb;

    //         $cat_produits = Http::withHeaders([
    //             'Accept' => 'application/json',
    //             'Content-Type' => 'application/json',
    //         ])->withToken($_SESSION['token'])->withoutVerifying()->get("https://api.mlouma.org/api/catproduit")->json();

    //         $produits = Http::withHeaders([
    //             'Accept' => 'application/json',
    //             'Content-Type' => 'application/json',
    //         ])->withToken($_SESSION['token'])->withoutVerifying()->get("https://api.mlouma.org/api/produit")->json();

    //         // return $producteurs;
    //         $varietes = Http::withHeaders([
    //             'Accept' => 'application/json',
    //             'Content-Type' => 'application/json',
    //         ])->withToken($_SESSION['token'])->withoutVerifying()->get("https://api.mlouma.org/api/variete")->json();

    //         $unites = Http::withHeaders([
    //             'Accept' => 'application/json',
    //             'Content-Type' => 'application/json',
    //         ])->withToken($_SESSION['token'])->withoutVerifying()->get("https://api.mlouma.org/api/unite")->json();

    //         return view('services.expression_de_besoin.create', compact('type_eb', 'cat_produits', 'produits', 'varietes', 'unites', 'type_eb_infos'));
    //     }



    // }

    public function store(Request $request)
    {
        $token = strval($_SESSION['token']);
        $url = $this->apiUrl . "/eb/create";

        // $formation = explode(',', $request->formation);
        // return $formation[1];

        // $formation = serialize($request->formation);
        // return $formation;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->post($url, [

            'profil' => $_SESSION['id'],
            'qte' => $request->qte,
            'from' => $request->from,
            'to' => $request->to,
            'description' => $request->description,
            'type_eb' => $request->type_eb,
            'produit' => $request->produit,
            'variete' => $request->variete,
            'formule' => $request->formule,
            'type_semence' => $request->type_semence,
            'type_assurance' => $request->type_assurance,
            'unite' => $request->unite,
            'offre_banque' => $request->offre_banque,
            'montant' => $request->montant,
            'formation' => $request->formation,
            'type_intrant' => $request->type_intrant,

        ]);

        // return redirect('/langue');
        return redirect('/expression-de-besoin');
    }

    public function offre(Request $request)
    {
        $token = strval($_SESSION['token']);
        $url = $this->apiUrl . "/eb_offre/create";

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->post($url, [

            'eb' => $request->eb,
            'description' => $request->description,
            'quantite' => $request->quantite,
            'montant' => $request->montant,
            'unite' => $request->unite,
            'prix' => $request->prix,
            'unite_prix' => $request->unite_prix,

        ]);

        return redirect('/expression-de-besoin/details/' . $request->eb)
            ->with('message', 'Offre Soumise Avec Succès');
    }

    public function liste_offre($id)
    {
        $token = strval($_SESSION['token']);

        $offres = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->get($this->apiUrl . "/eb_offre/eb/" . $id);

        $offres = json_decode($offres, true);
        // return $offres;

        return view('services.expression_de_besoin.offre', compact('offres'));
    }

    public function modifier($id)
    {
        $langue = Http::withoutVerifying()->get($this->apiUrl . "/showlangue/" . $id);

        return view('gestion.langue.edit', compact('langue', 'langue'));
    }

    public function edit(Request $request)
    {
        $token = strval($_SESSION['token']);
        $id = $request->id;
        $url = $this->apiUrl . "/editelangue/" . $id;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->put($url, [

            'langue' => $request->langue

        ]);

        return redirect('/langue');
    }

    public function delete($id)
    {
        $token = strval($_SESSION['token']);
        $url = $this->apiUrl . "/deletelangue/" . $id;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->delete($url);

        return redirect('/langue');
    }


    public function filter(Request $request)
    {
        $inputs = $request->all();
        $type_eb_filter = $inputs['eb-list-type'];
        $grp_filter = $inputs['grp-list'];
        $dept_filter = $inputs['dept-list'];
        $zone_filter = $inputs['zone-list'];

        // return $dept_filter;

        $statut = $inputs['eb-list-statut'];

        $etat = $inputs['eb-list-etat'];

        // return $etat;

        // if($etat == 3)
        // {
        //     $etat = 'null';
        // }

        // return $etat;

        $token = strval($_SESSION['token']);
        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {
            $url = $this->apiUrl . "/eb/filtrer/" . $grp_filter . "/" . $type_eb_filter . "/" . $statut . "/" . $etat . "/" . $dept_filter . "/" . $zone_filter;
        } else {
            $url = $this->apiUrl . "/eb/non_traites/filtrer/" . $grp_filter . "/" . $type_eb_filter . "/" . $etat . "/" . $statut . "/" . $dept_filter . "/" . $zone_filter;
        }

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

        if ($type_eb_filter != null && $type_eb_filter != 'null') {

            $type_eb_filter_infos = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/type_eb/" . $type_eb_filter)->json();

            // return $type_eb_filter_infos;

            // return 'OK';

            $type_eb_filter_name = $type_eb_filter_infos['type_eb'];
            $type_eb_filter_id = $type_eb_filter_infos['id'];
        } else {
            // return 'dafa null';
            $type_eb_filter_infos = null;

            $type_eb_filter_name = null;

            $type_eb_filter_id = null;
        }


        if ($dept_filter != null && $dept_filter != 'null') {

            $dept_filter_infos = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($token)->withoutVerifying()->get($this->apiUrl . "/departements/" . $dept_filter)->json();

            // return $grp_filter_infos;

            $dept_filter_name = $dept_filter_infos[0]['departement'];
            $dept_filter_id = $dept_filter_infos[0]['id'];
        } else {
            // return 'dafa null';
            $dept_filter_infos = null;

            $dept_filter_name = null;

            $dept_filter_id = null;
        }


        if ($zone_filter != null && $zone_filter != 'null') {

            $zone_filter_infos = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($token)->withoutVerifying()->get($this->apiUrl . "/zones/" . $zone_filter)->json();

            // return $grp_filter_infos;

            $zone_filter_name = $zone_filter_infos[0]['designation'];
            $zone_filter_id = $zone_filter_infos[0]['id'];
        } else {
            // return 'dafa null';
            $zone_filter_infos = null;

            $zone_filter_name = null;

            $zone_filter_id = null;
        }


        $eb = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->get($url)->json();

        $type_intrants = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/intrants/types")->json();

        // return $url;

        $cat_produits = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/catproduit")->json();

        $produits = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/produit")->json();

        // return $producteurs;
        $varietes = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/variete")->json();

        $unites = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite")->json();

        $unite_monnaie = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/unite/type/4")->json();

        $type_eb = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/type_eb")->json();

        $formations = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/formations")->json();

        $offres = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/offrebanque")->json();


        $intrants = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/produit/categorie/4")->json();

        $type_engrais = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/engrais/types")->json();

        $cours = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/cours")->json();

        $type_semences = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/semences/types")->json();

        $type_assurances = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/assurances/types")->json();

        $groupements = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/groupements")->json();


        $departements = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/departements")->json();


        $zones = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/zones")->json();


        return view('services.expression_de_besoin.liste', compact(
            'zones',
            'departements',
            'type_assurances',
            'groupements',
            'type_engrais',
            'type_semences',
            'type_intrants',
            'cours',
            'etat',
            'statut',
            'type_eb_filter_name',
            'type_eb_filter_id',
            'type_eb_filter',
            'grp_filter_libelle',
            'grp_filter_id',
            'eb',
            'type_eb',
            'cat_produits',
            'produits',
            'varietes',
            'unites',
            'formations',
            'offres',
            'intrants',
            'dept_filter_name',
            'dept_filter_id',
            'zone_filter_name',
            'zone_filter_id',
            'unite_monnaie'
        ));
    }
}
