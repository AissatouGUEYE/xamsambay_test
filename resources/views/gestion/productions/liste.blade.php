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
    Productions
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/productions/liste">Productions</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text">Liste des Productions</a>
    </li>
@endsection

@if (in_array($_SESSION['role'], ['AUOP', 'UOP', 'ONG', 'ADMIN', 'SUPERADMIN']))
    <section class="users-list-wrapper section">
        <div class="users-list-filter">
            <div class="card-panel">
                <div class="row">
                    <form method="POST" action="{{ url('/productions/filter') }}">

                        @csrf

                        <div class="col s12 m12 l10">
                            <label for="grp-list">Groupement</label>
                            <div class="input-field">
                                <select class="form-control" name="grp-list">

                                    @if (isset($grp_filter_libelle) && isset($grp_filter_id))

                                        @if (strcmp($grp_filter_libelle, 'null') == 0)
                                            <option value=null>Pas de filtre</option>
                                            @foreach ($groupements as $item)
                                                <option value="{{ $item['id_groupement'] }}">{{ $item['libelle'] }}
                                                </option>
                                            @endforeach
                                        @else
                                            @foreach ($groupements as $item)
                                                @if ($item['id_groupement'] == $grp_filter_id)
                                                    <option value="{{ $item['id_groupement'] }}" selected>
                                                        {{ $item['libelle'] }}</option>
                                                @else
                                                    <option value="{{ $item['id_groupement'] }}">{{ $item['libelle'] }}
                                                    </option>
                                                @endif
                                            @endforeach
                                            <option value=null>Pas de filtre</option>
                                        @endif
                                    @else
                                        <option value=null>Pas de filtre</option>
                                        @foreach ($groupements as $item)
                                            <option value="{{ $item['id_groupement'] }}">{{ $item['libelle'] }}
                                            </option>
                                        @endforeach

                                    @endif


                                </select>
                            </div>
                        </div>

                        <div class="col s12 m12 l2 display-flex align-items-center show-btn">
                            <button type="submit" class="btn block indigo waves-effect waves-light ml-1"><i
                                    class="material-icons">filter_list</i></button>


                        </div>
                    </form>

                </div>
            </div>

        </div>
@endif
<div class="users-list-table">
    <div class="card">
        <div class="card-content">

            @if (in_array($_SESSION['role'], ['AUOP', 'UOP', 'OP', 'INDIVIDUEL']))
                <a type="button" class="waves-effect waves-light  green darken-1 btn modal-trigger right"
                    {{-- href="/productions/create"><i class="material-icons">add_circle</i> --}} href="#modal1"><i class="material-icons">add_circle</i>
                    Production</a>
                <div id="modal1" class="modal">
                    <div class="modal-content">
                        <h4>Nouvelle Production</h4>
                        <div class="divider mt-2"></div>
                        <form method="POST" action="/productions/store" id="formAddProduction"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                @if (in_array($_SESSION['role'], ['AUOP']))
                                    <div class="col s6">
                                        <div class="input-field">

                                            <select class="" id="union" name="union">
                                                <option value="" disabled selected>Choisissez l' Union de
                                                    Groupement</option>
                                                @foreach ($union_groupements as $item)
                                                    <option value="{{ $item['id_union_groupement'] }}">
                                                        {{ $item['libelle'] }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            {{-- <label for="profil" class="active">Union</label> --}}

                                        </div>
                                    </div>

                                    <div class="col s6">
                                        <div class="input-field">
                                            <select class="browser-default" id="groupement" name="groupement">
                                                <option value="" disabled selected>--Groupement--</option>
                                            </select>
                                            {{-- <label for="groupement">Groupement</label> --}}
                                        </div>
                                    </div>
                                @endif

                                @if (in_array($_SESSION['role'], ['UOP']))
                                    <div class="col s12">
                                        <div class="input-field">

                                            <select class="" id="groupement_uop" name="groupement">
                                                <option value="" disabled selected>Choisissez le Groupement
                                                </option>
                                                @foreach ($groupements as $item)
                                                    <option value="{{ $item['id_groupement'] }}">
                                                        {{ $item['libelle'] }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            {{-- <label for="groupement" class="active">Groupement</label> --}}

                                        </div>
                                    </div>
                                @endif

                                @if (in_array($_SESSION['role'], ['AUOP', 'UOP']))
                                    <div class="col s12">
                                        <div class="input-field">
                                            <select class="browser-default" id="membre" name="profil">
                                                <option value="" disabled selected>Producteur</option>
                                            </select>
                                            {{-- <label for="cat_produit">Catégorie Produit</label> --}}
                                        </div>
                                    </div>
                                @endif

                                @if (in_array($_SESSION['role'], ['OP']))
                                    <div class="col s12">
                                        <div class="input-field">

                                            <select class="" id="profil" name="profil">
                                                <option value="" disabled selected>Choisissez le Producteur
                                                </option>
                                                @foreach ($producteurs as $item)
                                                    <option value="{{ $item['id'] }}">{{ $item['prenom'] }}
                                                        {{ $item['nom'] }} {{ $item['localite'] }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            {{-- <label for="profil" class="active">Producteur</label> --}}

                                        </div>
                                    </div>
                                @endif

                                <div class="col s6">
                                    <div class="input-field">
                                        <select class="browser-default" id="cat_produit" name="cat_produit">
                                            <option value="" disabled selected>Catégorie Produit</option>
                                        </select>
                                        {{-- <label for="cat_produit">Catégorie Produit</label> --}}
                                    </div>
                                </div>

                                <div class="col s6">
                                    <div class="input-field">
                                        <select class="browser-default" id="produit" name="produit">
                                            <option value="" disabled selected>--Produit--</option>
                                        </select>
                                        {{-- <label class="active" for="produit">Produit</label> --}}
                                    </div>
                                </div>


                                <div class="col s6">
                                    <div class="input-field">
                                        <select class="browser-default" id="variete" name="variete">
                                            <option value="" disabled selected>--Variété--</option>
                                        </select>
                                        {{-- <label class="active" for="variete">Variété</label> --}}
                                    </div>
                                </div>

                                @if (in_array($_SESSION['role'], ['AUOP', 'UOP', 'OP']))
                                    <div class="col s6">
                                        <div class="input-field">

                                            <select class="" id="sol" name="sol">
                                                <option value="" disabled selected>Choisissez le sol</option>
                                                @foreach ($sols as $item)
                                                    <option value="{{ $item['id'] }}">{{ $item['surface'] }}
                                                        {{ $item['unite'] }} de sol de type {{ $item['type_sol'] }}
                                                        appartenant à {{ $item['prenom'] }} {{ $item['nom'] }} dans
                                                        la
                                                        localité de {{ $item['localite'] }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            {{-- <label for="" class="active">Sol</label> --}}
                                        </div>
                                    </div>
                                @elseif (in_array($_SESSION['role'], ['INDIVIDUEL']))
                                    <div class="col s6">
                                        <div class="input-field">

                                            <select class="" id="sol" name="sol">
                                                <option value="" disabled selected>Choisissez le sol</option>
                                                @foreach ($sols as $item)
                                                    <option value="{{ $item['id'] }}">{{ $item['surface'] }}
                                                        {{ $item['unite'] }} de sol de type {{ $item['type_sol'] }}
                                                         dans
                                                        la
                                                        localité de {{ $item['localite'] }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            {{-- <label for="" class="active">Sol</label> --}}
                                        </div>
                                    </div>
                                @endif
                                <div class="col s6">
                                    <div class="input-field">

                                        <select class="" id="campagne" name="campagne">
                                            <option value="" disabled selected>Choisissez la campagne
                                            </option>
                                            @foreach ($campagnes as $item)
                                                <option value="{{ $item['id'] }}">Du {{ $item['debut'] }} au
                                                    {{ $item['fin'] }}</option>
                                            @endforeach
                                        </select>

                                        {{-- <label for="" class="active">Campagne de production</label> --}}

                                    </div>
                                </div>

                                <div class="col s6">
                                    <div class="input-field">

                                        <label for="quantite" class="active">Quantité produite <span
                                                    class="red-text"> *</span></label>
                                        <input type="number" class="form-control" id="quantite" name="quantite">

                                    </div>
                                </div>

                                <div class="col s6">
                                    <div class="input-field">

                                        <select class="" id="unite" name="unite">
                                            <option value="" disabled selected>Choisissez l'unité</option>
                                            @foreach ($unites as $item)
                                                <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                                            @endforeach
                                        </select>

                                        {{-- <label for="unite" class="active">Unité</label> --}}

                                    </div>
                                </div>



                            </div>

                            <div class="row">
                                <button type="button" id="formAddProductionbtn"
                                    class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#!"
                            class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                    </div>
                </div>
            @endif


            <!-- datatable start -->
            <div class="responsive-table">
                <table id="statsTable" class="table display striped">
                    <thead>
                        <tr>
                            {{-- @if (!in_array($_SESSION['role'], ['INDIVIDUEL', 'OP']))
                                <th>Groupement</th>
                            @endif --}}
                            <th>Produit</th>
                            <th>Variété</th>
                            <th>Quantité</th>
                            @if (!in_array($_SESSION['role'], ['INDIVIDUEL']))
                                <th>Producteur</th>
                            @endif
                            {{-- <th>Campagne</th> --}}
                            {{-- <th>Type de sol</th> --}}
                            <th>Surface</th>
                            <th>Localité</th>

                            @if (in_array($_SESSION['role'], ['AUOP', 'UOP', 'OP', 'ONG', 'ADMIN', 'SUPERADMIN']))
                                <th class="text-center">Actions</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody id="">
                        @isset($productions)
                            @foreach ($productions as $item)
                                <tr>
                                    {{-- @if (!in_array($_SESSION['role'], ['INDIVIDUEL', 'OP']))
                                        <td>
                                            @if (strcmp($item['libelle'], '') == 0)
                                                --
                                            @else
                                                {{ $item['libelle'] }}
                                            @endif
                                        </td>
                                    @endif --}}
                                    <td>{{ $item['produit'] }}</td>
                                    <td>
                                        @if (strcmp($item['variete'], '') == 0)
                                            --
                                        @else
                                            {{ $item['variete'] }}
                                        @endif
                                    </td>
                                    <td>{{ $item['quantite'] }} {{ $item['unite_production'] }}</td>

                                    @if (!in_array($_SESSION['role'], ['INDIVIDUEL']))
                                        <td>{{ $item['prenom'] }} {{ $item['nom'] }}</td>
                                    @endif

                                    {{-- <td>Du {{ $item['debut'] }} au {{ $item['fin'] }}</td> --}}
                                    {{-- <td>{{ $item['type_sol'] }}</td> --}}
                                    <td>{{ $item['surface'] }} {{ $item['unite_surface'] }}</td>
                                    <td>{{ $item['localite'] }}</td>

                                    {{-- @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']) || in_array($_SESSION['id'], [$item['id_profil']])) --}}
                                    {{-- || in_array($_SESSION['groupement'],[$item['id_groupement']])  || in_array($_SESSION['union_groupement'],[$item['id_union_groupement']])  || in_array($_SESSION['AUOP'],[$item['id_AUOP']])) --}}

                                    @if (in_array($_SESSION['role'], ['AUOP', 'UOP', 'OP', 'ONG', 'ADMIN', 'SUPERADMIN']))
                                        <td>
                                            <a href="/productions/modifier/{{ $item['id'] }}">
                                                <i class="material-icons orange-text ">edit</i>
                                            </a>
                                            <a href="#" class="px-1"
                                                onclick="deleteProduction({{ $item['id'] }})">
                                                <i class="material-icons red-text ">delete</i>
                                            </a>
                                        </td>
                                    @endif

                                    {{-- @elseif (in_array)
                                        <td> - </td>
                                    @endif --}}

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
<script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
<script src="{{ asset('assets/js/scripts/extra-components-sweetalert.js') }}"></script>
<script src="{{ asset('assets/js/providers/message.js') }}"></script>

{{-- <script src="{{ asset('assets\js\providers\produits.js') }}"></script> --}}

<script src="{{ asset('assets\js\crud\gestion\productions\message.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\productions\producteur.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\productions\delete.js') }}"></script>
@endsection
