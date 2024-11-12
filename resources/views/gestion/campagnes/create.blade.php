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
  <a href="/admin">Acceuil</a>
</li>
<li class="breadcrumb-item">
   <a href="#">Utilisateurs</a>
</li>

<li class="breadcrumb-item active">Rôles
</li>
@endsection
<div class="card">
  <div class="card-content">
    <h4 class="card-title">Nouvel entité</h4>
    <div class="row">
      <form  method="POST"  id="formAddEntity"   action="#">
        @csrf
        <div class="col s12">
          <div class="card-content pb-0">
            <div class="row">
              <div class="input-field col s6">
                <input id="nom_entite" type="text" class="validate" name="nom_entite" >                
                <label class="active" for="nom_entite">Nom entité</label>
              </div>
              <div class="input-field col s6">
                <select class="select2 browser-default" id="type_entite" name="type_entite">
                  <option value="" disabled selected>--Type entité--</option>
                </select>                
                <label class="active" for="type_entite">Type</label>
              </div>
            </div>        
            <div class="row">
              <div class="input-field col s12">
                <input id="description" type="text" class="validate" name="description" >                
                <label class="active" for="description">Description</label>
              </div> 
            </div>
            <div class="row">
              <div class="input-field col s12">
                <div class="row" id="load"></div>
                  <div class="col s12 display-flex justify-content-end mt-1">
                    <button id="formAddEntitybtn" type="submit" class="btn indigo">Enregistre</button>
                    <button type="button" class="ml-1 btn btn-light">Annuler</button>
                  </div>
                </div>
              </div>      
          </div>
        </div>
      </form>
    </div>
  </div>
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
    
    <script src="{{asset('assets\js\crud\gestion\utilisateurs\role\create.js')}}"></script>
    <script src="{{asset('assets\js\providers\location.js')}}"></script>
    {{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
    <script src="{{asset('assets\js\providers\type_entity.js')}}"></script>
    
    <script src="{{asset('assets\js\crud\gestion\utilisateurs\read.js')}}"></script>
    <script src="{{asset('assets\js\crud\gestion\utilisateurs\user-state.js')}}"></script>
    
    <!-- END PAGE LEVEL JS-->
@endsection