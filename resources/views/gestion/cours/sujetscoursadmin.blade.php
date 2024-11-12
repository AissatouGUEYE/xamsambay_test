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
    Produits
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
                                <th>Sujets</th>
                                {{-- <th>Résumé</th> --}}
                                <th>Liste Modules</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            @isset($sujets)
                                @foreach ($sujets as $item)
                                <tr>
                                    {{-- <td>{{ $item['id'] }}</td> --}}
                                    <td>{{ $item['name'] }}</td>
                                    {{-- <td>{{ $item['summary'] }}</td> --}}

                                    <td>
                                        @foreach ($item['modules'] as $value )
                                        <ul>
                                            {{ $value['name'] }}
                                        </ul>
                                        @endforeach
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

    <div class="divider mt-2"></div>


    <div class = "row">

        <div class="col s12 m8 l8 display-flex align-items-center show-btn"></div>

        <div class="col s12 m4 l4 display-flex align-items-center show-btn">
        
            <a target="_blank" href="https://loumadusavoir.mlouma.org/course/view.php?id={{ $courseid }}" class="text-center btn blue waves-effect waves-light btn-sm ml-3">S'inscrire</a>
            <a class="btn green waves-effect waves-light btn-sm ml-3" href="/louma-du-savoir/cours/listeEtudiants/{{ $courseid }}">Participants</a>
    
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
