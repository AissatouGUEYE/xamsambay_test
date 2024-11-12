@extends('layouts.master')
@section('page-title')
    Services Alertes
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('alertes') }}">Alertes</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('alertes.liste.diffusion') }}">Liste de Diffusion</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#" style="color:#ffe900">Liste Utilisateur</a>
    </li>
@endsection
@section('main_content')
    @php
        // dd($users);
    @endphp
    <section class="users-list-wrapper section">
        <div class="users-list-filter">
        </div>
        <div class="users-list-table">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col s4 p-3">
                            @isset($users[0])
                                <h6>{{ $users[0]->nom_diffusion }}</h6>
                                <h6>{{ $users[0]->desscription_diffusion }}</h6>
                            @endisset
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <!-- datatable start -->
                    <div class="responsive-table">
                        <table id="data-table-simple" class="table">
                            <thead>
                                <tr>
                                    <th>Prenom</th>
                                    <th>Nom</th>
                                    <th>Numero</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                @isset($users)
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->prenom }}</td>
                                            <td>{{ $user->nom }}</td>
                                            <td>{{ $user->tel }}</td>
                                            <td></td>

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

