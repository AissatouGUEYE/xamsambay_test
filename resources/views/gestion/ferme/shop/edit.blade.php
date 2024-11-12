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
        <a href="{{ url('/ferme/shop') }}">Boutiques</a>
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Modification Boutique
    </li>
@endsection
<div class="row">
    <form id="formModShopFerme" action="/ferme/shop/update" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Modification Boutique</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">

                            <input id="id" name="id" value="{{ $shops['id'] }}" hidden>

                            <div class="input-field col s6">
                                <input id="nom" type="text" class="validate" name="nom"
                                    value="{{ $shops['nom'] }}">
                                <label class="active" for="nom">Nom de la boutique</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="nom" type="text" class="validate" name="desc_boutique"
                                    value="{{ $shops['description'] }}" required>
                                <label class="active" for="nom">Description</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">

                                <select class="browser-default localite" id="localite" name="localite">
                                    <option value="{{ $shops['id_localite'] }}" selected>
                                        {{ $shops['localite'] }}</option>

                                </select>
                                <label class="active" for="">Localité</label>
                                {{-- <label for="icon_prefix16"></label> --}}
                            </div>
                            <div class="col s6 m6 l6">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>Logo</span>
                                        <input type="file" name="fichier">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path" name="fichier" type="text">
                                    </div>
                                    <div>
                                        <input type="text" value=" {{ $shops['logo'] }}" hidden name="image">
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <div class="row" id="load"></div>
                                <div class="col s12 display-flex justify-content-end mt-1">
                                    <button type="submit" id="formModShopFermeBtn" class="btn indigo">
                                        Enregistrer</button>
                                    <button type="button" id="annuler" class="ml-1 btn btn-light">Annuler</button>
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
<script>
    $(document).ready(function() {
        $("#annuler").click(function() {
            parent.history.back();
            return false;
        });
    });
</script>
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
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script> --}}

{{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\edit.js')}}"></script> --}}

{{-- <script src="{{asset('assets\js\crud\gestion\langues\create.js')}}"></script> --}}

{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}

{{-- <script src="{{ asset('assets\js\crud\gestion\ferme\activite\edit.js') }}"></script> --}}
<script src="{{ asset('assets/js/providers/panier.js') }}"></script>

{{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\read.js')}}"></script> --}}
{{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\user-state.js')}}"></script> --}}

<!-- END PAGE LEVEL JS-->
@endsection
