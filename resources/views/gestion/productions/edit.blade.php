@extends('layouts.master')
@section('other-css-files')

<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-modern-menu-template/materialize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-modern-menu-template/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/form-select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/page-users.css')}}">

@endsection
@section('main_content')
@section('page-title')
    Productions
@endsection
@section('ariane')
<li class="breadcrumb-item">
  <a href="{{url('/dashboard')}}">Accueil</a>
</li>
<li class="breadcrumb-item">
   <a href="{{url('/productions')}}">Productions</a>
</li>

<li class="breadcrumb-item">
  <a class="yellow-text">Modification Production</a>
</li>
@endsection
  <div class="row">
    <form  id="formEditProduction" action="/productions/edit" method="POST">
      @csrf
    <div class="col s12">
      <div class="card">
        <div class="card-content pb-0">
          <div class="card-header mb-2">
            <h4 class="card-title">Modification Production</h4>
          </div>
          <div class="card-body">

            <div class="row">

                <input id="profil" name="profil" value="{{ $production[0]['id_profil'] }}" hidden>
                <input id="id" name="id" value="{{ $production[0]['id'] }}" hidden>

                <div class="input-field col s6">

                  <select class="select2 browser-default" id="cat_produit" name="cat_produit">

                    <option value="{{ $production[0]['id_cat_produit'] }}" selected>{{ $production[0]['cat_produit'] }}</option>

                      {{-- @foreach ($varietes as $item)

                        @if($item['id'] == $production[0]['id_variete'])
                             <option value="{{ $item['id'] }}" selected>{{ $item['variete'] }}</option>
                        @else
                             <option value="{{ $item['id'] }}">{{ $item['variete'] }}</option>
                        @endif

                      @endforeach --}}

                  </select>

                  <label for="cat_produit" class="active">Catégorie du Produit</label>

              </div>

              <div class="input-field col s6">

                <select class="select2 browser-default" id="produit" name="produit">
                  <option value="{{ $production[0]['id_produit'] }}" selected>{{ $production[0]['produit'] }}</option>


                </select>

                <label for="variete" class="active">Produit</label>

            </div>

                <div class="input-field col s6">

                    <select class="select2 browser-default" id="variete" name="variete">
                      <option value="{{ $production[0]['id_variete'] }}" selected>{{ $production[0]['variete'] }}</option>


                    </select>

                    <label for="variete" class="active">Variété du Produit</label>

                </div>
                <div class="input-field col s6">

                  <select class="select2 browser-default" id="campagne" name="campagne">
                    {{-- <option value="{{ $production[0]['id_campagne'] }}" selected>Du {{ $production[0]['debut'] }} au {{ $production[0]['fin'] }}</option>
                      @foreach ($campagnes as $item)
                          <option value="{{ $item['id'] }}">Du {{ $item['debut'] }} au {{ $item['fin'] }}</option>
                      @endforeach --}}


                      @foreach ($campagnes as $item)

                        @if($item['id'] == $production[0]['id_campagne'])
                              <option value="{{ $item['id'] }}" selected>Du {{ $item['debut'] }} au {{ $item['fin'] }}</option>
                        @else
                              <option value="{{ $item['id'] }}">Du {{ $item['debut'] }} au {{ $item['fin'] }}</option>
                        @endif

                      @endforeach

                  </select>

                  <label for="" class="active">Campagne de production</label>

                </div>

                <div class="input-field col s6">

                    <label for="quantite" class="col-form-label">Quantité produite</label>
                    <input type="number" class="form-control" id="quantite" name="quantite" value="{{ $production[0]['quantite']}}">

                </div>

                <div class="input-field col s6">

                  <select class="select2 browser-default" id="unite" name="unite">
                    {{-- <option value="{{ $production[0]['id_unite'] }}" selected>{{ $production[0]['unite'] }}</option>
                      @foreach ($unites as $item)
                          <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                      @endforeach --}}


                      @foreach ($unites as $item)

                        @if($item['id'] == $production[0]['id_unite_production'])
                              <option value="{{ $item['id'] }}" selected>{{ $item['unite'] }}</option>
                        @else
                              <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                        @endif

                      @endforeach

                  </select>

                  <label for="unite" class="active">Unité</label>

                </div>


                <div class="input-field col s6">

                    <label for="surface_emblavee" class="col-form-label">Surface Emblavée</label>
                    <input type="number" class="form-control" id="surface_emblavee" name="surface_emblavee" value="{{ $production[0]['surface_emblavee']}}">

                </div>

                <div class="input-field col s6">

                  <select class="select2 browser-default" id="unite_surf_embl" name="unite_surf_embl">

                      @foreach ($unites as $item)

                        @if($item['id'] == $production[0]['unite_surf_emb'])
                              <option value="{{ $item['id'] }}" selected>{{ $item['unite'] }}</option>
                        @else
                              <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                        @endif

                      @endforeach

                  </select>

                  <label for="unite" class="active">Unité Surface Emblavée</label>

                </div>



                <div class="input-field col s12">

                  <select class="select2 browser-default" id="sol" name="sol">
                    {{-- <option value="{{ $production[0]['id_sol'] }}" selected>{{ $production[0]['surface'] }} hectares de sol de type {{ $production[0]['type_sol'] }} appartenant à {{ $production[0]['prenom'] }} {{ $production[0]['nom'] }} dans la localité de {{ $production[0]['localite'] }}</option>
                      @foreach ($sols as $item)
                          <option value="{{ $item['id'] }}">{{ $item['surface'] }} {{ $item['unite'] }} de sol de type {{ $item['type_sol'] }} appartenant à {{ $item['prenom'] }} {{ $item['nom'] }} dans la localité de {{ $item['localite'] }}
                          </option>
                      @endforeach --}}


                      @foreach ($sols as $item)

                        @if($item['id'] == $production[0]['id_sol'])
                              <option value="{{ $item['id'] }}" selected>{{ $item['surface'] }} {{ $item['unite'] }} de sol de type {{ $item['type_sol'] }} appartenant à {{ $item['prenom'] }} {{ $item['nom'] }} dans la localité de {{ $item['localite'] }}
                          </option>
                        @else
                              <option value="{{ $item['id'] }}">{{ $item['surface'] }} {{ $item['unite'] }} de sol de type {{ $item['type_sol'] }} appartenant à {{ $item['prenom'] }} {{ $item['nom'] }} dans la localité de {{ $item['localite'] }}
                          </option>
                        @endif

                      @endforeach
                  </select>

                  <label for="sol" class="active">Sol</label>

                </div>

            </div>


            <div class="row">
                <div class="input-field col s12">
                  <div class="row" id="load"></div>
                    {{-- <button id="formAddUserbtn" type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Enregistrer</button> --}}
                    <div class="col s12 display-flex justify-content-end mt-1">
                      <button type="button" id="formEditProductionbtn" class="btn indigo">
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
    <script src="{{asset('assets\js\providers\location.js')}}"></script>
    <script src="{{asset('assets\js\providers\entity.js')}}"></script>

    <script src="{{ asset('assets\js\crud\gestion\productions\message.js') }}"></script>

@endsection
