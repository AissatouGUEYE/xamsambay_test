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
    Marchés
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/prix-du-marche/prix">Prix du Marché</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text">Liste des Marchés</a>
    </li>
@endsection

<section class="users-list-wrapper section">
    <div class="users-list-filter">
        {{-- <div class="card-panel">
            <div class="row"></div>
        </div> --}}
    </div>
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Nouveau Marché</h4>
            <div class="divider mt-2"></div>
            <form method="POST" id="formAddMarket" action="/prix-du-marche/marches/store">
                @csrf
                <div class="row">
                    <div class="input-field col s6">
                        <label for="market" class="active">Nom du marché</label>
                        <input type="text" class="form-control" id="market" name="market">
                    </div>
                    <div class="input-field col s6">
                        <label for="code" class="active">Code du marché</label>
                        <input type="text" class="form-control" id="code" name="code">
                    </div>

                    <div class="input-field col s6" id="market-type-containers">
                        <select class="select2insidemodal1 browser-default" id="type_market" name="type_market">
                            <option value="" disabled selected>Choisissez le type de marché</option>
                            @foreach ($type_marches as $item)
                                <option value="{{ $item['id'] }}">{{ $item['type_market'] }}</option>
                            @endforeach
                        </select>
                        <label for="type_market" class="active">Type de marché</label>
                    </div>
                    {{-- <div class="input-field col s6">
                        <select class="select2insidemodal1 browser-default" id="type_market" name="type_market">
                            <option value="" disabled selected>Choisissez le type de marché</option>
                            @foreach ($type_marches as $item)
                                <option value="{{ $item['id'] }}">{{ $item['type_market'] }}</option>
                            @endforeach
                        </select>
                        <label for="type_market" class="active">Type de marché</label>
                    </div> --}}

                    <div class="input-field col s6">
                        <select class="select2insidemodal1 browser-default" id="pays" name="pays">
                            <option value="" disabled selected>Pays</option>
                        </select>
                        <label class="active" for="pays">Pays</label>
                    </div>

                    <div class="input-field col s6">
                        <select class="select2insidemodal1 browser-default" id="region" name="region">
                            <option value="" selected>Région</option>
                        </select>
                        <label class="active" for="region">Région</label>
                    </div>

                    <div class="input-field col s6">
                        <select class="select2insidemodal1 browser-default" id="dept" name="dept">
                            <option value="" selected>Département</option>
                        </select>
                        <label class="active" for="dept">Département</label>
                    </div>

                    <div class="input-field col s6">
                        <select class="select2insidemodal1 browser-default" id="commune" name="commune">
                            <option value="" selected>Commune</option>
                        </select>
                        <label class="active" for="commune">Commune</label>
                    </div>

                    <div class="input-field col s6" id="localite-container">
                        <select class="select2insidemodal1 browser-default" id="localite" name="localite">
                            <option value="" selected>Localité</option>
                        </select>
                        <label class="active" for="localite">Localité</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="latitude" type="number" class="validate"
                            name="latitude">
                        <label class="active" for="latitude">Latitude</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="longitude" type="number" class="validate"
                            name="longitude">
                        <label class="active" for="longitude">Longitude</label>
                    </div>

                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <div class="col s12 display-flex justify-content-end mt-1">
                            <button id="formAddMarketbtn" type="button" class="btn indigo">Enregistrer</button>
                            <a href="#!"
                                class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
        </div>
    </div>
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <!-- datatable start -->
                @if (in_array($_SESSION['role'], ['ADMIN', 'SUPERADMIN']))
                    <div class="pb-3">
                        <a type="button" class="waves-effect waves-light  green darken-1 btn modal-trigger right"
                            href="#modal1"><i class="material-icons">add_circle</i> Nouveau Marché</a>
                    </div>
                @endif

                <div class="responsive-table pt-3">
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Localité</th>
                                <th>Commune</th>
                                <th>Département</th>
                                <th>Région</th>
                                <th>Type</th>
                                @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']))
                                    <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody id="">
                            @isset($marches)
                                @foreach ($marches as $item)
                                    {{-- <tr onclick="showMap({{ $item['latitude'] }}, {{ $item['longitude'] }})"> --}}
                                    <tr id="trr">
                                        <td>{{ $item['market'] }}</td>
                                        <td>{{ $item['localite'] }}</td>
                                        <td>{{ $item['commune'] }}</td>
                                        <td>{{ $item['departement'] }}</td>
                                        <td>{{ $item['region'] }}</td>
                                        <td>{{ $item['type_market'] }}</td>
                                        @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']))
                                            <td>

                                                <a href="/prix-du-marche/marches/modifier/{{ $item['id'] }}">
                                                    <i class="material-icons orange-text ">edit</i>
                                                </a>
                                                <a href="#" class="px-1"
                                                    onclick="deleteMarket({{ $item['id'] }})">
                                                    <i class="material-icons red-text ">delete</i>
                                                </a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
                <!-- datatable ends -->
            </div>
        </div>
    </div>

</section>
@endsection

@section('other-js-script')
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>

<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>

<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\edit.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\read.js') }}"></script>
<script src="{{ asset('assets\js\crud\gestion\utilisateurs\role\read.js') }}"></script>
<script src="{{ asset('assets\js\crud\gestion\utilisateurs\user-state.js') }}"></script>

<script src="{{ asset('assets/js/crud/gestion/market/message.js') }}"></script>
<script src="{{ asset('assets/js/crud/gestion/market/delete.js') }}"></script>

<script src="{{ asset('assets/js/crud/gestion/groupements/localite.js') }}"></script>
<script src="{{ asset('assets/js/providers/market.js') }}"></script>
@endsection
