<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Storage;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

use Illuminate\Support\Facades\DB;

class GroupementController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function index()
    {
        $groupements = [];
        $union_groupements = [];
        $auop = [];

        $nb_grp = 0;
        $nb_auop = 0;
        $nb_uop = 0;

        $localites = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/localites")->json();

        $ong = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ong")->json();

        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN" || $_SESSION['role'] === "Superviseur") {

            $nb_grp = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/groupements/nombre/count_grp/null/null/null")->json();

            $nb_uop = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/union_groupements/nombre/count_uop/null/null")->json();

            $nb_auop = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/auop/nombre/count_auop/null")->json();

            $auop = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/auop")->json();

            $groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/groupements")->json();

            // return $groupements;

            $union_groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/union_groupements")->json();
        } elseif ($_SESSION['role'] === "ONG") {

            $nb_grp = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/groupements/nombre/count_grp/" . $_SESSION['id_entite']. "/null/null")->json();

            $nb_uop = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/union_groupements/nombre/count_uop/" . $_SESSION['id_entite']. "/null")->json();

            $nb_auop = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/auop/nombre/count_auop/" . $_SESSION['id_entite'])->json();

            $auop = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/entite/auop/" . $_SESSION['id_entite'])->json();


            $groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/groupements/show/" . $_SESSION['id_entite'] . "/null/null")->json();

            $union_groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/entite/union_groupements/" . $_SESSION['id_entite'])->json();
        } elseif ($_SESSION['role'] === "UOP") {

            $nb_grp = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/groupements/nombre/count_grp/null/null/" . $_SESSION['union_groupement'])->json();

            $auop = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/auop")->json();


            $groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/groupements/show/null/null/" . $_SESSION['union_groupement'])->json();


            $union_groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/union_groupements")->json();
        } elseif ($_SESSION['role'] === "AUOP") {

            $nb_grp = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/groupements/nombre/count_grp/null/" . $_SESSION['AUOP']. "/null")->json();

            $nb_uop = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/union_groupements/nombre/count_uop/null/" . $_SESSION['AUOP'])->json();

            $auop = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/auop")->json();

            $groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/groupements/show/null/" . $_SESSION['AUOP'] . "/null")->json();

            $union_groupements = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/auop/union_groupements/" . $_SESSION['AUOP'])->json();
        }

        // return view('gestion.groupements.index', ['nb_grp' => $nb_grp, 'nb_uop' => $nb_uop, 'nb_auop' => $nb_auop, 'ong' => $ong, 'groupements' => $groupements, 'auop' => $auop, 'union_groupements' => $union_groupements, 'localites' => $localites]);

        return view('gestion.groupements.index', compact('nb_grp', 'nb_uop', 'nb_auop', 'ong', 'groupements','auop', 'union_groupements', 'localites'));

    }

    public function membre($libelle, $id)
    {
        $nb_prod = session('nb_prod');
        $duplicated_num = session('duplicated_num');
        $duplicated_mail = session('duplicated_mail');
        $total_data = session('total_data');

        // return $duplicated_num;

        $token = strval($_SESSION['token']);

        $producteurs = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/producteurs")->json();

        $pluvios = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/mlpluvio")->json();

        $membres = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->get($this->apiUrl . "/groupements/membres/" . $id)->json();

        // return $membres;

        $data = compact('id', 'membres', 'libelle', 'producteurs', 'pluvios', 'total_data', 'nb_prod', 'duplicated_num', 'duplicated_mail');

        return view('gestion.groupements.groupements.membres', $data);

    }


    public function ajouter_membre($libelle, $id, Request $request)
    {
        $token = strval($_SESSION['token']);
        $url = $this->apiUrl . "/groupements/membres/ajouter/" . $id;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->put($url, [
            'producteur' => $request->producteur

        ]);

        return redirect('/groupements/membres/' . $libelle . '/' . $id);
    }


    public function membre_list($libelle, $id, Request $request)
    {

        $this->validate($request, [
            'plist' => 'required|file|mimes:xls,xlsx'
        ]);
        $the_file = $request->file('plist');

        $nb_prod = 0;
        $nb_num = 0;
        $nb_mail = 0;
        $duplicated_num = array();
        $duplicated_mail = array();

        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range(2, $row_limit);
            $column_range = range('J', $column_limit);
            $startcount = 2;
            $data = array();
            foreach ($row_range as $row) {

                $dt_naiss = str_replace('/', '-', $sheet->getCell('C' . $row)->getFormattedValue());

                $data[] = [
                    'prenom' => $sheet->getCell('A' . $row)->getValue(),
                    'nom' => $sheet->getCell('B' . $row)->getValue(),
                    'dt_naiss' => $dt_naiss,
                    'telephone' => $sheet->getCell('D' . $row)->getValue(),
                    'email' => $sheet->getCell('E' . $row)->getValue(),
                    'sexe' => $sheet->getCell('F' . $row)->getValue(),
                    'type_reception' => $sheet->getCell('G' . $row)->getValue(),
                    'langue' => $sheet->getCell('H' . $row)->getValue(),
                    'localite' => intval($request->localite),
                    'commune' => intval($request->commune),
                    'dept' => intval($request->dept),
                    'region' => intval($request->region),
                    'produit' => explode(',', $sheet->getCell('I' . $row)->getValue()),
                    // 'produit' => array($sheet->getCell('I' . $row)->getValue()),
                    'actif' => $sheet->getCell('J' . $row)->getValue(),
                    'status' => $sheet->getCell('J' . $row)->getValue(),
                    'groupement' => $id,
                    'pluvio' => intval($request->pluvio),
                    'entite' => 31,
                ];
            }

            $total_data = count($data);

            // print_r($data);
            // exit;
            for ($i = 0; $i < count($data); $i++) {
                for ($j = 0; $j < count($data[$i]['produit']); $j++) {
                    $data[$i]['produit'][$j] = DB::table('crm_produit')
                        ->where('crm_produit.produit', '=', $data[$i]['produit'][$j])->value('crm_produit.id');
                }

                // $data[$i]['produit'] = implode(',', $data[$i]['produit']);
                $data[$i]['produit'] = serialize($data[$i]['produit']);
                // $data[$i]['produit'] = unserialize( $data[$i]['produit'] );

            }

            for ($i = 0; $i < count($data); $i++) {
                    $data[$i]['localite_name'] = DB::table('crm_localite')
                        ->where('crm_localite.id', '=', $data[$i]['localite'])->value('crm_localite.localite');
            }

            for ($i = 0; $i < count($data); $i++) {
                    $data[$i]['commune_name'] = DB::table('crm_commune')
                        ->where('crm_commune.id', '=', $data[$i]['commune'])->value('crm_commune.commune');
                    }
            for ($i = 0; $i < count($data); $i++) {
                    $data[$i]['dept_name'] = DB::table('crm_departement')
                        ->where('crm_departement.id', '=', $data[$i]['dept'])->value('crm_departement.departement');
                    }
            for ($i = 0; $i < count($data); $i++) {
                    $data[$i]['region_name'] = DB::table('crm_region')
                        ->where('crm_region.id', '=', $data[$i]['region'])->value('crm_region.region');
                
            }

            // $test = unserialize('a:2:{i:0;s:1:"1";i:1;s:1:"2";}');
            // print_r($data);
            // exit;
            for ($i = 0; $i < count($data); $i++) {
                # code...
                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withOptions(['verify' => false])
                    ->withoutVerifying()
                    ->post($this->apiUrl . "/register/producteur", $data[$i]);
                $startcount++;

                // return $response;
                if ($response->status() == 200)
                {
                    $nb_prod++;
                    $message = "Producteur enrégistré avec succés";
                    $status = 200;

                }
                elseif($response->status() == 404)
                {
                    // $duplicated_num[] = $data[$i]['telephone'];
                    $duplicated_num[] = $data[$i];
                    $message = "Erreur, ce numéro existe déjà dans la base !";
                    $status = 404;
                }
                elseif($response->status() == 405)
                {
                    $duplicated_mail[] = $data[$i];
                    $message = "Erreur, cet email existe déjà dans la base !";
                    $status = 405;
                }
                else
                {
                    $message = "Enrégistrement échoué. Veuillez contacter l'administrateur";
                    $status = 500 ;
                }
            }
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            //  return back()->withErrors('Erreur survenue lors du chargement du fichier!');
            return response(['message' => 'Erreur survenue lors du chargement du fichier!'], 200);
        }

        //  return back()->withSuccess('fichier chargé  avec  succés.');
        // return redirect('/groupements/membres/'.$libelle.'/'.$id);



        // return $total_data;
        // return $nb_prod;
        // return $duplicated_num;
        // return $duplicated_mail;
        // return redirect('/groupements/membres/' . $libelle . '/' . $id)
        //             ->with('total_data', $total_data);

        if($total_data == $nb_prod)
        {
            // return $total_data;
            return redirect('/groupements/membres/' . $libelle . '/' . $id)
                    ->with('total_data', $total_data);
        }
        else
        {
            $nb_num = count($duplicated_num);
            $nb_mail = count($duplicated_mail);

            // return $nb_num;

            return view('gestion.groupements.groupements.erreur', compact('nb_num', 'nb_mail','nb_prod', 'total_data', 'nb_prod', 'duplicated_num', 'duplicated_mail',
                            'id', 'libelle'));
        }



    }


    public function updatebyphone($libelle, $id, Request $request)
    {

        $this->validate($request, [
            'phonelist' => 'required|file|mimes:xls,xlsx'
        ]);
        $the_file = $request->file('phonelist');

        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range(2, $row_limit);
            $column_range = range('E', $column_limit);
            $startcount = 2;
            $data = array();
            foreach ($row_range as $row) {

                $data[] = [

                    'telephone' => $sheet->getCell('D' . $row)->getValue(),
                ];
            }

            // return $data[0]["telephone"];
            $total_data = count($data);

            for ($i = 0; $i < count($data); $i++) {
                # code...

                $url = $this->apiUrl . "/updateprod/" . $data[$i]["telephone"]. "/null";
                // return $url ;

                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withOptions(['verify' => false])
                    ->withoutVerifying()
                    ->put($url, [
                        'groupement' => $id]);
                $startcount++;

                // return $response;
                if ($response->status() == 200)
                {
                    $message = "Producteur enrégistré avec succés";
                    $status = 200;

                }
                else
                {
                    $message = "Enrégistrement échoué. Veuillez contacter l'administrateur";
                    $status = 500 ;
                }
            }
        } catch (Exception $e) {

            return response(['message' => 'Erreur survenue lors du chargement du fichier!'], 200);
        }


        return redirect('/groupements/membres/' . $libelle . '/' . $id)
                ->with('total_data', $total_data);



    }

    public function updatebymail($libelle, $id, Request $request)
    {

        $this->validate($request, [
            'maillist' => 'required|file|mimes:xls,xlsx'
        ]);
        $the_file = $request->file('maillist');

        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range(2, $row_limit);
            $column_range = range('E', $column_limit);
            $startcount = 2;
            $data = array();
            foreach ($row_range as $row) {

                $data[] = [

                    'mail' => $sheet->getCell('D' . $row)->getValue(),
                ];
            }

            // return $data[0]["telephone"];
            $total_data = count($data);

            for ($i = 0; $i < count($data); $i++) {
                # code...

                $url = $this->apiUrl . "/updateprod/null/" . $data[$i]["mail"];
                // return $url ;

                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withOptions(['verify' => false])
                    ->withoutVerifying()
                    ->put($url, [
                        'groupement' => $id]);
                $startcount++;

                // return $response;
                if ($response->status() == 200)
                {
                    $message = "Producteur enrégistré avec succés";
                    $status = 200;

                }
                else
                {
                    $message = "Enrégistrement échoué. Veuillez contacter l'administrateur";
                    $status = 500 ;
                }
            }
        } catch (Exception $e) {

            return response(['message' => 'Erreur survenue lors du chargement du fichier!'], 200);
        }


        return redirect('/groupements/membres/' . $libelle . '/' . $id)
                ->with('total_data', $total_data);



    }

    // public function retirer_membre($libelle, $id, $producteur)
    // {
    //     $token = strval($_SESSION['token']);
    //     $url = "https://api.mlouma.org/api/groupements/membres/retirer/". $producteur;

    //     Http::withHeaders([
    //         'Accept' => 'application/json',
    //         'Content-Type' => 'application/json',
    //     ])->withToken($token)->withoutVerifying()->put($url);

    //     // return redirect('/langue');
    //     return redirect('/groupements/membres/'.$libelle.'/'.$id);
    // }

    public function store(Request $request)
    {
        $token = strval($_SESSION['token']);
        $url = $this->apiUrl . "/groupements/create";

        $date_creation = str_replace('/', '-', $request->date_creation);
        $date_creation = date('Y-m-d', strtotime($date_creation));



        $filename = null;

        if ($request->ninea) {
            $filename = Storage::disk('public')->put('groupements', $request->ninea);
        }


        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {

            Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($token)->withoutVerifying()->post($url, [
                'libelle' => $request->libelle,
                'date_creation' => $date_creation,
                'entite' => $request->entite,
                'localite' => $request->localite,
                'union_groupement' => $request->union_groupement,
                'description' => $request->description,
                'ninea' => $filename


            ]);
        } elseif ($_SESSION['role'] === "ONG") {

            Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($token)->withoutVerifying()->post($url, [
                'libelle' => $request->libelle,
                'date_creation' => $date_creation,
                'entite' => $_SESSION['id_entite'],
                'localite' => $request->localite,
                'union_groupement' => $request->union_groupement,
                'description' => $request->description,
                'ninea' => $filename


            ]);
        }


        // return redirect('/langue');
        return redirect('/groupements');
    }

    public function phone_form($libelle, $id)
    {
        return view('gestion.groupements.groupements.phone_form', ['id' => $id, 'libelle' => $libelle]);
    }

    public function mail_form($libelle, $id)
    {
        return view('gestion.groupements.groupements.mail_form', ['id' => $id, 'libelle' => $libelle]);
    }

    public function migrerPhone($libelle, $id, Request $request)
    {
        
        $this->validate($request, [
            'plist' => 'required|file|mimes:xls,xlsx'
        ]);
        $the_file = $request->file('plist');

        // return $the_file;
        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range(2, $row_limit);
            $column_range = range('G', $column_limit);
            $startcount = 2;
            $data = array();
            foreach ($row_range as $row) {

                $data[] = [

                    'telephone' => $sheet->getCell('F' . $row)->getValue(),
                ];
            }

            // return $data[0]["telephone"];
            $total_data = count($data);

            for ($i = 0; $i < count($data); $i++) {
                # code...

                $url = $this->apiUrl . "/updateprod/221" . $data[$i]["telephone"]. "/null";
                // return $url ;

                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withOptions(['verify' => false])
                    ->withoutVerifying()
                    ->put($url, [
                        'groupement' => $id,
                        'pluvio' => $request->pluvio]);
                $startcount++;

                // return $response;
                if ($response->status() == 200)
                {
                    $message = "Producteur enrégistré avec succés";
                    $status = 200;

                }
                else
                {
                    $message = "Enrégistrement échoué. Veuillez contacter l'administrateur";
                    $status = 500 ;
                }
            }
        } catch (Exception $e) {

            return response(['message' => 'Erreur survenue lors du chargement du fichier!'], 200);
        }


        return redirect('/groupements/membres/' . $libelle . '/' . $id)
                ->with('total_data', $total_data);


    }

    public function migrerMail($libelle, $id, Request $request)
    {

        $this->validate($request, [
            'maillist' => 'required|file|mimes:xls,xlsx'
        ]);
        $the_file = $request->file('maillist');

        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range(2, $row_limit);
            $column_range = range('G', $column_limit);
            $startcount = 2;
            $data = array();
            foreach ($row_range as $row) {

                $data[] = [

                    'mail' => $sheet->getCell('F' . $row)->getValue(),
                ];
            }

            // return $data[0]["telephone"];
            $total_data = count($data);

            for ($i = 0; $i < count($data); $i++) {
                # code...

                $url = $this->apiUrl . "/updateprod/null/" . $data[$i]["mail"];
                // return $url ;

                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withOptions(['verify' => false])
                    ->withoutVerifying()
                    ->put($url, [
                        'groupement' => $id,
                        'pluvio' => $request->pluvio]);
                $startcount++;

                // return $response;
                if ($response->status() == 200)
                {
                    $message = "Producteur enrégistré avec succés";
                    $status = 200;

                }
                else
                {
                    $message = "Enrégistrement échoué. Veuillez contacter l'administrateur";
                    $status = 500 ;
                }
            }
        } catch (Exception $e) {

            return response(['message' => 'Erreur survenue lors du chargement du fichier!'], 200);
        }


        return redirect('/groupements/membres/' . $libelle . '/' . $id)
                ->with('total_data', $total_data);



    }
    

    public function modifier($id)
    {
        $token = strval($_SESSION['token']);

        $union_grp = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/union_groupements")->json();


        $ong = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ong")->json();


        $groupement = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->get($this->apiUrl . "/groupements/" . $id)->json();

        // return $groupement;

        $union = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->get($this->apiUrl . "/groupements/union/" . $id)->json();

        $localites = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/localites")->json();


        return view('gestion.groupements.groupements.edit', ['union_grp' => $union_grp, 'groupement' => $groupement, 'union' => $union, 'localites' => $localites, 'ong' => $ong]);
    }

    public function edit(Request $request)
    {
        $token = strval($_SESSION['token']);
        $id = $request->id;
        $url = $this->apiUrl . "/groupements/update/" . $id;

        $date_creation = str_replace('/', '-', $request->date_creation);
        $date_creation = date('Y-m-d', strtotime($date_creation));


        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {

            Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($token)->withoutVerifying()->put($url, [
                'libelle' => $request->libelle,
                'date_creation' => $date_creation,
                'entite' => $request->entite,
                'localite' => $request->localite,
                'union_groupement' => $request->union_groupement,
                'description' => $request->description


            ]);
        } elseif ($_SESSION['role'] === "ONG") {

            Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($token)->withoutVerifying()->put($url, [
                'libelle' => $request->libelle,
                'date_creation' => $date_creation,
                'entite' => $_SESSION['id_entite'],
                'localite' => $request->localite,
                'union_groupement' => $request->union_groupement,
                'description' => $request->description
                // 'ninea' => $filename


            ]);
        }

        return redirect('/groupements');
    }

    public function delete($id)
    {
        $token = strval($_SESSION['token']);
        $url = $this->apiUrl . "/groupements/delete/" . $id;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($token)->withoutVerifying()->delete($url);

        return redirect('/groupements');
    }
}
