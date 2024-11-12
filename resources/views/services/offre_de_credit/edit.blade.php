@extends('layouts.master')
@section('other-css-files')

<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-modern-menu-template/materialize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-modern-menu-template/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/form-select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/page-users.css')}}">

@endsection
@section('main_content')
@section('page-title')
    Offres de Crédit
@endsection
@section('ariane')
<li class="breadcrumb-item">
  <a href="{{url('/dashboard')}}">Accueil</a>
</li>
<li class="breadcrumb-item">
   <a href="{{url('/banques/offre-de-credit')}}">Offres de Crédit</a>
</li>

<li class="breadcrumb-item">
  <a class="yellow-text">Modification Offre</a>
</li>
@endsection
  <div class="row">
    <form  id="formEditOffre" action="/banques/offre-de-credit/edit" method="POST">
      @csrf
    <div class="col s12">
      <div class="card">
        <div class="card-content pb-0">
          <div class="card-header mb-2">
            <h4 class="card-title">Modification Offre de Crédit</h4>
          </div>
          <div class="card-body">
            
            <div class="row">

                <input id="id" name="id" value="{{ $offre[0]['id'] }}" hidden>

                <div class="input-field col s6">
                    <select class="select2insidemodal1 browser-default" name="entite" required>
                        {{-- <option value="{{ $offre[0]['id_entite'] }}" selected>{{ $offre[0]['nom_entite'] }} </option>
                        @foreach ($banques as $item)
                            <option value="{{ $item['id_entite'] }}">{{ $item['nom_entite'] }}</option>
                        @endforeach --}}


                        @foreach ($banques as $item)

                          @if($item['id_entite'] == $offre[0]['id_entite'])
                                <option value="{{ $item['id_entite'] }}" selected>{{ $item['nom_entite'] }}</option>
                          @else
                                <option value="{{ $item['id_entite'] }}">{{ $item['nom_entite'] }}</option>
                          @endif

                        @endforeach


                    </select>
                    <label class="active" for="entite">Banque</label>
                </div>

                <div class="input-field col s6">
                    <input id="nom" type="text" class="validate" name="nom" value="{{ $offre[0]['nom_offre'] }}">
                    <label class="active" for="nom">Nom de l'Offre</label>
                </div>

                <div class="input-field col s6">
                    <input id="description" type="text" class="validate" name="description" value="{{ $offre[0]['description'] }}">                
                    <label class="active" for="description">Description</label>
                </div>

                <div class="input-field col s6">
                    <input id="plancher" type="number" class="validate" name="plancher" value="{{ $offre[0]['plancher'] }}">                
                    <label class="active" for="plancher">Montant Plancher (F CFA)</label>
                </div>

                <div class="input-field col s6">
                    <input id="plafond" type="number" class="validate" name="plafond" value="{{ $offre[0]['plafond'] }}">                
                    <label class="active" for="plafond">Montant Plafond (F CFA)</label>
                </div>
                
                {{-- <div class="input-field col s6">
                    <select class="select2insidemodal1 browser-default" id="unite" name="unite"> --}}
                        {{-- <option value="{{ $offre[0]['id_unite'] }}" selected>{{ $offre[0]['unite'] }} </option>
                        @foreach ($unites as $item)
                            <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                        @endforeach --}}

                      {{-- @foreach ($unites as $item)

                        @if($item['id'] == $offre[0]['id_unite'])
                              <option value="{{ $item['id'] }}" selected>{{ $item['unite'] }}</option>
                        @else
                              <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                        @endif

                      @endforeach

                    </select>
                    <label class="active" for="unite">Unité</label>
                </div> --}}

                <div class="input-field col s6">
                    <input id="date" type="text" class="datepicker" name="date" value="{{ $offre[0]['date'] }}">                
                    <label class="active" for="date">Date</label>
                </div>

                <div class="input-field col s6">
                    <input id="duree" type="number" class="validate" name="duree" value="{{ $offre[0]['duree'] }}">
                    <label class="active" for="duree">Durée (mois)</label>
                </div>

                <div class="input-field col s6">
                    <input id="taux" type="number" class="validate" name="taux" value="{{ $offre[0]['taux'] }}">
                    <label class="active" for="taux">Taux (%)</label>
                </div>

                <div class="input-field col s6">
                    <input id="frais_adhesion" type="number" class="validate" name="frais_adhesion" value="{{ $offre[0]['frais_adhesion'] }}">
                    <label class="active" for="frais_adhesion">Frais d'Adhésion (F CFA)</label>
                </div>

                <div class="input-field col s6">
                    <input id="apport_personnel" type="number" class="validate" name="apport_personnel" value="{{ $offre[0]['apport_personnel'] }}">
                    <label class="active" for="apport_personnel">Apport Personnel (F CFA)</label>
                </div>

                <div class="input-field col s6">
                    <input id="frais_dossier" type="number" class="validate" name="frais_dossier" value="{{ $offre[0]['frais_dossier'] }}">
                    <label class="active" for="frais_dossier">Frais de Dossier (F CFA)</label>
                </div>

                <div class="input-field col s6">
                    <input id="frais_gestion" type="number" class="validate" name="frais_gestion" value="{{ $offre[0]['frais_gestion'] }}">
                    <label class="active" for="frais_gestion">Frais de Gestion (F CFA)</label>
                </div>

                <div class="input-field col s6">
                    <select class="select" name="assurance" required>
                      @if($offre[0]['garantie'] == 1)
                            <option value="1" selected>Offre avec Garantie</option>
                            <option value="0">Offre sans Garantie</option>
                      @else
                            <option value="1">Offre avec Garantie</option>
                            <option value="0" selected>Offre sans Garantie</option>
                      @endif
                    </select>
                </div>

                <div class="input-field col s6">
                  <select class="select" name="assurance" required>
                      @if($offre[0]['assurance'] == 1)
                            <option value="1" selected>Offre avec Assurance</option>
                            <option value="0">Offre sans Assurance</option>
                      @else
                            <option value="1">Offre avec Assurance</option>
                            <option value="0" selected>Offre sans Assurance</option>
                      @endif

                  </select>
                </div>

            </div>

            <div class="row">
                <div class="input-field col s12">
                  <div class="row" id="load"></div>
                    {{-- <button id="formAddUserbtn" type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Enregistrer</button> --}}
                    <div class="col s12 display-flex justify-content-end mt-1">
                      <button id="formEditOffrebtn" type="button" class="btn indigo">
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
    
    <script src="{{ asset('assets/js/crud/services/offres/message.js') }}"></script>

@endsection