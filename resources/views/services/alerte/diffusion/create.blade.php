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
        <a href="#" style="color:#ffe900">Ajouter Utilisateurs</a>
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
    @endphp
    <div class="users-list-table">
        <div class="card">
            <div class="card-header">
                @isset($list)
                    <h5 class="pt-2 ml-3">{{ $list->nom }}</h5>
                @endisset
                @isset($listes)
                    <h5 class="pt-2 ml-3">Liste de Diffusion</h5>
                @endisset
                <h6 class="pt-2 ml-3">Enrôlement Utilisateur</h6>
            </div>
            <div class="card-content">
                <div id="image-card" class="section">
                    <div class="row">
                        <div class="col s12">
                            <form method="POST" id="EnrollFormUserToList" action="{{ route('alertes.list.addByFile') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col s12">
                                        <div class="input-field">
                                            <select class="browser-default" id="enrollement" name="enrollement">
                                                <option value="" disabled selected>Choisissez le type d'Enrollement *
                                                </option>
                                                {{-- <option value="reseau">Utilisateur Interne</option> --}}
                                                <option value="upload">Chargement fichier</option>
                                            </select>
                                            <label class="active" for="enrollement">Type d'Enrôlement</label>
                                            @isset($list)
                                                <input type="text" name="liste" id="liste" hidden
                                                       value="{{ $list->id }}">
                                            @endisset
                                            {{--                                            <input type="text" name="urlPost" id="urlPost"--}}
                                            {{--                                                   value="{{ route('alertes.list.addByFile') }}" hidden>--}}
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3 choixTypeEnroll">
                                    <div class="row">
                                        <div class="col s6">
                                            <div class="input-field">
                                                <select class="browser-default genre" id="genre" name="genre">
                                                    <option value="" selected disabled>Choisir le genre *</option>
                                                    <option value="F">Feminin</option>
                                                    <option value="M">Masculin</option>
                                                    <option value="all">Toutes les Genres</option>
                                                </select>
                                                <label class="active" for="genre">Genre</label>
                                            </div>
                                        </div>
                                        <div class="col s6">
                                            <div class="input-field">
                                                <select class="browser-default canal" id="canal" name="canal">
                                                    <option value="" selected disabled>Veuillez specifier le canal
                                                    </option>
                                                    <option value="SMS">SMS</option>
                                                    <option value="VOICE">VOICE</option>
                                                </select>
                                                <label class="active" for="canal">Canal de Communication</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s6">
                                            <div class="input-field">
                                                <select class="browser-default" id="langue" name="langue">
                                                    <option value="null" disabled selected>Choisissez une langue *
                                                    </option>
                                                    @isset($langues)
                                                        @foreach ($langues as $langue)
                                                            <option
                                                                value="{{ $langue->id }}">{{ $langue->langue }}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                                <label class="active" for="langue">Langue</label>
                                            </div>
                                        </div>
                                        <div class="col s6">
                                            <div class="input-field">
                                                <select name="produit" id="produit">
                                                    <option value="" selected disabled>Choisir un produit</option>
                                                </select>
                                                <label class="active" for="produit">Produit</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                                        <a href=" {{ asset('assets/modelsListe/model_enrollement_contacts.xlsx') }}"
                                           class=" waves-effect waves-green btn-flat mt-4"><span>Télécharger le
                                                modéle</span><i class="material-icons">file_download</i></a>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col s12">
                                        @isset($message)
                                            <input type="text" name="texto" id="texto" value="{{ $message }}"
                                                   hidden>
                                        @endisset
                                    </div>
                                </div>
                                <div class="row">
                                    <button id="addUsertoList" type="submit"
                                            class="waves-effect waves-light green s2 m6 l3 btn right ">Enrôler
                                        Utilisateur
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('other-js-script')
    {{--    <script src="{{ asset('assets/js/providers/location.js') }}"></script>--}}
    <script>
        $(document).ready(function () {

            let root = $('meta[name="url"]').attr("content");

            let sms = $('#texto').val();
            // console.log(sms);
            if (sms) {
                swal({
                    title: 'Success',
                    icon: 'success',
                    text: sms,
                    timer: 5000,
                    buttons: false
                });
                // location.reload();

            }

            $('.choixTypeEnroll').hide();
            $('.insertFile').hide();

            $("#addUsertoList").prop("disabled", true);

            $('#enrollement').change(() => {
                enrollement = $('#enrollement').val();
                // alert(enrollement);
                // console.log('type de campagne: ' + campagneType);
                if (enrollement === 'upload') {
                    $('.choixTypeEnroll').hide();
                    $('.insertFile').show();
                } else {
                    $('.insertFile').hide();
                    $('.choixTypeEnroll').show();
                }

                $("#addUsertoList").prop("disabled", false);
            });

            $('#addUsertoList').click(function (e) {
                e.preventDefault();
                swal({
                    title: "Enrolement utilisateurs",
                    text: "Voulez-vous enroler ces utilisateurs sur la liste",
                    icon: 'warning',
                    dangerMode: true,
                    buttons: {
                        cancel: 'Annuler',
                        delete: 'Oui'
                    }
                }).then(function (willDelete) {
                    if (willDelete) {
                        $('#EnrollFormUserToList').submit();
                    } else {
                        // alert('Ajout annule!');
                    }
                });

            });

        });
    </script>
@endsection
