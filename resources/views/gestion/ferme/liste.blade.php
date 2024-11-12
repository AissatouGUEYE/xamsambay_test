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
    Ferme
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/listeferme">Fermes</a>
    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Liste
    @endsection
    {{-- 
    @include('gestion.ferme.createFerme')
    @include('gestion.ferme.create-liste-ferme') --}}
    <section class="users-list-wrapper section">

        <div class="users-list-table">
            <div class="card ">
                <div class="row right mr-5 mt-2">
                    <form method="POST" action="{{ url('admin/utilisateurs/filter') }}">
                        @csrf
                        <div class=" display-flex align-items-center show-btn  ">
                            <a style="margin-left: 90px" type="button"
                                class=" modal-trigger btn green waves-effect waves-light btn-sm " href="#create-ferme">
                                <i class="material-icons">add_circle
                                </i>Ferme

                            </a>
                            <a style="margin-left: 90px" type="button"
                                class=" modal-trigger btn green waves-effect waves-light btn-sm "
                                href="#create-liste-ferme">
                                <i class="material-icons">add_circle
                                </i>Par liste

                            </a>
                        </div>

                    </form>
                </div>


                <div class="card-content mt-4">



                    <!-- datatable start -->
                    <div class="responsive-table">
                        <table id="" class="table data-table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Debut contrat</th>
                                    <th>Duree (mois)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                @isset($entite)
                                    @foreach ($entite as $ferme)
                                        <tr>
                                            <td>{{ $ferme->nom_entite }}</td>
                                            <td>{{ $ferme->date_debut }}</td>
                                            <td>{{ $ferme->duree }}</td>

                                            <td>
                                                <a href="#" id="{{ $ferme->id_entite }}" class="px-1 delete_ferme">
                                                    <i class="material-icons red-text">
                                                        delete
                                                    </i>
                                                </a>
                                                <a href="{{ url("/listeferme/edit/$ferme->id_entite") }}" id=""
                                                    class="px-1 mr-10 edit_ferme">
                                                    <i class="material-icons yellow-text">
                                                        edit
                                                    </i>
                                                </a>
                                                <a href='{{ url("/listeferme/details/$ferme->id_entite") }}'
                                                    class="btn-small indigo">

                                                    Details
                                                </a>
                                                {{-- je dois supprimer et modifier une ferme --}}

                                            </td>
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

        {{-- modal structure --}}
        <div id="create-liste-ferme" class="modal">
            <form method="POST" id="formAddfermeList" action="{{ route('ferme.create.list') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="col s12">
                    <div class="card">
                        <div class="card-content pb-0">
                            <div class="card-header mb-2">
                                <h4 class="card-title"> Nouvelle liste Ferme Agricole</h4>
                            </div>
                            <div class="users-list-table">
                                <div class="card-body">
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
                                            <a href=" {{ asset('assets/modelsListe/model_ferme.xlsx') }}"
                                                class=" waves-effect waves-green btn-flat"><span>Télécharger le
                                                    modéle</span><i class="material-icons">file_download</i></a>

                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="input-field col s12">
                                            <div class="row" class="load"></div>
                                            <div class="col s12 display-flex justify-content-end mt-1">
                                                <button type="submit">
                                                    creer
                                                </button>
                                                {{-- <a id="formAddFermeListBtn" href="javascript:void(0)"
                                                    class="btn indigo">
                                                    Créer</a> --}}
                                                <a href="#!"
                                                    class="modal-action modal-close waves-effect waves-red btn-flat">Annuler</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>

        <div id="create-ferme" class="modal">
            <form method="POST" id="formAddferme" action="{{ route('ferme.create') }}">
                @csrf
                <div class="col s12">
                    <div class="card">
                        <div class="card-content pb-0">
                            <div class="card-header mb-2">
                                <h4 class="card-title"> Nouvelle Ferme Agricole</h4>
                            </div>
                            <div class="users-list-table">
                                <div class="card-body">
                                    <div class="row">


                                        <div class="input-field col s6">
                                            <input id="nomFerme" type="text" class="nomFerme" name="nomFerme">
                                            <label class="active" for="nomFerme">Nom</label>
                                        </div>


                                        <div class="input-field col s6">
                                            <input id="descriptionFerme" type="text" class="descriptionFerme"
                                                name="descriptionFerme">
                                            <label class="active" for="descriptionFerme">Description</label>
                                        </div>


                                    </div>
                                    <div class="row">

                                        <div class="input-field col s6">
                                            <input id="date_debut" type="date" class="date_debut" name="date_debut" required>
                                            <label class="active" for="date_debut">Debut contrat</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="duree" type="text" class="duree" name="duree" required>
                                            <label class="active" for="duree">Duree (mois)</label>
                                        </div>
                                    </div>
                                    <div id="lieu">
                                        <div class="row">
                                            <div class="input-field col s4">
                                                <select class="select2 browser-default" id="pays"
                                                    name="pays">
                                                    <option value="" disabled selected>Pays</option>
                                                </select>
                                                <label class="active" for="pays">Pays</label>
                                            </div>
                                            <div class="input-field col s4">
                                                <select class="select2 browser-default region" id="region"
                                                    name="region">
                                                    <option value="" disabled selected>--Région--</option>
                                                </select>
                                                <label class="active" for="region">Région</label>
                                            </div>
                                            <div class="input-field col s4">
                                                <select class="select2 browser-default dept" id="dept"
                                                    name="dept">
                                                    <option value="" disabled selected>--Département--</option>

                                                </select>
                                                <label class="active" for="dept">département</label>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="input-field col s6">
                                                <select class="select2 browser-default commune" id="commune"
                                                    name="commune">
                                                    <option value="" disabled selected>--Commune--</option>
                                                </select>
                                                <label class="active" for="commune">Commune</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <select class="select2 browser-default localite" id="localite"
                                                    name="localite" class="validate">
                                                    <option value="" disabled>--Localité--</option>
                                                </select>
                                                <label class="active" for="localite">Localité</label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="input-field col s12">
                                            <div class="row" id="load"></div>
                                            {{-- <button id="formAddUserbtn" type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Enregistrer</button> --}}
                                            <div class="col s12 display-flex justify-content-end mt-1">

                                                <a id="formAddFermeBtn" href="javascript:void(0)" class="btn indigo">
                                                    Créer</a>
                                                <a href="#!"
                                                    class="modal-action modal-close waves-effect waves-red btn-flat">Annuler</a>
                                                {{-- <button type="button" class="ml-1 btn btn-light">Annuler</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>

    </section>

@endsection

@section('other-js-script')
    {{-- <script src="{{ asset('assets/js/providers/ferme_activite.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets\js\providers\produits.js') }}"></script> --}}
    <script src="{{ asset('assets\js\providers\ferme_profils.js') }}"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->


    {{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
    {{-- <script type="text/javascript">$(".select2").select2({
  dropdownAutoWidth: true,
  width: '100%'
});</script> --}}
@endsection
