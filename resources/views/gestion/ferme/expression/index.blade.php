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
{{$_SESSION['nom_entite']}} 
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="{{ url('/dashboard') }}">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/ferme/eb') }}">Expression des besoins</a>
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Nouvelle
    </li>
@endsection

<div class="row" style="margin-top: 50px">
    <form method="POST" id="ebForm" action="{{ route('eb.create') }}" enctype="multipart/form-data">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Ajout expression de besoin</h4>
                    </div>
                    <div class="users-list-table">
                        <div class="card-body">
                            <div class="row">
                                <div class="input-field col s6">
                                    <select class="select2 browser-default" id="activite" name="activite">
                                        <option value="" disabled selected>--Type d'activité--</option>
                                    </select>
                                    <label class="active" for="activite">Type d'activité</label>
                                </div>
                                <div class="input-field col s6">
                                    <select class="select2 browser-default produit" id="produit" name="produit">
                                        <option value="" disabled selected>--Produit--</option>
                                    </select>
                                    <label class="active" for="activite">Produit</label>
                                </div>

                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="intitule" type="text" class="intitule" name="intitule">
                                    <label class="active" for="intitule">Besoin</label>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col s12 m6 l6">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <span>Fichier</span>
                                            <input type="file" name="fichier">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path" name="fichier" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col s12 m6 l6">
                                    <div class="input-field">
                                        <input id="monfichier" type="file" class="monfichier" name="monfichier">
                                        <label class="active" for="monfichier">Fichier</label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row">

                                <div class="input-field col s12">
                                    <div class="row" id="load"></div>
                                    {{-- <button id="formAddUserbtn" type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Enregistrer</button> --}}
                                    <div class="col s12 display-flex justify-content-end mt-1">
                                        {{-- <button type="submit" class="btn indigo">
                                            Envoyer</button> --}}

                                            <a href='#' class='ebBtn'>
                                                <span class='chip' style="background-color: transparent !important">
                                                    <span class='green-text'>

                                                        <i class="btn indigo" title="valider">Envoyer</i>
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
<!-- BEGIN PAGE LEVEL JS-->


{{-- <script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>

<script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script> --}}

{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
<script src="{{ asset('assets\js\crud\gestion\ferme\create.js') }}"></script>
<script src="{{ asset('assets\js\providers\ferme_activite.js') }}"></script>
<script src="{{ asset('assets\js\providers\ferme_produit.js') }}"></script>
<script src="{{ asset('assets\js\crud\gestion\ferme\eb\create.js') }}"></script>

<!-- END PAGE LEVEL JS-->
@endsection
