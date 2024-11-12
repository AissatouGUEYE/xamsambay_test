@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/app-invoice.css') }}">
@endsection
@section('page-title')
    Diffusion de Prix
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/admin">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/prix-du-marche/prix">Prix du Marché</a>
    </li>
    <li class="breadcrumb-item active">Prix</li>
@endsection

@section('main_content')
    <section class="invoice-edit-wrapper section">
        <div class="row">
            <div class="col xl9 m8 s12">
                <div class="card">
                    <div class="card-content px-36">
                      <form id="price-sms-form" action="javascript:void(0)">
                        <div class="row mb-3">
                          <div class="col m6 s12 l12 pull-m6">
                            <h4 class="indigo-text">{{ $prix[0]->produit }}</h4>
                              <input id="produit" type="text" placeholder="Product Name" value="{{ $prix[0]->produit }}" data-id="{{ $prix[0]->id_produit }}" disabled>
                              <input id="produit" type="text" placeholder="Product Name" value="{{ $prix[0]->id_produit }}" data-id="{{ $prix[0]->id_produit }}" name="id_produit" hidden>
                          </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col l12 s12">
                                <div class="input-field">
                                    <select class="browser-default" id="market-region" name="region" required>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->region }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-field">
                                    <input name="message" id="message-input" value="" placeholder="Message"
                                        class="materialize-textarea" aria-rowcount="15" rows="10" aria-setsize="150">
                                </div>
                                <div class="input-field">
                                    <div id="preloader" class="preloader-wrapper small">
                                        <div class="spinner-layer spinner-green-only">
                                          <div class="circle-clipper left">
                                            <div class="circle"></div>
                                          </div><div class="gap-patch">
                                            <div class="circle"></div>
                                          </div><div class="circle-clipper right">
                                            <div class="circle"></div>
                                          </div>
                                        </div>
                                      </div>
                                    <button id="sms-push-btn" class="btn right" data-repeater-create type="button">
                                        <span >Diffuser</span>

                                    </button>
                                </div>


                                </form>
                            </div>
                        </div>
                        <!-- product details table-->
                        <div class="invoice-product-details mb-3">
                            <form class="form invoice-item-repeater">
                                <div data-repeater-list="group-a">
                                    <div class="mb-2" data-repeater-item>
                                        <!-- invoice Titles -->
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="invoice-subtotal">
                            <div class="row">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col xl3 m4 s12">
                <div class="card invoice-action-wrapper mb-10">
                    <div class="card-content">
                        <ul id="price-recap">
                            <li class="display-flex justify-content-between">
                                <span class="invoice-subtotal-title">Informations non disponibles</span>
                                <h6 class="invoice-subtotal-value"></h6>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('other-js-script')
    <script src="{{ asset('assets/js/scripts/app-invoice.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/extra-components-sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/providers/message.js') }}"></script>
    <script src="{{ asset('assets/js/providers/set_state.js') }}"></script>
    <script src="{{ asset('assets/js/providers/get-other-price.js') }}"></script>
    <script src="{{ asset('assets/js/crud/gestion/delete.js') }}"></script>
    <script src="{{ asset('assets/js/crud/gestion/edit.js') }}"></script>
    <script src="{{ asset('assets/js/crud/gestion/update.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/card-advanced.js') }}"></script>
    <script src="{{ asset('assets/js/crud/services/prix/message.js') }}"></script>
@endsection
