@extends('layouts.master')
@section('other-css-files')

<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-modern-menu-template/materialize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-modern-menu-template/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/form-select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/page-users.css')}}">

@endsection
@section('main_content')
@section('page-title')
    Expressions de Besoin
@endsection
@section('ariane')
<li class="breadcrumb-item">
  <a href="{{url('/dashboard')}}">Accueil</a>
</li>
<li class="breadcrumb-item">
   <a href="{{url('/expression-de-besoin')}}">Expressions de Besoin</a>
</li>

<li class="breadcrumb-item">
    <a class="yellow-text">Nouvelle Expression de BesoinP</a>
</li>
@endsection


  <div class="row">
    <form  id="formAddEB" action="/expression-de-besoin/store" method="POST">
      @csrf
    <div class="col s12">
      <div class="card">
        <div class="card-content pb-0">
          <div class="card-header mb-2">
            <h4 class="card-title">Nouvelle Expression de Besoin {{ $type_eb_infos['type_eb'] }}</h4>
          </div>
          <div class="card-body">
            
            
            
            @if (in_array($type_eb,[1]))
                                                
                <div class="row">
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="cat_produit" name="cat_produit">
                            <option value="" disabled selected>Catégorie Produit</option>
                        </select>
                        <label class="active" for="cat_produit">Catégorie Produit</label>
                    </div>
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="produit" name="produit">
                            <option value="" disabled selected>--Produit--</option>
                        </select>
                        <label class="active" for="produit">Produit</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="variete" name="variete">
                            <option value="" disabled selected>--Variété--</option>
                        </select>
                        <label class="active" for="variete">Variété</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="description" type="text" class="validate" name="description" required>                
                        <label class="active" for="qte">Description</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input id="qte" type="number" class="validate" name="qte" required>                
                        <label class="active" for="qte">Quantité</label>
                    </div>
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="unite" name="unite" required>
                            <option value="" disabled selected>Unité</option>
                            @foreach ($unites as $item)
                                <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            @elseif (in_array($type_eb,[3]))
                
                <div class="row">
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="" name="produit">
                            <option value="" disabled selected>--Intrant--</option>
                        </select>
                        <label class="active" for="produit">Intrant</label>
                    </div>
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="" name="variete">
                            <option value="" disabled selected>--Variété Intrant--</option>
                        </select>
                        <label class="active" for="variete">Variété Intrant</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input id="description" type="text" class="validate" name="description" required>                
                        <label class="active" for="qte">Description</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="qte" type="number" class="validate" name="qte" required>                
                        <label class="active" for="qte">Quantité</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="unite" name="unite" required>
                            <option value="" disabled selected>Unité</option>
                            @foreach ($unites as $item)
                                <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            


            @elseif (in_array($type_eb,[4]))
                
                <div class="row">
                    <div class="input-field col s6">
                        <input id="description" type="text" class="validate" name="description" required>                
                        <label class="active" for="qte">Description</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="qte" type="number" class="validate" name="qte" required>                
                        <label class="active" for="qte">Montant</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="unite" name="unite" required>
                            <option value="" disabled selected>Unité</option>
                            @foreach ($unites as $item)
                                <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>



                @elseif (in_array($type_eb,[5]))
                
                <div class="row">
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="" name="produit">
                            <option value="" disabled selected>--Engrais--</option>
                        </select>
                        <label class="active" for="produit">Engrais</label>
                    </div>
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="" name="variete">
                            <option value="" disabled selected>--Variété Engrais--</option>
                        </select>
                        <label class="active" for="variete">Variété Engrais</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input id="description" type="text" class="validate" name="description" required>                
                        <label class="active" for="qte">Description</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="qte" type="number" class="validate" name="qte" required>                
                        <label class="active" for="qte">Quantité</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="unite" name="unite" required>
                            <option value="" disabled selected>Unité</option>
                            @foreach ($unites as $item)
                                <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                @elseif (in_array($type_eb,[6]))
                
                <div class="row">
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="" name="produit">
                            <option value="" disabled selected>--Semence--</option>
                        </select>
                        <label class="active" for="produit">Semence</label>
                    </div>
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="" name="variete">
                            <option value="" disabled selected>--Variété Semence--</option>
                        </select>
                        <label class="active" for="variete">Variété Semence</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input id="description" type="text" class="validate" name="description" required>                
                        <label class="active" for="qte">Description</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="qte" type="number" class="validate" name="qte" required>                
                        <label class="active" for="qte">Quantité</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="unite" name="unite" required>
                            <option value="" disabled selected>Unité</option>
                            @foreach ($unites as $item)
                                <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>



                @elseif (in_array($type_eb,[7]))
                
                <div class="row">
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="" name="produit">
                            <option value="" disabled selected>--Produit Phytosanitaire--</option>
                        </select>
                        <label class="active" for="produit">Produit Phytosanitaire</label>
                    </div>
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="" name="variete">
                            <option value="" disabled selected>--Variété--</option>
                        </select>
                        <label class="active" for="variete">Variété Produit Phytosanitaire</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input id="description" type="text" class="validate" name="description" required>                
                        <label class="active" for="qte">Description</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="qte" type="number" class="validate" name="qte" required>                
                        <label class="active" for="qte">Quantité</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="unite" name="unite" required>
                            <option value="" disabled selected>Unité</option>
                            @foreach ($unites as $item)
                                <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                @elseif (in_array($type_eb,[8]))
                
                <div class="row">
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="" name="produit">
                            <option value="" disabled selected>--Amendement Organique--</option>
                        </select>
                        <label class="active" for="produit">Amendement Organique</label>
                    </div>
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="" name="variete">
                            <option value="" disabled selected>--Variété--</option>
                        </select>
                        <label class="active" for="variete">Variété Amendement Organique</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input id="description" type="text" class="validate" name="description" required>                
                        <label class="active" for="qte">Description</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="qte" type="number" class="validate" name="qte" required>                
                        <label class="active" for="qte">Quantité</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="unite" name="unite" required>
                            <option value="" disabled selected>Unité</option>
                            @foreach ($unites as $item)
                                <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>



                @elseif (in_array($type_eb,[9]))
                
                <div class="row">
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="" name="produit">
                            <option value="" disabled selected>--Biostimulant--</option>
                        </select>
                        <label class="active" for="produit">Biostimulant</label>
                    </div>
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="" name="variete">
                            <option value="" disabled selected>--Variété Biostimulant--</option>
                        </select>
                        <label class="active" for="variete">Variété Biostimulant</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input id="description" type="text" class="validate" name="description" required>                
                        <label class="active" for="qte">Description</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="qte" type="number" class="validate" name="qte" required>                
                        <label class="active" for="qte">Quantité</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="unite" name="unite" required>
                            <option value="" disabled selected>Unité</option>
                            @foreach ($unites as $item)
                                <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                @elseif (in_array($type_eb,[10]))
                
                <div class="row">
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="" name="produit">
                            <option value="" disabled selected>--Correcteur de carrence--</option>
                        </select>
                        <label class="active" for="produit">Correcteur de carrence</label>
                    </div>
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="" name="variete">
                            <option value="" disabled selected>--Variété--</option>
                        </select>
                        <label class="active" for="variete">Variété</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input id="description" type="text" class="validate" name="description" required>                
                        <label class="active" for="qte">Description</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="qte" type="number" class="validate" name="qte" required>                
                        <label class="active" for="qte">Quantité</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="unite" name="unite" required>
                            <option value="" disabled selected>Unité</option>
                            @foreach ($unites as $item)
                                <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @elseif (in_array($type_eb,[12]))
                
                <div class="row">
                    
                    <div class="input-field col s6">
                        <div class="btn">
                            <a href="#modal1" class = "modal-trigger">Adresse de Provenance</a>
                            <input type="text" id="localite_from" name="localite_from" hidden>
                        </div>

                    </div>

                    <div class="input-field col s6">
                        <div class="btn">
                            <a href="#modal1" class = "modal-trigger">Adresse de Destination</a>
                            <input type="text" id="localite_from" name="localite_from" hidden>
                        </div>
                    </div>
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="cat_produit" name="cat_produit">
                            <option value="" disabled selected>--Catégorie Produit--</option>
                        </select>
                        <label class="active" for="cat_produit">Catégorie Produit</label>
                    </div>
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="produit" name="produit">
                            <option value="" disabled selected>--Produit--</option>
                        </select>
                        <label class="active" for="produit">Produit</label>
                    </div>
                    
                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="variete" name="variete">
                            <option value="" disabled selected>--Variété--</option>
                        </select>
                        <label class="active" for="variete">Variété</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="description" type="text" class="validate" name="description" required>                
                        <label class="active" for="qte">Description</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="qte" type="number" class="validate" name="qte" required>                
                        <label class="active" for="qte">Quantité</label>
                    </div>

                    <div class="input-field col s6">
                        <select class="select2 browser-default" id="unite" name="unite" required>
                            <option value="" disabled selected>Unité</option>
                            @foreach ($unites as $item)
                                <option value="{{ $item['id'] }}">{{ $item['unite'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    

                </div>

            @endif
                
                    
                    <div class="input-field col s12">
                        <div class="col s12 display-flex justify-content-end mt-1">
                            <button id="formAddEBbtn" type="button" class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">
                                Enregistrer</button>
                            
                            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>

                        </div>
                    </div>
        </div>
        </div>
      
        </div>
    </div>
    </form>
  </div>


  <div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Adresse de Provenance</h4>
        <div class="divider mt-2"></div>

        <form  id="formAddEB" action="/expression-de-besoin/create" method="POST">
            @csrf
          <div class="col s12">
            <div class="card">
              <div class="card-content pb-0">
                <div class="card-header mb-2">
                </div>
                <div class="card-body">
                  
                  <div class="row">
                  
                    <div class="input-field col s6">
                        <select class="select2insidemodal1 browser-default" id="pays" name="pays">
                            <option value="" disabled selected>Pays</option>
                        </select>
                        <label class="active" for="pays">Pays</label>
                    </div>

                    <div class="input-field col s6">
                        <select class="select2insidemodal1 browser-default" id="region" name="region">
                            <option value="" selected>Région</option>
                        </select>
                        <label class="active" for="region">Région</label>
                    </div>

                    <div class="input-field col s6">
                        <select class="select2insidemodal1 browser-default" id="dept" name="dept">
                            <option value="" selected>Département</option>
                        </select>
                        <label class="active" for="dept">Département</label>
                    </div>

                    <div class="input-field col s6">
                        <select class="select2insidemodal1 browser-default" id="commune" name="commune">
                            <option value=""  selected>Commune</option>
                        </select>
                        <label class="active" for="commune">Commune</label>
                    </div>

                    <div class="input-field col s6">
                        <select class="select2insidemodal1 browser-default" id="localite" name="localite">
                            <option value="" selected>Localité</option>
                        </select>             
                        <label class="active" for="localite">Localité</label>
                      
                  </div>
      
      
                  <div class="row">


                      <div class="input-field col s12">
                        <div class="col s12 display-flex justify-content-end mt-1">
                            <button id="formAddEBbtn" type="submit" class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">
                                Enregistrer</button>
                            
                            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>

                        </div>
                      </div>

                  </div>   

                    </div>
                </div>
            
              </div>
          </div>
          </form>
    </div>
    <div class="modal-footer">
    </div>
</div>

@endsection

@section('other-js-script')

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

    <script src="{{ asset('assets\js\providers\produits.js') }}"></script>

    <script src="{{ asset('assets/js/crud/gestion/groupements/localite.js') }}"></script>

    <script src="{{ asset('assets/js/crud/gestion/eb/message.js') }}"></script>
    
@endsection