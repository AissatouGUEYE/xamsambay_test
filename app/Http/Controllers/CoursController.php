<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CoursController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function index()
    {

        // $data = Http::withoutVerifying()->get($this->apiUrl . "/cours", [

        //     'login' => 'administrateur',
        //     'password' => 'Aicheikh_123'

        // ])->json();

        $data = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/cours")->json();

        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {

            return view('gestion.cours.listecoursadmin', compact('data'));
        } else {
            return view('gestion.cours.liste', compact('data'));
        }
    }

    public function getEnrolledStudents($id)
    {

        $data = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/listeEtudiants/" . $id)->json();

        return view('gestion.cours.etudiants', ['etudiants' => $data, 'courseid' => $id]);
    }

    public function desinscrireCours($userid, $courseid)
    {

        Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/desinscrire/" . $userid . "/" . $courseid)->json();

        return redirect('/louma-du-savoir/cours');
    }

    public function sujetsCours($courseid)
    {
        $data = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withToken($_SESSION['token'])->withoutVerifying()->get($this->apiUrl . "/sujetsCours/" . $courseid)->json();


        if ($_SESSION['role'] === "ADMIN" || $_SESSION['role'] === "SUPERADMIN") {

            return view('gestion.cours.sujetscoursadmin', ['sujets' => $data, 'courseid' => $courseid]);
        } else {
            return view('gestion.cours.sujets', ['sujets' => $data, 'courseid' => $courseid]);
        }
    }
}
