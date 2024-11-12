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
    {{ $_SESSION['nom_entite'] }}
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/ferme/administration">Administration</a>
    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Liste des demandes administratives
    </li>
@endsection

@include('gestion.ferme.administration.create')
<section class="users-list-wrapper section">
    <div class="users-list-table">
        <div class="card">
            <div class="row right mr-5 mt-2">
                <form method="POST" action="{{ url('admin/utilisateurs/filter') }}">
                    @csrf
                    @if ($_SESSION['profil'] != 'MANAGER' || $_SESSION['profil'] == 'PRESIDENT')
                        <div class=" display-flex align-items-center show-btn right">
                            <a style="margin-left: 90px" type="button"
                                class="create-activite modal-trigger btn green waves-effect waves-light btn-sm "
                                href="#create-demande">
                                <i class="material-icons">add_circle
                                </i>Demande
                            </a>
                        </div>
                    @endif

                </form>
            </div>
            <div class="card-content mt-4">
                <!-- datatable start -->
                <div class="responsive-table">
                    <table id="" class="table data-table">
                        <thead>
                            <tr>

                                @if ($_SESSION['profil'] == 'MANAGER')
                                    <th>User</th>
                                    <th>Type</th>
                                    <th>Motif</th>
                                    <th>Date debut</th>
                                    <th>Date Fin</th>
                                    <th>Justificatif</th>
                                    <th>Commentaire</th>
                                    <th>Etat</th>
                                    <th>Action</th>
                                @else
                                    <th>Type</th>
                                    <th>Motif</th>
                                    <th>Date debut</th>
                                    <th>Date Fin</th>
                                    <th>Justificatif</th>
                                    <th>Commentaire</th>
                                    <th>Etat</th>
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody id="">
                            @isset($demandes)
                                @foreach ($demandes as $entities)
                                    @php
                                        $id = $entities['id'];
                                    @endphp
                                    @if ($_SESSION['profil'] == 'MANAGER' || $_SESSION['profil'] == 'PRESIDENT')
                                        <tr>
                                            <td>{{ $entities['nom_demandeur'] }} {{ $entities['prenom_demandeur'] }} </td>
                                            <td>{{ $entities['type'] }} </td>
                                            <td>{{ $entities['motif'] }} </td>

                                            <td>{{ $entities['date_debut'] }} </td>
                                            <td>{{ $entities['date_fin'] }} </td>
                                            <td>
                                                @if (strcmp($entities['justificatif'], '') == 0)
                                                    -
                                                @else
                                                    <a href="{{ asset('storage/' . $entities['justificatif']) }}"
                                                        target="_blank">
                                                        <i class="material-icons green-text ">file_download</i>
                                                    </a>
                                                @endif
                                            </td>

                                            <td>
                                                @if (strcmp($entities['commentaire'], '') == 0)
                                                    <a href='{{ url("/ferme/administration/demande/edit/$id") }}'
                                                        class="btn-small indigo">Commentaire</a>
                                                @else
                                                    {{ $entities['commentaire'] }}
                                                @endif
                                            </td>
                                            <td>

                                                @if ($entities['etat'] == 1)
                                                    <a id="" href='#' class=''><span
                                                            class=''><span class='green-text'>Validé</span></span></a>
                                                @else
                                                    @if ($entities['etat'] == 0)
                                                        <a id="" href='#' class=''><span
                                                                class=''><span class='yellow-text'>En
                                                                    cours...</span></span></a>
                                                    @else
                                                        <a id="" href='#' class=''><span
                                                                class=''><span
                                                                    class='red-text'>Rejeté</span></span></a>
                                                    @endif
                                                @endif
                                            </td>

                                            <td>

                                                @if ($entities['etat'] == 0)
                                                    <a id="{{ $id }}" href='#' class='valider_demande'>
                                                        <span class='chip '
                                                            style="background-color: transparent !important">
                                                            <span class='green-text'><i class="material-icons"
                                                                    title="valider">done</i>
                                                            </span>
                                                        </span>
                                                    </a>
                                                    <a id="{{ $id }}" href='#' class='rejeter_demande'>
                                                        <span
                                                            class='chip'style="background-color: transparent !important">
                                                            <span class='red-text'><i
                                                                    class="material-icons"title="rejeter">close</i>
                                                            </span>
                                                        </span>
                                                    </a>
                                                @else
                                                    -
                                                @endif
                                            </td>


                                        </tr>
                                    @else
                                        @if ($entities['demandeur_profil_id'] == $_SESSION['id'])
                                            <tr>
                                                <td>{{ $entities['type'] }} </td>
                                                <td>{{ $entities['motif'] }} </td>

                                                <td>{{ $entities['date_debut'] }} </td>
                                                <td>{{ $entities['date_fin'] }} </td>
                                                <td>
                                                    @if (strcmp($entities['justificatif'], '') == 0)
                                                        -
                                                    @else
                                                        <a href="{{ asset('storage/' . $entities['justificatif']) }}"
                                                            target="_blank">
                                                            <i class="material-icons green-text ">file_download</i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (strcmp($entities['commentaire'], '') != 0)
                                                        {{ $entities['commentaire'] }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($entities['etat'] == 1)
                                                        <a id="" href='#' class=''><span
                                                                class=''><span
                                                                    class='green-text'>Validé</span></span></a>
                                                    @else
                                                        @if ($entities['etat'] == 0)
                                                            <a id="" href='#' class=''><span
                                                                    class=''><span class='yellow-text'>En
                                                                        cours...</span></span></a>
                                                        @else
                                                            <a id="" href='#' class=''><span
                                                                    class=''><span
                                                                        class='red-text'>Rejeté</span></span></a>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($entities['etat'] == 0)
                                                        <a href='{{ url("/ferme/administration/demande/edit/$id") }}'
                                                            class="px-1">
                                                            <i class="material-icons orange-text">
                                                                edit
                                                            </i>
                                                        </a>
                                                        <a href="#" id="{{ $id }}"
                                                            class="px-1 delete_demande">
                                                            <i class="material-icons red-text">
                                                                delete
                                                            </i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
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

<script src="{{ asset('assets/js/providers/ferme_activite.js') }}"></script>
@endsection
