<!-- Start Offres Section -->
@php
    $app_store = "https://apps.apple.com/bm/app/xamsambay/id1665994195";
    $play_store = "https://play.google.com/store/apps/details?id=com.xamsambay.mlouma";
@endphp
<div class="offres bg-light" id="offres">
    <div class="layer-stretch">
        <div class="layer-wrapper" style="padding-bottom:5%">
            <div class="layer-ttl">
                <h4>TESTEZ NOTRE<span class="vert-louma"> PACK GRATUIT</span></h4>
            </div>
            <div class="" style="padding-top:2%;padding-bottom:0%;">
                <div class="row">
                    <div class="col-md-4">

                        <div class="card text-center border-1 card-border" style="background-color: #a2673b;">
                            <h2 class="py-2 class-header text-white">
                                PACK DE BIENVENUE
                            </h2>
                            <div class="card-body bg-light">
                                <div class="card border-0 bg-light">
                                    @isset($pack_default)
                                        @foreach ($pack_default as $item)
                                            @if ($item->canal == 'SMS')
                                                <div class="fs-4 card-header bg-transparent text-uppercase border-0">
                                                    <i class="fa fa-envelope mr-2"></i> Services Par SMS <br>
                                                </div>
                                                <div class="card-body border-0 pt-0">
                                                    <span class="push">{{ $item->nombre }} PUSH</span>
                                                    <ul class="offres-test-lu">
                                                        @if ($item->descriptionpack != null)
                                                            @foreach ($item->descriptionpack as $iteme)
                                                                <li class="li-view text-dark offres-test-li">
                                                                    {{ $iteme }}
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endisset

                                </div>
                                <hr>
                                <div class="card border-0 bg-light">
                                    @isset($pack_default)
                                        @foreach ($pack_default as $item)
                                            @if ($item->canal == 'VOICE')
                                                <div class="fs-4 card-header bg-transparent text-uppercase border-0">
                                                    <i class="fa fa-microphone mr-1"></i> Services Par Vocal <br>
                                                </div>
                                                <div class="card-body border-0 pt-0">
                                                    <span class="push">{{ $item->nombre }} PUSH</span>
                                                    <ul class="offres-test-ul">
                                                        @if ($item->descriptionpack != null)
                                                            @foreach ($item->descriptionpack as $iteme)
                                                                <li class="li-view text-dark offres-test-li">
                                                                    {{ $iteme }}
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endisset

                                </div>
                            </div>
                            <div class="card-footer corner-footer border-0 pb-3 bg-light">
                                <a class="btn rounded-pill btn-sm mb-2" style="color:white;background-color: orangered"
                                   href="{{ route('packs') }}">Commencer
                                    Gratuitement <i class="fa fa-chevron-right"></i> </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 " style="padding-top:2%">
                        <div class="py-3" style="">
                            <img class="" style="width:100%;" src="{{ asset('assets/images/gallery/callc.png') }}"
                                 alt="xsm mobile appli img"/>
                        </div>
                    </div>
                    <div class="col-md-5" style="padding-top:8%">
                        <ul type="square" class="fs-5 text-warning">
                            <li>
                                <span class="text-dark text-justify">
                                    A travers xam sa mbay, Mlouma vous propose des services étudiés et optimisés
                                    pour
                                    répondre aux besoins spécifiques des acteurs de la chaine de valeurs!
                                </span>
                            </li>
                        </ul>
                        <br><br>
                        <p class="mt-3 fs-4 text-center" style="color:#d16208">
                            Accédez à nos propositions de Packs suivant votre profil.
                        </p>
                        <br> <br>

                        <div class="mt-4">
                            <div class="slider-search-wrapper">
                                <div class="row">
                                    <form method="POST" action="/packByProfil">
                                        @csrf
                                        <div class="block main-input text-center">
                                            {{-- Forme avec a un btn submit --}}
                                            <select class="mt-1 mb-2" id="acteur" name="acteur">
                                                {{-- <option value="#">Profil</option> --}}
                                                @isset($profils)
                                                    @foreach ($profils as $profil)
                                                        <option value="{{ $profil->nom_typentite }}">
                                                            {{ $profil->libelle }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>

                                            <button type="submit"
                                                    class="mt-1 mb-2 btn bg-vert-louma text-light rounded-pill submit">
                                                Acceder
                                            </button>
                                            {{-- <br> --}}
                                        </div>
                                        {{-- <div class="col-md-2"></div>
                                        <div class=" mt-2 col-md-4 text-center">
                                        </div> --}}
                                    </form>


                                </div>
                            </div>
                        </div>
                        <br><br>
                        <h4 class="text-center text-uppercase mt-4">
                            <strong> TELECHARGEZ l’APPLICATION MOBILE DE MLOUMA |</strong> <span
                                style="color: #d16208">XAM SA MBAY</span>
                        </h4>

                        {{-- deux bouttons download apple - android --}}
                        <div class="mt-3 d-flex justify-content-evenly">
                            <a href="{{$play_store}}" target="_blank" class="d-inline-block"><img class="ml-2 mr-2"
                                                                                                  style="width:193px;height:75px"
                                                                                                  src="{{ asset('assets/images/gallery/android-button.png') }}"
                                                                                                  alt=""></a>
                            <a href="{{$app_store}}" target="_blank" class="d-inline-block"><img class="ml-2 mr-2"
                                                                                                 style="width:193px;height:75px"
                                                                                                 src="{{ asset('assets/images/gallery/apple-button.png') }}"
                                                                                                 alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Offres Section -->
