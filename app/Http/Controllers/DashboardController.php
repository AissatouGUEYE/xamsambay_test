<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{

    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [];
        $campagnes_meteo = [];
        $currentYear = (int)date('Y');
        $years = [$currentYear - 2, $currentYear - 1, $currentYear, $currentYear + 1, $currentYear + 2];
        $nb_stat_base_url = $this->apiUrl . "/nombre/prod_enrolle";
        $params_for_nb = "/nombre/null/null/null/null/null/null/null/null/null/null";
        $nb_pluvio = [];
        $id_entite = $_SESSION['id_entite'];
        $id_profil = $_SESSION['id'];
        $id_groupement = isset($_SESSION['groupement']) ? $_SESSION['groupement'] : null;
        $role = $_SESSION['role'];
        $count_eb_valide_intrant = 0;
        //        ddd($role);


        if ($role === "FERME AGRICOLE") {

            return view('data.dashboard.index');
        } elseif (in_array($role, ["ADMIN", "SUPERADMIN", "ONG", "GERANT", "OP"])) {

            if (in_array($role, ["ADMIN", "SUPERADMIN"])) {

                $nb_stat_url = $nb_stat_base_url . "/null/null";
                $nb_pluvio_stat_url = $this->apiUrl . "/nbpluvio_entite_reseau/null/null";
                $params_for_nb = "/nombre/null/null/null/null/null/null/null/null/null/null";
            } elseif (in_array($role, ["ONG"])) {
                // dd($_SESSION);
                $nb_stat_url = $nb_stat_base_url . "/" . $_SESSION['id_entite'] . "/null";
                $nb_pluvio_stat_url = $this->apiUrl . "/nbpluvio_entite_reseau/" . $_SESSION["id_entite"] . "/null";
                $params_for_nb = "/nombre/" . $_SESSION['id_entite'] . "/null/null/null/null/null/null/null/null/null";
            } elseif (in_array($role, ["GERANT", "OP"]) || $_SESSION['role_user'] == "GESTIONNAIRE BD") {

                $nb_stat_url = $nb_stat_base_url . "/null/" . $_SESSION['groupement'];
                $nb_pluvio_stat_url = $this->apiUrl . "/nbpluvio_entite_reseau/null/" . $_SESSION['groupement'];
                $params_for_nb = "/nombre/null/" . $_SESSION['groupement'] . "/null/null/null/null/null/null/null/null";
            } else {

                $nb_stat_url = $this->apiUrl . "/stat/entite";
            }

            // get reception by op
            $request_recpt_op = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/receptions/resp_op/' . $_SESSION['id']);
            $request_recpt_op = $request_recpt_op->object();
            // dd($request_recpt_op);
            $count_recpt_op = count($request_recpt_op);


            $request = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->pool(fn(Pool $pool) => [

                $pool->withToken($_SESSION['token'])->withoutVerifying()->get($nb_stat_url),
                $pool->withToken($_SESSION['token'])->withoutVerifying()->get($nb_pluvio_stat_url),
                $pool->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/entite/nombre_grp/" . $_SESSION["id_entite"]),
                $pool->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/prix/profil/nb_prix/" . $id_profil),
                $pool->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "" . $params_for_nb),
                $pool->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/boutiques/nombre")

            ]);

            $nb_prod_enrolle = $request[0]->object()[0];
            $nb_pluvio = $request[1]->object()[0];
            $nb_groupement = $request[2]->object()[0];
            $nb_prod = $request[4]->object()[0];
            $nb_btk = $request[5]->object();


            array_push($data, $nb_prod_enrolle->nb_prod_enrolle);
            array_push($data, $nb_pluvio->nombre_pluvio);
            array_push($data, $nb_groupement->nombre);
            array_push($data, $nb_prod);
            array_push($data, $nb_btk);
            // dd($data);

            return view('layouts.dashboard', compact('data', 'campagnes_meteo', 'currentYear', 'years', 'count_recpt_op'));
        } else {

            //            Get Stat Entite
            $stat_url = $this->apiUrl . '/stat/entite';
            $stats = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($stat_url)->object();


            //            $nb_btq = $this->apiUrl . '/boutiques/nombre';
            //            $nb_cours = $this->apiUrl . "/cours/nombre";
            $besoinUrl = $this->apiUrl . "/eb/stats/" . $id_entite;
            $besoins = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($besoinUrl)->object();
            $besoins = $besoins[0];

            //            ddd($stats);

            // get eb valide de type intrant
            $request_eb = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/eb/filtre_com/null/3/1/null/null/null/null/null');
            $request_eb = $request_eb->object();
            $count_eb_valide_intrant = count($request_eb);

            // get eb traite de type intrant
            $request_eb = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/eb/filtre_com/null/3/null/1/null/null/null/null');
            $request_eb = $request_eb->object();
            $count_eb_traite_intrant = count($request_eb);

            // get recpetion/commission /receptions/commission/{id_entite}
            $request_recpt_com = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/receptions/commission/' . $_SESSION['id_entite']);
            $request_recpt_com = $request_recpt_com->object();
            // dd($request_recpt_com);
            $count_recpt_com = count($request_recpt_com);


            // get distribution emises (cc_profil==null)

            $request_dist_emise = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/distributions');
            $request_dist_ = $request_dist_emise->object();
            $request_dist_emise = count($request_dist_);

            // get count all receptions

            $request_recept = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/receptions');
            $request_dist_ = $request_recept->object();
            $request_recept = count($request_dist_);


            // get distribution validee (cc_profil !=null)
            $request_dist_valide = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/dist_validees');
            $request_dist_valide = $request_dist_valide->object();
            // dd($request_dist_valide);

            // get nb commune rattache a un FIA
            $request_communes = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/fia_communes/fia/' . $_SESSION['id']);
            $request_communes = $request_communes->object();
//            dd($request_communes);
            $count_communes = count($request_communes);

            // get eb valide/commission
            $request_ebv_com = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/eb/filtre_com/null/3/1/null/null/null/' . $_SESSION['id_commune'] . '/null');
            $request_ebv_com = $request_ebv_com->object();
            $count_ebv_com = count($request_ebv_com);
            // get eb traite /commission
            $request_ebt_com = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/eb/filtre_com/null/3/null/1/null/null/' . $_SESSION['id_commune'] . '/null');
            $request_ebt_com = $request_ebt_com->object();
            $count_ebt_com = count($request_ebt_com);

            // get all distribution  /commission

            $request_dist_comm = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/distributions/nb_comm_dist/' . $_SESSION['id_entite']);
            $count_dist_comm = $request_dist_comm->object();
            // dd($count_dist_comm);

            // get distributon traite/commission

            $request_dist_comm_traite = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                // 'Authorization' => $_SESSION['token']
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . '/distributions/nb_comm_dist_traite/' . $_SESSION['id_entite']);
            $count_dist_comm_traite = $request_dist_comm_traite->object();


            if ($role === 'MLOUMER' || $role === 'SERVICE_TRANSPORT' || $role === 'INDIVIDUEL' || $role === 'FOURNISSEUR_INTRANT') {
                $url_packs = $this->apiUrl . '/pack/get_stat/null/' . $id_profil;
            } else {
                $url_packs = $this->apiUrl . '/pack/get_stat/' . $id_entite . '/null';
            }
            return view(
                'layouts.dashboard',
                compact('data', 'campagnes_meteo', 'currentYear', 'years', 'stats', 'besoins', 'count_eb_valide_intrant', 'count_eb_traite_intrant', 'request_dist_emise', 'request_dist_valide', 'count_communes', 'count_ebv_com', 'count_ebt_com', 'count_dist_comm', 'count_dist_comm_traite', 'count_recpt_com', 'request_recept')
            );
        }
    }
}

// $nb = Http::withHeaders([
//         'Accept' => 'application/json',
//         'Content-Type' => 'application/json',
//     ])->withToken($_SESSION['token'])->withoutVerifying()->get($nb_stat_url)->object();
// dd($nb);
// $id_user = Auth::user()->id;

// dd($request[4]->object()[0] );
// if (isset($nb_pluvio_stat_url)) {
//     $nb_pluvio = Http::withHeaders([
//         'Accept' => 'application/json',
//         'Content-Type' => 'application/json',
//     ])->withToken($_SESSION['token'])->withoutVerifying()->get($nb_pluvio_stat_url)->object();
// }


// $request = Http::withHeaders([
//     'Accept' => 'application/json',
//     'Content-Type' => 'application/json',
// ])->pool(fn (Pool $pool) => [

//     $pool->withToken($_SESSION['token'])->withoutVerifying()->get($nb_stat_url),
//     $pool->withToken($_SESSION['token'])->withoutVerifying()->get($nb_stat_url),
//     $pool->withToken($_SESSION['token'])->withoutVerifying()->get($nb_pluvio_stat_url),
//     $pool->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/entite/nombre_grp/" . $_SESSION["id_entite"]),
//     $pool->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl .  "/prix/profil/nb_prix/" . $id_profil),
//     $pool->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "" . $params_for_nb),
//     $pool->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/boutiques/nombre"),

//     $pool->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl .  "/nombre/" . $_SESSION["id_entite"]),
//     $pool->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/cours/nombre"),
//     $pool->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/pack/get/stat/montant"),
//     $pool->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/users/inscription/stats/2022"),
//     $pool->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/stat/entite"),
//     $pool->withToken($_SESSION['token'])->withoutVerifying()->get($url_packs),
//     $pool->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl .  "/prix/profil/nb_market/" . $id_profil),
//     $pool->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl .  "/prix/profil/nb_prix/" . $id_profil),
//     $pool->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/envoi/stat_data/2/null/" . $id_entite),
//     $pool->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/entite/nombre_grp/" . $id_entite),
//     $pool->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl .   "/eb/stats/" . $id_entite),


// ]);


// $nb_cours = $request[0]->object();
// $stats_pack = $request[1]->object();
// $user_by_months = $request[2]->object();
// dd($stats_entite = $request[3]->object());
// $nb_btq = $request[4]->object();
// $stats_pack_by_profil = $request[5]->object();
// $nb_per_service = $request[13]->object();
// // dd($request[10]->object()[0]);
// // $ebesoin = $ebesoin[0];
// $stats_entite_array = [];

// $nb_prod_by_ent = (isset($request[11]->object()[0]) && !empty($request[11]->object()[0])) ? $request[11]->object()[0]->nombre : 0;
// // $nb_reseaux = (isset($request[10]->object()[0]) && !empty($request[10]->object()[0])) ? $request[10]->object()[0]->nombre : 0;
// $nb_pluvio = (isset($request[8]->object()[0]) && !empty($request[8]->object()[0])) ? $request[8]->object()[0]->nombre_pluvio : 0;
// $stats_alertes = (isset($request[9]->object()[0]) && !empty($request[9]->object()[0])) ? $request[9]->object()[0] : null;
// // $nb_market_mloumer = (isset($request[6]->object()[0]) && !empty($request[6]->object()[0])) ? $request[6]->object()[0] : 0;
// $nb_prix_by_mloumer = (isset($request[7]->object()[0]) && !empty($request[7]->object()[0])) ? $request[7]->object()[0] : 0;
// $ebesoin = (isset($request[12]->object()[0]) && !empty($request[12]->object()[0])) ? $request[12]->object()[0] : [];

// foreach ($stats_entite as $key => $value) {
//     # code...
//     $keyObject = $key = key((array)$value);
//     $valueObject = $key = current((array)$value);
//     $stats_entite_array[$keyObject] = $valueObject;
// }
// $stats_entite =  (object) $stats_entite_array;

// $data['nb_cours'] = $nb_cours;
// $data['stats_alertes'] = $stats_alertes;
// $data['stats_entite'] = $stats_entite;
// $data['stats_pack'] = $stats_pack;
// $data['nb_btq'] = $nb_btq;
// $data['nb_prod_by_ent'] = $nb_prod_by_ent;
// // $data['nb_reseaux'] = $nb_reseaux;
// $data['nb_pluvio'] = $nb_pluvio;
// // $data['nb_market_mloumer'] = $nb_market_mloumer;
// $data['nb_prix_by_mloumer'] = $nb_prix_by_mloumer;
// $data['besoin'] = $ebesoin;
// $data['nb_per_service'] = $nb_per_service[0];


// $campagnes_meteo = Http::withHeaders([
//     'Accept' => 'application/json',
//     'Content-Type' => 'application/json',
// ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/campagnes/actif");
// $campagnes_meteo = $campagnes_meteo->object();
// $campagnes_meteo = $campagnes_meteo[1];
