@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('main_content')
@section('page-title')
{{ $_SESSION['nom_entite'] }}
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/listeferme">Fermes</a>
    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Details
    @endsection
    @include('gestion.ferme.production.create')
    @include('gestion.ferme.activite.create')  
    @include('gestion.ferme.stock.create')

   {{-- @php
       dd($_SESSION['id_entite'])
   @endphp --}}
    <section class="users-list-wrapper section">
        <div id="chart-dashboard" style="margin-top: 50px">
            <div class="row">
                <div class="col s12">

                    <div class="card animate fadeUp">
                        <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                            @isset($nom)
                              
                                    <span class="chart-title task-cat" >Stats {{ $nom[0]->nom_entite }}</span>
                             
                            @endisset
                            <table id="" class="table">
                                <thead>
                                    <tr>
                                        <th>Users actifs</th>
                                        <th>Produit</th>
                                        <th>Vente(FCFA)</th>
                                        <th>Decaissement(FCFA)</th>
                                        <th>Besoins valides</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($stats)
                                        @foreach ($stats as $entities)
                                            <tr>
                                                <td>
                                                    <span class="task-cat cyan "> {{ $entities->nb_users }}</span>
                                                </td>
                                                <td>
                                                    <span class="task-cat teal accent-4">
                                                        {{ $entities->nb_produits }}</span>
                                                </td>
                                                <td>
                                                    <span class="task-cat red accent-4 ">
                                                        {{ $entities->ferme_somme_ventes }} </span>

                                                </td>
                                                <td>
                                                    <span class="task-cat deep-orange accent-2">
                                                        {{ $entities->ferme_somme_decaissements }} </span>

                                                </td>

                                                <td>
                                                    <span class="task-cat cyan"> {{ $entities->nbre_eb_validees }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>


                        </div>
                    </div>


                    <div class="card animate fadeUp">
                        <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                            <span class="chart-title  ">Productions</span>
                            <ul class="tabs">
                                <li class="tab col m4"><a href="#activites" class="active">Activites</a></li>
                                <li class="tab col m4"><a href="#produits">Produits</a></li>
                                <li class="tab col m4"><a href="#stocks">Stocks</a></li>
                            </ul>
                            <div id="activites">
                                <div class="responsive-table">
                                    <table id="" class="table data-table">
                                        <thead>
                                            <tr>
                                                <th>Intitulé</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            @isset($activite)
                                                @foreach ($activite as $entities)
                                                    <tr>
                                                        <td>{{ $entities->libelle }} </td>

                                                        <td>
                                                            <a href='{{ url("/listeferme/activite/edit/$entities->id") }}'
                                                                class="px-1"><i
                                                                    class="material-icons orange-text ">edit</i></a>
                                                            <a id="{{ $entities->id }}" href="#"
                                                                class="px-1 supprimer_activite">
                                                                <i class="material-icons red-text ">delete</i>
                                                            </a>

                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endisset

                                        </tbody>
                                    </table>
                                    @isset($activite)
                                        {{-- @php
                                            $id_entite = $activite[0]->id_entite;
                                        @endphp --}}

                                        <div class=" display-flex align-items-center show-btn left">

                                            <a type="button"
                                            class="create-activite modal-trigger btn green waves-effect waves-light btn-sm "
                                            href="#create-activite">
                                            <i class="material-icons">add_circle
                                            </i>Activité
            
                                        </a>

                                        </div>
                                    @endisset

                                </div>

                            </div>

                            <div id="produits">
                                <div class="responsive-table">
                                    <table id="" class="table data-table">
                                        <thead>
                                            <tr>

                                                <th>Produit</th>
                                                <th>Type activité</th>
                                                <th>Action</th>


                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            @isset($prod)
                                                @foreach ($prod as $entities)
                                                    <tr>
                                                        <td>{{ $entities->produit }}</td>
                                                        <td>{{ $entities->libelle }} </td>
                                                        <td>
                                                            <a href='{{ url("/listeferme/produit/edit/$entities->id_produit") }}'
                                                                class="px-1"><i
                                                                    class="material-icons orange-text ">edit</i>
                                                            </a>
                                                            <a id="{{ $entities->id_produit }}" href="#"
                                                                class="px-1 supprimer_produit">
                                                                <i class="material-icons red-text ">delete</i>
                                                            </a>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                    <div class=" display-flex align-items-center show-btn  ">
                                        <a  type="button"
                                            class="modal-trigger btn green waves-effect waves-light btn-sm " href="#create-produit">
                                            <i class="material-icons">add_circle
                                            </i>Produit
            
                                        </a>
            
                                    </div>
                                </div>
                            </div>
                            <div id="stocks">
                                <div class="responsive-table">
                                    <table id="" class="table data-table">
                                        <thead>
                                            <tr>
                                                <th>Produit</th>
                                                <th>Quantite</th>
                                                <th>Unite</th>
                                                <th>Prix en gros (FCFA)</th>
                                                <th>Prix detaillant (FCFA)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            @isset($stock)
                                                @foreach ($stock as $entities)
                                                    <tr>
                                                        <td>{{ $entities->produit }} </td>
                                                        <td>{{ $entities->quantite }}</td>
                                                        <td>{{ $entities->unite }}</td>
                                                        <td>{{ $entities->prix_en_gros }}</td>
                                                        <td>{{ $entities->prix_detaillant }}</td>
                                                        <td>
                                                            <a class="px-1 " id="{{ $entities->id }}"
                                                                href='{{ url("/listeferme/stock/edit/$entities->id") }}'>
                                                                <i class="material-icons  orange-text ">edit</i>
                                                            </a>
                                                            <a href="#" class=" px-1 suprrimer_stock"
                                                                id="{{ $entities->id }}">
                                                                <i class="material-icons red-text ">delete</i>
                                                            </a>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                    <div class=" display-flex align-items-center show-btn  ">
                                        <a  type="button"
                                            class=" modal-trigger btn green waves-effect waves-light btn-sm "
                                            href="#create-stock">
                                            <i class="material-icons">add_circle
                                            </i>Stock
            
                                        </a>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="card animate fadeUp">
                        <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                            <span class="chart-title   "> Expressions de besoins</span>
                            <div class="row right mr-5 mt-2">
                            </div>
                            <div class="responsive-table">
                                <table id="users-list-datatable" class="table data-table">
                                    <thead>
                                        <tr>
                                            <th>Produit</th>
                                            <th>Besoin</th>
                                            <th>Justificatif</th>
                                            <th>Date</th>
                                            <th>Commentaire Manager</th>
                                            <th>Commentaire President</th>
                                            <th>Statut Manager</th>
                                            <th>Statut President</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        @isset($eb)
                                            @foreach ($eb as $entities)
                                                <tr>
                                                    <td>{{ $entities->produit }}</td>
                                                    <td>{{ $entities->description }}</td>
                                                    <td class=" ">

                                                        @if (strcmp($entities->justificatif, '') == 0)
                                                            -
                                                        @else
                                                            <a href="{{ asset('storage/' . $entities->justificatif) }}"
                                                                target="_blank">
                                                                <i class="material-icons green-text ">file_download</i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>{{ date('d/m/Y', strtotime($entities->created_at)) }}</td>
                                                    <td>
                                                        @if (strcmp($entities->commentaire_p, '') == 0)
                                                            -
                                                        @else
                                                            {{ $entities->commentaire_p }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (strcmp($entities->commentaire_m, '') == 0)
                                                            -
                                                        @else
                                                            {{ $entities->commentaire_m }}
                                                        @endif
                                                    </td>

                                                    @if ($entities->actif_p == 2)
                                                        <td><a id="{{ $entities->id }}" href='#'
                                                                class=''><span class=''><span
                                                                        class='green-text'>Validé</span></span></a>
                                                        </td>
                                                    @else
                                                        @if ($entities->actif_p == 1)
                                                            <td><a id="{{ $entities->id }}" href='#'
                                                                    class=''><span class=''><span
                                                                            class='yellow-text'>En
                                                                            cours...</span></span></a></td>
                                                        @else
                                                            <td><a id="{{ $entities->id }}" href='#'
                                                                    class=''><span class=''><span
                                                                            class='red-text'>Rejeté</span></span></a>
                                                            </td>
                                                        @endif
                                                    @endif
                                                    @if ($entities->actif_m == 2)
                                                        <td><a id="{{ $entities->id }}" href='#'
                                                                class=''><span class=''><span
                                                                        class='green-text'>Validé</span></span></a>
                                                        </td>
                                                    @else
                                                        @if ($entities->actif_m == 1)
                                                            <td><a id="{{ $entities->id }}" href='#'
                                                                    class=''><span class=''><span
                                                                            class='yellow-text'>En
                                                                            cours...</span></span></a></td>
                                                        @else
                                                            <td><a id="{{ $entities->id }}" href='#'
                                                                    class=''><span class=''><span
                                                                            class='red-text'>Rejeté</span></span></a>
                                                            </td>
                                                        @endif
                                                    @endif

                                                    <td>
                                                        <input type="text" hidden id="root"
                                                            value="{{ route('ferme.eb') }}">
                                                        @if ($entities->actif_m != 2 && $entities->actif_p != 2)
                                                            <a href='{{ url("/ferme/eb/edit/$entities->id") }}'
                                                                class="px-1"><i
                                                                    class="material-icons orange-text ">edit</i>
                                                            </a>
                                                            <a id="{{ $entities->id }}" href="#"
                                                                class="px-1 supprimer_eb">
                                                                <i class="material-icons red-text ">delete</i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="card animate fadeUp">
                        <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                            <span class="chart-title  ">Finances</span>
                            <ul class="tabs">
                                <li class="tab col m6"><a href="#vente" class="active">Ventes</a></li>
                                <li class="tab col m6"><a href="#decaissement">Decaissements</a></li>
                            </ul>

                            <div id="vente">
                                <div class="responsive-table ">
                                    <table  class="table col s12 data-table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Produit</th>
                                                <th>Quantite</th>
                                                <th>Unite</th>
                                                <th>Prix de vente</th>
                                                <th>Total(FCFA)</th>
                                                <th>Justificatif</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            @isset($vente)
                                                @foreach ($vente as $entities)
                                                    <tr>
                                                        <td> {{ $entities->produit }} </td>
                                                        <td>{{ $entities->quantite }}</td>
                                                        <td>{{ $entities->unite }}</td>
                                                        <td>{{ $entities->prix_vente }}</td>
                                                        <td>
                                                            {{ $entities->prix_vente * $entities->quantite }}
                                                        </td>
                                                        <td>
                                                            @if (strcmp($entities->justificatif, '') == 0)
                                                                -
                                                            @else
                                                                <a href="{{ asset('storage/' . $entities->justificatif) }}"
                                                                    target="_blank">
                                                                    <i class="material-icons green-text ">file_download</i>
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>

                                                            <a id="{{ $entities->id }}"
                                                                href='{{ url("/listeferme/finance/vente/view/$entities->id") }}'>
                                                                <i class="material-icons">visibility
                                                                </i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div id="decaissement">
                                <div class="responsive-table ">
                                    <table  class="table col s12 data-table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Produit</th>
                                                <th>Montant(CFA)</th>
                                                <th>Payement</th>
                                                <th>Justificatif</th>
                                                <th>Date</th>

                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            @isset($decaissement)
                                                @foreach ($decaissement as $entities)
                                                    <tr>
                                                        <td> {{ $entities->produit }} </td>
                                                        <td>{{ $entities->montant }}</td>
                                                        <td>{{ $entities->paiement }}</td>
                                                        <td class="">
                                                            @if (strcmp($entities->fichier, '') == 0)
                                                                -
                                                            @else
                                                                <a href="{{ asset('storage/' . $entities->fichier) }}"
                                                                    target="_blank">
                                                                    <i class="material-icons green-text ">file_download</i>
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>{{ date('d/m/Y', strtotime($entities->date_creation)) }}</td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>




@endsection



@section('other-js-script')
    {{-- <script src="{{ asset('assets\js\providers\produits.js') }}"></script> --}}
    <script src="{{ asset('assets\js\providers\ferme_activite.js') }}"></script>
    <script src="{{ asset('assets\js\providers\ferme_all_produit.js') }}"></script>

    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
@endsection
