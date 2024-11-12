@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('main_content')
    @php
        // dd($users);
    @endphp
@section('page-title')
    Utilisateurs
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        @if ($_SESSION['role'] == 'ONG')
            <a href="/ong/utilisateurs">Utilisateurs</a>
        @else
            <a href="/admin/utilisateurs">Utilisateurs</a>
        @endif
    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Listes des utilisateurs
    </li>
@endsection

<section class="users-list-wrapper section">

    <div class="users-list-table">
        <div class="card">

            <div class="card-content">
                @if ($_SESSION['role'] == 'ONG')
                    <div class="row mb-3">
                        <div class="col s8"></div>
                        <div class="col s4">
                            <a type="button" class="btn green waves-effect waves-light btn-sm ml-3 right"
                                href="{{ url('ong/utilisateurs/create') }}"><i class="material-icons">add_circle</i>
                                Utilisateur</a>
                        </div>
                    </div>
                @endif
                @if ($_SESSION['role'] == 'ADMIN')
                    <div class="row mb-3">
                        <div class="col s8"></div>
                        <div class="col s4">
                            <a type="button" class="btn green waves-effect waves-light btn-sm ml-3 right"
                                href="{{ url('admin/utilisateurs/create') }}"><i class="material-icons">add_circle</i>
                                Nouvel Utilisateur</a>
                        </div>
                    </div>
                @endif
                <!-- datatable start -->
                <div class="responsive-table">
                    <table id="statsTable" class="table display striped">
                        <thead>
                            <tr>
                                {{-- <th hidden>id</th> --}}
                                <th>Utilisateur</th>
                                {{-- <th>Nom</th> --}}
                                {{-- <th>Date de naissance</th> --}}
                                {{-- <th>Sexe</th> --}}
                                <th>Telephone</th>
                                <th>Fonction</th>
                                <th>Rôle</th>
                                <th>Statut</th>
                                <th>Action</th>
                                {{-- <th>Détails</th> --}}
                            </tr>
                        </thead>
                        <tbody id="">
                            @isset($users)
                                @foreach ($users as $entities)
                                    <tr>
                                        {{-- <td hidden></td> --}}
                                        <td>{{ Str::ucfirst($entities->prenom) }} {{ Str::upper($entities->nom) }}</td>
                                        {{-- <td>{{ date('D M Y', strtotime($entities->dt_naiss)) }}</td> --}}
                                        {{-- <td>{{ $entities->sexe }}</td> --}}
                                        <td>{{ $entities->telephone }}</td>
                                        <td>{{ $entities->fonction }}</td>
                                        <td>{{ $entities->nom_entite }}</td>
                                        @if ($entities->actif == 0)
                                            <td><a id="{{ $entities->utilisateur }}" href='#'
                                                    class='active-user'><span class='chip red lighten-5'><span
                                                            class='red-text'>Inactif</span></span></a></td>
                                        @else
                                            <td><a id="{{ $entities->utilisateur }}" href='#'
                                                    class='deactive-user'><span class='chip green lighten-5'><span
                                                            class='green-text'>Actif</span></span></a></td>
                                        @endif
                                        @if ($_SESSION['role'] == 'ADMIN')
                                            <td>
                                                <a href='{{ url("admin/utilisateurs/$entities->utilisateur") }}'><i
                                                        class="material-icons">visibility</i></a> <a
                                                    href='{{ url("/admin/utilisateurs/edit/$entities->utilisateur") }}'
                                                    class="px-1"><i class="material-icons orange-text ">edit</i></a>
                                            </td>
                                        @else
                                            <td>
                                                <a href='{{ url("ong/utilisateurs/$entities->utilisateur") }}'><i
                                                        class="material-icons">visibility</i></a> <a
                                                    href='{{ url("/ong/utilisateurs/edit/$entities->utilisateur") }}'
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
                                <th>Fonction</th>
                                <th>Rôle</th>
                                <th>Statut</th>
                                <th>Action</th>
                                {{-- <th>Détails</th> --}}
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
<script src="{{ asset('assets\js\providers\set_state.js') }}"></script>


{{-- <script>
    $(document).ready(() => {
        // alert('work');
        $('#userTable tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');

        });

        var table = $('#userTable').DataTable({
            initComplete: function() {
                // Apply the search
                this.api()
                    .columns()
                    .every(function() {
                        var that = this;

                        $('input', this.footer()).on('keyup change clear', function() {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        });
                    });
                var r = $('#userTable tfoot tr');
                r.find('th').each(function() {
                    $(this).css('padding', 8);
                });
                $('#userTable thead').append(r);
                $('#search_0').css('text-align', 'center');
            },
        });
    });
</script> --}}
{{-- <script type="text/javascript">$(".select2").select2({
  dropdownAutoWidth: true,
  width: '100%'
});</script> --}}
@endsection
