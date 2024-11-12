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

    <div id="my-element" data-total-data="{{ json_encode(session('total_data')) }}">
        {{-- data-nb-prod="{{ json_encode(session('nb_prod')) }}"
        data-duplicated-num="{{ json_encode(session('duplicated_num')) }}"
        data-duplicated-mail="{{ json_encode(session('duplicated_mail')) }}"> --}}
    </div>


    <div class="users-list-table">
        <div class="card">
            <div class="card-content">


                <div class="col s12 m12 l12 display-flex align-items-center show-btn">

                    <h5>Liste des Membres de {{ $libelle }}<h5>

                </div>


                {{-- <a class="waves-effect waves-light  green darken-1 btn modal-trigger right" href="#modal1"> <i
                        class="material-icons">add</i> Membre
                </a> --}}

                <a class="waves-effect waves-light  green darken-1 btn modal-trigger right mr-1" href="#prod"> <i
                        class="material-icons">add</i> Liste de Membres
                </a>


                {{-- <a class="waves-effect waves-light  green darken-1 btn modal-trigger right mr-1" href="#prod"> <i
                        class="material-icons">add_circle</i> Nouvelle liste de Membres
                    </a>

                    <a type="button" class="btn green waves-effect waves-light btn-sm ml-3 modal-trigger"
                        href="#modal1"><i class="material-icons">add_circle</i>
                        Membre</a> --}}

                <div id="modal1" class="modal">
                    <div class="modal-content">
                        <h4>Nouveau membre</h4>
                        <div class="divider mt-2"></div>
                        <form method="POST"
                            action="/groupements/membres/ajouter/{{ $libelle }}/{{ $id }}"
                            id="add_membre">
                            @csrf
                            <div class="row">
                                <div class="input-field col s6">

                                    <select class="select" id="producteur" name="producteur">

                                        <option value="" disabled selected>Choisissez le Producteur</option>

                                        @foreach ($producteurs as $item)
                                            <option value="{{ $item['id_profil'] }}">{{ $item['prenom'] }}
                                                {{ $item['nom'] }} {{ $item['localite'] }}
                                            </option>
                                        @endforeach

                                    </select>

                                    {{-- <label for="producteur" class="col-form-label">Producteur</label> --}}

                                </div>
                            </div>

                            <div class="row">
                                {{-- id="ajouter_membre" --}}
                                <button type="button" id="ajouter_membre"
                                    class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                    </div>
                </div>



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

            </div>






            <!-- datatable start -->
            <div class="responsive-table">
                <table id="membreTable" class="table">
                    <thead>
                        <tr>
                            {{-- <th>ID</th> --}}
                            <th>Prénom et Nom</th>
                            {{-- <th>Date de naissance</th> --}}
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Sexe</th>
                            <th>Adresse</th>

                            {{-- <th class="text-center">Actions</th>   --}}
                        </tr>
                    </thead>
                    <tbody id="">
                        @isset($membres)
                            @foreach ($membres as $item)
                                <tr>
                                    <td>
                                        @if (strcmp($item['prenom'], '') == 0)
                                            --
                                        @else
                                            {{ $item['prenom'] }} {{ $item['nom'] }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (strcmp($item['telephone'], '') == 0)
                                            --
                                        @else
                                            {{ $item['telephone'] }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (strcmp($item['email'], '') == 0)
                                            --
                                        @else
                                            {{ $item['email'] }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (strcmp($item['nom_typentite'], '') == 0)
                                            --
                                        @else
                                            {{ $item['nom_typentite'] }}
                                        @endif
                                    </td>
                                    {{-- <td>
                                        @if (strcmp($item['dt_naiss'], '') == 0)
                                            --
                                        @else
                                            @php echo date('d/m/Y', strtotime($item['dt_naiss']));  @endphp
                                        @endif
                                    </td> --}}
                                    <td>
                                        @if (strcmp($item['sexe'], '') == 0)
                                            --
                                        @else
                                            {{ $item['sexe'] }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (strcmp($item['localite'], '') == 0)
                                            --
                                        @else
                                            {{ $item['localite'] }}
                                        @endif
                                    </td>


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
        </div>
    </div>
    </div>
</section>
@endsection

@section('other-js-script')
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->

{{-- @if (!is_null(session('total_data')) || !is_null(session('nb_prod')) || !is_null(session('duplicated_num')) || !is_null(session('duplicated_mail'))) --}}
@if (!is_null(session('total_data')))
    <script>
        $(document).ready(function() {
            var totalData = $('#my-element').data('total-data');

            swal({
                title: "Enrégistrement Réussi !",
                text: "Vous avez ajouté " + totalData + " Producteur(s)",
                icon: 'success'
            })

            // var nbProd = $('#my-element').data('nb-prod');
            // var duplicatedNum = $('#my-element').data('duplicated-num');
            // var duplicatedMail = $('#my-element').data('duplicated-mail');

            // if (totalData == nbProd)
            // {
            //     swal({
            //         title: "Enrégistrement Réussi !",
            //         text: "Vous avez ajouté " + nbProd + " Producteur(s)",
            //         icon: 'success'
            //     })
            // }
            // else
            // {
            //     swal({
            //         title: "Avertissement !",
            //         text: `Vous avez ajouté `+nbProd+` Producteur(s) sur `+ totalData +`. \nLes numéros suivants existent déjà dans la base: `+duplicatedNum+` Les mails suivants existent déjà dans la base: `+duplicatedMail+`.`,
            //         icon: "warning"
            //     });

            // swal({
            //     title: "Erreur!",
            //     html: `
        //         <div>Vous avez ajouté ${nbProd} Producteur(s) sur ${totalData}.</div>
        //         <ul>
        //             <li>Les numéros suivants existent déjà dans la base:</li>
        //             <ul>
        //                 ${duplicatedNum.map(num => `<li>${num}</li>`).join("")}
        //             </ul>
        //             <li>Les mails suivants existent déjà dans la base:</li>
        //             <ul>
        //                 ${duplicatedMail.map(mail => `<li>${mail}</li>`).join("")}
        //             </ul>
        //         </ul>
        //     `,
            //     icon: "warning"
            // });

            // }
        });
    </script>
@endif

<script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>

<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>

{{-- <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script> --}}
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>

<script src="{{ asset('assets/js/crud/gestion/groupements/message.js') }}"></script>

<script src="{{ asset('assets/js/crud/gestion/groupements/delete.js') }}"></script>

<script src="{{ asset('assets/js/crud/gestion/groupements/localite.js') }}"></script>
@endsection
