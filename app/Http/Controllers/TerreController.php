<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class TerreController extends Controller
{
    //
    protected $apiUrl ;

    public function __construct() {
        $this->apiUrl = config("app.api_url");
    }

    public function new_producteur_terre(Request $request)
    {
        // dd($request->input());
        if ($request) {
            # code...
            $url = $this->apiUrl."/sols/create";

            $data = [
                "profil" => $request->input("profil"),
                "type_sol" => $request->input("type_sol"),
                "surface" => $request->input("surface"),
                "unite" => 10,
                "latitude" => $request->input("lat"),
                "longitude" => $request->input("lon")
            ];
            // dd($data);
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])
                ->withOptions(['verify' => false])
                ->withoutVerifying()
                ->post($url,$data)->status();
            if ($response == 200) {
                # code...
                $message = "Declaration enregistre avec succes";

            } else {

                $message = "Erreur lors de l'enregistrement";

            }

        } else {
            $message = "Erreur lors de l'enregistrement";


        }
        # code...
        return response(["message" =>$message],200);



    }

    public function get_producteur_terre($id)
    {
        # code...
        $url = $this->apiUrl."/sols/profil/".$id;
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->get($url)->object();
        // dd($response);
        return response(["data" => $response],200);

    }

    public function get_terre_to_edit($id){
        $url = $this->apiUrl."/sols/".$id;
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->get($url)->object();

        return response()->json($response[0], 200) ;
    }

    public function update_terre(Request $request, $id){
        if ($request) {
            # code...
            $url = $this->apiUrl."/sols/update/".$id;

            $data = [
                // "profil" => $request->input("profil"),
                "type_sol" => $request->input("type_sol"),
                "surface" => $request->input("surface"),
                // "unite" => 10,
                // "latitude" => $request->input("lat"),
                // "longitude" => $request->input("lon")
            ];
            // dd($data);
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withToken($_SESSION['token'])
                ->withOptions(['verify' => false])
                ->withoutVerifying()
                ->put($url, $data)->object();
                dd($response);

            if ($response == 200) {
                # code...
                $message = "Declaration enregistre avec succes";

            } else {
                $message = "Erreur lors de l'enregistrement 1";

            }

        } else {
            $message = "Erreur lors de l'enregistrement 2";


        }
        # code...
        return response(["message" =>$message], 200);
    }

    public function delete_terre($id){
        $url = $this->apiUrl."/sols/delete/".$id;
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])
            ->withOptions(['verify' => false])
            ->withoutVerifying()
            ->delete($url)->status();
            if ($response == 200) {
                # code...
                $message = "Déclaration supprimé avec succés";

            } else {
                $message = "Erreur lors de l'enregistrement 1";

            }

        return response()->json($message, 200) ;
    }
}
