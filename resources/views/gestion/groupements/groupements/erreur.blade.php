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
    Groupements
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/groupements">Groupements</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text">Liste des Membres</a>
    </li>
@endsection

<section class="users-list-wrapper section">
    <div class="users-list-filter">
        {{-- <div class="card-panel">
            <div class="row">



            </div>
        </div> --}}
    </div>

    <div id="my-element" data-total-data="{{ $total_data }}" data-nb-prod="{{ $nb_prod }}">
    </div>

    <div class="users-list-table">
        <div class="card">
            <div class="card-content">


                <div class="col s12 m12 l12 display-flex align-items-center show-btn">

                    <h5>{{ $libelle }}<h5>

                </div>
                <br>


                {{-- <a class="waves-effect waves-light  green darken-1 btn modal-trigger right" href="#modal1"> <i
                        class="material-icons">add</i> Membre
                    </a> --}}

                <a class="waves-effect waves-light  green darken-1 btn modal-trigger right mr-1" href="#prod"> <i
                        class="material-icons">add</i> Liste de Membres
                </a>
                

                <div id="prod" class="modal">
                    <div class="modal-content">
                        <h4>Nouvelle liste de producteurs</h4>
                        <div class="divider mt-2"></div>
                        <form id="form-producteur-list" method="POST"
                            action="/groupements/liste_membres/ajouter/{{ $libelle }}/{{ $id }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="input-field col s6">
                                    <select class="select2insideprod browser-default" id="pays1" name="pays">
                                        <option value="" disabled selected>Pays</option>
                                    </select>
                                    <label class="active" for="pays">Pays</label>
                                </div>
                                <div class="input-field col s6">
                                    <select class="select2insideprod browser-default" id="region1" name="region">
                                        <option value="" disabled selected>--Région--</option>
                                    </select>
                                    <label class="active" for="region">Région</label>
                                </div>
                            </div>


                            <div class="row">
                                <div class="input-field col s6">
                                    <select class="select2insideprod browser-default" id="dept1" name="dept">
                                        <option value="" disabled selected>--Département--</option>
                                    </select>
                                    <label class="active" for="dept">Département</label>
                                </div>
                                <div class="input-field col s6">
                                    <select class="select2insideprod browser-default" id="commune1" name="commune">
                                        <option value="" disabled selected>--Commune--</option>
                                    </select>
                                    <label class="active" for="commune">Commune</label>
                                </div>
                            </div>


                            <div class="row">
                                <div class="input-field col s6">
                                    <select class="select2insideprod browser-default" id="localite1" name="localite">
                                        <option value="" disabled selected>--Localité--</option>
                                    </select>
                                    <label class="active" for="localite1">Localité</label>
                                </div>

                                <div class="input-field col s6">
                                    <select class="select2insideprod browser-default" id="pluvio" name="pluvio">
                                        <option value="" disabled selected>--- Pluvio ---</option>
                                        {{-- @foreach ($pluvios as $item)
                                                <option value="{{ $item['id'] }}"> {{ $item['localite'] }}</option>
                                            @endforeach --}}
                                    </select>
                                    <label class="active" for="pluvio">Pluvio</label>
                                </div>


                            </div>

                            <div class="row">

                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>Fichier</span>
                                        <input type="file" name="plist" accept=".xls, .xlsx">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path" name="plist_name" type="text">
                                    </div>
                                </div>

                                <div class=" ">
                                    <a href=" {{ asset('assets/modelsListe/model_membre.xlsx') }}"
                                        class=" waves-effect waves-green btn-flat"><span>Télécharger le modéle</span><i
                                            class="material-icons">file_download</i></a>
                                    <button id="ajouter_list_membre"
                                        class="waves-effect waves-light green darken-1 s2 m6 l3 btn right"
                                        type="button">Enregistrer</button>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#!"
                            class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                    </div>
                </div>



                <div id="migrer_phone" class="modal">
                    <div class="modal-content">
                        <h4>Migration Producteurs</h4>
                        <div class="divider mt-2"></div>
                        <form id="form-migrer-phone" method="POST"
                            action="/groupements/liste_membres/migrer_phone/{{ $libelle }}/{{ $id }}"
                            enctype="multipart/form-data">
                            @csrf


                            <div class="row">

                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span> Téléverser Fichier</span>
                                        <input type="file" name="phonelist" accept=".xls, .xlsx">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path" name="phonelist" type="text">
                                    </div>
                                </div>


                            </div>

                            <div class="row">

                                <div class=" ">
                                    <button id="ajouter_list_phone"
                                        class="waves-effect waves-light green darken-1 s2 m6 l3 btn right"
                                        type="button">Enregistrer</button>
                                </div>

                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#!"
                            class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                    </div>
                </div>



                <div id="migrer_mail" class="modal">
                    <div class="modal-content">
                        <h4>Migration Producteurs</h4>
                        <div class="divider mt-2"></div>
                        <form id="form-migrer-mail" method="POST"
                            action="/groupements/liste_membres/migrer_mail/{{ $libelle }}/{{ $id }}"
                            enctype="multipart/form-data">
                            @csrf


                            <div class="row">

                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span> Téléverser Fichier</span>
                                        <input type="file" name="maillist" accept=".xls, .xlsx">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path" name="maillist" type="text">
                                    </div>
                                </div>


                            </div>

                            <div class="row">

                                <div class=" ">
                                    <button id="ajouter_list_mail"
                                        class="waves-effect waves-light green darken-1 s2 m6 l3 btn right"
                                        type="button">Enregistrer</button>
                                </div>

                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#!"
                            class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                    </div>
                </div>



                @if ($nb_num != 0)
                    {{-- <div class="divider mt-2"></div> --}}
                    <br><br><br>
                    <h5> Ces numéros existent déjà dans la base </h5>
                    <br>
                    <!-- datatable start -->
                    <div class="responsive-table">
                        <table id="phoneTable" class="table">
                            <thead>
                                <tr>
                                    <th>Prénom et Nom</th>
                                    <th>Localité</th>
                                    <th>Commune</th>
                                    <th>Département</th>
                                    <th>Région</th>
                                    <th>Téléphone</th>
                                    <th>Groupement</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                @isset($duplicated_num)
                                    @foreach ($duplicated_num as $item)
                                        <tr>
                                            <td>
                                                @if (strcmp($item['prenom'], '') == 0)
                                                    --
                                                @else
                                                    {{ $item['prenom'] }} {{ $item['nom'] }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (strcmp($item['localite_name'], '') == 0)
                                                    --
                                                @else
                                                    {{ $item['localite_name'] }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (strcmp($item['commune_name'], '') == 0)
                                                    --
                                                @else
                                                    {{ $item['commune_name'] }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (strcmp($item['dept_name'], '') == 0)
                                                    --
                                                @else
                                                    {{ $item['dept_name'] }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (strcmp($item['region_name'], '') == 0)
                                                    --
                                                @else
                                                    {{ $item['region_name'] }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (strcmp($item['telephone'], '') == 0)
                                                    --
                                                @else
                                                    {{ $item['telephone'] }}
                                                @endif
                                            </td>
                                            <td class="phone_groupement-cell"></td>

                                            {{-- <td> --}}
                                            {{-- <a href="/groupements/membres/delete/{{ $libelle }}/{{ $id }}/{{ $item['id'] }}" class="px-1">
                                            <i class="material-icons red-text ">delete</i>
                                        </a> --}}
                                            {{-- <a href="#" onclick="deleteMembre({{$item['id']}})" class="px-1">
                                            <i class="material-icons red-text ">delete</i>
                                        </a> --}}
                                            {{-- </td> --}}
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                    <!-- datatable ends -->

                    <br>
                    <div style="justify-content: center; align-items: center; margin-left: 170px">
                        {{-- <h6>
                        Si vous voulez migrer ces producteurs vers le groupement {{ $libelle }} Merci de
                        Télécharger le fichier puis
                        <a class="waves-effect waves-light darken-1 blue modal-trigger" href="#migrer_phone"> Cliquez
                            ici
                        </a>.
                    </h6> --}}

                        <h6>
                            Si vous voulez migrer ces producteurs vers le groupement {{ $libelle }} Merci de
                            Télécharger le fichier puis
                            <a class="waves-effect waves-light darken-1 blue" href="/phone_form/{{ $libelle }}/{{ $id }}"
                                target="_blank"> Cliquez
                                ici
                            </a>.
                        </h6>
                    </div>
                @endif



                @if ($nb_mail != 0)
                    <br><br>
                    <div class="divider mt-2"></div>
                    <br><br>

                    <h5> Ces adresses mail existent déjà dans la base </h5>
                    <br>
                    <!-- datatable start -->
                    <div class="responsive-table">
                        <table id="mailTable" class="table">
                            <thead>
                                <tr>
                                    <th>Prénom et Nom</th>
                                    <th>Localité</th>
                                    <th>Commune</th>
                                    <th>Département</th>
                                    <th>Région</th>
                                    <th>Email</th>
                                    <th>Groupement</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                @isset($duplicated_mail)
                                    @foreach ($duplicated_mail as $item)
                                        <tr>
                                            <td>
                                                @if (strcmp($item['prenom'], '') == 0)
                                                    --
                                                @else
                                                    {{ $item['prenom'] }} {{ $item['nom'] }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (strcmp($item['localite_name'], '') == 0)
                                                    --
                                                @else
                                                    {{ $item['localite_name'] }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (strcmp($item['commune_name'], '') == 0)
                                                    --
                                                @else
                                                    {{ $item['commune_name'] }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (strcmp($item['dept_name'], '') == 0)
                                                    --
                                                @else
                                                    {{ $item['dept_name'] }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (strcmp($item['region_name'], '') == 0)
                                                    --
                                                @else
                                                    {{ $item['region_name'] }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (strcmp($item['email'], '') == 0)
                                                    --
                                                @else
                                                    {{ $item['email'] }}
                                                @endif
                                            </td>

                                            <td class="mail_groupement-cell"></td>

                                            {{-- <td> --}}
                                            {{-- <a href="/groupements/membres/delete/{{ $libelle }}/{{ $id }}/{{ $item['id'] }}" class="px-1">
                                            <i class="material-icons red-text ">delete</i>
                                        </a> --}}
                                            {{-- <a href="#" onclick="deleteMembre({{$item['id']}})" class="px-1">
                                            <i class="material-icons red-text ">delete</i>
                                        </a> --}}
                                            {{-- </td> --}}
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                    <!-- datatable ends -->
                    <br>
                    <div style="justify-content: center; align-items: center; margin-left: 170px">
                        <h6>
                            Si vous voulez migrer ces producteurs vers le groupement {{ $libelle }} Merci de
                            Télécharger le fichier puis
                            <a class="waves-effect waves-light darken-1 blue modal-trigger" href="/mail_form/{{ $libelle }}/{{ $id }}" target="_blank">
                                Cliquez
                                ici
                            </a>.
                        </h6>
                    </div>
                @endif



                    @if ( ($nb_num == 0) && ($nb_mail == 0) )

                        <br><br>
                        <div class="divider mt-2"></div>
                        <br><br>

                        <h5> Erreur, le fichier inséré n'est pas conforme au template fourni !!! </h5>

                    @endif

            </div>
        </div>
    </div>
</section>
@endsection

@section('other-js-script')
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->

<script src="{{ asset('assets/js/crud/gestion/groupements/erreur.js') }}"></script>

<script>
    $(document).ready(function() {

        var totalData = $('#my-element').data('total-data');
        var nbProd = $('#my-element').data('nb-prod');

        if (nbProd != 0) {
            swal({
                title: "Avertissement !",
                text: `Vous avez ajouté ` + nbProd + ` Producteur(s) sur ` + totalData,
                icon: "warning"
            });
        } else {
            swal({
                title: "Avertissement !",
                text: `Aucun Producteur Ajouté !`,
                icon: "warning"
            });
        }

    });
</script>


<script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>

<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>

{{-- <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script> --}}
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\edit.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\create.js') }}"></script>
<script src="{{ asset('assets\js\providers\location.js') }}"></script>
{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
<script src="{{ asset('assets\js\providers\entity.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\read.js') }}"></script>
{{-- <script src="{{ asset('assets\js\crud\gestion\utilisateurs\filter.js') }}"></script> --}}
<script src="{{ asset('assets\js\crud\gestion\utilisateurs\role\read.js') }}"></script>
<script src="{{ asset('assets\js\crud\gestion\utilisateurs\user-state.js') }}"></script>

<script src="{{ asset('assets/js/crud/gestion/groupements/message.js') }}"></script>

<script src="{{ asset('assets/js/crud/gestion/groupements/delete.js') }}"></script>

<script src="{{ asset('assets/js/crud/gestion/groupements/localite.js') }}"></script>

{{-- <script src="{{ asset('assets/js/crud/gestion/groupements/erreur.js') }}"></script> --}}

@endsection
