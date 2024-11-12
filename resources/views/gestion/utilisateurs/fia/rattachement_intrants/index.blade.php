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

        @if ($_SESSION['role'] == 'SERVICE_ETATIQUE')
            <a href="/entite/fia">Utilisateurs</a>
        @else
            <a href="#">Utilisateurs</a>
        @endif

    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Liste des Intrants rattachés au FIA
    </li>
@endsection

<section class="users-list-wrapper section">
    <div class="users-list-table">
        <div class="card">

            {{-- <div class="green white-text"> Compte créé avec succes!</div> --}}

            <div class="card-content">

                @if ($_SESSION['role'] == 'SERVICE_ETATIQUE')
                    <div class="row mb-3">
                        <div class="col s8"></div>
                        <div class="col s4">
                            <a type="button" class="btn green waves-effect waves-light btn-sm ml-3 right"
                                href="/entite/fia/rattachement_intrant/create/{{ $id }}"><i
                                    class="material-icons">add_circle</i>
                                Intrants</a>
                        </div>
                    </div>
                @endif

                @isset($id)
                    <input type="text" value="{{ $id }}" hidden id="id_fia">
                @endisset

                @if (session()->has('message'))
                    <div class="yellow">
                        {{ session('message') }}
                    </div>
                @endif
                <!-- datatable start -->
                <div class="responsive-table">
                    <table id="statsTable" class="table display striped">
                        <thead>
                            <tr>
                                <th>Intrant</th>
                                <th>Produit</th>

                                @if ($_SESSION['role'] == 'SERVICE_ETATIQUE')
                                    <th>Action</th>
                                    <th></th>
                                @endif

                            </tr>
                        </thead>
                        <tbody id="">
                            @isset($intrants)
                                @foreach ($intrants as $entities)
                                    <tr>
                                        <td>{{ $entities->type_intrant }}</td>
                                        <td>{{ $entities->produit }}</td>

                                        @if ($_SESSION['role'] == 'SERVICE_ETATIQUE')
                                            <td> <a href="#" id="{{ $entities->id }}"
                                                    class="px-1 supprimer_rattachement_intrant">
                                                    <i class="material-icons red-text">
                                                        delete
                                                    </i>
                                                </a></td>
                                            <td></td>
                                        @endif

                                    </tr>
                                @endforeach
                            @endisset

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Intrant</th>
                                <th>Produit</th>
                                @if ($_SESSION['role'] == 'SERVICE_ETATIQUE')
                                    <th>Action</th>
                                    <th></th>
                                @endif

                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection

@section('other-js-script')
<script></script>
<script src="{{ asset('assets\js\crud\gestion\utilisateurs\create.js') }}"></script>
<script src="{{ asset('assets\js\crud\gestion\delete.js') }}"></script>

<!-- BEGIN THEME  JS-->
@endsection
