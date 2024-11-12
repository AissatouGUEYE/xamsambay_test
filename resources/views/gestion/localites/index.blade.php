@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">
@endsection
@section('page-title')
    Localités
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
   <a href="localites">Localités</a>
</li>

<li class="breadcrumb-item">
    <a class="yellow-text">Liste des Localités</a>
</li>
@endsection

@section('main_content')
    <section class="users-list-wrapper section">
        <div class="users-list-filter">
            {{-- <div class="card-panel">


            </div> --}}
        </div>


        <div class="row">
            <div class="col s12">
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <div class="collapsible-header"><i class="material-icons">location_on</i> Régions </div>
                        <div class="collapsible-body">
                            <div class="row col12">
                                <a class="waves-effect waves-light  green darken-1 btn modal-trigger right" href="#modal1"> <i
                                        class="material-icons">add</i> Nouvelle Région
                                </a>
                                <!-- Modal Structure -->
                                <div id="modal1" class="modal">
                                    <div class="modal-content">
                                        <h4>Nouvelle Région</h4>
                                        <div class="divider mt-2"></div>
                                        <form method="POST" action="/regions/store" id = "add_region">
                                            @csrf
                                            <div class="row">
                                                <div class="col s12 m12 l12">
                                                    <div class="input-field">
                                                        <input id="region" type="text" class="validate" name="region" >
                                                        <label class="active" for="region">Nom de la Région <span
                                                    class="red-text"> *</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m12 l12">
                                                    <div class="input-field">
                                                        {{-- <select name="type_entite">
                                                            <option value="{{ $userInfos['type_entite'] }}">
                                                                {{ $userInfos['nom_typentite'] }}</option>
                                                        </select> --}}
                                                        <select class="select browser-default" id="pays" name="pays">
                                                            <option value="" disabled selected>Choisissez le pays</option>
                                                            <option value="1">Sénégal</option>
                                                            <option value="2">Mali</option>
                                                        </select>
                                                        {{-- <label class="active" for="users-list-role">Pays</label> --}}

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <button type="button" id = "create_region" class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                                    </div>
                                </div>
                            </div>
                            <table id="regionTable" class="table">
                                <thead>
                                    <tr>
                                        <th>Pays</th>
                                        <th>Régions</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @isset($regions)
                                        @foreach ($regions as $item)
                                        <tr>
                                            <td>{{ $item['pays'] }}</td>
                                            <td>{{ $item['region'] }}</td>
                                            <td>
                                                {{-- <a href="/regions/modifier/{{ $item['id'] }}">
                                                    <i class="material-icons orange-text ">edit</i>
                                                </a> --}}
                                                <a href="/regions/modifier/{{ $item['id'] }}">
                                                    <i class="material-icons orange-text ">edit</i>
                                                </a>
                                                {{-- <a href="/regions/delete/{{ $item['id'] }}" class="px-1">
                                                    <i class="material-icons red-text ">delete</i>
                                                </a> --}}
                                                <a href="#" class="px-1" onclick="deleteRegion({{$item['id']}})">
                                                    <i class="material-icons red-text ">delete</i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">location_on</i> Départements</div>
                        <div class="collapsible-body">
                            <div class="row col12">
                                <a class="waves-effect waves-light  green darken-1 btn modal-trigger right" href="#modal2"> <i
                                        class="material-icons">add</i> Nouveau Département
                                </a>
                                <!-- Modal Structure -->
                                <div id="modal2" class="modal">
                                    <div class="modal-content">
                                        <h4>Nouveau Département</h4>
                                        <div class="divider mt-2"></div>
                                        <form method="POST" action="/departements/store" id="add_dept">
                                            @csrf
                                            <div class="row">
                                                <div class="col s12 m12 l12">
                                                    <div class="input-field">
                                                        <input id="departement" type="text" class="validate" name="departement" >
                                                        <label class="active" for="departement">Nom du Département <span
                                                    class="red-text"> *</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m12 l12">
                                                    <div class="input-field">
                                                        {{-- <select name="type_entite">
                                                            <option value="{{ $userInfos['type_entite'] }}">
                                                                {{ $userInfos['nom_typentite'] }}</option>
                                                        </select> --}}
                                                        <select class="select browser-default" id="region" name="region">
                                                            <option value="" disabled selected>Choisissez la région</option>
                                                            @foreach ($regions as $item)
                                                                <option value="{{ $item['id'] }}">{{ $item['region'] }}</option>
                                                            @endforeach
                                                        </select>
                                                        {{-- <label class="active" for="users-list-role">Pays</label> --}}

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <button type="button" id="create_dept" class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                                    </div>
                                </div>
                            </div>
                            {{-- <table id="data-table-simple" class="table"> --}}
                            <table id="depTable" class="table">
                                <thead>
                                    <tr>
                                        <th>Pays</th>
                                        <th>Régions</th>
                                        <th>Départements</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @isset($dep)
                                        @foreach ($dep as $item)
                                        <tr>
                                            <td>{{ $item['pays'] }}</td>
                                            <td>{{ $item['region'] }}</td>
                                            <td>{{ $item['departement'] }}</td>
                                            <td>
                                                {{-- <a href="/regions/modifier/{{ $item['id'] }}">
                                                    <i class="material-icons orange-text ">edit</i>
                                                </a> --}}
                                                <a href="/departements/modifier/{{ $item['id'] }}">
                                                    <i class="material-icons orange-text ">edit</i>
                                                </a>
                                                {{-- <a href="/departements/delete/{{ $item['id'] }}" class="px-1">
                                                    <i class="material-icons red-text ">delete</i>
                                                </a> --}}
                                                <a href="#" class="px-1" onclick="deleteDept({{$item['id']}})">
                                                    <i class="material-icons red-text ">delete</i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>

                    </li>

                    <li>
                        <div class="collapsible-header">
                            <i class="material-icons">location_on</i>
                            Communes
                        </div>

                        <div class="collapsible-body">
                            <div class="row col12">
                                <a class="waves-effect waves-light  green darken-1 btn modal-trigger right" href="#modal3"> <i
                                        class="material-icons">add</i> Nouvelle Commune
                                </a>
                                <!-- Modal Structure -->
                                <div id="modal3" class="modal">
                                    <div class="modal-content">
                                        <h4>Nouvelle Commune</h4>
                                        <div class="divider mt-2"></div>
                                        <form method="POST" action="/communes/store" id="add_commune">
                                            @csrf
                                            <div class="row">
                                                <div class="col s12 m12 l12">
                                                    <div class="input-field">
                                                        <input id="commune" type="text" class="validate" name="commune" >
                                                        <label class="active" for="commune">Nom de la Commune <span
                                                    class="red-text"> *</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m12 l12">
                                                    <div class="input-field">
                                                        {{-- <select name="type_entite">
                                                            <option value="{{ $userInfos['type_entite'] }}">
                                                                {{ $userInfos['nom_typentite'] }}</option>
                                                        </select> --}}
                                                        <select class="select browser-default" id="departement" name="departement">
                                                            <option value="" disabled selected>Choisissez le département</option>
                                                            @foreach ($dep as $item)
                                                                <option value="{{ $item['id'] }}">{{ $item['departement'] }}</option>
                                                            @endforeach
                                                        </select>
                                                        {{-- <label class="active" for="users-list-role">Pays</label> --}}

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <button type="button" id="create_commune" class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                                    </div>
                                </div>
                            </div>
                            {{-- <table id="data-table-simple" class="table"> --}}
                            <table id="communeTable" class="table">
                                <thead>
                                    <tr>
                                        <th>Pays</th>
                                        <th>Régions</th>
                                        <th>Départements</th>
                                        <th>Communes</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @isset($dep)
                                        @foreach ($communes as $item)
                                        <tr>
                                            <td>{{ $item['pays'] }}</td>
                                            <td>{{ $item['region'] }}</td>
                                            <td>{{ $item['departement'] }}</td>
                                            <td>{{ $item['commune'] }}</td>
                                            <td>
                                                {{-- <a href="/regions/modifier/{{ $item['id'] }}">
                                                    <i class="material-icons orange-text ">edit</i>
                                                </a> --}}
                                                <a href="/communes/modifier/{{ $item['id'] }}">
                                                    <i class="material-icons orange-text ">edit</i>
                                                </a>
                                                {{-- <a href="/communes/delete/{{ $item['id'] }}" class="px-1">
                                                    <i class="material-icons red-text ">delete</i>
                                                </a> --}}
                                                <a href="#" class="px-1" onclick="deleteCommune({{$item['id']}})">
                                                    <i class="material-icons red-text ">delete</i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </li>

                    <li class="active">
                        <div class="collapsible-header">
                            <i class="material-icons">location_on</i>
                            Localités
                        </div>


                    <div class="collapsible-body">
                        <div class="row col12">
                            <a class="waves-effect waves-light  green darken-1 btn modal-trigger right" href="#modal4"> <i
                                    class="material-icons">add</i> Nouvelle Localité
                            </a>
                            <!-- Modal Structure -->
                            <div id="modal4" class="modal">
                                <div class="modal-content">
                                    <h4>Nouvelle Localité</h4>
                                    <div class="divider mt-2"></div>
                                    <form method="POST" action="/localites/store" id="add_localite">
                                        @csrf
                                        <div class="row">
                                            <div class="col s12 m12 l12">
                                                <div class="input-field">
                                                    <input id="localite" type="text" class="validate" name="localite" >
                                                    <label class="active" for="localite">Nom de la Localité <span
                                                    class="red-text"> *</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l12">
                                                <div class="input-field">
                                                    {{-- <select name="type_entite">
                                                        <option value="{{ $userInfos['type_entite'] }}">
                                                            {{ $userInfos['nom_typentite'] }}</option>
                                                    </select> --}}
                                                    <select class="select browser-default" id="id_commune" name="id_commune">
                                                        <option value="" disabled selected>Choisissez la Commune</option>
                                                        @foreach ($communes as $item)
                                                            <option value="{{ $item['id'] }}">{{ $item['commune'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    {{-- <label class="active" for="users-list-role">Pays</label> --}}

                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <button type="button" id="create_localite" class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                                </div>
                            </div>
                        </div>
                        {{-- <table id="data-table-simple" class="table"> --}}
                        <table id="localiteTable" class="table">
                            <thead>
                                <tr>
                                    <th>Pays</th>
                                    <th>Régions</th>
                                    <th>Départements</th>
                                    <th>Communes</th>
                                    <th>Localités</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                @isset($dep)
                                    @foreach ($localites as $item)
                                    <tr>
                                        <td>{{ $item['pays'] }}</td>
                                        <td>{{ $item['region'] }}</td>
                                        <td>{{ $item['departement'] }}</td>
                                        <td>{{ $item['commune'] }}</td>
                                        <td>{{ $item['localite'] }}</td>
                                        <td>
                                            <a href="/localites/modifier/{{ $item['id'] }}">
                                                <i class="material-icons orange-text ">edit</i>
                                            </a>
                                            {{-- <a href="/localites/delete/{{ $item['id'] }}" class="px-1">
                                                <i class="material-icons red-text ">delete</i>
                                            </a> --}}
                                            <a href="#" class="px-1" onclick="deleteLocalite({{$item['id']}})">
                                                <i class="material-icons red-text ">delete</i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
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

<script src="{{ asset('assets/js/crud/gestion/localites/message.js') }}"></script>
<script src="{{ asset('assets/js/crud/gestion/localites/delete.js') }}"></script>

@endsection
