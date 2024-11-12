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
    Banques
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/banques/liste">Banques</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text">Liste des Banques</a>
    </li>
@endsection

<section class="users-list-wrapper section">

    <div class="users-list-filter">
        {{-- <div class="card-panel">
            <div class="row">


            </div>
        </div> --}}
    </div>




    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Nouvelle Banque</h4>
            <div class="divider mt-2"></div>

            <form method="POST" id="formAddBanque" action="/banques/store">
                @csrf
                <div class="row">

                    <div class="input-field col s6">
                        <input id="nom_entite" type="text" class="validate" name="nom_entite" >
                        <label class="active" for="nom_entite">Nom de la Banque</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="description" type="text" class="validate" name="description" >
                        <label class="active" for="description">Description</label>
                    </div>

                    <div class="input-field col s6">
                        <select class="select browser-default" id="pays" name="pays">
                            <option value="" disabled selected>Pays</option>
                        </select>
                        <label class="active" for="pays">Pays</label>
                    </div>

                    <div class="input-field col s6">
                        <select class="select browser-default" id="region" name="region">
                            <option value="" selected>Région</option>
                        </select>
                        <label class="active" for="region">Région</label>
                    </div>

                    <div class="input-field col s6">
                        <select class="select browser-default" id="dept" name="dept">
                            <option value="" selected>Département</option>
                        </select>
                        <label class="active" for="dept">Département</label>
                    </div>

                    <div class="input-field col s6">
                        <select class="select browser-default" id="commune" name="commune">
                            <option value=""  selected>Commune</option>
                        </select>
                        <label class="active" for="commune">Commune</label>
                    </div>

                    <div class="input-field col s6">
                        <select class="select browser-default" id="localite" name="localite">
                            <option value="" selected>Localité</option>
                        </select>
                        <label class="active" for="localite">Localité</label>
                    </div>

                </div>


                <div class="row">

                    <div class="input-field col s12">
                        <div class="col s12 display-flex justify-content-end mt-1">
                            <button id="formAddBanquebtn" type="button" class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">
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

                @if (in_array($_SESSION['role'],["SUPERADMIN","ADMIN"]))

                    <div>

                        <a type="button" class="waves-effect waves-light  green darken-1 btn modal-trigger right"
                            href="#modal1"><i class="material-icons">add_circle</i>
                            Banque</a>

                    </div>

                @endif


                <div class="responsive-table">
                    <!-- datatable start -->
                    <table id="banqueTable" class="table">
                        <thead>
                            <tr>
                                <th>Nom de la Banque</th>
                                <th>Description</th>
                                <th>Localité</th>

                                <th>Agences</th>

                                @if (in_array($_SESSION['role'],["SUPERADMIN","ADMIN"]))
                                    <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody id="">
                            @isset($banques)
                                @foreach ($banques as $item)
                                <tr>
                                    <td>{{ $item['nom_entite'] }}</td>
                                    <td>{{ $item['description'] }}</td>
                                    <td>
                                        @if (strcmp($item['localite'], '') == 0)

                                                -

                                        @else

                                            {{ $item['localite'] }}

                                        @endif
                                    </td>

                                    <td>
                                        @if ($item['nombre_agence'] == 0)
                                            {{-- Pas d'Agence --}}
                                            <a id=""
                                                href="/banques/liste/agences/{{ $item['id_entite'] }}/{{ $item['nom_entite'] }}">
                                                <span class='chip green lighten-5'><span
                                                    class='green-text'> <i class="material-icons" >add</i> </span></span>
                                            </a>
                                        @else
                                            <a href="/banques/liste/agences/{{ $item['id_entite'] }}/{{ $item['nom_entite'] }}"
                                                class=''>
                                                <span class='chip green lighten-5'>
                                                    <span class='green-text'><u>{{ $item['nombre_agence'] }} agence(s)</u></span>
                                                </span>
                                            </a>
                                        @endif

                                    </td>

                                    {{-- <td><a class="btn indigo waves-effect waves-light btn-sm ml-3" href="/banques/liste/agences/{{ $item['id_entite'] }}/{{ $item['nom_entite'] }}">Liste Agences</a></td> --}}


                                    @if (in_array($_SESSION['role'],["SUPERADMIN","ADMIN"]))
                                        <td>
                                            <a href="/banques/modifier/{{ $item['id_entite'] }}">
                                                <i class="material-icons orange-text ">edit</i>
                                            </a>

                                            <a href="#" onclick="deleteBanque({{$item['id_entite']}})" class="px-1">
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

<script src="{{ asset('assets/js/crud/gestion/groupements/localite.js') }}"></script>

<script src="{{ asset('assets/js/crud/gestion/banques/message.js') }}"></script>

<script src="{{ asset('assets/js/crud/gestion/banques/delete.js') }}"></script>

@endsection
