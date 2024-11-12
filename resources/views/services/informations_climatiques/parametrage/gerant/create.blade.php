@extends('layouts.master')
{{-- @section('other-css-files')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection --}}
@section('main_content')
@section('page-title')
    Paramétrage
@endsection
@section('ariane')
    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/information-climatique/parametrage') }}">Paramétrage</a></li>
    <li class="breadcrumb-item active yellow-text" >Nouveau Gérant</li>
@endsection
<div class="row">
    <form id="form-gerant-create" method="POST" action="#">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Nouveau Gérant</h4>
                    </div>
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
                                        <input value="M" name="sexe" type="radio" required />
                                        <span>Homme</span>
                                    </p>
                                </label>
                            </div>
                            <div class="row">
                                <label>
                                    <p>
                                        <input value="F" name="sexe" type="radio" required />
                                        <span>Femme</span>
                                    </p>
                                </label>
                            </div>
                        </div>
                        <div class="input-field col s6">
                            <input id="dt_naiss" type="text" class="datepicker" name="dtNaiss">
                            <label class="active" for="dt_naiss">Date de naissance</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="telephone" type="number" class="validate" name="telephone">
                            <label class="active" for="telephone">Téléphone</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="email" type="email" class="validate" name="email">
                            <label class="active" for="email">Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="login" type="text" class="validate" name="login">
                            <label class="active" for="telephone">Login</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="password" type="password" class="validate" name="password">
                            <label class="active" for="email">Mot de Passe</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <select class=" browser-default" id="" name="status">
                                <option value="" disabled selected>Status</option>
                                <option value="0">OUI</option>
                                <option value="1">NON</option>
                            </select>
                            <label class="active" for="pays">Status</label>
                        </div>
                        <div class="input-field col s6">
                            <select class=" browser-default" id="pays" name="pays">
                                <option value="" disabled selected>Pays</option>
                            </select>
                            <label class="active" for="pays">Pays</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <select class=" browser-default region" id="region" name="region">
                                <option value="" disabled selected>--Région--</option>
                            </select>
                            <label class="active" for="region">Région</label>
                        </div>
                        <div class="input-field col s6">
                            <select class=" browser-default dept" id="dept" name="dept">
                                <option value="" disabled selected>--Département--</option>
                            </select>
                            <label class="active" for="dept">département</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <select class=" browser-default commune" id="commune" name="commune">
                                <option value="" disabled selected>--Commune--</option>
                            </select>
                            <label class="active" for="commune">Commune</label>
                        </div>
                        <div class="input-field col s6">
                            <select class=" browser-default localite" id="localite" name="localite">
                                <option value="" disabled>--Localité--</option>
                            </select>
                            <label class="active" for="localite">Localité</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <select class=" browser-default " id="reseau-gerant" name="reseau">
                                <option value="" disabled selected>Choisissez le reseau</option>
                                @foreach ($reseaux as $reseau)
                                    <option value="{{ $reseau->id_groupement }}">{{ $reseau->libelle }}</option>
                                @endforeach
                            </select>
                            <label class="active" for="users-list-status">Reseau</label>
                        </div>
                        <div class="input-field col s6">
                            <select class="browser-default" id="pluvio" name="pluvio">
                                <option value="" disabled selected>Choisissez le pluvio</option>
                                @foreach ($pluvios as $pluvio)
                                    <option value="{{ $pluvio->id }}">{{ $pluvio->localite }}</option>
                                @endforeach
                            </select>
                            <label class="active" for="users-list-status">Pluvio</label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <div class="col s12 display-flex justify-content-end mt-1">
                                <a id="btn-gerant-create"
                                    class="waves-effect waves-light green darken-1  btn right">Enregistrer</a>
                                <button type="button" class="ml-1 btn btn-light">Annuler</button>
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
{{-- <script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>

<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>

<script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>

{{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\edit.js')}}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\create.js') }}"></script>
<script src="{{ asset('assets\js\providers\location.js') }}"></script>
{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script>
<script src="{{ asset('assets\js\providers\entity.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\read.js') }}"></script>
<script src="{{ asset('assets\js\crud\gestion\utilisateurs\user-state.js') }}"></script> --}}

<!-- END PAGE LEVEL JS-->


@endsection
