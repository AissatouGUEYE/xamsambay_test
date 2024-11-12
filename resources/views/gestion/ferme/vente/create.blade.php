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
        <a href="{{ url('/ferme/finance/vente') }}">Vente</a>
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Nouveau
    </li>
@endsection

<div class="row" style="margin-top: 50px">
    <form method="POST" id="formAddVente" action={{route('ferme.vente.create')}} enctype="multipart/form-data" >
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="users-list-table">
                        <div class="card-body">
                            <div class="row">
                                <div class="input-field col s6">
                                    <select class="select2 browser-default">
                                        <option value="{{ $stock->id_produit }}"selected>{{ $stock->produit }}</option>
                                    </select>
                                    <label class="active" for="activite">Produit</label>
                                </div>
                                <div class="input-field col s6">
                                    <label class="active" for="activite">Prix Previsionnel(CFA)</label>
                                    <div class="input-field  col s3">
                                        Detail : {{ $stock->prix_detaillant }}
                                    </div>
                                    <div class="input-field  col s3">
                                        En gros : {{ $stock->prix_en_gros }}
                                    </div>
                                    <div class="input-field  col s3">
                                        Stock: {{ $stock->quantite }} {{ $stock->unite }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="input-field col s6">
                                    <input id="quantite" type="text" class="quantite" name="quantite" required>
                                    <label class="active" for="quantite">Quantite</label>
                                </div>

                                <div class="input-field col s6">
                                    <select class="select2 browser-default">
                                        <option value="{{ $stock->id_unite }}" disabled selected>{{ $stock->unite }}
                                        </option>
                                    </select>
                                    <label class="active" for="activite">Unite</label>
                                </div>

                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input id="prix_vente" type="text" class="prix_vente" name="prix_vente" required>
                                    <label class="active" for="prix_vente">Prix de vente </label>
                                </div>
                                <div class="input-field col s6">
                                    <select class=" browser-default" id="operation" name="operation" required>
                                        <option value="" disabled selected>--Type d'opération--</option>
                                    </select>
                                    <label class="active" for="operation">Type d'opération</label>

                                </div>


                                <div class="input-field col s12">
                                    <input id="stock" type="text" class="stock" name="stock"
                                        value="{{ $stock->id }}" hidden>
                                    <input id="unite_stock" type="text" class="unite_stock" name="unite_stock"
                                        value="{{ $stock->unite }}" hidden>
                                    <input id="id_unite_stock" type="text" class="id_unite_stock"
                                        name="id_unite_stock" value="{{ $stock->id_unite }}" hidden>
                                    <input id="qtite_stock" type="text" class="qtite_stock" name="qtite_stock"
                                        value="{{ $stock->quantite }}" hidden>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col s6 m6 l6">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <span>Justificatif</span>
                                            <input type="file" name="fichier" class="filename">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path" name="fichier" class="filename" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <div class="row" id="load"></div>
                                    <div class="col s12 display-flex justify-content-end mt-1">
                                        <a href='#' id='venteBtn'>
                                            <span class='chip' style="background-color: transparent !important">
                                                <span class='green-text'>

                                                    <i class="btn indigo" title="valider">Envoyer</i>
                                                </span>
                                            </span>
                                        </a>
                                        {{-- <button id="venteBtn" class="btn indigo">
                                            Valider</button> --}}
                                        <button type="button" class="ml-1 btn btn-light">Annuler</button>
                                    </div>
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
{{-- <script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>

<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>

<script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script> --}}
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>
<script src="{{ asset('assets\js\crud\gestion\ferme\create.js') }}"></script>
<script src="{{ asset('assets/js/providers/ferme_activite.js')}}"></script>
{{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\edit.js')}}"></script> --}}


<!-- END PAGE LEVEL JS-->
@endsection
