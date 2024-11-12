@extends('layouts.master')
@section('other-css-files')

<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-modern-menu-template/materialize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-modern-menu-template/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/form-select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/page-users.css')}}">

@endsection
@section('main_content')
@section('page-title')
Groupements
@endsection
@section('ariane')
<li class="breadcrumb-item">
  <a href="{{url('/dashboard')}}">Accueil</a>
</li>
<li class="breadcrumb-item">
   <a href="{{url('/groupements')}}">Groupements</a>
</li>

<li class="breadcrumb-item">
  <a class="yellow-text">Migrer des Producteurs</a>
</li>
@endsection
  <div class="row">
    <form  id="" action="/enroler/migrer_mail/{{ $libelle }}/{{ $id }}" method="POST" enctype="multipart/form-data">
      @csrf
    <div class="col s12">
      <div class="card">
        <div class="card-content pb-0">
          <div class="card-header mb-2">
            <h4 class="card-title">Migration Producteurs vers le Groupement {{ $libelle }}</h4>
          </div>
          <div class="card-body">

            <div class="row">

                <input id="id" name="id" value="{{ $id }}" hidden>

                
                <div class="file-field input-field">
                    <div class="btn">
                        <span>Fichier</span>
                        <input type="file" name="maillist" accept=".xls, .xlsx">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path" name="maillist_name" type="text">
                    </div>
                </div>

                <div class="input-field col s6">
                    <select class="select2insideprod browser-default" id="pays1" name="pays">
                        <option value="" disabled selected>Pays</option>
                    </select>
                    <label class="active" for="pays">Pays</label>
                </div>
                
                <div class="input-field col s6">
                    <select class="select2insideprod browser-default" id="region1" name="region">
                        <option value="" disabled selected>--Région--</option>
                    </select>
                    <label class="active" for="region">Région</label>
                </div>
                <div class="input-field col s6">
                    <select class="select2insideprod browser-default" id="dept1" name="dept">
                        <option value="" disabled selected>--Département--</option>
                    </select>
                    <label class="active" for="dept">Département</label>
                </div>
                <div class="input-field col s6">
                    <select class="select2insideprod browser-default" id="commune1" name="commune">
                        <option value="" disabled selected>--Commune--</option>
                    </select>
                    <label class="active" for="commune">Commune</label>
                </div>
                <div class="input-field col s6">
                    <select class="select2insideprod browser-default" id="localite1" name="localite">
                        <option value="" disabled selected>--Localité--</option>
                    </select>
                    <label class="active" for="localite1">Localité</label>
                </div>

                <div class="input-field col s6">
                    <select class="select2insideprod browser-default" id="pluvio" name="pluvio">
                        <option value="" disabled selected>--- Pluvio ---</option>
                    </select>
                    <label class="active" for="pluvio">Pluvio</label>
                </div>


            </div>

            <div class="row">
                <div class="input-field col s12">
                  <div class="row" id="load"></div>
                    <div class="col s12 display-flex justify-content-end mt-1">
                      <button type="submit" class="btn indigo">
                        Enregistrer les Modifications</button>
                      {{-- <button type="button" class="ml-1 btn btn-light">Annuler</button> --}}
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

    <script src="{{ asset('assets/js/crud/gestion/groupements/message.js') }}"></script>

    <script src="{{ asset('assets/js/crud/gestion/groupements/delete.js') }}"></script>

    <script src="{{ asset('assets/js/crud/gestion/groupements/localite.js') }}"></script>

@endsection
