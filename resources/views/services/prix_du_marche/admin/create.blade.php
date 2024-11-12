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
        <a href="{{ url('/prix-du-marche') }}">Prix</a>
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Nouveau Prix
    </li>
@endsection
<div class="row">
    <form method="POST" id="formAddPrix" action="/prix-du-marche/store">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Nouveau Prix</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="input-field col s6">
                                <select class="select2 browser-default" id="cat_produit" name="cat_produit">
                                    <option value="" disabled selected>Catégorie Produit</option>
                                </select>
                                <label class="active" for="cat_produit">Catégorie Produit</label>
                            </div>
                            <div class="input-field col s6">
                                <select class="select2 browser-default" id="produit" name="produit">
                                    <option value="" disabled selected>--Produit--</option>
                                </select>
                                <label class="active" for="produit">Produit</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <select class="select2 browser-default" id="variete" name="variete">
                                    <option value="" disabled selected>--Variété--</option>
                                </select>
                                <label class="active" for="variete">Variété</label>
                            </div>
                            <div class="input-field col s6">
                                <select class="select2 browser-default" id="unite" name="unite" required>
                                    <option value="" disabled selected>Unité</option>
                                    @foreach ($unites as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                                    @endforeach
                                </select>
                                {{-- <label for="unite" class="col-form-label">Unité</label> --}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <input id="prix_unitaire" type="number" class="validate" name="prix_unitaire" required>                
                                <label class="active" for="prix_unitaire">Prix Détaillant</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="prix_en_gros" type="number" class="validate" name="prix_en_gros" required>                
                                <label class="active" for="prix_en_gros">Prix En Gros</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <input id="date" type="text" class="datepicker" name="date" required>                
                                <label class="active" for="date">Date</label>
                            </div>
                            <div class="input-field col s6">
                                <select class="select2 browser-default" id="market" name="market" required>
                                    <option value="" disabled selected>Marché</option>
                                    @foreach ($marches as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['market'] }}</option>
                                    @endforeach
                                </select>
                                {{-- <label for="market" class="col-form-label">Marché</label> --}}
                            </div>
                        </div>

                        {{-- <div class="row">
                            <div class="input-field col s6">
                                <select class="select2 browser-default" id="campagne" name="campagne" required>
                                    <option value="" disabled selected>Campagne</option>
                                    @foreach ($campagnes as $item)
                                        <option value="{{ $item['id'] }}">Du {{ $item['debut'] }} au {{ $item['fin'] }}</option>
                                    @endforeach
                                </select>
                                <label for="campagne" class="col-form-label">Campagne</label>
                            </div>
                            
                        </div> --}}

                        <div class="row">

                            <div class="input-field col s12">
                                <div class="col s12 display-flex justify-content-end mt-1">
                                    <button id="formAddPrixbtn" type="button" class="btn indigo">
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

<script src="{{ asset('assets\js\crud\services\prix\message.js') }}"></script>
<script src="{{ asset('assets\js\providers\produits.js') }}"></script>

<script src="{{ asset('assets\js\providers\entity.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\read.js') }}"></script>
<script src="{{ asset('assets\js\crud\gestion\utilisateurs\user-state.js') }}"></script>

<!-- END PAGE LEVEL JS-->
@endsection
