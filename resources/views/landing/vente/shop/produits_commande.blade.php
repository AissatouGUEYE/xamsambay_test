<script src="{{ asset('assets/vendors/sweetalert/sweetalert.min.js') }}"></script>
<div class="light-background">
    <div class="layer-stretch">
        <nav aria-label="breadcrumb" style="margin-top:10px ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" style="color: black">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/shop') }}" style="color: black">Le Louma</a></li>
                <li class="breadcrumb-item active" style="color: #a2673b;" aria-current="page">Produits de ma commande
                </li>
            </ol>
        </nav>
        <div class="layer-wrapper">
            <div class="row pt-4">
                <div class="panel panel-default m-0">
                    <div class="panel-head">
                        <div class="panel-title text-center">
                            <h3>Liste des produits de ma commande</h3>
                        </div>
                    </div>
                    <div class="card-content" style="padding: 30px">
                        <div class="responsive-table">
                            <table class="table  data-table ">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Boutique</th>
                                        <th>Quantite</th>
                                        <th>Unite</th>
                                        <th>Total</th>

                                    </tr>
                                <tbody>
                                    @isset($produit)

                                        @foreach ($produit as $item)
                                            <tr>

                                                @php

                                                if (!$item['image_produit']) {
                                                    $image = asset('storage/produits/new.jpg');
                                                } elseif (substr($item['image_produit'], 0, 5) === 'https') {
                                                    $image = $item['image_produit'];
                                                } else {
                                                    $image = asset('storage/' . $item['image_produit']);
                                                }
                                               
                                            @endphp
                                                <td><img width="200px"
                                                        src="{{ $image }}"
                                                        alt=""></td>

                                                <td>{{ $item['boutique'] }}</td>
                                                <td>{{ $item['quantite'] }} </td>

                                                <td> {{ $item['unite_stock'] }}</td>
                                                <td>{{ $item['prix_produit'] * $item['quantite'] }}</td>

                                            </tr>
                                        @endforeach

                                    @endisset

                                </tbody>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script> --}}
{{-- <script src="{{ asset('assets\js\providers\shop.js') }}"></script> --}}
