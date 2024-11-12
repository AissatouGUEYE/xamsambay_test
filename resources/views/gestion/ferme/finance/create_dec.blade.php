@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('main_content')
@section('page-title')
    {{ $_SESSION['nom_entite'] }}
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="{{ url('/dashboard') }}">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/ferme/finance/decaissement') }}">Décaissement</a>
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Nouveau
    </li>
@endsection

<div class="row" style="margin-top: 50px">
    <form method="POST" id="decForm" action="{{ route('ferme.decaissement') }}" enctype="multipart/form-data">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Effectuer un décaissement</h4>
                    </div>

                    <div class="users-list-table">
                        <div class=" display-flex align-items-center right">
                            <h5>
                                <i class="material-icons">trending_up
                                </i>Solde : {{$somme}} FCFA
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="input-field col s6">
                                    <select class="select2 browser-default" id="operation" name="operation">
                                        <option value="" disabled selected>--Type d'opération--</option>
                                    </select>
                                    <label class="active" for="operation">Type d'opération</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <div class="input-field col s12">
                                        <input id="montant" type="text" class="montant" name="montant">
                                        <label class="active" for="montant">Montant </label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="eb" type="text" class="eb" name="eb"
                                            value="{{ $id }}" hidden>

                                    </div>
                                    <div class="input-field col s12">
                                        <input id="solde" type="text" 
                                            value="{{ $somme }}" hidden>

                                    </div>

                                </div>
                                <div class="col s6 m6 l6">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <span>Justificatif</span>
                                            <input type="file" name="fichier">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path" name="fichier" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="input-field col s12">
                                    <div class="row" id="load"></div>
                                    <div class="col s12 display-flex justify-content-end mt-1">
                                        {{-- <button type="submit" class="btn indigo">
                                            Envoyer</button> --}}

                                            <a href='#' id='decBtn'>
                                                <span class='chip' style="background-color: transparent !important">
                                                    <span class='green-text'>
    
                                                        <i class="btn indigo" title="valider">Enregistrer</i>
                                                    </span>
                                                </span>
                                            </a>
                                            <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Annuler</a>                                    </div>
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
{{-- <!-- BEGIN PAGE LEVEL JS-->
<script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>

<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>

<script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script> --}}
{{-- <script src="{{ asset('assets\js\crud\gestion\ferme\create.js') }}"></script> --}}
<script src="{{ asset('assets\js\providers\ferme_activite.js') }}"></script>
{{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\edit.js')}}"></script> --}}


<!-- END PAGE LEVEL JS-->
@endsection
