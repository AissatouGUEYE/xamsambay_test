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
    <li class="breadcrumb-item active" style="color:#ffe900">Listes des Commissions Cession (CC)
    </li>
@endsection

{{-- @php
    if (request()->session()->exists('message2')) {
        $message = request()->session()->pull('message2', '');
        request()->session()->forget('message2');
    }
@endphp --}}
@include('gestion.utilisateurs.cc.create')

<section class="users-list-wrapper section">
    <div class="users-list-table">
        <div class="card">
            <div class="row right mr-5 mt-2">
                <form method="POST" action="{{ url('admin/utilisateurs/filter') }}">
                    @csrf

                    <div class=" display-flex align-items-center show-btn right">
                        <a style="margin-left: 90px" type="button"
                            class="create-cc modal-trigger btn green waves-effect waves-light btn-sm "
                            href="#create-cc">
                            <i class="material-icons">add_circle
                            </i>CC
                        </a>
                    </div>

                </form>
            </div>
            <div class="card-content">
                <!-- datatable start -->
                <div class="responsive-table">
                    <table id="statsTable" class="table display striped">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Localite</th>
                                <th>Action</th>
                                <th>Membre</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            @isset($users)
                                @foreach ($users as $entities)
                                    <tr>
                                        {{-- <td hidden></td> --}}
                                        <td>{{ Str::ucfirst($entities->nom_entite) }} </td>
                                        <td>{{ $entities->localite }}</td>
                                        <td>
                                            <a href="#" id="{{ $entities->id_entite }}" class="supprimer_cc">
                                                <i class="material-icons red-text">
                                                    delete
                                                </i>
                                            </a>
                                        </td>
                                        {{-- voir les membres de la commission --}}

                                        <td><a href="{{ route('get.membre.cc', $entities->id_entite) }}"
                                                class="btn-small indigo">Membre</td>
                                    </tr>
                                @endforeach
                            @endisset

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nom</th>
                                <th>Localite</th>
                                <th>Action</th>
                                <th>Membre</th>

                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- datatable ends -->
            </div>
            {{-- @isset($message)
                <input type="text" name="texto2" id="texto2" value="{{ $message }}" hidden>
            @endisset --}}
        </div>
    </div>
</section>
@endsection

@section('other-js-script')
<script src="{{ asset('assets\js\crud\gestion\utilisateurs\create.js') }}"></script>
<script src="{{ asset('assets\js\crud\gestion\delete.js') }}"></script>

<script src="{{ asset('assets\js\providers\location.js') }}"></script>
{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
<script src="{{ asset('assets\js\providers\entity.js') }}"></script>

{{-- <script src="{{ asset('assets\js\crud\gestion\utilisateurs\filter.js') }}"></script> --}}
<script src="{{ asset('assets\js\providers\set_state.js') }}"></script>
@endsection
