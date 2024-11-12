@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

@endsection
@section('page-title')
    Collecte
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/admin">Acceuil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">Informations climatiques</a>
    </li>
    <li class="breadcrumb-item active ">
        <a class="yellow-text" href="#">Collecte </a>
    </li>
@endsection

@section('main_content')
    {{-- {{dd($_SESSION)}} --}}

    <section class="users-list-wrapper section">

        <ul class="collapsible collapsible-accordion">
            @if (in_array($_SESSION['role'], ['ADMIN', 'SUPERADMIN', 'ONG', 'GERANT','MLOUMER',"RESPONSABLE OP" ]))
                <li class="active">
                    <div class="collapsible-header"><i class="material-icons">opacity</i> Collecte</div>
                    <div class="collapsible-body">
                        <div class="row col12" id="sscon">
                            @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN', 'GERANT']))
                                <a class="waves-effect waves-light  green darken-1 btn modal-trigger right"
                                   href="#new-collecte-modal"> <i class="material-icons">add</i> Nouvelle Collecte
                                </a>
                            @endif

                            <!-- Modal Structure -->
                            <div id="new-collecte-modal" class="modal modal-lg">
                                <div class="modal-content">
                                    <h4>Nouvelle Collecte</h4>
                                    <div class="divider mt-2"></div>
                                    <form id="form-create-collecte" method="POST" action="#">
                                        @csrf
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <div class="input-field">
                                                    <input class="datepicker" type="text" name="date">
                                                    <label class="active" for="users-list-verified">Date</label>
                                                </div>
                                            </div>
                                            <div class="col s12 m6 l6">
                                                <div class="input-field">
                                                    <input class="" type="number" max="150" name="qte" required>
                                                    <label class="active" for="users-list-verified">Quantité</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <div class="input-field">
                                                    <select class="select" id="phenomene" name="phenomene">
                                                        <option value="" disabled selected>Choisissez le phénoméne
                                                        </option>
                                                        @foreach ($phenomenes as $phenom)
                                                            <option class="pheno"
                                                                    value="{{$phenom->id}}">{{$phenom->nom_phenomene}}</option>
                                                        @endforeach

                                                    </select>
                                                    {{-- <label class="active" for="users-list-role">Phénoméne</label> --}}

                                                </div>
                                            </div>
                                            @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN', 'ONG']))

                                                <div class="col s12 m6 l6">
                                                    {{-- {{dd($pluvios)}} --}}
                                                    <div class="input-field">
                                                        <select class="browser-default" id="pluvio" name="pluvio">
                                                            <option value="" selected disabled>Pluvio</option>
                                                            @foreach ($pluvios as $pluvio)
                                                                <option value="{{ $pluvio->id }}">
                                                                    {{ $pluvio->localite }}</option>
                                                            @endforeach
                                                        </select>
                                                        {{-- <label class="active" for="users-list-status">Pluvio</label> --}}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="row">
                                            <a id="btn-create-collecte"
                                               class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Envoyer</a>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <a href=""
                                       class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">

                            <table id="" class="mmtable table striped  l12 display">
                                <thead>
                                <tr>
                                    <th>Expéditeur</th>
                                    <th>Quantité</th>
                                    <th>Cumul</th>
                                    <th>Phenomene</th>
                                    <th>NB Jours de pluie</th>
                                    <th>Pluvio</th>
                                    <th>Date</th>

                                    {{-- <th>Push</th> --}}
                                    <th>Supprimer</th>
                                    {{-- @endif --}}
                                    <th>Historique d'envoi</th>

                                </tr>
                                </thead>
                                <tbody id="">

                                @foreach ($collecte_data as $collecte)
                                    @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']))

                                        <tr>
                                            <td>{{ $collecte['gestionnaire'] }}</td>
                                            <td>{{ $collecte['qte'] }}</td>
                                            <td>{{ $collecte['cumul'] }}</td>
                                            <td>{{ $collecte['phenom'] }}</td>
                                            <td>{{ $collecte['total_jp'] }}</td>
                                            <td>{{ $collecte['pluvio'] }}</td>
                                            <td>{{ $collecte['date'] }}</td>
                                            <td>
                                                @if ($collecte['etat'] == 0)
                                                    <a id="{{ $collecte['id'] }}" href="#" class="btn-delete-collecte">
                                                        <span class='chip green lighten-5'><span class='green-text'><i
                                                                    class="material-icons">check</i></span></span>
                                                    </a>
                                                @elseif ($collecte['etat'] == 1)
                                                    {{-- <a id="{{ $collecte['id'] }}" href="#" class="btn-delete-collecte"> --}}
                                                    <span class='chip red lighten-5'><span class='red-text'><i
                                                                class="material-icons">close</i></span></span>
                                                    {{-- </a> --}}
                                                @endif
                                            </td>
                                            <td>
                                                <a id="{{ $collecte['id'] }}"
                                                   href="{{ url('/information-climatique/collecte/' . $collecte['id']) }}">
                                                        <span class='chip green lighten-5'><span
                                                                class='green-text'> <i
                                                                    class="material-icons">history</i> </span></span>
                                                </a>
                                            </td>
                                        {{-- @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN', 'GERANT']) && $collecte['etat'] == 1) --}}
                                        {{-- <td>
                                            <a id="{{ $collecte['id'] }}"
                                                href="{{ url('/information-climatique/collecte/push/' . $collecte['id'] . '/' . $collecte['id_pluvio']) }}">
                                                <span class='chip green lighten-5'><span
                                                        class='green-text'>Diffuser</span></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a id="{{ $collecte['id'] }}" href="#" class="btn-delete-collecte">
                                                <span class='chip red lighten-5'><span
                                                        class='red-text'>Supprimer</span></span>
                                            </a>
                                        </td> --}}
                                        {{-- @else --}}
                                        {{-- <td>---</td>
                                        <td>---</td> --}}
                                    @elseif (isset($_SESSION['role_user']) && $_SESSION['role_user'] === 'GERANT PLUVIO' && (isset($_SESSION['id_pluvio']) && $_SESSION['id_pluvio'] == $collecte['id_pluvio']) && ($collecte['etat'] == 0))

                                        <tr>
                                            <td>{{ $collecte['gestionnaire'] }}</td>
                                            <td>{{ $collecte['qte'] }}</td>
                                            <td>{{ $collecte['cumul'] }}</td>
                                            <td>{{ $collecte['phenom'] }}</td>
                                            <td>{{ $collecte['total_jp'] }}</td>
                                            <td>{{ $collecte['pluvio'] }}</td>
                                            <td>{{ $collecte['date'] }}</td>
                                            {{-- <td>
                                                <a id="{{ $collecte['id'] }}" href="#" class="btn-delete-collecte">
                                                    <span class='chip red lighten-5'><span
                                                            class='red-text'>Supprimer</span></span>
                                                </a>
                                            </td> --}}
                                            <td>
                                                <a id="{{ $collecte['id'] }}"
                                                   href="{{ url('/information-climatique/collecte/' . $collecte['id']) }}">
                                                                <span class='chip green lighten-5'><span
                                                                        class='green-text'> <i class="material-icons">history</i> </span></span>
                                                </a>
                                            </td>
                                        </tr>

                                        {{-- @endif --}}
                                    @elseif (isset($_SESSION['role_user']) && in_array($_SESSION['role_user'], ['GESTIONNAIRE BD',"RESPONSABLE OP"]) && (Str::upper($collecte['groupement']) === Str::upper($_SESSION['nomGroupement'])))
                                        {{-- {{dd($collecte_data)}} --}}
                                        <tr>
                                            <td>{{ $collecte['gestionnaire'] }}</td>
                                            <td>{{ $collecte['qte'] }}</td>
                                            <td>{{ $collecte['cumul'] }}</td>
                                            <td>{{ $collecte['phenom'] }}</td>
                                            <td>{{ $collecte['total_jp'] }}</td>
                                            <td>{{ $collecte['pluvio'] }}</td>
                                            <td>{{ $collecte['date'] }}</td>
                                            <td>
                                                <a id="{{ $collecte['id'] }}" href="#" class="btn-delete-collecte">
                                                                <span class='chip red lighten-5'><span
                                                                        class='red-text'>Supprimer</span></span>
                                                </a>
                                            </td>
                                            <td>
                                                <a id="{{ $collecte['id'] }}"
                                                   href="{{ url('/information-climatique/collecte/' . $collecte['id']) }}">
                                                                <span class='chip green lighten-5'><span
                                                                        class='green-text'> <i class="material-icons">history</i> </span></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @elseif ($_SESSION['role'] === "MLOUMER" && (isset($_SESSION['id_pluvio']) && $_SESSION['id_pluvio'] == $collecte['id_pluvio']))
                                        {{-- {{dd($collecte_data)}} --}}
                                        {{-- @if (isset($_SESSION['id_pluvio']) && $_SESSION['id_pluvio'] == $collecte['id_pluvio']) --}}
                                        <tr>
                                            <td>{{ $collecte['gestionnaire'] }}</td>
                                            <td>{{ $collecte['qte'] }}</td>
                                            <td>{{ $collecte['cumul'] }}</td>
                                            <td>{{ $collecte['phenom'] }}</td>
                                            <td>{{ $collecte['total_jp'] }}</td>
                                            <td>{{ $collecte['pluvio'] }}</td>
                                            <td>{{ $collecte['date'] }}</td>
                                            {{-- <td>
                                                <a id="{{ $collecte['id'] }}" href="#" class="btn-delete-collecte">
                                                    <span class='chip red lighten-5'><span
                                                            class='red-text'>Supprimer</span></span>
                                                </a>
                                            </td> --}}
                                            <td>
                                                <a id="{{ $collecte['id'] }}"
                                                   href="{{ url('/information-climatique/collecte/' . $collecte['id']) }}">
                                                            <span class='chip green lighten-5'><span
                                                                    class='green-text'> <i class="material-icons">history</i> </span></span>
                                                </a>
                                            </td>
                                        </tr>
                                        {{-- @endif --}}
                                    @elseif ($_SESSION['role'] === "ONG" &&  (isset($_SESSION['nom_entite']) && $_SESSION['nom_entite'] == $collecte['entite']))
                                        <tr>
                                            <td>{{ $collecte['gestionnaire'] }}</td>
                                            <td>{{ $collecte['qte'] }}</td>
                                            <td>{{ $collecte['cumul'] }}</td>
                                            <td>{{ $collecte['phenom'] }}</td>
                                            <td>{{ $collecte['total_jp'] }}</td>
                                            <td>{{ $collecte['pluvio'] }}</td>
                                            <td>{{ $collecte['date'] }}</td>
                                            {{-- <td>
                                                <a id="{{ $collecte['id'] }}" href="#" class="btn-delete-collecte">
                                                    <span class='chip red lighten-5'><span
                                                            class='red-text'>Supprimer</span></span>
                                                </a>
                                            </td> --}}
                                            <td>
                                                <a id="{{ $collecte['id'] }}"
                                                   href="{{ url('/information-climatique/collecte/' . $collecte['id']) }}">
                                                            <span class='chip green lighten-5'><span
                                                                    class='green-text'> <i class="material-icons">history</i> </span></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @else
                                    @endif
                                @endforeach
                                </tbody>
                                <tfoot>
                                <th>Expéditeur</th>
                                <th>Quantité</th>
                                <th>Cumul</th>
                                <th>Phenomene</th>
                                <th>Jours de pluie</th>
                                <th>Pluvio</th>
                                {{-- <th>Reseau</th> --}}
                                <th>Date</th>
                                {{-- <th>Supprimer</th> --}}
                                @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN']) || (isset($_SESSION['role_user']) && in_array($_SESSION["role_user"],["GESTIONNAIRE BD"])))
                                    {{-- <th>Push</th> --}}
                                    <th>Supprimer</th>
                                    <th>Historique d'envoi</th>

                                @endif
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </li>
            @endif


            {{-- <div class="collapsible-body">
                <div class="row">
                    <div class="input-field col s12">
                        <select class="select2 browser-default" id="date" name="date">
                            @foreach ($collecte_data as $c)
                                <option value="">{{$c['date']}}</option>
                            @endforeach

                        </select>
                        <label class="active" for="date">Date d'envoi</label>
                    </div>
                </div> --}}
            {{-- {{-- CONTAIN
            <table id="datatable" class="table">
                <thead>
                    <tr>
                        <th>Expéditeur</th>
                        <th>Destinataire</th>
                        <th>Canal</th>
                        <th>Etat</th>
                    </tr>
                </thead>
                <tbody id="">
                    {{-- @foreach ($entitiesList as $entities)
                    <tr>
                        <td>User</td>
                        <td>Producteur</td>
                        <td>USSD</td>
                        <td>
                            <a>
                                <span class='chip green lighten-5'><span
                                      class='green-text'>Délivré</span>
                                </span>
                            </a>
                        </td>

                    </tr>
                    {{-- @endforeach

                </tbody>
            </table>

        </div>
    </li> --}}

        </ul>
    </section>
@endsection
@section('other-js-script')
    <script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/extra-components-sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/providers/message.js') }}"></script>
    <script>
        // $('#pluvio').focus(function (e) {
        //     e.preventDefault();
        $('#pluvio').select2({
            /* the following code is used to disable x-scrollbar when click in select input and
            take 100% width in responsive also */
            dropdownParent: "#new-collecte-modal",
            dropdownAutoWidth: true,
            width: '100%',
            // z:10000
            // containerCssClass: 'select-sm'
        });

        // });
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.print.min.js"></script>
@endsection
