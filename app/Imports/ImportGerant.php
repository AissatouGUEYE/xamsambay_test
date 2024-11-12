<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Http;
class ImportGerant implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //

        foreach ($collection as $row)
        {
            if (!empty($row['prenom'])&& !empty($row['nom'])&&!empty($row['telephone'])&&!empty($row['login'])&&!empty($row['password'])) {
                # code...

            // $response = Http::withHeaders([
            //     'Accept' => 'application/json',
            //     'Content-Type' => 'application/json',
            // ])->withOptions(['verify' => false])
            //     ->withoutVerifying()
            //     ->post("https://api.mlouma.org/api/register/create", [
            //         'prenom' => $row['prenom'],
            //         'nom' => $row['nom'],
            //         'email' => !empty($row['email'])?$row['email']:null,
            //         'telephone' => $row['telephone'],
            //         'login' => $row['login'],
            //         'password' => $row['password'],
            //         'localite' => null,
            //         'entite' => 21,

            //     ]);
            print_r( ['prenom' => $row['prenom'],
                    'nom' => $row['nom'],
                    'email' => !empty($row['email'])?$row['email']:null,
                    'telephone' => $row['telephone'],
                    'login' => $row['login'],
                    'password' => $row['password'],
                    'localite' => null,
                    'entite' => 21,

            ]);
                    // print_r($collection);
                // return $response;
            }
        }
    }
}
