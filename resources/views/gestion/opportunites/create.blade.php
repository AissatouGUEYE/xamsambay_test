@extends('layouts.master')
@section('page-title')
    Opportunites
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('opportunites.index') }}">Opportunites</a>
    </li>
    <li class="breadcrumb-item active">
        <a href="#" style="color:#ffe900">Nouvel Opportunite</a>
    </li>
@endsection


@section('main_content')
    <div class="row">
        <form method="POST" id="createOffer" action="{{route('opportunites.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="col s12">
                <div class="card">
                    <div class="card-content pb-0">
                        <div class="card-header mb-2">
                            <h4 class="card-title">Formulaire</h4>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="poste" type="text" class="validate" name="poste">
                                    <label class="active" for="poste">Intitule Poste</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="libelle" type="text" class="validate" name="libelle">
                                    <label class="active" for="libelle">Libelle</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <div>
                                        <label for="offreType">Type D'offre</label>
                                    </div>
                                    <select id="offreType" name="offreType">
                                        <option value="" selected>Choisissez le type d'offre</option>
                                        <option value="opportunite">Opportunite</option>
                                        <option value="recrutement"
                                                @if(!in_array($_SESSION['role'],['ADMIN','SUPERADMIN'])) disabled @endif>
                                            Recrutement
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="description" class="materialize-textarea"
                                              name="description"></textarea>
                                    <label for="description">Description de l'Offre</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="contexte" class="materialize-textarea" name="contexte"></textarea>
                                    <label for="contexte">Contexte</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="location" type="text" class="validate" name="location">
                                    <label class="active" for="location">Ou est base le poste?</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="criteres" class="materialize-textarea" name="criteres"></textarea>
                                    <label for="criteres">Quels sont les criteres de la selection</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s10">
                                    <div class="mb-2">
                                        <label class="active" for="input-file-now">Details Offres (PDF)</label>
                                    </div>
                                    <input type="file" id="input-file-now"
                                           accept="image/jpeg,image/gif,image/png,application/pdf" name="filepdf"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <div class="row" id="load"></div>
                                    <div class="col s12 display-flex justify-content-end mt-1">
                                        <button id="formAddOfferbtn" type="submit" class="btn indigo">
                                            Soumettre
                                        </button>
                                        {{--                                        <button type="button" class="ml-1 btn btn-light">Annuler</button>--}}
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
        $(document).ready(function () {
            $('#formAddOfferbtn').click(function (e) {
                e.preventDefault();
                swal({
                    title: "Souscription",
                    text: "Voulez vous soumettre cette annonce",
                    icon: 'warning',
                    dangerMode: true,
                    buttons: {
                        delete: 'Oui',
                        cancel: 'Annuler'
                    }
                }).then(function (willDelete) {
                    if (willDelete) {
                        $('#createOffer').submit();
                    } else {

                    }
                });


            });

        });
    </script>
    <script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>

    <script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>

    <script src="{{ asset('assets\js\crud\gestion\utilisateurs\create.js') }}"></script>
    <script src="{{ asset('assets\js\providers\location.js') }}"></script>
    <script src="{{ asset('assets\js\providers\entity.js') }}"></script>

    <script src="{{ asset('assets\js\crud\gestion\utilisateurs\read.js') }}"></script>
    <script src="{{ asset('assets\js\crud\gestion\utilisateurs\user-state.js') }}"></script>
    <script src="{{ asset('assets\js\crud\gestion\utilisateurs\profil.js') }}"></script>




    <!-- END PAGE LEVEL JS-->
@endsection
