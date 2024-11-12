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
        <a href="{{ url('/ferme/tache') }}">Tâche</a>
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Modification Tâche
    </li>
@endsection
<div class="row">
    <form id="formModtache" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Modification Tâche</h4>
                    </div>
                    <div class="card-body">
                        {{-- @php
    dd($tache);
@endphp --}}
                        <input type="text" value="{{ $tache->id }}" hidden name="id">
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="nom" type="text" class="validate" name="nom"
                                    value="{{ $tache->nom }}">
                                <label class="active" for="nom">Nom</label>
                            </div>
                            <div class="input-field col s6">
                                <select class="browser-default form-control" name="assigne" id="assigne"
                                    value="" autofocus>
                                    <option value="{{ $tache->assigne_profil_id }}" selected>
                                        {{ $tache->prenom_assigne }} {{ $tache->nom_assigne }}</option>

                                    @foreach ($users as $item)
                                        @if ($item->id_profil != $tache->assigne_profil_id)
                                            <option value="{{ $item->id_profil }}">
                                                {{ $item->prenom }} {{ $item->nom }}

                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <label class="active" for="assigne">Assignée À</label>
                            </div>

                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <div class="input-field col s4">
                                    <input type="date" name="date_debut" id=""
                                        value="{{ $tache->date_debut }}">
                                    <label class="active" for="date_debut">Debut</label>
                                </div>
                                <div class="input-field col s4">
                                    <input type="date" name="date_fin" value="{{ $tache->date_fin }}"
                                        id="">
                                    <label class="active" for="date_fin">Fin.</label>
                                </div>
                                <div class="input-field col s4">
                                    <input type="date" name="fin_prev" value="{{ $tache->fin_prev }}"
                                        id="">
                                    <label class="active" for="fin_prev">Fin Previsionnelle</label>
                                </div>
                            </div>
                        </div>

                        <div class="input-field col s12">
                            <div class="input-field col s6">
                                <input id="description" type="text" class="description" name="description"  value="{{ $tache->description }}">
                                <label class="active" for="description">Description</label>
                            </div>
                            <div class="col s6">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>Fichier</span>
                                        <input type="file" name="fichier" 
                                            accept=".pdf, .doc, .docx"  value="{{ $tache->justificatif }}">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path" name="fichier" type="text" value="{{ $tache->justificatif }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                @php
                                    $statut_array = ['Non démarrée', 'Démarrée', 'Terminée'];
                                @endphp
                                <select class="browser-default" name="statut" id="statut" value="">

                                    <option value="{{ $tache->statut }}" selected>{{ $statut_array[$tache->statut] }}
                                    </option>
                                    @foreach ($statut_array as $key=> $item)
                                        @if ($item != $statut_array[$tache->statut])
                                            <option value={{ $key }}>{{ $item}}</option>
                                            @endif
                                        @endforeach
                                </select>
                                <label class="active" for="statut">Statut</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <div class="row" id="load"></div>
                                <div class="col s12 display-flex justify-content-end mt-1">
                                    <button type="submit" id="formModTacheBtn" class="btn indigo">
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
