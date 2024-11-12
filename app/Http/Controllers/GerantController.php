<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\ImportGerant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Illuminate\Http\Response;

class GerantController extends Controller
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


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $reseaux = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/groupements");
        $reseaux  = (array)($reseaux->object());
        $pluvios = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/mlpluvio");
        $pluvios  = (array)($pluvios->object());
        return view('services.informations_climatiques.parametrage.gerant.create', compact('reseaux', 'pluvios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $create_gerant = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post(
            $this->apiUrl . "/register/gerant",
            [
                // "profil" => $request->user,
                // "reseau" => $request->reseau,
                // "localite" =>$request->localite,
                'prenom' => $request->prenom,
                'nom' => $request->nom,
                'dt_naiss' => date("Y-m-d", strtotime($request->dtNaiss)),
                'telephone' => $request->telephone,
                'email' => $request->email,
                'sexe' => $request->sexe,
                'canal' => $request->canal,
                'langue_reception' => $request->langue,
                'localite' => intval($request->localite),
                'actif' => 1,
                'status' => $request->status,
                'groupement' => intval($request->reseau),
                'pluvio' => intval($request->pluvio),
                'produit' => serialize($request->produit),
                'entite' => 21,
            ]
        );
        $res  = $create_gerant->object();
        print_r($res);
        exit;
        if ($res) {
            $message =  "Gerant créé avec succés";
        } else {
            $message = "Erreur lors de la création du gerant";
        }

        return response(['message' => $message], 200);
    }

    public function store_list(Request $request)
    {




        $this->validate($request, [
            'glist' => 'required|file|mimes:xls,xlsx'
        ]);
        $the_file = $request->file('glist');
        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range(2, $row_limit);
            $column_range = range('F', $column_limit);
            $startcount = 2;
            $data = array();
            foreach ($row_range as $row) {
                $data[] = [
                    'prenom' => $sheet->getCell('A' . $row)->getValue(),
                    'nom' => $sheet->getCell('B' . $row)->getValue(),
                    'telephone' => $sheet->getCell('C' . $row)->getValue(),
                    'email' => $sheet->getCell('D' . $row)->getValue(),
                    'login' => $sheet->getCell('E' . $row)->getValue(),
                    'password' => $sheet->getCell('F' . $row)->getValue(),
                    'localite' => intval($request->localite),
                    'reseau' => intval($request->reseau),
                    'entite' => 21,
                ];
            }

            for ($i = 0; $i < count($data); $i++) {
                # code...
                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withOptions(['verify' => false])
                    ->withoutVerifying()
                    ->post($this->apiUrl . "/register/gerant", $data[$i]);
                $startcount++;
            }

            return response((array)$response->object(), 200);
            exit;
            // DB::table('tbl_customer')->insert($data);
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('Erreur survenue lors du chargement du fichier!');
        }
        return back()->withSuccess('fichier chargé  avec  succés.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $create_gerant = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/gerant/" . $id);
        $res  = (array)($create_gerant->object())[0];
        if ($res) {
            $message =  "Gérant créé avec succés";
        } else {
            $message = "Erreur lors de la création du gerant";
        }
        return response($res, 200);
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
        $update_gerant = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put($this->apiUrl . "/gerant/update/" . $id, [
            'profil' => $request->user,
            'reseau' => $request->reseau,
            'localite' => $request->localite,

        ]);
        $res  = $update_gerant->object();
        if ($res) {
            $message =  "Gérant modifié avec succés";
        } else {
            $message = "Erreur lors de la modification du gerant";
        }
        return response(['message' => $message], 200);
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
        $delete_gerant = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->delete($this->apiUrl . "/gerant/delete/" . $id);
        $res  = $delete_gerant->object();
        if ($res) {
            $message =  "Gérant supprimé avec succés";
        } else {
            $message = "Erreur lors de la création du gérant";
        }
        return response(['message' => $message], 200);
    }

    public function dowload_model()
    {
        # code...
        $path = storage_path() . '/file_model/model_gerant.xlsx';
        // Send Download
        return Response::download($path, 'model_gerant.xlsx', [
            'Content-Length: ' . filesize($path)
        ]);
    }
}
