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
  <a class="yellow-text">Modification Union Groupement</a>
</li>

@endsection
  <div class="row">
    <form  id="formAddLangue" action="/union_groupements/edit" method="POST">
      @csrf
    <div class="col s12">
      <div class="card">
        <div class="card-content pb-0">
          <div class="card-header mb-2">
            <h4 class="card-title">Modification Union Groupement</h4>
          </div>
          <div class="card-body">
            
            <div class="row">

                <input id="id" name="id" value="{{ $union_grp[0]['id_union_groupement'] }}" hidden>

                <div class="input-field col s6">
                    <input id="libelle" type="text" class="validate" name="libelle" value="{{ $union_grp[0]['libelle'] }}">                
                    <label class="active" for="libelle">Libellé</label>
                </div>
                <div class="input-field col s6">
                  <input id="date_creation" type="text" class="datepicker" name="date_creation" value="{{ $union_grp[0]['date_creation'] }}">                
                  <label class="active" for="date_creation">Date Création</label>
                </div>

                <div class="input-field col s6">
                    <select class="select2 browser-default" id="pays" name="pays">
                        <option value="{{ $union_grp[0]['id_pays'] }}" selected>{{ $union_grp[0]['pays'] }}</option>
                    </select>
                    <label class="active" for="pays">Pays</label>
                </div>
                <div class="input-field col s6">
                    <select class="select2 browser-default" id="region" name="region">
                        <option value="{{ $union_grp[0]['id_region'] }}" selected>{{ $union_grp[0]['region'] }}</option>
                    </select>
                    <label class="active" for="region">Région</label>
                </div>

                <div class="input-field col s6">
                    <select class="select2 browser-default" id="dept" name="dept">
                        <option value="{{ $union_grp[0]['id_departement'] }}" selected>{{ $union_grp[0]['departement'] }}</option>
                    </select>
                    <label class="active" for="dept">Département</label>
                </div>
                <div class="input-field col s6">
                    <select class="select2 browser-default" id="commune" name="commune">
                        <option value="{{ $union_grp[0]['id_commune'] }}"  selected>{{ $union_grp[0]['commune'] }}</option>
                    </select>
                    <label class="active" for="commune">Commune</label>
                </div>

                <div class="input-field col s6">
                    <select class="select2 browser-default" id="localite" name="localite">
                        <option value="{{ $union_grp[0]['id_localite'] }}" selected>{{ $union_grp[0]['localite'] }}</option>
                    </select>             
                    <label class="active" for="localite">Localité</label>
                </div>

                <div class="input-field col s6">
                    <select class="select2 browser-default" id="OP" name="AUOP">

                        {{-- @if ($union_grp[0]['id_AUOP'] != null)
                            <option value="{{ $union_grp[0]['id_AUOP'] }}" selected>{{ $union_grp[0]['nom_AUOP'] }}</option>
                        @else
                          <option value="" selected>Aucune</option>
                        @endif
                        @foreach ($auop as $item)
                            <option value="{{ $item['id_auop'] }}">{{ $item['libelle'] }}</option>
                        @endforeach --}}


                        @if ($union_grp[0]['id_AUOP'] != null)
                              
                              @foreach ($auop as $item)

                                @if($item['id_auop'] == $union_grp[0]['id_AUOP'])
                                     <option value="{{ $item['id_auop'] }}" selected>{{ $item['libelle'] }}</option>
                                @else
                                     <option value="{{ $item['id_auop'] }}">{{ $item['libelle'] }}</option>
                                @endif

                              @endforeach

                              <option value="">Aucune</option>

                          @else

                              <option value="" selected>Aucune</option>

                              @foreach ($auop as $item)

                                <option value="{{ $item['id_auop'] }}">{{ $item['libelle'] }}</option>  

                              @endforeach


                          @endif

                    </select>             
                     <label class="active" for="AUOP">AUOP</label>
                </div>

                <div class="input-field col s6">
                    <input id="description" type="text" class="validate" name="description" value="{{ $union_grp[0]['description'] }}">                
                    <label class="active" for="libelle">Description</label>
                </div>

                @if (in_array($_SESSION['role'],["SUPERADMIN","ADMIN"]))

                    <div class="input-field col s6">
                      <select class="select2 browser-default" name="entite">

                          {{-- @if ($union_grp[0]['id_entite'] != null)
                              <option value="{{ $union_grp[0]['id_entite'] }}" selected>{{ $union_grp[0]['nom_entite'] }}</option>
                          @else
                            <option value="" selected>Aucune</option>
                          @endif

                          @foreach ($ong as $item)
                              <option value="{{ $item['id_entite'] }}">{{ $item['nom_entite'] }}</option>
                          @endforeach --}}



                          @if ($union_grp[0]['id_entite'] != null)
                              
                              @foreach ($ong as $item)

                                @if($item['id_entite'] == $union_grp[0]['id_entite'])
                                    <option value="{{ $item['id_entite'] }}" selected>{{ $item['nom_entite'] }}</option>
                                @else
                                    <option value="{{ $item['id_entite'] }}">{{ $item['nom_entite'] }}</option>
                                @endif

                              @endforeach

                              <option value="">Aucune</option>

                          @else

                              <option value="" selected>Aucune</option>

                              @foreach ($ong as $item)

                                <option value="{{ $item['id_entite'] }}">{{ $item['nom_entite'] }}</option>

                              @endforeach

                          @endif

                      </select>             
                      <label class="active" for="OP">Entité</label>
                    </div>
                                        
                @endif

            </div>

            <div class="row">
                <div class="input-field col s12">
                  <div class="row" id="load"></div>
                    {{-- <button id="formAddUserbtn" type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Enregistrer</button> --}}
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
    
    <script src="{{ asset('assets/js/crud/gestion/groupements/localite.js') }}"></script>

@endsection