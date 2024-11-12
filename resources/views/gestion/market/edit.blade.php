@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('main_content')
@section('page-title')
    Groupements
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="{{ url('/dashboard') }}">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/prix-du-marche/marches') }}">Marchés</a>
    </li>

    <li class="breadcrumb-item">
        <a class="yellow-text">Modification Marché</a>
    </li>
@endsection
<div class="row">
    <form id="" action="/prix-du-marche/marches/edit" method="POST">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Modification Marché</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <input id="id" name="id" value="{{ $market[0]['id'] }}" hidden>

                            <div class="input-field col s6">
                                <input id="market" type="text" class="validate" name="market"
                                    value="{{ $market[0]['market'] }}" required>
                                <label class="active" for="market">Nom du marché</label>
                            </div>
                            <div class="input-field col s6">
                                <label for="code" class="active">Code du marché</label>
                                <input type="text" class="form-control" id="code" name="code"
                                    value="{{ $market[0]['code_market'] }}">
                            </div>
                            <div class="input-field col s6" id="market-type-containers">
                                <select class=" browser-default" id="type_market" name="type_market">

                                    {{-- <option value="{{ $market[0]['id_type_market'] }}" selected>{{ $market[0]['type_market'] }}</option>

                      @foreach ($type_marches as $item)
                          <option value="{{ $item['id'] }}">{{ $item['type_market'] }}</option>
                      @endforeach --}}
                                    <option value="{{ $market[0]['id_type_market'] }}" selected>
                                        {{ $market[0]['type_market'] }}</option>

                                    @foreach ($type_marches as $item)
                                        @if ($item['id'] != $market[0]['id_type_market'])
                                            <option value="{{ $item['id'] }}">{{ $item['type_market'] }}</option>
                                        @endif
                                    @endforeach

                                </select>
                                <label class="active" for="type_market">Type de marché</label>

                            </div>
                            {{-- <div class="input-field col s6">
                                <select class=" browser-default" id="pays" name="pays">
                                    <option value="{{ $market[0]['id_pays'] }}" selected>{{ $market[0]['pays'] }}
                                    </option>
                                </select>
                                <label class="active" for="pays">Pays</label>
                            </div> --}}
                            <div class="input-field col s6">
                                <select class=" browser-default" id="pays" name="pays">
                                    <option value="{{ $market[0]['id_pays'] }}" selected>{{ $market[0]['pays'] }}
                                    </option>
                                </select>
                                <label class="active" for="pays">Pays</label>
                            </div>
                            <div class="input-field col s6">
                                <select class=" browser-default" id="region" name="region">
                                    <option value="{{ $market[0]['id_region'] }}" selected>{{ $market[0]['region'] }}
                                    </option>
                                </select>
                                <label class="active" for="region">Région</label>
                            </div>
                            <div class="input-field col s6">
                                <select class=" browser-default" id="dept" name="dept">
                                    <option value="{{ $market[0]['id_departement'] }}" selected>
                                        {{ $market[0]['departement'] }}</option>
                                </select>
                                <label class="active" for="dept">Département</label>
                            </div>
                            <div class="input-field col s6">
                                <select class=" browser-default" id="commune" name="commune">
                                    <option value="{{ $market[0]['id_commune'] }}" selected>
                                        {{ $market[0]['commune'] }}</option>
                                </select>
                                <label class="active" for="commune">Commune</label>
                            </div>

                            <div class="input-field col s6" id="localite-container">
                                <select class=" browser-default" id="localite" name="localite">
                                    <option value="{{ $market[0]['id_localite'] }}" selected>
                                        {{ $market[0]['localite'] }}</option>
                                </select>
                                <label class="active" for="localite">Localité</label>
                            </div>

                            <div class="input-field col s6">
                                <input id="latitude" type="text" name="latitude"
                                    value="{{ $market[0]['latitude'] }}">
                                <label class="active" for="latitude">Latitude</label>
                            </div>

                            <div class="input-field col s6">
                                <input id="longitude" type="text" name="longitude"
                                    value="{{ $market[0]['longitude'] }}">
                                <label class="active" for="longitude">Longitude</label>
                            </div>

                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <div class="row" id="load"></div>
                                {{-- <button id="formAddUserbtn" type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Enregistrer</button> --}}
                                <div class="col s12 display-flex justify-content-end mt-1">
                                    <button type="submit" class="btn indigo">
                                        Mettre à jour</button>
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
@endsection

@section('other-js-script')
<!-- START RIGHT SIDEBAR NAV -->


<!-- BEGIN: Footer-->



<!-- END: Footer-->
<!-- BEGIN VENDOR JS-->

<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{ asset('assets/js/scripts/form-.js') }}"></script>

<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>

<script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>

<script src="{{ asset('assets\js\providers\location.js') }}"></script>

<script src="{{ asset('assets/js/crud/gestion/groupements/localite.js') }}"></script>

<script src="{{ asset('assets/js/crud/gestion/market/message.js') }}"></script>
<script src="{{ asset('assets/js/providers/market.js') }}"></script>
@endsection
