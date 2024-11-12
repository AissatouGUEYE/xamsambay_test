<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    CONST GOOGLE_TYPE = 'google';

    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function handleGoogleRedirect()
    {
        return Socialite::driver(static::GOOGLE_TYPE)->redirect();
    }

    public function handleGoogleCallback()
    {

        try {

            $user = Socialite::driver(static::GOOGLE_TYPE)->user();

            // $userExisted = User::where('google_id', $user->id)->where('oauth_type', static::GOOGLE_TYPE)->first();

            $userExisted = User::where('email', $user->email)->first();

            // return $userExisted;

            if($userExisted)
            {

                $userExisted->update([
                    // 'logo' => $user->avatar,
                    'google_id' => $user->id,
                    'oauth_type' => static::GOOGLE_TYPE,
                ]);

                Auth::login($userExisted);

                return redirect()->route('dashboard');
            }
            else
            {
                // return $user->name;
                $name = $user->name;

                $name = trim($name);
                $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
                $first_name = trim( preg_replace('#'.preg_quote($last_name,'#').'#', '', $name ) );

                $email = $user->email;

                $google_id = $user->id;

                $oauth_type = static::GOOGLE_TYPE;


                $request = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    // ])->withoutVerifying()->get($this->apiUrl . "/gettypent");
                ])->withoutVerifying()->get($this->apiUrl . "/entite");
                $profils = $request->object();


                return view('auth.register-google', compact('first_name', 'last_name', 'email', 'google_id', 'oauth_type', 'profils'));


                // $newUser = User::create([
                //     'prenom' => $first_name,
                //     'nom' => $last_name,
                //     'email' => $user->email,
                //     'google_id' => $user->id,
                //     'oauth_type' => static::GOOGLE_TYPE,
                //     'login' => $user->email,
                //     'sit_matrimonial_id' => 2,
                //     'password' => Hash::make($user->id)

                // ]);

                // if ($newUser->save()) {
                //     // $validator->validated();
                //     $idp = new ProfilModel();
                //     $idp->utilisateur = $newUser->id;
                //     $idp->entite = 5;
                //     $idp->localite = 41684;
                //     $idp->actif = true;
                //     $idp->save();
                // }


                // $response = Http::withHeaders([
                //     'Accept' => 'application/json',
                //     'Content-Type' => 'application/json',
                // ])->withOptions(['verify' => false])
                //     ->withoutVerifying()
                //     ->post($this->apiUrl . "/register", [
                //         'prenom' => $first_name,
                //         'nom' => $last_name,
                //         'email' => 'blablahgtyfc',
                //         'login' => 'blabla',
                //         'password' => Hash::make($user->id),
                //         'localite' => 24633,
                //         'entite' => 5,
                //         'dt_ns' => 'null'

                //     ]);

                // if ($response->successful()) {

                //     Auth::login($response);

                //     return redirect()->route('dashboard');

                // } else {
                //     $message = 'Un compte avec ce mail ou ce numero a ete deja cree veuillez creer un autre compte avec un autre mail ou vous connectez';
                //     return view('auth.register', ['message' => $message]);
                // }


                // Auth::login($newUser);

                // return redirect()->route('dashboard');

            }

        } catch (Exception $e) {

            dd($e);

        }

    }
}
