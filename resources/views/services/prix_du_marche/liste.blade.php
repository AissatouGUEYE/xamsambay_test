@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('main_content')
@section('page-title')
    Prix
@endsection
@section('ariane')
    <li class="breadcrumb-item"><a href="/dashboard">Accueil</a></li>
    <li class="breadcrumb-item"><a href="/prix-du-marche">Prix</a></li>
    <li class="breadcrumb-item active yellow-text">Liste des Prix du Marché</li>
@endsection

<section class="users-list-wrapper section">

    <div class="users-list-filter">
        <div class="card-panel">
            <div class="row">
            </div>
        </div>
    </div>


    <div class="users-list-table">
        <div class="card">
            <div class="card-content">

                <!-- datatable start -->
                <div class="responsive-table">
                    <table id="data-table-simple" class="table">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Variété</th>
                                <th>Unité</th>
                                <th>Prix Détaillant</th>
                                <th>Prix en Gros</th>
                                <th>Date</th>
                                <th>Marché</th>
                                <th>Localité</th>

                            </tr>
                        </thead>
                        <tbody id="">
                            @isset($prix)
                                @foreach ($prix as $item)
                                <tr>
                                    <td>{{ $item['produit'] }}</td>
                                    <td>{{ $item['variete'] }}</td>
                                    <td>{{ $item['unite'] }}</td>
                                    <td>{{ $item['prix_unitaire'] }}</td>
                                    <td>{{ $item['prix_en_gros'] }}</td>
                                    <td>{{ $item['date_creation'] }}</td>
                                    <td>{{ $item['marche'] }}</td>
                                    <td>{{ $item['localite'] }}</td>

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

{{-- <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script> --}}
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\edit.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\create.js') }}"></script>
{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
<script src="{{ asset('assets\js\providers\entity.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\read.js') }}"></script>
{{-- <script src="{{ asset('assets\js\crud\gestion\utilisateurs\filter.js') }}"></script> --}}
<script src="{{ asset('assets\js\crud\gestion\utilisateurs\role\read.js') }}"></script>
<script src="{{ asset('assets\js\crud\gestion\utilisateurs\user-state.js') }}"></script>

<script src="{{ asset('assets\js\crud\services\prix\delete.js') }}"></script>


<script src="{{ asset('assets\js\crud\services\prix\message.js') }}"></script>
<script src="{{ asset('assets\js\providers\produits.js') }}"></script>
@endsection
