<script src="{{ asset('assets/vendors/sweetalert/sweetalert.min.js') }}"></script>
<input type="text" id="nb_prod" value="{{ $nombre }}" hidden>
<div class="light-background">
    <div class="layer-stretch">
        <nav aria-label="breadcrumb" style="margin-top:10px ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" style="color: black">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/shop') }}" style="color: black">Le Louma</a></li>
                <li class="breadcrumb-item active" style="color: #a2673b;" aria-current="page">Mon Panier</li>
            </ol>
        </nav>
        <div class="clearfix">
            <a href="/mesCommandes" class="btn bg-vert-louma text-light rounded-pill  float-end">
                <i class="fa fa-clipboard  icon-size"> </i>
                Mes commandes
            </a>
        </div>
        <div class="row  right ml-100 mr-5 mt-2 ">
            <div class="col-3 display-flex align-items-center show-btn right">

            </div>
        </div>

        <div class="layer-wrapper">
            <div class="row pt-4">
                <div class="panel panel-default m-0">
                    <div class="panel-head">
                        <div class="panel-title text-center">
                            <h3>Liste des Produits</h3>
                        </div>
                    </div>


                    <div class="card-content" style="padding: 30px">
                        <div class="responsive-table">
                            <table class="table  data-table ">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Boutique</th>
                                        <th>Prix</th>
                                        <th>Quantite</th>
                                        <th>Unite</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                <tbody>
                                    @isset($data)

                                        @foreach ($data as $item)
                                            <tr>
                                                <input type="text" id="boutique_produit"
                                                    value="{{ $item['id_boutique_produit'] }}" hidden>
                                                @php

                                                    if (!$item['image_produit']) {
                                                        $image = asset('storage/produits/new.jpg');
                                                    } elseif (substr($item['image_produit'], 0, 5) === 'https') {
                                                        $image = $item['image_produit'];
                                                    } else {
                                                        $image = asset('storage/' . $item['image_produit']);
                                                    }
                                                   
                                                @endphp
                                                <td><img style='width:150px ; height:100px' src="{{ $image }}"
                                                        alt=""></td>

                                                <td>{{ $item['boutique'] }}</td>
                                                <td>{{ $item['prix_produit'] }} {{ $item['unite_prix'] }} </td>
                                                <td>

                                                    <i class="fa fa-add mr-2 icon-size plus"
                                                        id="{{ $item['id'] }}_{{ $item['id_boutique_produit'] }}_{{ $item['id_commande'] }}">

                                                        <span id="qtite_{{ $item['id'] }}"
                                                            class=" ml-3 pricing-head-title text-uppercase">{{ $item['quantite'] }}</span>
                                                    </i>
                                                    <i class="fa fa-minus mr-2 icon-size moins"
                                                        id="{{ $item['id'] }}_{{ $item['id_boutique_produit'] }}_{{ $item['id_commande'] }}">
                                                        <span class="ml-3 pricing-head-title text-uppercase"></span></i>

                                                    {{-- <input type="number" name="quantite" id="quantite" value="1"> --}}
                                                </td>
                                                <td> {{ $item['unite_stock'] }}</td>
                                                <td id="prices_{{ $item['id'] }}" class="{{ $item['prix_produit'] }} ">
                                                    {{ $item['prix_produit'] * $item['quantite'] }}</td>
                                                <td>
                                                    <i id="{{ $item['id'] }}" style="color:red"
                                                        class="fa delete_panier  fa-remove mr-2 icon-size"> <span
                                                            class="ml-3">
                                                        </span>
                                                    </i>

                                                </td>
                                            </tr>
                                        @endforeach

                                    @endisset

                                </tbody>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-8">
                            <a href="/shop" class="btn bg-vert-louma text-light rounded-pill">
                                <i class="fa fa-arrow-left mr-1 icon-size"> </i>
                                Retour aux produits
                            </a>
                        </div>
                    </div>

                    <form method="post" action="/valider_panier/payer" id="formPayer">
                        @csrf
                        <div class="container" style="padding: 20px; background-color:rgb(244, 250, 250); width:500px;">
                            <div class="card" style="align-items: center">
                                <input class="input_total" name="total" value="{{ $somme }}" id="totale"
                                    hidden>
                                <input name="command_name" value="{{ $command_name }}" hidden>
                                <input name="command_id" id="command_id" value="{{ $commande_id }}" hidden>
                                <h3>Total:

                                    <span class="right" id="total" style="color: red">{{ $somme }}
                                        Fcfa</span>
                                </h3>
                                @auth
                                    <div class="input-field col s6 "id='livraison'>
                                        <div class="row">
                                            <label class="col s3">
                                                <input value="O" name="livraison" type="radio" id="yes"
                                                    required />
                                                <span>Payement à la livraison</span>

                                                </p>
                                            </label>
                                            <label class="col s3">
                                                <p>
                                                    <input value="N" name="livraison" type="radio" id="no"
                                                        required />
                                                    <span>Par OM/Wave...</span>
                                                </p>
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <div id="lieu" style="margin-top: 10px">
                                    <div class="row">
                                        <div class="input-field col s4">

                                            <select class="select2 browser-default" id="pays" name="pays">
                                                <option value="" disabled selected>Pays</option>
                                            </select>

                                        </div>
                                        <div class="input-field col s4">
                                            <select class="select2 browser-default region" id="region" name="region">
                                                <option value="" disabled selected>--Région--</option>
                                            </select>

                                        </div>

                                    </div>
                                    <div class="row" style="margin-top:10px">
                                        <div class="input-field col s4">
                                            <select class="select2 browser-default dept" id="dept" name="dept">
                                                <option value="" disabled selected>--Département--</option>

                                            </select>

                                        </div>

                                        <div class="input-field col s4">
                                            <select class="select2 browser-default commune" id="commune"
                                                name="commune">
                                                <option value="" disabled selected>--Commune--</option>
                                            </select>

                                        </div>

                                    </div>
                                    <div class="row" style="margin-top:10px">
                                        <div class="input-field col s6">
                                            <select class="select2 browser-default localite" id="localite"
                                                name="localite">
                                                <option value="" disabled selected>--Localité--</option>
                                            </select>

                                        </div>
                                    </div>


                                </div>
                                <div id="tel">
                                    <div class="row" style="margin-top:10px">
                                        <div class="input-field col s6">
                                            <input placeholder="Telephone" name="telephone" class="tel"
                                                type="number" required>

                                        </div>
                                    </div>
                                </div>
                                <div style="margin-top:20px; margin-left:100px">
                                    <button type="submit" style="align-items: center"
                                        class="btn bg-vert-louma text-light valider_btn">
                                        Valider la commande
                                    </button>
                                </div>
                            @else
                                <div style="margin-top:10px; margin-bottom:10px">
                                    <a href="{{ url("/panier/produit/payer/$commande_id ") }}"
                                        style="align-items: center" class="btn bg-vert-louma text-light valider_btn">Se
                                        connecter pour continuer</a>
                                </div>
                            @endauth

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script> --}}


{{-- <script src="{{ asset('assets\js\providers\shop.js') }}"></script> --}}
