<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use DateTime;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PackMonitoringController extends Controller
{

    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }
    //CRUD PACK pour le Profil

    public function index()
    {

        $packLists = array();
        $packXeweul = array();
        $packConfort = array();
        $packPrestige = array();
        $packTest = array();
        $idProfil = $_SESSION['id'];
        $souscrisTestSMS =  false;
        $souscrisTestVOICE =  false;
        // recuperer toute la liste des Packs si c'est un admin

        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {
            $acteur = '';
        } else {
            $acteur = $_SESSION['role'];
            if ($_SESSION['role'] === "AUOP" || $_SESSION['role'] === "UOP") {
                $acteur = "OP";
            }
        }


        // si c'est un profil a part recuperer ses propres packs

        $packList = $this->getPackByProfil($acteur);

        foreach ($packList as $item) {
            $desc = $item->descriptionpack;
            $desc = str_replace("[", "", $desc);
            $desc = str_replace("]", "", $desc);
            $desc = str_replace("\"", "", $desc);
            $array_desc = explode(",", $desc);
            $item->descriptionpack = $array_desc;
        }

        $packTest1 = $this->getPackByProfil('TEST');
        //List Abonnement
        $abonnementList = $this->getAbonnementList($idProfil);

        // dd($abonnementList);

        foreach ($packTest1 as $item) {
            $desc = $item->descriptionpack;
            $desc = str_replace("[", "", $desc);
            $desc = str_replace("]", "", $desc);
            $desc = str_replace("\"", "", $desc);
            $array_desc = explode(",", $desc);
            $item->descriptionpack = $array_desc;
            foreach ($abonnementList as $key => $abonnement) {
                # code...
                if ($abonnement->id_pack == $item->id) {
                    if ($item->canal == 'SMS') {
                        $souscrisTestSMS = true;
                    } else {
                        $souscrisTestVOICE = true;
                    }
                }
            }
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
            if ($item->type_pack == 'DEFAUT') {
                array_push($packTest, $item);
            }
        }
        array_push($packLists, $packTest, $packXeweul, $packConfort, $packPrestige);

        return view('gestion.packs.index', ['pack' => $packList, 'packs' => $packLists, 'profil' => $_SESSION['role'], 'testProfil' => $packTest1, 'testSMS' => $souscrisTestSMS, 'testVOICE' => $souscrisTestVOICE, 'abonnements' => $abonnementList]);
    }

    public function create()
    {
        $services = $this->getService();
        // dd($services);
        $profils = $this->getRole();

        $typePack = $this->getTypePack();
        $durePack = $this->getDureePack();
        // dd($durePack);

        // lister les services aussi

        return view('gestion.packs.create', ['profils' => $profils, 'services' => $services, 'typePacks' => $typePack, 'duree' => $durePack]);
    }

    public function validation($id, $acteur)
    {
        if($acteur == 'GREENAPI'){

            $success = 0;
            $profil = $_SESSION['id'];
            $abonnements = $this->get_greenapi_abon($profil);

            if(isset($_GET['success'])){

                if($_GET['success'] == 1){
                    $success=1;
                }
                elseif($_GET['success'] == 4) {
                    $success=4;

                }
            }
            else {
                foreach ($abonnements as $abonnement) {
                    if ($abonnement->pack->id == $id) {
                        $today = Carbon::now();
                        if ($abonnement->date_prochain_paiement > $today) {
                            $success = 2;
                        }
                        else {
                            $success = 3;
                        }
                        break;
                    }
                }
            }

            $packList = $this->getPackGreenapi();
            $pack = null;

            foreach ($packList as $packItem) {

                if ($packItem->id == $id) {
                    $pack = $packItem;
                    break;
                }
            }

            // $success = 4;
            return view('gestion.greenapi.packs.validation', compact('pack', 'success'));
        }
        $souscris = false;
        $effectif = 1;
        $tarif = 1;
        $payer = false;
        $abonnementId = null;
        $abonnement = null;
        $nb_sms_restant = 0;
        $nb_sec_voice_restant = 0;
        $idProfil = $_SESSION['id'];

        // Recuperer le pack a partir de l'acteur

        $packList = $this->getPackByProfil($acteur);

        // suivant la liste des pack chosir le bon

        foreach ($packList as $packItem) {

            if ($packItem->id == $id) {
                $pack = $packItem;
            }
        }
        // checker si le parametre succes est passe
        // Si oui
        // Verifier si c'est a 1 si oui
        // Mettre a jour la table abonnement
        if (isset($_GET['success'])) {
            if ($_GET['success'] == 1 && isset($_GET['reference'])) {
                $ref = $_GET['reference'];
                $eff = $_GET['effectif'];

                // dd($eff);
                if ($pack->canal === 'SMS') {
                    $nb_sms_restant = $pack->nombre;
                } else {
                    $nb_sec_voice_restant = $pack->nombre;
                }

                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withToken($_SESSION['token'])
                    ->withOptions(['verify' => false])
                    ->withoutVerifying()
                    ->post($this->apiUrl . "/abonnement/create", [
                        'pack' => $id,
                        'profil' => $idProfil,
                        'nb_sms_restant' => $nb_sms_restant * $eff,
                        'nb_sec_voice_restant' => $nb_sec_voice_restant * $eff,
                        'reference' => $ref,
                        'effectif' => $eff,
                        'status' => true,
                        'type_abonnement' => null,
                        'service'=>null
                    ]);

                // recuperer liste abonnement
                if ($response->successful()) {

                    $abonnementList = $this->getAbonnementList($idProfil);

                    //Update table Abonnement
                    foreach ($abonnementList as $value) {
                        if ($value->id_pack == $id) {
                            $abonnement = $value;
                        }
                    }

                    $response = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        // 'Authorization' => $_SESSION['token']
                    ])->withToken($_SESSION['token'])
                        ->withOptions(['verify' => false])
                        ->withoutVerifying()
                        ->put($this->apiUrl . "/abonnement/payer/" . $abonnement->id_abonnement);
                    // $message = $response->object()->message;
                    if ($response->successful()) {
                        return redirect(route('packs.validation', ['id' => $id, 'acteur' => $acteur]));
                    }
                }
            }
        } elseif (isset($_GET['renew']) && isset($_GET['reference'])) {
            #Renouvellement Pack
            $ref = $_GET['reference'];
            // dd($ref);
            // $eff = $_GET['effectif'];
            $idAbonnement = $_GET['renew'];
            // dd($ref);
            #...
            $request = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/" . "abonnement/" . $idAbonnement);
            $abonnementArr = $request->object();
            $abonnement  = $abonnementArr[0];
            // dd($abonnement);

            $request = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withoutVerifying()->get($this->apiUrl . "/pack");
            $packList = $request->object();

            foreach ($packList as $item) {
                if ($item->id == $abonnement->id_pack) {
                    $pack = $item;
                }
            }
            // https://api.mlouma.org/api/abonnement/75/ref-UQIP123
            # Renouveller le Pack API... idAbonnement & New Ref

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/" . "abonnement/" . $idAbonnement . "/" . $ref);

            # Si ok retourner vers validation
            if ($response->successful()) {
                return redirect(route('packs.validation', ['id' => $id, 'acteur' => $acteur]));
            }
        }

        $packList = $this->getPackByProfil($acteur);

        foreach ($packList as $packItem) {
            if ($packItem->id == $id) {
                $pack = $packItem;
            }
        }

        $abonnementList = $this->getAbonnementList($idProfil);
        foreach ($abonnementList as $value) {
            if (!$souscris && $value->id_pack == $pack->id) {
                $souscris = true;
                $payer = $value->payer;
                $abonnementId = $value->id_abonnement;
                $effectif = $value->effectif;
                $tarif = $value->pricing * $effectif;
                $abonnement = $value;
            }
        }

        // Recuperer la liste des produits
        $productList = $this->getProduit();
        // recuperer liste des marches
        $marketList = $this->getMarkets();
        // recuperer liste des cours
        $stuffList = $this->getStuff();

        // dd($abonnementId);
        $modules = $this->getServiceAbonnement($abonnementId);
        // dd($modules);

        //songer a faire une redirection et faire un clean de l'url
        return view('gestion.packs.validation', ['pack' => $pack, 'souscris' => $souscris, 'payer' => $payer, 'idAbonnement' => $abonnementId, 'effectif' => $effectif, 'tarif' => $tarif, 'produits' => $productList, 'markets' => $marketList, 'cours' => $stuffList, 'abonnement' => $abonnement, 'modules' => $modules]);
    }


    public function suscribeService($pack)
    {
        $idProfil = $_SESSION['id'];

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->post($this->apiUrl . "/greenapi_inscriptions", [
                        'profil_id' => $idProfil,
                        'pack_id' => $pack,
                    ]);

        if ($response->successful()) {
            $paytech = $response->object();
            if ($paytech->success != -1) {
                return redirect($paytech->redirect_url);
            } else {
                return $paytech;
            }
        }
    }

    public function renouveler($pack)
    {
        $idProfil = $_SESSION['id'];

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->post($this->apiUrl . "/greenapi_inscriptions/mensuel", [
                        'profil_id' => $idProfil,
                        'pack_id' => $pack,
                    ]);

        if ($response->successful()) {
            $paytech = $response->object();
            if ($paytech->success != -1) {
                return redirect($paytech->redirect_url);
            } else {
                return $paytech;
            }
        }
    }

    public function greenapi_packs()
    {
        $idProfil = $_SESSION['id'];

        $packList = $this->getPackGreenapi();

        $abonnementList = $this->get_greenapi_abon($idProfil);

        $today = Carbon::now();
        // return $abonnementList;

        return view('gestion.greenapi.packs.index', ['pack' => $packList, 'abonnements' => $abonnementList, 'today' => $today]);


    }

    public function confirm($pack){

        $idProfil = $_SESSION['id'];
        if (isset($_GET['success'])) {
            if ($_GET['success'] == 1 && isset($_GET['reference'])) {
                $ref = $_GET['reference'];

                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withToken($_SESSION['token'])
                    ->withOptions(['verify' => false])
                    ->withoutVerifying()
                    ->post($this->apiUrl . "/greenapi_inscriptions", [
                        'profil_id' => $idProfil,
                        'pack_id' => $pack,
                    ]);

                if ($response->successful()) {

                    return redirect(route('packs.validation', ['id' => $pack, 'acteur' => 'GREENAPI']));
                }

            }
        } elseif (isset($_GET['renew']) && isset($_GET['reference'])) {

        }
    }
    public function souscription($id)
    {
        $user_id = $_SESSION['id'];
        $pack = null;
        $nb_sms_restant = 0;
        $nb_sec_voice_restant = 0;
        $effectif = (isset($_GET['effectif'])) ? $_GET['effectif'] : 1;
        $ref = '';
        $statut = false;

        $packList = $this->getAllPack();
        foreach ($packList as $item) {
            if ($item->id == $id) {
                $pack = $item;
            }
        }
        // Reference
        $date = date('Y-m-d H:i:s');
        $date = strtotime($date);
        // function de generation de key
        $ref = 'ref-' . $this->generateRandomString(5) . $date;

        if ($pack) {
            $acteur = $pack->type_entite;

            $price = (isset($_GET['prix'])) ? $_GET['prix'] : $pack->pricing;

            // if (isset($_GET['prix'])) {
            //     $price = $_GET['prix'];
            // } else {
            //     $price = $pack->pricing;
            // }

            $command_name = $pack->type_pack . "-" . $pack->canal . "-" . $pack->type_entite;

            $url = route('packs.validation', ['id' => $id, 'acteur' => $acteur]);
            $success_url = $url . '?success=1&reference=' . $ref . '&effectif=' . $effectif;
            $cancel_url = $url;
            // Verifier si le pack n'est pas un paack Test
            // if ($pack->type_entite != "TEST" && $pack->type_entite != "ONG") {
            // Faire si Pack - type entite == INDIV
            if ($pack->type_entite == "INDIVIDUEL") {
                $response1 = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    // 'Authorization' => $_SESSION['token']
                ])->withToken($_SESSION['token'])
                    ->withOptions(['verify' => false])
                    ->withoutVerifying()
                    ->post($this->apiUrl . "/paytech", [
                        "item_name" => $command_name,
                        "item_price" =>   $price,
                        "command_name" =>  $user_id . ' ' . $command_name,
                        "item_id" => $pack->id,
                        "ref_command" => $ref,
                        "env" => 'test',
                        "success_url" => $success_url,
                        "cancel_url" => $cancel_url
                    ]);

                if ($response1->successful()) {
                    $paytech = $response1->object();
                    // dd($paytech);
                    if ($paytech->success != -1) {
                        return redirect($paytech->redirect_url);
                    } else {
                        return $paytech;
                    }
                }
            } else {
                // Pack Test

                if ($pack->type_entite == "TEST") {
                    # code...
                    if ($pack->canal === 'SMS') {
                        $nb_sms_restant = $pack->nombre;
                    } else {
                        $nb_sec_voice_restant = $pack->nombre;
                    }
                    $statut = true;
                }

                //  Others Packs

                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withToken($_SESSION['token'])
                    ->withOptions(['verify' => false])
                    ->withoutVerifying()
                    ->post($this->apiUrl . "/abonnement/create", [
                        'pack' => $id,
                        'profil' => $user_id,
                        'nb_sms_restant' => $nb_sms_restant * $effectif,
                        'nb_sec_voice_restant' => $nb_sec_voice_restant * $effectif,
                        'reference' => $ref,
                        'effectif' => $effectif,
                        'status' => $statut
                    ]);

                // recuperer liste abonnement
                if ($response->successful()) {
                    if ($pack->type_entite == "TEST") {

                        $abonnementList = $this->getAbonnementList($user_id);

                        foreach ($abonnementList as $value) {
                            if ($value->id_pack == $id) {
                                $abonnement = $value;
                            }
                        }

                        //Update table Abonnement
                        $response = Http::withHeaders([
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            // 'Authorization' => $_SESSION['token']
                        ])->withToken($_SESSION['token'])
                            ->withOptions(['verify' => false])
                            ->withoutVerifying()
                            ->put($this->apiUrl . "/abonnement/payer/" . $abonnement->id_abonnement);
                        // $message = $response->object()->message;
                        if ($response->successful()) {
                            return redirect(route('packs.validation', ['id' => $id, 'acteur' => $pack->type_entite]));
                        }
                    }
                    return redirect(route('packs.validation', ['id' => $id, 'acteur' => $pack->type_entite]));
                }
            }
        }
    }

    // liste des Souscriptions Initie
    public function souscriptions()
    {
        $packsInitie = array();
        $abonnementList = $this->getAllAbonnement();
        // dd($abonnementList);
        // foreach ($abonnementList as $key => $abonnement) {
        //     # code...
        //     if ($abonnement->status == 0) {
        //         array_push($packsInitie, $abonnement);
        //     }
        // }

        // $packs = (object) $packsInitie;
        // dd($packs);
        return view('gestion.packs.souscription', ['packs' => $abonnementList]);
    }

    public function journalSouscriptions()
    {

        $packsValide = array();
        $abonnementList = $this->getAllAbonnement();
        // dd($abonnementList);
        foreach ($abonnementList as $key => $abonnement) {
            # code...
            if ($abonnement->status != 0 && $abonnement->type_pack != "DEFAUT") {
                array_push($packsValide, $abonnement);
            }
        }

        $packs = (object) $packsValide;
        // dd($packs);
        return view('gestion.packs.journals', ['packs' => $packs]);
    }

    public function detailsSouscriptions($id)
    {
        $abonnementItem = null;
        $abonnementList = $this->getAllAbonnement();
        foreach ($abonnementList as $key => $abonnement) {
            # code...
            if ($abonnement->id_abonnement == $id) {
                $abonnementItem = $abonnement;
            }
        }
        // dd($packs);
        return view('gestion.packs.detailsSouscription', ['pack' => $abonnementItem]);
    }

    public function addContrat(Request $request)
    {
        // dd($request);
        $abonnement = $request->idAbonnement;
        $id = $request->idPack;
        $acteur = $request->acteur;
        $name = null;

        if ($request->glist) {
            $name = Storage::disk('public')->put('contrats', $request->glist);
        }
        // dd($name);

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put($this->apiUrl . "/abonnement/fichier/" . $abonnement, [
            "fichier" => $name
        ]);
        // $uploadContrat = $response->object();
        // return;
        if ($response->successful()) {
            return redirect(route('packs.validation', ['id' => $id, 'acteur' => $acteur]));
            // return vers validation
        }
    }

    public function renouvellement($idAbonnement)
    {
        $ref = '';
        $user_id = $_SESSION['id'];
        // Reference
        $date = date('Y-m-d H:i:s');
        $date = strtotime($date);
        // function de generation de key
        $ref = 'ref-' . $this->generateRandomString(5) . $date;
        $effectif = 1;
        if (isset($_GET['effectif'])) {
            $effectif = $_GET['effectif'];
        }

        // Renouvellement Pack
        // Recuperer les infos besoin sur la table abonnement
        //  lors du renouvellement faire part a Assane si profil ONG de remettre le statut a initi2
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/abonnement/" . $idAbonnement);
        $abonnementArr = $request->object();
        $abonnement  = $abonnementArr[0];
        // dd($abonnement);
        $packList = $this->getAllPack();

        foreach ($packList as $item) {
            if ($item->id == $abonnement->id_pack) {
                $pack = $item;
            }
        }

        $acteur = $pack->type_entite;
        if (isset($_GET['prix'])) {
            $price = $_GET['prix'];
        } else {
            $price = $pack->pricing;
        }
        $command_name = $pack->type_pack . "-" . $pack->canal . "-" . $pack->type_entite;

        $url = route('packs.validation', ['id' => $abonnement->id_pack, 'acteur' => $acteur]);
        $success_url = $url . '?renew=' . $idAbonnement . '&reference=' . $ref . '&effectif=' . $effectif;
        $cancel_url = $url;
        if ($acteur == 'INDIVIDUEL') {

            $response1 = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])
                ->withOptions(['verify' => false])
                ->withoutVerifying()
                ->post($this->apiUrl . "/paytech", [
                    "item_name" => $command_name,
                    "item_price" =>   $price,
                    "command_name" =>  $user_id . ' ' . $command_name,
                    "item_id" => $pack->id,
                    "ref_command" => $ref,
                    // "env" => 'test',
                    "success_url" => $success_url,
                    "cancel_url" => $cancel_url
                ]);

            if ($response1->successful()) {
                $paytech = $response1->object();
                // dd($paytech);
                if ($paytech->success != -1) {
                    return redirect($paytech->redirect_url);
                } else {
                    return $paytech;
                }
            }
        } else {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->put($this->apiUrl . "/" . "abonnement/" . $idAbonnement . "/" . $ref);

            // dd($response);

            # Si ok retourner vers validation
            if ($response->successful()) {
                return redirect(route('packs.validation', ['id' => $pack->id, 'acteur' => $acteur]));
            }
        }



        // Generer un nouveau Reference
        // Faire le paiement avec Paytech
        // Si Oui
        // Recuperer les infos sur la table des packs
        // Update les infos sur la table (ajout Sms ou voice )
        // Changer le ref

    }

    public function activerPack($id)
    {
        // dd($canal);
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->put($this->apiUrl . "/abonnement/payer/" . $id);

        $request1 = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put($this->apiUrl . "/abonnement/active/" . $id);
        // dd($request1);
        if ($request1->successful()) {
            return redirect(route('packs.souscriptions'));
        }
    }

    public function activerPackDetails($id)
    {
        // dd($canal);
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->put($this->apiUrl . "/abonnement/payer/" . $id);

        $request1 = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put($this->apiUrl . "/abonnement/active/" . $id);
        // dd($request1);
        if ($request1->successful()) {
            return redirect(route('packs.souscriptions.details', [$id]));
        }
    }

    public function payer($id)
    {
        $user_id = $_SESSION['id'];
        $abonnementList = $this->getAbonnementList($user_id);

        foreach ($abonnementList as $value) {
            if ($value->id_pack == $id) {
                $abonnement = $value;
            }
        }
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->put($this->apiUrl . "/abonnement/payer/" . $abonnement->id_abonnement);
        $message = $response->object()->message;
        return redirect(route('packs.validation', ['id' => $id, 'acteur' => $abonnement->nom_type_entite]));
    }

    public function prixMarche(Request $request)
    {
        // dd($request);
        $idPack = $request->idPack;
        $acteur = $_SESSION['role'];
        $abonnementId = $request->idAbonnement;
        $produit = $request->produit;
        $marche = $request->marche;
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post($this->apiUrl . "/serviceabon/create", [
            "abonnement" => $abonnementId,
            "cours" => null,
            "nom_cours" => null,
            "produit" => $produit,
            "marche" => $marche
        ]);
        if ($response->successful()) {
            return redirect(route('packs.validation', ['id' => $idPack, 'acteur' => $acteur]));
        }
    }

    public function choixCours(Request $request)
    {
        // dd($request);
        $idPack = $request->idPack;
        $acteur = $_SESSION['role'];
        $abonnementId = $request->idAbonnement;
        $cours = explode('-', $request->cours);
        $idCours = $cours[0];
        $libelleCours = $cours[1];
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post($this->apiUrl . "/serviceabon/create", [
            "abonnement" => $abonnementId,
            "cours" => $idCours,
            "nom_cours" => $libelleCours,
            "produit" => null,
            "marche" => null
        ]);
        // dd($response);
        if ($response->successful()) {
            return redirect(route('packs.validation', ['id' => $idPack, 'acteur' => $acteur]));
        }
    }

    public function list()
    {
        $idProfil = $_SESSION['id'];
        $sms = 0;
        $appel = 0;
        $abonnementList = $this->getAbonnementList($idProfil);

        foreach ($abonnementList as $item) {
            $desc = $item->descriptionpack;
            $desc = str_replace("[", "", $desc);
            $desc = str_replace("]", "", $desc);
            $desc = str_replace("\"", "", $desc);
            $array_desc = explode(",", $desc);
            $item->descriptionpack = $array_desc;
            $item->date_debut_pack = strtotime($item->date_debut_pack);
            // $item->date_debut_pack = date_format($item->date_debut_pack, "d/m/Y");
            $item->date_fin_pack = strtotime($item->date_fin_pack);
            $sms += $item->nb_sms_restant;
            $appel += $item->nb_sec_voice_restant;
        }

        return view('gestion.packs.list', ['list' => $abonnementList, 'sms' => $sms, 'appel' => $appel]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $arrayServices = array();
        $descriptionPack = '[';
        $service = null;
        foreach ($request->services as $key => $serv) {
            $serviceExplode = explode('--', $serv);
            $nomService = $serviceExplode[1];
            $idService = $serviceExplode[0];
            if ($key == 0) {
                $descriptionPack .= '"' . $nomService . '"';
            } else {
                $descriptionPack .= ', "' . $nomService . '"';
            }
            $arrayServices[$idService] = $nomService;
        }
        $descriptionPack .= ']';


        $service = json_decode(json_encode($arrayServices, JSON_UNESCAPED_UNICODE));

        // Traitement sur description et Service

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post($this->apiUrl . "/pack/create", [
            "descriptionpack" => $descriptionPack,
            "duree_pack" => (int) $request->duree,
            "type_pack" => (int) $request->type_pack,
            "canal" => $request->canal,
            "pricing" => (int) $request->prix,
            "nombre" => (int) $request->nombre,
            "entite" => (int) $request->type_entite,
            "minproducteur" => (int) $request->minproducteur,
            "maxproducteur" => (int) $request->maxproducteur,
            "service" => $service
        ]);
        // dd($response);
        if ($response->successful()) {
            return redirect(route('packs'));
        }
        // return view('test', ['response' => $request]);
    }

    public function edit($id, $acteur)
    {
        $services = $this->getService();

        $profils = $this->getRole();
        $typePack = $this->getTypePack();
        $durePack = $this->getDureePack();

        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/pack/" . $acteur);
        $packList = $request->object();

        foreach ($packList as $packItem) {

            if ($packItem->id == $id) {
                $pack = $packItem;
            }
        }
        // lister les services
        return view('gestion.packs.create', ['pack' => $pack, 'acteur' => $acteur, 'profils' => $profils, 'services' => $services, 'typePacks' => $typePack, 'duree' => $durePack]);
    }

    public function update(Request $request)
    {
        $idPack = $request->idPack;
        // dd($request);
        // dd(gettype($request->minproducteur));
        $arrayServices = array();
        $descriptionPack = '[';
        $service = null;
        foreach ($request->services as $key => $serv) {
            $serviceExplode = explode('--', $serv);
            $nomService = $serviceExplode[1];
            $idService = $serviceExplode[0];
            if ($key == 0) {
                $descriptionPack .= '"' . $nomService . '"';
            } else {
                $descriptionPack .= ', "' . $nomService . '"';
            }
            $arrayServices[$idService] = $nomService;
        }
        $descriptionPack .= ']';


        $service = json_decode(json_encode($arrayServices, JSON_UNESCAPED_UNICODE));

        $url = $this->apiUrl . "/pack/update/" . $idPack;

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put($url, [
            "descriptionpack" => $descriptionPack,
            "duree_pack" => (int) $request->duree,
            "type_pack" => (int) $request->type_pack,
            "canal" => $request->canal,
            "pricing" => (int) $request->prix,
            "nombre" => (int) $request->nombre,
            "entite" => (int) $request->type_entite,
            "minproducteur" => (int) $request->minproducteur,
            "maxproducteur" => (int) $request->maxproducteur,
            "service" => $service
        ]);
        // dd($response);
        if ($response->successful()) {
            return redirect(route('packs'));
        }
    }

    public function destroy($id)
    {
    }

    //  Fonctions Intermediaires

    public function getRole()
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withoutVerifying()->get($this->apiUrl . '/gettypent');
        $roleList = $request->object();
        return $roleList;
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
    public function getAbonnementList($idProfil)
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/abonnementprofil/" . $idProfil);
        $abonnementList = $request->object();
        return $abonnementList;
    }

    public function get_greenapi_abon($idProfil)
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/greenapi_inscriptions/" . $idProfil . "/packs");
        $abonnementList = $request->object();
        return $abonnementList;
    }
    public function getService()
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/service");
        $services = $request->object();
        return $services;
    }
    public function getTypePack()
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/typepack");
        $typePack = $request->object();
        return $typePack;
    }
    public function getDureePack()
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/getalldureep");
        $dureePack = $request->object();
        return $dureePack;
    }
    public function getAllPack()
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/pack");
        $packList = $request->object();
        return $packList;
    }
    public function getPackByProfil($acteur)
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/pack/" . $acteur);
        return $request->object();
    }

    public function getPackGreenapi()
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->get($this->apiUrl . "/greenapi_packs");

        return $request->object();
    }
    public function getProduit()
    {
        $requestProduct = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/produit");
        $productList = $requestProduct->object();
        return $productList;
    }
    public function getMarkets()
    {
        $requestMarket = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/market");
        $marketList = $requestMarket->object();
        return $marketList;
    }
    public function getStuff()
    {
        $courses = Http::withoutVerifying()->get($this->apiUrl . "/cours", [

            'login' => 'administrateur',
            'password' => 'Aicheikh_123'

        ])->object();
        return $courses;
    }
    public function getAllAbonnement()
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/abonnement");
        $abonnementList = $request->object();
        return $abonnementList;
    }
    public function getServiceAbonnement($idAbonnement)
    {
        $serciceSouscris = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/serviceabonnement/" . $idAbonnement);
        $serviceAbonn = $request->object();
        return $serviceAbonn;
    }
}
