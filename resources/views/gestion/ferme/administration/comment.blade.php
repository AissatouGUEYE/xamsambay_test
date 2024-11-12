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
        <a href="{{ url('/ferme/administration') }}">Demande administrative</a>
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Modification demande
    </li>
@endsection
<div class="row">
    <form id="formCommentDemande" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Modification demande</h4>
                    </div>

                    <div class="card-body mt-30">
                        @php
                            $demande = $demande[0];
                        @endphp

                        <input type="text" value="{{ $demande->id }}" hidden name="id">
                        <div class="input-field col s6">
                            <input id="commentaire" type="text" class="validate" name="commentaire">
                            <label class="active" for="commentaire">Commentaire </label>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <div class="row" id="load"></div>
                                <div class="col s12 display-flex justify-content-end mt-1">
                                    <button type="submit" id="formCommentDemandeBtn" class="btn indigo">
                                        Enregistrer</button>
                                    <button type="button" id="annuler" class="ml-1 btn btn-light">Annuler</button>
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
<script>
    $(document).ready(function() {
        $("#annuler").click(function() {
            parent.history.back();
            return false;
        });
    });
</script>
@endsection
