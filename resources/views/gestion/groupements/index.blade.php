@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">
@endsection
@section('page-title')
    Groupements
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="groupements">Groupements</a>
    </li>

    <li class="breadcrumb-item">
        <a class="yellow-text">Liste des Groupements</a>
    </li>
@endsection
@section('main_content')
    <section class="users-list-wrapper section">


        <div class="row" style="padding-top: 7%">
            <div class="col s12">
                <ul class="collapsible collapsible-accordion">
                    @if (!in_array($_SESSION['role'], ['AUOP', 'UOP']))
                        <li>
                            <div class="collapsible-header"><i class="material-icons">group</i>

                                <a href="" class='chip red lighten-5'>
                                    <span class=''>
                                        <span class='red-text'>{{ $nb_auop }}
                                        </span>
                                    </span>
                                </a> Association d'Unions de Groupements / AUOP

                            </div>

                            <div class="collapsible-body">
                                <div class="row col12">
                                    @if ($_SESSION['role'] != 'SUPERVISEUR')
                                        <a class="waves-effect waves-light  green darken-1 btn modal-trigger right"
                                            href="#modal1">
                                            <i class="material-icons">add</i> Nouvelle AUOP
                                        </a>
                                    @endif
                                    <!-- Modal Structure -->
                                    <div id="modal1" class="modal">
                                        <div class="modal-content">
                                            <h4>Nouvelle AUOP</h4>
                                            <div class="divider mt-2"></div>
                                            <form method="POST" action="/auop/store" id="add_op"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col s6">
                                                        <div class="input-field">
                                                            <input id="libelle1" type="text" class="validate"
                                                                name="libelle" required>
                                                            <label class="active" for="libelle">Nom</label>
                                                        </div>
                                                    </div>
                                                    <div class="col s6">
                                                        <div class="input-field">
                                                            <input id="date_creation1" type="text" class="datepicker"
                                                                name="date_creation">
                                                            <label class="active" for="date_creation">Date de
                                                                Création</label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col s12">
                                                        <div class="input-field">
                                                            <input id="description1" type="text" class="validate"
                                                                name="description">
                                                            <label class="active" for="description">Description</label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="input-field col s6">
                                                        <select class="select2insidemodal1 browser-default" id="pays1"
                                                            name="pays">
                                                            <option value="" disabled selected>Pays</option>
                                                        </select>
                                                        <label class="active" for="pays">Pays</label>
                                                    </div>
                                                    <div class="input-field col s6">
                                                        <select class="select2insidemodal1 browser-default" id="region1"
                                                            name="region">
                                                            <option value="" disabled selected>--Région--</option>
                                                        </select>
                                                        <label class="active" for="region">Région</label>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="input-field col s6">
                                                        <select class="select2insidemodal1 browser-default" id="dept1"
                                                            name="dept">
                                                            <option value="" disabled selected>Département</option>
                                                        </select>
                                                        <label class="active" for="dept">Département</label>
                                                    </div>
                                                    <div class="input-field col s6">
                                                        <select class="select2insidemodal1 browser-default" id="commune1"
                                                            name="commune">
                                                            <option value="" disabled selected>--Commune--</option>
                                                        </select>
                                                        <label class="active" for="commune">Commune</label>
                                                    </div>
                                                </div>



                                                <div class="row">
                                                    <div class="col s6">

                                                        <div class="input-field">
                                                            <select class="select2insidemodal1 browser-default"
                                                                id="localite1" name="localite">
                                                                <option value="" disabled selected>Localité</option>
                                                            </select>
                                                            <label class="active" for="localite1">Localité</label>
                                                        </div>

                                                    </div>

                                                    <div class="col s6">
                                                        <div class="file-field input-field">
                                                            <div class="btn">
                                                                <span>Ninéa</span>
                                                                <input type="file" name="ninea" id="ninea1"
                                                                    accept=".pdf, .doc, .docx">
                                                            </div>
                                                            <div class="file-path-wrapper">
                                                                <input class="file-path" name="ninea_name"
                                                                    type="text">
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="row">


                                                    @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']))
                                                        <div class="col s6">
                                                            <div class="input-field">

                                                                <select class="select2insidemodal1 browser-default"
                                                                    id="entite1" name="entite">
                                                                    <option value="" disabled selected>Choisissez
                                                                        l'ONG</option>
                                                                    @foreach ($ong as $item)
                                                                        <option value="{{ $item['id_entite'] }}">
                                                                            {{ $item['nom_entite'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endif

                                                </div>


                                                <div class="row">
                                                    <button type="button" id="create_op"
                                                        class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#!"
                                                class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="responsive-table">
                                    <table id="data-table-simple" class="table"> --}}
                                <table id="opTable" class="table">
                                    <thead>

                                        <tr>
                                            <th>Libellé</th>
                                            {{-- <th>Date de Création</th> --}}
                                            <th>Localité</th>
                                            {{-- <th>Description</th> --}}
                                            <th>Ninéa</th>

                                            @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']))
                                                <th>ONG</th>
                                            @endif

                                            <th class="text-center">Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        @isset($auop)
                                            @foreach ($auop as $item)
                                                <tr>
                                                    <td>{{ $item['libelle'] }}</td>
                                                    {{-- <td>{{ $item['date_creation'] }}</td> --}}
                                                    <td>{{ $item['localite'] }}</td>
                                                    {{-- <td>
                                                            @if (strcmp($item['description'], '') == 0)
                                                                -
                                                            @else
                                                                {{ $item['description'] }}
                                                            @endif
                                                        </td> --}}

                                                    <td>

                                                        @if (strcmp($item['ninea'], '') == 0)
                                                            -
                                                        @else
                                                            <a href="{{ asset('storage/' . $item['ninea']) }}"
                                                                target="_blank">
                                                                <i class="material-icons blue-text ">file_download</i>
                                                            </a>
                                                        @endif


                                                    </td>

                                                    @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']))
                                                        {{-- <td>{{ $item['nom_entite'] }}</td> --}}
                                                        <td>

                                                            @if (strcmp($item['nom_entite'], '') == 0)
                                                                -
                                                            @else
                                                                {{ $item['nom_entite'] }}
                                                            @endif


                                                        </td>
                                                    @endif


                                                    <td>
                                                        <a href="/auop/modifier/{{ $item['id_auop'] }}">
                                                            <i class="material-icons orange-text ">edit</i>
                                                        </a>
                                                        <a href="#" class="px-1"
                                                            onclick="deleteAUOP({{ $item['id_auop'] }})">
                                                            <i class="material-icons red-text ">delete</i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                                {{-- </div> --}}
                            </div>


                        </li>
                    @endif
                    @if (!in_array($_SESSION['role'], ['UOP']))
                        <li>
                            <div class="collapsible-header"><i class="material-icons">group</i>

                                <a href="" class='chip red lighten-5'>
                                    <span class=''>
                                        <span class='red-text'>{{ $nb_uop }}
                                        </span>
                                    </span>
                                </a> Unions de Groupements / UOP

                            </div>
                            <div class="collapsible-body">
                                <div class="row col12">
                                    @if ($_SESSION['role'] != 'SUPERVISEUR')
                                        <a class="waves-effect waves-light  green darken-1 btn modal-trigger right"
                                            href="#modal2"> <i class="material-icons">add</i> Nouvelle Union de
                                            Groupements
                                        </a>
                                    @endif
                                    <div id="modal2" class="modal">
                                        <div class="modal-content">
                                            <h4> Nouvelle Union de Groupements</h4>
                                            <div class="divider mt-2"></div>
                                            <form method="POST" action="/union_groupements/store" id="add_union_grp"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col s6">
                                                        <div class="input-field">
                                                            <input id="libelle2" type="text" class="validate"
                                                                name="libelle" required>
                                                            <label class="active" for="libelle">Nom</label>
                                                        </div>
                                                    </div>

                                                    <div class="col s6">
                                                        <div class="input-field">
                                                            <input id="date_creation2" type="text" class="datepicker"
                                                                name="date_creation">
                                                            <label class="active" for="date_creation">Date de
                                                                Création</label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col s12">
                                                        <div class="input-field">
                                                            <input id="description2" type="text" class="validate"
                                                                name="description">
                                                            <label class="active" for="description">Description</label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']))
                                                        <div class="col s6">
                                                            <div class="input-field">

                                                                <select class="select2insidemodal2 browser-default"
                                                                    id="entite2" name="entite">
                                                                    <option value="" disabled selected>Choisissez
                                                                        l'ONG</option>
                                                                    @foreach ($ong as $item)
                                                                        <option value="{{ $item['id_entite'] }}">
                                                                            {{ $item['nom_entite'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col s6">
                                                            <div class="input-field">

                                                                <select class="select2insidemodal2 browser-default"
                                                                    id="OP2" name="AUOP">
                                                                    <option value="" disabled selected>Choisissez
                                                                        l'AUOP
                                                                    </option>
                                                                    @foreach ($auop as $item)
                                                                        <option value="{{ $item['id_auop'] }}">
                                                                            {{ $item['libelle'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                                {{-- <label for="AUOP" class="col-form-label">AUOP</label> --}}
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="col s12">
                                                            <div class="input-field">

                                                                <select class="select2insidemodal2 browser-default"
                                                                    id="OP2" name="AUOP">
                                                                    <option value="" disabled selected>Choisissez
                                                                        l'AUOP
                                                                    </option>
                                                                    @foreach ($auop as $item)
                                                                        <option value="{{ $item['id_auop'] }}">
                                                                            {{ $item['libelle'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                                {{-- <label for="AUOP" class="col-form-label">AUOP</label> --}}
                                                            </div>
                                                        </div>
                                                    @endif

                                                </div>


                                                <div class="row">

                                                    <div class="input-field col s6">
                                                        <select class="select2insidemodal2 browser-default" id="pays2"
                                                            name="pays">
                                                            <option value="" disabled selected>Pays</option>
                                                        </select>
                                                        <label class="active" for="pays">Pays</label>
                                                    </div>

                                                    <div class="input-field col s6">
                                                        <select class="select2insidemodal2 browser-default" id="region2"
                                                            name="region">
                                                            <option value="" disabled selected>--Région--</option>
                                                        </select>
                                                        <label class="active" for="region">Région</label>
                                                    </div>

                                                </div>


                                                <div class="row">

                                                    <div class="input-field col s6">
                                                        <select class="select2insidemodal2 browser-default" id="dept2"
                                                            name="dept">
                                                            <option value="" disabled selected>Département</option>
                                                        </select>
                                                        <label class="active" for="dept">Département</label>
                                                    </div>

                                                    <div class="input-field col s6">
                                                        <select class="select2insidemodal2 browser-default" id="commune2"
                                                            name="commune">
                                                            <option value="" disabled selected>--Commune--</option>
                                                        </select>
                                                        <label class="active" for="commune">Commune</label>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col s6">
                                                        <div class="input-field">
                                                            <select class="select2insidemodal2 browser-default"
                                                                id="localite2" name="localite">
                                                                <option value="" disabled selected>Localité</option>
                                                            </select>
                                                            <label class="active" for="localite2">Localité</label>
                                                        </div>
                                                    </div>

                                                    <div class="col s6">
                                                        <div class="file-field input-field">
                                                            <div class="btn">
                                                                <span>Ninéa</span>
                                                                <input type="file" name="ninea" id="ninea2"
                                                                    accept=".pdf, .doc, .docx">
                                                            </div>
                                                            <div class="file-path-wrapper">
                                                                <input class="file-path" name="ninea_name"
                                                                    type="text">
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>



                                                <div class="row">
                                                    <button type="button" id="create_union_grp"
                                                        class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#!"
                                                class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="responsive-table">
                                    <table id="data-table-simple" class="table"> --}}
                                <table id="union_grp_Table" class="table">
                                    <thead>
                                        <tr>
                                            <th>Libellé</th>
                                            {{-- <th>Date de Création</th> --}}
                                            <th>Localité</th>
                                            {{-- <th>Description</th> --}}
                                            <th>Ninéa</th>
                                            <th>AUOP</th>

                                            @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']))
                                                <th>ONG</th>
                                            @endif

                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>


                                    <tbody id="">
                                        @isset($union_groupements)
                                            @foreach ($union_groupements as $item)
                                                <tr>
                                                    <td>{{ $item['libelle'] }}</td>
                                                    {{-- <td>{{ $item['date_creation'] }}</td> --}}
                                                    <td>{{ $item['localite'] }}</td>
                                                    {{-- <td>
                                                        @if (strcmp($item['description'], '') == 0)
                                                            -
                                                        @else
                                                            {{ $item['description'] }}
                                                        @endif
                                                    </td> --}}

                                                    <td>

                                                        @if (strcmp($item['ninea'], '') == 0)
                                                            -
                                                        @else
                                                            <a href="{{ asset('storage/' . $item['ninea']) }}"
                                                                target="_blank">
                                                                <i class="material-icons blue-text ">file_download</i>
                                                            </a>
                                                        @endif


                                                    </td>

                                                    <td>
                                                        @if (strcmp($item['nom_AUOP'], '') == 0)
                                                            -
                                                        @else
                                                            {{ $item['nom_AUOP'] }}
                                                        @endif
                                                    </td>

                                                    @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']))
                                                        <td>

                                                            @if (strcmp($item['nom_entite'], '') == 0)
                                                                -
                                                            @else
                                                                {{ $item['nom_entite'] }}
                                                            @endif


                                                        </td>
                                                    @endif

                                                    <td>
                                                        <a
                                                            href="/union_groupements/modifier/{{ $item['id_union_groupement'] }}">
                                                            <i class="material-icons orange-text ">edit</i>
                                                        </a>
                                                        <a href="#" class="px-1"
                                                            onclick="deleteUnion({{ $item['id_union_groupement'] }})">
                                                            <i class="material-icons red-text ">delete</i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                                {{-- </div> --}}
                            </div>

                        </li>
                    @endif
                    <li class="active">
                        <div class="collapsible-header">
                            <i class="material-icons">group</i>

                            <a href="" class='chip red lighten-5'>
                                <span class=''>
                                  <span class='red-text'>{{ $nb_grp }}
                                    </span>
                                </span>
                            </a> Groupements / OP

                        </div>

                        <div class="collapsible-body">
                            {{-- <div class="row col12"> --}}
                                @if ($_SESSION['role'] != 'SUPERVISEUR')
                                    <a class="waves-effect waves-light  green darken-1 btn modal-trigger right"
                                        href="#modal3"> <i class="material-icons">add</i> Nouveau Groupement
                                    </a>
                                @endif
                                <!-- Modal Structure -->
                                <div id="modal3" class="modal modal-lg">
                                    <div class="modal-content">
                                        <h4>Nouveau Groupement</h4>
                                        <div class="divider mt-2"></div>
                                        <form method="POST" action="/groupements/store" id="add_grp"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col s6">
                                                    <div class="input-field">
                                                        <input id="libelle3" type="text" class="validate"
                                                            name="libelle" required>
                                                        <label class="active" for="libelle">Nom</label>
                                                    </div>
                                                </div>
                                                <div class="col s6">
                                                    <div class="input-field">
                                                        <input id="date_creation3" type="text" class="datepicker"
                                                            name="date_creation">
                                                        <label class="active" for="date_creation">Date de
                                                            Création</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col s12">
                                                    <div class="input-field">
                                                        <input id="description3" type="text" class="validate"
                                                            name="description">
                                                        <label class="active" for="description">Description</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']))
                                                    <div class="col s6">
                                                        <div class="input-field">

                                                            <select class="select2insidemodal3 browser-default"
                                                                id="entite3" name="entite">
                                                                <option value="" disabled selected>Choisissez
                                                                    l'ONG</option>
                                                                @foreach ($ong as $item)
                                                                    <option value="{{ $item['id_entite'] }}">
                                                                        {{ $item['nom_entite'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col s6">
                                                        <div class="input-field">
                                                            <select class="select2insidemodal3 browser-default"
                                                                id="union_groupement3" name="union_groupement">
                                                                <option value="" disabled selected>Choisissez l'Union
                                                                    de Groupements</option>
                                                                @foreach ($union_groupements as $item)
                                                                    <option value="{{ $item['id_union_groupement'] }}">
                                                                        {{ $item['libelle'] }}</option>
                                                                @endforeach
                                                            </select>
                                                            {{-- <label for="union_groupement" class="col-form-label">Union de Groupements</label> --}}
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col s12">
                                                        <div class="input-field">
                                                            <select class="select2insidemodal3 browser-default"
                                                                id="union_groupement3" name="union_groupement">
                                                                <option value="" disabled selected>Choisissez l'Union
                                                                    de Groupements</option>
                                                                @foreach ($union_groupements as $item)
                                                                    <option value="{{ $item['id_union_groupement'] }}">
                                                                        {{ $item['libelle'] }}</option>
                                                                @endforeach
                                                            </select>
                                                            {{-- <label for="union_groupement" class="col-form-label">Union de Groupements</label> --}}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <select class="select2insidemodal3 browser-default" id="pays3"
                                                        name="pays">
                                                        <option value="" disabled selected>Pays</option>
                                                    </select>
                                                    <label class="active" for="pays">Pays</label>
                                                </div>

                                                <div class="input-field col s6">
                                                    <select class="select2insidemodal3 browser-default" id="region3"
                                                        name="region">
                                                        <option value="" disabled selected>--Région--</option>
                                                    </select>
                                                    <label class="active" for="region">Région</label>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <select class="select2insidemodal3 browser-default" id="dept3"
                                                        name="dept">
                                                        <option value="" disabled selected>Département</option>
                                                    </select>
                                                    <label class="active" for="dept">Département</label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <select class="select2insidemodal3 browser-default" id="commune3"
                                                        name="commune">
                                                        <option value="" disabled selected>--Commune--</option>
                                                    </select>
                                                    <label class="active" for="commune">Commune</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <div class="input-field">
                                                        <select class="select2insidemodal3 browser-default" id="localite3"
                                                            name="localite">
                                                            <option value="" disabled selected>Localité</option>
                                                        </select>
                                                        <label class="active" for="localite3">Localité</label>
                                                    </div>
                                                </div>
                                                <div class="col s6">
                                                    <div class="file-field input-field">
                                                        <div class="btn">
                                                            <span>Ninéa</span>
                                                            <input type="file" name="ninea" id="ninea3"
                                                                accept=".pdf, .doc, .docx">
                                                        </div>
                                                        <div class="file-path-wrapper">
                                                            <input class="file-path" name="ninea_name" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <button type="button" id="create_grp"
                                                    class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#!"
                                            class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                                    </div>
                                </div>
                            {{-- </div> --}}
                            {{-- <div class="responsive-table">
                                <table id="data-table-simple" class="table"> --}}
                            <table id="grpTable" class="table">
                                <thead>
                                    <tr>
                                        <th>Libellé</th>
                                        {{-- <th>Date de Création</th> --}}
                                        <th>Localité</th>
                                        {{-- <th>Description</th> --}}
                                        <th>Ninéa</th>
                                        <th>Membres</th>
                                        <th>Union de Groupements</th>
                                        <th>Association d'Unions de Groupements</th>

                                        @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']))
                                            <th>ONG</th>
                                        @endif

                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @isset($groupements)
                                        @foreach ($groupements as $item)
                                            <tr>
                                                <td>{{ $item['libelle'] }}</td>
                                                {{-- <td>{{ $item['date_creation'] }}</td> --}}
                                                <td>{{ $item['localite'] }}</td>
                                                {{-- <td>
                                                    @if (strcmp($item['description'], '') == 0)
                                                        -
                                                    @else
                                                        {{ $item['description'] }}
                                                    @endif
                                                </td> --}}

                                                <td>

                                                    @if (strcmp($item['ninea'], '') == 0)
                                                        -
                                                    @else
                                                        <a href="{{ asset('storage/' . $item['ninea']) }}" target="_blank">
                                                            <i class="material-icons blue-text ">file_download</i>
                                                        </a>
                                                    @endif


                                                </td>

                                                {{-- <td>
                                                        <a class="btn indigo waves-effect waves-light btn-sm ml-3"
                                                            href="/groupements/membres/{{ $item['libelle'] }}/{{ $item['id_groupement'] }}">Membres</a>
                                                    </td> --}}

                                                <td>
                                                    @if ($item['nombre_membre'] == 0)
                                                        {{-- Pas de Membre --}}
                                                        <a id=""
                                                            href="/groupements/membres/{{ $item['libelle'] }}/{{ $item['id_groupement'] }}">
                                                            <span class='chip green lighten-5'><span
                                                                class='green-text'> <i class="material-icons" >add</i> </span></span>
                                                        </a>
                                                    @else
                                                        <a href="/groupements/membres/{{ $item['libelle'] }}/{{ $item['id_groupement'] }}"
                                                            class='chip green lighten-5'>
                                                            <span class=''>
                                                                <span class='green-text'><u>{{ $item['nombre_membre'] }} 
                                                                    </u></span>
                                                            </span>
                                                        </a>
                                                    @endif

                                                </td>

                                                <td>
                                                    @if (strcmp($item['nom_union_groupement'], '') == 0)
                                                        -
                                                    @else
                                                        {{ $item['nom_union_groupement'] }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (strcmp($item['nom_AUOP'], '') == 0)
                                                        -
                                                    @else
                                                        {{ $item['nom_AUOP'] }}
                                                    @endif
                                                </td>

                                                @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']))
                                                    <td>

                                                        @if (strcmp($item['nom_entite'], '') == 0)
                                                            -
                                                        @else
                                                            {{ $item['nom_entite'] }}
                                                        @endif


                                                    </td>
                                                @endif

                                                <td>
                                                    <a href="/groupements/modifier/{{ $item['id_groupement'] }}">
                                                        <i class="material-icons orange-text ">edit</i>
                                                    </a>
                                                    <a href="#" onclick="deleteGrp({{ $item['id_groupement'] }})"
                                                        class="px-1">
                                                        <i class="material-icons red-text ">delete</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        {{-- @endif --}}
                                    @endisset
                                </tbody>
                            </table>
                            {{-- </div> --}}
                        </div>
                    </li>

                </ul>
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

    <script src="{{ asset('assets/js/crud/gestion/groupements/message.js') }}"></script>

    <script src="{{ asset('assets/js/crud/gestion/groupements/delete.js') }}"></script>

    <script src="{{ asset('assets/js/crud/gestion/groupements/localite.js') }}"></script>
@endsection
