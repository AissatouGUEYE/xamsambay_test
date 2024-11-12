@extends('layouts.master')
@section('page-title')
    Services Alertes
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('alertes') }}" style="color:#ffe900">Alertes</a>
    </li>
@endsection
@section('main_content')
    @php
        if (
            request()
                ->session()
                ->exists('message')
        ) {
            $message = request()
                ->session()
                ->pull('message', '');
            request()
                ->session()
                ->forget('message');
        }
        if (
            request()
                ->session()
                ->exists('message2')
        ) {
            $message2 = request()
                ->session()
                ->pull('message2', '');
            request()
                ->session()
                ->forget('message2');
        }
    @endphp
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div id="image-card" class="section">
                    <div class="row">
                        <div class="col s12">
                            <ul class="tabs">
                                <li class="tab col m12"><a href="#sms" class="active">Gestion Alertes </a></li>
                                {{-- <li class="tab col m6"><a class="" href="#voice">Alerte VOICE</a></li> --}}
                            </ul>
                        </div>
                        <div id="sms" class="col s12">
                            <form id="form-alerte" method="POST" action="{{ route('alertes.sms.submit') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                {{-- Type alerte --}}
                                <div class="row mt-3">
                                    <div class="input-field col s6">
                                        @if ($_SESSION['role'] == 'ADMIN' || $_SESSION['role'] == 'SUPPERADMIN')
                                            <div class="row">
                                                <label>
                                                    <p>
                                                        <input id="type_alerte" value="prevision" name="type_alerte"
                                                               type="radio" checked/>
                                                        <span>Prevision</span>
                                                    </p>
                                                </label>
                                                <label>
                                                    <p>
                                                        <input id="type_alerte" value="diffusion" name="type_alerte"
                                                               type="radio"/>
                                                        <span>Diffusion </span>
                                                    </p>
                                                </label>
                                            </div>
                                        @else
                                            <div class="row">
                                                <label>
                                                    <p>
                                                        <input id="type_alerte" value="prevision" name="type_alerte"
                                                               type="radio" disabled/>
                                                        <span>Prevision</span>
                                                    </p>
                                                </label>
                                                <label>
                                                    <p>
                                                        <input id="type_alerte" value="diffusion" name="type_alerte"
                                                               type="radio" checked/>
                                                        <span>Diffusion </span>
                                                    </p>
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                {{-- Type de Destination --}}
                                <div class="row mt-2">
                                    <div class="col s12">
                                        <div class="input-field">
                                            <select class="browser-default" id="campagne" name="campagne" required>
                                                <option value="" disabled selected>Choisir la cible de
                                                    diffusion
                                                </option>
                                                <option value="reseau">Réseau</option>
                                                <option value="zone">Zone</option>
                                                <option value="localite">Localité</option>
                                                <option value="diffusion">Liste diffusion</option>
                                                <option value="upload">Charger un fichier</option>
                                            </select>
                                            <label class="active" for="users-list-status">Cible de diffusion <span
                                                    class="red-text"> *</span></label>
                                        </div>
                                    </div>
                                </div>
                                {{-- Liste des Potentiels destinations --}}
                                <div class="row mt-3 choixCampagne">
                                    <div class="col s12">
                                        <div class="input-field">
                                            <select class="browser-default" id="campagnetype" name="campagnetype">
                                            </select>
                                            <label class="active" for="users-list-status">Destinataire <span
                                                    class="red-text">*</span></label>
                                        </div>
                                    </div>
                                </div>
                                {{-- Localite ou zone --}}
                                <div class="localiteSection">
                                    <div class="row mb-2 mt-2">

                                        <div class="col s12">
                                            <div class="input-field">
                                                <select class="browser-default pays" id="pays" name="pays">
                                                </select>
                                                <label class="active" for="pays">Pays <span
                                                        class="red-text">*</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="zoneChoixConfirme">
                                        <div class="row">
                                            <div class="col s12">
                                                <div class="input-field">
                                                    <select class="browser-default zone" id="zone" name="zone">
                                                        <option value="">--Selectionner d'abord un pays--</option>
                                                        {{--  @isset($zones)
                                                            @foreach ($zones as $zone)
                                                                <option value="{{ $zone->id }}">ZONE
                                                                    {{ $zone->designation }}</option>
                                                            @endforeach
                                                        @endisset --}}
                                                    </select>
                                                    <label class="active" for="zone">Choisir la zone</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="localiteChoixConfirme">
                                        <div class="row">
                                            <div class="col s6">
                                                <div class="input-field">
                                                    <select class="browser-default region" id="region" name="region">
                                                    </select>
                                                    <label class="active" for="region">Région</label>
                                                </div>
                                            </div>
                                            <div class="col s6">
                                                <div class="input-field">
                                                    <select class="browser-default dept" id="dept" name="departement">
                                                    </select>
                                                    <label class="active" for="dept">Département</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s6">
                                                <div class="input-field">
                                                    <select class="browser-default commune" id="commune"
                                                            name="commune">
                                                    </select>
                                                    <label class="active" for="commune">Commune</label>
                                                </div>
                                            </div>
                                            <div class="col s6">
                                                <div class="input-field">
                                                    <select class="browser-default localite" id="localite"
                                                            name="localite">
                                                    </select>
                                                    <label class="active" for="localite">Localité</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row genre_lang">
                                        <div class="col s6">
                                            <div class="input-field">
                                                <select class="browser-default genre" id="genre" name="genre">
                                                    <option value="null" selected>Choisir le genre</option>
                                                    <option value="F">Féminin</option>
                                                    <option value="M">Masculin</option>
                                                    {{-- <option value=null>Tout</option> --}}
                                                </select>
                                                <label class="active" for="genre">Genre</label>
                                            </div>
                                        </div>
                                        <div class="col s6">
                                            <div class="input-field">
                                                <select class="browser-default langue" id="langue" name="langue">
                                                    <option value="null" selected>Choisir la langue
                                                    </option>
                                                    @isset($langues)
                                                        @foreach ($langues as $langue)
                                                            <option value="{{ $langue->id }}">{{ $langue->langue }}
                                                            </option>
                                                        @endforeach
                                                    @endisset
                                                    {{-- <option value="null">Toutes les langues
                                                    </option> --}}
                                                </select>
                                                <label class="active" for="langue">Langue</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Nombre de Producteur --}}
                                <div class="row">
                                    <div class="col s2"></div>
                                    <div class="col s8">
                                        <p class="producteurs mt-3" style="text-align: center;font-size:17px"></p>
                                    </div>
                                    <div class="col s2"></div>
                                </div>
                                {{-- Insert File --}}
                                <div class="row insertFile">
                                    <div class="col s12 m6 l6">
                                        <div class="file-field input-field">
                                            <div class="btn">
                                                <span>Fichier</span>
                                                <input type="file" name="glist">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path" name="glist_name" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l6">
                                        <a href=" {{ asset('assets/modelsListe/model_diffusion.xlsx') }}"
                                           class=" waves-effect waves-green btn-flat mt-4"><span>Télécharger le
                                                modéle</span><i class="material-icons">file_download</i></a>

                                        {{-- <a id="new-gerant-list"
                                            class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</a> --}}
                                    </div>

                                </div>
                                {{-- Message de Diffusion --}}
                                <div class="row">

                                    <div class="col s12">
                                        <div class="input-field">
                                            <select class="browser-default" name="type_canal" id="type_canal">
                                                <option value="">Choisissez le Canal d'Envoi</option>
                                                <option value="alerte_sms">Alerte SMS</option>
                                                <option value="alerte_voice">Alerte Voice</option>
                                            </select>
                                            <label class="active" for="users-list-status">Canal d'Envoi <span
                                                    class="red-text">*</span></label>
                                        </div>
                                    </div>

                                    <div class="col s12 smsType">
                                        <div class="input-field">
                                            <textarea rows="4" id="textarea1" name="message"
                                                      class="materialize-textarea" maxlength="140" required></textarea>
                                            <label for="textarea1">Message de diffusion <span
                                                    class="red-text">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col s12 voiceType">

                                        <div class="file-field input-field">
                                            <div class="btn">
                                                <span>Fichier audio(MP3)</span>
                                                <input id="audiofile" type="file" name="audiofile"
                                                       accept="audio/mp3,audio/*;capture=microphone">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" name="audiofile_name">
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <input type="text" name="id_entite" id="id_entite"
                                               value="{{ $_SESSION['id_entite'] }}" hidden>
                                        <input type="text" name="nbSms" id="nbSms"
                                               value="{{ $_SESSION['sms'] }}" hidden>
                                        <input type="text" name="profil" id="profil"
                                               value="{{ $_SESSION['role'] }}" hidden>
                                        <input type="text" name="nombreProd" id="nombreProd" value="0" hidden>

                                        @isset($message)
                                            <input type="text" name="texto" id="texto" value="{{ $message }}"
                                                   hidden>
                                        @endisset

                                        @isset($message2)
                                            <input type="text" name="texto2" id="texto2" value="{{ $message2 }}"
                                                   hidden>
                                        @endisset
                                    </div>

                                </div>
                                {{-- Submit Button --}}
                                <div class="row">
                                    <a id="submitAlertes"
                                       class="waves-effect waves-light green darken-1 s2 m6 l3 btn right mr-3">Envoyer
                                    </a>
                                </div>
                            </form>
                        </div>
                        {{-- <div id="voice" class="col s12">
                        </div> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
    @if ($_SESSION['role'] == 'ADMIN' || $_SESSION['role'] == 'SUPERADMIN')
        {{-- @include('services.alerte.partials.alertesAdmin') --}}
    @endif
@endsection
@section('other-js-script')
    <script src="{{ asset('assets/js/providers/location.js') }}"></script>
    <script src="{{ asset('assets/js/providers/gestionAlertes.js') }}"></script>
@endsection
