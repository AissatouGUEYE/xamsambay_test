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
    <title>User Register | Materialize - Material Design Admin Template</title>
    {{-- <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon/apple-touch-icon-152x152.png') }}"> --}}
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
                <div id="register-page" class="row">
                    <div class="col s12 m8 l8 z-depth-4 card-panel border-radius-6 register-card bg-opacity-8">
                        <div class="row">
                            <div class="col s12">
                                <form id="login_form" class="login-form" method="POST"
                                    action="{{ route('password.numero.reset') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="input-field col s12 " style="margin-bottom: 0">
                                            <h5 class="text-center" style="text-align:center">Veuillez saisir le
                                                code transmis par message </h5>
                                        </div>
                                    </div>
                                    <div class="row margin">
                                        <div class="input-field col s4">
                                        </div>
                                        <div class="input-field col s4">
                                            <i class="material-icons prefix pt-1">M-</i>
                                            <input id="code" type="text" name="code" :value="old('code')"
                                                required autofocus>
                                            <label for="code" :value="__('code')" class="center-align">code
                                                <span>*</span></label>
                                            <input hidden id="codes" type="text" name="codes"
                                                value="{{ $response->code }}" autofocus>
                                            <input hidden id="idProfil" type="text" name="idProfil"
                                                value="{{ $response->utilisateur }}" autofocus>
                                            <input hidden id="token" type="text" name="token"
                                                value="{{ $response->token }}" autofocus>
                                            <input hidden id="log" type="text" name="login"
                                                value="{{ route('login') }}">

                                        </div>
                                        <div class="input-field col s4">
                                        </div>
                                    </div>
                                    <div class="row margin">
                                        <div class="col s3"></div>
                                        <div class="input-field col s6">
                                            <i class="material-icons prefix pt-1">lock_outline</i>
                                            <input id="password" type="password" name="password" required
                                                autocomplete="current-password">
                                            <label for="password" :value="__('Password')">Nouveau mot de passe</label>
                                        </div>
                                        <div class="col s3"></div>
                                    </div>
                                    <div class="row margin">
                                        <div class="col s3"></div>
                                        <div class="input-field col s6">
                                            <i class="material-icons prefix pt-1">lock_outline</i>
                                            <input id="password1" type="password" name="password1" required
                                                autocomplete="current-password">
                                            <label for="password" :value="__('Password')">Confirmer Mot de
                                                passe</label>
                                        </div>
                                        <div class="col s3"></div>
                                    </div>
                                    <div class="row margin">
                                        <div class="col s5"></div>
                                        <div class="input-field col s2">
                                            <button type="submit" class="btn border-round text-center"
                                                style="background-color:#4ab058 !important;justify-content:center !important">
                                                Valider</button>
                                        </div>
                                        {{-- <div class="input-field col s5">
                                            <button class="reload-code btn border-round col s6 text-center"
                                                style="background-color:#b07e4a !important">
                                                Renvoyer Code</button>
                                        </div> --}}
                                        <div class="col s5"></div>
                                    </div>
                                    <div class="container" id="message">
                                        {{-- @isset($message)
                                            <p
                                                style="height: 50px;border-radius:50px;background-color:rgb(215, 163, 163);padding:10px; margin:10px;color:white;text-align:center">
                                                {{ $message }}</p>
                                        @endisset --}}
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
    <script src="{{ asset('assets/vendors/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/form-wizard.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>


    <script>
        $(document).ready(function() {
            // console.log('work')
            let root = $('meta[name="url"]').attr("content");

            // $('.ong').hide();
            $('#fonction').change(() => {
                var profil = $('#fonction').val();
                var urlEntity = root + "/entitetype/" + profil;
                $('#ong-select').empty();

                $.ajax({
                    url: urlEntity,
                    method: 'GET',
                    headers: {},
                    dataType: 'JSON',
                    success: (res) => {
                        if (res.length > 1) {} else {}

                    },
                    error: () => {
                        alert('sheet error ')
                    }
                });


            });

            $('form.login-form').on('submit', function() {

                // console.log('reset declenched');
                let login = $('#log').val();
                // console.log(login);
                let formSkel = $(this),
                    urlForm = formSkel.attr('action'),
                    meth = formSkel.attr('method'),
                    dataForm = {};
                dataForm = $('form.login-form').serialize();
                // console.log(meth);
                swal({
                    title: "Renouvellement",
                    text: "Etes vous sur de vouloir renouveler votre mot de passe",
                    icon: 'warning',
                    dangerMode: true,
                    buttons: {
                        delete: 'Oui',
                        cancel: 'Annuler'
                    }
                }).then(function(willDelete) {
                    if (willDelete) {

                        $.ajax({
                            url: urlForm,
                            method: meth,
                            headers: {
                                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr(
                                    'content'),
                            },
                            data: dataForm,
                            // dataType: 'JSON',
                            success: (res) => {
                                $("#message").empty();
                                // Recuperer le status et Suivant le statut charger le message
                                // si le renouvellement est passe set la variable session et charger la page login
                                // console.log('Say yes ! ' + res.msg);
                                if (res.status === 200) {
                                    location.replace(login);

                                } else if (res.status === 401) {
                                    $("#message").append(
                                        "<div class='card-alert card text-center danger'><div class='card-content'><p style='text-align:center'>" +
                                        res.msg + "</p></div></div>"
                                    );

                                }

                            },
                            error: (err) => {
                                console.log('Oh no !! ' + err);
                            }
                        });

                    } else {

                    }
                });


                return false;
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
