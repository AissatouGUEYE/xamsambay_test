@extends('layouts.master')
@section('other-css-files')
    <meta>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('main_content')
    <!-- users edit start -->
@section('page-title')
    Utilisateurs
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="{{ url('/dashboard') }}">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        @if ($_SESSION['role'] == 'ONG')
            <a href="/ong/utilisateurs">Utilisateurs</a>
        @else
            <a href="/admin/utilisateurs">Utilisateurs</a>
        @endif
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Modification Utilisateur
    </li>
@endsection
@php
    $user = Auth::user();
@endphp
<div class="section users-edit">
    <div class="card">
        <div class="card-content">
            <!-- <div class="card-body"> -->
            <ul class="tabs mb-2 row">
                <li class="tab">
                    <a class="display-flex align-items-center active" id="account-tab" href="#account">
                        <i class="material-icons mr-1">person_outline</i><span>Account</span>
                    </a>
                </li>
                <li class="tab">
                    <a class="display-flex align-items-center" id="information-tab" href="#information">
                        <i class="material-icons mr-2">error_outline</i><span>Information</span>
                    </a>
                </li>
            </ul>
            <div class="divider mb-3"></div>
            <div class="row">
                <div class="col s12" id="account">
                    <!-- users edit media object start -->

                    <div class="media display-flex align-items-center mb-2">
                        @php
                            // dd($userInfos);
                        @endphp
                        @if ($user->id == $userInfos['utilisateur'])
                            <form method="POST" action="{{ route('user.change.avatar') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mr-3">
                                    <a class="mr-2" href="#">
                                        <img @if ($userInfos['logo'] == '') src="{{ asset('assets/images/avatar/person-icon.png') }}" @else src="{{ asset('storage/' . $userInfos['logo']) }}" @endif
                                            alt="users avatar" class="z-depth-4 circle" height="64" width="64">
                                        <br>
                                        <input type="file" id="avatar" name="avatar"
                                            accept="image/png, image/jpeg" required>
                                        <input type="text" id="id" name="id" hidden
                                            value="{{ $userInfos['utilisateur'] }}">
                                    </a>
                                    <br>
                                    <button type="submit" class="btn-small indigo mt-2 mr-2">Change</button>
                                    <a href="{{ route('user.reset.avatar', ['id' => $userInfos['utilisateur']]) }}"
                                        class="btn-small btn-light-pink">Reset</a>
                                </div>
                            </form>
                        @else
                            <div class="mr-3">
                                <a class="mr-2" href="#">
                                    <img @if ($userInfos['logo'] == '') src="{{ asset('assets/images/avatar/person-icon.png') }}" @else src="{{ asset('storage/' . $userInfos['logo']) }}" @endif
                                        alt="users avatar" class="z-depth-4 circle" height="64" width="64">
                                    <br>
                                </a>
                                <br>
                            </div>
                        @endif

                        <div class="media-body">
                            <h5 class="media-heading mt-0">{{ $userInfos['prenom'] }}</h5>
                            <span>{{ $userInfos['nom'] }}</span>
                            <div class="user-edit-btns display-flex">
                                {{-- <label for="avatar">Choose a profile picture:</label> --}}
                            </div>
                        </div>
                    </div>
                    <!-- users edit media object ends -->
                    <!-- users edit account form start -->
                    <form id="editUserAccountForm" class="user-edit" method="POST"
                        data-id="{{ $userInfos['utilisateur'] }}" action="#">
                        @csrf
                        <div class="row">
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="icon_telephone8" type="text" class="validate" name="login"
                                            value="{{ $userInfos['login'] }}">
                                        <label for="icon_telephone8">Login</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                    <div class="col s12 input-field">
                                        <input id="prenom" name="prenom" type="text" class="validate"
                                            value="{{ $userInfos['prenom'] }}" data-error=".errorTxt2">
                                        <label for="prenom">Prénom</label>
                                        <small class="errorTxt2"></small>
                                    </div>
                                    <div class="col s12 input-field">
                                        <input id="icon_prefix7" type="email" class="validate" name="email"
                                            value="{{ $userInfos['email'] }}">
                                        <label for="icon_prefix7">Email</label>
                                        <small class="errorTxt3"></small>
                                    </div>
                                    <div class="col s12 input-field">
                                        <select class="browser-default" id="role" name="role">
                                            <option value="null">
                                                Choisissez un role</option>
                                            @isset($roleGpt)
                                                @foreach ($roleGpt as $item)
                                                    @if ($item->role == $userInfos['role'])
                                                        <option value="{{ $item->id }}" selected>
                                                            {{ $item->role }}</option>
                                                    @else
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->role }}</option>
                                                    @endif
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                    @if ($userInfos['nom_typentite'] == 'SUPERVISEUR' || $userInfos['nom_typentite'] == 'GERANT')
                                        <div class="col s12 input-field">
                                            <select class="browser-default" id="pluvio" name="pluvio">
                                                <option value="null">
                                                    Choisissez un pluvio</option>
                                                @isset($pluvio)
                                                    @foreach ($pluvio as $item)
                                                        @if ($item->pluvio == $userInfos['pluvio'])
                                                            <option value="{{ $item->id }}" selected>
                                                                {{ $item->pluvio }}</option>
                                                        @else
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->pluvio }}</option>
                                                        @endif
                                                    @endforeach
                                                @endisset
                                            </select>
                                            {{-- <input id="role" type="text" class="validate" name="role"
                                            value="{{ $userInfos['email'] }}">
                                        <label for="role">Role</label> --}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <select class="browser-default" id="type_entite" name="type_entite">
                                            <option value="{{ $userInfos['type_entite'] }}">
                                                {{ $userInfos['nom_typentite'] }}</option>
                                        </select>
                                        {{-- <label>Rôle</label> --}}
                                    </div>
                                    <div class="col s12 input-field">
                                        <select>
                                            <option value="{{ $userInfos['actif'] }}">
                                                {{ $userInfos['actif'] == 1 ? 'Actif' : 'Inactif' }} </option>
                                            @if ($userInfos['actif'] == 1)
                                                <option value="0">Inactif</option>
                                            @else
                                                <option value="1">Actif</option>
                                            @endif
                                        </select>
                                        <label>Statut</label>
                                    </div>
                                    @if ($_SESSION['role'] === 'FERME AGRICOLE')
                                        <div class="input-field col s12">
                                            <select class="select2 browser-default" id="entite" name="entite">
                                                <option value="{{ $userInfos['role'] }}" selected>
                                                    {{ $userInfos['role'] }}</option>
                                            </select>
                                            <label class="active" for="entite">Profil</label>
                                        </div>
                                    @else
                                        <div class="col s12 input-field">
                                            <span>
                                                <label>Entite</label>
                                            </span>
                                            <select class="browser-default" name="entite">
                                                <option value="{{ $userInfos['entite'] }}" selected>
                                                    {{ $userInfos['nom_entite'] }}</option>
                                                @foreach ($entities as $entite)
                                                    @if ($entite->id != $userInfos['entite'])
                                                        <option value="{{ $entite->id }}">{{ $entite->nom_entite }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col s12 input-field">
                                            <span>
                                                <label>Reseau</label>
                                            </span>
                                            <select class="browser-default" id="groupement" name="groupement">
                                                <option value="null">
                                                    Choisissez un reseau</option>
                                                @if ($_SESSION['role'] == 'ONG')
                                                    @isset($Gpt)
                                                        @foreach ($Gpt as $item)
                                                            @if ($item->id_groupement == $userInfos['groupement'])
                                                                <option value="{{ $item->id_groupement }}" selected>
                                                                    {{ $item->libelle_groupement }}</option>
                                                            @else
                                                                <option value="{{ $item->id_groupement }}">
                                                                    {{ $item->libelle_groupement }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endisset
                                                @else
                                                    @isset($Gpt)
                                                        @foreach ($Gpt as $item)
                                                            @if ($item->id == $userInfos['groupement'])
                                                                <option value="{{ $item->id }}" selected>
                                                                    {{ $item->libelle }}</option>
                                                            @else
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->libelle }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endisset
                                                @endif
                                            </select>
                                            {{-- <label for="groupement">Groupement de Base</label> --}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col s12">
                                <div class="load"></div>
                                <!-- </div> -->
                            </div>


                            <div class="col s12 display-flex justify-content-end mt-3">
                                <button type="submit" class="btn indigo" onclick="$('.user-edit').submit()">
                                    Enregistrer</button>
                                <button type="button" class="btn btn-light">Annuler</button>
                            </div>


                        </div>
                </div>
                </form>
                <!-- users edit account form ends -->
                {{-- </div> --}}
                <div class="col s12" id="information">
                    <!-- users edit Info form start -->
                    <form class="col s12 user-edit" method="POST" id="userEditInfotabForm" action="#">
                        {{-- @csrf --}}
                        <div class="row">
                            <div class="input-field col s12">
                                {{-- <i class="material-icons prefix">account_circle</i> --}}
                                <input id="icon_prefix2" type="text" class="validate" name="nom"
                                    value="{{ $userInfos['nom'] }}">
                                <label for="icon_prefix2">Nom</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                {{-- <i class="material-icons prefix">account_circle</i> --}}

                                <div class="row">
                                    <label>
                                        <p>
                                            <input value="M" name="sexe" type="radio"
                                                {{ $userInfos['sexe'] === 'M' ? 'checked' : '' }} required />
                                            <span>Homme</span>
                                        </p>

                                    </label>
                                </div>

                                <div class="row">
                                    <label>
                                        <p>
                                            <input value="F" name="sexe" type="radio"
                                                {{ $userInfos['sexe'] === 'F' ? 'checked' : '' }} required />
                                            <span>Femme</span>
                                        </p>
                                    </label>
                                </div>

                                {{-- </p> --}}
                                {{-- <label>Materialize Select</label> --}}
                                {{-- <label for="icon_prefix3">Sexe</label> --}}
                            </div>
                            <div class="input-field col s6">
                                {{-- <i class="material-icons prefix">phone</i> --}}
                                <input id="icon_prefix4" type="text" class="datepicker" name="dt_naiss"
                                    value="{{ date('d-m-Y', strtotime($userInfos['dt_naiss'])) }}">
                                <label for="icon_telephone4">Date de naissance <i style="font-size: 12px">(+15
                                        ans)</i></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                {{-- <i class="material-icons prefix">account_circle</i> --}}
                                <span><label for="">Situation matrimoniale</label></span>
                                <select id="icon_prefix3" name="sit_matrimonial">
                                    <option value="{{ $userInfos['sit_matrimonial_id'] }}" disabled selected>
                                        {{ $userInfos['sit_matrimonial'] }}</option>
                                </select>
                                {{-- <label for="icon_prefix5">Situation matrimoniale</label> --}}
                            </div>
                            <div class="input-field col s6">
                                {{-- <i class="material-icons prefix">phone</i> --}}
                                <input id="icon_telephone6" type="number" class="validate" name="telephone"
                                    value="{{ $userInfos['telephone'] }}">
                                <label for="icon_telephone6">Téléphone</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                {{-- <i class="material-icons prefix">account_circle</i> --}}
                                <input id="icon_prefix9" type="password" class="validate" name="password" disabled>
                                <label for="icon_prefix9">Mot de passe</label>
                            </div>
                            <div class="input-field col s6">
                                {{-- <i class="material-icons prefix">account_circle</i> --}}
                                <input id="icon_prefix10" type="password" class="validate" name="cmdp" disabled>
                                <label for="icon_prefix10">Confirmation mot de passe</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                {{-- <i class="material-icons prefix">account_circle</i> --}}
                                <input id="icon_prefix11" type="text" class="validate" name="fonction"
                                    value="{{ $userInfos['fonction'] }}">
                                <label for="icon_prefix11">Fonction</label>
                            </div>
                            <div class="input-field col s6">
                                {{-- <i class="material-icons prefix">phone</i> --}}
                                <span><label for="">Pays</label></span>
                                <select class="browser-default" id="pays" name="pays">
                                    <option value="{{ $userInfos['id_pays'] }}" selected>{{ $userInfos['pays'] }}
                                    </option>
                                </select>
                                {{-- <label for="icon_prefix12">Pays</label> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                {{-- <i class="material-icons prefix">account_circle</i> --}}
                                <span><label for="">Région</label></span>

                                <select class="browser-default region" id="region" name="region">
                                    <option value="{{ $userInfos['id_region'] }}" selected>
                                        {{ $userInfos['region'] }}</option>

                                </select>
                                {{-- <label for="icon_prefix13">Region</label> --}}
                            </div>
                            <div class="input-field col s6">
                                {{-- <i class="material-icons prefix">phone</i> --}}
                                <span><label for="">Département</label></span>
                                <select class="browser-default dept" id="dept" name="dept">
                                    <option value="{{ $userInfos['id_departement'] }}" selected>
                                        {{ $userInfos['departement'] }}</option>

                                </select>
                                {{-- <label for="icon_prefix14">Departement</label> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                {{-- <i class="material-icons prefix">account_circle</i> --}}
                                <span><label for="">Commune</label></span>

                                <select class="browser-default commune" id="commune" name="commune">
                                    <option value="{{ $userInfos['id_commune'] }}" selected>
                                        {{ $userInfos['commune'] }}</option>

                                </select>
                                {{-- <label for="icon_prefix15">Commune</label> --}}
                            </div>
                            <div class="input-field col s6">
                                <span><label for="">Localité</label></span>
                                {{-- <i class="material-icons prefix">phone</i> --}}
                                <select class="browser-default localite" id="localite" name="localite">
                                    <option value="{{ $userInfos['id_localite'] }}" selected>
                                        {{ $userInfos['localite'] }}</option>

                                </select>
                                {{-- <label for="icon_prefix16"></label> --}}
                            </div>
                        </div>
                        {{-- <div class="col s12">
                        <div class="load"></div>
                        <!-- </div> -->
                    </div> --}}
                        <div class="col s12 display-flex justify-content-end mt-1">
                            <button type="submit" class="btn indigo">
                                Enregistrer</button>
                            <button type="button" class="btn btn-light">Annuler</button>
                        </div>
                </div>
                </form>
                <!-- users edit Info form ends -->
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- users edit ends -->
<!-- START RIGHT SIDEBAR NAV -->

@endsection
@section('other-js-script')
<script src="{{ asset('assets/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery-validation/jquery.validate.min.js') }}"></script>

<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>
<script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>

{{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\create.js')}}"></script> --}}
<script src="{{ asset('assets\js\providers\location.js') }}"></script>
<script src="{{ asset('assets\js\providers\entity.js') }}"></script>
<script src="{{ asset('assets\js\providers\type_entity.js') }}"></script>


<script src="{{ asset('assets\js\crud\gestion\utilisateurs\read.js') }}"></script>
<script src="{{ asset('assets\js\crud\gestion\ferme\create.js') }}"></script>
{{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\edit.js')}}"></script> --}}

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\update.js') }}"></script>
<script src="{{ asset('assets\js\providers\ferme_profils.js') }}"></script>
<script>
    $(document).ready(function() {
        
    });
</script>
@endsection
