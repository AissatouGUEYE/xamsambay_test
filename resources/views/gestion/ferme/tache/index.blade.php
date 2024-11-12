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
        <a href="/ferme/tache">Tâche</a>
    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Liste des tâches
    </li>
@endsection

@include('gestion.ferme.tache.create')
<section class="users-list-wrapper section">
    <div class="users-list-table">
        <div class="card">
            <div class="row right mr-5 mt-2">
                <form method="POST" action="{{ url('admin/utilisateurs/filter') }}">
                    @csrf
                    @if ($_SESSION['profil'] == 'MANAGER')
                        <div class=" display-flex align-items-center show-btn right">
                            <a style="margin-left: 90px" type="button"
                                class="create-tache modal-trigger btn green waves-effect waves-light btn-sm "
                                href="#create-tache">
                                <i class="material-icons">add_circle
                                </i>Tâche
                            </a>
                        </div>
                    @endif
                </form>
            </div>
            <div class="card-content ">
                <!-- datatable start -->
                <div class="responsive-table">
                    <table id="" class="table data-table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Assignateur</th>
                                <th>Assigné À</th>
                                <th>Debut</th>
                                <th>Fin Effective</th>
                                <th>Fin Prev.</th>
                                <th>Retard</th>
                                <th>Statut</th>
                                @if ($_SESSION['profil'] == 'MANAGER')
                                    <th>Action</th>
                                @endif
                                <th>Justificatif</th>

                            </tr>
                        </thead>
                        <tbody id="">
                            @isset($taches)
                                @foreach ($taches as $item)
                                    <tr>
                                        <td> {{ $item->nom }} </td>
                                        <td>
                                            @if (strcmp($item->description, '') == 0)
                                                -
                                            @else
                                                {{ $item->description }}
                                            @endif

                                        </td>
                                        <td>{{ $item->prenom_assignateur }} {{ $item->nom_assignateur }}</td>
                                        <td>{{ $item->prenom_assigne }} {{ $item->nom_assigne }}</td>
                                        <td>{{ $item->date_debut }}</td>
                                        <td>{{ $item->date_fin }}</td>
                                        <td>{{ $item->fin_prev }}</td>

                                        @php

                                            $d1 = new DateTime(date('d-m-Y', strtotime($item->fin_prev)));
                                            $d2 = new DateTime(date('d-m-Y', strtotime($item->date_fin)));
                                            $retard = $d1->diff($d2);
                                            // dd($retard->d)
                                        @endphp
                                        @if ($item->date_fin && $item->fin_prev)
                                            @if ($item->date_fin <= $item->fin_prev)
                                                <td class="green-text">{{ $retard->d }} j</td>
                                            @else
                                                <td class="red-text">-{{ $retard->d }}j</td>
                                            @endif
                                        @else
                                            <td>-</td>
                                        @endif

                                        <td>
                                            @if ($item->statut == 2)
                                                <a id="" href='#' class=''>
                                                    <span class=''><span class='green-text'>Terminé</span></span>
                                                </a>
                                            @else
                                                @if ($item->statut == 1)
                                                    <a id="" href='#' class=''><span
                                                            class=''><span class='yellow-text'>Démarée
                                                            </span></span></a>
                                                @else
                                                    <a id="" href='#' class=''><span
                                                            class=''><span class='red-text'>Non
                                                                démarée</span></span></a>
                                                @endif
                                            @endif
                                        </td>
                                        @if ($_SESSION['profil'] == 'MANAGER')
                                            <td>
                                                <a href='{{ url("ferme/tache/edit/$item->id") }}' class="px-1"><i
                                                        class="material-icons orange-text ">edit</i>
                                                </a>
                                                <a id="{{ $item->id }}" href="#" class="px-1 delete_tache">

                                                    <i class="material-icons red-text ">delete</i>
                                                </a>
                                            </td>
                                        @endif
                                        <td>
                                            @if (strcmp($item->justificatif, '') == 0)
                                                -
                                            @else
                                                <a href="{{ asset('storage/' . $item->justificatif) }}" target="_blank">
                                                    <i class="material-icons green-text ">file_download</i>
                                                </a>
                                            @endif
                                        </td>


                                    </tr>
                                @endforeach
                            @endisset

                        </tbody>
                        {{-- <tfoot>
                            <tr>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Assignateur</th>
                                <th>Assigné À</th>
                                <th>Debut</th>
                                <th>Fin Effective</th>
                                <th>Fin Prev.</th>
                                <th>Retard</th>

                                <th>Statut</th>
                                <th>Justificatif</th>
                                @if ($_SESSION['profil'] == 'MANAGER')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </tfoot> --}}
                    </table>
                </div>
                <!-- datatable ends -->
            </div>
        </div>
    </div>
</section>

@endsection

@section('other-js-script')
@endsection
