<?php

namespace App\Http\Controllers\Services;

use App\Exports\NumberExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class AlertesController extends Controller
{
    //

    protected $apiUrl;
    protected $apiVoiceLam;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
        $this->apiVoiceLam = 'https://voiceapi.lafricamobile.com';
    }

    public function index()
    {
        $langues = $this->getAllLangue();
        return view('services.alerte.index', ['langues' => $langues]);
    }

    public function newList()
    {
        return view('services.alerte.diffusion.createList');
    }

    public function stats()
    {
        $user = Auth::user();
        $stats = [];
        if ($_SESSION['role'] == 'ADMIN' || $_SESSION['role'] == 'SUPERADMIN') {
            $stats = $this->getAllStats();
        } else {
            $stats = $this->getStatsByUser($user->id);
        }
//        dd($stats);
        /*
         * Faudra checker sur la base la possibilite de recuperer
         * l'heure bien que le GroupBy c'est par date
         */
        return view('services.alerte.stats.index', ['stats' => $stats]);
    }

    public function smsSubmit(Request $request)
    {
        try {
            set_time_limit(600);
            $userid = Auth::user()->id;
            $role = $_SESSION['role'];
            $sms = $_SESSION['sms'];
            $emit = "MLOUMA";
            $typeAlerte = $request->type_alerte;
            $campagne = $request->campagne;
            $campagneType = $request->campagnetype;
            $typeAlerteData = ($request->type_alerte == 'diffusion') ? 'Diffusion' : 'Prevision';

            // reste le nombre de producteurs sur une liste de diffusion
            $nombreProd = $request->nombreProd;
            $entiteId = ($role == 'ADMIN' || $role == 'SUPERADMIN') ? "null" : $request->id_entite;

            if ($role != 'ADMIN' && $role != 'SUPERADMIN') {
                if ($nombreProd > $sms) return redirect(route('alertes'))
                    ->with('message2', 'Le nombre de producteurs destinataire est superieur au stock de messages');
            }

            if ($request->type_canal == "alerte_sms") {
                $emiter = $this->getEmiterName($userid);
                $message = (($emiter != 'ADMIN' && $emiter != 'SUPERADMIN')) ? $request->message . " " . $emiter : $request->message;

                if ($campagne == 'reseau') {
                    if ($campagneType == 'all') {
                        if ($typeAlerte == 'diffusion') {
                            $url = $this->apiUrl . "/sms/entite/allreseau/" . $_SESSION['id_entite'];
                            $response = $this->sendMessageByParams2($url, $message, $userid);
                        } else {
                            $url = $this->apiUrl . "/sms/envoi/" . $entiteId . "/null/null/null/null/null/null/null/null/null";
                            $response = $this->sendMessageByParamsWithTypeAlerte($url, $message, $userid, $typeAlerteData);
                        }
                        if ($response->successful()) {
                            return redirect(route('alertes'))->with('message', 'Message de Diffusion envoye avec succes!');
                        }
                    } else {
                        if ($typeAlerte == 'diffusion') {
                            $url = $this->apiUrl . "/sms/reseau/" . $campagneType;
                            $response = $this->sendMessageByParams2($url, $message, $userid);
                        } else {
                            $url = $this->apiUrl . "/sms/envoi/" . $entiteId . "/" . $campagneType . "/null/null/null/null/null/null/null/null";
                            $response = $this->sendMessageByParamsWithTypeAlerte($url, $message, $userid, $typeAlerteData);
                        }
                        if ($response->successful()) {
                            return redirect(route('alertes'))->with('message', 'Message de ' . $typeAlerte . ' envoye avec succes!');
                        }
                    }
                }
                if ($campagne == 'upload') {
                    if ($typeAlerte == 'prevision') {
                        return redirect(route('alertes'))->with('message2', 'Service pas encore disponibles pour les chargements de fichiers');
                    }
                    $this->validate($request, [
                        'glist' => 'required|file|mimes:xls,xlsx'
                    ]);
                    $the_file = $request->file('glist');
                    try {
                        $spreadsheet = IOFactory::load($the_file->getRealPath());
                        $sheet = $spreadsheet->getActiveSheet();
                        $row_limit = $sheet->getHighestDataRow();
                        $column_limit = $sheet->getHighestDataColumn();
                        $row_range = range(2, $row_limit);
                        $column_range = range('F', $column_limit);
                        $startcount = 2;
                        $data = array();
                        foreach ($row_range as $row) {
                            $data[] = [
                                'numero' => $sheet->getCell('A' . $row)->getValue(),
                            ];
                        }
                        if ($data != []) {
                            $contactNumber = count($data);
                            if ($role != 'ADMIN' && $role != 'SUPERADMIN') {
                                if ($contactNumber > $sms) {
                                    return redirect(route('alertes'))->with('message2', 'Le nombre de producteurs destinataire est superieur au stock de messages');
                                }
                            }
                            for ($i = 0; $i < count($data); $i++) {
                                $numero = $data[$i]['numero'];
                                $urlFile = $this->apiUrl . "/sendsms/" . $emit . "/" . $numero . "/" . $message;
                                if (strlen($numero) == 9) {
                                    $numero = '221' . $numero;
                                }
                                $urlFile = $this->apiUrl . "/sendsms/" . $emit . "/" . $numero . "/" . $message;

                                $response = $this->sendSmsForFile($urlFile, $userid);
                            }
                            return redirect(route('alertes'))->with('message', 'Message de Diffusion envoye avec succes!');
                        }
                    } catch (Exception $e) {
                        // dd($e);
                        return back()->withErrors('Erreur survenue lors du chargement du fichier!');
                    }
                }
                if ($campagne == 'diffusion') {
                    $diffusionId = $request->campagnetype;
                    $urlDiffusion = $this->apiUrl . "/sms/diffusion/" . $diffusionId;

                    if ($role != 'ADMIN' && $role != 'SUPERADMIN') {
                        if ($nombreProd > $sms) return redirect(route('alertes'))
                            ->with('message2', 'Le nombre de producteurs destinataire est superieur au stock de messages');

                    }

                    if ($typeAlerte == 'prevision') return redirect(route('alertes'))
                        ->with('message2', 'Service pas encore disponibles pour les listes de diffusion');

                    $response = $this->sendMessageByParams2($urlDiffusion, $message, $userid);
                    if ($response->successful()) {
                        return redirect(route('alertes'))->with('message', 'Message de Diffusion envoye avec succes!');
                    }
                }
                if ($campagne == 'localite') {

                    $localiteId = (isset($request->localite)) ? $request->localite : 'null';
                    $commune = (isset($request->commune)) ? $request->commune : 'null';
                    $dpt = (isset($request->departement)) ? $request->departement : 'null';
                    $region = (isset($request->region)) ? $request->region : 'null';
                    $pays = (isset($request->pays)) ? $request->pays : 'null';
                    $langue = (isset($request->langue)) ? $request->langue : 'null';
                    $genre = (isset($request->genre)) ? $request->genre : 'null';
                    $network = 'null';
                    $urlSend = $this->apiUrl . "/sms/envoi/" . $entiteId . "/" . $network . "/" . $pays . "/" . $region . "/" . $dpt . "/" . $commune . "/" . $localiteId . "/" . $langue . "/" . $genre . "/null";

                    $response = $this->sendMessageByParamsWithTypeAlerte($urlSend, $message, $userid, $typeAlerteData);
                    // A revoir l'url
                    // dd($response);
                    if ($response->successful()) {
                        return redirect(route('alertes'))->with('message', 'Message de Diffusion envoye avec succes!');
                    }
                }
                if ($campagne == 'zone') {
                    $pays = (isset($request->pays)) ? $request->pays : 'null';
                    $langue = (isset($request->langue)) ? $request->langue : 'null';
                    $genre = (isset($request->genre)) ? $request->genre : 'null';
                    $zone = (isset($request->zone)) ? $request->zone : 'null';

                    $url = $this->apiUrl . "/sms/" . $entiteId . "/" . $pays . "/" . $zone . "/" . $langue . "/" . $genre;

                    if ($typeAlerte == 'prevision') {
                        $url = $this->apiUrl . "/sms/previson/zone/" . $entiteId . "/" . $pays . "/" . $zone . "/" . $langue . "/" . $genre;
                    }
                    $send = $this->sendMessageByParams2($url, $message, $userid);
                    if ($send->successful()) {
                        return redirect(route('alertes'))->with('message', 'Message de Diffusion envoye avec succes!');
                    }
                }
            } else {
                $campagne = $request->campagne;
                $audioFile = $request->file('audiofile');
                $fileName = Storage::disk('public')->put('audiofile', $request->audiofile);
                $audioFilename = asset('storage/' . $fileName);
                if ($campagne == "upload") {
                    if ($typeAlerte == 'prevision') {
                        return redirect(route('alertes'))->with('message2', 'Service pas encore disponibles pour les chargements de fichiers');
                    }
                    $this->validate($request, [
                        'glist' => 'required|file|mimes:xls,xlsx'
                    ]);
                    $the_file = $request->file('glist');
                    try {
                        $spreadsheet = IOFactory::load($the_file->getRealPath());
                        $sheet = $spreadsheet->getActiveSheet();
                        $row_limit = $sheet->getHighestDataRow();
                        $column_limit = $sheet->getHighestDataColumn();
                        $row_range = range(2, $row_limit);
                        $column_range = range('F', $column_limit);
                        $startcount = 2;
                        $data = array();
                        foreach ($row_range as $row) {
                            $data[] = [
                                'numero' => $sheet->getCell('A' . $row)->getValue(),
                            ];
                        }

                        if ($data != []) {
                            $contactNumber = count($data);
                            $numeros = [];

                            for ($i = 0; $i < count($data); $i++) {
                                $numero = $data[$i]['numero'];
                                if (strlen($numero) == 9) {
                                    $numero = '00221' . $numero;
                                }
                                if ($numero != null) $numeros[] = $numero;
                            }

                            $urlFile = $this->apiUrl . "/sendvoice";

                            //  ToDo Pass AudioFile Insted of File Name
                            $response = $this->sendVoiceToFileListV2($urlFile, $numeros, $audioFile, $userid, $audioFilename);
//                            dd($response);
//                            $response = $this->sendVoiceToFileList($urlFile, $numeros, $audioFilename, $userid);
                            //Check if the response is success??
                            if ($response->successful()) return redirect(route('alertes'))->with('message', 'Message Vocale envoyé avec succes!');
                        }
                    } catch (Exception $e) {
                        return back()->withErrors('Erreur survenue lors du chargement du fichier!');
                    }
                } elseif ($campagne == 'localite') {

                    $localiteId = (isset($request->localite)) ? $request->localite : 'null';
                    $commune = (isset($request->commune)) ? $request->commune : 'null';
                    $dpt = (isset($request->departement)) ? $request->departement : 'null';
                    $region = (isset($request->region)) ? $request->region : 'null';
                    $pays = (isset($request->pays)) ? $request->pays : 'null';
                    $langue = (isset($request->langue)) ? $request->langue : 'null';
                    $genre = (isset($request->genre)) ? $request->genre : 'null';
                    $network = 'null';

                    $urlSend = $this->apiUrl . "/voice/appel/" . $entiteId . "/" . $network . "/" . $pays . "/" . $region . "/" . $dpt . "/" . $commune . "/" . $localiteId . "/" . $langue . "/" . $genre . "/null";
                    $response = $this->sendVoiceByParamsWithTypeAlerte($urlSend, $audioFile, $userid, $typeAlerteData, $audioFilename);
                    if ($response->successful()) {
                        return redirect(route('alertes'))->with('message', 'Alerte envoye avec succes!');
                    }
                } elseif ($campagne == 'zone') {
                    $pays = (isset($request->pays)) ? $request->pays : 'null';
                    $langue = (isset($request->langue)) ? $request->langue : 'null';
                    $genre = (isset($request->genre)) ? $request->genre : 'null';
                    $zone = (isset($request->zone)) ? $request->zone : 'null';

                    if ($typeAlerte == 'prevision') {
                        $url = $this->apiUrl . "/voice/previson/zone/null/" . $pays . "/" . $zone . "/" . $langue . "/" . $genre;
                    } else {
                        return redirect(route('alertes'))
                            ->with('message2', 'Service Voice disponible que pour les previsions par zones');
                    }

//                    Function to Update ToDo with new method of upload file
                    $send = $this->sendVoiceByParamsV2($url, $audioFile, $userid, $audioFilename);

                    if ($send->successful()) {
                        return redirect(route('alertes'))->with('message', 'Message de Diffusion envoye avec succes!');
                    }
                } elseif ($campagne == 'diffusion') {
                    $diffusionId = $request->campagnetype;
                    $urlDiffusion = $this->apiUrl . "/voice/diffusion/" . $diffusionId;
                    $typeAlerteData = "Diffusion";

                    if ($role != 'ADMIN' && $role != 'SUPERADMIN') {
                        return redirect(route('alertes'))->with('message2', 'Le nombre de producteurs destinataire est superieur au stock de messages');
                    }

                    if ($typeAlerte == 'prevision') return redirect(route('alertes'))
                        ->with('message2', 'Service pas encore disponibles pour les listes de diffusion');
                    $response = $this->sendVoiceByParamsWithTypeAlerte($urlDiffusion, $audioFile, $userid, $typeAlerteData, $audioFilename);
//                    $response = $this->sendVoiceByParamsV2($urlDiffusion, $audioFile, $userid, $audioFilename);

//                    dd($response);

                    //     Function to Update ToDo with check if the result status is 200
                    if ($response->successful()) {
                        return redirect(route('alertes'))->with('message', 'Message de Diffusion envoye avec succes!');
                    } else {
                        return redirect(route('alertes'))->with('message2', 'Message de Diffusion envoye avec succes! mais Erreur lors de la Sauvegarde');
                    }
                } elseif ($campagne == 'reseau') {
                    $localiteId = 'null';
                    $commune = 'null';
                    $dpt = 'null';
                    $region = 'null';
                    $pays = 'null';
                    $langue = 'null';
                    $genre = 'null';
                    $network = 'null';

                    if (isset($request->campagnetype)) {
                        $network = $request->campagnetype;
                    }
                    $urlSend = $this->apiUrl . "/voice/appel/" . $entiteId . "/" . $network . "/" . $pays . "/" . $region . "/" . $dpt . "/" . $commune . "/" . $localiteId . "/" . $langue . "/" . $genre . "/null";
                    $response = $this->sendVoiceByParamsWithTypeAlerte($urlSend, $audioFile, $userid, $typeAlerteData, $audioFilename);

                    if ($response->successful()) {
                        return redirect(route('alertes'))->with('message', 'Message de ' . $typeAlerte . ' envoye avec succes!');
                    }
                } else {
                    return redirect(route('alertes'))->with('message2', 'Service Voice pas disponible pour les reseaux');
                }
            }
            set_time_limit(180);

        } catch (Exception $e) {
            // Handle exceptions and provide user-friendly error messages
            return back()->withErrors('An error occurred.');
        }
    }

    private function getEmiterName($userId)
    {
        $user = $this->getDataByUrl($this->apiUrl . '/showuser/' . $userId);
        $emiter = 'MLOUMA';
        if (!empty($user)) {
            $emiter = strtoupper($user[0]->nom_entite);
            if ($user[0]->nom_typentite === 'ADMIN' || $user[0]->nom_typentite === 'SUPERADMIN') {
                $emiter = $user[0]->nom_typentite;
            }
        }

        return $emiter;
    }

    public function addByListUpload(Request $request)
    {
        $idListe = $request->liste;
        $enrolement = $request->enrollement;

        if ($enrolement == 'upload') {
            $this->validate($request, [
                'glist' => 'required|file|mimes:xls,xlsx'
            ]);
            $the_file = $request->file('glist');
            try {
                $spreadsheet = IOFactory::load($the_file->getRealPath());
                $sheet = $spreadsheet->getActiveSheet();
                $row_limit = $sheet->getHighestDataRow();
                $column_limit = $sheet->getHighestDataColumn();
                $row_range = range(2, $row_limit);
                $column_range = range('F', $column_limit);
                $startcount = 2;
                $data = array();
                foreach ($row_range as $row) {
                    $data[] = [
                        'prenom' => $sheet->getCell('A' . $row)->getValue(),
                        'nom' => $sheet->getCell('B' . $row)->getValue(),
                        'numero' => $sheet->getCell('C' . $row)->getValue(),
                    ];
                }

                if ($data != []) {

                    foreach ($data as $datum) {
                        $response = Http::withHeaders([
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                        ])->withToken($_SESSION['token'])
                            ->withOptions(['verify' => false])
                            ->withoutVerifying()
                            ->post($this->apiUrl . "/contact/create", [
                                "prenom" => $datum['prenom'],
                                "nom" => $datum['nom'],
                                "tel" => $datum['numero'],
                                "diffusion" => $idListe
                            ]);
                    }

                    // dd($response);
                    return redirect(route('alertes.diffusion.addUserForList', [$idListe]))->with('message', 'Utilisateurs enrollés avec succes!');
                }
            } catch (Exception $e) {
                return back()->withErrors('Erreur survenue lors du chargement du fichier!');
            }
        }
    }

    public function createListDiffusion(Request $request)
    {
        // dd($request);
        $nom = $request->libelle;
        $description = $request->description;
        $entite = $_SESSION['id_entite'];

        $request1 = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post($this->apiUrl . "/diffusions/create", [
            "nom" => $nom,
            "description" => $description,
            "entite" => $entite
        ]);

        if ($request1->successful()) {
            return redirect(route('alertes.liste.diffusion'));
        }
    }

    public function listeDiffusionForCamp($id)
    {
        $users = $this->getContactByIdListe($id);
        return view('services.alerte.diffusion.listUser', ["users" => $users]);;
    }

    public function listeDiffusion()
    {
        $listes = $this->getListeDiffusionByEntite($_SESSION['id_entite']);
        if ($_SESSION['role'] == 'ADMIN' || $_SESSION['role'] == 'SUPERADMIN') {
            $listes = $this->getListeDiffusion();
        }
        return view('services.alerte.diffusion.liste', ["list" => $listes]);
    }

    public function enrollDiffusionForCamp($id)
    {
        $list = $this->getListeDiffusionById($id);
        $list = $list[0];
        $langues = $this->getAllLangue();
        return view('services.alerte.diffusion.create', ['list' => $list, 'langues' => $langues]);
    }

    public function enrollDiffusion()
    {
        $lists = $this->getListeDiffusion();
        $langues = $this->getAllLangue();
        return view('services.alerte.diffusion.create', ['listes' => $lists, 'langues' => $langues]);
    }

    protected function activerListe($id)
    {
        $request1 = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put($this->apiUrl . "/diffusions/activer/" . $id);
        if ($request1->successful()) {
            return redirect(route('alertes.liste.diffusion'));
        }
    }

    protected function desactiverListe($id)
    {
        $request1 = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put($this->apiUrl . "/diffusions/inactiver/" . $id);
        if ($request1->successful()) {
            return redirect(route('alertes.liste.diffusion'));
        }
    }

    protected function details(Request $request)
    {
        $date_alerte = $request->date_reception;
        $type_alerte = $request->type_alerte;
        $sms = $request->sms;
        $stats = [];
        $stats["data"] = [];

        if ($sms != null) {
//             SMS HISTORIES
            $stats['type_message'] = "SMS";
            $stats['contenu'] = $sms;
            $response = $this->getSmsListByAlerte($type_alerte, $sms, $date_alerte);
            $result = $response->object();
            if ($result && !empty($result)) {
                if ($type_alerte == 2) {
//                    dd($result);
                    # Alerte Diffusion
                    foreach ($result as $key => $value) {
                        $stats["data"][] = $value->telephone;
                    }
                } else if ($type_alerte == 3) {
                    # Alerte Prevision
                    foreach ($result as $key => $value) {
                        $stats["data"][] = $value->telephone_prev;
                    }
                }
            }
        } else {
            $stats['type_message'] = "VOICE";
            $stats['contenu'] = $request->voice;
            $sms = $request->voice;
            $response = $this->getVoiceListByAlerte($type_alerte, $sms);
            $result = $response->object();
            if ($result && !empty($result)) {
//                dd($result);
                $id_campagn = $result[0]->id_camp_lam;
                $relance = $result[0]->relance;
                if ($id_campagn == 1) {
                    //Ancien Campagne
                    $stats["data"] = explode(",", $result[0]->telephone);
                } else {
                    //                 Recuperer l'historique sur LAM
//                    dd($id_campagn);
                    $lam_appel_histories = $this->getHistoricsByCampaignID($id_campagn);
//                    dd($lam_appel_histories);
                    $stats["data_lam"] = $lam_appel_histories->calls;
                }

                $stats["campaign_id"] = $id_campagn;
                $stats["relance"] = $relance;
            }
        }
        return view('services.alerte.stats.details', ['stats' => $stats]);
    }

    protected function resendAlert(Request $request)
    {
//        "CALL REJECTED", "UNSPECIFIED"
        $typeLabel = ["NO ANSWER", "NO USER RESPONSE", "USER BUSY", "CALL REJECTED"];
        $userid = Auth::user()->getAuthIdentifier();
        $campagnVoice = $request->campagn_id;
        $audiofile = $request->audiofile;
        $fileName = Storage::disk('public')->put('audiofile', $request->audiofile);
        $audioFilename = asset('storage/' . $fileName);
        $urlFile = $this->apiUrl . "/sendvoice";
        $lam_hist_calls = $this->getHistoricsByCampaignID($campagnVoice)->calls;
        $calls = [];
        foreach ($lam_hist_calls as $lam_hist_call) {
            if (in_array($lam_hist_call->statusLabel, $typeLabel)) $calls[] = $lam_hist_call->phoneNumber;
        }

        $response = $this->resendVoiceToFileList($urlFile, $calls, $audiofile, $userid, $audioFilename);
        if ($response->successful()) return redirect(route('alertes'))->with('message', 'Message Vocale envoyé avec succes!');
    }

    protected function export(Request $request)
    {
        $response = [];
        $calls = [];
        $numeros = [];
        $numero = [];
        $date_alerte = $request->date_reception;
        $type_alerte = $request->type_alerte;
        $sms = $request->sms;
        $campagnVoice = 1;

        if ($request->sms != null) {
//             SMS  STATS
            $sms = $request->sms;
            $response = $this->getSmsListByAlerte($type_alerte, $sms, $date_alerte);
        } else {
//            VOICE STATS
            $sms = $request->voice;
            $response = $this->getVoiceListByAlerte($type_alerte, $sms);
            $resultat_histories_lam = $response->object()[0];

            if ($resultat_histories_lam->id_camp_lam == 1) {
                // get List of historique Ancien API LAM
                $campaignName = $resultat_histories_lam->campaignName;
                $campaignId = $resultat_histories_lam->historyStateId;
                $histories = $this->getHistoriesCalls();
                foreach ($histories as $key => $historie) {
                    if ($campaignName == $historie->campaignName) {
                        $calls = $historie->calls;
                        break;
                    }
                }
            } else {
//                Get Histories By LAM ID CAMPAIGN
                $campagnVoice = $resultat_histories_lam->id_camp_lam;
                $lam_hist = $this->getHistoricsByCampaignID($campagnVoice);
//                dd($lam_hist);
                $callsStatus = $lam_hist->campaignStatus;
                $calls = $lam_hist->calls;
            }
        }

        $list = $response->object();

        if ($campagnVoice != 1) {
//            New Lam API HISTORICS
            foreach ($calls as $call) {
                $numero = [];
                $numero[] = $sms;
                $statut = "" . $call->statusLabel . "/" . $callsStatus;
                $numero[] = $call->phoneNumber;
                $numero[] = $date_alerte;
                $numero[] = $statut;
                $numeros[] = (object)$numero;

            }
        } else {
//            Classic Case
            foreach ($list as $key => $value) {
                $numero = [];
                $numero[] = $sms;
                $statut = "";
                if ($request->sms != null) {
                    if (isset($value->telephone_prev)) {
                        $telephone = $value->telephone_prev;
                    } else {
                        $telephone = $value->telephone;
                    }
                    $statut .= "Delivré";
                } else {
                    if ($campagnVoice != 1) {
//                        dd($calls);

                    } else {
                        $value->contacts = json_decode($value->contacts);
                        $telephone = $value->contacts->called;
                        $idContact = $value->contacts->id;
                        foreach ($calls as $key => $call) {
                            if ($idContact == $call->contactId) {
                                $value->contacts = $call;
                                break;
                            }
                        }

                        if ($value->contacts->callResultId == 1) {
                            $statut .= "En traitement ";
                        }
                        if ($value->contacts->callResultId == 2) {
                            $statut .= "Pas de reponse ";
                        }
                        if ($value->contacts->callResultId == 3) {
                            $statut .= "Accepté";
                        }
                        $statut .= "/";
                        if ($value->contacts->callStateId == 1) {
                            $statut .= "En attente";
                        }
                        if ($value->contacts->callStateId == 2) {
                            $statut .= "En cours";
                        }
                        if ($value->contacts->callStateId == 3) {
                            $statut .= "Terminé";
                        }
                    }
                }
                $numero[] = $telephone;
                $numero[] = $value->date;
                $numero[] = $statut;
                $numeros[] = (object)$numero;
            }
        }

        $name = 'alerte_' . $date_alerte . '_mlouma.xlsx';

        return Excel::download(new NumberExport($numeros, $sms, $date_alerte), $name);
    }


    // Fonctions Intermediaires
    protected function getListeDiffusion()
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/diffusions");
        $listes = $request->object();
        return $listes;
    }

    protected function getListeDiffusionByEntite($idEntite)
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/diffusions/entite/" . $idEntite);
        $listes = $request->object();
        return $listes;
    }

    protected function getListeDiffusionById($id)
    {
        $urlGetListByID = $this->apiUrl . "/diffusions/" . $id;
        $listes = $this->getDataByUrl($urlGetListByID);
        return $listes;

    }

    protected function getAllLangue()
    {
        $urlGetAllLangue = $this->apiUrl . "/getAlllangue";
        $response = $this->getDataByUrl($urlGetAllLangue);
        return $response;
    }

    protected function getContactByIdListe($id)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->get($this->apiUrl . "/contact/diffusion/" . $id);
        return $response->object();
    }

    protected function sendSmsForFile($urlFile, $userid)
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->post($urlFile, [
                "id_utilisateur" => $userid
            ]);
    }

    protected function sendVoiceToFileList($urlFile, $numeros, $audioFilename, $userid)
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->post($urlFile, [
                "numero" => $numeros,
                "file" => $audioFilename,
                "id_utilisateur" => $userid
            ]);

    }

    protected function sendVoiceToFileListV2($urlFile, $numeros, $audiofile, $userid, $audioFilename)
    {
        $params = [
            "numero" => json_encode($numeros),
            "id_utilisateur" => $userid,
            'filename' => $audioFilename,
            'relance' => false
        ];
        $response = Http::attach('file', $audiofile->get(), $audiofile->getClientOriginalName())
            ->withHeaders([
                'Accept' => 'application/json',
            ])->withToken($_SESSION['token'])
            ->post($urlFile, $params);

        return $response;
    }

    protected function resendVoiceToFileList($urlFile, $numeros, $audiofile, $userid, $audioFilename)
    {
        $params = [
            "numero" => json_encode($numeros),
            "id_utilisateur" => $userid,
            'filename' => $audioFilename,
            'relance' => true
        ];
        $response = Http::attach('file', $audiofile->get(), $audiofile->getClientOriginalName())
            ->withHeaders([
                'Accept' => 'application/json',
            ])->withToken($_SESSION['token'])
            ->post($urlFile, $params);

        return $response;
    }

    protected function sendMessageByParams2($url, $message, $userId)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->post($url, [
                "message" => $message,
                "id_utilisateur" => $userId
            ]);
        return $response;
    }

    protected function sendVoiceByParams2($url, $file, $userId)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->post($url, [
                "file" => $file,
                "id_utilisateur" => $userId
            ]);
        return $response;
    }

    protected function sendVoiceByParamsV2($url, $audiofile, $userId, $audioFilename)
    {
        $response = Http::attach('file', $audiofile->get(), $audiofile->getClientOriginalName())
            ->withHeaders([
                'Accept' => 'application/json',
//                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->post($url, [
//                "file" => $file,
                "id_utilisateur" => $userId,
                'filename' => $audioFilename
            ]);
        return $response;
    }

    protected function sendMessageByParamsWithTypeAlerte($url, $message, $userId, $typeAlerteData)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->post($url, [
                "message" => $message,
                "id_utilisateur" => $userId,
                "alerte" => $typeAlerteData
            ]);
        return $response;
    }

    //    Check function - ok
    protected function sendVoiceByParamsWithTypeAlerte($url, $file, $userId, $typeAlerteData, $audioFilename)
    {
        $response = Http::attach('file', $file->get(), $file->getClientOriginalName())
            ->withHeaders([
                'Accept' => 'application/json',
            ])->withToken($_SESSION['token'])
            ->post($url, [
                'alerte' => $typeAlerteData,
                'id_utilisateur' => $userId,
                'filename' => $audioFilename
            ]);

        return $response;
    }

//    Statistics INIT
    protected function getAllStats()
    {
        $url = $this->apiUrl . "/sms/stat_sms/";
        $response = $this->getDataByUrl($url);
        return $response;
    }

    protected function getStatsByUser($id)
    {
        $url = $this->apiUrl . "/sms/stat_sms_by_user/" . $id;
        $response = $this->getDataByUrl($url);
        return $response;
    }
//  End  Statistics INIT

    // LAM HISTORIES
    protected function getHistoriesCalls()
    {
        $urlVoice = 'https://voice.lafricamobile.com/api/Histories';
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->get($urlVoice, [
                'login' => "mlouma",
                'password' => "9J3KbA44am",
            ])->object();
    }

    public function getHistoricsByCampaignID($campaign_id)
    {
        $urlVoice = $this->apiVoiceLam . '/statistics/' . $campaign_id;
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withOptions(['verify' => false])
            ->withoutVerifying()
            ->post($urlVoice, [
                'login' => "mlouma",
                'password' => "9J3KbA44am"
            ])->object();
        return $response;
    }
//     END LAM HISTORIES

    // Voice & SMS Histories on System
    protected function getVoiceListByAlerte($type_alerte, $sms)
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->get($this->apiUrl . "/voice_date/" . $type_alerte, [
                'voice' => $sms,
            ]);
    }

    // SMS Histories
    protected function getSmsListByAlerte($type_alerte, $sms, $date_alerte)
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->get($this->apiUrl . "/sms_date/" . $type_alerte, [
                'sms' => $sms,
                'date' => $date_alerte
            ]);
    }

    // END Voice & SMS Histories on System

    // Raccourcis Appel WEB SERVICES || Transformer en Action
    private function getDataByUrl($url)
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($url)->object();
    }

}
