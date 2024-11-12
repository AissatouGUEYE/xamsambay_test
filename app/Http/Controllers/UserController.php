<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function index()
    {
        $data = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/utilisateurs", [

            'login' => 'agueye',
            'password' => '0WJgW^qcSLn88&^0Vv2mm*8x'

        ])->json();

        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {

            return view('gestion.wordpress.utilisateurs.liste', ['data' => $data]);
        }
    }

    public function edit($id)
    {
        $data = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/utilisateurs/" . $id, [

            'login' => 'agueye',
            'password' => '0WJgW^qcSLn88&^0Vv2mm*8x'

        ]);

        return view('gestion.wordpress.utilisateurs.edit', ['user' => $data]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put($this->apiUrl . "/utilisateurs/updateUtilisateur/" . $id, [

            'login' => $request->login,
            'password' => $request->password,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'pwd' => $request->pwd,
            'email' => $request->email,
            'roles' => $request->roles

        ]);
        return redirect('/louma-mbay/utilisateurs');
    }


    public function delete($id)
    {
        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->delete($this->apiUrl . "/supprimerUtilisateur/" . $id, [

            'login' => 'agueye',
            'password' => '0WJgW^qcSLn88&^0Vv2mm*8x'

        ]);
        return redirect('/louma-mbay/utilisateurs');
    }

    public function create()
    {
        return view('gestion.wordpress.utilisateurs.create');
    }

    public  function enregistrer(Request $request)
    {
        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post($this->apiUrl . "/enregistrerUtilisateur", [

            'login' => $request->login,
            'password' => $request->password,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'username' => $request->username,
            'pwd' => $request->pwd,
            'roles' => $request->roles

        ]);
        return redirect('/louma-mbay/utilisateurs');
    }

    // public static function fetch()
    // {
    //     return User::all();
    // }\
}
