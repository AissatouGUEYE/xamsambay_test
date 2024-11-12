{{-- <script src="{{ asset('assets/landing/plugin/jquery/jquery-2.1.4.min.js') }}"></script> --}}
{{-- @include('landing.layouts.script') --}}
<script src="{{ asset('assets/vendors/sweetalert/sweetalert.min.js') }}"></script>
<div class="light-background">
    <div class="layer-stretch">
        <nav aria-label="breadcrumb" style="margin-top:10px ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" style="color: black">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/shop') }}" style="color: black">Le Louma</a></li>
                <li class="breadcrumb-item active" style="color: #a2673b;" aria-current="page">Panier</li>
            </ol>
        </nav>
        <div class="layer-wrapper">
            <div class="row pt-4">
                <div class="panel panel-default m-0">
                    <div class="panel-head">
                        <div class="panel-title text-center">
                            <h3>Merci. Votre commande a été reçue.</h3>
                        </div>

                    </div>
                    <div id="div_top_hypers" style=" top: 50%;
                    left: 50%;">
                        <ul id="ul_top_hypers" style="padding:5px">

                            <li> Reference Commande <strong> {{ $data[0]['reference'] }}</strong></li>
                            <li> Date <strong>{{ $data[0]['created_at'] }}</strong> </li>
                            <li> E-mail <strong>{{ $data[0]['email_client'] }}</strong></li>
                            <li>Total <strong>{{ $data[0]['montant'] }}Fcfa</strong></li>
                            @php
                                if ($data[0]['id_paiement'] == 2) {
                                    $paiement = 'Payement a la livraison';
                                } else {
                                    $paiement = 'Payement par Paytech';
                                }
                            @endphp
                            <li> Moyen de Payement <strong>{{ $paiement }}</strong></li>
                        </ul>
                    </div>
                    <br>

                    <div class="panel-head">
                        <div class="panel-title text-center">
                            <h3>Detail de la commande </h3>
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

                                    </tr>
                                <tbody>
                                    @isset($panier)

                                        @foreach ($panier as $item)
                                            <tr>
                                                <input type="text" id="boutique_produit"
                                                    value="{{ $item['id_boutique_produit'] }}" hidden>

                                                <td><img width="200px"
                                                        src="{{ asset('storage/' . $item['image_produit']) }}"
                                                        alt=""></td>

                                                <td>{{ $item['boutique'] }}</td>
                                                <td>{{ $item['prix_produit'] }} {{ $item['unite_prix'] }} </td>
                                                <td>
                                                    {{ $item['quantite'] }}
                                                </td>
                                                <td> {{ $item['unite_stock'] }}</td>
                                                <td id="prices_{{ $item['id'] }}" class="{{ $item['prix_produit'] }} ">
                                                    {{ $item['prix_produit'] * $item['quantite'] }}</td>

                                            </tr>
                                        @endforeach

                                    @endisset

                                </tbody>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="panel-head">
                        <div class="panel-title text-center">
                            <h3>Adresse de facturation.</h3>
                        </div>

                    </div>
                    <div class="row">
                        <i class=" fa fa-user">
                            <span class=" ml-3" style="font-family: Dosis, Poppins, sans-serif";>{{ $data[0]['prenom_client'] }}
                                {{ $data[0]['nom_client'] }}</span>
                        </i>
                        <i class="fa fa-location">
                            <span class=" ml-3 " style="font-family: Dosis, Poppins, sans-serif">{{ $data[0]['localite'] }}
                              </span>
                        </i>
                        <i class="fa fa-phone">
                            <span class=" ml-3  " style="font-family: Dosis, Poppins, sans-serif">{{ $data[0]['telephone'] }}
                              </span>
                        </i>
                        <i class="fa fa-mail" >
                            <span class=" ml-3  "style="font-family: Dosis, Poppins, sans-serif">{{ $data[0]['email_client'] }}
                              </span>
                        </i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script> --}}

    {{-- <script src="{{ asset('assets\js\providers\shop.js') }}"></script> --}}
