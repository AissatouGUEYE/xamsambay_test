<!DOCTYPE html>

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
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/logo/FAVICO1.ico') }}">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/vendors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2-materialize.css') }}" type="text/css">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/css/themes/vertical-modern-menu-template/style2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/register.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/materialize-stepper/materialize-stepper.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">

    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/login.css') }}">
    <!-- END: Custom CSS-->


    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- Font Awesome --}}

</head>
<!-- END: Head-->

@php
    $key = Crypt::encryptString('path');
@endphp

<body
    class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column login-bg blank-page blank-page"
    data-open="click" data-menu="vertical-modern-menu" data-col="1-column" style="height: auto">

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
                                <div class="row margin">
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix pt-1">person_outline</i>
                                        <input id="username1" type="text" name="username1"
                                               :value="old('username1')" required autofocus>
                                        <label for="username1" :value="__('username1')" class="center-align">Prénom
                                            <span>*</span></label>
                                        @isset($_GET[$key])
                                            @if (Crypt::decryptString($_GET[$key]) != 'dashboard')
                                                <input hidden id="paths" type="text" name="paths"
                                                       value="{{ $_GET[$key] }}" autofocus>
                                            @endif
                                        @endisset
                                    </div>
                                    <div class="input-field col s6">
                                        {{-- <i class="material-icons prefix pt-2">person_outline</i> --}}
                                        <input id="username2" type="text" name="username2"
                                               :value="old('username2')" required autofocus>
                                        <label for="username2" :value="__('username2')" class="center-align">Nom
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

                                <div class="row margin">

                                    <div class="input-field col s6">
                                        <i class="material-icons prefix pt-1">email</i>
                                        <input id="email" type="email" name="email" required autofocus>
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
                                </div>

                                @isset($message)
                                    <div class="row margin">
                                        <p
                                            style="padding:2px;text-align: center; background-color:rgba(255, 0, 0, 0.158); color:black">
                                            {{ $message }}
                                        </p>
                                    </div>
                                @endisset

                                <div class="row">
                                    <div class="input-field col s12 ml-4 mb-6">
                                        <label>
                                            <input id="conditions" type="checkbox"/>
                                            <span class="mr-3"
                                                  style="font-size:14px; font-style: italic; color:saddlebrown;text-align: center">
                                                En cochant sur ce boutton vous acceptez les
                                                <a href="{{route('cgu')}}" target="_blank" style="color: #0a6aa1">
                                                    Conditions Generales d'Utilisation
                                                </a>
                                                et les
                                                <a href="{{route('cp')}}" target="_blank" style="color: #0a6aa1">
                                                    Politiques de Confidentialites
                                                </a>
                                                de Xam Sa Mbay
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <br><br>

                                <div class="row margin mt-2">
                                    <div class="input-field col s12">
                                        <button id="registerButton" class="btn border-round col s12"
                                                style="background-color:#b07e4a !important">
                                            Creer Compte
                                        </button>

                                        <br><br>

                                        <button class="btn border-round col s12 white" id="loginWithGoogle"
                                                style="color:#000000">
                                            <i class="fa fa-google"
                                               style="background: conic-gradient(from -45deg, #ea4335 110deg, #4285f4 90deg 180deg, #34a853 180deg 270deg, #fbbc05 270deg) 73% 55%/150% 150% no-repeat;
                                                            -webkit-background-clip: text;
                                                            background-clip: text;
                                                            color: transparent;
                                                            -webkit-text-fill-color: transparent;">
                                            </i>
                                            Utiliser votre compte Google
                                        </button>

                                        <br><br>

                                        <button class="btn border-round col s12 blue" id="loginWithFacebook">
                                            <i class="fa fa-facebook-square"></i>
                                            Utiliser votre compte Facebook
                                        </button>
                                        <br><br>
                                        <div style="text-align:center">

                                            <a style="color:#C99F68 "
                                               href="{{ route('login') }}">Se
                                                Connecter</a>
                                        </div>
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
    $(document).ready(function () {
        // console.log('work')
        let root = $('meta[name="url"]').attr("content");
        $('#ong-select').hide();
        $('.newEntite').hide();
        $('#registerButton').attr("disabled", true);
        $('#loginWithFacebook').attr("disabled", true);
        $('#loginWithGoogle').attr("disabled", true);
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


        $('#loginWithGoogle').click(function (e) {

            window.location.href = 'auth/google/redirect'

        });

        $('#loginWithFacebook').click(function (e) {

            window.location.href = 'auth/facebook/redirect'

        });

        $('#conditions').change(() => {

            $('#registerButton').attr("disabled", true);
            $('#loginWithFacebook').attr("disabled", true);
            $('#loginWithGoogle').attr("disabled", true);

            if ($('#conditions').is(':checked')) {
                $('#registerButton').removeAttr("disabled");
                $('#loginWithFacebook').removeAttr("disabled");
                $('#loginWithGoogle').removeAttr("disabled");
            }

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
