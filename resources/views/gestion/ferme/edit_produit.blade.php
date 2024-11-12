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
        <a href="{{ url('/listeferme') }}">Ferme</a>
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Modification Produit
    </li>
@endsection
<div class="row">
    <form id="formModprod" action="#" method="POST">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Modification Produit</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                           
                            <input id="id" name="id" value="{{ $prodInfos['id'] }}" hidden>
                            {{-- <input id="id_ferme" name="id_ferme" value="{{ $prodInfos['id_ferme'] }}" hidden> --}}

                            <div class="input-field col s6">
                                <input id="commune" type="text" class="validate" name="produit"
                                    value="{{ $prodInfos['produit'] }}">
                                <label class="active" for="produit">Nom du produit</label>
                            </div>
                            <div class="input-field col s6">
                                <select class="select2 browser-default" id="activite" name="activite">
                                    <option value="{{ $prodInfos['id_activite'] }}" selected>{{ $prodInfos['activite'] }}</option>
                                </select>
                                <label class="active" for="activite">Type d'activité</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <div class="row" id="load"></div>
                                <div class="col s12 display-flex justify-content-end mt-1">
                                    <button type="submit" id="formModProdBtn" class="btn indigo">
                                        Envoyer</button>
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
{{-- <script src="{{ asset('assets\js\providers\ferme_activite.js') }}"></script> --}}
{{-- <script src="{{ asset('assets\js\providers\produits.js') }}"></script> --}}
{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}


{{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\read.js')}}"></script> --}}
{{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\user-state.js')}}"></script> --}}

<!-- END PAGE LEVEL JS-->
@endsection
