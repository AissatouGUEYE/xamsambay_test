{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Xamsambay, une plateforme de Mlouma qui vous propose des services étudiés et optimisés pour répondre aux besoins spécifiques des acteurs de la chaine de valeurs!">
    <meta name="keywords"
        content="mlouma, xamsambay, louma mbay, meteombay, prix du marche">
    <meta name="author" content="ThemeSelect">
    <title>Mot de Passe oublie | CRM - XAMSAMBAY </title>
    {{-- <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon/apple-touch-icon-152x152.png') }}"> --}}
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}"> --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/logo/FAVICO1.ico') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/vendors.min.css') }}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/forgot.css') }}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/login.css') }}">

    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<body
    class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column login-bg   blank-page blank-page"
    data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="row">
                    <div class="col s12 mt-2" style="display: flex; justify-content: center;">
                        <a href="{{ url('/') }}"><img src="{{ asset('assets/images/logo/Logo_mlouma_v2.png') }}"
                                alt="" height="90"></a>
                    </div>
                </div>
                <div id="forgot-password" class="row">
                    <div class="col s12 m6 l4 z-depth-4 offset-m4 card-panel border-radius-6 forgot-card bg-opacity-8">
                        <form class="login-form" method="POST" action="{{ route('password.numero') }}">
                            @csrf
                            <div class="row">
                                <div class="input-field col s12">
                                    <h5 style="text-align:center" class="ml-4">Renouvellement mot de passe</h5>
                                    <p class="ml-4">{{ session('status') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                {{-- {{ $errors}} --}}
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">person_outline</i>
                                    <input id="telephone" type="tel" name="telephone" :value="old('telephone')"
                                        required autofocus>
                                    <label for="telephone" class="center-align">Numéro de Téléphone</label>
                                    {{-- <input id="email" type="email" id="email" name="email"
                                        :value="old('email')" required autofocus>
                                    <label for="email" class="center-align">Email</label> --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s4"></div>
                                <div class="input-field col s3">
                                    <button type="submit" class="btn border-round"
                                        style="background-color:#4ab058 !important; display: flex;align-items: center;">
                                        Valider</button>
                                    {{-- <button  class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12 mb-1"> {{ __('Email Password Reset Link') }}</button> --}}
                                    {{-- <button
                                  class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12 mb-1">{{ 'Envoyer le mail de reinitialisation' }}</button> --}}

                                </div>
                                <div class="col s5"></div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6 m6 l6">
                                    <p class="margin medium-small"><a href="{{ route('login') }}"
                                            style="color:#b07e4a !important">Se Connecter</a></p>
                                </div>
                            </div>
                            <div class="container">
                                @isset($message)
                                    <p
                                        style="height: 50px;border-radius:50px;background-color:rgb(215, 163, 163);padding:10px; margin:10px;color:white;text-align:center">
                                        {{ $message }}</p>
                                @endisset
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="content-overlay"></div>
        </div>
    </div>

    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('assets/js/vendors.min.js') }}"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/search.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
</body>

</html>
