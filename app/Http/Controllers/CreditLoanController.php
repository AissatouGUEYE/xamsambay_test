<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CreditLoanController extends Controller
{
    protected $apiUrl;
    protected $agrixUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
        $this->agrixUrl = config('app.agrix_url');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $idProfil = $_SESSION['id'];
        $response = $this->get_greenapi_abon($idProfil);

        $suscribe = $response['suscribe'];
        $pack_id = $response['pack_id'];

        $dossiers = [];
        $dossiersRequest = $this->getActivitiesForProfile();
        $dossiers = $dossiersRequest->activites;

        // $suscribe = 0;
        // dd($dossiers);
        return view('services.credit_demande.index', ["suscribe" => $suscribe, "pack_id" => $pack_id, "dossiers" => $dossiers]);
    }

    public function get_greenapi_abon($idProfil)
    {
        $suscribe = 0;
        $pack_id = null;

        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/greenapi_inscriptions/" . $idProfil . "/packs");

        $abonnementList = $request->object();

        foreach ($abonnementList as $abonnement) {
            foreach ($abonnement->pack->services as $service) {
                if (strtolower($service->service) === 'credit agricol') {
                    $suscribe = 1;
                    $pack_id = $abonnement->pack->id;
                    break 2;
                }
            }
        }

        if ($suscribe == 1) {
            $today = Carbon::now();
            if ($abonnement->date_prochain_paiement > $today) {
                $suscribe = 2;
            }
        }

        return ['suscribe' => $suscribe, 'pack_id' => $pack_id];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        // Create new Abonnement and verify payment before redirect to the loan page
        // Need List Product
        // Check Revenue Table if an element with de the id producer already exist if yes return it to a form
        return view('services.credit_demande.loan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userAuth = Auth::user();
        $user = $this->getUserbyId($userAuth->id);
        // id Profil is $user->id

        // dd($request->all());
        $data = $request->all();

        unset($data["_token"]);
        // return $data;
        // Add User Info
        //Get the name / phone / date_of_birth / Sexe / adress (localite, commune, departement, region, Pays)
        $data['farmer_name'] = $user->prenom . " " . $user->nom;
        $data['phone'] = $user->telephone;
        $data['date'] = $user->dt_naiss;
        $data['genre'] = $user->sexe;
        $data['adress'] = $user->localite . "(village), " . $user->region . "(region), " . $user->pays . "(pays)";
        $data['location'] = $user->localite . "(village), " . $user->region . "(region), " . $user->pays . "(pays)";
        // dd($data);
        // Create Activity
        $activity = $this->createActivity($data);
        // Create Revenue
        $revenu = $this->createRevenu($data);
        // Create Credit
        $credit = $this->createCredit($data, $activity->data->id);
        // Generate BP
        // dd('Generate BP');
        $businessPlan = $this->generateBP($data);
        // dd($businessPlan);
        $storeBP = $this->StoreBP($businessPlan, $credit->data->id);

        $bp = json_decode($storeBP->business_plan);

        $pdfAccessLink = $bp->pdf_access_link;
        return redirect()->away($pdfAccessLink);
        // Pdf file / View that display the BP of Folder
        // return view('services.credit_demande.business_plan', ["business" => $bp, "idCredit" => $storeBP->credit_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getUserbyId($id)
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/showuser/" . $id);
        $entitiesList = $request->object();
        return $entitiesList[0];
    }

    public function createActivity($data)
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post($this->apiUrl . "/activites", [
            "abonnement_id" => 166, // Check Abonnement
            "nombre_emplois_crees" => (float) $data['number_of_jobs_created'],
            "revenu_exploitation" =>  (float) $data['operatingIncome'],
            "argent_disponible" => (float) $data['current_cash'],
            "experience_speculation" => ($data['experience_with_speculation'] == 'yes') ? true : false,
            "premiere_experience_entrepreneuriale" => ($data['first_entrepreneur_experience'] == 'yes') ? true : false,
            "speculation_prevues" => 2, // Id of choosen product
            "duree_production" => $data['production_duration'],
            "emplacement" => $data['location'],
            "superficie_prevues" => $data['plans_surface_launch'],
            "nombre_sujets_prevus" => 0,
            "canaux_vente" => "Marché local",
            "depenses_preproduction" => $data['preharvest_expenses'],
            "depenses_croissance" => $data['harvesting_expenses'],
            "depenses_postmaturation" => $data['postharvest_expenses'],
            "amortissement_equipements" => $data['amortization_of_investment'],
            "prix_vente" => $data['selling_price'],
            "autres_revenus_financiers" => $data['other_financial_income'],
            "marge_brute" => $data['grossMargin'],
            "autres_dettes" => $data['other_debts']
        ]);
        return $request->object();
    }

    public function createRevenu($data)
    {

        $idProfil = $_SESSION['id'];
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post(
            $this->apiUrl . "/revenus",
            [
                "profil_id" => $idProfil,
                "description_autre_revenu_financier" => $data['other_financial_income_desc'],
                "valeur_terres_batiments_agricoles" => $data['farmland_and_buildings_value'],
                "valeur_equipements_outillage_agricole" => $data['equipments_and_tooling_value'],
                "valeur_stock_actuel" => $data['stocked_production_value'],
                "valeur_production_vendue_a_recevoir" => $data['total_receivable'],
                "depenses_familiales" => $data['family_expenses'],
                "depenses_financieres" => $data['financialExpenses'],
                "revenu_exploitation" => $data['operatingIncomeTimeNumberOfCycle'],
                "valeur_autres_biens_personnels" => $data['other_assets'],
                "total_passifs" => $data['totalAsset']
            ]
        );
        return $request->object();
    }

    public function createCredit($data, $id)
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post(
            $this->apiUrl . "/credits",
            [
                "activite_id" => $id,
                "montant_credit_souhaite" => $data['loan_amount_requested'],
                "duree_credit" => $data['loan_duration'],
                "besoin_investissement" => $data['investment_requirements'],
                "total_depenses_exploitation" => $data['totalOperatingExpenses']
            ]
        );
        return $request->object();
    }

    public function generateBP($data)
    {
        $url = $this->agrixUrl . "/loan_form/business_plan/GreenAPI/agriculture";
        foreach ($data as $key => $item) {
            if (ctype_digit($item)) {
                $data[$key] = (float)$item;
            }
        }
        // dd($data);
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            "API-KEY" => "WE58922036633MVTE852000SWQPA-AKZ"
        ])->withToken($_SESSION['token'])->withoutVerifying()->post(
            $url,
            $data
        );
        return $request->object();
    }

    public function StoreBP($data, $idCredit)
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post(
            $this->apiUrl . "/eligibles",
            [
                "credit_id" => $idCredit,
                "business_plan" => $data
            ]
        );
        return $request->object();
    }

    public function getActivitiesForProfile()
    {
        $idProfil = $_SESSION['id'];
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get(
            $this->apiUrl . "/activites/profil/" . $idProfil
        );

        // dd($request->object());
        return $request->object();
    }
}
