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
    Prix
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="{{ url('/dashboard') }}">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/banques/offre-de-credit') }}">Offres de Crédit</a>
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Création Offre
    </li>
@endsection
<div class="row">
    <form method="POST" id="formAddOffre" action="/banques/offre-de-credit/store">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Nouvelle Offre de Crédit</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">

                            <div class="input-field col s6">
                                <select class="select browser-default" name="entite" required>
                                    <option value="" disabled selected>Banque</option>
                                    @foreach ($banques as $item)
                                        <option value="{{ $item['id_entite'] }}">{{ $item['nom_entite'] }}</option>
                                    @endforeach
                                </select>
                                <label class="active" for="entite">Banque</label>
                            </div>


                            <div class="input-field col s6">
                                <input id="nom" type="text" class="validate" name="nom">
                                <label class="active" for="nom">Nom de l'Offre</label>
                            </div>

                            <div class="input-field col s6">
                                <input id="description" type="text" class="validate" name="description">
                                <label class="active" for="description">Description</label>
                            </div>

                            <div class="input-field col s6">
                                <input id="plancher" type="number" class="validate" name="plancher">
                                <label class="active" for="plancher">Montant Plancher (F CFA)</label>
                            </div>

                            <div class="input-field col s6">
                                <input id="plafond" type="number" class="validate" name="plafond">
                                <label class="active" for="plafond">Montant Plafond (F CFA)</label>
                            </div>

                            {{-- <div class="input-field col s6">
                                <select class="select browser-default" id="unite" name="unite" required> --}}
                                    {{-- <option value="" disabled selected>Unité</option>
                                    @foreach ($unites as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                                    @endforeach --}}
                                    {{-- @foreach ($unites as $item)

                                        @if($item['id'] == 7)
                                            <option value="{{ $item['id'] }}" selected>{{ $item['unite'] }}</option>
                                        @else
                                            <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                                        @endif

                                    @endforeach
                                </select>
                                <label class="active" for="unite">Unité</label>
                            </div> --}}

                            <div class="input-field col s6">
                                <input id="date" type="text" class="datepicker" name="date" required>
                                <label class="active" for="date">Date</label>
                            </div>

                            <div class="input-field col s6">
                                <input id="duree" type="number" class="validate" name="duree">
                                <label class="active" for="duree">Durée (mois)</label>
                            </div>

                            <div class="input-field col s6">
                                <input id="taux" type="number" class="validate" name="taux">
                                <label class="active" for="taux">Taux (%)</label>
                            </div>

                            <div class="input-field col s6">
                                <input id="frais_adhesion" type="number" class="validate" name="frais_adhesion">
                                <label class="active" for="frais_adhesion">Frais d'Adhésion (F CFA)</label>
                            </div>

                            <div class="input-field col s6">
                                <input id="apport_personnel" type="number" class="validate" name="apport_personnel">
                                <label class="active" for="apport_personnel">Apport Personnel (F CFA)</label>
                            </div>

                            <div class="input-field col s6">
                                <input id="frais_dossier" type="number" class="validate" name="frais_dossier">
                                <label class="active" for="frais_dossier">Frais de Dossier (F CFA)</label>
                            </div>

                            <div class="input-field col s6">
                                <input id="frais_gestion" type="number" class="validate" name="frais_gestion">
                                <label class="active" for="frais_gestion">Frais de Gestion (F CFA)</label>
                            </div>

                            <div class="input-field col s6">
                                <select class="select" name="assurance" required>
                                    <option value="1">Offre avec Assurance</option>
                                    <option value="0">Offre sans Assurance</option>
                                </select>
                                {{-- <label class="active" for="assurance">Assurance</label> --}}
                            </div>

                            <div class="input-field col s6">
                                <select class="select" name="garantie" required>
                                    <option value="1">Offre avec Garantie</option>
                                    <option value="0">Offre sans Garantie</option>
                                </select>
                                {{-- <label class="active" for="garantie">Garantie</label> --}}
                            </div>
        
                        </div>

                        <div class="row">

                            <div class="input-field col s12">
                                <div class="col s12 display-flex justify-content-end mt-1">
                                    <button id="formAddOffrebtn" type="button" class="btn indigo">
                                        Enregistrer</button>
                                    {{-- <button type="button" class="ml-1 btn btn-light">Annuler</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
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

<script src="{{ asset('assets\js\providers\produits.js') }}"></script>

<script src="{{ asset('assets\js\providers\entity.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\read.js') }}"></script>
<script src="{{ asset('assets\js\crud\gestion\utilisateurs\user-state.js') }}"></script>

<script src="{{ asset('assets/js/crud/services/offres/message.js') }}"></script>

<!-- END PAGE LEVEL JS-->
@endsection
