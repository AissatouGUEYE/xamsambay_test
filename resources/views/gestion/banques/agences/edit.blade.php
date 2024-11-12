@extends('layouts.master')
@section('other-css-files')

<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-modern-menu-template/materialize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-modern-menu-template/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/form-select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/page-users.css')}}">

@endsection
@section('main_content')
@section('page-title')
    Banques
@endsection
@section('ariane')
<li class="breadcrumb-item">
  <a href="{{url('/dashboard')}}">Accueil</a>
</li>
<li class="breadcrumb-item">
   <a href="{{url('/banques/liste')}}">Banques</a>
</li>

<li class="breadcrumb-item">
  <a class="yellow-text">Modification Agence</a>
</li>
@endsection
  <div class="row">
    <form  id="formEditAgence" action="/banques/liste/agences/edit/{{ $banque }}/{{ $nom_banque }}" method="POST">
      @csrf
    <div class="col s12">
      <div class="card">
        <div class="card-content pb-0">
          <div class="card-header mb-2">
            <h4 class="card-title">Modification Agence</h4>
          </div>
          <div class="card-body">
            
            <div class="row">

                <input id="id" name="id" value="{{ $agence[0]['id'] }}" hidden>

                <div class="input-field col s6">
                      <select class="select2 browser-default" id="pays" name="pays">
                          <option value="{{ $agence[0]['id_pays'] }}" selected>{{ $agence[0]['pays'] }}</option>
                      </select>
                      <label class="active" for="pays">Pays</label>
                  </div>
                  <div class="input-field col s6">
                      <select class="select2 browser-default" id="region" name="region">
                          <option value="{{ $agence[0]['id_region'] }}" selected>{{ $agence[0]['region'] }}</option>
                      </select>
                      <label class="active" for="region">Région</label>
                  </div>

                  <div class="input-field col s6">
                      <select class="select2 browser-default" id="dept" name="dept">
                          <option value="{{ $agence[0]['id_departement'] }}" selected>{{ $agence[0]['departement'] }}</option>
                      </select>
                      <label class="active" for="dept">Département</label>
                  </div>
                  <div class="input-field col s6">
                      <select class="select2 browser-default" id="commune" name="commune">
                          <option value="{{ $agence[0]['id_commune'] }}"  selected>{{ $agence[0]['commune'] }}</option>
                      </select>
                      <label class="active" for="commune">Commune</label>
                  </div>

                  <div class="input-field col s6">
                      <select class="select2 browser-default" id="localite" name="localite">
                          <option value="{{ $agence[0]['id_localite'] }}" selected>{{ $agence[0]['localite'] }}</option>
                      </select>             
                      <label class="active" for="localite">Localité</label>
                  </div>

                  <div class="input-field col s6">
                        <input id="adresse" type="text" class="validate" name="adresse" value="{{ $agence[0]['adresse'] }}">                
                        <label class="active" for="adresse">Adresse</label>
                  </div>

                  <div class="input-field col s6">
                      <input id="telephone" type="text" class="validate" name="telephone" value="{{ $agence[0]['telephone'] }}">                
                      <label class="active" for="telephone">Téléphone</label>
                  </div>


            </div>

            <div class="row">
                <div class="input-field col s12">
                  <div class="row" id="load"></div>
                    {{-- <button id="formAddUserbtn" type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Enregistrer</button> --}}
                    <div class="col s12 display-flex justify-content-end mt-1">
                      <button id="formEditAgencebtn" type="button" class="btn indigo">
                        Enregistrer les Modifications</button>
                      {{-- <button type="button" class="ml-1 btn btn-light">Annuler</button> --}}
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
    
    <script src="{{ asset('assets/js/crud/gestion/banques/agences/message.js') }}"></script>

    <script src="{{ asset('assets/js/crud/gestion/groupements/localite.js') }}"></script>

@endsection