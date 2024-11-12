<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }

    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.forgot-password');
    }
    public function renouveau()
    {
        return view('auth.renouveller-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }

    public function reset(Request $request)
    {
        // dd($request);
        $numero = $request->telephone;
        // https://api.mlouma.org/api/sms/password

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->post($this->apiUrl . "/sms/password", ['telephone' => $numero]);
        if ($response->successful()) {
            $data = $response->object();
            return view('auth.confirm-reset', ['response' => $data]);
        }
        if ($response->status() == 403) {
            return view('auth.forgot-password', ['message' => 'Ce numero ne figure pas dans la base']);
        }
    }

    public function resetPassword(Request $request)
    {
        // dd($request);
        $codes = $request->codes;
        $code = $request->code;
        $idProfil = $request->idProfil;
        $mdp = $request->password;
        $mdp1 = $request->password1;
        $resp['code'] = $codes;
        $resp['utilisateur'] = $idProfil;
        $resp['token'] = $request->token;
        $data = (object) $resp;

        #tester si le code entrer est valide 
        if ("M-" . $code === $codes) {
            #Si oui 
            ## Verifier si les mots de passes sont les memes
            if ($mdp1 === $mdp) {
                ## Si oui 
                ###Enregistrer le nouveau mot de passe
                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->withToken($request->token)
                    ->withoutVerifying()
                    ->put($this->apiUrl . "/passedit/" . $idProfil, ['password' => $mdp]);
                ###Rediriger a la page de connexion
                if ($response->successful()) {
                    // return redirect(RouteServiceProvider::HOME, ['message' => 'Mot de passe renouvelé! Veuillez vous reconnecter']);
                    // return redirect('login')->with('message', 'Mot de passe renouvelé! Veuillez vous reconnecter');
                    $res = array('msg' => 'Mot de passe renouvelé! Veuillez vous reconnecter', 'status' => 200);
                    session(['message' => 'Mot de passe renouvelé! Veuillez vous reconnecter']);
                    return response()->json($res);
                }
            } else {
                ##Si non 
                ### faire un retour vers la page avec le message Mot de passes Non identique
                //return view('auth.confirm-reset', ['response' => $data, 'message' => 'Les mots de passe saisis ne sont pas les memes']);
                $res = array('msg' => 'Les mots de passe saisis ne sont pas les memes', 'status' => 401);
                return response()->json($res);
            }
        } else {
            #Si non
            ##faire un retour vers la page avec le message de code Incorrect
            // return view('auth.confirm-reset', ['response' => $data, 'message' => 'Le code entré est invalide']);
            $res = array('msg' => 'Le code entré est invalide', 'status' => 401);
            return response()->json($res);
        }
    }
}
