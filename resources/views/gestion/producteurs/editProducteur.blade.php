@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/producteurs-table.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-wizard.css') }}">
@endsection
@section('page-title')
    Producteurs
@endsection
@php
    // dd($meteombay . ' ' . $prix);
    // dd($meteombay);
    // dd($producteur);
    // dd($pluvios);
@endphp
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item active ">
        <a href="/producteurs">Producteurs</a>
    </li>

    <li class="breadcrumb-item active yellow-text">Modification Producteur
    </li>
@endsection
@section('main_content')
    <section class="users-list-wrapper section">
        <div class="users-list-filter">
            @include('services.informations_climatiques.campagne-meteo.campagne-actif')
        </div>
        <div class="users-list-table">
            <div class="card">
                <div class="card-content">
                    @if (empty($producteur))
                        Information non disponible sur notre base de donnees
                    @else
                        <div class="row">
                            <div class="col s12">
                                <ul class="tabs">
                                    <li class="tab col m4"><a href="#user" class="active"><i
                                                class="material-icons mr-1">person_outline</i> <span> Producteur </span></a>
                                    </li>
                                    <li class="tab col m4"><a href="#meteombay"> <i
                                                class="material-icons mr-1">wb_cloudy</i> <span> Météo Mbay </span></a></li>
                                    <li class="tab col m4"><a href="#prixmarche"><i
                                                class="material-icons mr-1">trending_down</i>
                                            <span> Prix du Marché</span></a></li>
                                </ul>
                            </div>
                            <br>
                            <div class="row pr-3 pl-3">
                                <form id="form-producteurs-update" method="POST" action="#">
                                    @csrf
                                    <div id="user" class="col s12 ">
                                        <div class="row pt-2">
                                            <input id="utilisateur" type="hidden" name="utilisateur"
                                                value="{{ $producteur->utilisateur }}">
                                            {{-- <input id="localite" type="hidden" name="localite"
                                                value="{{ $producteur->id_localite }}"> --}}
                                            <input id="entite" type="hidden" name="entite"
                                                value="{{ $producteur->id_entite }}">
                                            <input type="hidden" name="prod_prix" value="{{ $prix }}">
                                            <input type="hidden" name="prod_meteo" value="{{ $meteombay }}">

                                            <input id="role" type="hidden" name="role" value="null">
                                            <div class="input-field col s6">
                                                <input id="prenom" type="text" class="validate" name="prenom"
                                                    value="{{ $producteur->prenom }}">
                                                <label class="active" for="prenom">Prénom</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input id="nom" type="text" class="validate" name="nom"
                                                    value="{{ $producteur->nom }}">
                                                <label class="active" for="nom">Nom</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <div class="row">
                                                    <label>
                                                        <p>
                                                            <input value="M" name="sexe" type="radio" required
                                                                @if ($producteur->sexe == 'M') checked @endif />
                                                            <span>Homme</span>
                                                        </p>
                                                    </label>
                                                </div>
                                                <div class="row">
                                                    <label>
                                                        <p>
                                                            <input value="F" name="sexe" type="radio" required
                                                                @if ($producteur->sexe == 'F') checked @endif />
                                                            <span>Femme</span>
                                                        </p>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="input-field col s6">
                                                {{-- <div class="row">
                                                        <label>
                                                            <p>
                                                                <input value="1" name="sit_matrimonial_id" type="radio"
                                                                    required />
                                                                <span>Marié</span>
                                                            </p>
                                                        </label>
                                                    </div>
                                                    <div class="row">
                                                        <label>
                                                            <p>
                                                                <input value="2" name="sit_matrimonial_id" type="radio"
                                                                    required />
                                                                <span>Célibataire</span>
                                                            </p>
                                                        </label>
                                                    </div> --}}
                                                <input id="dt_naiss" type="text" class="datepicker" name="dt_naiss"
                                                    @if ($producteur->dt_naiss) value="{{ $producteur->dt_naiss }}"
                                           @else   
                                           value="" @endif>
                                                <label class="active" for="dt_naiss">Date de naissance</label>
                                                {{-- </div> --}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input id="telephone" type="number" class="validate" name="telephone"
                                                    value="{{ $producteur->telephone }}">
                                                <label class="active" for="telephone">Téléphone</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input id="email" type="email" class="validate" name="email"
                                                    value="{{ $producteur->email }}">
                                                <label class="active" for="email">Email</label>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <select class="browser-default pays" id="pays" name="pays">
                                                    <option value="null" disabled selected>Pays</option>
                                                </select>
                                                <label class="active" for="pays">Pays</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <select class="select2 lp browser-default region" id="region"
                                                    name="region">
                                                    <option value="{{ $producteur->id_region }}" selected>
                                                        {{ $producteur->region }}</option>
                                                </select>
                                                <label class="active" for="region">Région</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <select class="select2 lp browser-default dept" id="dept"
                                                    name="dept">
                                                    <option value="{{ $producteur->id_departement }}" selected>
                                                        {{ $producteur->departement }}</option>

                                                </select>
                                                <label class="active" for="dept">département</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <select class="select2 lp browser-default commune" id="commune"
                                                    name="commune">
                                                    <option value="{{ $producteur->id_commune }}" selected>
                                                        {{ $producteur->commune }}</option>
                                                </select>
                                                <label class="active" for="commune">Commune</label>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <select class="select2 lp browser-default localite" id="localite"
                                                    name="localite">
                                                    <option value='null' selected>
                                                        {{ $producteur->localite }}</option>
                                                </select>
                                                <label class="active" for="localite">Localité</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <select class="select2 lp browser-default" id=""
                                                    name="groupement">
                                                    <option value="" disabled selected>Choisissez le reseau</option>
                                                    @foreach ($reseaux as $reseau)
                                                        <option value="{{ $reseau->id_groupement }}"
                                                            @if ($reseau->id_groupement == $producteur->id_groupement) selected @endif>
                                                            {{ $reseau->libelle }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <label class="active" for="users-list-status">Reseau</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <select class="select2 browser-default" name="produit" required>
                                                    <option value="">Choisissez un produit</option>
                                                    @foreach ($produits as $produit)
                                                        @if ($producteur->id_produit == $produit->id)
                                                            <option value="{{ $produit->produit }}" selected>
                                                                {{ $produit->produit }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $produit->produit }}">
                                                                {{ $produit->produit }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <label class="active" for="users-list-status">Spéculation de base</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="meteombay" class="col s12">
                                        <div class="row pt-2">
                                            <div class="input-field col s6">
                                                <select class="browser-default" id="" name="status">
                                                    <option value="0"
                                                        @if ($producteur->actif == '0') selected @endif>Inactif
                                                    </option>
                                                    <option value="1"
                                                        @if ($producteur->actif == '1') selected @endif>Actif
                                                    </option>
                                                </select>
                                                <label class="active" for="pays">Status</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <select class=" browser-default" id="" name="type_reception">
                                                    <option value="" disabled selected>Choisissez le canal</option>
                                                    @if (isset($producteur->type_reception))
                                                        @if ($producteur->type_reception == 1)
                                                            <option value="SMS" selected>SMS</option>
                                                            <option value="VOICE">VOICE</option>
                                                        @endif
                                                        @if ($producteur->type_reception == 2)
                                                            <option value="SMS">SMS</option>
                                                            <option value="VOICE" selected>VOICE</option>
                                                        @endif
                                                    @else
                                                        <option value="SMS">SMS</option>
                                                        <option value="VOICE">VOICE</option>
                                                    @endif
                                                </select>
                                                <label class="active" for="users-list-status">Canal de réception</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            @if ($meteombay != 'null')
                                                <div class="input-field col s6 ">
                                                    <select class="select2 lp browser-default" id=""
                                                        name="pluvio">
                                                        <option value="" disabled selected>Choisissez le pluvio
                                                        </option>
                                                        @foreach ($pluvios as $pluvio)
                                                            <option value="{{ $pluvio->id }}"
                                                                @if ($pluvio->localite == $producteur->pluvio) selected @endif>
                                                                {{ $pluvio->localite }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label class="active" for="users-list-status">Pluvio</label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <select class=" browser-default" id="" name="langue">
                                                        @if (!$producteur->langue_reception)
                                                            <option value="">Choisissez la langue de reception
                                                            </option>
                                                        @endif
                                                        @foreach ($langues as $langue)
                                                            <option value="{{ $langue->id }}"
                                                                @if ($langue->id == $producteur->langue_reception) selected @endif>
                                                                {{ $langue->langue }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label class="active" for="users-list-status">Langue</label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div id="prixmarche" class="col s12">
                                        <div class="row pt-2">
                                            @if ($prix != 'null')
                                                <div class="input-field col s12">
                                                    <select class="select2 browser-default" name="regionprix" required>
                                                        {{-- <option value="">Choisissez une region </option> --}}
                                                        @foreach ($region as $item)
                                                            @if ($producteur->id_region_prix == $item->id)
                                                                <option value="{{ $item->id }}" selected>
                                                                    {{ $item->region }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $item->id }}">{{ $item->region }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <label class="active" for="users-list-status">Region Prix du
                                                        Marche</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <select class="select2 browser-default" name="produitprix" required>
                                                        <option value="">Choisissez un produit</option>
                                                        @foreach ($produits as $produit)
                                                            @if ($producteur->id_produit_prix == $produit->id)
                                                                <option value="{{ $produit->id }}" selected>
                                                                    {{ $produit->produit }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $produit->id }}">
                                                                    {{ $produit->produit }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <label class="active" for="users-list-status">Produit Prix du
                                                        Marche</label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <div class="row" id="load"></div>
                                            <div class="col s12 display-flex justify-content-end mt-1">
                                                <button id="btn-update-producteur" type="submit" class="btn indigo">
                                                    Mettre à Jour
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>




    </section>
@endsection

@section('other-js-script')
    <script>
        let today = new Date();
        let day = today.getDate();
        let months = today.getMonth();
        let year = today.getFullYear();
        let yearFixed = year - 15;
        $("#dt_naiss").datepicker({
            maxDate: new Date(yearFixed, months, day),
            changeYear: true,
        });
        $("#dt_naiss").datepicker("setDate", new Date(yearFixed - 10, months, day));
    </script>
@endsection

{{-- <form id="form-producteurs-update" method="POST" action="#">
                            @csrf
                            <div class="row">
                                <input id="utilisateur" type="hidden" name="utilisateur"
                                    value="{{ $producteur->utilisateur }}">
                                <input id="localite" type="hidden" name="localite" value="{{ $producteur->id_localite }}">
                                <input id="entite" type="hidden" name="entite" value="{{ $producteur->id_entite }}">
                                <input type="hidden" name="prod_prix" value="{{ $prix }}">
                                <input type="hidden" name="prod_meteo" value="{{ $meteombay }}">

                                <input id="role" type="hidden" name="role" value="null">
                                <div class="input-field col s6">
                                    <input id="prenom" type="text" class="validate" name="prenom"
                                        value="{{ $producteur->prenom }}">
                                    <label class="active" for="prenom">Prénom</label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="nom" type="text" class="validate" name="nom"
                                        value="{{ $producteur->nom }}">
                                    <label class="active" for="nom">Nom</label>
                                </div>
                            </div>
                            <div class="row">
                        <input id="dt_naiss" type="text" class="datepicker" name="dt_naiss"
                            @if ($producteur->dt_naiss) value="{{ $producteur->dt_naiss }}"
                                   @else   
                                   value="" @endif>
                        <label class="active" for="dt_naiss">Date de naissance</label>
                        
                </div>
            </div>
            <div class="row">

                <div class="input-field col s6">
                    <input id="telephone" type="number" class="validate" name="telephone"
                        value="{{ $producteur->telephone }}">
                    <label class="active" for="telephone">Téléphone</label>
                </div>
                <div class="input-field col s6">
                    <input id="email" type="email" class="validate" name="email" value="{{ $producteur->email }}">
                    <label class="active" for="email">Email</label>
                </div>

            </div>
            <div class="row">
                <div class="input-field col s12">
                    <select class="select2 lp browser-default" id="" name="groupement">
                        <option value="" disabled selected>Choisissez le reseau</option>
                        @foreach ($reseaux as $reseau)
                            <option value="{{ $reseau->id_groupement }}" @if ($reseau->id_groupement == $producteur->id_groupement) selected @endif>
                                {{ $reseau->libelle }}
                            </option>
                        @endforeach
                    </select>
                    <label class="active" for="users-list-status">Reseau</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <select class="browser-default" id="" name="status">
                        <option value="0" @if ($producteur->actif == '0') selected @endif>Inactif
                        </option>
                        <option value="1" @if ($producteur->actif == '1') selected @endif>Actif
                        </option>
                    </select>
                    <label class="active" for="pays">Status</label>
                </div>
                <div class="input-field col s6">
                    <select class=" browser-default" id="" name="type_reception">
                        <option value="" disabled selected>Choisissez le canal</option>
                        @if (isset($producteur->type_reception))
                            @if ($producteur->type_reception == 1)
                                <option value="SMS" selected>SMS</option>
                                <option value="VOICE">VOICE</option>
                            @endif
                            @if ($producteur->type_reception == 2)
                                <option value="SMS">SMS</option>
                                <option value="VOICE" selected>VOICE</option>
                            @endif
                        @else
                            <option value="SMS">SMS</option>
                            <option value="VOICE">VOICE</option>
                        @endif
                    </select>
                    <label class="active" for="users-list-status">Canal de réception</label>
                </div>
            </div>
            <div class="row">
                @if ($meteombay != 'null')
                    <div class="input-field col s6 ">
                        <select class="select2 lp browser-default" id="" name="pluvio">
                            <option value="" disabled selected>Choisissez le pluvio</option>
                            @foreach ($pluvios as $pluvio)
                                <option value="{{ $pluvio->id }}" @if ($pluvio->localite == $producteur->pluvio) selected @endif>
                                    {{ $pluvio->localite }}</option>
                            @endforeach
                        </select>
                        <label class="active" for="users-list-status">Pluvio</label>
                    </div>
                    <div class="input-field col s6">
                        <select class=" browser-default" id="" name="langue">
                            @if (!$producteur->langue_reception)
                                <option value="">Choisissez la langue de reception
                                </option>
                            @endif
                            @foreach ($langues as $langue)
                                <option value="{{ $langue->id }}" @if ($langue->id == $producteur->langue_reception) selected @endif>
                                    {{ $langue->langue }}</option>
                            @endforeach
                        </select>
                        <label class="active" for="users-list-status">Langue</label>
                    </div>
                @endif
                @if ($prix != 'null')
                    <div class="input-field col s12">
                        <select class="select2 browser-default" name="region" required>
                            @foreach ($region as $item)
                                @if ($producteur->id_region_prix == $item->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->region }}
                                    </option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->region }}</option>
                                @endif
                            @endforeach
                        </select>
                        <label class="active" for="users-list-status">Region</label>
                    </div>
                    <div class="input-field col s12">
                        <select class="select2 browser-default" name="produit" required>
                            <option value="">Choisissez un produit</option>
                            @foreach ($produits as $produit)
                                @if ($producteur->id_produit_prix == $produit->id)
                                    <option value="{{ $produit->produit }}" selected>
                                        {{ $produit->produit }}
                                    </option>
                                @else
                                    <option value="{{ $produit->produit }}">{{ $produit->produit }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <label class="active" for="users-list-status">Spéculation</label>
                    </div>
                @endif

            </div>

            <div class="row">
                <div class="input-field col s12">
                    <div class="row" id="load"></div>
                    <div class="col s12 display-flex justify-content-end mt-1">
                        <button id="btn-update-producteur" type="submit" class="btn indigo">
                            Mettre à Jour
                        </button>
                          </div>
                </div>
            </div>
            </form> --}}
