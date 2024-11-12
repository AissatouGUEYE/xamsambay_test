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
        <a href="{{ url('ferme/finance/decaissement') }}">Decaissement</a>
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Modification
    </li>
@endsection
<div class="row">
    <form action="{{ url('ferme/finance/decaissement/update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Modification Décaissement</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">

                            <input id="id" name="id" value="{{ $decInfos['id'] }}" hidden>
                            <input id="id_eb" name="id_eb" value="{{ $decInfos['id_eb'] }}" hidden>
                            {{-- <input id="file" name="file" value="{{ $decInfos['fichier'] }}" hidden> --}}
                            <div class="input-field col s6">
                                <select class="select2 browser-default" id="operation" name="operation">
                                    <option value="{{ $decInfos['id_payement'] }}" disabled selected>
                                        {{ $decInfos['payement'] }}</option>
                                </select>
                                <label class="active" for="operation">Type d'opération</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" class="validate" name="montant"
                                    value="{{ $decInfos['montant'] }}">
                                <label class="active" for="montant">Montant</label>
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
                                        <input class="file-path" name="fichier" type="text" value="{{ $decInfos['fichier'] }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <div class="row" id="load"></div>
                                <div class="col s12 display-flex justify-content-end mt-1">
                                    <button type="submit" class="btn indigo">
                                        Enregistrer</button>
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

{{-- <script src="{{asset('assets\js\crud\gestion\langues\create.js')}}"></script> --}}

{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}

<script src="{{ asset('assets\js\crud\gestion\ferme\activite\edit.js') }}"></script>

{{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\read.js')}}"></script> --}}
{{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\user-state.js')}}"></script> --}}

<!-- END PAGE LEVEL JS-->
@endsection
