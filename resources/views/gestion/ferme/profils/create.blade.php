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
        <a href="{{ url('/ferme/utilisateurs') }}">Utilisateurs</a>
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Nouvel Utilisateur
    </li>
@endsection
<div class="row">
    <form method="POST" id="formAddFermeUser" action="#">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Nouvel Utilisateur</h4>
                    </div>
                    <div class="card-body">

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
                            {{-- <div class="input-field col s6">
                                <div class="row">
                                    <label>
                                        <p>
                                            <input value="1" name="sit_matrimonial_id" type="radio" required />
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
                                <label class="active" for="first_name2">First Name</label> 
                            </div> --}}
                        </div>
                        <div class="row">
                            {{-- <div class="input-field col s6">
                                <input id="dt_naiss" type="text" class="datepicker" name="dt_naiss">
                                <label class="active" for="dt_naiss">Date de naissance</label>
                            </div> --}}
                            <div class="input-field col s6">
                                <input id="telephone" type="number" class="validate" name="telephone" >
                                <label class="active" for="telephone">Téléphone</label>
                            </div>

                            <div class="input-field col s6">
                                <select class="select2 browser-default" id="entite" name="entite" required>
                                    <option value="" disabled selected>--Profils--</option>
                                </select>
                                <label class="active" for="entite">Profil</label>

                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="email" type="email" class="validate" name="email">
                                <label class="active" for="email">Email</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="login" type="text" class="validate" name="login">
                                <label class="active" for="login">Login</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="password" type="password" class="validate" name="password">
                                <label class="active" for="password">Mot de passe</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="cmdp" type="password" class="validate" name="cmdp">
                                <label class="active" for="cmdp">Confirmation mot de passe</label>
                            </div>
                        </div>
                        <div class="row">

                            <div class="input-field col s6">
                                <select class="select2 browser-default" id="pays" name="pays">
                                    <option value="" disabled selected>Pays</option>
                                </select>
                                <label class="active" for="pays">Pays</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <select class="select2 browser-default region" id="region" name="region">
                                    <option value="" disabled selected>--Région--</option>
                                </select>
                                <label class="active" for="region">Région</label>
                            </div>
                            <div class="input-field col s6">
                                <select class="select2 browser-default dept" id="dept" name="dept">
                                    <option value="" disabled selected>--Département--</option>

                                </select>
                                <label class="active" for="dept">département</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <select class="select2 browser-default commune" id="commune" name="commune">
                                    <option value="" disabled selected>--Commune--</option>
                                </select>
                                <label class="active" for="commune">Commune</label>
                            </div>
                            <div class="input-field col s6">
                                <select class="select2 browser-default localite" id="localite" name="localite">
                                    <option value="" disabled>--Localité--</option>
                                </select>
                                <label class="active" for="localite">Localité</label>
                            </div>
                        </div>

                        <div class="row">

                            <div class="input-field col s12">
                                <div class="row" id="load"></div>
                                {{-- <button id="formAddUserbtn" type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Enregistrer</button> --}}
                                <div class="col s12 display-flex justify-content-end mt-1">
                                    <button id="formAddFermeUserbtn" type="submit" class="btn indigo">
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
</div>
@endsection

@section('other-js-script')
<script>
    $(document).ready(function(){
	$("#annuler").click(function(){
		parent.history.back();
		return false;
	});
});

</script>
<!-- START RIGHT SIDEBAR NAV -->


<!-- BEGIN: Footer-->



<!-- END: Footer-->
<!-- BEGIN VENDOR JS-->

<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>

<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>

<script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>

{{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\edit.js')}}"></script> --}}

<script src="{{ asset('assets\js\crud\gestion\ferme\create.js') }}"></script>
<script src="{{ asset('assets\js\providers\location.js') }}"></script>
{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
<script src="{{ asset('assets\js\providers\ferme_profils.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\read.js') }}"></script>
<script src="{{ asset('assets\js\crud\gestion\utilisateurs\user-state.js') }}"></script>

<!-- END PAGE LEVEL JS-->
@endsection
