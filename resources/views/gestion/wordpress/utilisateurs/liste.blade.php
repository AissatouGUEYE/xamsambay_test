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
    Utilisateurs
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/louma-mbay/utilisateurs">Utilisateurs</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text">Liste des Utilisateurs</a>
    </li>
@endsection

<section class="users-list-wrapper section">
    <div class="users-list-filter">
        {{-- <div class="card-panel">
            <div class="row">
                
            </div>
        </div> --}}
    </div>
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">

                <a type="button" class="waves-effect waves-light green darken-1 btn modal-trigger right"
                    href="{{ url('/louma-mbay/utilisateurs/create') }}"><i class="material-icons">add_circle</i>
                    Utilisateur</a>
                <!-- datatable start -->
                {{-- <div class="responsive-table"> --}}
                <table id="data-table-simple" class="table">
                    <thead>
                        <tr>
                            {{-- <th>ID</th> --}}
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôles</th>
                            {{-- <th class="text-center">Actions</th>   --}}
                        </tr>
                    </thead>
                    <tbody id="">
                        @isset($data)
                            @foreach ($data as $item)
                                <tr>

                                    <td class=" ">

                                        @if (strcmp($item['first_name'], '') == 0)
                                            -
                                        @else
                                            {{ $item['first_name'] }}
                                        @endif

                                    </td>

                                    <td class=" ">

                                        @if (strcmp($item['last_name'], '') == 0)
                                            -
                                        @else
                                            {{ $item['last_name'] }}
                                        @endif

                                    </td>

                                    <td>{{ $item['email'] }}</td>

                                    <td>
                                        @foreach ($item['roles'] as $role)
                                            @if (strcmp($role, 'customer') == 0)
                                                <ul>Client</ul>
                                            @elseif (strcmp($role, 'wcfm_vendor') == 0)
                                                <ul>Propriétaire de magasin</ul>
                                            @elseif (strcmp($role, 'subscriber') == 0)
                                                <ul>Abonné</ul>
                                            @elseif (strcmp($role, 'disable_vendor') == 0)
                                                <ul>Vendeur désactivé</ul>
                                            @elseif (strcmp($role, 'administrator') == 0)
                                                <ul>Administrateur</ul>
                                            @else
                                                <ul>{{ $role }}</ul>
                                            @endif
                                        @endforeach
                                    </td>
                                    {{-- <td> --}}

                                    {{-- <a href="/louma-mbay/utilisateurs/modifier/{{ $item['id'] }}">
                                            <i class="material-icons orange-text ">edit</i>
                                        </a>
                                        <a href="/louma-mbay/utilisateurs/supprimer/{{ $item['id'] }}" class="px-1">
                                            <i class="material-icons red-text ">delete</i>
                                        </a> --}}
                                    {{-- </td> --}}

                                    {{-- <td class="text-center"><a href="/modifierProduit/{{ $item['id'] }}" class='btn btn-info btn-sm btnEditer'>Editer</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/supprimerProduit/{{ $item['id'] }}" class='btn btn-danger btn-sm btnSupprimer'>Supprimer</a></td> --}}
                                </tr>
                            @endforeach
                        @endisset

                    </tbody>
                </table>
                {{-- </div> --}}
                <!-- datatable ends -->
            </div>
        </div>
    </div>
</section>
@endsection

@section('other-js-script')
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
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

<script type="text/javascript">
    $(document).ready(function() {

        $('#myTable').DataTable();
    });
</script>
@endsection
