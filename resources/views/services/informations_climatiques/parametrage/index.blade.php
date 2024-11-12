@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">
@endsection
@section('page-title')
    Paramétrage
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/admin">Acceuil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">Paramétrage</a>
    </li>
@endsection
@section('main_content')
{{-- {{ dd($_SESSION)}} --}}

    <section class="users-list-wrapper section">
        <div class="users-list-filter">
            @include('services.informations_climatiques.campagne-meteo.campagne-actif')
        </div>
        <div class="row">
            <div class="col s12">
                <ul class="collapsible collapsible-accordion">
                    @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']) || (isset($_SESSION['role_user']) && in_array($_SESSION['role_user'], ["GESTIONNAIRE BD"])))

                    <li>
                        <div class="collapsible-header"><i class="material-icons">assignment</i> Gérants</div>
                        <div class="collapsible-body">
                            <div class="row col12">

                                    <a class="waves-effect waves-light  green darken-1 btn  right"
                                        href="{{ url('/admin/utilisateurs/create') }}"> <i class="material-icons">add</i>
                                        Nouveau gérant
                                    </a>
                                <!-- Modal Structure -->
                                <div id="modal2" class="modal">
                                    <div class="modal-content">
                                        <h4>Nouveau gerant</h4>
                                        <div class="divider mt-2"></div>
                                        <form id="form-gerant-create" method="POST" action="#">
                                            @csrf
                                            <div class="col s12">
                                                <div class="row">
                                                    <div class="input-field col s6">
                                                        <input id="prenom" type="text" class="validate"
                                                            name="prenom">
                                                        <label class="active" for="prenom">Prénom</label>
                                                    </div>
                                                    <div class="input-field col s6">
                                                        <input id="nom" type="text" class="validate"
                                                            name="nom">
                                                        <label class="active" for="nom">Nom</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s6">
                                                        <div class="row">
                                                            <label>
                                                                <p>
                                                                    <input value="M" name="sexe" type="radio"
                                                                        required />
                                                                    <span>Homme</span>
                                                                </p>
                                                            </label>
                                                        </div>
                                                        <div class="row">
                                                            <label>
                                                                <p>
                                                                    <input value="F" name="sexe" type="radio"
                                                                        required />
                                                                    <span>Femme</span>
                                                                </p>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="input-field col s6">
                                                        <input id="dt_naiss" type="text" class="datepicker"
                                                            name="dtNaiss">
                                                        <label class="active" for="dt_naiss">Date de naissance</label>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="input-field col s6">
                                                        <input id="telephone" type="number" class="validate"
                                                            name="telephone">
                                                        <label class="active" for="telephone">Téléphone</label>
                                                    </div>
                                                    <div class="input-field col s6">
                                                        <input id="email" type="email" class="validate"
                                                            name="email">
                                                        <label class="active" for="email">Email</label>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s6">
                                                        <select class=" browser-default" id="" name="status">
                                                            <option value="" disabled selected>Status</option>
                                                            <option value="0">OUI</option>
                                                            <option value="1">NON</option>
                                                        </select>
                                                        <label class="active" for="pays">Status</label>
                                                    </div>
                                                    <div class="input-field col s6">
                                                        <select class=" browser-default" id="pays" name="pays">
                                                            <option value="" disabled selected>Pays</option>
                                                        </select>
                                                        <label class="active" for="pays">Pays</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s6">
                                                        <select class=" browser-default region" id="region"
                                                            name="region">
                                                            <option value="" disabled selected>--Région--</option>
                                                        </select>
                                                        <label class="active" for="region">Région</label>
                                                    </div>
                                                    <div class="input-field col s6">
                                                        <select class=" browser-default dept" id="dept"
                                                            name="dept">
                                                            <option value="" disabled selected>--Département--
                                                            </option>

                                                        </select>
                                                        <label class="active" for="dept">département</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s6">
                                                        <select class=" browser-default commune" id="commune"
                                                            name="commune">
                                                            <option value="" disabled selected>--Commune--</option>
                                                        </select>
                                                        <label class="active" for="commune">Commune</label>
                                                    </div>
                                                    <div class="input-field col s6">
                                                        <select class=" browser-default localite" id="localite"
                                                            name="localite">
                                                            <option value="" disabled>--Localité--</option>
                                                        </select>
                                                        <label class="active" for="localite">Localité</label>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    {{-- {{dd($reseaux)}} --}}
                                                    <div class="input-field col s6">
                                                        <select class="select-gerant browser-default" id="reseau-gerant"
                                                            name="reseau">
                                                            <option value="" disabled selected>Choisissez le reseau
                                                            </option>
                                                            @foreach ($reseaux as $reseau)
                                                                <option value="{{ $reseau->id_groupement }}">
                                                                    {{ $reseau->libelle }}</option>
                                                            @endforeach
                                                        </select>
                                                        <label class="active" for="users-list-status">Reseau</label>
                                                    </div>
                                                    <div class="input-field col s6">
                                                        <select class="select-gerant browser-default " id="pluvio"
                                                            name="pluvio">
                                                            <option value="" disabled selected>Choisissez le pluvio</option>
                                                            {{-- @foreach ($pluvios as $pluvio)
                                                                        <option value="{{ $pluvio->id }}">{{ $pluvio->localite }}</option>
                                                                    @endforeach --}}
                                                        </select>
                                                        <label class="active" for="users-list-status">Pluvio</label>
                                                    </div>

                                                </div>


                                                <div class="row">
                                                    <a id="btn-gerant-create"
                                                        class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</a>
                                                </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#!"
                                            class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                                    </div>
                                </div>
                            </div>
                            {{-- <div>{{print_r($pluvios)}}</div> --}}
                            <table id="" class="table striped paramtables">
                                <thead>
                                    <tr>
                                        {{-- <th>id</th> --}}
                                        <th>Prénom</th>
                                        <th>Nom</th>
                                        <th>Téléphone</th>
                                        <th>Reseau</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody id="">

                                    @foreach ($pluvios as $pluvio)
                                            <tr>
                                                @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']))
                                                    <td>{{ $pluvio->prenom }}</td>
                                                    <td>{{ $pluvio->nom }}</td>
                                                    <td>{{ $pluvio->telephone }}</td>
                                                    <td>{{ $pluvio->libelle }}</td>
                                                    <td>
                                                        <a href='{{ url('/admin/utilisateurs/edit/' . $pluvio->utilisateur) }}'
                                                            {{-- id="{{$pluvio->id_profil}}" --}} class=''>
                                                            <span class='chip yellow lighten-5'>
                                                                <span class='yellow-text'>Modifier</span>
                                                            </span>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href='#' id="{{ $pluvio->id_profil }}"
                                                            class='inactif btn-delete-pluvio'>
                                                            <span class='chip red lighten-5'>
                                                                <span class='red-text'>Supprimer</span>
                                                            </span>
                                                        </a>
                                                    </td>
                                                {{-- @endif --}}
                                                @elseif (isset($_SESSION['role_user']) && in_array($_SESSION['role_user'], ["GESTIONNAIRE BD", "RESPONSABLE OP"]))
                                                    @if (isset($pluvio->libelle) && isset($_SESSION['nomGroupement']) && $pluvio->libelle === $_SESSION['nomGroupement'])

                                                        <td>{{ $pluvio->prenom }}</td>
                                                        <td>{{ $pluvio->nom }}</td>
                                                        <td>{{ $pluvio->libelle }}</td>
                                                        @if(in_array($_SESSION['role_user'], ["GESTIONNAIRE BD"]))
                                                            <td>
                                                                <a href='{{ url('/admin/utilisateurs/edit/' . $pluvio->utilisateur) }}'
                                                                    {{-- id="{{$pluvio->id_profil}}" --}} class=''>
                                                                    <span class='chip yellow lighten-5'>
                                                                        <span class='yellow-text'>Modifier</span>
                                                                    </span>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href='#' id="{{ $pluvio->id_profil }}"
                                                                    class='inactif btn-delete-pluvio'>
                                                                    <span class='chip red lighten-5'>
                                                                        <span class='red-text'>Supprimer</span>
                                                                    </span>
                                                                </a>
                                                            </td>

                                                        @elseif(in_array($_SESSION['role_user'], ["RESPONSABLE OP"]))
                                                            <td>---</td>
                                                            <td>---</td>
                                                        @endif

                                                    @else
                                                    @endif
                                                </tr>
                                            @endif
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    {{-- <tr> --}}
                                        <th>Prénom</th>
                                        <th>Nom</th>
                                        <th>Téléphone</th>
                                        <th>Reseau</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    {{-- </tr> --}}

                                </tfoot>
                            </table>
                            @include('services.informations_climatiques.parametrage.gerant.edit')


                        </div>
                    </li>
                    @endif

                    <li>
                        <div class="collapsible-header"><i class="material-icons">opacity</i>Pluvio</div>
                        <div class="collapsible-body">
                            <div class="row col19">

                                <a class="waves-effect waves-light  green darken-1 btn modal-trigger right"
                                    href="#modal-pluvio">
                                    <i class="material-icons">add</i> Nouveau pluvio
                                </a>
                                <!-- Modal Structure -->
                                <div id="modal-pluvio" class="modal">
                                    <div class="modal-content">
                                        <h4>Nouveau pluvio</h4>
                                        <div class="divider mt-2"></div>
                                        <form id="form-pluvio-create" method="POST" action="#">
                                            @csrf
                                            <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        {{-- {{print_r($regions)}} --}}
                                                        <select class="select-pluvio browser-default region"
                                                            id="region" name="date">
                                                            <option value="" disabled selected>Choisissez la région
                                                            </option>
                                                            {{-- <option value="24651"  >Dakar</option> --}}

                                                            @foreach ($regions as $region)
                                                                <option value="{{ $region->id }}">{{ $region->region }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <select class="select-pluvio browser-default dept" id="dept"
                                                            name="departement">
                                                            <option value="" disabled selected>Choisissez le département</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <select class="select-pluvio browser-default commune"
                                                            id="commune" name="commune">
                                                            <option value="" disabled selected>Choisissez la Commune
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <select class="select-pluvio browser-default localite"
                                                            id="localite" name="localite">
                                                            <option value="" disabled selected>Choisissez la localité</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <select class="select-pluvio browser-default" id="reseau"
                                                            name="reseau">
                                                            <option value="" disabled selected>Choisissez le réseau</option>
                                                            @foreach ($reseaux as $reseau)
                                                                <option value="{{ $reseau->id_groupement }}">{{ $reseau->libelle }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        {{-- {{dd($users)}} --}}
                                                        <select class="select-pluvio browser-default" id="gerant"
                                                            name="gerant">
                                                            <option value="" disabled selected>Choisissez le gérant</option>
                                                            @foreach ($users as $user)
                                                                @if (in_array($user->nom_typentite, ['GERANT', 'MLOUMER']))

                                                                    <option value="{{ $user->id_profil }}">
                                                                        {{ $user->nom_typentite.' '.$user->nom . ' ' . $user->prenom }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
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
                                                <a id="btn-pluvio-create" class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#!"
                                            class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                                    </div>
                                </div>
                                <div class="row l12">
                                    <table id="" class="table striped data-table">
                                        <thead>
                                            <tr>
                                                <th>Gérant</th>
                                                <th>Réseau</th>
                                                <th>Région</th>
                                                <th>Département</th>
                                                <th>Commune</th>
                                                <th>Localité</th>
                                                <th>Modifier</th>
                                                <th>Supprimer</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            @foreach ($pluvios as $pluvio)
                                                @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']))
                                                    <tr>
                                                        <td>{{ $pluvio->nom || $pluvio->prenom ? $pluvio->nom . ' ' . $pluvio->prenom : '---' }}</td>
                                                        <td>{{ $pluvio->libelle }}</td>
							                            <td>{{ $pluvio->region }}</td>
                                                        <td>{{ $pluvio->departement }}</td>
							                            <td>{{ $pluvio->commune }}</td>
                                                        <td>{{ $pluvio->localite }}</td>
                                                        <td>
                                                            <a href='#modal-edit-pluvio' id="{{ $pluvio->id }}"
                                                                class='inactif modal-trigger  edit-pluvio'>
                                                                <span class='chip yellow lighten-5'><span
                                                                        class='yellow-text'>Modifier</span></span>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href='#' id="{{ $pluvio->id }}"
                                                                class='inactif btn-delete-pluvio'>
                                                                <span class='chip red lighten-5'><span
                                                                        class='red-text'>Supprimer</span></span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @elseif (isset($_SESSION['role_user']) && in_array($_SESSION['role_user'], ["GESTIONNAIRE BD", "RESPONSABLE OP"]))
                                                    @if (isset($pluvio->libelle) && isset($_SESSION['nomGroupement']) && $pluvio->libelle === $_SESSION['nomGroupement'])
                                                        <tr>
                                                            <td>{{ $pluvio->nom || $pluvio->prenom ? $pluvio->nom . ' ' . $pluvio->prenom : '---' }}</td>
                                                            <td>{{ $pluvio->libelle }}</td>
                                                            <td>{{ $pluvio->region }}</td>
                                                            <td>{{ $pluvio->departement }}</td>
                                                            <td>{{ $pluvio->commune }}</td>
                                                            <td>{{ $pluvio->localite }}</td>
                                                            <td>
                                                                <a href='#modal-edit-pluvio' id="{{ $pluvio->id }}"
                                                                    class='inactif modal-trigger  edit-pluvio'>
                                                                    <span class='chip yellow lighten-5'><span
                                                                            class='yellow-text'>Modifier</span></span>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href='#' id="{{ $pluvio->id }}"
                                                                    class='inactif btn-delete-pluvio'>
                                                                    <span class='chip red lighten-5'><span
                                                                            class='red-text'>Supprimer</span></span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @elseif (in_array($_SESSION['role'], ["ONG"]))
                                                    <tr>
                                                        @if ($pluvio->nom_entite_grp != null && $_SESSION['nom_entite'] === $pluvio->nom_entite_grp)
                                                            <td>{{ $pluvio->nom || $pluvio->prenom ? $pluvio->nom . ' ' . $pluvio->prenom : '---' }}</td>
                                                            <td>{{ $pluvio->libelle }}</td>
                                                            <td>{{ $pluvio->region }}</td>
                                                            <td>{{ $pluvio->departement }}</td>
                                                            <td>{{ $pluvio->commune }}</td>
                                                            <td>{{ $pluvio->localite }}</td>
                                                            <td>
                                                                <a href='#modal-edit-pluvio' id="{{ $pluvio->id }}"
                                                                    class='inactif modal-trigger  edit-pluvio'>
                                                                    <span class='chip yellow lighten-5'><span
                                                                            class='yellow-text'>Modifier</span></span>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href='#' id="{{ $pluvio->id }}"
                                                                    class='inactif btn-delete-pluvio'>
                                                                    <span class='chip red lighten-5'><span
                                                                            class='red-text'>Supprimer</span></span>
                                                                </a>
                                                            </td>
                                                        @else
                                                        @endif
                                                    </tr>
                                                @endif

                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Gérant</th>
                                                <th>Réseau</th>
                                                <th>Région</th>
                                                <th>Département</th>
                                                <th>Commune</th>
                                                <th>Localité</th>
                                                <th>Modifier</th>
                                                <th>Supprimer</th>
                                            </tr>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            @include('services.informations_climatiques.parametrage.pluvio.edit')

                        </div>

                    </li>
                    @if (in_array($_SESSION['role'],["ADMIN","SUPERADMIN"]))

                        <li>
                            <div class="collapsible-header"><i class="material-icons">accessibility</i> Transverseaux
                            </div>
                            <div class="collapsible-body">

                                {{-- CONTAIN --}}

                                <div class="row col12">
                                    <a class="waves-effect waves-light  green darken-1 btn modal-trigger right"
                                        href="#modal-transversal"> <i class="material-icons">add</i> Nouveau transversal
                                    </a>
                                    <a class="waves-effect waves-light  green darken-1 btn modal-trigger right mr-1"
                                        href="#modal-lot-transversaux"> <i class="material-icons">add</i> Nouvelle liste de
                                        transversaux
                                    </a>
                                    <div id="modal-lot-transversaux" class="modal">
                                        <div class="modal-content">
                                            <h4>Nouvelle liste de transversaux</h4>
                                            <div class="divider mt-2"></div>
                                            <form id="form-create-transversal-list" method="POST" action="#">
                                                @csrf
                                                <div class="row">
                                                    <div class="col s12 m6 l6">
                                                        <div class="input-field">
                                                            <select class="browser-default region" id="pluvio"
                                                                name="pluvio">
                                                                <option value="" disabled selected>Choisissez le région
                                                                </option>
                                                                @foreach ($regions as $region)
                                                                    <option value="{{ $region->id }}">{{ $region->region }}</option>
                                                                @endforeach
                                                            </select>
                                                            <label class="active" for="users-list-status">Région</label>
                                                        </div>
                                                    </div>
                                                    <div class="col s12 m6 l6">
                                                        <div class="input-field">
                                                            <select class="browser-default dept" id="date" name="date">
                                                                <option value="" disabled selected>Choisissez le département</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col s12 m6 l6">
                                                        <div class="input-field">
                                                            <select class="browser-default commune" id="pluvio"
                                                                name="pluvio">
                                                                <option value="" disabled selected>Choisissez le commune
                                                                </option>

                                                            </select>
                                                            <label class="active" for="users-list-status">Commune</label>
                                                        </div>
                                                    </div>
                                                    <div class="col s12 m6 l6">
                                                        <div class="input-field">
                                                            <select class=" browser-default localite" id="localite"
                                                                name="localite">
                                                                <option value="" disabled selected>Choisissez la localité
                                                                </option>
                                                                <option value="">Localité 1</option>
                                                            </select>
                                                            <label class="active" for="users-list-status">Localité</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col s12 m6 l6">
                                                        <div class="input-field">
                                                            <select class=" browser-default" id="pluvio" name="pluvio">
                                                                <option value="" disabled selected>Choisissez le réseau
                                                                </option>
                                                                @foreach ($pluvios as $pluvio)
                                                                    <option value="{{ $pluvio->id }}">
                                                                        {{ $pluvio->localite }}</option>
                                                                @endforeach
                                                            </select>
                                                            <label class="active" for="users-list-status">Pluvio</label>
                                                        </div>
                                                    </div>
                                                    <div class="col s12 m6 l6">
                                                        <div class="file-field input-field">
                                                            <div class="btn">
                                                                <span>Fichier</span>
                                                                <input type="file" name="tlist">
                                                            </div>
                                                            <div class="file-path-wrapper">
                                                                <input class="file-path validate" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col s12 m6 l12">
                                                        <a href=" {{ asset('assets/modelsListe/model_gerant.xlsx') }}"
                                                            class=" waves-effect waves-green btn-flat"><span>Télécharger le
                                                                modéle</span><i class="material-icons">file_download</i></a>

                                                        <a id="new-transversal-list"
                                                            class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</a>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">

                                            <a href="#!"
                                                class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                                        </div>
                                    </div>
                                    <!-- Modal Structure -->
                                    <div id="modal-transversal" class="modal">
                                        <div class="modal-content">
                                            <h4>Nouveau Transversal</h4>
                                            <div class="divider mt-2"></div>
                                            <form id="form-create-transversal" method="POST" action="#">
                                                @csrf
                                                <div class="row">
                                                    <div class="col s12 m6 l6">
                                                        <div class="input-field">
                                                            <select class="select-transversal browser-default" id=""
                                                                name="profil">
                                                                <option value="" disabled selected>Choisissez le
                                                                    producteur</option>
                                                                @foreach ($users as $user)
                                                                    @if ($user->nom_typentite === 'PRODUCTEUR' || $user->nom_typentite === 'INDIVIDUEL')
                                                                        <option value="{{ $user->id_profil }}">
                                                                            {{ $user->nom . ' ' . $user->prenom .' '.$user->nom_typentite}}</option>
                                                                    @endif
                                                                @endforeach

                                                            </select>
                                                            <label class="active" for="users-list-status">Producteur</label>
                                                        </div>
                                                    </div>
                                                    <div class="col s12 m6 l6">
                                                        <div class="input-field">
                                                            <select class="select-multitransversal browser-default"
                                                                multiple="multiple" id="pluvio" name="pluvio[]">
                                                                {{-- <option value="" disabled selected>Choisissez le pluvio</option> --}}
                                                                @foreach ($pluvios as $pluvio)
                                                                    <option value="{{ $pluvio->id }}">
                                                                        {{ $pluvio->localite }}</option>
                                                                @endforeach
                                                            </select>
                                                            <label class="active" for="users-list-status">Pluvio</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <a id="btn-create-transversal"
                                                        class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</a>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#!"
                                                class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                                        </div>
                                    </div>
                                </div>
                                <table id="data-table-trans" class="table">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>pluvio</th>
                                            <th>Etat</th>
                                            <th>Modifier</th>
                                            {{-- <th>Supprimer</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        @foreach ($transversaux as $transversal)
                                            <tr>
                                                <td>{{ $transversal->nom . ' ' . $transversal->prenom }}</td>
                                                <td>{{ $transversal->localite }}</td>
                                                {{-- <td>{{$transversal->actif}}</td> --}}
                                                @if ($transversal->actif == 1)
                                                    <td>
                                                        <a href='#' id='{{ $transversal->id }}'
                                                            class='active-transversal'>
                                                            <span class='chip green lighten-5'><span
                                                                    class='green-text'>Actif</span></span>
                                                        </a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a href='#' id='{{ $transversal->id }}'
                                                            class='inactive-transversal'>
                                                            <span class='chip red lighten-5'><span
                                                                    class='red-text'>Inactif</span></span>
                                                        </a>
                                                    </td>
                                                @endif
                                                <td>
                                                    <a href='#modal-edit-transversal' id='{{ $transversal->id }}'
                                                        class='edit-transversal modal-trigger'>
                                                        <span class='chip yellow lighten-5'><span
                                                                class='yellow-text'>Modifier</span></span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @include('services.informations_climatiques.parametrage.transversal.edit')

                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        {{-- </div>
        </div>
    </div> --}}

    </section>
@endsection
@section('other-js-script')
    {{-- <script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script> --}}
    <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/extra-components-sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/providers/message.js') }}"></script>
    <script src="{{ asset('assets/js/providers/set_state.js') }}"></script>


    <script>
        $(document).ready(() => {
            // alert('work');
            $('.paramtables tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');

            });

            var table = $('.paramtables').DataTable({
                dom: "Bfrtip",
                buttons: ["colvis", "excel", "print"],
                stateSave: true,
                buttons: true,
                language: {
                    decimal: "",
                    emptyTable: "Pas de données trouvées",
                    info: "_START_ à _END_ sur _TOTAL_ entrees",
                    infoEmpty: "0 sur 0 entrees",
                    infoFiltered: "(filtered from _MAX_ total entries)",
                    infoPostFix: "",
                    thousands: ",",
                    // lengthMenu: "liste _MENU_ entrees",
                    loadingRecords: "Chargement...",
                    processing: "",
                    search: "Recherche:",
                    zeroRecords: "No matching records found",
                    paginate: {
                        first: "Premier",
                        last: "Dernier",
                        next: "Suivant",
                        previous: "Précédent",
                    },
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending",
                    },
                },
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

                    var r = $('.paramtables tfoot th');
                    r.find('th').each(function() {
                        $(this).css('padding', 8);
                    });
                    $('.paramtables thead').append(r);
                    $('#search_0').css('text-align', 'center');
                },
            });

            var table = $('#data-table-trans').DataTable({
                dom: "Bfrtip",
                buttons: ["colvis", "excel", "print"],
                stateSave: true,
                buttons: true,
                language: {
                    decimal: "",
                    emptyTable: "Pas de données trouvées",
                    info: "_START_ à _END_ sur _TOTAL_ entrees",
                    infoEmpty: "0 sur 0 entrees",
                    infoFiltered: "(filtered from _MAX_ total entries)",
                    infoPostFix: "",
                    thousands: ",",
                    // lengthMenu: "liste _MENU_ entrees",
                    loadingRecords: "Chargement...",
                    processing: "",
                    search: "Recherche:",
                    zeroRecords: "No matching records found",
                    paginate: {
                        first: "Premier",
                        last: "Dernier",
                        next: "Suivant",
                        previous: "Précédent",
                    },
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending",
                    },
                }
            });
        });



        // $("#p-select2").select2({
        //     /* the following code is used to disable x-scrollbar when click in select input and
        //     take 100% width in responsive also */
        //     dropdownAutoWidth: true,
        //     width: '100%',
        //     dropdownParent: '#modal-transversal'
        // });
    </script>
@endsection
