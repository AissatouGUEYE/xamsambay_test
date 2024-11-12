@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }} ">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('page-title')
    Appel a candidature
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('opportunites.index') }}">Opportunites</a>
    </li>
    <li class="breadcrumb-item active">
        <a href="#" style="color:#ffe900;">Details</a>
    </li>
@endsection
@section('main_content')

    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div class="row mb-3">
                    <div class="col s12">
                        <h5> {{$offre->libelle}}</h5>
                        <hr>
                        @if($offre->description)
                            <div class="mt-2">
                                <span class="font-weight-600">Descritpion:</span>
                                {{$offre->description}}
                            </div>
                        @endif
                        @if($offre->criteres)
                            <div class="mt-2">
                                <span class="font-weight-600"> Criteres:</span>
                                {{$offre->criteres}}
                            </div>
                        @endif
                    </div>
                    <div class="col s12 mt-4">
                        <h5>Candidats</h5>
                        <hr>
                    </div>
                </div>
                <!-- datatable start -->
                <div class="responsive-table">
                    <table id="statsTable" class="table display striped">
                        <thead>
                        <tr>
                            <th>Candidat</th>
                            <th>Mail</th>
                            {{--                            <th>Numero</th>--}}
                            <th>CV (PDF)</th>
                            <th>Action</th>
                            {{--  Elle consistera a rejeter la candidature par mail --}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($candidats as $candidat)
                            <tr>
                                <td>{{$candidat->prenom}} {{$candidat->nom}}</td>
                                <td>{{$candidat->email}}</td>
                                {{--                                <td>--</td>--}}
                                <td>
                                    <a class="text-success"
                                       href="{{asset('storage/' .$candidat->lienCV) }}"
                                       target="_blank"> <i
                                            class="material-icons blue-grey-text">file_download</i></a>
                                </td>
                                <td>
                                    <a class="text-success"
                                       title="Rejeter Candidature"
                                       {{--                             Joindre le mail et le libelle de l'appel d'offre          --}}
                                       href="#"
                                       target="_blank"> <i
                                            class="material-icons red-text">cancel</i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- datatable ends -->
            </div>
        </div>
    </div>

@endsection
