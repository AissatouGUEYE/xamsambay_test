<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class TransversalController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request) {
            # code...
           for ($i=0; $i < count($request->pluvio); $i++) {
            # code...


            $create_transversal = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])->withoutVerifying()->post(
                $this->apiUrl . "/transversal/create",
                [
                    "profil" => $request->profil,
                    "pluvio" => $request->pluvio[$i],
                ]
            );
           }

           $res  = $create_transversal->object();
           if ($res) {
               $message =  "Transversal ajouté avec succés";
           } else {
               $message = "Erreur lors de l'ajout  du transversal";
           }
           return response(['message' => $message], 200);

        }



    }
    public function store_list(Request $request)
    {
        # code...

        $this->validate($request, [
            'tlist' => 'required|file|mimes:xls,xlsx'
        ]);
        $the_file = $request->file('tlist');
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
                    'pluvio' => intval($request->pluvio),
                    'entite' => 22,
                ];
            }

            for ($i = 0; $i < count($data); $i++) {
                # code...
                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withOptions(['verify' => false])
                    ->withoutVerifying()
                    ->post($this->apiUrl . "/register/transversal", $data[$i]);
                $startcount++;
            }

            return response((array)$response->object(), 200);
            exit;
            // DB::table('tbl_customer')->insert($data);
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
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
        $pluvio_to_edit = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/transversal/" . $id);
        $res  = (array)($pluvio_to_edit->object())[0];
        if ($res) {
            $message =  "Pluvio créé avec succés";
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
        ])->withToken($_SESSION['token'])->withoutVerifying()->put($this->apiUrl . "/transversal/update/" . $id, [
            'profil' => $request->profil,
            'pluvio' => $request->pluvio,
            // 'localite' =>$request->localite,
        ]);
        $res  = $update_gerant->object();
        if ($res) {
            $message =  "Transversal modifié avec succés";
        } else {
            $message = "Erreur lors de la modification du pluvio";
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
        ])->withToken($_SESSION['token'])->withoutVerifying()->delete($this->apiUrl . "/transversal/delete/" . $id);
        $res  = $delete_gerant->object();
        if ($res) {
            $message =  "Transversal supprimé avec succés";
        } else {
            $message = "Erreur lors de la suppression du transversal";
        }
        return response(['message' => $message], 200);
    }
}
