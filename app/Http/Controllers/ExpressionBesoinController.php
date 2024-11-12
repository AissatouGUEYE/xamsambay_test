<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExpressionBesoinController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function index()
    {
        return view('gestion.ferme.expression.index');
    }

    public function validerPresi()

    {
        $prod = array();
        $eb = array();
        # code...
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/ferme_eb/" .$_SESSION['id_entite']);
        $eb = $request->object();
      
        return view('gestion.ferme.expression.liste', compact('eb'));

    }

    public function store(Request $request)
    {

        $filename = null;

        // dd($request->fichier);
        if ($request->fichier) {
            $filename = Storage::disk('public')->put('justificatif_eb', $request->fichier);
        }

        $create_eb = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post(
            $this->apiUrl . "/ferme/eb/create",
            [
                "profil"=>$_SESSION['id'],
                "produit" => $request->produit,
                "description" => $request->intitule,
                "justificatif" => $filename,
            ]
        );

        $res  = $create_eb->object();
        // dd($res->status);
        if ($res->status == 'Expression de besoin enregistrée avec succés') {
            return redirect(route('ferme.eb'));
        }
        // if ($res) {
        //     $message =  "eb ajouté avec succés";
        // } else {
        //     $message = "Erreur lors de l'ajout de l'eb";
        // }
        // return response(['message' => $message], 200);

        //faire le test suivant le statut de la requete
        return redirect(route('ferme.eb'));
    }


    public function edit($id)
    {
        $ebInfos = array();
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => $_SESSION['token']
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/eb/" . $id);

        $ebList = $request->object();
        foreach ($ebList as $entities) {
            # code...
            $ebInfos['id'] = $entities->id;
            $ebInfos['description'] = $entities->description;
            $ebInfos['produit'] = $entities->produit;
            $ebInfos['commentaireP'] = $entities->commentaire_p;
            $ebInfos['commentaireM'] = $entities->commentaire_m;
        }
        return view('gestion.ferme.expression.edit', compact('ebInfos'));
    }

    public function update(Request $request)
    {

        $update_eb = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put(
            $this->apiUrl . "/ferme/eb/update_descripton/" . $request->id,
            [
                "description" => $request->description,
            ]
        );
        // dd($update_eb);

        $res  = $update_eb->object();
        if ($res) {
            $message =  "eb  modifié avec succés";
            return redirect(route('ferme.eb'));
        } else {
            $message = "Erreur lors de la modification de l'eb ";
            return response(['message' => $message], 200);
        }
    }


    public function show($id)
    {
        $ebData = $this->getEbbyId($id);
        // dd($eb);
        $eb = $ebData[0];
        $date = date('d/m/Y', strtotime($eb->created_at));
        $date_m = date('d/m/Y', strtotime($eb->updated_at));
        $res = array('id' => $eb->id, 'produit' => $eb->produit, 'description' => $eb->description, 'date' => $date, 'date_modif' => $date_m);

        return $res;
        // return view('gestion.ferme.expression.view', compact('eb'));
        // return response(['message' =>  $res,]);
    }

    public function getEbbyId($id)
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/ferme/eb/" . $id);
        $ebList = $request->object();
        return $ebList;
    }

    public function updateP(Request $request)
    {

        // print_r($request);
        // exit;
        $update_eb = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put(
            $this->apiUrl . "/ferme/eb/commenter/president/" . $request->id,
            [
                "commentaire_p" => $request->commentaireP,
            ]
        );
        // dd($update_prod);
        $res  = $update_eb->object();
        if ($res) {
            $message =  "commentaire  ajoute avec succés";
            return redirect(route('ferme.eb'));
        } else {
            $message = "Erreur lors de la modification de l'eb ";
            return response(['message' => $message], 200);
        }
    }




    public function updateM(Request $request)
    {

        // print_r($request);
        // exit;
        $update_eb = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put(
            $this->apiUrl . "/ferme/eb/commenter/manager/" . $request->id,
            [
                "commentaire_m" => $request->commentaireM,
            ]
        );
        // dd($update_prod);
        $res  = $update_eb->object();
        if ($res) {
            $message =  "commentaire  ajoute avec succés";
            return redirect(route('ferme.eb'));
        } else {
            $message = "Erreur lors de la modification de l'eb ";
            return response(['message' => $message], 200);
        }
    }
}
