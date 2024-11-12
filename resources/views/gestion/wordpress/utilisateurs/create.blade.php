@extends('layouts.master')
@section('other-css-files')

<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-modern-menu-template/materialize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-modern-menu-template/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/form-select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/page-users.css')}}">

@endsection
@section('main_content')
@section('page-title')
    Utilisateurs
@endsection
@section('ariane')
<li class="breadcrumb-item">
  <a href="{{url('/dashboard')}}">Accueil</a>
</li>
<li class="breadcrumb-item">
   <a href="{{url('/louma-mbay/utilisateurs')}}">Utilisateurs</a>
</li>

<li class="breadcrumb-item">
    <a class="yellow-text">Nouvel Utilisateur</a>
</li>
@endsection
  <div class="row">
    <form  method="POST"  action="/louma-mbay/utilisateurs/enregistrer">
      @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Nouvel utilisateur</h4>
                    </div>
                    <div class="card-body">
                        <input id="login" name="login" type="text" class="form-control" value="agueye" hidden>
                        <input id="password" name="password" type="text" class="form-control" value="0WJgW^qcSLn88&^0Vv2mm*8x" hidden>
                        <div class="row">
                            <div class="input-field col s6">
                                <label for="" class="col-form-label">Prénom</label>
                                <input type="text" class="form-control" id="first_name" name="first_name">
                            </div>
                            <div class="input-field col s6">
                                <label for="" class="col-form-label">Nom</label>
                                <input type="text" class="form-control" id="last_name" name="last_name">
                            </div>
                            <div class="input-field col s6">
                                <label for="" class="col-form-label">Username</label>
                                <input id="username" name="username" type="text" class="form-control" required>
                            </div>
                            <div class="input-field col s6">
                                <label for="" class="col-form-label">Mot de passe</label>
                                <input id="pwd" name="pwd" type="password" class="form-control" required>
                            </div>
                            <div class="input-field col s6">
                                <label for="" class="col-form-label">Email</label>
                                <input id="email" name="email" type="text" class="form-control" required>
                            </div>
                            <div class="input-field col s6">
                                <select class="select" id="roles" name="roles[0]">
                                  <option value="" disabled selected>Choisissez le rôle</option>
                                  <option value="wcfm_vendor" >Propriétaire de magasin</option>
                                  <option value="customer">Client</option>
                                  <option value="subscriber">Abonné</option>
                                  <option value="administrator">Administrateur</option>
                                </select>              
                                <label class="active" for="roles">Rôle</label>
                            </div>
                        </div>
                        
                        <div class="row">
                        
                            <div class="input-field col s12">
                                <div class="row" id="load"></div>
                                    {{-- <button id="formAddUserbtn" type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Enregistrer</button> --}}
                                    <div class="col s12 display-flex justify-content-end mt-1">
                                        <button type="submit" class="btn indigo">
                                            Enregistrer</button>
                                        <button type="button" class="ml-1 btn btn-light">Annuler</button>
                                    </div>
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

<!-- START RIGHT SIDEBAR NAV -->

    
    <!-- BEGIN: Footer-->

    

    <!-- END: Footer-->
    <!-- BEGIN VENDOR JS-->

    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('assets/js/scripts/form-select2.js')}}"></script>

    <script src="{{asset('assets/js/plugins.js')}}"></script>
    <script src="{{asset('assets/js/search.js')}}"></script>
    <script src="{{asset('assets/js/custom/custom-script.js')}}"></script>
    <script src="{{asset('assets/js/scripts/customizer.js')}}"></script>
    
    <script src="{{asset('assets/js/scripts/page-users.js')}}"></script>
    <script src="{{asset('assets/js/scripts/advance-ui-modals.js')}}"></script>
    <script src="{{asset('assets/js/scripts/form-elements.js')}}"></script>
    <script src="{{asset('assets/js/scripts/ui-alerts.js')}}"></script>
    
    {{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\edit.js')}}"></script> --}}
    
    <script src="{{asset('assets\js\crud\gestion\utilisateurs\create.js')}}"></script>
    <script src="{{asset('assets\js\providers\location.js')}}"></script>
    {{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
    <script src="{{asset('assets\js\providers\entity.js')}}"></script>
    
    <script src="{{asset('assets\js\crud\gestion\utilisateurs\read.js')}}"></script>
    <script src="{{asset('assets\js\crud\gestion\utilisateurs\user-state.js')}}"></script>
    
    <!-- END PAGE LEVEL JS-->
@endsection