@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('main_content')
@section('page-title')
    {{ $_SESSION['nom_entite'] }}
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="{{ url('/dashboard') }}">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/listeferme') }}">Ferme</a>
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Modification Ferme
    </li>
@endsection
<div class="row">
    <form id="formModFerme" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Modification Ferme</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">

                            <input id="id" name="id" value="{{ $ferme->id_entite }}" hidden>
                            <div class="input-field col s6">
                                <input id="nomFerme" type="text" class="validate" name="nomFerme"
                                    value="{{ $ferme->nom_entite }}">
                                <label class="active" for="nomFerme">Nom </label>
                            </div>
                            <div class="input-field col s6">
                                <input id="descriptionFerme" type="text" class="validate" name="descriptionFerme"
                                    value="{{ $ferme->description }}">
                                <label class="active" for="descriptionFerme">Description </label>
                            </div>

                        </div>
                        <div class="row">

                            <div class="input-field col s6">
                                <input id="date_debut" type="text" class="date_debut" name="date_debut"   value="{{ $ferme->date_debut }}">
                                <label class="active" for="date_debut">Debut contrat</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="duree" type="text" class="duree" name="duree"   value="{{ $ferme->duree }}">
                                <label class="active" for="duree">Duree (mois)</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">

                                <select class="browser-default localite" id="localite" name="localite">
                                    <option value="{{ $ferme->id_localite }}" selected>
                                        {{ $ferme->localite }}</option>
                                </select>
                                <label class="active" for="">Localité</label>
                                {{-- <label for="icon_prefix16"></label> --}}
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>Logo</span>
                                        <input type="file" name="fichier" value="">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path" name="fichier" type="text" value="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <div class="row" id="load"></div>
                                <div class="col s12 display-flex justify-content-end mt-1">
                                    <button type="submit" id="formModFermeBtn" class="btn indigo">
                                        Modifier</button>
                                    <button type="button" class="ml-1 btn btn-light">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection

@section('other-js-script')
@endsection
