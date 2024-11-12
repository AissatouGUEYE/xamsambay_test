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
                <li class="breadcrumb-item active" style="color: #a2673b;" aria-current="page">Nos Produits</li>
            </ol>
        </nav>
        <div class="layer-wrapper row">
            <div class="col-sm-12">
                <div class="panel panel-default m-0 ">
                    <div class="panel-head">
                        <div class="panel-title text-center">
                            <h3 style="color: #a2673b">Nos Produits</h3>
                        </div>
                    </div>
                </div>

            </div>
            <div class="d-flex mt-2">
                <div class="ml-auto">
                    <a href="{{ url('/nosboutiques') }}" title="nos boutiques" class="add btn ">
                        <span>
                            <i class="fa fa-eye">
                            </i>
                        </span>
                        Nos boutiques
                    </a>
                </div>
            </div>
        </div>

        <div class="">
            <ul class="list-group list-group-horizontal-md categorie">

            </ul>
        </div>
        <div class="row  " style="margin-top: 20px;">
            <div class=" col-sm-4  span6 " style="float: none; margin: 0 auto;">
                {{-- <label for="products">Choisissez un Produit :</label> --}}
                <input list="products" name="product" id="productInput" placeholder="Rechercher produit...">
                <datalist id="products">
                    <option value='Pas de filtre' id="null"></option>
                    @foreach ($shops as $item)
                        <option value="{{ $item['produit'] }}" id="{{ $item['id_boutique_produit'] }}">
                    @endforeach
                </datalist>
                {{-- <select class=" browser-default" id="product" name="product">
                    <option value=null>Pas de filtre</option>
                    @foreach ($shops as $item)
                        <option value="{{ $item['id_boutique_produit'] }}">{{ $item['produit'] }}</option>
                    @endforeach
                    <option value="" disabled selected>-- Recherche Produit--</option>
                </select> --}}
            </div>

            <div class=" col-sm-4 show-btn " style="float: none; margin: 0 auto;">

                <input list="cats" name="cat" id="catInput" placeholder="Rechercher categorie...">
                <datalist id="cats">
                    <option value='Pas de filtre' id="null"></option>
                    @foreach ($data_cat as $item)
                        <option value="{{ $item['cat_produit'] }}" id="{{ $item['id'] }}">
                    @endforeach
                </datalist>

                {{-- <select class=" browser-default" id="cat-prod" name="cat-prod">

                    <option value=null>Pas de filtre</option>
                    @foreach ($data_cat as $item)
                        <option value="{{ $item['id'] }}">{{ $item['cat_produit'] }}</option>
                    @endforeach

                    <option value="" disabled selected>-- Recherche Categorie--</option>
                </select> --}}
            </div>
        </div>
        {{-- produits --}}
        <div class="row card_prod" style="margin-top: 20px; margin-bottom:20px">
            @foreach ($shops as $item)
                <div class="card col-sm-4" style="width: 18rem; margin-top:5px; margin-right:2px">
                    @php
                        $id = $item['id_boutique_produit'];
                        $id_produit = $item['id_produit'];
                        if (!$item['image_produit']) {
                            $image = asset('storage/produits/new.jpg');
                        } elseif (substr($item['image_produit'], 0, 5) === 'https') {
                            $image = $item['image_produit'];
                        } else {
                            $image = asset('storage/' . $item['image_produit']);
                        }
                    @endphp
                    <div class="image"
                        style=" display: flex;
                    justify-content: center;
                    align-items: center;
                    margin-top:10px">
                        <img class="card-img-top" src="{{ $image }}" style="height:150px; width:180px ">

                    </div>
                    <div class="card-body">
                        <h4 class="card-title"
                            style="max-width: 140px; white-space: nowrap;  text-align:center; margin:0 auto;
                        overflow: hidden;
                        text-overflow: ellipsis;color:#a2673b">
                            {{ $item['produit'] }} </h4>
                        <h5 style="margin-top: 10px; text-align:center">

                            <span class="price">{{ $item['prix'] }}</span>
                            <span class="sup"><small> FCFA/
                                    {{ $item['unite_stock'] }}</small></span>
                        </h5>

                        <a href="{{ url("/addProdPanier/$id") }}" title="ajouter au panier" class="add btn ">
                            <span>
                                <i class="fa fa-plus">
                                </i>
                            </span>
                            Panier
                        </a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" title="details"
                            class="btn details" id="#modalDetailsProduit {{ $item['id_boutique_produit'] }} }}">
                            <span class="">
                                <i class="fa fa-eye ">
                                </i>
                            </span>
                            Details
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="ajaxloader-prod" style="display:none ;margin-left:50%; margin-right:50%; margin-top:40px">
            <img class="mx-auto mt-30 mb-30  d-block" src="{{ asset('assets/images/loader/loader-13.svg') }}"
                alt="">
        </div>
        <div style="margin-bottom: 100px">
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
                    <img class="description_img m-2" src="" alt=""
                        style="height:150px; width:180px ">
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
