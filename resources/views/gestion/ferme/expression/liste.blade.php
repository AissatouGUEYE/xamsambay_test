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
        <a href="/ferme/eb">Expression des besoins</a>
    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Liste
    </li>
@endsection


{{-- faire un controle suivant qu'on est president ou pas --}}
{{-- @include('gestion.ferme.activite.create') --}}
@include('gestion.ferme.expression.view')
<section class="users-list-wrapper section">
    <div class="users-list-table" style="margin-top: 20px">
        <div class="card">
            <div class="card-content">
                <div class="row right mr-5 mt-2">
                    <form method="POST" action="{{ url('admin/utilisateurs/filter') }}">
                        @csrf

                        <div class=" display-flex align-items-center show-btn  right">
                            <a type="button" class="btn green waves-effect waves-light btn-sm "
                                href="{{ url('ferme/eb/create') }}"><i class="material-icons">add_circle</i>
                                Expression</a>
                        </div>

                    </form>
                </div>
                <!-- datatable start -->


                <div class="responsive-table">
                    <table id="" class="table data-table">
                        <thead>
                            <tr>
                                {{-- <th>Type activite</th> --}}
                                <th>Produit</th>
                                <th>Besoin</th>
                                <th>Justificatif</th>
                                <th>Statut </th>
                                <th>Action</th>
                                @if ($_SESSION['profil'] == 'MANAGER' || $_SESSION['profil'] == 'PRESIDENT')
                                    <th>Ajouter</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody id="">

                            @isset($eb)
                                @if (!in_array($_SESSION['profil'], [ 'MANAGER', 'PRESIDENT']))
                                    @foreach ($eb as $entities)
                                        @if ($entities->id_profil == $_SESSION['id'])
                                            <tr>
                                                <td>{{ $entities->produit }}</td>
                                                <td>{{ $entities->description }}</td>
                                                <td class=" ">

                                                    @if (strcmp($entities->justificatif, '') == 0)
                                                        -
                                                    @else
                                                        <a href="{{ asset('storage/' . $entities->justificatif) }}"
                                                            target="_blank">
                                                            <i class="material-icons green-text ">file_download</i>
                                                        </a>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($entities->actif_p == 2 && $entities->actif_m == 2)
                                                        <a id="{{ $entities->id }}" href='#' class=''><span
                                                                class=''><span
                                                                    class='green-text'>Validé</span></span></a>
                                                    @else
                                                        @if ($entities->actif_p == 1 || $entities->actif_m == 1)
                                                            <a id="{{ $entities->id }}" href='#' class=''><span
                                                                    class=''><span class='yellow-text'>En
                                                                        cours...</span></span></a>
                                                        @else
                                                            <a id="{{ $entities->id }}" href='#' class=''><span
                                                                    class=''><span
                                                                        class='red-text'>Rejeté</span></span></a>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href='#detail-eb' title="details" id="{{$entities->id}}"
                                                        class="detail_eb modal-trigger px-1"><i
                                                            class="material-icons yellow-text ">visibility</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                   
                                    @foreach ($eb as $entities)
                                        <tr>
                                            <td>{{ $entities->produit }}</td>
                                            <td>{{ $entities->description }}</td>
                                            <td class=" ">

                                                @if (strcmp($entities->justificatif, '') == 0)
                                                    -
                                                @else
                                                    <a href="{{ asset('storage/' . $entities->justificatif) }}"
                                                        target="_blank">
                                                        <i class="material-icons green-text ">file_download</i>
                                                    </a>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($entities->actif_p == 2 && $entities->actif_m == 2)
                                                    <a id="{{ $entities->id }}" href='#' class=''><span
                                                            class=''><span class='green-text'>Validé</span></span></a>
                                                @else
                                                    @if ($entities->actif_p == 1 || $entities->actif_m == 1)
                                                        <a id="{{ $entities->id }}" href='#' class=''><span
                                                                class=''><span class='yellow-text'>En
                                                                    cours...</span></span></a>
                                                    @else
                                                        <a id="{{ $entities->id }}" href='#' class=''><span
                                                                class=''><span
                                                                    class='red-text'>Rejeté</span></span></a>
                                                    @endif
                                                @endif
                                            </td>



                                            @if (strpos($_SESSION['profil'], "RESPONSABLE ACTIVITES") !== false)
                                                <td>
                                                    <input type="text" hidden id="root"
                                                        value="{{ route('ferme.eb') }}">
                                                    <a href='#' data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop" title="details"
                                                        class="px-1 detail_eb" id="{{ $entities->id }}"><i
                                                            class="material-icons yellow-text ">visibility</i>
                                                    </a>
                                                    @if ($entities->actif_m != 2 && $entities->actif_p != 2)
                                                        <a href='{{ url("/ferme/eb/edit/$entities->id") }}'
                                                            class="px-1"><i class="material-icons orange-text ">edit</i>
                                                        </a>
                                                        <a id="{{ $entities->id }}" href="#"
                                                            class="px-1 supprimer_eb">
                                                            <i class="material-icons red-text ">delete</i>
                                                        </a>
                                                    @endif


                                                </td>
                                            @endif

                                            @if ($_SESSION['profil'] == 'MANAGER' || $_SESSION['profil'] == 'PRESIDENT')
                                                <td>
                                                    <a href='{{ url("/ferme/eb/commentP/edit/$entities->id") }}'
                                                        class="btn-small indigo">Commentaire</a>
                                                </td>
                                                <td>

                                                    <a href='#detail-eb' title="details"  id="{{$entities->id}}"
                                                        class="detail_eb modal-trigger px-1"><i
                                                            class="material-icons yellow-text ">visibility</i>
                                                    </a>
                                                    @if ($entities->actif_m == 2)
                                                    @else
                                                        @if ($entities->actif_m == 0)
                                                        @else
                                                            <a id="{{ $entities->id }}" href='#'
                                                                class='activate_eb'>
                                                                <span class='chip '
                                                                    style="background-color: transparent !important">
                                                                    <span class='green-text'><i class="material-icons"
                                                                            title="valider">done</i>
                                                                    </span>
                                                                </span>
                                                            </a>
                                                            <a id="{{ $entities->id }}" href='#'
                                                                class='desactivate_eb'>
                                                                <span
                                                                    class='chip'style="background-color: transparent !important">
                                                                    <span class='red-text'><i
                                                                            class="material-icons"title="rejeter">close</i>
                                                                    </span>
                                                                </span>
                                                            </a>
                                                        @endif
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
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
<script src="{{ asset('assets\js\providers\produits.js') }}"></script>

{{-- <script src="{{ asset('assets\js\crud\gestion\ferme\create.js') }}"></script> --}}
@endsection
