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
{{$_SESSION['nom_entite']}} 
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="{{ url('/dashboard') }}">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/ferme/utilisateurs') }}">Utilisateurs</a>
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

            </ul>
            <div class="divider mb-3"></div>
            <div class="row">
                <div class="col s12" id="account">
                    <!-- users edit media object start -->

                    <div class="media display-flex align-items-center mb-2">
                       
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
                    <form method="POST" action="{{ url('/ferme/edit_user') }}" id="editUserFerme">
                        @csrf
                        <div class="row">
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="utilisateur" type="text" name="utilisateur"
                                            value="{{ $userInfos['utilisateur'] }}" hidden>
                                            {{-- <input  type="text"  id="role" name="role"
                                            value="{{ $userInfos['id_role'] }}" hidden> --}}
                                        <input id="icon_telephone8" type="text" class="validate" name="login"
                                            value="{{ $userInfos['login'] }}">
                                        <label for="icon_telephone8">Login</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                    <div class="col s12 input-field">
                                        <input id="prenom" name="prenom" type="text" class="validate"
                                            value="{{ $userInfos['prenom'] }}" data-error=".errorTxt2">
                                        <label for="icon_prefix7">Prénom</label>
                                        <small class="errorTxt3"></small>
                                    </div>
                                    {{-- <i class="material-icons prefix">account_circle</i> --}}
                                    <div class="col s12 input-field">
                                        <input id="icon_prefix2" type="text" class="validate" name="nom"
                                            value="{{ $userInfos['nom'] }}" data-error=".errorTxt2">
                                        <label for="icon_prefix7">Nom</label>
                                        <small class="errorTxt3"></small>

                                    </div>

                                    <div class="col s12 input-field">
                                        <input id="icon_prefix7" type="email" class="validate" name="email"
                                            value="{{ $userInfos['email'] }}">
                                        <label for="icon_prefix7">Email</label>
                                        <small class="errorTxt3"></small>
                                    </div>


                                    {{-- <div class="row">
                                        <div class="input-field col s6">
                                         
                                            <input id="icon_prefix9" type="password" class="validate"
                                                name="password" disabled>
                                            <label for="icon_prefix9">Mot de passe</label>
                                        </div>
                                        <div class="input-field col s6">
                                           
                                            <input id="icon_prefix10" type="password" class="validate"
                                                name="cmdp" disabled>
                                            <label for="icon_prefix10">Confirmation mot de passe</label>
                                        </div>
                                    </div> --}}
                                    <div class="row">
                                        <div class="input-field col s12">
                                            {{-- <i class="material-icons prefix">phone</i> --}}
                                            <input id="icon_telephone6" type="number" class="validate"
                                                name="telephone" value="{{ $userInfos['telephone'] }}">
                                            <label for="icon_telephone6">Téléphone</label>
                                        </div>

                                    </div>
                                    <div class="input-field col s12">
                                      
                                        <span><label for="entite">Fonction</label></span>
                                       
                                        <select required class=" browser-default entite" name="entite" >
                                   
                                            <option value="{{ $userInfos['id_role'] }}"  >
                                                {{ $userInfos['entite'] }} </option>
                                        </select>
                                       
                                 
                                    
                                </div>

                                </div>
                            </div>
                            <div class="col s12 m6">
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

                                </div>
                                <div class="row">

                                    <div class="col s12 input-field">
                                        <select>
                                            <option value="{{ $userInfos['actif'] }}">
                                                {{ $userInfos['actif'] == 1 ? 'Actif' : 'Inactif' }} </option>
                                        </select>
                                        <label>Statut</label>
                                    </div>
                                


                                    <div class="input-field col s12">
                                        {{-- <i class="material-icons prefix">phone</i> --}}
                                        <span><label for="">Pays</label></span>
                                        <select class="browser-default" id="pays" name="pays">
                                            <option value="{{ $userInfos['id_pays'] }}" selected>
                                                {{ $userInfos['pays'] }}</option>
                                        </select>
                                        {{-- <label for="icon_prefix12">Pays</label> --}}
                                    </div>
                                    {{-- <div class="input-field col s6">
                                      
                                            <span><label for="entite">Fonction</label></span>
                                        <select class=" " id="entite" >
                                            <option value="{{ $userInfos['entite'] }}" selected>{{ $userInfos['entite'] }}
                                            </option>
                                        </select>
                                        
                                    </div> --}}



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


                                    {{-- <div class="col s12 input-field">
                    {{-- <span><label>Statut</label></span>
                    <select class="browser-default" >
                    </select>
                    <label>Statut</label>
                </div> --}}
                                </div>
                            </div>
                            <div class="col s12">
                                <div class="load"></div>
                                <!-- </div> -->
                            </div>


                            <div class="col s12 display-flex justify-content-end mt-3">
                                <button type="button" id="editUserFermebtn" class="btn indigo">
                                    Enregistrer</button>
                                <button id="annuler" type="button" class="btn btn-light">Annuler</button>
                            </div>


                        </div>
                </div>
                </form>
                <!-- users edit account form ends -->
            </div>

        </div>
        <!-- </div> -->
    </div>
</div>
</div>
<!-- users edit ends -->
<!-- START RIGHT SIDEBAR NAV -->

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
{{-- <script src="{{ asset('assets\js\providers\location.js') }}"></script> --}}
{{-- <script src="{{ asset('assets\js\providers\entity.js') }}"></script> --}}

{{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\edit.js')}}"></script> --}}

<script src="{{ asset('assets\js\providers\ferme_profils.js') }}"></script>


<script src="{{ asset('assets/js/crud/gestion/ferme/user/message.js') }}"></script>
@endsection
