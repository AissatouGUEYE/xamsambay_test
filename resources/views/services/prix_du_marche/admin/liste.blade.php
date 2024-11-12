@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('main_content')
@section('page-title')
    Prix
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/prix-du-marche">Prix</a>
    </li>
    <li class="breadcrumb-item active">Liste des Prix du Marché
    </li>
@endsection

<section class="users-list-wrapper section">

    <div class="users-list-filter">
        <div class="card-panel">
            <div class="row">
            </div>
        </div>
    </div>


    <div id="modal1" class="modal">
            <div class="modal-content">
                <h4>Nouveaux Prix</h4>
                <div class="divider mt-2"></div>
                <form method="POST" id="formAddPrix" action="/prix-du-marche/prix/store">
                    @csrf
                    <div class="row">
                        <div class="input-field col s6">
                            <select class="select2insidemodal1 browser-default" id="cat_produit" name="cat_produit">
                                <option value="" disabled selected>Catégorie Produit</option>
                            </select>
                            <label class="active" for="cat_produit">Catégorie Produit</label>
                        </div>
                        <div class="input-field col s6">
                            <select class="select2insidemodal2 browser-default" id="produit" name="produit">
                                <option value="" disabled selected>--Produit--</option>
                            </select>
                            <label class="active" for="produit">Produit</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <select class="select2insidemodal3 browser-default" id="variete" name="variete">
                                <option value="" disabled selected>--Variété--</option>
                            </select>
                            <label class="active" for="variete">Variété</label>
                        </div>
                        <div class="input-field col s6">
                            <select class="select2insidemodal4 browser-default" id="unite" name="unite" required>
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
                            <input id="date" type="text" class="datepicker" name="date" required>
                            <label class="active" for="date">Date</label>
                        </div>
                        <div class="input-field col s6">
                            <select class="select2insidemodal5 browser-default" id="market" name="market" required>
                                <option value="" disabled selected>Marché</option>
                                @foreach ($marches as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['market'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="input-field col s6">
                            <input id="prix_detaillant" type="number" class="validate" name="prix_detaillant" >
                            <label class="active" for="prix_detaillant">Prix Détaillant</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="prix_en_gros" type="number" class="validate" name="prix_en_gros" >
                            <label class="active" for="prix_en_gros">Prix En Gros</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <div class="col s12 display-flex justify-content-end mt-1">
                                <button id="" type="button" class="btn indigo">
                                    Enregistrer</button>

                                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>

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
                <div>
                        <a type="button" class="waves-effect waves-light  green darken-1 btn modal-trigger right" href="#modal1">
                            <i class="material-icons">add_circle</i>Nouveaux Prix
                        </a>
                </div>
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
                                {{-- <th>Campagne</th>                                               --}}
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            @isset($prix)
                                @foreach ($prix as $item)
                                <tr>
                                    <td>{{ $item['produit'] }}</td>
                                    <td>{{ $item['variete'] }}</td>
                                    <td>{{ $item['unite'] }}</td>
                                    <td>{{ $item['prix_detaillant'] }}</td>
                                    <td>{{ $item['prix_en_gros'] }}</td>
                                    <td>{{ $item['date_creation'] }}</td>
                                    <td>{{ $item['marche'] }}</td>
                                    <td>{{ $item['localite'] }}</td>
                                    {{-- <td>Du {{ $item['debut'] }} au {{ $item['fin'] }}</td> --}}

                                    <td>
                                        <a href="/prix-du-marche/prix/modifier/{{ $item['id'] }}">
                                            <i class="material-icons orange-text ">edit</i>
                                        </a>
                                        <a href="#" class="px-1" onclick="deletePrix({{$item['id']}})">
                                            <i class="material-icons red-text ">delete</i>
                                        </a>
                                    </td>
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
