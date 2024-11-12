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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @if (in_array(env('APP_ENV'), ['local', 'test']))
        <meta name="url" content="{{ 'https://api.mlouma.org/api' }}" hidden>
    @elseif(env('APP_ENV') === 'prod')
        <meta name="url" content="{{ 'https://api.mlouma.com/api' }}" hidden>
    @endif
    <meta name="author" content="MLOUMA">
    <title>XAMSAMBAY | V2.0 - Connection</title>
    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon/apple-touch-icon-152x152.png') }}">
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/favicon/favicon-32x32.png')}}"> --}}
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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/login.css') }}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom/custom.css') }}">
    <!-- END: Custom CSS-->

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- Font Awesome --}}


    

</head>
<!-- END: Head-->
{{-- @isset($_SESSION['message']) --}}
@php
// dd($_SESSION['message']);
if (
    request()
        ->session()
        ->exists('message')
) {
    $message = request()
        ->session()
        ->pull('message', '');
    request()
        ->session()
        ->forget('message');
}
// dd($message);
@endphp
{{-- @endisset --}}

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

                <div id="login-page" class="row">
                    <div class="col s12 m8 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
                        <form class="login-form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="input-field col s12 ">
                                    <h5 style="text-align:center" class="ml-4">Connexion</h5>
                                </div>
                            </div>

                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">person_outline</i>
                                    <input id="username" type="text" name="login" :value="old('login')" required
                                        autofocus>
                                    <label for="username" :value="__('login')" class="center-align">Nom d'utilisateur,
                                        Email ou Téléphone</label>
                                </div>
                                @isset($message)
                                    @if ($message != '')
                                        <input hidden id="messages" type="text" name="messages"
                                            value="{{ $message }}" autofocus>
                                    @endif
                                @endisset
                                @isset($_GET['path'])
                                    @if ($_GET['path'] != 'dashboard')
                                        <input hidden id="paths" type="text" name="paths"
                                            value="{{ $_GET['path'] }}" autofocus>
                                    @endif
                                @endisset
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">lock_outline</i>
                                    <input id="password" type="password" name="password" required
                                        autocomplete="current-password">
                                    <label for="password" :value="__('Password')">Mot de passe</label>
                                </div>
                            </div>

                            

                            <div class="row">
                                <div class="col s12 m12 l12 ml-2 mt-1">
                                    <p>
                                        <label>
                                            <input type="checkbox" />
                                            {{-- <span>{{ __('Remember me') }}</span> --}}
                                            <span>Se rappeler de moi</span>

                                        </label>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    {{-- <button  class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12"> {{ __('Log in') }}</button> --}}
                                    <button class="btn waves-effect waves-light border-round green col s12"
                                        id="submit" onclick="validate()">Se Connecter</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6 m6 l6">
                                    @isset($_GET['path'])
                                        @if ($_GET['path'] != 'dashboard' || $_GET['path'] != '')
                                            <p class="margin medium-small"><a
                                                    href="{{ route('register', ['path' => $_GET['path']]) }}"
                                                    style="color:#C99F68">S'inscrire</a></p>
                                        @else
                                            <p class="margin medium-small"><a href="{{ route('register') }}"
                                                    style="color:#C99F68">S'inscrire</a></p>
                                        @endif
                                    @else
                                        <p class="margin medium-small"><a href="{{ route('register') }}"
                                                style="color:#C99F68">S'inscrire</a></p>
                                    @endisset
                                </div>
                                <div class="input-field col s6 m6 l6">
                                    @if (Route::has('password.request'))
                                        {{-- <p class="margin right-align medium-small"><a href="{{ route('password.request') }}"> {{ __('Forgot your password?') }}</a></p> --}}
                                        <p class="margin right-align medium-small"><a
                                                href="{{ route('password.request') }}" style="color:#C99F68">Mot de
                                                passe oublié ?</a></p>
                                    @endif
                                </div>
                            </div>
                        </form>

                        <div class="row">
                                {{-- <a href="" class="btn btn-facebook btn-user btn-block">
                                    <i class="material-icons">group</i> Login with Facebook
                                </a>
                                <a href="" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Login with Google
                                </a> --}}
                                
                            
                            <div class="input-field col s12">
                                
                                <button class="btn waves-effect waves-light border-round white col s12 " id="loginWithGoogle" style="color:#000000 " type="button">
                                    <i class="fa fa-google" 
                                        style="background: conic-gradient(from -45deg, #ea4335 110deg, #4285f4 90deg 180deg, #34a853 180deg 270deg, #fbbc05 270deg) 73% 55%/150% 150% no-repeat;
                                                -webkit-background-clip: text;
                                                background-clip: text;
                                                color: transparent;
                                                -webkit-text-fill-color: transparent;">
                                    </i>
                                    Se Connecter avec Google
                                </button>

                            </div>
                            <div class="input-field col s12">
                                <button class="btn waves-effect waves-light border-round blue col s12 " id="loginWithFacebook" >
                                    <i class="fa fa-facebook-square"></i>
                                    Se Connecter avec Facebook
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{-- <div class="content-overlay"></div> --}}
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
    <script src="{{ asset('assets/vendors/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
    <script>
        $(document).ready(function() {
            // $(function() {

            // function validate() {
            //     var username = document.getElementById("username").value;
            //     var password = document.getElementById("password").value;

            //     '<%Session["username"] = "' + username + '"; %>';
            //     '<%Session["password"] = "' + password + '"; %>';
            //     // Session.set('username', username);
            //     // Session.set('password', password);
            //     // alert ("Login successfully");
            // }

            let sms = $('#messages').val();
            // console.log(sms);
            if (sms != null) {
                swal({
                    title: 'Success',
                    icon: 'success',
                    text: sms,
                    timer: 5000,
                    buttons: false
                });
                // location.reload();

            }


            $('#loginWithGoogle').click(function(e) {

                window.location.href = 'auth/google/redirect'

            });


            $('#loginWithFacebook').click(function(e) {

                window.location.href = 'auth/facebook/redirect'

            });
            // $(function() {

            // function loginWithGoogle() {
                
            //     window.location.href = 'auth/google/redirect'
                
            // }
            // });

            

        });
    </script>

    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
</body>

</html>
