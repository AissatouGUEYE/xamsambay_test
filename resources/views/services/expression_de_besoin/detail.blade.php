@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
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

    <li class="breadcrumb-item active" style="color:#ffe900">Details Expression de Besoin
    </li>
@endsection
@section('main_content')
    <div class="section eb-view">

        @php
            $id = $eb[0]['id'];
        @endphp


        <div id="my-element"
            data-id-type-eb="{{ $eb[0]['id_type_eb'] }}"
            data-message="{{ json_encode(session('message')) }}">
        </div>


        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12 m12">
                        <table class="striped">
                            <tbody>
                                <tr>
                                    <td> <b>Émetteur :</b> {{ $eb[0]['prenom'] }} {{ $eb[0]['nom'] }}</td>
                                    {{-- <td></td> --}}
                                    @if (in_array($eb[0]['id_type_eb'], [1, 3]))
                                        <td><b>Nom du Produit :</b> {{ $eb[0]['produit'] }}</td>
                                    @elseif (in_array($eb[0]['id_type_eb'], [2]))
                                        <td><b>Montant :</b> {{ $eb[0]['montant'] }} {{ $eb[0]['unite'] }}</td>
                                    @elseif (in_array($eb[0]['id_type_eb'], [4]))
                                        <td><b>Type Assurance :</b> {{ $eb[0]['type_assurance'] }}</td>
                                    @elseif (in_array($eb[0]['id_type_eb'], [11]))
                                        <td><b>Intitulé Formation :</b> {{ $eb[0]['intitule_formation'] }}</td>
                                    @elseif (in_array($eb[0]['id_type_eb'], [12]))
                                        <td><b>Nom du Produit :</b> {{ $eb[0]['produit'] }}</td>
                                    @endif
                                    {{-- <td></td> --}}
                                    @if (in_array($eb[0]['id_type_eb'], [12]))
                                        <td><b>Provenance :</b> {{ $eb[0]['commune_from'] }} - {{ $eb[0]['departement_from'] }} - {{ $eb[0]['region_from'] }}</td>
                                    @endif
                                    {{-- <td>Adresse: {{ $eb[0]['nom'] }},
                                        {{ $eb[0]['nom'] }},{{ $eb[0]['nom'] }}</td> --}}
                                </tr>
                                <tr>
                                    <td><b>Besoin:</b> {{ $eb[0]['type_eb'] }}</td>
                                    {{-- <td></td> --}}
                                    @if (in_array($eb[0]['id_type_eb'], [1, 3, 12]))
                                        <td><b>Variété :</b> {{ $eb[0]['variete'] }}</td>
                                    @endif

                                    @if (in_array($eb[0]['id_type_eb'], [12]))
                                        <td><b>Destination :</b> {{ $eb[0]['commune_to'] }} - {{ $eb[0]['departement_to'] }} - {{ $eb[0]['region_to'] }}</td>
                                    @endif
                                    {{-- <td></td> --}}
                                    {{-- <td>Date d'inscription: {{ date('d M Y', strtotime($eb[0]['nom'])) }}</td> --}}

                                </tr>
                                <tr>
                                    <td><b>Description :</b> {{ $eb[0]['description'] }}</td>
                                    {{-- <td></td> --}}
                                    @if (in_array($eb[0]['id_type_eb'], [1, 3, 12]))
                                        <td><b>Quantité :</b> {{ $eb[0]['qte'] }} {{ $eb[0]['unite'] }}</td>
                                    @endif


                                    {{-- <td></td> --}}
                                    {{-- @if ($eb[0]['etat'] == 0)
                                        <td>Statut: <span
                                                class=" eb-view-status chip red lighten-5 red-text">Inactif</span></td>
                                    @else
                                        <td>Statut: <span
                                                class=" eb-view-status chip green lighten-5 green-text">Actif</span>
                                        </td>
                                    @endif --}}
                                </tr>
                                <tr>
                                    <td>
                                        <b> Date d'Émission :</b>
                                        @php echo date('d/m/Y', strtotime($eb[0]['created_at']));  @endphp
                                    </td>

                                    {{-- <td></td> --}}
                                    {{-- @if (in_array($eb[0]['id_type_eb'], [12]))
                                        <td>Provenance : {{ $eb[0]['commune_from'] }}</td>
                                    @endif --}}
                                    {{-- <td></td> --}}
                                    {{-- @if ($eb[0]['nom'])
                                        <td> Role : {{ $eb[0]['nom'] }} </td>
                                    @endif --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-panel">
            <div class="row">
                <div class="col s12 quick-action-btns display-flex justify-content-center">

                    <a class="btn-small green" id="btnOffre">
                        <i class="material-icons">add</i>Offre
                    </a>

                    @if ($eb[0]['nombre_offre'] != 0)
                        <a class="btn-small green" id="listOffre" style="margin-left: 10px;"
                            href = "/expression-de-besoin/offre/liste/{{ $eb[0]['id'] }}">
                            Voir les {{ $eb[0]['nombre_offre'] }} Offres
                        </a>
                    @else
                        <h6 style="margin-left: 10px;">Pas d'Offre Pour Le Moment !</h6>
                    @endif


                </div>

            </div>
        </div>

        <div class="card" id="cardOffre" style="display:none;">
            <div class="card-content">
                <div class="row">
                    <form method="POST" action="{{ url('/expression-de-besoin/offre/store') }}" id="formSoumettreOffre">

                        @csrf

                        <input id="eb" name="eb" value="{{ $eb[0]['id'] }}" hidden>

                        <div id="description_div" class="input-field col s12" style="display:none;">
                            <input type="text" class="validate" name="description" id="description">
                            <label class="active" for="description">Description</label>
                        </div>

                        <div class="input-field col s6" style="display:none;" id="montant_div">
                            <input id="montant" type="number" class="validate" name="montant">
                            <label class="active" for="montant">Montant</label>
                        </div>
                        <div class="input-field col s6" style="display:none;" id="qte_div">
                            <input id="qte" type="number" class="validate" name="quantite">
                            <label class="active" for="qte">Quantité</label>
                        </div>

                        <div class="input-field col s6" style="display:none;" id="prix_div">
                            <input id="prix" type="number" class="validate" name="prix">
                            <label class="active" for="prix">Prix</label>
                        </div>

                        <div class="input-field col s6" style="display:none;" id="unite_div">
                            <select class="select browser-default" name="unite">
                                <option value="" disabled selected>Unité</option>
                                @foreach ($unites as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                                @endforeach
                            </select>
                            <label class="active" for="unite">Unité</label>
                        </div>

                        <div class="input-field col s6" style="display:none;" id="unite_monnaie_div">
                            <select class="select browser-default" name="unite">
                                <option value="" disabled selected>Unité</option>
                                @foreach ($unite_monnaie as $item)`
                                    @if ($item['id'] == 7)
                                    <option value="{{ $item['id'] }}" selected>{{ $item['unite'] }}</option>
                                    @else
                                    <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                                    @endif

                                @endforeach
                            </select>
                            <label class="active" for="unite">Unité</label>
                        </div>

                        <div class="input-field col s6" style="display:none;" id="unite_prix_div">
                            <select class="select browser-default" name="unite_prix">
                                <option value="" disabled selected>Unité</option>
                                @foreach ($unite_monnaie as $item)`
                                    @if ($item['id'] == 7)
                                    <option value="{{ $item['id'] }}" selected>{{ $item['unite'] }}</option>
                                    @else
                                    <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                                    @endif

                                @endforeach
                            </select>
                            <label class="active" for="unite_prix">Unité</label>
                        </div>

                        <div class="card-panel" id="Offre_btn_div">
                            <div class="row">

                                {{-- <div class="col s12 m12 l10 quick-action-btns display-flex justify-content-center align-items-center pt-2">
                                    <a class="btn-small green" id="btnSoumettreOffre" type="button">Soumettre</a>
                                </div> --}}
                                <div class="col s12 m12 quick-action-btns display-flex justify-content-end align-items-end pt-2">
                                    <a class="btn-small indigo" id="btnSoumettreOffre" type="button">Soumettre</a>
                                </div>


                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection
@section('float-btn')
    <div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top">
        <button class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow  modal-trigger"
            data-target="modal3">
            <i class="material-icons">add</i>
        </button>
        {{-- <ul>
      <li><a href="css-helpers.html" class="btn-floating blue"><i class="material-icons">help_outline</i></a></li>
      <li><a href="cards-extended.html" class="btn-floating green"><i class="material-icons">widgets</i></a></li>
      <li><a href="app-calendar.html" class="btn-floating amber"><i class="material-icons">today</i></a></li>
      <li><a href="app-email.html" class="btn-floating red"><i class="material-icons">mail_outline</i></a></li>
  </ul> --}}
    </div>
    {{-- <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a> --}}
    <!-- Modal Structure -->
    <div id="modal3" class="modal modal-fixed-footer">
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <form action="">
                        <div class="row">
                            <div class="input-field col s6">
                                <input value="Alvin" id="first_name2" type="text" class="validate">
                                <label class="active" for="first_name2">First Name</label>
                            </div>
                            <div class="input-field col s6">
                                <input value="Alvin" id="first_name2" type="text" class="validate">
                                <label class="active" for="first_name2">First Name</label>
                            </div>
                        </div>
                        {{-- <div class="row"> --}}
                        <div class="input-field">
                            <select class="select2 browser-default">
                                <option value="square">Square</option>
                                <option value="rectangle">Rectangle</option>
                                <option value="rombo">Rombo</option>
                                <option value="romboid">Romboid</option>
                                <option value="trapeze">Trapeze</option>
                                <option value="traible">Triangle</option>
                                <option value="polygon">Polygon</option>
                            </select>
                        </div>
                        {{-- </div> --}}
                    </form>
                    {{-- <div id="icon-prefixes" class="card card-tabs"> --}}
                    {{-- <div id="view-icon-prefixes">

              </div> --}}
                    {{-- </div> --}}
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Annuler</a>
        </div>
    </div>
@endsection
@section('other-js-script')
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    {{-- @if (!is_null(session('message')))
        <script>
            $(document).ready(function() {
                var message = $('#my-element').data('message');

                swal({
                    title: "Enrégistrement Réussi !",
                    text:  message ,
                    icon: 'success'
                })

        </script>
    @endif --}}

    <script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>

    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/search.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>

    <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>

    <script src="{{ asset('assets/js/crud/gestion/eb/detail.js') }}"></script>
@endsection
