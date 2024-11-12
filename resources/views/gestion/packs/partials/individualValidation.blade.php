@if (!isset($course))
    <div class="card">
        <form id="formChoixCours" action="{{ route('packs.choix.cours') }}" method="post">
            @csrf
            <h5 style="text-align: center;padding-top:10px">Module de cours au choix</h5>
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="material-icons prefix pt-2">school</i>
                    <select id="cours" type="text" name="cours" :value="old('cours')" required autofocus>
                        <option value="" disabled selected>Choix Cours</option>
                        @isset($cours)
                            @foreach ($cours as $item)
                                <option value="{{ $item->id }}-{{ $item->displayname }}">{{ $item->displayname }}
                                </option>
                            @endforeach
                        @endisset
                        {{-- <option value="">Beine Cours</option>
                    <option value="">deffouma Cours</option>
                    <option value="">benene Cours</option> --}}
                    </select>
                    <label for="cours" :value="__('cours')" class="center-align">Module de cours
                        au
                        choix</label>
                    <input hidden name="idAbonnement" value="{{ $idAbonnement }}">
                    <input hidden name="idPack" value="{{ $pack->id }}">
                </div>
            </div>
            <div class="row">
                <div class="col s2"></div>
                <div class="input-field col s8">
                    {{-- <button  class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12"> {{ __('Log in') }}</button> --}}
                    <button class="btn waves-effect waves-light border-round green col s12"
                        id="choixCours">Valider</button>
                </div>
                <div class="col s2"></div>
            </div>
        </form>
    </div>
@endif
{{-- <br> --}}
@if ($pack->type_pack != 'KHEWEUL')
    @if (!isset($produit))
        <div class="card">
            <form id="formPrixMarche" action="{{ route('packs.prix.marche') }}" method="post">
                @csrf
                <h5 style="text-align: center;padding-top:10px">Prix du Marché</h5>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="material-icons prefix pt-2">local_florist</i>
                        <select id="produitMarche" type="text" name="produit" required>
                            <option value="" disabled selected>Choix produit *</option>
                            @isset($produits)
                                @foreach ($produits as $item)
                                    <option value="{{ $item->id }}">{{ $item->produit }} ({{ $item->cat_produit }})
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        <label for="produitMarche" class="center-align">Choix
                            du produit</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="material-icons prefix pt-2">shopping_cart</i>
                        <select id="marcheChoisi" type="text" name="marche" :value="old('marche')" required>
                            <option value="" disabled selected>Choix du Marché *</option>
                            @isset($markets)
                                @foreach ($markets as $item)
                                    <option value="{{ $item->id }}">{{ $item->market }} ({{ $item->localite }})
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        <label for="marcheChoisi" class="center-align">Choix du
                            marché</label>
                        <input hidden name="idAbonnement" value="{{ $idAbonnement }}">
                        <input hidden name="idPack" value="{{ $pack->id }}">


                    </div>
                </div>

                {{-- Choix Region au lieu du marche --}}
                {{-- <div class="row margin">
                    <div class="input-field col s12">
                        <i class="material-icons prefix pt-2">shopping_cart</i>
                        <select id="regionChoisi" type="text" name="region" :value="old('region')" required>
                            <option value="" disabled selected>Choix de la Region *</option>
                            @isset($regions)
                                @foreach ($regions as $item)
                                    <option value="{{ $item->id }}">{{ $item->region }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        <label for="regionChoisi" class="center-align">Choix de la
                            Region</label>
                        <input hidden name="idAbonnement" value="{{ $idAbonnement }}">
                        <input hidden name="idPack" value="{{ $pack->id }}">


                    </div>
                </div> --}}

                <div class="row">
                    <div class="col s2"></div>
                    <div class="input-field col s8">
                        {{-- <button  class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12"> {{ __('Log in') }}</button> --}}
                        <button class="btn waves-effect waves-light border-round green col s12"
                            id="prixDuMarche">Valider</button>
                    </div>
                    <div class="col s2"></div>
                </div>
            </form>

        </div>
    @endif
@endif
