{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"  autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                 autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation"  />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}


<!DOCTYPE html>
<!--
Template Name: Materialize - Material Design Admin Template
Author: PixInvent
Website: http://www.pixinvent.com/
Contact: hello@pixinvent.com
Follow: www.twitter.com/pixinvents
Like: www.facebook.com/pixinvents
Purchase: https://themeforest.net/item/materialize-material-design-admin-template/11446068?ref=pixinvent
Renew Support: https://themeforest.net/item/materialize-material-design-admin-template/11446068?ref=pixinvent
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.

-->
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @if (in_array(env('APP_ENV'), ['local', 'test']))
        <meta name="url" content="{{ 'https://api.mlouma.org/api' }}" hidden>
    @elseif(env('APP_ENV') === 'prod')
        <meta name="url" content="{{ 'https://api.mlouma.com/api' }}" hidden>
    @endif
    <meta name="author" content="MLOUMA">
    <title>XAMSAMBAY | V2.0 - Creation de Compte</title>
    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon/apple-touch-icon-152x152.png') }}">
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}"> --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/logo/FAVICO1.ico') }}">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/vendors.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}" type="text/css"> --}}
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2-materialize.css') }}" type="text/css">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/register.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/vendors/materialize-stepper/materialize-stepper.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">

    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/page-users.css')}}"> --}}


    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/login.css') }}">
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<body
    class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column login-bg blank-page blank-page"
    data-open="click" data-menu="vertical-modern-menu" data-col="1-column">

    <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="row">
                    <div class="col s12 mt-2 mb-1" style="display: flex; justify-content: center;">
                        <a href="{{ url('/') }}"><img src="{{ asset('assets/images/logo/Logo_mlouma_v2.png') }}"
                                alt="" height="90"></a>
                    </div>
                </div>
                <div id="register-page" class="row">
                    <div class="col s12 m9 l9 z-depth-4 card-panel border-radius-6 register-card bg-opacity-8">
                        <div class="row">
                            <div class="col s12">
                                <form class="login-form" method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="input-field col s12 " style="margin-bottom: 0">
                                            <h5 style="text-align:center" class="ml-4">Inscription</h5>
                                        </div>
                                    </div>

                                    <input id="password" name="password" value="null" hidden>
                                   <input id="password1" name="password1" value="null" hidden>
                                    <input id="login" name="login" value="{{ $email }}" hidden>
                                    <input id="google_id" name="google_id" value="{{ $google_id }}" hidden>
                                    <input id="oauth_type" name="oauth_type" value="{{ $oauth_type }}" hidden>

                                    <div class="row margin">
                                        <div class="input-field col s6">
                                            <i class="material-icons prefix pt-1">person_outline</i>
                                            <input id="username1" type="text" name="username1"
                                                value="{{ $first_name }}" required autofocus>
                                            <label for="username1" :value="__('username1')" class="center-align">Prénom
                                                <span>*</span></label>
                                            @isset($_GET['path'])
                                                @if ($_GET['path'] != 'dashboard')
                                                    <input hidden id="paths" type="text" name="paths"
                                                        value="{{ $_GET['path'] }}" autofocus>
                                                @endif
                                            @endisset
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="username2" type="text" name="username2"
                                                value="{{ $last_name }}" required autofocus>
                                            <label for="username2" :value="__('username2')" class="center-align">Nom
                                                <span>*</span></label>
                                        </div>
                                    </div>
                                    

                                    {{-- <div class="row margin newEntite">
                                        <div class="col s3"></div>
                                        <div class="input-field col s6">
                                            <i class="material-icons prefix pt-1">E</i>
                                            <input id="entite" type="text" name="entite" required autofocus>
                                            <label for="entite" :value="__('entite')" class="center-align">Nouveau
                                                Entite
                                                <span>*</span></label>
                                        </div>
                                        <div class="col s3"></div>
                                    </div> --}}

                                    <div class="row margin">

                                        <div class="input-field col s6">
                                            <i class="material-icons prefix pt-1">email</i>
                                            <input id="email" type="email" name="email" required autofocus value="{{ $email }}">
                                            <label for="email" :value="__('email')" class="center-align">Email
                                                <span>*</span></label>
                                        </div>

                                        <div class="input-field col s6">
                                            <i class="material-icons prefix pt-1">contact_phone</i>
                                            <input id="telephone" type="tel" name="telephone" required autofocus>
                                            <label for="telephone" :value="__('telephone')"
                                                class="center-align">Numéro téléphone
                                                <span>*</span></label>
                                        </div>
                                    </div>

                                    <div class="row margin">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix pt-1">work</i>
                                            {{-- <input id="fonction" type="text" name="fonction" required autofocus> --}}
                                            <label for="fonction"></label>
                                            <select name="fonction" id="fonction" required>
                                                <option value="" disabled selected>Choisir une fonction
                                                    <span>*</span>
                                                </option>
                                                @isset($profils)
                                                    @foreach ($profils as $profil)
                                                        @if ($profil->status == true)
                                                            <option value="{{ $profil->id_entite }}">
                                                                {{ $profil->nom_entite }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $profil->id_entite }}" disabled>
                                                                {{ $profil->nom_entite }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                @endisset
                                                {{-- <option value="Autres">Autres</option> --}}
                                            </select>
                                        </div>

                                        
                                        {{-- <div class="col s5 ong-div pt-1">
                                            <select name="ong-select" id="ong-select">
                                            </select>
                                        </div> --}}

                                    </div>

                                    {{-- <div class="row margin">

                                        <div class="input-field col s12">
                                            <i class="material-icons prefix pt-1">input</i>
                                            <input id="username" type="text" name="login" required autofocus>
                                            <label for="username" :value="__('login')" class="center-align">Login
                                                <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="row margin">
                                        <div class="input-field col s6">
                                            <i class="material-icons prefix pt-1">lock_outline</i>
                                            <input id="password" type="password" name="password" required
                                                autocomplete="current-password">
                                            <label for="password" :value="__('Password')">Mot de passe</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <i class="material-icons prefix pt-1">lock_outline</i>
                                            <input id="password1" type="password" name="password1" required
                                                autocomplete="current-password">
                                            <label for="password1" :value="__('Password')">Confirmer Mot de
                                                passe</label>
                                        </div>
                                    </div> --}}

                                    @isset($message)
                                        <div class="row margin">
                                            <p
                                                style="padding:2px;text-align: center; background-color:rgba(255, 0, 0, 0.158); color:black">
                                                {{ $message }}
                                            </p>
                                        </div>
                                    @endisset

                                    <div class="row margin">
                                        <div class="input-field col s12">
                                            <button class="btn border-round col s12"
                                                style="background-color:#b07e4a !important">
                                                Creer Compte</button>

                                            {{-- <button class="btn border-round col s12 black" id="loginWithGoogle"
                                                >
                                                Utiliser votre compte Google</button>

                                            <p class="pt-1" style="text-align: center;"><a style="color:#C99F68"
                                                    href="{{ route('login') }}">Se
                                                    Connecter</a></p> --}}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('assets/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/select2.full.min.js') }}"></script>

    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{ asset('assets/vendors/materialize-stepper/materialize-stepper.min.js') }}"></script>
    {{-- <script src="{{ asset('assets\js\providers\location.js') }}"></script> --}}
    {{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}

    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/search.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/form-wizard.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>


    <script>
        $(document).ready(function() {
            // console.log('work')
            let root = $('meta[name="url"]').attr("content");
            $('#ong-select').hide();
            $('.newEntite').hide();
            // $('.ong').hide();
            $('.ong-div').hide();
            $('#fonction').change(() => {
                $('.newEntite').hide();
                $('#ong-div').hide();

                var profil = $('#fonction').val();
                var urlEntity = root + "/entitetype/" + profil;
                $('#ong-select').empty();

                $.ajax({
                    url: urlEntity,
                    method: 'GET',
                    headers: {},
                    dataType: 'JSON',
                    success: (res) => {
                        if (res.length > 1) {

                            var selectContent = '';
                            var selectOpt = '';

                            for (let index = 0; index < res.length; index++) {
                                // console.log(res[index].id_entite);
                                // console.log(res[index].nom_entite);

                                opt = '<option value ="' + res[index].id_entite + '" >' +
                                    res[index].nom_entite +
                                    '</option>';
                                selectOpt += opt;

                            }

                            var selectContent =
                                '<option value="Select" disabled selected>Preciser l\'entite <span class="red-text">*</span></option>' +
                                selectOpt + '<option value="Autres">Autres</option>';
                            // alert(selectContent);

                            $('#ong-select').append(selectContent);
                            $('#ong-select').show();
                            $('.ong-div').show();
                            // $('.ong').show();

                        } else {
                            $('.ong-div').hide();
                            // alert('sheet');
                            // console.log(res);
                        }

                    },
                    error: () => {
                        alert('sheet error ')
                    }
                });


            });
            $('#ong-select').change(() => {
                var autreOption = $('#ong-select').val();
                if (autreOption == 'Autres') {
                    $('.newEntite').show();
                } else {
                    $('.newEntite').hide();
                }
            });


            $('#loginWithGoogle').click(function(e) {

                window.location.href = 'auth/google/redirect'

            });

        });
    </script>
    {{-- <script src="{{asset('assets/js/scripts/form-elements.js')}}"></script> --}}

    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->




    <script>
        // $(".ong").empty();
        // var select = $('#ong-select').serialize();
        // var select = $('.ong').serialize();



        // var option = $('option').serialize();
        // option.append(res[index].nom_entite).attr(
        //     'value', res[
        //         index].id_entite);
        // console.log(option);
        // select.append(option);


        // '<div class="input-field col s12">' +
        // '<i class="material-icons prefix pt-1">work</i>' +
        // '<label for="ong-select" class="center-align"></label>' +
        // '<select name="ong-select" id="ong-select" autofocus><option value="">Preciser Entite</option>' +
        // selectOpt;
        // '</select>' + '</div>';
        // selectContent += selectOpt;
        // selectContent += '</select>' + '</div>';
        // $('#ong-select').remove();
    </script>
</body>

</html>
