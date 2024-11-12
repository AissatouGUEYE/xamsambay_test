@extends('layouts.master')
@section('page-title')
    Distribution d'Intrants
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">{{ __('Accueil') }}</a>
    </li>
    <li class="breadcrumb-item active">
        {{--        <a href="locale/en">English</a>/--}}
        {{--        <a href="locale/fr">French</a>/--}}
        <a href="#" style="color:#ffe900">{{__("Distributions")}}</a>
    </li>
@endsection

@section('main_content')
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div id="image-card" class="section">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h4 class="header">{{ __('Liste de Distribution') }}</h4>
                        </div>
                        <div class="col s12 m6 l6 mt-2" style="text-align: right">
                            <a type="button" class="btn green waves-effect waves-light btn-sm ml-3"
                               href="{{ route('ecoulements.create') }}">
                                <i class="material-icons mt-2">add_circle</i>
                                <span>{{ __('Distribution') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div id="image-card" class="section">
                    <div class="row">
                        <div class="responsive-table">
                            <table id="statsTable" class="table display striped">
                                <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Quantite</th>
                                    <th>Producteur</th>
                                    <th>Numero Producteur</th>
                                    <th>Date Reception</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @isset($ecoulements)
                                    @foreach ($ecoulements as $item)
                                        <tr>
                                            <td>{{$item->description_eb}}</td>
                                            <td>{{$item->qte_reçue}} {{$item->unite}}</td>
                                            <td>{{$item->prenom_prod}} {{$item->nom_prod}}</td>
                                            <td>{{$item->tel_prod}}</td>
                                            <td>{{$item->date}}</td>
                                            <td>---</td>
                                        </tr>
                                    @endforeach
                                @endisset
                                </tbody>

                                <tfoot>
                                <tr>
                                    <th>Produit</th>
                                    <th>Quantite</th>
                                    <th>Producteur</th>
                                    <th>Numero Producteur</th>
                                    <th>Date Reception</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
