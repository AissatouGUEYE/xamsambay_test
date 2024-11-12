<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FinanceController extends Controller
{

    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function index()
    {

        $eb_valider = array();
        $decaissement = array();
        $decaissement_activite=array();
        # code...
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/eb_actifs_non_payes/" . $_SESSION['id_entite']);
        if ($request->status() == 404) {
            return view('layout.404');
        } else {
            $eb_valider = $request->object();


            $request_dec = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/ferme_decaissements/" . $_SESSION['id_entite']);
            if ($request_dec->status() == 404) {
                return view('layout.404');
            } else {
                $decaissement = $request_dec->object();

                if (strpos($_SESSION['profil'], "RESPONSABLE ACTIVITES") !== false) {
                    $chaine = $_SESSION['profil'];
                    $elements = explode(' ', $chaine);
                    $activite = trim(strtolower(end($elements)));
                    $activite = ucfirst($activite);
    
                    foreach ($decaissement as $item) {
                        if ($item->libelle_activite == $activite) {
                            array_push($decaissement_activite, $item);
                        }
                    }
                    $decaissement = $decaissement_activite;
                }
                return view('gestion.ferme.finance.liste', compact('eb_valider', 'decaissement'));
            }
        }


        // $eb = $eb_valider[0];
        // $date = date('d/m/Y', strtotime($eb->created_at));
        // dd($date);

    }

    public function banque()
    {
        $caisse = array();
        $banques = array();
        $somme = 0;
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/ferme_caisses/" . $_SESSION['id_entite']);
        if ($request->status() == 404) {
            return view('layout.404');
        } else {
            $caisse = $request->object();
            // $caisse = $caisse[0];

            foreach ($caisse as $value) {
                # code...
                if ($value->id_type_operation == 1 || $value->id_type_operation == 4) {
                    $somme = $somme - $value->montant;
                } else
                    $somme = $somme + $value->montant;
            }
            foreach ($caisse as $value) {

                if ($value->type_operation == 'Banque') {
                    array_push($banques, $value);
                }
            }


            return view('gestion.ferme.banque.index', compact('banques', 'somme'));
        }
    }

    public function decaissement($id)
    {

        //somme de la caisse 

        $caisse = array();
        $somme = 0;
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/caisse");
        if ($request->status() == 404) {
            return view('layout.404');
        } else {
            $caisse = $request->object();
            // $caisse = $caisse[0];

            foreach ($caisse as $value) {
                # code...
                if ($value->id_type_operation == 1 ||$value->id_type_operation == 4) {
                    $somme = $somme - $value->montant;
                } else
                    $somme = $somme + $value->montant;
            }

            return view('gestion.ferme.finance.create_dec', compact('id', 'somme'));
        }
    }




    public function store(Request $request)
    {
        // dd($request);
        // dd($_SESSION['id']);
        $filename = null;
        $request->montant = (int)$request->montant;
        //  dd($request);
        if ($request->fichier) {
            $filename = Storage::disk('public')->put('justificatif_decaissement', $request->fichier);
        }
        //  dd($filename);
        $create_dec = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post(
            $this->apiUrl . "/ferme/decaissements/create",
            [
                "acteur" => $_SESSION['id'],
                "paiement" => $request->operation,
                "montant" => $request->montant,
                "eb" => $request->eb,
                "fichier" => $filename,
                "operation" => 1
            ]
        );
        if ($create_dec->status() == 404) {
            return view('layout.404');
        } else {
            $res  = $create_dec->object();
            //   dd($res);
            if ($res->status == 'Décaissement enregistré avec succés') {
                return redirect(route('ferme.finance'));
            } else {
                $message = "Erreur lors de l'ajout du decaissement";
                return response(['message' => $message], 200);
            }
        }
    }


    public function edit($id)
    {
        $decInfos = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/decaissements/" . $id);

        if ($request->status() == 404) {
            return view('layout.404');
        } else {
            $decliste = $request->object();
            $decliste = $decliste[0];
            // dd($decliste);
            $decInfos['id'] = $decliste->id;
            $decInfos['id_eb'] = $decliste->id_eb;
            $decInfos['id_payement'] = $decliste->id_paiement;
            $decInfos['montant'] = $decliste->montant;
            $decInfos['payement'] = $decliste->paiement;
            $decInfos['fichier'] = $decliste->fichier;


            return view('gestion.ferme.finance.edit', compact('decInfos'));
        }
    }


    public function update(Request $request)
    {
        //  dd($request);
        $filename = '';

        $request->montant = (int)$request->montant;
        $filename = Storage::disk('public')->put('justificatif_decaissement', $request->fichier);

        $update_dec = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put(
            $this->apiUrl . "/ferme/decaissements/update/" . $request->id,
            [
                "paiement" => $request->operation,
                "montant" => $request->montant,
                "eb" => $request->id_eb,
                "fichier" => $filename,

            ]
        );
        if ($update_dec->status() == 404) {
            return view('layout.404');
        } else {
            $res  = $update_dec->object();
            // dd($res);
            if ($res->status == 'Décaissement modifié avec succés') {
                return redirect(route('ferme.decaissement'));
            } else {
                $message = "Erreur lors de la modification du decaissement";
                return response(['message' => $message], 200);
            }
        }
    }


    //VENTE

    public function index_vente()
    {

        $stock = array();
        $stock_activite=array();
        $vente_activite=array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/ferme_stocks/" . $_SESSION['id_entite']);
        if ($request->status() == 404) {
            return view('layout.404');
        } else {

            $stock = $request->object();

            

            $vente = array();
            $request = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/ferme_ventes/" . $_SESSION['id_entite']);
            if ($request->status() == 404) {
                return view('layout.404');
            } else {
                $vente = $request->object();

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
                    foreach ($vente as $item) {
                        if ($item->libelle_activite == $activite) {
                            array_push($vente_activite, $item);
                        }
                    }
                    $stock = $stock_activite;
                    $vente = $vente_activite;
                }
                return view('gestion.ferme.vente.index', compact('stock', 'vente'));
            }
        }
    }

    public function view($id)
    {
        $vente = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/vente/" . $id);
        if ($request->status() == 404) {
            return view('layout.404');
        } else {
            $vente = $request->object();
            $vente = $vente[0];
            return view('gestion.ferme.vente.view', compact('vente'));
        }
    }

    //view by admin 
    public function view_admin($id)
    {
        $vente = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/vente/" . $id);
        if ($request->status() == 404) {
            return view('layout.404');
        } else {
            $vente = $request->object();
            $vente = $vente[0];
            return view('gestion.ferme.vente_view', compact('vente'));
        }
    }


    public function vente($id)
    {

        $stock = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/stocks/" . $id);
        if ($request->status() == 404) {
            return view('layout.404');
        } else {
            $stock = $request->object();
            $stock = $stock[0];
            // dd($stock[0]);

            return view('gestion.ferme.vente.create', compact('stock'));
        }
    }

    public function store_vente(Request $request)
    {

        // dd($request);
        $filename = null;
        if ($request->fichier) {
            $filename = Storage::disk('public')->put('ventes', $request->fichier);
        }
        // dd($filename);

        if ($request->qtite_stock >= $request->quantite) {
            $request->montant = (int)$request->montant;
            $create_dec = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->put(
                $this->apiUrl . "/ferme/stocks/etat/" . $request->stock,
                [
                    "stock" => $request->stock,
                    "quantite" => $request->quantite,
                    "unite" => $request->id_unite_stock,
                    "prix_vente" => $request->prix_vente,
                    "acteur" => $_SESSION['id'],
                    "type_operation" => $request->operation,
                    "justificatif" => $filename,
                    "operation" => 2

                ]
            );
            if ($create_dec->status() == 404) {
                return view('layout.404');
            } else {
                $res  = $create_dec->object();
                dd($res);
                if ($res->status == 'ok') {
                    $message = "Vente ajoute avec succes";
                    return response(['message' => $message, 'data' => $res], 200);
                    //  return redirect(route('ferme.vente'));
                } else {
                    $message = "Erreur lors de l'ajout de la  vente";
                    return response(['message' => $message], 200);
                }
            }
        }
    }

    //payement

    //modifier la table vente avec payer=1 et renseigner la reference

    // public function validation_vente($id,$montant)
    // {


    //     if (isset($_GET['success'])) {
    //         if ($_GET['success'] == 1) {
    //             // $ref = $_GET['reference'];
    //             $response = Http::withHeaders([
    //                 'Accept' => 'application/json',
    //                 'Content-Type' => 'application/json',
    //             ])->withToken($_SESSION['token'])
    //                 ->withOptions(['verify' => false])
    //                 ->withoutVerifying()
    //                 ->put("https://api.mlouma.org/api/ferme/vente/payer/" . $id,[
    //                     "montant"=>$montant,
    //                     "acteur"=>$_SESSION['id']

    //                 ]);
    //             if ($response->successful()) {
    //                 return redirect(route('ferme.vente'));
    //             }
    //         }
    //     }
    // }


    public function payement($id)
    {
        // dd($id);

        $id = (int)$id;
        $vente = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/vente/" . $id);
        if ($request->status() == 404) {
            return view('layout.404');
        } else {
            $vente = $request->object();
            $vente = $vente[0];
            $price = $vente->prix_vente;
            // $vente_id = $vente->id;
            $qtite = $vente->quantite;
            $montant = $price * $qtite;

            return view('gestion.ferme.vente.payer', compact('vente', 'montant'));
        }



        // dd($vente);
        // $command_name = $vente->produit;
        // $price = $vente->prix_vente;
        // $vente_id = $vente->id;
        // $qtite = $vente->quantite;
        // $montant=$price * $qtite;


        // // Reference
        // $date = date('Y-m-d H:i:s');
        // $date = strtotime($date);
        // // function de generation de key 
        // $ref = 'ref-' . $this->generateRandomString(5) . $date;

        // //update reference 
        //  //modifier la table
        //  $response = Http::withHeaders([
        //     'Accept' => 'application/json',
        //     'Content-Type' => 'application/json',
        // ])->withToken($_SESSION['token'])
        //     ->withOptions(['verify' => false])
        //     ->withoutVerifying()
        //     ->put("https://api.mlouma.org/api/ferme/vente/reference/$id", [

        //         'reference' => $ref,

        //     ]);

        //     if($response->successful()){
        //         $url = route('vente.validation', ['id' => $id,'montant'=>$montant]);
        //         $success_url = $url . '?success=1&reference=' . $ref;

        //         $payer = Http::withHeaders([
        //             'Accept' => 'application/json',
        //             'Content-Type' => 'application/json',
        //         ])->withToken($_SESSION['token'])->withoutVerifying()->post(
        //             "https://api.mlouma.org/api/paytech",
        //             [
        //                 "item_name" => $command_name,
        //                 "item_price" =>   $montant,
        //                 "command_name" =>  $vente_id . ' ' . $command_name,
        //                 "item_id" => $vente_id,
        //                 "ref_command" => $ref,
        //                 "env" => 'test',
        //                 "success_url" => $success_url,
        //                 "cancel_url" => ""

        //             ]
        //         );
        //         if ($payer->successful()) {
        //             $paytech = $payer->object();
        //             // dd($paytech);
        //             if ($paytech->success != -1) {
        //                 return redirect($paytech->redirect_url);
        //             } else {
        //                 return $paytech;
        //             }
        //         }
        // }

        //url

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


    //caisse

    public function index_caisse()
    {
        $caisse = array();
        $somme = 0;
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/ferme_caisses/" . $_SESSION['id_entite']);
        if ($request->status() == 404) {
            return view('layout.404');
        } else {
            $caisse = $request->object();
            // $caisse = $caisse[0];

            foreach ($caisse as $value) {
                # code...
                if ($value->id_type_operation == 1 || $value->id_type_operation == 4) {
                    $somme = $somme - $value->montant;
                } else
                    $somme = $somme + $value->montant;
            }


            return view('gestion.ferme.caisse.index', compact('caisse', 'somme'));
        }
    }
    public function store_caisse(Request $request)
    {

        // dd($request);
        $filename = null;
        if ($request->fichier) {
            $filename = Storage::disk('public')->put('caisse', $request->fichier);
        }
        $request->montant = (int)$request->montant;
        $create_caisse = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post(
            $this->apiUrl . "/ferme/caisse/create",
            [
                "montant" => $request->montant,
                "justificatif" => $filename,
                "operation" => 3,
                "acteur" => $_SESSION['id'],
            ]
        );
        if ($create_caisse->status() == 404) {
            return view('layout.404');
        } else {
            $res  = $create_caisse->object();
            if ($res->status == 'ok') {
                return redirect(route('ferme.caisse'));
            } else {
                $message = "Erreur lors de l'ajout a la caisse";
                return response(['message' => $message], 200);
            }
        }
    }

    public function store_banque(Request $request)
    {

        // dd($request);
        $filename = null;
        if ($request->fichier) {
            $filename = Storage::disk('public')->put('caisse', $request->fichier);
        }
        $request->montant = (int)$request->montant;
        $create_caisse = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post(
            $this->apiUrl . "/ferme/caisse/create",
            [
                "montant" => $request->montant,
                "justificatif" => $filename,
                "operation" => 4,
                "acteur" => $_SESSION['id'],
            ]
        );
        if ($create_caisse->status() == 404) {
            return view('layout.404');
        } else {
            $res  = $create_caisse->object();
            if ($res->status == 'ok') {
                return redirect(route('ferme.banque'));
            } else {
                $message = "Erreur lors de l'ajout a la banque";
                return response(['message' => $message], 200);
            }
        }
    }

    public function view_caisse($id)
    {
        $caisse = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/caisse/" . $id);
        if ($request->status() == 404) {
            return view('layout.404');
        } else {
            $caisse = $request->object();
            $caisse = $caisse[0];
            return view('gestion.ferme.caisse.view', compact('caisse'));
        }
    }

    // public function payement_espece(Request $request)
    // {
    //     //on update la table caisse et le champs payer de la table vente

    //     $filename = null;
    //     $request->montant = (int)$request->montant;
    //     //  dd($request);
    //     if ($request->fichier) {
    //         $filename = Storage::disk('public')->put('justificatif_payement_vente', $request->fichier);
    //     }

    //     $response = Http::withHeaders([
    //         'Accept' => 'application/json',
    //         'Content-Type' => 'application/json',
    //     ])->withToken($_SESSION['token'])
    //         ->withOptions(['verify' => false])
    //         ->withoutVerifying()
    //         ->put("https://api.mlouma.org/api/ferme/vente/payer/" . $request->id_vente, [
    //             "montant" => $request->montant,
    //             "acteur" => $_SESSION['id'],
    //             "justificatif" => $filename,
    //             "paiement" => $request->operation,


    //         ]);
    //     if ($response->successful()) {
    //         return redirect(route('ferme.vente'));
    //     }
    // }
}
