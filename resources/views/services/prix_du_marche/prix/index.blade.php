@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('page-title')
    Prix du Marché
@endsection
@section('ariane')
    <li class="breadcrumb-item"><a href="/dashboard">Accueil</a></li>
    <li class="breadcrumb-item active "><a class="yellow-text" href="#">Prix du Marché</a></li>
@endsection

@section('main_content')
    <section class="users-list-wrapper section">

        <div class="users-list-table">
            <div class="card">
                <div class="card-content">
                    <div class="row col12">
                        <div class="mt-1">
                            @if ($_SESSION['role'] == 'ADMIN')
                                <a class="waves-effect waves-light  green darken-1 btn modal-trigger right"
                                    href="#modal-diffusion"> <i class="material-icons">add</i> Nouvelle Liste
                                </a>
                                <a class="waves-effect waves-light  green darken-1 btn modal-trigger right mr-1"
                                    href="#modal-prix"> <i class="material-icons">add</i> Nouveau prix
                                </a>
                            @else
                                <a class="waves-effect waves-light  green darken-1 btn modal-trigger right"
                                    href="#modal-diffusion"> <i class="material-icons">add</i> Nouvelle Liste
                                </a>
                                <a class="waves-effect waves-light  green darken-1 btn modal-trigger right mr-1"
                                    href="#modal-prix"> <i class="material-icons">add</i> Nouveau prix
                                </a>
                            @endif
                        </div>
                        <div id="modal-diffusion" class="modal">
                            <div class="modal-content">
                                <h4 class="card-title">Nouvelle Diffusion De Prix</h4>
                                <div class="divider mt-2"></div>
                                <form id="form-producteur-list-prix" method="POST" action="#"
                                    enctype="multipart/form-data">
                                    @csrf
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
                                                <option value="" disabled selected>Choisissez le département
                                                </option>
                                            </select>
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
                                    @if (in_array($_SESSION['role'], ['ADMIN', 'SUPERADMIN']))
                                        <div class="row">
                                            <div class="col s12 m6 l12">
                                                <div class="input-field">
                                                    <select class=" up browser-default" id="reseau" name="reseau">
                                                        <option value="" disabled selected>Choisissez le réseau
                                                        </option>
                                                        @isset($groupements)
                                                            @foreach ($groupements as $groupement)
                                                                <option value="{{ $groupement['id_groupement'] }}">
                                                                    {{ $groupement['libelle'] }}
                                                                </option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                    <label class="active" for="users-list-status">Réseau</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col s12 m6 l12">
                                            <div class="file-field input-field">
                                                <div class="btn">
                                                    <span>Fichier</span>
                                                    <input type="file" name="pplist">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path" name="glist_name" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m6 l12">
                                            <a href=" {{ asset('assets/modelsListe/prod_prix.xlsx') }}"
                                                class=" waves-effect waves-green btn-flat"><span>Télécharger le
                                                    modéle</span><i class="material-icons">file_download</i></a>
                                            <a id="new-producteur-list-prix"
                                                class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Modal Structure -->
                        <div id="modal-prix" class="modal">
                            <div class="modal-content">
                                <h4 class="card-title">Nouveau Prix</h4>
                                <div class="divider mt-2"></div>
                                <form method="POST" id="formAddPrix" action="/prix-du-marche/prix/store">
                                    @csrf
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <select class="1 browser-default" id="cat_produit" name="cat_produit">
                                                <option value="" disabled selected>Catégorie Produit</option>
                                            </select>
                                            <label class="active" for="cat_produit">Catégorie Produit</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <select class="2 browser-default" id="produit" name="produit">
                                                <option value="" disabled selected>--Produit--</option>
                                            </select>
                                            <label class="active" for="produit">Produit</label>
                                        </div>
                                    </div>

                                    <div class="row" id="varieties">


                                    </div>

                                    <div class="row">
                                        <div class="input-field col s6">
                                            <select class="4 browser-default" id="unite" name="unite" required>
                                                <option value="" disabled selected>Unité</option>
                                                @isset($unites)
                                                    @foreach ($unites as $item)
                                                        <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            {{-- <label for="unite" class="col-form-label">Unité</label> --}}
                                        </div>

                                        <div class="input-field col s6">
                                            <select class="5 browser-default" id="market" name="market" required>
                                                <option value="" disabled selected>Marché</option>
                                                @isset($marches)
                                                    @foreach ($marches as $item)
                                                        <option value="{{ $item['id'] }}">{{ $item['market'] }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input id="date" type="text" class="datepicker" name="date"
                                                required>
                                            <label class="active" for="date">Date</label>
                                        </div>

                                    </div>


                                    {{-- <div class="row">
                                        <div class="input-field col s6">
                                            <input id="prix_detaillant" type="number" class="validate"
                                                name="prix_detaillant">
                                            <label class="active" for="prix_detaillant">Prix Détaillant</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="prix_en_gros" type="number" class="validate"
                                                name="prix_en_gros">
                                            <label class="active" for="prix_en_gros">Prix En Gros</label>
                                        </div>
                                    </div> --}}



                                    <div class="row">
                                        <div class="input-field col s12">
                                            <div class="col s12 display-flex justify-content-end mt-1">
                                                <button id="formAddPrixbtn" type="button" class="btn indigo">
                                                    Enregistrer
                                                </button>
                                                <a href="#!"
                                                    class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{-- <div class="modal-footer">
                                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                            </div> --}}
                        </div>
                    </div>
                    <div>
                        <div class="mt-3">
                            {{-- {{dd($prix)}} responsive-table --}}
                            <table id = "prixTable" class="table s3 m5 l5">
                                <thead>
                                    <tr>
                                        <th>Catégorie</th>
                                        <th>Produit</th>
                                        <th>Variété</th>
                                        <th>Unité</th>
                                        <th>Prix En Gros</th>
                                        <th>Prix Détaillant</th>
                                        <th>Marché</th>
                                        <th>Région</th>
                                        <th>Type de Marché</th>
                                        <th>Date</th>

                                        @if (in_array($_SESSION['role'], ['ADMIN', 'SUPERADMIN']))
                                            <th>Validité</th>
                                            <th>Etat</th>
                                            <th class="text-center">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @isset($prix)
                                        @foreach ($prix as $item)
                                            @if (
                                                ($item['type_market'] === 'journalier' &&
                                                    (new Datetime(date('Y-m-d')))->diff(new Datetime($item['date_creation']))->d <= 2 &&
                                                    (new Datetime(date('Y-m-d')))->diff(new Datetime($item['date_creation']))->m == 0 &&
                                                    (new Datetime(date('Y-m-d')))->diff(new Datetime($item['date_creation']))->y == 0) ||
                                                    ($item['type_market'] === 'hebdomadaire' &&
                                                        (new Datetime(date('Y-m-d')))->diff(new Datetime($item['date_creation']))->d <= 7 &&
                                                        (new Datetime(date('Y-m-d')))->diff(new Datetime($item['date_creation']))->m == 0 &&
                                                        (new Datetime(date('Y-m-d')))->diff(new Datetime($item['date_creation']))->y == 0))
                                                <tr>
                                                    <td>{{ $item['cat_produit'] }}</td>
                                                    <td>{{ $item['produit'] }}</td>
                                                    <td>{{ Str::ucfirst($item['variete']) }}</td>
                                                    <td>{{ $item['unite'] }}</td>
                                                    <td>{{ $item['prix_en_gros'] }}</td>
                                                    <td>{{ $item['prix_detaillant'] }}</td>
                                                    <td>{{ $item['marche'] }}</td>
                                                    <td>{{ $item['region'] }}</td>
                                                    <td>{{ $item['type_market'] }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($item['date_creation'])) }}</td>

                                                    @if (in_array($_SESSION['role'], ['ADMIN', 'SUPERADMIN']))
                                                        @if ($item['valide'])
                                                            <td>
                                                                <a href='#' id="{{ $item['id'] }}"
                                                                    class='set-price-state'>
                                                                    <span class='chip green lighten-5'><span
                                                                            class='green-text'>Validé</span></span>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href="{{ url('/prix-du-marche/prix/push/' . $item['id']) }}"
                                                                    id="valide" class='inactif'>
                                                                    <span class='chip green lighten-5'><span
                                                                            class='green-text'>push</span></span>
                                                                </a>
                                                            </td>
                                                        @elseif ($item['valide'] == false)
                                                            <td>
                                                                <a href='#' id="{{ $item['id'] }}"
                                                                    class='set-price-state'>
                                                                    <span class='chip yellow lighten-5'><span
                                                                            class='yellow-text'>en
                                                                            attente</span></span>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <p>
                                                                    <span class='chip red lighten-5'><span
                                                                            class='red-text'>...</span></span>
                                                                </p>
                                                            </td>
                                                        @endif
                                                        {{-- <td>
                                                        <a href="{{url('/prix-du-marche/prix/push/'.$item['id'])}}" id="push" class=''>
                                                            <span class='chip green lighten-5'><span class='green-text'>push</span></span>
                                                        </a>
                                                    </td> --}}
                                                        <td>
                                                            <a href="/prix-du-marche/prix/modifier/{{ $item['id'] }}">
                                                                <i class="material-icons orange-text ">edit</i>
                                                            </a>
                                                            <a href="#" class="px-1"
                                                                onclick="deletePrix({{ $item['id'] }})">
                                                                <i class="material-icons red-text ">delete</i>
                                                            </a>
                                                        </td>
                                                    @elseif (in_array($_SESSION['role'], ['ADMIN', 'SUPERADMIN']))
                                                        <td>
                                                            <a href='#' id="{{ $item['id'] }}"
                                                                class='set-price-state'>
                                                                <span class='chip yellow lighten-5'><span
                                                                        class='yellow-text'>en
                                                                        attente</span></span>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <p>
                                                                <span class='chip red lighten-5'><span
                                                                        class='red-text'>...</span></span>
                                                            </p>
                                                        </td>
                                                    @endif




                                                </tr>
                                            @endif
                                        @endforeach
                                    @endisset
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Catégorie</th>
                                        <th>Produit</th>
                                        <th>Variété</th>
                                        <th>Unité</th>
                                        <th>Prix En Gros</th>
                                        <th>Prix Détaillant</th>
                                        <th>Marché</th>
                                        <th>Région</th>
                                        <th>Type de Marché</th>
                                        <th>Date</th>

                                        @if (in_array($_SESSION['role'], ['ADMIN', 'SUPERADMIN']))
                                            <th>Validité</th>
                                            <th>Etat</th>
                                            <th class="text-center">Actions</th>
                                        @endif
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    {{-- @include('services.informations_climatiques.parametrage.pluvio.edit') --}}

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
    {{-- <script src="{{ asset('assets/js/scripts/card-advanced.js') }}"></script> --}}
    <script src="{{ asset('assets/js/crud/services/prix/message.js') }}"></script>


    <script>
        $(document).ready(() => {

            $('#prixTable tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');

            });

            var table = $('#prixTable').DataTable({
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
                    var r = $('#prixTable tfoot tr');
                    r.find('th').each(function() {
                        $(this).css('padding', 8);
                    });
                    $('#prixTable thead').append(r);
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
