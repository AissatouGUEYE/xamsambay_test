<script src="{{ asset('assets/vendors/sweetalert/sweetalert.min.js') }}"></script>
<div class="light-background">
    <div class="layer-stretch">
        <nav aria-label="breadcrumb" style="margin-top:10px ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" style="color: black">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/shop') }}" style="color: black">Le Louma</a></li>
                <li class="breadcrumb-item active" style="color: #a2673b;" aria-current="page">Mes commandes</li>
            </ol>
        </nav>
        <div class="layer-wrapper">
            <div class="row pt-4">
                <div class="panel panel-default m-0">
                    <div class="panel-head">
                        <div class="panel-title text-center">
                            <h3>Liste des commandes</h3>
                        </div>
                    </div>
                    <div class="card-content" style="padding: 30px">
                        <div class="responsive-table">
                            <table class="table  data-table ">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Reference</th>
                                        <th>Statut</th>
                                        <th>Payement</th>
                                        <th>Produits</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($commande)
                                        @foreach ($commande as $item)
                                            <tr>
                                                <td>{{ $item['date_commande'] }}</td>
                                                <td>{{ $item['reference'] }}</td>
                                                @if ($item['statut'] == 0)
                                                    <td> <span class='text-warning'>Initié...</span></td>
                                                @else
                                                    @if ($item['statut'] == 1)
                                                        <td> <span class='text-warning'>En cours</span></td>
                                                    @else
                                                        <td> <span class='text-success'>Terminé</span></td>
                                                    @endif
                                                @endif
                                                <td> {{$item['type_paiement']}} </td>
                                                @php
                                                    $id_commande=$item['id_commande'];
                                                @endphp
                                                <td> <a href="{{ url("produits_commandes/$id_commande") }}" class="btn bg-vert-louma text-light ">Produits</a></td>
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
{{-- <script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script> --}}
{{-- <script src="{{ asset('assets\js\providers\shop.js') }}"></script> --}}
