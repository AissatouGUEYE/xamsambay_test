@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('main_content')
    @php
        // dd($users);
    @endphp
    @section('page-title')
        {{ $_SESSION['nom_entite'] }}
    @endsection
    @section('ariane')
        <li class="breadcrumb-item">
            <a href="/dashboard">Accueil</a>
        </li>
        <li class="breadcrumb-item">

            <a href="/entite/fia">Utilisateurs</a>

        </li>
        <li class="breadcrumb-item active" style="color:#ffe900">Listes des Fournisseurs Intrants Agréé (FIA)
        </li>
    @endsection

    @include('gestion.utilisateurs.fia.create')


    <section class="users-list-wrapper section">
        <div class="users-list-table">
            <div class="card">

                <div class="row right mr-5 mt-2">
                    <div class=" display-flex align-items-center show-btn right">
                        <div class=" display-flex align-items-center show-btn right">
                            <a style="margin-left: 90px" type="button"
                               class="create-fia modal-trigger btn green waves-effect waves-light btn-sm "
                               href="#create-fia">
                                <i class="material-icons">add_circle
                                </i>FIA
                            </a>
                        </div>
                    </div>
                </div>

                {{-- <div class="green white-text"> Compte créé avec succes!</div> --}}

                <div class="card-content">
                    <!-- datatable start -->
                    <div class="responsive-table">
                        <table id="statsTable" class="table display striped">
                            <thead>
                            <tr>
                                <th>Utilisateur</th>
                                <th>Telephone</th>
                                {{-- <th>Commune</th> --}}
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="">
                            @isset($users)
                                @foreach ($users as $entities)
                                    <tr>
                                        <td>{{ Str::ucfirst($entities->prenom) }} {{ Str::upper($entities->nom) }}</td>
                                        <td>{{ $entities->telephone }}</td>
                                        {{-- <td>{{ $entities->commune }}</td> --}}

                                        @if ($entities->actif == 0)
                                            <td><a id="{{ $entities->utilisateur }}" href='#'
                                                   class='active-user'><span class='chip red lighten-5'><span
                                                            class='red-text'>Inactif</span></span></a></td>
                                        @else
                                            <td><a id="{{ $entities->utilisateur }}" href='#'
                                                   class='deactive-user'><span class='chip green lighten-5'><span
                                                            class='green-text'>Actif</span></span></a></td>
                                        @endif
                                        <td>
                                            <a href='{{ url("/entite/fia/communes/$entities->id_profil") }}'
                                               class="btn-small indigo">Communes</a>
                                               <a href='{{ url("/entite/fia/intrants/$entities->id_profil") }}'
                                                class="btn-small indigo">Intrants</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endisset

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Utilisateur</th>
                                <th>Telephone</th>
                                {{-- <th>Commune</th> --}}
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
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

    <script src="{{ asset('assets\js\crud\gestion\utilisateurs\create.js') }}"></script>

    <!-- BEGIN THEME  JS-->
@endsection
