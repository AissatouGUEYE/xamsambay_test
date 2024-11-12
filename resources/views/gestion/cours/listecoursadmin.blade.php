@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('main_content')
@section('page-title')
    Cours
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/louma-du-savoir/cours">Cours</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text">Liste des Cours</a>
    </li>
@endsection

<section class="users-list-wrapper section">
    
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <!-- datatable start -->
                <div class="responsive-table">
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                {{-- <th>ID</th> --}}
                                <th>Titre</th>
                                {{-- <th>Résumé du Cours</th> --}}
                                <th>Contenu du Cours</th>
                                <th class="text-center">Inscription</th> 
                                <th>Liste Inscrits</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            @isset($data)
                                @foreach ($data as $item)
                                <tr>
                                    {{-- <td>{{ $item['id'] }}</td> --}}
                                    <td>{{ $item['fullname'] }}</td>

                                    {{-- <td>{{ $item['summary'] }}</td> --}}
                                    <td><a class="btn block indigo waves-effect waves-light ml-1" href="/louma-du-savoir/cours/sujets/{{ $item['id'] }}"><i class="material-icons">visibility</i></a></td>
                                    <td>
                                        <a target="_blank" href="https://loumadusavoir.mlouma.org/course/view.php?id={{ $item['id'] }}" class="btn blue waves-effect waves-light btn-sm ml-3">S'inscrire</a>
                                    </td>
                                    <td><a class="btn green waves-effect waves-light btn-sm ml-3" href="/louma-du-savoir/cours/listeEtudiants/{{ $item['id'] }}">Participants</a></td>

                                    {{-- <td class="text-center"><a href="/modifierProduit/{{ $item['id'] }}" class='btn btn-info btn-sm btnEditer'>Editer</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/supprimerProduit/{{ $item['id'] }}" class='btn btn-danger btn-sm btnSupprimer'>Supprimer</a></td> --}}
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
    $(document).ready( function () {

        $('#myTable').DataTable();
    } );
</script>
@endsection
