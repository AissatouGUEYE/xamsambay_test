@extends('layouts.master')
@section('other-css-files')
    {{-- {{dd($_SESSION)}} --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/producteurs-table.css') }}">
@endsection
@section('page-title')
    Producteurs
@endsection
{{-- @php --}}
{{-- @endphp --}}
@section('ariane')
    <li class="breadcrumb-item"><a href="/dashboard">Accueil</a></li>
    <li class="breadcrumb-item active "><a class="yellow-text" href="/producteurs">Producteurs</a></li>
    <li class="breadcrumb-item active yellow-text">Liste Producteurs</li>
@endsection

@section('main_content')
    {{-- {{dd($_SESSION)}} --}}
    <section class="users-list-wrapper section">
        <div class="users-list-filter">
            @include('services.informations_climatiques.campagne-meteo.campagne-actif')
        </div>
        <div class="users-list-table">
            <div class="card">
                <div class="card-content">
                    <br>
                    @if (in_array($_SESSION['role'], ['SUPERADMIN', 'ADMIN', 'ONG']))
                        <a id="lpf" class="waves-effect waves-light  green darken-1 btn modal-trigger right"
                            href="{{ route('create.producteur') }}"> <i class="material-icons">add</i> Nouveau Producteur
                        </a>
                        <a class="waves-effect waves-light  green darken-1 btn modal-trigger right mr-1" href="#prod"> <i
                                class="material-icons">add</i> Nouvelle liste de Producteur
                        </a>
                    @endif
                    <!-- Modal Structure -->
                    <div id="prod" class="modal">
                        <div class="modal-content">
                            <h4>Nouvelle liste de producteur</h4>
                            <div class="divider mt-2"></div>
                            <form id="form-producteur-list" method="POST" action="#" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col s12 m6 l6">
                                        <div class="input-field">
                                            <select class="up browser-default region" id="reg" name="region">
                                                <option value="" disabled selected>Choisissez le région</option>
                                                @foreach ($regions as $region)
                                                    <option value="{{ $region->id }}">{{ $region->region }}</option>
                                                @endforeach
                                            </select>
                                            <label class="active" for="users-list-status">Région</label>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l6">
                                        <div class="input-field">
                                            <select class=" up browser-default dept" id="" name="date">
                                                <option value="" disabled selected>Choisissez le département</option>
                                            </select>
                                            {{-- <label class="active" for="users-list-role">Etat</label> --}}

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m6 l6">
                                        <div class="input-field">
                                            <select class=" up browser-default commune" id="" name="pluvio">
                                                <option value="" disabled selected>Choisissez le commune</option>

                                            </select>
                                            <label class="active" for="users-list-status">Commune</label>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l6">
                                        <div class="input-field">
                                            <select class=" up browser-default localite" id="" name="localite">
                                                <option value="" disabled selected>Choisissez la localité</option>
                                                {{-- <option value="">Localité 1</option> --}}
                                            </select>
                                            <label class="active" for="users-list-status">Localité</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m6 l6">
                                        <div class="input-field">
                                            <select class=" up browser-default" id="reseau" name="reseau">
                                                <option value="" disabled selected>Choisissez le réseau</option>
                                                @foreach ($reseaux as $reseau)
                                                    <option value="{{ $reseau->id_groupement }}">{{ $reseau->libelle }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label class="active" for="users-list-status">Réseau</label>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l6 ">
                                        <div class="input-field">
                                            <select class=" up browser-default" id="pluvio" name="pluvio">
                                                <option value="" disabled selected>Choisissez le pluvio</option>
                                                @foreach ($pluvios as $pluvio)
                                                    <option value="{{ $pluvio->id }}">{{ $pluvio->localite }}</option>
                                                @endforeach
                                            </select>
                                            <label class="active" for="users-list-status">Pluvio</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m6 l10">
                                        <div class="file-field input-field">
                                            <div class="btn">
                                                <span>Fichier</span>
                                                <input type="file" name="glist">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path" name="glist_name" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m6 l12">
                                        <a href=" {{ asset('assets/modelsListe/model_producteur.xlsx') }}"
                                            class=" waves-effect waves-green btn-flat"><span>Télécharger le modéle</span><i
                                                class="material-icons">file_download</i></a>
                                        <a id="new-producteur-list"
                                            class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">
                                            Enregister
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">

                            <a href="#!"
                                class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                        </div>
                    </div>
                    <div id="listProd" class="modal">
                        <div class="modal-content">
                            <h4>Nouveau Producteur</h4>

                            <div class="divider mt-2"></div>
                            <form method="POST" id="form-producteurs-create" action="#">
                                @csrf
                                <div class="col s12">
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input id="prenom" type="text" class="validate" name="prenom">
                                            <label class="active" for="prenom">Prénom</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="nom" type="text" class="validate" name="nom">
                                            <label class="active" for="nom">Nom</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <div class="row">
                                                <label>
                                                    <p>
                                                        <input value="M" name="sexe" type="radio" required />
                                                        <span>Homme</span>
                                                    </p>
                                                </label>
                                            </div>
                                            <div class="row">
                                                <label>
                                                    <p>
                                                        <input value="F" name="sexe" type="radio" required />
                                                        <span>Femme</span>
                                                    </p>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="dt_naiss" type="text" class="datepicker" name="dtNaiss">
                                            <label class="active" for="dt_naiss">Date de naissance</label>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="input-field col s6">
                                            <input id="telephone" type="number" class="validate" name="telephone">
                                            <label class="active" for="telephone">Téléphone</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="email" type="email" class="validate" name="email">
                                            <label class="active" for="email">Email</label>
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="input-field col s6">
                                            <select class="browser-default" id="" name="status">
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
                                            <select class=" lp browser-default region" id="" name="region">
                                                <option value="" disabled selected>--Région--</option>
                                            </select>
                                            <label class="active" for="region">Région</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <select class=" lp browser-default dept" id="" name="dept">
                                                <option value="" disabled selected>--Département--</option>

                                            </select>
                                            <label class="active" for="dept">département</label>
                                        </div>
                                    </div>
                                    <div class="row">


                                        <div class="input-field col s6">
                                            <select class=" lp browser-default commune" id="" name="commune">
                                                <option value="" disabled selected>--Commune--</option>
                                            </select>
                                            <label class="active" for="commune">Commune</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <select class=" lp browser-default localite" id="" name="localite">
                                                <option value="" disabled>--Localité--</option>
                                            </select>
                                            <label class="active" for="localite">Localité</label>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <select class=" lp browser-default" id="" name="reseau">
                                                <option value="" disabled selected>Choisissez le reseau</option>
                                                @foreach ($reseaux as $reseau)
                                                    <option value="{{ $reseau->id_groupement }}">{{ $reseau->libelle }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label class="active" for="users-list-status">Reseau</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <select class="lp browser-default" id="" name="pluvio">
                                                <option value="" disabled selected>Choisissez le pluvio</option>
                                                @foreach ($pluvios as $pluvio)
                                                    <option value="{{ $pluvio->id }}">{{ $pluvio->localite }}</option>
                                                @endforeach
                                            </select>
                                            <label class="active" for="users-list-status">Pluvio</label>
                                        </div>

                                    </div>
                                    <div class="row">


                                        <div class="input-field col s6">
                                            <select class=" browser-default" id="" name="canal">
                                                <option value="" disabled selected>Choisissez le canal</option>
                                                <option value="SMS">SMS</option>
                                                <option value="VOICE">VOICE</option>


                                            </select>
                                            <label class="active" for="users-list-status">Canal de réception</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <select class=" browser-default" id="" name="langue">
                                                <option value="" disabled selected>Choisissez la langue de reception
                                                </option>
                                                @foreach ($langues as $langue)
                                                    <option value="{{ $langue->id }}">{{ $langue->langue }}</option>
                                                @endforeach
                                            </select>
                                            <label class="active" for="users-list-status">Langue</label>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <select class=" browser-default" multiple="multiple" name="produit[]">
                                            @foreach ($produits as $produit)
                                                <option value="{{ $produit->id }}">{{ $produit->produit }}</option>
                                            @endforeach
                                        </select>
                                        <label class="active" for="users-list-status">Spéculation</label>

                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <div class="row" id="load"></div>
                                            {{-- <button id="formAddUserbtn" type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Enregistrer</button> --}}
                                            <div class="col s12 display-flex justify-content-end mt-1">
                                                <button id="btn-create-producteur" type="submit" class="btn indigo">
                                                    Enregistrer
                                                </button>
                                                {{-- <button type="button" class="ml-1 btn btn-light">Annuler</button> --}}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                        </div>

                        <div class="modal-footer">
                            <a href="#!"
                                class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 5% !important">
                        {{-- {{dd($producteurs)}} --}}
                        <table id="statsTable" class="table display">
                            <thead>
                                <tr>
                                    <th>Prenom Nom</th>
                                    <th>Téléphone</th>
                                    <th>Genre</th>
                                    <th>Pluvio</th>
                                    <th>Localité</th>

                                    @if (in_array($_SESSION['role'], ['ADMIN', 'SUPERADMIN']))
                                        <th>Etat</th>
                                    @endif
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                @if (in_array($_SESSION['role'], ['ADMIN', 'SUPERADMIN']))
                                    @foreach ($producteurs as $producteur)
                                        {{-- @if ($_SESSION['role'] === 'GERANT') --}}
                                        <tr>
                                            <td>{{ $producteur->prenom }} {{ $producteur->nom }}</td>
                                            <td>{{ $producteur->telephone }}</td>
                                            <td>{{ isset($producteur->sexe) ? $producteur->sexe : '---' }}</td>
                                            </td>
                                            <td>
                                                {{ isset($producteur->pluvio) ? $producteur->pluvio : '---' }}</td>
                                            <td>{{ $producteur->localite }}</td>
                                            @if ($producteur->actif == true)
                                                <td>
                                                    <a href='#' id='{{ $producteur->utilisateur }}'
                                                        class='inactif deactive-user'>
                                                        <span class='chip green lighten-5'><span
                                                                class='green-text'>Actif</span></span>
                                                    </a>
                                                </td>
                                            @else
                                                <td>
                                                    <a href='#' id="{{ $producteur->utilisateur }}"
                                                        class='inactif active-user'>
                                                        <span class='chip red lighten-3'><span
                                                                class='red-text'>Inactif</span></span>
                                                    </a>
                                                </td>
                                            @endif
                                            <td>
                                                <a href='{{ url("producteur/$producteur->utilisateur") }}'><i
                                                        class="material-icons">visibility</i></a>
                                                <a href='{{ url("producteurs/edit/$producteur->utilisateur") }}'
                                                    class="px-1"><i class="material-icons orange-text ">edit</i></a>

                                            </td>
                                        </tr>
                                        {{-- @endif --}}
                                    @endforeach
                                @elseif (in_array($_SESSION['role'], ['ONG']))
                                    @for ($i = 0; $i < count($producteur_groupement); $i++)
                                        @foreach ($producteur_groupement[$i] as $producteur)
                                            <tr>
                                                <td>{{ $producteur->prenom }} {{ $producteur->nom }}</td>
                                                <td>{{ $producteur->telephone }}</td>
                                                <td>{{ isset($producteur->sexe) ? $producteur->sexe : '---' }}</td>
                                                <td>{{ isset($producteur->pluvio) ? $producteur->nom_pluvio : '---' }}</td>
                                                <td>{{ $producteur->localite }}</td>
                                                {{-- @if ($producteur->actif == true)
                                                    <td>
                                                        <a href='#' id='{{ $producteur->id_utilisateur }}'
                                                            class='inactif deactive-user'>
                                                            <span class='chip green lighten-5'><span
                                                                    class='green-text'>Actif</span></span>
                                                        </a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a href='#' id="{{ $producteur->id_utilisateur }}"
                                                            class='inactif active-user'>
                                                            <span class='chip red lighten-3'><span
                                                                    class='red-text'>Inactif</span></span>
                                                        </a>
                                                    </td>
                                                @endif --}}
                                                <td>
                                                    <a href='{{ url("producteur/$producteur->id_utilisateur") }}'><i
                                                            class="material-icons">visibility</i></a>

                                                    <a href='{{ url("producteurs/edit/$producteur->id_utilisateur") }}'
                                                        class="px-1"><i class="material-icons orange-text ">edit</i></a>
                                                    {{-- Url en Chantier sera bientot prete {{ url("producteurs/edit/$producteur->id_utilisateur") }} --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endfor
                                @elseif (isset($_SESSION['role_user']) && in_array($_SESSION['role_user'], ['GERANT PLUVIO']))
                                    {{-- {{dd($producteurs)}} --}}
                                    @foreach ($producteurs as $producteur)
                                        @if (isset($producteur->id_pluvio) && isset($_SESSION['id_pluvio']) && $producteur->id_pluvio == $_SESSION['id_pluvio'])
                                            <tr>
                                                <td>{{ $producteur->prenom }} {{ $producteur->nom }}</td>
                                                <td>{{ $producteur->telephone }}</td>
                                                <td>{{ isset($producteur->sexe) ? $producteur->sexe : '---' }}</td>
                                                <td>{{ isset($producteur->pluvio) ? $producteur->pluvio : '---' }}</td>
                                                <td>{{ $producteur->localite }}</td>
                                                {{-- @if ($producteur->actif == true)
                                                    <td>
                                                        <a href='#' id='{{ $producteur->utilisateur }}'
                                                            class='inactif deactive-user'>
                                                            <span class='chip green lighten-5'>
                                                                <span class='green-text'>Actif</span>
                                                            </span>
                                                        </a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a href='#' id="{{ $producteur->utilisateur }}"
                                                            class='inactif active-user'>
                                                            <span class='chip red lighten-3'>
                                                                <span class='red-text'>Inactif</span>
                                                            </span>
                                                        </a>
                                                    </td>
                                                @endif --}}
                                                <td>
                                                    <a href='{{ url("producteur/$producteur->utilisateur") }}'><i
                                                            class="material-icons">visibility</i></a>

                                                    <a href='{{ url("producteurs/edit/$producteur->utilisateur") }}'
                                                        class="px-1"><i class="material-icons orange-text ">edit</i></a>
                                                    {{-- Url en Chantier sera bientot prete {{ url("producteurs/edit/$producteur->id_utilisateur") }} --}}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @elseif (isset($_SESSION['role_user']) && in_array($_SESSION['role_user'], ['GESTIONNAIRE BD', 'RESPONSABLE OP']))
                                    {{-- {{dd($producteurs)}} --}}
                                    @foreach ($producteurs as $producteur)
                                        @if (isset($producteur->nom_groupement) &&
                                                isset($_SESSION['nomGroupement']) &&
                                                $producteur->nom_groupement === $_SESSION['nomGroupement']
                                        )
                                            <tr>
                                                <td>{{ $producteur->prenom }} {{ $producteur->nom }}</td>
                                                <td>{{ $producteur->telephone }}</td>
                                                <td>{{ isset($producteur->sexe) ? $producteur->sexe : '---' }}</td>
                                                <td>{{ isset($producteur->pluvio) ? $producteur->pluvio : '---' }}</td>
                                                <td>{{ $producteur->localite }}</td>
                                                {{-- @if ($producteur->actif == true)
                                                    <td>
                                                        <a href='#' id='{{ $producteur->utilisateur }}'
                                                            class='inactif deactive-user'>
                                                            <span class='chip green lighten-5'>
                                                                <span class='green-text'>Actif</span>
                                                            </span>
                                                        </a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a href='#' id="{{ $producteur->utilisateur }}"
                                                            class='inactif active-user'>
                                                            <span class='chip red lighten-3'>
                                                                <span class='red-text'>Inactif</span>
                                                            </span>
                                                        </a>
                                                    </td>
                                                @endif --}}
                                                <td>
                                                    <a href='{{ url("producteur/$producteur->utilisateur") }}'><i
                                                            class="material-icons">visibility</i></a>

                                                    <a href='{{ url("producteurs/edit/$producteur->utilisateur") }}'
                                                        class="px-1"><i class="material-icons orange-text ">edit</i></a>
                                                    {{-- Url en Chantier sera bientot prete {{ url("producteurs/edit/$producteur->id_utilisateur") --}}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Prenom</th>
                                    <th>Téléphone</th>
                                    <th>Genre</th>
                                    <th>Pluvio</th>
                                    <th>Localité</th>
                                    @if (in_array($_SESSION['role'], ['ADMIN', 'SUPERADMIN']))
                                        <th>Etat</th>
                                    @endif
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('other-js-script')
    <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/extra-components-sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/providers/message.js') }}"></script>
    <script src="{{ asset('assets/js/providers/set_state.js') }}"></script>
    <script src="{{ asset('assets/js/providers/progress.js') }}"></script>
    <script src="{{ asset('assets/js/crud/gestion/delete.js') }}"></script>
    <script src="{{ asset('assets/js/crud/gestion/edit.js') }}"></script>
    <script src="{{ asset('assets/js/crud/gestion/update.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/card-advanced.js') }}"></script>
    <script>
        $(document).ready(() => {
            // alert('work');
            $('#producteurTable tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');

            });

            var table = $('#producteurTable').DataTable({
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

                    var r = $('#producteurTable tfoot tr');
                    r.find('th').each(function() {
                        $(this).css('padding', 8);
                    });
                    $('#producteurTable thead').append(r);
                    $('#search_0').css('text-align', 'center');
                },
            });
        });
    </script>
@endsection
