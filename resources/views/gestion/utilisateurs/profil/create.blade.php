@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }} ">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('page-title')
    Utilisateurs
@endsection
@section('ariane')
    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Accueil</a></li>
    <li class="breadcrumb-item">
        @if ($_SESSION['role'] == 'ONG')
            <a href="{{ url('/ong/utilisateurs') }}">Utilisateurs</a>
        @else
            <a href="{{ url('/admin/utilisateurs') }}">Utilisateurs</a>
        @endif
    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Nouvel Utilisateur</li>
@endsection
@section('main_content')
    <div class="row">
        <form method="POST" id="formAddUser" action="#">
            @csrf
            <div class="col s12">
                <div class="card">
                    <div class="card-content pb-0">
                        <div class="card-header mb-2">
                            <h4 class="card-title">Nouvel Utilisateur</h4>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="input-field col s6">
                                    <input id="prenom" type="text" class="validate" name="prenom">
                                    <label class="active" for="prenom">Prénom</label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="nom" type="text" class="validate" name="nom">
                                    <label class="active" for="nom">Nom</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <div class="row">
                                        <label>
                                            <p>
                                                <input value="M" name="sexe" type="radio" required/>
                                                <span>Homme</span>
                                            </p>
                                        </label>
                                    </div>
                                    <div class="row">
                                        <label>
                                            <p>
                                                <input value="F" name="sexe" type="radio" required/>
                                                <span>Femme</span>
                                            </p>
                                        </label>
                                    </div>
                                </div>
                                <div class="input-field col s6">
                                    <div class="row">
                                        <label>
                                            <p>
                                                <input value="1" name="sit_matrimonial_id" type="radio" required/>
                                                <span>Marié</span>
                                            </p>
                                        </label>
                                    </div>
                                    <div class="row">
                                        <label>
                                            <p>
                                                <input value="2" name="sit_matrimonial_id" type="radio" required/>
                                                <span>Célibataire</span>
                                            </p>
                                        </label>
                                    </div>
                                    {{-- <label class="active" for="first_name2">First Name</label> --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input id="dt_naiss" type="text" class="datepicker" name="dt_naiss">
                                    <label class="active" for="dt_naiss">Date de naissance <i style="font-size: 12px">(+15
                                            ans)</i></label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="telephone" type="number" class="validate" name="telephone">
                                    <label class="active" for="telephone">Téléphone</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input id="email" type="email" class="validate" name="email">
                                    <label class="active" for="email">Email</label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="login" type="text" class="validate" name="login">
                                    <label class="active" for="login">Login</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input id="password" type="password" class="validate" name="password">
                                    <label class="active" for="password">Mot de passe</label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="cmdp" type="password" class="validate" name="cmdp">
                                    <label class="active" for="cmdp">Confirmation mot de passe</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input id="fonction" type="text" class="validate" name="fonction">
                                    <label class="active" for="fonction">Fonction</label>
                                </div>
                                <div class="input-field col s6">
                                    <select class="select2 browser-default" id="pays" name="pays">
                                        <option value="" disabled selected>Pays</option>
                                    </select>
                                    <label class="active" for="pays">Pays</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <select class="select2 browser-default region" id="region" name="region">
                                        <option value="" disabled selected>--Région--</option>
                                    </select>
                                    <label class="active" for="region">Région</label>
                                </div>
                                <div class="input-field col s6">
                                    <select class="select2 browser-default dept" id="dept" name="dept">
                                        <option value="" disabled selected>--Département--</option>

                                    </select>
                                    <label class="active" for="dept">département</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <select class="select2 browser-default commune" id="commune" name="commune">
                                        <option value="" disabled selected>--Commune--</option>
                                    </select>
                                    <label class="active" for="commune">Commune</label>
                                </div>
                                <div class="input-field col s6">
                                    <select class="select2 browser-default localite" id="localite" name="localite"
                                            class="validate">
                                        <option value="" disabled>--Localité--</option>
                                    </select>
                                    <label class="active" for="localite">Localité</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    @if ($_SESSION['role'] == 'ONG')
                                        <select class="select2 browser-default" id="entite" name="entite">
                                            <option value="" selected>Entité</option>
                                        </select>
                                        <input type="text" id="urlRootReplace" value="{{ url('/ong/utilisateurs') }}"
                                               hidden>
                                    @else
                                        <input type="text" id="urlRootReplace"
                                               value="{{ url('/admin/utilisateurs') }}" hidden>
                                        <select class="select2 browser-default" id="entite" name="entite">
                                            <option value="" selected>Entité</option>
                                        </select>
                                    @endif
                                    <label class="active" for="entite">Entité</label>
                                </div>
                                <div class="input-field col s12" id="profil_ferme_div" style="display:none;">
                                    <select class="select2 browser-default" id="entite_f" name="entite_f">
                                        <option value="" disabled selected>--Profils--</option>
                                    </select>
                                    <label class="active" for="entite_f">Profil</label>

                                </div>
                            </div>
                            @if ($_SESSION['role'] == 'ONG')
                                <div class="col s12 input-field">
                                    <label class="active" for="groupement">Reseau</label>
                                    <select class="browser-default" id="groupement" name="groupement">
                                        <option value="null">
                                            Choisissez un reseau
                                        </option>

                                        @isset($Gpt)
                                            @foreach ($Gpt as $item)
                                                @if ($item->id_groupement == $userInfos['groupement'])
                                                    <option value="{{ $item->id_groupement }}" selected>
                                                        {{ $item->libelle_groupement }}</option>
                                                @else
                                                    <option value="{{ $item->id_groupement }}">
                                                        {{ $item->libelle_groupement }}</option>
                                                @endif
                                            @endforeach
                                        @endisset

                                    </select>
                                </div>
                                <div class="col s12 input-field">
                                    <select class="browser-default" id="role" name="role">
                                        <option value="null">
                                            Choisissez un role
                                        </option>
                                        @isset($roleGpt)
                                            @foreach ($roleGpt as $item)
                                                @if ($item->role == $userInfos['role'])
                                                    <option value="{{ $item->id }}" selected>
                                                        {{ $item->role }}</option>
                                                @else
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->role }}</option>
                                                @endif
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                            @endif
                            <div class="row " id="roleDivPar">
                                <div class="input-field col s12" id="gptDiv">
                                    <select class="select2 browser-default" id="groupement" name="groupement">

                                    </select>
                                    <label class="active" for="groupement">Groupement de Base</label>
                                </div>
                                <div class="input-field col s12" id="roleDiv">
                                    <select class="select2 browser-default" id="role" name="role">

                                    </select>
                                    <label class="active" for="role">Role</label>
                                </div>
                            </div>
                            <div class="row " id="reseauDivPar">
                                <div class="input-field col s12" id="roleDiv">
                                    <select class="select2 browser-default" id="role2" name="role">

                                    </select>
                                    <label class="active" for="role2">Role</label>
                                </div>
                                <div class="input-field col s12" id="gptDiv2">
                                    <select class="select2 browser-default" id="groupement2" name="groupement">

                                    </select>
                                    <label class="active" for="groupement2">Reseau</label>
                                </div>
                                <div class="input-field col s12" id="pluvioDiv">
                                    <select class="select2 browser-default" id="pluvio" name="pluvio">

                                    </select>
                                    <label class="active" for="pluvio">Pluvio</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <div class="row" id="load"></div>
                                    {{-- <button id="formAddUserbtn" type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Enregistrer</button> --}}
                                    <div class="col s12 display-flex justify-content-end mt-1">
                                        <button id="formAddUserbtn" type="submit" class="btn indigo">
                                            Enregistrer
                                        </button>
                                        <button type="button" class="ml-1 btn btn-light">Annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection

@section('other-js-script')
    <!-- START RIGHT SIDEBAR NAV -->


    <!-- BEGIN: Footer-->



    <!-- END: Footer-->
    <!-- BEGIN VENDOR JS-->

    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>

    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/search.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>

    <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>

    {{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\edit.js')}}"></script> --}}

    <script src="{{ asset('assets\js\crud\gestion\utilisateurs\create.js') }}"></script>
    <script src="{{ asset('assets\js\providers\location.js') }}"></script>
    {{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
    <script src="{{ asset('assets\js\providers\entity.js') }}"></script>

    <script src="{{ asset('assets\js\crud\gestion\utilisateurs\read.js') }}"></script>
    <script src="{{ asset('assets\js\crud\gestion\utilisateurs\user-state.js') }}"></script>
    <script src="{{ asset('assets\js\crud\gestion\utilisateurs\profil.js') }}"></script>




    <!-- END PAGE LEVEL JS-->
@endsection
