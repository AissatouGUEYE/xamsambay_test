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

class FacebookController extends Controller
{
    CONST DRIVER_TYPE = 'facebook';

    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    public function handleFacebookRedirect()
    {
        return Socialite::driver(static::DRIVER_TYPE)->redirect();
    }

    public function handleFacebookCallback()
    {

        try {

            $user = Socialite::driver(static::DRIVER_TYPE)->user();

            // dd($user);

            // $userExisted = User::where('facebook_id', $user->id)->where('oauth_type', static::DRIVER_TYPE)->first();

            // if ($user->email != null && $user->email != 'null') {

            //     $userExisted = User::where('email', $user->email)->first();

            // }
            if ($user->id != null) {

                $userExisted = User::where('facebook_id', $user->id)->first();

            }
            else {
                $userExisted = null;
            }

            // $userExisted = User::where('email', $user->email)->first();

            // return $userExisted;

            if($userExisted)
            {

                // $userExisted->update([
                //     'facebook_id' => $user->id,
                //     'oauth_type' => static::DRIVER_TYPE,
                // ]);

                Auth::login($userExisted);

                return redirect()->route('dashboard');
            }
            else
            {
                // return 'Le compte n\'existe pas dans la base';
                $name = $user->name;

                $name = trim($name);
                $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
                $first_name = trim( preg_replace('#'.preg_quote($last_name,'#').'#', '', $name ) );

                $email = $user->email;

                $facebook_id = $user->id;

                $oauth_type = static::DRIVER_TYPE;


                $request = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withoutVerifying()->get($this->apiUrl . "/entite");
                $profils = $request->object();


                return view('auth.register-facebook', compact('first_name', 'last_name', 'email', 'facebook_id', 'oauth_type', 'profils'));


            }

        } catch (Exception $e) {

            dd($e);

        }

    }
}
