@extends('layouts.master')
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Profil
    </li>
@endsection
@section('main_content')
    <div class="section users-view">

        @php
            $id = $user[0]->utilisateur;
        @endphp
        <!-- users view media object start -->
        <div class="card-panel">
            <div class="row">
                <div class="col s12 m8">
                    <div class="display-flex media">
                        <a href="#" class="avatar">
                            <img    @if( $user[0]->logo == '') src="{{ asset('assets/images/avatar/person-icon.png') }}"
                                    @else src="{{ asset('storage/' . $user[0]->logo) }}"
                                    @endif alt="users view avatar" class="z-depth-4 circle" height="64" width="64">
                        </a>
                        <div class="media-body">
                            <h6 class="media-heading">
                                <span class="users-view-name">{{ $user[0]->prenom }} {{ $user[0]->nom }}</span>
                            </h6>
                            <span>Profil:</span>
                            <span class="users-view-id">{{ $user[0]->nom_typentite }}</span>
                        </div>
                    </div>
                </div>
                <div class="col s12 m4">

                    {{-- <div class="media-body">
                        <span class="users-view-name"><i class="material-icons">chat_bubble_outline</i>SMS Restant:
                            {{ $sms }}</span> <br>
                        <span class="users-view-id"> <i class="material-icons">call</i>Appels Restant:
                            {{ $appel }} </span>
                    </div> --}}
                </div>
                {{-- <div class="col s12 m4 quick-action-btns display-flex justify-content-end align-items-center pt-2"> --}}
                {{-- edit User --}}
                {{-- <a href='{{ url("/admin/profil/edit/$id") }}' class="btn-small indigo">Edit</a> --}}
                {{-- </div> --}}
            </div>
        </div>
        <!-- users view media object ends -->
        <!-- users view card data start -->
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12 m12">
                        <table class="striped">
                            <tbody>
                                <tr>
                                    <td>Telephone:{{ $user[0]->telephone }}</td>
                                    <td></td>
                                    <td>Mail:{{ $user[0]->email }}</td>
                                    <td></td>
                                    <td>Adresse: {{ $user[0]->adresse }},
                                        {{ strtolower($user[0]->commune) }},{{ $user[0]->pays }}</td>
                                </tr>
                                <tr>
                                    <td>Fonction: {{ $user[0]->fonction }}</td>
                                    <td></td>
                                    <td>Role: {{ $user[0]->nom_entite }}</td>
                                    <td></td>
                                    <td>Date d'inscription: {{ date('d M Y', strtotime($user[0]->created_at)) }}</td>

                                </tr>
                                <tr>
                                    <td>Nom d'Utilisateur: {{ $user[0]->login }}</td>
                                    <td></td>
                                    <td>Type d'accès: {{ $user[0]->description }}</td>
                                    <td></td>
                                    @if ($user[0]->actif == 0)
                                        <td>Statut: <span
                                                class=" users-view-status chip red lighten-5 red-text">Inactif</span></td>
                                    @else
                                        <td>Statut: <span
                                                class=" users-view-status chip green lighten-5 green-text">Actif</span>
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    {{-- <td></td> --}}
                                    @if ($user[0]->groupement)
                                        <td> Groupement : {{ $user[0]->nom_groupement }} </td>
                                    @endif
                                    <td></td>
                                    @if ($user[0]->role)
                                        <td> Role : {{ $user[0]->role }} </td>
                                    @endif
                                    <td></td>
                                    @if ($user[0]->pluvio)
                                        <td> Pluvio : {{ $user[0]->pluvio }} </td>
                                    @endif
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col s12 m7"></div>
                    <div class="col s12 m4 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                        {{-- edit User --}}
                        @if ($_SESSION['role'] === 'FERME AGRICOLE')
                            <a href='{{ url("/ferme/profil/edit/$id") }}' class="btn-small indigo">Edit</a>
                        @else
                            <a href='{{ url("/admin/utilisateurs/edit/$id") }}' class="btn-small indigo">Edit</a>
                        @endif

                    </div>
                    <div class="col s12 m1"></div>
                </div>
                <br>
            </div>
        </div>
    </div>
@endsection
