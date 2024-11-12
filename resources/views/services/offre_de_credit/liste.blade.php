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
    Offres de Crédit
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/banques/offre-de-credit">Offres de Crédit</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text">Liste des Offres</a>
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
            <h4>Nouvelle Offre de Crédit</h4>
            <div class="divider mt-2"></div>

            <form method="POST" id="formAddOffre" action="/banques/offre-de-credit/store">
                @csrf
                <div class="row">

                    <div class="input-field col s6">
                        <select class="select browser-default" name="entite" required>
                            <option value="" disabled selected>Banque</option>
                            @foreach ($banques as $item)
                                <option value="{{ $item['id_entite'] }}">{{ $item['nom_entite'] }}</option>
                            @endforeach
                        </select>
                        <label class="active" for="entite">Banque</label>
                    </div>


                    <div class="input-field col s6">
                        <input id="nom" type="text" class="validate" name="nom">
                        <label class="active" for="nom">Nom de l'Offre</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="description" type="text" class="validate" name="description">
                        <label class="active" for="description">Description</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="plancher" type="text" class="validate" name="plancher">
                        <label class="active" for="plancher">Montant Plancher (F CFA)</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="plafond" type="text" class="validate" name="plafond">
                        <label class="active" for="plafond">Montant Plafond (F CFA)</label>
                    </div>

                    {{-- <div class="input-field col s6">
                        <select class="select browser-default" id="unite" name="unite" required> --}}
                            {{-- <option value="" disabled selected>Unité</option>
                            @foreach ($unites as $item)
                                <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                            @endforeach --}}
                            {{-- @foreach ($unites as $item)

                                @if($item['id'] == 7)
                                    <option value="{{ $item['id'] }}" selected>{{ $item['unite'] }}</option>
                                @else
                                    <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                                @endif

                            @endforeach
                        </select>
                        <label class="active" for="unite">Unité</label>
                    </div> --}}

                    <div class="input-field col s6">
                        <input id="date" type="text" class="datepicker" name="date" required>
                        <label class="active" for="date">Date</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="duree" type="text" class="validate" name="duree">
                        <label class="active" for="duree">Durée (mois)</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="taux" type="text" class="validate" name="taux">
                        <label class="active" for="taux">Taux (%)</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="frais_adhesion" type="text" class="validate" name="frais_adhesion">
                        <label class="active" for="frais_adhesion">Frais d'Adhésion (F CFA)</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="apport_personnel" type="text" class="validate" name="apport_personnel">
                        <label class="active" for="apport_personnel">Apport Personnel (F CFA)</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="frais_dossier" type="text" class="validate" name="frais_dossier">
                        <label class="active" for="frais_dossier">Frais de Dossier (F CFA)</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="frais_gestion" type="text" class="validate" name="frais_gestion">
                        <label class="active" for="frais_gestion">Frais de Gestion (F CFA)</label>
                    </div>

                    <div class="input-field col s6">
                        <select class="select" name="assurance" required>
                            <option value="1">Offre avec Assurance</option>
                            <option value="0">Offre sans Assurance</option>
                        </select>
                        <label class="active" for="assurance">Assurance</label>
                    </div>

                    <div class="input-field col s6">
                        <select class="select" name="garantie" required>
                            <option value="1">Offre avec Garantie</option>
                            <option value="0">Offre sans Garantie</option>
                        </select>
                        <label class="active" for="garantie">Garantie</label>
                    </div>

                </div>


                <div class="row">

                    <div class="input-field col s12">
                        <div class="col s12 display-flex justify-content-end mt-1">
                            <button id="formAddOffrebtn" type="button"
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

                @if (in_array($_SESSION['role'], ['FINANCIER', 'ADMIN', 'SUPERADMIN']))
                    <div>

                        <a type="button" class="waves-effect waves-light  green darken-1 btn modal-trigger right"
                            href="/banques/offre-de-credit/create"><i class="material-icons">add_circle</i>
                            Offre de Crédit</a>

                    </div>
                @endif

                <div class="responsive-table">
                    <!-- datatable start -->
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th>Banque</th>
                                <th>Nom de l'Offre</th>
                                <th>Description</th>
                                <th>Plancher (F CFA)</th>
                                <th>Plafond (F CFA)</th>
                                <th>Durée (mois)</th>
                                <th>Taux (%)</th>
                                {{-- <th>Date</th> --}}
                                <th>Frais d'Adhésion (F CFA)</th>
                                <th>Apport Personnel</th>
                                <th>Frais de Dossier (F CFA)</th>
                                <th>Frais de Gestion (F CFA)</th>
                                <th>Assurance</th>
                                <th>Garantie</th>

                                @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']))
                                    <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody id="">
                            @isset($offres)
                                @foreach ($offres as $item)
                                    <tr>
                                        <td>{{ $item['nom_entite'] }}</td>
                                        <td>{{ $item['nom_offre'] }}</td>
                                        <td>{{ $item['description'] }}</td>
                                        <td>{{ $item['plancher'] }}</td>
                                        <td>{{ $item['plafond'] }}</td>
                                        <td>{{ $item['duree'] }}</td>
                                        <td>{{ $item['taux'] }}</td>
                                        {{-- <td>{{ $item['date'] }}</td> --}}
                                        <td>{{ $item['frais_adhesion'] }}</td>
                                        <td>{{ $item['apport_personnel'] }}</td>
                                        <td>{{ $item['frais_dossier'] }}</td>
                                        <td>{{ $item['frais_gestion'] }}</td>
                                        <td>
                                            @if ($item['assurance'] == 1)
                                                    <span class='chip green lighten-5'><span class='green-text'><i class="material-icons">check</i></span></span>
                                            @elseif ($item['assurance'] == 0)
                                                    <span class='chip red lighten-5'><span class='red-text'><i class="material-icons">close</i></span></span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item['garantie'] == 1)
                                                    <span class='chip green lighten-5'><span class='green-text'><i class="material-icons">check</i></span></span>
                                            @elseif ($item['garantie'] == 0)
                                                    <span class='chip red lighten-5'><span class='red-text'><i class="material-icons">close</i></span></span>
                                            @endif
                                        </td>

                                        @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']))
                                            <td>
                                                <a href="/banques/offre-de-credit/modifier/{{ $item['id'] }}">
                                                    <i class="material-icons orange-text ">edit</i>
                                                </a>

                                                <a href="#" onclick="deleteOffre({{ $item['id'] }})"
                                                    class="px-1">
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

{{-- <script src="{{ asset('assets/js/crud/gestion/langues/message.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/crud/gestion/langues/delete.js') }}"></script> --}}

<script src="{{ asset('assets/js/crud/services/offres/message.js') }}"></script>

<script src="{{ asset('assets/js/crud/services/offres/delete.js') }}"></script>
@endsection
