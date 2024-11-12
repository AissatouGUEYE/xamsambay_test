<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class ProducteurController extends Controller
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
        //
        // dd($_SESSION);
        $langues = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/getAlllangue")->object();
        $produits = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/produit")->object();

        if (in_array($_SESSION['role'], ["ADMIN", "SUPERADMIN"])) {
            # code...
            $users_url = $this->apiUrl . "/user";
            $pluvio_url = $this->apiUrl . "/mlpluvio";
            $producteurs_url = $this->apiUrl . "/producteurs";
            $reseaux_url = $this->apiUrl . '/groupements';
        } else {
            // elseif (in_array($_SESSION['role'], ["ONG", "OP", "MLOUMER"])) {
            # code...
            $users_url = $this->apiUrl . "/showuser/entite/" . $_SESSION['id_entite'];
            $pluvio_url = $this->apiUrl . "/mlpluvio";
            $producteurs_url = $this->apiUrl . "/producteurs";
            $reseaux_url = $this->apiUrl . "/entite/groupements/" . $_SESSION['id_entite'];
            // $prod_membres_url = $this->apiUrl . "/groupements/membres/";

            if (isset($_SESSION['role_user']) && $_SESSION['role_user'] === "GESTIONNAIRE BD") {
                # code...
                // $producteurs_url = $prod_membres_url."". $_SESSION['groupement'];

            }
        }

        $users = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($users_url);

        $producteurs = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->withToken($_SESSION['token'])->get($producteurs_url);

        $pluvios = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($pluvio_url);

        $reseaux = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($reseaux_url);

        $users = $users->object();
        $producteurs = $producteurs->object();
        $pluvios = (array)($pluvios->object());
        $reseaux = (array)($reseaux->object());
        // dd($producteurs);
        // $producteur_groupement  = array();
        // if (isset($prod_membres_url)) {
        //     foreach ($reseaux as $key => $reseau) {
        //         # code...
        //         $prod_membres = Http::withHeaders([
        //             'Accept' => 'application/json',
        //             'Content-Type' => 'application/json',
        //             // 'Authorization' => $_SESSION['token']
        //         ])->withToken($_SESSION['token'])->withoutVerifying()->get($producteurs_url);
        //         $prod_membres  =  (array)$prod_membres->object();
        //         // dd($prod_membres);

        //         foreach ($prod_membres as $key => $value) {
        //             if ($value->nom_typentite != "PRODUCTEUR") {
        //                 unset($prod_membres[$key]);
        //             }
        //         }
        //         // dd($producteur_groupement);
        //         array_push($producteur_groupement, $prod_membres);
        //     }
        // }

        // dd($producteurs);

        return view(
            'gestion.producteurs.index',
            compact('producteurs', 'users', 'reseaux', 'pluvios', 'langues', 'produits')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dump("Creation de producteur");
        //
        $langues = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/getAlllangue")->object();
        $produits = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/produit")->object();
        if (in_array($_SESSION['role'], ["ADMIN", "SUPERADMIN"])) {
            # code...
            $users_url = $this->apiUrl . "/user";
            $pluvio_url = $this->apiUrl . "/mlpluvio";
            $producteurs_url = $this->apiUrl . "/producteurs";
            $reseaux_url = $this->apiUrl . '/groupements';
        } else {
            // elseif (in_array($_SESSION['role'], ["ONG", "OP", "MLOUMER"])) {
            # code...
            $users_url = $this->apiUrl . "/showuser/entite/" . $_SESSION['id_entite'];
            $pluvio_url = $this->apiUrl . "/mlpluvio";
            $producteurs_url = $this->apiUrl . "/producteurs";
            $reseaux_url = $this->apiUrl . "/entite/groupements/" . $_SESSION['id_entite'];
            $prod_membres_url = $this->apiUrl . "/groupements/membres/";
        }

        $users = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($users_url);
        $producteurs = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->withToken($_SESSION['token'])->get($producteurs_url);
        $pluvios = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($pluvio_url);
        $reseaux = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($reseaux_url);

        $users = $users->object();
        $producteurs = $producteurs->object();
        $pluvios = (array)($pluvios->object());
        $reseaux = (array)($reseaux->object());
        $producteur_groupement  = array();
        if (isset($prod_membres_url)) {
            foreach ($reseaux as $key => $reseau) {
                # code...
                $prod_membres = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    // 'Authorization' => $_SESSION['token']
                ])->withToken($_SESSION['token'])->withoutVerifying()
                    ->get($prod_membres_url . "" . $reseau->id_groupement);
                $prod_membres  =  (array)$prod_membres->object();

                array_push($producteur_groupement, $prod_membres);
            }
        }

        // dd($producteurs);

        return view(
            'gestion.producteurs.create',
            compact('producteurs', 'users', 'reseaux', 'pluvios', 'producteur_groupement', 'langues', 'produits')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # code...
        $data = [
            // "profil" => $request->user,
            // "pluvio" => $request->pluvio
            // "reseau" => $request->reseau,
            // "localite" =>$request->localite,
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'dt_naiss' => date("Y-m-d", strtotime($request->dtNaiss)),
            'telephone' => $request->telephone,
            'email' => $request->email,
            'sexe' => $request->sexe,
            'sit_matrimonial_id' => intval($request->sit_matrimonial),
            'type_reception' => $request->canal,
            'langue_reception' => $request->langue,
            'localite' => intval($request->localite),
            'actif' => 1,
            'status' => $request->status,
            'groupement' => intval($request->reseau),
            'pluvio' => intval($request->pluvio),
            'role' => "null",
            'produit' => serialize($request->produit),
            'entite' => 31,
        ];

        $producteurs = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->withToken($_SESSION['token'])->post($this->apiUrl . "/register/producteur", $data);

        $producteurs = (array)$producteurs->object();
        if (!empty($producteurs)) {

            $message = "Producteur ajouté avec succés";
        } else {
            $message = "Erreur lors de l'ajout";
        }

        return response(["message" => $message], 200);
    }
    
    public function store_list(Request $request)
    {

        $this->validate($request, [
            'glist' => 'required|file|mimes:xls,xlsx'
        ]);
        set_time_limit(600);
        $the_file = $request->file('glist');
        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range(2, $row_limit);
            $column_range = range('J', $column_limit);
            $startcount = 1;
            $data = array();
            foreach ($row_range as $row) {
                $data[] = [
                    'prenom' => $sheet->getCell('A' . $row)->getValue(),
                    'nom' => $sheet->getCell('B' . $row)->getValue(),
                    'dt_naiss' => $sheet->getCell('C' . $row)->getFormattedValue(),
                    'telephone' => $sheet->getCell('D' . $row)->getValue(),
                    'email' => $sheet->getCell('E' . $row)->getValue(),
                    'sexe' => $sheet->getCell('F' . $row)->getValue(),
                    'type_reception' => $sheet->getCell('G' . $row)->getValue(),
                    'langue' => $sheet->getCell('H' . $row)->getValue(),
                    'localite' => intval($request->localite),
                    // 'produit' => explode(',', $sheet->getCell('I' . $row)->getValue()),
                    // 'produit' => $sheet->getCell('I' . $row)->getValue(),
                    'actif' => $sheet->getCell('I' . $row)->getValue(),
                    'status' => $sheet->getCell('I' . $row)->getValue(),
                    'groupement' => intval($request->reseau),
                    'pluvio' => intval($request->pluvio),
                    'entite' => 31,
                ];
            }



            for ($i = 0; $i < count($data); $i++) {
                # code...
                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withOptions(['verify' => false])
                    ->withoutVerifying()
                    ->post($this->apiUrl . "/register/producteur", $data[$i]);
                if ($response->status() == 200) {
                    $startcount++;
                }
            }
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return response(['message' => 'Erreur survenue lors du chargement du fichier!'], 200);
        }
        set_time_limit(60);
        return response([
            'message' => 'Liste ajoutée avec succés',
            "Nb Total de ligne" => $sheet->getHighestDataRow(),
            "Lignes insérées" => $startcount
        ], 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producteur = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/producteurs/" . $id)->object();
        // Get Producteur By Id
        // dd($producteur);

        $meteombay = $producteur->prod_meteo;
        $prix = $producteur->prod_prix;
        if (!empty($producteur->data[0])) {
            $producteur = $producteur->data[0];
        } else {
            $producteur = [];
        }

        return view(
            'gestion.producteurs.view',
            compact('producteur', 'meteombay', 'prix')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producteur = [];
        $region = [];
        // Get Producteur By Id
        $langues = $this->getDataByUrl($this->apiUrl . "/getAlllangue");
        $produits = $this->getDataByUrl($this->apiUrl . "/produit");

        if (in_array($_SESSION['role'], ["ADMIN", "SUPERADMIN"])) {
            # code...
            $users_url = $this->apiUrl . "/user";
            $pluvio_url = $this->apiUrl . "/mlpluvio";
            $producteurs_url = $this->apiUrl . "/producteurs";
            $reseaux_url = $this->apiUrl . '/groupements';
        } else {
            // elseif (in_array($_SESSION['role'], ["ONG", "OP", "MLOUMER"])) {
            # code...
            $users_url = $this->apiUrl . "/showuser/entite/" . $_SESSION['id_entite'];
            $pluvio_url = $this->apiUrl . "/mlpluvio";
            $producteurs_url = $this->apiUrl . "/producteurs";
            $reseaux_url = $this->apiUrl . "/entite/groupements/" . $_SESSION['id_entite'];
            $prod_membres_url = $this->apiUrl . "/groupements/membres/";
        }

        $users = $this->getDataByUrl($users_url);
        $producteurs = $this->getDataByUrl($producteurs_url);

        $pluvios = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($pluvio_url);
        $reseaux = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($reseaux_url);
        $pluvios = (array)($pluvios->object());
        $reseaux = (array)($reseaux->object());
        $producteur_groupement  = array();
        if (isset($prod_membres_url)) {
            foreach ($reseaux as $key => $reseau) {
                # code...
                $prod_membres = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    // 'Authorization' => $_SESSION['token']
                ])->withToken($_SESSION['token'])->withoutVerifying()
                    ->get($prod_membres_url . "" . $reseau->id_groupement);
                $prod_membres  =  (array)$prod_membres->object();

                array_push($producteur_groupement, $prod_membres);
                // dd($producteur_groupement);
            }
        }

        $producteur_data = $this->getDataByUrl($this->apiUrl . "/producteurs/" . $id);
        // dd($producteur);

        $meteombay = $producteur_data->prod_meteo;
        $prix = $producteur_data->prod_prix;
        if (isset($producteur_data->data[0]) && !empty($producteur_data->data[0])) {
            # code...
            $producteur = $producteur_data->data[0];

            $producteur->dt_naiss = date('d/m/Y', strtotime($producteur->dt_naiss));

            if ($_SESSION['role'] == "ONG") {
                $pays = $producteur->id_pays;
                $region = $this->getDataByUrl($this->apiUrl . "/showreg/" . $pays);
                // dd($region);
            }
        }
        $pays = $this->getDataByUrl($this->apiUrl . "/pays");




        return view(
            'gestion.producteurs.editProducteur',
            compact('producteur', 'producteurs', 'users', 'reseaux', 'pluvios', 'producteur_groupement', 'langues', 'produits', 'meteombay', 'prix', 'region', 'pays')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function store_list_prix(Request $request)
    {
        # code...

        $this->validate($request, [
            'pplist' => 'required|file|mimes:xls,xlsx'
        ]);
        $the_file = $request->file('pplist');
        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range(2, $row_limit);
            $column_range = range('E', $column_limit);
            $startcount = 0;
            $data = array();
            foreach ($row_range as $row) {
                $data[] = [
                    'prenom' => $sheet->getCell('A' . $row)->getValue(),
                    'nom' => $sheet->getCell('B' . $row)->getValue(),
                    'dt_naiss' => "null",
                    'telephone' => $sheet->getCell('C' . $row)->getValue(),
                    'email' => "null",
                    'sexe' => $sheet->getCell('D' . $row)->getValue(),
                    'type_reception' => "null",
                    'langue' => "null",
                    'localite' => intval($request->localite),
                    'produit' => explode(',', $sheet->getCell('E' . $row)->getValue()),
                    'groupement' => intval($request->reseau),
                    'entite' => 31,
                    'region'  => intval($request->region)
                ];
            }

            for ($i = 0; $i < count($data); $i++) {
                # code...
                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withOptions(['verify' => false])
                    ->withoutVerifying()
                    ->post($this->apiUrl . "/register/prix_producteur", $data[$i]);
                if ($response->status() == 200) {
                    $startcount++;
                }
            }
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return response([
                'message' => 'Erreur survenue lors du chargement du fichier!'
            ], 200);
        }
        return response([
            'message' => 'Liste ajoutée avec succés',
            "nl" => $sheet->getHighestDataRow() - 1,
            "li" => $startcount
        ], 200);
    }


    public function getDataByUrl($url)
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($url)->object();
    }
}
