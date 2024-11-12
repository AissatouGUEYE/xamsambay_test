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
    <li class="breadcrumb-item active">
        <a href="{{ route('opportunites.index') }}" style="color:#ffe900;">Opportunites</a>
    </li>
@endsection


@section('main_content')

    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div class="row mb-3">
                    <div class="col s8"></div>
                    <div class="col s4">
                        <a type="button" class="btn green waves-effect waves-light btn-sm ml-3 right"
                           href="{{route('opportunites.create')}}"><i class="material-icons">add_circle</i>
                            Candidatures</a>
                    </div>
                </div>
                <!-- datatable start -->
                <div class="responsive-table">
                    <table id="statsTable" class="table display striped">
                        <thead>
                        <tr>
                            <th>Titre Poste</th>
                            {{--                                <th>Secteur</th>--}}
                            <th>Location</th>
                            {{--                                <th>Entreprise</th>--}}
                            <th>Statut</th>
                            <th>PDF</th>
                            <th>Action</th>
                            {{--  Actions Consistera a cloturer l'appel d'offres ou modifier --}}
                        </tr>
                        </thead>
                        <tbody id="">
                        @foreach( $opportunites as $opportunite)
                            <tr>

                                <td>{{$opportunite->poste}}</td>
                                {{--                                    <td></td>--}}
                                <td>{{$opportunite->location}}</td>
                                {{--                                    <td></td>--}}
                                <td style="text-align: center">

                                            <span class="chips lighten-3 padding-5 border-radius-3
                                                @if($opportunite->statut === 'Soumis')
                                                 green
                                                 @else
                                                  red
                                                @endif ">
                                                {{$opportunite->statut}}
                                            </span>


                                </td>
                                <td>
                                    <a class="text-success"
                                       href="{{asset('storage/' .$opportunite->lien) }}"
                                       target="_blank"> <i
                                            class="material-icons blue-grey-text">file_download</i></a>
                                </td>
                                <td>
                                    {{--     Modifier Statut (cloturer - Supprimer)--}}
                                    <a href='{{route('opportunites.details.offres',['id'=>$opportunite->id])}}'
                                       title="Candidats">
                                        <i class="material-icons blue-text">visibility</i></a>
                                    @if($opportunite->statut == 'Soumis')
                                        <a href='{{route('opportunites.cloture',['id'=>$opportunite->id])}}'
                                           title="Cloturer"><i
                                                class="material-icons blue-grey-text">archive</i></a>
                                    @endif
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Titre Poste</th>
                            <th>Location</th>
                            <th>Statut</th>
                            <th>PDF</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- datatable ends -->
            </div>
        </div>
    </div>

@endsection
@section('other-js-script')

@endsection
