@extends('layouts.master')
@section('other-css-files')

<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-modern-menu-template/materialize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-modern-menu-template/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/form-select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/page-users.css')}}">

@endsection
@section('main_content')
@section('page-title')
    Langues
@endsection
@section('ariane')
<li class="breadcrumb-item">
  <a href="{{url('/dashboard')}}">Acceuil</a>
</li>
<li class="breadcrumb-item">
   <a href="{{url('/langue')}}">Régions</a>
</li>

<li class="breadcrumb-item">
  <a class="yellow-text">Nouvelle Région</a>
</li>
@endsection
  <div class="row">
    <form  id="formAddLangue" action="/regions/store" method="POST">
      @csrf
    <div class="col s12">
      <div class="card">
        <div class="card-content pb-0">
          <div class="card-header mb-2">
            <h4 class="card-title">Nouvelle Région</h4>
          </div>
          <div class="card-body">
            
            <div class="row">
              <div class="input-field col s6">
                <input id="region" type="text" class="validate" name="region" >                
                <label class="active" for="region">Nom de la Région</label>
              </div>
              <div class="input-field col s6">
                <select class="select" id="pays" name="pays">
                  <option value="" disabled selected>Choisissez le pays</option>
                  <option value="1" >Sénégal</option>
                  <option value="2">Mali</option>
                </select>              
                <label class="active" for="pays">Nom du pays</label>
              </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                  <div class="row" id="load"></div>
                    <div class="col s12 display-flex justify-content-end mt-1">
                      <button id="formAddLanguebtn" type="submit" class="btn indigo">
                        Enregistrer</button>
                      <button type="button" class="ml-1 btn btn-light">Annuler</button>
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
    
    {{-- <script src="{{asset('assets\js\crud\gestion\langues\create.js')}}"></script> --}}
    <script src="{{asset('assets\js\providers\location.js')}}"></script>
    {{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
    <script src="{{asset('assets\js\providers\entity.js')}}"></script>
    
    {{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\read.js')}}"></script> --}}
    {{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\user-state.js')}}"></script> --}}
    
    <!-- END PAGE LEVEL JS-->
@endsection