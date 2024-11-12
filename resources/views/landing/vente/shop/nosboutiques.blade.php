<style>
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
                <li class="breadcrumb-item active" style="color: #a2673b;" aria-current="page">Nos Boutiques</li>
            </ol>
        </nav>
        <div class="layer-wrapper row">
            <div class="col-sm-12">
                <div class="panel panel-default m-0 ">
                    <div class="panel-head">
                        <div class="panel-title text-center">
                            <h3 style="color: #a2673b">Nos boutiques</h3>
                        </div>
                    </div>
                </div>

            </div>
            <div class="d-flex mt-2">
                <div class="ml-auto">
                    <a class=" add btn  " href="#" data-bs-toggle="modal" data-bs-target="#createShop">
                        <span>
                            <i class="fa fa-plus ">
                            </i>
                        </span>
                        Boutique
                    </a>
                </div>
            </div>
        </div>

        <div class="">
            <ul class="list-group list-group-horizontal-md categorie">

            </ul>
        </div>
        <div class="row d-flex" style="margin-top:20px;">
            <div></div>
            <div class=" col-sm-4 ml-auto">
                  <input list="shops" name="shop" id="shopInput" placeholder="Rechercher Boutique...">
                <datalist id="shops">
                    <option value='Pas de filtre' id="null"></option>
                    @foreach ($data_shop as $item)
                        <option value="{{ $item['nom'] }}" id="{{ $item['id'] }}">
                    @endforeach
                </datalist>
                {{-- <select class=" browser-default" id="shop" name="shop">

                    <option value=null class="go-page-boutique" id="li_1">Pas de filtre</option>
                    @foreach ($data_shop as $item)
                        <option value="{{ $item['id'] }}">{{ $item['nom'] }}</option>
                    @endforeach

                    <option value="" disabled selected>-- Recherche Boutique--</option>
                </select> --}}
            </div>
        </div>


        {{-- shop --}}
        <div class="row box-container" id="card-shop" style="margin-top: 20px; margin-bottom:20px">
            @foreach ($shops as $item)
                <div class="card col-sm-4" style="width: 18rem; margin-top:5px; margin-right:2px">
                    @php
                        $id = $item['id'];
                        if (!$item['logo']) {
                            $image = asset('storage/produits/new.jpg');
                        } elseif (substr($item['logo'], 0, 5) === 'https') {
                            $image = $item['logo'];
                        } else {
                            $image = asset('storage/' . $item['logo']);
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
                        <h5 class="card-title"
                            style="max-width: 140px; white-space: nowrap;  text-align:center; margin:0 auto;
                        overflow: hidden;
                        text-overflow: ellipsis;">
                            {{ $item['nom'] }}</h5>
                        <a class="px-1 btn btn-light mt-3" style="color:#a2673b ; display:block"
                            href="/prod_by_shop/{{ $id }}"><i class="fa fa-eye "> Visiter
                            </i>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="ajaxloader" style="display:none ;margin-left:50%; margin-right:50%; margin-top:40px">
            <img class="mx-auto mt-30 mb-30  d-block" src="{{ asset('assets/images/loader/loader-13.svg') }}"
                alt="">
        </div>
        <div style="margin-bottom: 100px">
            <ul class="pagination  " style="text-align:center; margin:0 auto;">
                @if ($page > 1)
                    <li class="disabled"><a href="#!"><i class="mdi-navigation-chevron-left"></i></a></li>
                    <li class="list_active go-page-boutique " id="li_1"><a href="#!">1</a></li>

                    @for ($i = 1; $i < $page; $i++)
                        <li class="waves-effect go-page-boutique" id="li_{{ $i + 1 }}"><a
                                href="#">{{ $i + 1 }}</a></li>
                    @endfor
                @endif
            </ul>
        </div>
    </div>

</div>

{{-- modal --}}

<div class="modal fade bd-example-modal-lg " id="createShop" aria-hidden="true" aria-labelledby="createShopLabel"
    tabindex="-1">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 " id="createShopLabel">Nouvelle Boutique</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="formmessage">Success/Error Message Goes Here</div>

            <form method="post" id="formAddShop" enctype="multipart/form-data"
                action="{{ url('/louma/create_shop') }}">
                @csrf
                <div class="contact-form clearfix">
                    <div class="row mt-3" style="margin: 5px;padding:5px">
                        <div class="input-field col s6">

                            <input type="text" name="name_boutique" placeholder="Entrez le nom de la boutique ">
                        </div>
                        <div class="input-field col s6">

                            <input type="text" name="desc_boutique" placeholder="Donner une description">
                        </div>
                    </div>
                    <div class="row mt-2" style="margin: 5px;padding:5px">
                        <div class=" col-sm-4">
                            {{-- <label for="" style="color: #a2673b">--Pays--</label> --}}
                            <select class=" browser-default" id="pays" name="pays">
                                <option value="" disabled selected>Pays</option>
                            </select>
                        </div>
                        <div class=" col-sm-4">
                            {{-- <label for="" style="color: #a2673b">--Region--</label> --}}
                            <select class="region browser-default" id="region" name="region">
                                <option value="" disabled selected>Region</option>
                            </select>
                        </div>
                        <div class=" col-sm-4">
                            {{-- <label for="" style="color: #a2673b">--Département--</label> --}}
                            <select class="dept browser-default" id="dept" name="dept">
                                <option value="" disabled selected>Département</option>
                            </select>
                        </div>

                    </div>
                    <div class="row mt-2" style="margin: 5px;padding:5px">
                        <div class=" col-sm-4">
                            {{-- <label for="" style="color: #a2673b">--Commune--</label> --}}
                            <select class="commune browser-default" id="commune" name="commune">
                                <option value="" disabled selected>Commune</option>
                            </select>
                        </div>
                        <div class=" col-sm-4">
                            {{-- <label for="" style="color: #a2673b">--Localité--</label> --}}
                            <select class="localite browser-default" id="localite" name="localite">
                                <option value="" disabled selected>Localité</option>
                            </select>
                        </div>

                    </div>
                    <div class="row" style="margin: 5px;padding:5px">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Logo</label>
                                <input class="form-control" type="file" id="formFile" name="fichier">
                            </div>
                        </div>
                    </div>

                    <div id="ajaxloader" style="display:none"><img class="mx-auto mt-30 mb-30 d-block"
                            src="{{ asset('assets/images/loader/loader-02.svg') }}" alt=""></div>
                    <div class="modal-footer">
                        <button type="submit" id="submit" name="submit"
                            style="color: white; background-color:#a2673b" class="btn">
                            Enregistrer
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // <script src="{{ asset('assets\js\providers\location.js') }}">
</script>

