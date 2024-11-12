<?php

namespace App\Http\Controllers;

use App\Exports\InfoClimaExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class PrevisionController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        set_time_limit(300);
        $prevision_tab = array();
        $previsions_tab = array();

        $urlGetPrevision = $this->apiUrl . "/allprevision";
        if ($_SESSION['role'] == "ONG") {
            $entite = $_SESSION['id_entite'];
            $urlGetPrevision = $this->apiUrl . "/allprevision/" . $entite;
        }

        $previsions = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($urlGetPrevision);

        $previsions_tab = $previsions->object();
//        dd($previsions_tab);

        return view('services.informations_climatiques.prevision.index', ["previsions_tab" => $previsions_tab]);
    }

    public function detailsPrevision($date, $message)
    {
        set_time_limit(600);
        $message = Crypt::decryptString($message);
        $listNumber = $this->getDetailsStatSmsforPartner($date, $message);
//        $listNumber = $this->getDetailsStatSmsforPartnerV2($date, $message);
//        dd($listNumber);
        $numberBuffer = [];

        if (!empty($listNumber)) {
            foreach ($listNumber as $key => $item) {
                //  Check if they key is Pair or equal to zero
                if ($key % 2 == 0) {
                    $producerItem = $item;
                    $producerItemInfos = $listNumber[$key + 1];
                    if (!empty($producerItemInfos)) {
                        //  Recept all info about the producer and put it on producer item
                        $producerItem->nom = $producerItemInfos[0]->prenom . " " . $producerItemInfos[0]->nom;
                        $producerItem->localite = $producerItemInfos[0]->localite;
                        $numberBuffer[] = $producerItem;
                    }
                }
            }
        }
        return view('services.informations_climatiques.prevision.details', ["listNumber" => $numberBuffer]);


    }

    public function downloadPrevision($date, $message)
    {
        set_time_limit(600);
        $numeros = [];
        $message = Crypt::decryptString($message);
//        $listNumber = $this->getDetailsStatSmsforPartner($date, $message);
        $listNumber = $this->getDetailsStatSmsforPartnerV2($date, $message);

//        dd($listNumber);

        if (!empty($listNumber)) {
            foreach ($listNumber as $key => $item) {
                $numero = [];
                //  Recept all info about the producer and put it on producer item
                $numero[] = $message;
                $numero[] = $date;
                $numero[] = $item->tel;
                $numero[] = $item->prenom . " " . $item->nom;
                $numero[] = $item->localite;
                $numeros[] = (object)$numero;

                //  Check if they key is Pair or equal to zero
//                if ($key % 2 == 0) {
//                    $producerItem = $item;
//                    $producerItemInfos = $listNumber[$key + 1];
//                    if (!empty($producerItemInfos)) {
//                        $numero[] = $producerItemInfos[0]->prenom . " " . $producerItemInfos[0]->nom;
//                        $numero[] = $producerItemInfos[0]->localite;
//                    }
//                }
            }
        }

        $name = 'prevision_sms_' . $date . '_mlouma.xlsx';
        return Excel::download(new InfoClimaExport($numeros, $message, $date), $name);
    }

    public function detailsPrevisionVoice($date, $voice)
    {
        $numberBuffer = [];
        $voice = Crypt::decryptString($voice);
        $listVoiceNumber = $this->getDetailsStatVoiceForPartner($date, $voice);

        if (!empty($listVoiceNumber)) {
            $dateAlert = $listVoiceNumber[0]->date;
            foreach ($listVoiceNumber as $key => $item) {
                //  Check if they key is Odd
                $producerItemFinal = [];
                $producerItem = [];
                if ($key % 2 != 0) {
                    if (!empty($item) && isset($item[0])) {
                        $producerItem = $item[0];
//                        dd($producerItem);
                        if ($producerItem->prenom == "NULL") {

                            $producerItemFinal["nom"] = $producerItem->nom;
                        } else {

                            $producerItemFinal["nom"] = $producerItem->prenom . " " . $producerItem->nom;
                        }
                        $producerItemFinal["telephone"] = $producerItem->telephone;
                        $producerItemFinal["date"] = $dateAlert;
                        $producerItemFinal["localite"] = $producerItem->localite;
                        $numberBuffer[] = (object)$producerItemFinal;
                    }
                }
            }
        }
        return view('services.informations_climatiques.prevision.details', ["listNumber" => $numberBuffer]);

    }

    public function downloadPrevisionVoice($date, $voice)
    {
        set_time_limit(600);
        $numbers = [];
        $voice = Crypt::decryptString($voice);
        $listVoiceNumber = $this->getDetailsStatVoiceForPartner($date, $voice);
//        dd($listVoiceNumber);

        if (!empty($listVoiceNumber)) {
            $dateAlert = $listVoiceNumber[0]->date;
            foreach ($listVoiceNumber as $key => $item) {

                //  Check if they key is Odd
                $numero = [];
                $producerItem = [];
                if ($key % 2 != 0) {
                    if (!empty($item) && isset($item[0])) {
                        $numero[] = $voice;
                        $numero[] = $dateAlert;
                        $producerItem = $item[0];
                        $numero[] = $producerItem->telephone;
                        if ($producerItem->prenom == "NULL") {
                            $numero[] = $producerItem->nom;
                        } else {
                            $numero[] = $producerItem->prenom . " " . $producerItem->nom;
                        }
                        $numero[] = $producerItem->localite;
                        $numbers[] = (object)$numero;
                    }
                }
            }
        }

        $name = 'prevision_voice_' . $date . '_mlouma.xlsx';
        return Excel::download(new InfoClimaExport($numbers, $voice, $date), $name);
    }


    public function store(Request $request)
    {
        //

        if (
            isset($request->message) &&
            (isset($request->zone) ||
                isset($request->localite))
            // isset($request->region) ||
            // isset($request->dept) ||
            // isset($request->commune) ||

        ) {
            // $region = isset($request->region) ? $request->region : "null";
            // $dept = isset($request->dept) ? $request->dept : "null";
            // $commune = isset($request->commune) ? $request->commune : "null";
            $zone = isset($request->zone) ? $request->zone : "null";
            $localite = isset($request->localite) ? $request->localite : "null";
            // $role = "null";
            // $reseau = "null";
            // $langue = "null";
            // $sexe = "null";
            $req = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()
                ->post($this->apiUrl . "/mlprevision/create", [
                    "message" => $request->message,
                    "profil" => $_SESSION['id'],
                    "localite" => $localite,
                    "zone" => $zone
                ]);

            if ($req->status() == 200) {
                # code...
                $message = "Informations diffusée avec succés";
            } else {
                $message = "Erreur survenue,contacter l'administrateur";
            }
            return response(["message" => $message], 200);
        } else {

            $message = "Erreur survenue,veuillez revoir les informations saisies";
            return response(["message" => $message], 500);
        }
    }

    private function getDetailsStatSmsforPartner($date, $message)
    {
        $entite_id = $_SESSION['id_entite'];
        $typeAlert = 2; // Alert Prevision

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/sms_user/" . $typeAlert, [
            "sms" => $message,
            "date" => $date,
            "entite" => $entite_id
        ]);
//        dd($response);
        return $response->object();
    }

    private function getDetailsStatSmsforPartnerV2($date, $message)
    {
        $entite_id = $_SESSION['id_entite'];

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/sms_user_2/" . $date, [
            "sms" => $message,
            "entite" => $entite_id
        ]);
//        dd($response);
        return $response->object();
    }


    private function getDetailsStatVoiceForPartner($date, $voice)
    {
        $entite_id = $_SESSION['id_entite'];
        $typeAlert = 2; // Alert Prevision Prod 3


        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/voice_user/" . $typeAlert, [
            "voice" => $voice,
            "date" => $date,
            "entite" => $entite_id

        ])->object();
    }
}
