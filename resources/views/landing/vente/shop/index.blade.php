<style>
    .list_active {
        color: white;
        background-color: green;
    }

    .details {
        background-color: white;
        color: green
    }

    .details:hover {
        background-color: #a2673b;
        color: white;

    }

    .add {
        background-color: white;
        color: green
    }

    .add:hover {
        background-color: #a2673b;
        color: white;

    }
</style>

<div class="light-background">
    <div class="layer-stretch">
        <nav aria-label="breadcrumb" style="margin-top:10px ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" style="color: black">Accueil</a></li>
                <li class="breadcrumb-item"><a href="#" style="color: black">Le Louma</a></li>
                <li class="breadcrumb-item active" style="color: #a2673b;" aria-current="page">Produits</li>
            </ol>
        </nav>
        <div class="layer-wrapper row">
            @include('landing.layouts.filtre')
            <div class="col-sm-9 ">
                <div class="panel panel-default m-0 ">
                    <div class="panel-head">
                        <div class="panel-title text-center">
                            <h3>Nos Produits</h3>
                        </div>
                    </div>


                    <div class="panel-body">

                       

                        <div class="row text-center card_prod">
                            {{-- {{ csrf_field() }} --}}

                            @foreach ($shops as $index => $item)
                                @php
                                    $id = $item['id_boutique_produit'];
                                    $id_produit = $item['id_produit'];
                                @endphp

                                <div class="col-md-4 mt-2">
                                    <div class="card mt-2 border-1 card-border" style="background-color: #a2673b; ">
                                        <h3 class=" text-light  " id="nom_prod"
                                            style="max-width: 140px; white-space: nowrap;  text-align:center; margin:0 auto;
                                        overflow: hidden;
                                        text-overflow: ellipsis;">
                                            {{ $item['produit'] }}
                                        </h3>

                                        <div class="card-body bg-light corner-footer">
                                            <div class=" border-0 mb-0 mt-3">
                                                <div class="image">
                                                    @php
                                                        if (!$item['image_produit']) {
                                                            $image = asset('storage/produits/new.jpg');
                                                        } elseif (substr($item['image_produit'], 0, 5) === 'https') {
                                                            $image = $item['image_produit'];
                                                        } else {
                                                            $image = asset('storage/' . $item['image_produit']);
                                                        }

                                                    @endphp
                                                    <img src="{{ $image }}" style="height: 150px; width:180px"
                                                        alt="" class="image_src">

                                                </div>
                                                <div class="pricing-body">
                                                    {{-- <span class="price">{{ $item['cat_produit'] }} </span> --}}
                                                    @if ($item['variete'])
                                                        <span class="inf"
                                                            style="font-style: italic">{{ $item['variete'] }}</span>
                                                    @else
                                                        <span class="inf" style="font-style: italic">-</span>
                                                    @endif
                                                    <ul style="padding-bottom:10px !important;">
                                                    </ul>

                                                </div>

                                                <div class="pricing-footer">
                                                    <span class="price">{{ $item['prix'] }}</span>
                                                    <span class="sup"><small> FCFA/
                                                            {{ $item['unite_stock'] }}</small></span>
                                                    <p>
                                                        <a href="{{ url("/addProdPanier/$id") }}"
                                                            title="ajouter au panier" class="add btn ">
                                                            <span>
                                                                <i class="fa fa-plus">
                                                                </i>
                                                            </span>
                                                            Panier
                                                        </a>
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#staticBackdrop" title="details"
                                                            class="btn details"
                                                            id="#modalDetailsProduit {{ $item['id_boutique_produit'] }} }}">
                                                            <span class="">
                                                                <i class="fa fa-eye ">
                                                                </i>
                                                            </span>
                                                            Details
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="ajaxloader-prod"
                        style="display:none ;margin-left:50%; margin-right:50%; margin-top:40px">
                        <img class="mx-auto mt-30 mb-30  d-block"
                            src="{{ asset('assets/images/loader/loader-13.svg') }}" alt="">
                    </div>
                    <ul class="pagination right">
                        @if ($page > 1)
                            <li class="disabled"><a href="#!"><i class="mdi-navigation-chevron-left"></i></a></li>
                            <li class="list_active go_page " id="li_1"><a href="#!">1</a></li>

                            @for ($i = 1; $i < $page; $i++)
                                <li class="waves-effect go_page" id="li_{{ $i + 1 }}"><a
                                        href="#">{{ $i + 1 }}</a></li>
                            @endfor
                        @endif
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg " id="staticBackdrop" aria-hidden="true"
    aria-labelledby="staticBackdropLabel" tabindex="-1">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 " id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="row ">
                <div class="col-md-6"
                    style=" display: flex;
                justify-content: center;
                align-items: center;">
                    <img class="description_img m-2" src="" alt="" style="height:150px; width:180px ">
                </div>
                <div class="col-md-6 description_nom " style="margin-top: 20px">
                    <p class="m-2"><strong>Variete :</strong> <span class="variete_prod">-</span> </p>
                    <p class="m-2"><strong>Prix : </strong><span class="prix_prod">-</span> </p>
                    <p class="m-2"><strong>Categorie :</strong> <span class="cat_prod">-</span> </p>
                    <p class="m-2"><strong>Boutique :</strong> <span class="shop_prod">-</span> </p>
                    <p class="m-2"><strong>Localisation :</strong> <span class="loc_prod">-</span> </p>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

                <a href="" style="color: white; background-color:green" title="ajouter au panier"
                    class=" btn add_p ">
                    <span>
                        <i class="fa fa-plus  green-text" style="color: white">
                        </i>
                    </span>
                    Panier </a>
            </div>
        </div>
    </div>
</div>
@include('landing.layouts.comment')
