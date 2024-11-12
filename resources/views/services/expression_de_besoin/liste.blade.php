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
    Expressions de Besoin
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/expression-de-besoin">Expressions de Besoin</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text">Liste des Expressions de Besoin</a>
    </li>
@endsection

<section class="users-list-wrapper section">
    <div class="users-list-filter">
        <div class="card-panel">
            <div class="row">

                <form method="POST" action="{{ url('/expression-de-besoin/filter') }}">

                    @csrf

                    <div class="col s12 m6 l4">
                        <label for="grp-list">Groupement</label>
                        <div class="input-field">
                            <select class="form-control" name="grp-list">

                                @if (isset($grp_filter_libelle) && isset($grp_filter_id))

                                    @if (strcmp($grp_filter_libelle, 'null') == 0)
                                        <option value=null>Pas de filtre</option>
                                        @foreach ($groupements as $item)
                                            <option value="{{ $item['id_groupement'] }}">{{ $item['libelle'] }}</option>
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



                                        {{-- <option value={{ $grp_filter_id }}>{{ $grp_filter_libelle }}</option> --}}
                                    @endif
                                @else
                                    <option value=null>Pas de filtre</option>
                                    @foreach ($groupements as $item)
                                        <option value="{{ $item['id_groupement'] }}">{{ $item['libelle'] }}</option>
                                    @endforeach

                                @endif


                            </select>
                        </div>
                    </div>

                    <div class="col s12 m6 l4">
                        <label for="eb-list-type">Type d'Expression de Besoin</label>
                        <div class="input-field">
                            <select class="form-control" name="eb-list-type">

                                @if (isset($type_eb_filter_name) && isset($type_eb_filter_id))

                                    @if (strcmp($type_eb_filter_name, 'null') == 0)
                                        <option value=null>Pas de filtre</option>
                                        @foreach ($type_eb as $item)
                                            <option value="{{ $item['id'] }}">{{ $item['type_eb'] }}</option>
                                        @endforeach
                                    @else
                                        {{-- <option value={{ $type_eb_filter_id }}>{{ $type_eb_filter_name }}</option> --}}

                                        @foreach ($type_eb as $item)
                                            @if ($item['id'] == $type_eb_filter_id)
                                                <option value="{{ $item['id'] }}" selected>{{ $item['type_eb'] }}
                                                </option>
                                            @else
                                                <option value="{{ $item['id'] }}">{{ $item['type_eb'] }}</option>
                                            @endif
                                        @endforeach
                                        <option value=null>Pas de filtre</option>
                                    @endif
                                @else
                                    <option value=null>Pas de filtre</option>
                                    @foreach ($type_eb as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['type_eb'] }}</option>
                                    @endforeach

                                @endif


                            </select>
                        </div>
                    </div>


                    @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']))
                        <div class="col s12 m6 l2">
                            <label for="eb-list-statut">Statut</label>
                            <div class="input-field">
                                <select class="form-control" name="eb-list-statut">

                                    @if (isset($statut))
                                        @if (strcmp($statut, 'null') == 0)
                                            <option value="null" selected>Pas de filtre</option>
                                            <option value=0>Soumis</option>
                                            <option value=1>Validé</option>
                                            <option value=2>Rejeté</option>
                                        @elseif ($statut == 0)
                                            <option value=0 selected>Soumis</option>
                                            <option value=1>Validé</option>
                                            <option value=2>Rejeté</option>
                                            <option value="null">Pas de filtre</option>
                                        @elseif ($statut == 1)
                                            <option value=1 selected>Validé</option>
                                            <option value=0>Soumis</option>
                                            <option value=2>Rejeté</option>
                                            <option value="null">Pas de filtre</option>
                                        @elseif ($statut == 2)
                                            <option value=2 selected>Rejeté</option>
                                            <option value=0>Soumis</option>
                                            <option value=1>Validé</option>
                                            <option value="null">Pas de filtre</option>
                                        @else
                                            <option value="null" selected>Pas de filtre</option>
                                            <option value=0>Soumis</option>
                                            <option value=1>Validé</option>
                                            <option value=2>Rejeté</option>
                                        @endif
                                    @else
                                        <option value="null" selected>Pas de filtre</option>
                                        <option value=0>Soumis</option>
                                        <option value=1>Validé</option>
                                        <option value=2>Rejeté</option>
                                    @endif

                                </select>
                            </div>
                        </div>
                    @endif


                    <div class="col s12 m6 l4">
                        <label for="grp-list">Zone</label>
                        <div class="input-field">
                            <select class="form-control" name="zone-list" id="zone-list">

                                @if (isset($zone_filter_name) && isset($zone_filter_id))

                                    @if (strcmp($zone_filter_name, 'null') == 0)
                                        <option value=null>Pas de filtre</option>
                                        @foreach ($zones as $item)
                                            <option value="{{ $item['id'] }}">{{ $item['designation'] }}</option>
                                        @endforeach
                                    @else
                                        @foreach ($zones as $item)
                                            @if ($item['id'] == $zone_filter_id)
                                                <option value="{{ $item['id'] }}" selected>
                                                    {{ $item['designation'] }}</option>
                                            @else
                                                <option value="{{ $item['id'] }}">{{ $item['designation'] }}
                                                </option>
                                            @endif
                                        @endforeach
                                        <option value=null>Pas de filtre</option>



                                        {{-- <option value={{ $grp_filter_id }}>{{ $grp_filter_libelle }}</option> --}}
                                    @endif
                                @else
                                    <option value=null>Pas de filtre</option>
                                    @foreach ($zones as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['designation'] }}</option>
                                    @endforeach

                                @endif


                            </select>
                        </div>
                    </div>

                    <div class="col s12 m6 l4">
                        <label for="dept-list">Département</label>
                        <div class="input-field">
                            <select class=" browser-default" name="dept-list" id="dept-list">

                                @if (isset($dept_filter_name) && isset($dept_filter_id))

                                    @if (strcmp($dept_filter_name, 'null') == 0)
                                        <option value=null>Pas de filtre</option>
                                        @foreach ($departements as $item)
                                            <option value="{{ $item['id'] }}">{{ $item['departement'] }}</option>
                                        @endforeach
                                    @else
                                        @foreach ($departements as $item)
                                            @if ($item['id'] == $dept_filter_id)
                                                <option value="{{ $item['id'] }}" selected>
                                                    {{ $item['departement'] }}</option>
                                            @else
                                                <option value="{{ $item['id'] }}">{{ $item['departement'] }}
                                                </option>
                                            @endif
                                        @endforeach
                                        <option value=null>Pas de filtre</option>
                                    @endif
                                @else
                                    <option value=null>Pas de filtre</option>
                                    @foreach ($departements as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['departement'] }}</option>
                                    @endforeach

                                @endif


                            </select>
                        </div>
                    </div>


                    @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']))
                        <div class="col s12 m6 l2">
                            <label for="eb-list-etat">État</label>
                            <div class="input-field">
                                <select class="form-control" name="eb-list-etat">

                                    @if (isset($etat))
                                        @if (strcmp($etat, 'null') == 0)
                                            <option value="null" selected>Pas de filtre</option>
                                            <option value=1>Traité</option>
                                            <option value=0>Non Traité</option>
                                        @elseif ($etat == 1)
                                            <option value=1 selected>Traité</option>
                                            <option value=0>Non Traité</option>
                                            <option value="null">Pas de filtre</option>
                                        @elseif ($etat == 0)
                                            <option value=0 selected>Non Traité</option>
                                            <option value=1>Traité</option>
                                            <option value="null">Pas de filtre</option>
                                        @else
                                            <option value="null" selected>Pas de filtre</option>
                                            <option value=1>Traité</option>
                                            <option value=0>Non Traité</option>
                                        @endif
                                    @else
                                        <option value="null" selected>Pas de filtre</option>
                                        <option value=1>Traité</option>
                                        <option value=0>Non Traité</option>
                                    @endif

                                </select>
                            </div>
                        </div>
                    @endif


                    <div class="col s12 m12 l2 display-flex align-items-center show-btn">
                        <button type="submit" class="btn block indigo waves-effect waves-light ml-1"><i
                                class="material-icons">filter_list</i></button>


                    </div>
                </form>

            </div>


        </div>
    </div>


    <div class="row">

        {{-- @if ($_SESSION['role'] == 'ADMIN')
            @if (isset($_SESSION['role_user']))
                @if ($_SESSION['role_user'] == 'MARKCOM') --}}
                    <div>

                        <a type="button" class="waves-effect waves-light  green darken-1 btn modal-trigger right"
                            href="#modal1"><i class="material-icons">add_circle</i>
                            Expression de Besoin</a>

                    </div>
                {{-- @endif
            @else --}}
                {{-- <div>

                    <a type="button" class="waves-effect waves-light  green darken-1 btn modal-trigger right"
                        href="#modal1"><i class="material-icons">add_circle</i>
                        Expression de Besoin</a>

                </div> --}}
            {{-- @endif --}}
        {{-- @else
            <div>

                <a type="button" class="waves-effect waves-light  green darken-1 btn modal-trigger right"
                    href="#modal1"><i class="material-icons">add_circle</i>
                    Expression de Besoin</a>

            </div>
        @endif --}}



    </div>



    <div id="modal1" class="modal modal-lg">
        <div class="modal-content">
            <h4>Nouvelle Expression de Besoin</h4>
            <div class="divider mt-2"></div>

            <form id="formAddEB" action="/expression-de-besoin/store" method="POST">
                @csrf


                <div class="row">

                    <div class="input-field col s6" id="type_eb_div">
                        <select class="select" id="type_eb" name="type_eb">
                            <option value="" disabled selected>Choisissez le type d'Expression de Besoin</option>
                            @foreach ($type_eb as $item)
                                <option value="{{ $item['id'] }}">{{ $item['type_eb'] }}</option>
                            @endforeach
                        </select>
                        {{-- <label class="active" for="type_eb">Type d'Expression de Besoin</label> --}}
                    </div>

                    <div class="input-field col s6" id="offre_div" style="display:none;">
                        <select class="select" id="offre" name="offre">
                            <option value="" disabled selected>Choisissez une Offre Bancaire</option>
                            @foreach ($offres as $item)
                                <option value="{{ $item['id'] }}">Offre comprise entre {{ $item['plancher'] }}
                                    {{ $item['unite'] }} et {{ $item['plafond'] }} {{ $item['unite'] }}

                                    par {{ $item['nom_entite'] }} </option>
                            @endforeach
                        </select>
                        {{-- <label class="active" for="type_eb">Type d'Expression de Besoin</label> --}}
                    </div>


                    <div class="input-field col s6" id="type_intrant_div" style="display:none;">
                        <select class="select" id="type_intrant" name="type_intrant">
                            <option value="" disabled selected>Choisissez le type d'intrant</option>
                            @foreach ($type_intrants as $item)
                                <option value="{{ $item['id'] }}">{{ $item['type_intrant'] }}</option>
                            @endforeach
                        </select>
                        {{-- <label class="active" for="type_intrant">Type </label> --}}
                    </div>


                    <div class="input-field col s12" id="type_engrais_div" style="display:none;">
                        <select class="select" id="type_engrais" name="type_engrais">
                            <option value="" disabled selected>Choisissez le type d'engrais</option>
                            @foreach ($type_engrais as $item)
                                <option value="{{ $item['id'] }}">{{ $item['type_engrais'] }}</option>
                            @endforeach
                        </select>
                        {{-- <label class="active" for="type_intrant">Type </label> --}}
                    </div>




                    {{-- <div class="input-field col s6" style="display:none;" id="formation_div">
                        <select class="select" id="formation" name="formation">
                            <option value="" disabled selected>Choisissez la Formation</option>
                            @foreach ($cours as $item)
                                <option value="{{ $item['id'] }} , {{ $item['displayname'] }}">{{ $item['displayname'] }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="input-field col s6" style="display:none;" id="formation_div">
                        <select class="select" id="formation" name="formation">
                            <option value="" disabled selected>Choisissez la Formation</option>
                            @foreach ($cours as $item)
                                <option value="{{ $item['displayname'] }}">{{ $item['displayname'] }}</option>
                            @endforeach
                        </select>
                        {{-- <label class="active" for="type_eb">Type d'Expression de Besoin</label> --}}
                    </div>

                    <div class="input-field col s6" style="display:none;" id="cat_produit_div">
                        <select class="select browser-default" id="cat_prod" name="cat_produit">
                            <option value="" disabled selected>Catégorie Produit</option>
                        </select>
                        <label class="active" for="cat_produit">Catégorie Produit</label>
                    </div>

                    <div class="input-field col s6" style="display:none;" id="produit_div">
                        <select class="select browser-default" id="prod" name="produit">
                            <option value="" disabled selected>--Produit--</option>
                        </select>
                        <label class="active" for="produit">Produit</label>
                    </div>

                    <div class="input-field col s6" style="display:none;" id="variete_div">
                        <select class="select browser-default" id="variet" name="variete">
                            <option value="" disabled selected>Variété</option>
                        </select>
                        <label class="active" for="variete">Variété</label>
                    </div>

                    <div class="input-field col s6" id="type_semence_div" style="display:none;">
                        <select class="select" id="type_semence" name="type_semence">
                            <option value="" disabled selected>Choisissez le type de semence</option>
                            @foreach ($type_semences as $item)
                                <option value="{{ $item['id'] }}">{{ $item['type_semence'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-field col s6" id="type_assurance_div" style="display:none;">
                        <select class="select" id="type_assurance" name="type_assurance">
                            <option value="" disabled selected>Choisissez le type d'assurance</option>
                            @foreach ($type_assurances as $item)
                                <option value="{{ $item['id'] }}">{{ $item['designation'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-field col s6" style="display:none;" id="cat_produit_engrais_div">
                        <select class="select browser-default" id="cat_prod_engrais" name="cat_produit">
                            <option value="" disabled selected>Catégorie Produit</option>
                        </select>
                        <label class="active" for="cat_produit">Catégorie Produit</label>
                    </div>

                    <div class="input-field col s6" style="display:none;" id="produit_engrais_div">
                        <select class="select browser-default" id="prod_engrais" name="produit">
                            <option value="" disabled selected>--Produit--</option>
                        </select>
                        <label class="active" for="produit">Produit</label>
                    </div>

                    <div class="input-field col s6" style="display:none;" id="variete_engrais_div">
                        <select class="select browser-default" id="variet_engrais" name="variete">
                            <option value="" disabled selected>Variété</option>
                        </select>
                        <label class="active" for="variete">Variété</label>
                    </div>


                    <div class="input-field col s6" style="display:none;" id="formule_engrais_div">
                        <select class="select browser-default" id="formule_engrais" name="formule">
                            <option value="" disabled selected>Formule Engrais</option>
                        </select>
                        <label class="active" for="variete">Formule</label>
                    </div>

                    <div class="input-field col s6" style="display:none;" id="region_pro_div">
                        <select class="select browser-default" id="region_pro" name="region">
                            <option value="" selected>Région de Provenance</option>
                        </select>
                        <label class="active" for="region">Région de Provenance</label>
                    </div>

                    <div class="input-field col s6" style="display:none;" id="dept_pro_div">
                        <select class="select browser-default" id="dept_pro" name="dept">
                            <option value="" selected>Département de Provenance</option>
                        </select>
                        <label class="active" for="dept">Département de Provenance</label>
                    </div>

                    <div class="input-field col s6" style="display:none;" id="commune_pro_div">
                        <select class="select browser-default" id="commune_pro" name="from">
                            <option value="" selected>Commune de Provenance</option>
                        </select>
                        <label class="active" for="commune">Commune de Provenance</label>
                    </div>

                    <div class="input-field col s6" style="display:none;" id="region_dest_div">
                        <select class="select browser-default" id="region_dest" name="region">
                            <option value="" selected>Région de Destination</option>
                        </select>
                        <label class="active" for="region">Région de Destination</label>
                    </div>

                    <div class="input-field col s6" style="display:none;" id="dept_dest_div">
                        <select class="select browser-default" id="dept_dest" name="dept">
                            <option value="" selected>Département de Destination</option>
                        </select>
                        <label class="active" for="dept">Département de Destination</label>
                    </div>

                    <div class="input-field col s6" style="display:none;" id="commune_dest_div">
                        <select class="select browser-default" id="commune_dest" name="to">
                            <option value="" selected>Commune de Destination</option>
                        </select>
                        <label class="active" for="commune">Commune de Destination</label>
                    </div>

                    <div id="description_div" class="input-field col s12" style="display:none;">
                        <input type="text" class="validate" name="description" id="description">
                        <label class="active" for="qte">Description</label>
                    </div>

                    <div class="input-field col s6" style="display:none;" id="montant_div">
                        <input id="montant" type="number" class="validate" name="montant" required>
                        <label class="active" for="montant">Montant</label>
                    </div>
                    <div class="input-field col s6" style="display:none;" id="qte_div">
                        <input id="qte" type="number" class="validate" name="qte" required>
                        <label class="active" for="qte">Quantité</label>
                    </div>

                    <div class="input-field col s6" style="display:none;" id="unite_div">
                        <select class="select browser-default" name="unite" required>
                            <option value="" disabled selected>Unité</option>
                            @foreach ($unites as $item)
                                <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                            @endforeach
                        </select>
                        <label class="active" for="unite">Unité</label>
                    </div>

                    <div class="input-field col s6" style="display:none;" id="unite_monnaie_div">
                        <select class="select browser-default" name="unite" required>
                            <option value="" disabled selected>Unité</option>
                            @foreach ($unite_monnaie as $item)
                                <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                            @endforeach
                        </select>
                        <label class="active" for="unite">Unité</label>
                    </div>

                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <div class="col s12 display-flex justify-content-end mt-1">
                            <button id="formAddEBbtn" type="button"
                                class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">
                                Enregistrer</button>

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

                <div class="col s12 m8 l3 display-flex align-items-center show-btn right">

                </div>

                {{-- @if ($eb != null) --}}
                <div class="responsive-table">
                    <table id="EBTable" class=" table">
                        <thead>
                            <tr>
                                {{-- <th>Groupement</th> --}}
                                <th>Prénom et Nom</th>
                                <th>Description</th>
                                @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']))
                                    <th>Statut</th>
                                    <th>Etat</th>
                                @endif
                                {{-- <th>Etat</th>    --}}
                                <th>Type</th>
                                <th>Date</th>

                                @if (isset($type_eb_filter))
                                    @if (in_array($type_eb_filter, [1, 3]))
                                        <th>Produit</th>
                                        <th>Variété</th>
                                        <th>Quantité</th>
                                    @elseif (in_array($type_eb_filter, [2]))
                                        <th>Montant</th>
                                    @elseif (in_array($type_eb_filter, [4]))
                                        <th>Assurance</th>
                                    @elseif (in_array($type_eb_filter, [11]))
                                        <th>Intitulé du Cours</th>
                                    @elseif (in_array($type_eb_filter, [12]))
                                        <th>Produit</th>
                                        <th>Variété</th>
                                        <th>Quantité</th>
                                        <th>Provenance / Destination</th>
                                    @endif
                                @endif




                                {{-- @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN'])) --}}
                                <th>Actions</th>
                                {{-- @endif   --}}
                            </tr>
                        </thead>
                        <tbody id="">
                            @isset($eb)
                                @foreach ($eb as $item)
                                    <tr>
                                        {{-- <td>
                                            @if (strcmp($item['libelle'], '') == 0)
                                                --
                                            @else
                                                {{ $item['libelle'] }}
                                            @endif
                                        </td> --}}
                                        <td>{{ $item['prenom'] }} {{ $item['nom'] }}</td>
                                        <td>{{ $item['description'] }}</td>
                                        @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']))
                                            @if ($item['statut'] == 0)
                                                <td><a id="{{ $item['id'] }}" href='#' class='statut-eb'><span
                                                            class='chip orange lighten-5'><span class='orange-text'>Soumis</span></span></a></td>
                                            @elseif ($item['statut'] == 1)
                                                <td><a id="{{ $item['id'] }}" href='#'><span
                                                            class='chip green lighten-5'><span
                                                                class='green-text'>Accepté</span></span></a></td>
                                            @else
                                                <td><a id="{{ $item['id'] }}" href='#'><span
                                                            class='chip red lighten-5'><span
                                                                class='red-text'>Rejeté</span></span></a></td>
                                            @endif
                                            @if ($item['etat'] == 0)
                                                <td><a id="{{ $item['id'] }}" href='#' class='traiter-eb'><span
                                                            class='chip red lighten-5'><span class='red-text'>Non
                                                                Traité</span></span></a></td>
                                            @else
                                                <td><a id="{{ $item['id'] }}" href='#' class='non_traiter-eb'><span
                                                            class='chip green lighten-5'><span
                                                                class='green-text'>Traité</span></span></a></td>
                                            @endif
                                        @endif
                                        <td>{{ $item['type_eb'] }}</td>
                                        <td>{{ $item['created_at'] }}</td>

                                        @if (isset($type_eb_filter))
                                            @if (in_array($type_eb_filter, [1, 3]))
                                                <td>{{ $item['produit'] }}</td>
                                                <td>{{ $item['variete'] }}</td>
                                                <td>{{ $item['qte'] }} {{ $item['unite'] }}</td>
                                            @elseif (in_array($type_eb_filter, [2]))
                                                <td>{{ $item['montant'] }} {{ $item['unite'] }}</td>
                                            @elseif (in_array($type_eb_filter, [4]))
                                                <td>{{ $item['type_assurance'] }}</td>
                                            @elseif (in_array($type_eb_filter, [11]))
                                                <td>{{ $item['intitule_formation'] }}</td>
                                            @elseif (in_array($type_eb_filter, [12]))
                                                <td>{{ $item['produit'] }}</td>
                                                <td>{{ $item['variete'] }}</td>
                                                <td>{{ $item['qte'] }} {{ $item['unite'] }}</td>
                                                <td>De {{ $item['commune_from'] }} à {{ $item['commune_to'] }}</td>
                                            @endif
                                        @endif


                                        <td>
                                            <a href="{{ url('expression-de-besoin/details/' . $item['id']) }}">
                                                <i class="material-icons"> visibility </i>
                                            </a>

                                            @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']) || in_array($_SESSION['id'], [$item['id_profil']]))
                                                <a href="#" onclick="deleteEB({{ $item['id'] }})"
                                                    class="px-1">
                                                    <i class="material-icons red-text ">delete</i>
                                                </a>
                                            @endif

                                        </td>


                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                        <tfoot>
                            <tr>
                                {{-- <th>Groupement</th> --}}
                                <th>Prénom et Nom</th>
                                <th>Description</th>
                                @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']))
                                    <th>Statut</th>
                                    <th>Etat</th>
                                @endif
                                {{-- <th>Etat</th>    --}}
                                <th>Type</th>
                                <th>Date</th>

                                @if (isset($type_eb_filter))
                                    @if (in_array($type_eb_filter, [1, 3]))
                                        <th>Produit</th>
                                        <th>Variété</th>
                                        <th>Quantité</th>
                                    @elseif (in_array($type_eb_filter, [2]))
                                        <th>Montant</th>
                                    @elseif (in_array($type_eb_filter, [4]))
                                        <th>Assurance</th>
                                    @elseif (in_array($type_eb_filter, [11]))
                                        <th>Intitulé du Cours</th>
                                    @elseif (in_array($type_eb_filter, [12]))
                                        <th>Produit</th>
                                        <th>Variété</th>
                                        <th>Quantité</th>
                                        <th>Provenance / Destination</th>
                                    @endif
                                @endif




                                {{-- @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN'])) --}}
                                <th>Actions</th>
                                {{-- @endif   --}}
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- datatable ends -->
                {{-- @else
                    <div>
                        <br><br><br>
                        <h4>Aucune EB !

                        </h4>

                    </div>
                @endif --}}
            </div>
        </div>
    </div>
</section>
@endsection

@section('other-js-script')
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->

<script src="{{ asset('assets/js/crud/gestion/eb/message.js') }}"></script>


<script src="{{ asset('assets/js/crud/gestion/eb/produits.js') }}"></script>

<script src="{{ asset('assets/js/crud/gestion/eb/intrants.js') }}"></script>

<script src="{{ asset('assets/js/crud/gestion/eb/localite.js') }}"></script>

<script src="{{ asset('assets/js/crud/gestion/eb/set_eb_state.js') }}"></script>

<script src="{{ asset('assets/js/crud/gestion/eb/engrais.js') }}"></script>

<script src="{{ asset('assets/js/crud/gestion/eb/delete.js') }}"></script>

<script>
    $(document).ready(() => {

        $('#EBTable tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');

        });

        var table = $('#EBTable').DataTable({
            initComplete: function() {
                // Apply the search
                this.api()
                    .columns()
                    .every(function() {
                        var that = this;

                        $('input', this.footer()).on('keyup change clear', function() {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        });
                    });
                var r = $('#EBTable tfoot tr');
                r.find('th').each(function() {
                    $(this).css('padding', 8);
                });
                $('#EBTable thead').append(r);
                $('#search_0').css('text-align', 'center');
            },

            dom: "Bfrtip",
            buttons: ["colvis", "excel", "print"],
            buttons: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],
            ],

        });
    });
</script>
@endsection
