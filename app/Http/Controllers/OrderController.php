<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function index()
    {
        $orders = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/vente")->json();

        // return $orders;

        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {
            return view('gestion.commandes.liste', compact('orders'));
        }
    }

    public function listOrderProducts($id)
    {
        $data = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/commande/all/showbyid/" . $id)->json();

        return view('gestion.commandes.listOrderProducts', ['products' => $data]);
    }

    public function commanderProduit($id)
    {
        $data = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/produits/" . $id, [

            'login' => 'agueye',
            'password' => '0WJgW^qcSLn88&^0Vv2mm*8x'

        ])->json();

        return view('gestion.produits.commanderProduit', ['product' => $data]);
    }

    public function enregistrerCommande(Request $request)
    {
        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->post($this->apiUrl . "/enregistrerCommande", [

            'login' => $request->login,
            'password' => $request->password,
            'customer_id' => $request->idcustomer,
            'line_items' => $request->line_items,
            'payment_method' => $request->payment_method,
            'billing' => $request->billing,
            'shipping' => $request->shipping

        ]);

        return redirect('/louma-mbay/commandes');
    }

    public function updateCommande(Request $request)
    {
        $id = $request->id;

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->put($this->apiUrl . "/updateCommande/" . $id, [

            'login' => $request->login,
            'password' => $request->password,
            'customer_id' => $request->idcustomer,
            'line_items' => $request->line_items,
            'payment_method' => $request->payment_method,
            'billing' => $request->billing,
            'shipping' => $request->shipping

        ]);
        return redirect('/louma-mbay/commandes');
    }


    public function modifierCommande($id)
    {
        $data = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/commandes/" . $id, [

            'login' => 'agueye',
            'password' => '0WJgW^qcSLn88&^0Vv2mm*8x'

        ])->json();

        return view('gestion.commandes.modifierCommande', ['commande' => $data]);
    }

    public function supprimerCommande($id)
    {
        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->delete($this->apiUrl . "/supprimerCommande/" . $id, [

            'login' => 'agueye',
            'password' => '0WJgW^qcSLn88&^0Vv2mm*8x'

        ]);
        return redirect('/louma-mbay/commandes');
    }
}
