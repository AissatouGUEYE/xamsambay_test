@extends('layouts.master')
@section('other-css-files')

<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-modern-menu-template/materialize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-modern-menu-template/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/form-select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/page-users.css')}}">

@endsection
@section('main_content')
@section('page-title')
Communes
@endsection
@section('ariane')
<li class="breadcrumb-item">
  <a href="{{url('/dashboard')}}">Accueil</a>
</li>
<li class="breadcrumb-item">
   <a href="{{url('/localites')}}">Localités</a>
</li>

<li class="breadcrumb-item">
  <a class="yellow-text">Modification Commune</a>
</li>
@endsection
  <div class="row">
    <form  id="formAddLangue" action="/communes/edit" method="POST">
      @csrf
    <div class="col s12">
      <div class="card">
        <div class="card-content pb-0">
          <div class="card-header mb-2">
            <h4 class="card-title">Modification Commune</h4>
          </div>
          <div class="card-body">
            
            <div class="row">

                <input id="id" name="id" value="{{ $commune[0]['id'] }}" hidden>

                <div class="input-field col s6">
                    <input id="commune" type="text" class="validate" name="commune" value="{{ $commune[0]['commune'] }}">                
                    <label class="active" for="commune">Nom de la commune</label>
                </div>
                <div class="input-field col s6">
                    <select class="select2 browser-default" id="departement" name="departement">
                        {{-- <option value="{{ $commune[0]['id_departement'] }}" selected>{{ $commune[0]['departement'] }}</option>
                        @foreach ($dep as $item)
                            <option value="{{ $item['id'] }}">{{ $item['departement'] }}</option>
                        @endforeach --}}


                        @foreach ($dep as $item)

                          @if($item['id'] == $commune[0]['id_departement'])
                              <option value="{{ $item['id'] }}" selected>{{ $item['departement'] }}</option>
                          @else
                              <option value="{{ $item['id'] }}">{{ $item['departement'] }}</option>
                          @endif

                        @endforeach


                    </select>             
                    <label class="active" for="departement">Nom du département</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                  <div class="row" id="load"></div>
                    <div class="col s12 display-flex justify-content-end mt-1">
                      <button id="formAddLanguebtn" type="submit" class="btn indigo">
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
    
    {{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\edit.js')}}"></script> --}}
    
    {{-- <script src="{{asset('assets\js\crud\gestion\langues\create.js')}}"></script> --}}
    <script src="{{asset('assets\js\providers\location.js')}}"></script>
    {{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
    <script src="{{asset('assets\js\providers\entity.js')}}"></script>
    
    {{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\read.js')}}"></script> --}}
    {{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\user-state.js')}}"></script> --}}
    
    <!-- END PAGE LEVEL JS-->
@endsection