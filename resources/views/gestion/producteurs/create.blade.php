@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/producteurs-table.css') }}">
@endsection
@section('page-title')
    Producteurs
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/admin">Accueil</a>
    </li>
    {{-- <li class="breadcrumb-item">
   <a href="#">Utilisateurs</a>
</li> --}}

    <li class="breadcrumb-item active yellow-text">Producteurs
    </li>
@endsection
@section('main_content')
    <section class="users-list-wrapper section">
        <div class="users-list-filter">
            @include('services.informations_climatiques.campagne-meteo.campagne-actif')
        </div>
        <div class="users-list-table">
            <div class="card">
                <div class="card-content">


                    <h4>Nouveau Producteur</h4>


                    <form method="POST" id="form-producteurs-create" action="#">
                        @csrf
                        {{-- <div class="col s12"> --}}
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="prenom" type="text" class="validate" name="prenom">
                                <label class="active" for="prenom">Prénom</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="nom" type="text" class="validate" name="nom">
                                <label class="active" for="nom">Nom</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <div class="row">
                                    <label>
                                        <p>
                                            <input value="M" name="sexe" type="radio" required />
                                            <span>Homme</span>
                                        </p>
                                    </label>
                                </div>
                                <div class="row">
                                    <label>
                                        <p>
                                            <input value="F" name="sexe" type="radio" required />
                                            <span>Femme</span>
                                        </p>
                                    </label>
                                </div>
                            </div>
                            <div class="input-field col s6">
                                <div class="row">
                                    <label>
                                        <p>
                                            <input value="1" name="sit_matrimonial" type="radio" required />
                                            <span>Marié</span>
                                        </p>
                                    </label>
                                </div>
                                <div class="row">
                                    <label>
                                        <p>
                                            <input value="2" name="sit_matrimonial_id" type="radio" required />
                                            <span>Célibataire</span>
                                        </p>
                                    </label>
                                </div>
                                {{-- <label class="active" for="first_name2">First Name</label> --}}

                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="dt_naiss" type="text" class="datepicker" name="dtNaiss">
                                <label class="active" for="dt_naiss">Date de naissance</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="telephone" type="number" class="validate" name="telephone">
                                <label class="active" for="telephone">Téléphone</label>
                            </div>
                        </div>
                        <div class="row">


                            <div class="input-field col s6">
                                <input id="email" type="email" class="validate" name="email">
                                <label class="active" for="email">Email</label>
                            </div>
                            <div class="input-field col s6">
                                <select class="browser-default" id="" name="status">
                                    <option value="" disabled selected>Status</option>
                                    <option value="0">OUI</option>
                                    <option value="1">NON</option>
                                </select>
                                <label class="active" for="pays">Status</label>
                            </div>

                        </div>
                        <div class="row">


                            <div class="input-field col s6">
                                <select class=" browser-default" id="pays" name="pays">
                                    <option value="" disabled selected>Pays</option>
                                </select>
                                <label class="active" for="pays">Pays</label>
                            </div>
                            <div class="input-field col s6">
                                <select class="select2 lp browser-default region" id="" name="region">
                                    <option value="" disabled selected>--Région--</option>
                                </select>
                                <label class="active" for="region">Région</label>
                            </div>
                        </div>

                        <div class="row">

                            <div class="input-field col s6">
                                <select class="select2 lp browser-default dept" id="" name="dept">
                                    <option value="" disabled selected>--Département--</option>

                                </select>
                                <label class="active" for="dept">département</label>
                            </div>
                            <div class="input-field col s6">
                                <select class="select2 lp browser-default commune" id="" name="commune">
                                    <option value="" disabled selected>--Commune--</option>
                                </select>
                                <label class="active" for="commune">Commune</label>
                            </div>
                        </div>
                        <div class="row">


                            <div class="input-field col s6">
                                <select class="select2 lp browser-default localite" id="" name="localite">
                                    <option value="" disabled selected>--Localité--</option>
                                </select>
                                <label class="active" for="localite">Localité</label>
                            </div>
                            <div class="input-field col s6">
                                <select class="select2 lp browser-default" id="" name="reseau">
                                    <option value="" disabled selected>Choisissez le reseau</option>
                                    @foreach ($reseaux as $reseau)
                                        <option value="{{ $reseau->id_groupement }}">{{ $reseau->libelle }}
                                        </option>
                                    @endforeach
                                </select>
                                <label class="active" for="users-list-status">Reseau</label>
                            </div>
                        </div>
                        <div class="row">

                            <div class="input-field col s6">
                                <select class="select2 lp browser-default" id="" name="pluvio">
                                    <option value="" disabled selected>Choisissez le pluvio</option>
                                    @foreach ($pluvios as $pluvio)
                                        <option value="{{ $pluvio->id }}">{{ $pluvio->localite }}</option>
                                    @endforeach
                                </select>
                                <label class="active" for="users-list-status">Pluvio</label>
                            </div>
                            <div class="input-field col s6">
                                <select class=" browser-default" id="" name="canal">
                                    <option value="" disabled selected>Choisissez le canal</option>
                                    <option value="SMS">SMS</option>
                                    <option value="VOICE">VOICE</option>


                                </select>
                                <label class="active" for="users-list-status">Canal de réception</label>
                            </div>
                        </div>
                        <div class="row">



                            <div class="input-field col s6">
                                <select class=" browser-default" id="" name="langue">
                                    <option value="" disabled selected>Choisissez la langue de reception
                                    </option>
                                    @foreach ($langues as $langue)
                                        <option value="{{ $langue->id }}">{{ $langue->langue }}</option>
                                    @endforeach
                                </select>
                                <label class="active" for="users-list-status">Langue</label>
                            </div>
                            <div class="input-field col s12 m6 l6">
                                <select class="select2 browser-default" multiple="multiple" name="produit[]">
                                    @foreach ($produits as $produit)
                                        <option value="{{ $produit->id }}">{{ $produit->produit }}</option>
                                    @endforeach
                                </select>
                                <label class="active" for="users-list-status">Spéculation</label>
                            </div>

                        </div>


                        <div class="row">
                            <div class="input-field col s12">
                                <div class="row" id="load"></div>
                                <div class="col s12 display-flex justify-content-end mt-1">
                                    <button id="btn-create-producteur" type="submit" class="btn indigo">
                                        Enregistrer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
@section('other-js-script')
    <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/extra-components-sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/providers/message.js') }}"></script>
    <script src="{{ asset('assets/js/providers/set_state.js') }}"></script>
    <script src="{{ asset('assets/js/providers/progress.js') }}"></script>
    <script src="{{ asset('assets/js/crud/gestion/delete.js') }}"></script>
    <script src="{{ asset('assets/js/crud/gestion/edit.js') }}"></script>
    <script src="{{ asset('assets/js/crud/gestion/update.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/card-advanced.js') }}"></script>
    <script>
        $(document).ready(() => {
            // alert('work');
            $('#producteurTable tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');

            });

            var table = $('#producteurTable').DataTable({
                initComplete: function() {
                    // Apply the search
                    this.api()
                        .columns()
                        .every(function() {
                            var that = this;

                            $('input', this.footer()).on('keyup change clear', function() {
                                if (that.search() !== this.value) {
                                    that.search(this.value).draw();
                                }
                            });
                        });

                    var r = $('#producteurTable tfoot tr');
                    r.find('th').each(function() {
                        $(this).css('padding', 8);
                    });
                    $('#producteurTable thead').append(r);
                    $('#search_0').css('text-align', 'center');
                },
            });
        });
    </script>
@endsection
