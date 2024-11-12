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
        <a href="/ferme/utilisateurs">Utilisateurs</a>
    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Listes des utilisateurs
    </li>
@endsection
{{-- faire un controle suivant qu'on est president ou pas --}}
@if ($_SESSION['profil'] == 'PRESIDENT' || $_SESSION['profil'] == 'MANAGER')
    <section class="users-list-wrapper section">
        <div class="users-list-table">
            <div class="card">
                <div class="card-content">

                    <div class="row right mr-5 mt-2">
                        @if ($_SESSION['profil'] == 'MANAGER' || $_SESSION['profil'] == 'PRESIDENT')
                            <div class=" display-flex align-items-center show-btn right">
                                <a type="button" class="btn green waves-effect waves-light btn-sm "
                                    href="{{ url('ferme/utilisateurs/create') }}"><i
                                        class="material-icons">add_circle</i>
                                    Utilisateur</a>

                            </div>
                        @endif
                    </div>
                    <!-- datatable start -->
                    <div class="responsive-table">
                        <table id="statsTable" class="table display striped">
                            <thead>
                                <tr>
                                    <th>Utilisateur</th>
                                    <th>Sexe</th>
                                    <th>Rôle</th>
                                    <th>Statut</th>
                                    @if ($_SESSION['profil'] == 'MANAGER')
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="">
                                @isset($users)
                                    @foreach ($users as $entities)
                                        <tr>
                                            {{-- <td hidden></td> --}}
                                            <td>{{ $entities->prenom }} {{ $entities->nom }}</td>
                                            {{-- <td>{{ date('D M Y', strtotime($entities->dt_naiss)) }}</td> --}}
                                            <td>{{ $entities->sexe }}</td>

                                            <td>{{ $entities->role }}</td>
                                            @if ($entities->actif == 0)
                                                <td><a id="{{ $entities->utilisateur }}" href='#'
                                                        class='active-user'><span class='chip red lighten-5'><span
                                                                class='red-text'>Inactif</span></span></a></td>
                                            @else
                                                <td><a id="{{ $entities->utilisateur }}" href='#'
                                                        class='deactive-user'><span class='chip green lighten-5'><span
                                                                class='green-text'>Actif</span></span></a></td>
                                            @endif
                                            @if ($_SESSION['profil'] == 'MANAGER')
                                                <td><a href='{{ url("ferme/utilisateur/$entities->utilisateur") }}'><i
                                                            class="material-icons">visibility</i></a> <a
                                                        href='{{ url("/ferme/utilisateurs/profil/edit/$entities->utilisateur") }}'
                                                        class="px-1"><i class="material-icons orange-text ">edit</i></a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endisset

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Utilisateur</th>
                                    <th>Sexe</th>
                                    <th>Rôle</th>
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
@endif
@endsection

@section('other-js-script')
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
{{-- <script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>

<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script> --}}

{{-- <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\edit.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\create.js') }}"></script>
<script src="{{ asset('assets\js\providers\location.js') }}"></script> --}}
{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
{{-- <script src="{{ asset('assets\js\providers\entity.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\read.js') }}"></script>
{{-- <script src="{{ asset('assets\js\crud\gestion\utilisateurs\filter.js') }}"></script> --}}
{{-- <script src="{{ asset('assets\js\crud\gestion\utilisateurs\role\read.js') }}"></script> --}}
<script src="{{ asset('assets\js\providers\set_state.js') }}"></script>

{{-- <script type="text/javascript">$(".select2").select2({
  dropdownAutoWidth: true,
  width: '100%'
});</script> --}}
@endsection
