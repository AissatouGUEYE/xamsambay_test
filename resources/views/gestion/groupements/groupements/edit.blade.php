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
  <a class="yellow-text">Modification Groupement</a>
</li>
@endsection
  <div class="row">
    <form  id="" action="/groupements/edit" method="POST">
      @csrf
    <div class="col s12">
      <div class="card">
        <div class="card-content pb-0">
          <div class="card-header mb-2">
            <h4 class="card-title">Modification Groupement</h4>
          </div>
          <div class="card-body">
            
            <div class="row">

                <input id="id" name="id" value="{{ $groupement[0]['id_groupement'] }}" hidden>

                <div class="input-field col s6">
                    <input id="libelle" type="text" class="validate" name="libelle" value="{{ $groupement[0]['libelle'] }}" required>                
                    <label class="active" for="libelle">Libellé</label>
                </div>


                <div class="input-field col s6">
                  <input id="description" type="text" class="validate" name="date_creation" value="{{ $groupement[0]['date_creation'] }}" required>                
                  <label class="active" for="description">Date de Création</label>
                </div>



                <div class="input-field col s6">
                    <select class="select2 browser-default" id="pays" name="pays">
                        <option value="{{ $groupement[0]['id_pays'] }}" selected>{{ $groupement[0]['pays'] }}</option>
                    </select>
                    <label class="active" for="pays">Pays</label>
                </div>
                <div class="input-field col s6">
                    <select class="select2 browser-default" id="region" name="region">
                        <option value="{{ $groupement[0]['id_region'] }}" selected>{{ $groupement[0]['region'] }}</option>
                    </select>
                    <label class="active" for="region">Région</label>
                </div>

                <div class="input-field col s6">
                    <select class="select2 browser-default" id="dept" name="dept">
                        <option value="{{ $groupement[0]['id_departement'] }}" selected>{{ $groupement[0]['departement'] }}</option>
                    </select>
                    <label class="active" for="dept">Département</label>
                </div>
                <div class="input-field col s6">
                    <select class="select2 browser-default" id="commune" name="commune">
                        <option value="{{ $groupement[0]['id_commune'] }}"  selected>{{ $groupement[0]['commune'] }}</option>
                    </select>
                    <label class="active" for="commune">Commune</label>
                </div>

                <div class="input-field col s6">
                    <select class="select2 browser-default" id="localite" name="localite">
                        <option value="{{ $groupement[0]['id_localite'] }}" selected>{{ $groupement[0]['localite'] }}</option>
                    </select>             
                    <label class="active" for="localite">Localité</label>
                </div>

                <div class="input-field col s6">
                    <select class="select2 browser-default" id="union_groupement" name="union_groupement">

                        {{-- @if ($groupement[0]['id_union_groupement'] != null)
                            <option value="{{ $groupement[0]['id_union_groupement'] }}" selected>{{ $groupement[0]['nom_union_groupement'] }}</option>
                        @else
                          <option value="" selected>Aucune</option>
                        @endif

                        @foreach ($union_grp as $item)
                            <option value="{{ $item['id_union_groupement'] }}">{{ $item['libelle'] }}</option>
                        @endforeach --}}


                        @if ($groupement[0]['id_union_groupement'] != null)
                              
                            @foreach ($union_grp as $item)

                              @if($item['id_union_groupement'] == $groupement[0]['id_union_groupement'])
                                  <option value="{{ $item['id_union_groupement'] }}" selected>{{ $item['libelle'] }}</option>
                              @else
                                  <option value="{{ $item['id_union_groupement'] }}">{{ $item['libelle'] }}</option>
                              @endif

                            @endforeach

                            <option value="">Aucune</option>

                        @else

                          <option value="" selected>Aucune</option>

                          @foreach ($union_grp as $item)

                            <option value="{{ $item['id_union_groupement'] }}">{{ $item['libelle'] }}</option>

                          @endforeach


                        @endif

                    </select>             
                    <label class="active" for="OP">Union de Groupement</label>
                </div>

  `             <div class="input-field col s6">
                    <input id="description" type="text" class="validate" name="description" value="{{ $groupement[0]['description'] }}">                
                    <label class="active" for="libelle">Description</label>
                </div>

                {{-- <div class="input-field col s6">
                    <input id="ninea" type="text" class="validate" name="ninea" value="{{ $groupement[0]['ninea'] }}" >                
                    <label class="active" for="libelle">Ninéa</label>
                </div> --}}

                {{-- <div class="file-field input-field col s6">
                    <div class="btn">
                      <span>Ninéa</span>
                      <input type="file" name="ninea" accept=".pdf, .doc, .docx" value="{{ asset('storage/'.$groupement[0]['ninea'] ) }}">
                    </div>
                    <div class="file-path-wrapper">
                      <input class="file-path" name="ninea_name" type="text">
                    </div>
                </div> --}}



                @if (in_array($_SESSION['role'],["SUPERADMIN","ADMIN"]))

                    <div class="input-field col s6">
                      <select class="select2 browser-default" name="entite">

                          {{-- @if ($groupement[0]['id_entite'] != null)
                              <option value="{{ $groupement[0]['id_entite'] }}" selected>{{ $groupement[0]['nom_entite'] }}</option>
                          @else
                            <option value="" selected>Aucune</option>
                          @endif

                          @foreach ($ong as $item)
                              <option value="{{ $item['id_entite'] }}">{{ $item['nom_entite'] }}</option>
                          @endforeach --}}



                          @if ($groupement[0]['id_entite'] != null)
                              
                              @foreach ($ong as $item)

                                @if($item['id_entite'] == $groupement[0]['id_entite'])
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
    
    <script src="{{asset('assets\js\providers\location.js')}}"></script>

    <script src="{{ asset('assets/js/crud/gestion/groupements/localite.js') }}"></script>
    
@endsection