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
    {{ $_SESSION['nom_entite'] }}
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">

        <a href="/entite/cc">Utilisateurs</a>

    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Listes des Membres de
    </li>
@endsection
{{-- @include('gestion.utilisateurs.cc.membre.create') --}}
<section class="users-list-wrapper section">
    <div class="users-list-table">
        <div class="card">
            <div class="row right mr-5 mt-2">
                <div class=" display-flex align-items-center show-btn right">
                    <div class=" display-flex align-items-center show-btn right">
                        <a style="margin-left: 90px" type="button"
                            class="create-membre modal-trigger btn green waves-effect waves-light btn-sm "
                            href="#create-membre">
                            <i class="material-icons">add_circle
                            </i>Membre
                        </a>
                    </div>
                </div>
            </div>

            {{-- <div class="green white-text"> Compte créé avec succes!</div> --}}
            <input id="cc" type="text" name="cc" hidden value="{{ $id }}">
            <div class="card-content">
                <!-- datatable start -->
                @if (session()->has('message'))
                    <div class="yellow">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="responsive-table">
                    <table id="statsTable" class="table display striped">
                        <thead>
                            <tr>
                                <th>Utilisateur</th>
                                <th>Telephone</th>
                                <th>Role</th>
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
                                        <td>{{ $entities->role }}</td>
                                        <td>
                                            @if ($entities->actif == 0)
                                                <a id="{{ $entities->utilisateur }}" href='#'
                                                    class='active-user'><span class='chip red lighten-5'><span
                                                            class='red-text'>Inactif</span></span></a>
                                            @else
                                                <a id="{{ $entities->utilisateur }}" href='#'
                                                    class='deactive-user'><span class='chip green lighten-5'><span
                                                            class='green-text'>Actif</span></span></a>
                                            @endif
                                        </td>
                                        <td></td>

                                    </tr>
                                @endforeach
                            @endisset

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Utilisateur</th>
                                <th>Telephone</th>
                                <th>Role</th>
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- datatable ends -->
            </div>
            {{-- modal --}}
            <div class="modal" id="create-membre">
                <div class="formmessage">Success/Error Message Goes Here</div>
                <form method="post" id="formAddMembre" action="{{ url('/entite/cc/membre/store') }}">
                    @csrf
                    <div class="col s12">
                        <div class="card">
                            <div class="card-content pb-0">
                                <div class="card-header mb-2">
                                    <h4 class="card-title">Nouveau Membre CC</h4>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="input-field col s4">
                                            <input id="entite" type="text" name="entite" hidden
                                                value="{{ $id }}">

                                            <input id="prenom" type="text" name="prenom">
                                            <label class="active" for="prenom">Prénom</label>
                                        </div>
                                        <div class="input-field col s4">
                                            <input id="nom" type="text" name="nom">
                                            <label class="active" for="nom">Nom</label>
                                        </div>
                                        <div class="input-field col s4">
                                            <select class="select2 browser-default" id="role" name="role"
                                                required>
                                                <option value="" disabled selected>--Roles--</option>
                                            </select>
                                            <label class="active" for="role">Roles</label>

                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="input-field col s6">
                                            <input id="telephone" type="number" name="telephone">
                                            <label class="active" for="telephone">Téléphone</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="email" type="email" name="email">
                                            <label class="active" for="email">Email</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s4">
                                            <input id="login" type="text" name="login">
                                            <label class="active" for="login">Login</label>
                                        </div>
                                        <div class="input-field col s4">
                                            <input id="password" type="password" name="password">
                                            <label class="active" for="password">Mot de passe</label>
                                        </div>
                                        <div class="input-field col s4">
                                            <input id="cmdp" type="password" name="cmdp">
                                            <label class="active" for="cmdp">Confirmation mot de passe</label>
                                        </div>
                                    </div>
                                    <div id="ajaxloader" style="display:none"><img
                                            class="mx-auto mt-30 mb-30 d-block"
                                            src="{{ asset('assets/images/loader/loader-02.svg') }}" alt="">
                                    </div>
                                    <div class="modal-footer">
                                        <a id="submitCreation" type="submit"
                                            class="waves-effect waves-light green darken-1 s2 m6 l3 btn right mr-3">{{ __('Enregistrer') }}
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('other-js-script')
<!-- END PAGE VENDOR JS-->

<script>
    $("#submitCreation").click((e) => {
        e.preventDefault();
        swal({
            title: "Creation",
            text: "Etes vous sur de vouloir creer cet utilisateur?",
            icon: "warning",
            dangerMode: true,
            buttons: {
                delete: "Oui",
                cancel: "Annuler",
            },
        }).then(function(willDelete) {
            if (willDelete) {
                $("#formAddMembre").submit();
                $("#ajaxloader").show();

                $("#submitCreation").attr("disabled", true);
            } else {}
        });
    });
</script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\create.js') }}"></script>
<script src="{{ asset('assets\js\providers\entity.js') }}"></script>
<script src="{{ asset('assets\js\providers\set_state.js') }}"></script>


<!-- BEGIN THEME  JS-->
@endsection
