<!-- Start Page Section -->
<div class="light-background">
    <div class="layer-stretch">
        <div class="layer-wrapper">
            <div class="row pt-4">
                <div class="panel panel-default m-0">
                    <div class="panel-head">
                        <div class="panel-title text-center">
                            <h3>Green API</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row text-center">
                            @if (!empty($packList))

                                <div class="row">
                                    @foreach($green_api as $pack)
                                    <div class="col-md-4 pt-4">
                                        <div class="card mt-2 border-1 card-border d-flex flex-column">
                                            <h3 class="card-header text-light text-uppercase" style="background-color: #a2673b;">
                                                {{ $pack->nom }}
                                            </h3>
                                            <div class="card-body bg-light corner-footer flex-grow-1">
                                                <div class="pricing01 border-0 mb-0">
                                                    <div class="pt-3 text-center">
                                                        <span class="section-title text-uppercase">Inscription</span>
                                                        <br>
                                                    </div>
                                                    <div class="pricing-body">
                                                        <span class="price">{{ number_format($pack->montant_initial, 0, ',', ' ') }}</span>
                                                        <span class="sup"><small>FCFA</small></span>
                                                    </div>
                                                </div>
                                                <div class="pricing01 border-0 corner-footer mb-0 styled">
                                                    <div class="pt-3 text-center">
                                                        <span class="section-title text-uppercase">Mensualité</span>
                                                        <br>
                                                    </div>
                                                    <div class="pricing-body">
                                                        <span class="price">{{ number_format($pack->montant_mensuel, 0, ',', ' ') }}</span>
                                                        <span class="sup"><small>FCFA</small></span>
                                                        <br><br>
                                                        <ul style="padding-bottom:30px !important;">
                                                            @foreach($pack->services as $service)
                                                                <li class="li-view text-dark sup">{{ $service->service }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing-footer mt-auto text-center">
                                                <a href="{{ route('greenapi.validation', [$pack->id, "GREENAPI"]) }}" class="btn bg-vert-louma text-light rounded-pill btn-lg shadow">Acheter Maintenant</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>


                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Section -->

<!-- Start Page Section -->
<div class="light-background">
    <div class="layer-stretch">
        <div class="layer-wrapper">
            <div class="row pt-4">
                <div class="panel panel-default m-0">
                    <div class="panel-head">
                        <div class="panel-title text-center">
                            <h3>Liste des Packs</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row text-center">
                            @if (!empty($packList))

                                @php
                                    // dd($packList);
                                    if (isset($packList[0][0])) {
                                        $xeweul_sms = $packList[0][0];
                                    }
                                    if (isset($packList[0][1])) {
                                        $xeweul_voice = $packList[0][1];
                                    }
                                    if (isset($packList[1][0])) {
                                        $confort_sms = $packList[1][0];
                                    }
                                    if (isset($packList[1][1])) {
                                        $confort_voice = $packList[1][1];
                                    }
                                    if (isset($packList[0][0])) {
                                        $prestige_sms = $packList[2][0];
                                    }
                                    if (isset($packList[0][0])) {
                                        $prestige_voice = $packList[2][1];
                                    }

                                    $count = 0;

                                @endphp
                                <div class="col-md-4">
                                    @if (isset($xeweul_sms) && isset($xeweul_voice))
                                        <div class="card mt-2 border-1 card-border" style="background-color: #a2673b;">
                                            <h3 class="card-header text-light text-uppercase">
                                                KHEWEUL
                                            </h3>
                                            <div class="card-body bg-light corner-footer">
                                                <div class="pricing01 border-0 mb-0">
                                                    <div class="pt-3 text-center">
                                                        <i class="fa fa-envelope icon-size mr-2"> <span
                                                                class="ml-3 pricing-head-title text-uppercase">Services
                                                                Par SMS</span></i>
                                                        <br>
                                                        <small class="qty">
                                                            @if ($xeweul_sms->maxproducteur != 1)
                                                                De
                                                                {{ $xeweul_sms->minproducteur }} à
                                                                {{ $xeweul_sms->maxproducteur }} Producteurs
                                                            @else
                                                                {{-- {{ $xeweul_sms->descriptionpack[0] }} --}}
                                                            @endif
                                                        </small>
                                                    </div>
                                                    <div class="pricing-body">
                                                        <span class="price">{{ $xeweul_sms->pricing }}</span>
                                                        <span class="sup"><small>FCFA</small></span>
                                                        @if ($acteur == 'ONG')
                                                            <span class="inf" style="font-style: italic"> Par
                                                                Producteur</span>
                                                        @endif
                                                        @if ($xeweul_sms->descriptionpack != null)
                                                            @php
                                                                $count = count($xeweul_sms->descriptionpack);
                                                                $res = 6 - $count;
                                                                // var_dump($res);
                                                            @endphp
                                                            <ul
                                                                style="@if ($res == 1) padding-bottom:30px !important; @endif @if ($res >= 2) padding-bottom:30px !important; padding-top:35px !important; @endif ">
                                                                @foreach ($xeweul_sms->descriptionpack as $key => $item)
                                                                    <li class="li-view text-dark">
                                                                        {{ $item }}
                                                                    </li>
                                                                @endforeach

                                                            </ul>
                                                        @endif
                                                    </div>
                                                    <div class="pricing-footer">
                                                        <a href="{{ route('packs.validation', [$xeweul_sms->id, $xeweul_sms->type_entite]) }}"
                                                            class="btn bg-vert-louma text-light rounded-pill">Acheter
                                                            Maintenant</a>
                                                    </div>
                                                </div>
                                                <div class="pricing01 border-0 corner-footer mb-0 styled">
                                                    <div class="pt-3 text-center">
                                                        <i class="fa fa-microphone mr-2 icon-size"> <span
                                                                class="ml-3 pricing-head-title text-uppercase">Services
                                                                Par Vocal</span></i>
                                                        <br>
                                                        <small class="qty">
                                                            @if ($xeweul_voice->maxproducteur != 1)
                                                                De
                                                                {{ $xeweul_voice->minproducteur }} à
                                                                {{ $xeweul_voice->maxproducteur }} Producteurs
                                                            @else
                                                                {{-- {{ $xeweul_voice->descriptionpack[0] }} --}}
                                                            @endif
                                                        </small>
                                                    </div>
                                                    <div class="pricing-body">
                                                        <span class="price">{{ $xeweul_voice->pricing }}</span>
                                                        <span class="sup"><small>FCFA</small></span>
                                                        @if ($acteur == 'ONG')
                                                            <span class="inf" style="font-style: italic"> Par
                                                                Producteur</span>
                                                        @endif
                                                        @if ($xeweul_voice->descriptionpack != null)
                                                            @php
                                                                $count = count($xeweul_voice->descriptionpack);
                                                                $res = 6 - $count;
                                                            @endphp
                                                            <ul
                                                                style="@if ($res == 1) padding-bottom:30px !important; @endif @if ($res >= 2) padding-bottom:30px !important; padding-top:35px !important; @endif ">
                                                                @foreach ($xeweul_voice->descriptionpack as $key => $item)
                                                                    <li class="li-view text-dark">
                                                                        {{ $item }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                    <div class="pricing-footer">
                                                        <a href="{{ route('packs.validation', [$xeweul_voice->id, $xeweul_voice->type_entite]) }}"
                                                            class="btn bg-vert-louma text-light rounded-pill">Acheter
                                                            Maintenant</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif()
                                </div>
                                <div class="col-md-4">
                                    @if (isset($confort_sms) && isset($confort_voice))
                                        <div class="card mt-2 border-1 card-border" style="background-color: #6d4222;">
                                            <h3 class="card-header text-light text-uppercase">
                                                CONFORT
                                            </h3>
                                            <div class="card-body bg-light corner-footer">
                                                <div class="pricing01 border-0 mb-0">
                                                    <div class=" pt-3 text-center">
                                                        <i class="fa fa-envelope mr-2 icon-size"> <span
                                                                class="ml-3 pricing-head-title text-uppercase">Services
                                                                Par SMS</span></i>
                                                        <br>
                                                        <small class="qty">
                                                            @if ($confort_sms->maxproducteur != 1)
                                                                De
                                                                {{ $confort_sms->minproducteur }} à
                                                                {{ $confort_sms->maxproducteur }} Producteurs
                                                            @else
                                                                {{-- {{ $confort_sms->descriptionpack[0] }} --}}
                                                            @endif
                                                        </small>
                                                    </div>

                                                    <div class="pricing-body">
                                                        <span class="price">{{ $confort_sms->pricing }}</span>
                                                        <span class="sup"><small>FCFA</small></span>
                                                        @if ($acteur == 'ONG')
                                                            <span class="inf" style="font-style: italic"> Par
                                                                Producteur</span>
                                                        @endif
                                                        @if ($confort_sms->descriptionpack != null)
                                                            @php
                                                                $count = count($confort_sms->descriptionpack);
                                                                $res = 6 - $count;
                                                            @endphp
                                                            <ul
                                                                style="@if ($res == 1) padding-bottom:30px !important; @endif @if ($res >= 2) padding-bottom:30px !important; padding-top:35px !important; @endif ">
                                                                @foreach ($confort_sms->descriptionpack as $key => $item)
                                                                    <li class="li-view text-dark">
                                                                        {{ $item }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                    <div class="pricing-footer">
                                                        <a href="{{ route('packs.validation', [$confort_sms->id, $confort_sms->type_entite]) }}"
                                                            class="btn bg-vert-louma text-light rounded-pill">Acheter
                                                            Maintenant</a>
                                                    </div>
                                                </div>
                                                <div class="pricing01 border-0 corner-footer mb-0 styled">
                                                    <div class="pt-3 text-center">
                                                        <i class="fa fa-microphone icon-size mr-2"> <span
                                                                class="ml-3 pricing-head-title text-uppercase">Services
                                                                Par Vocal</span></i>
                                                        <br>
                                                        <small class="qty">
                                                            @if ($confort_voice->maxproducteur != 1)
                                                                De
                                                                {{ $confort_voice->minproducteur }} à
                                                                {{ $confort_voice->maxproducteur }} Producteurs
                                                            @else
                                                                {{-- {{ $confort_voice->descriptionpack[0] }} --}}
                                                            @endif
                                                        </small>
                                                    </div>

                                                    <div class="pricing-body">
                                                        <span class="price">{{ $confort_voice->pricing }}</span>
                                                        <span class="sup"><small>FCFA</small></span>
                                                        @if ($acteur == 'ONG')
                                                            <span class="inf" style="font-style: italic"> Par
                                                                Producteur</span>
                                                        @endif
                                                        @if ($confort_voice->descriptionpack != null)
                                                            @php
                                                                $count = count($confort_voice->descriptionpack);
                                                                $res = 6 - $count;
                                                            @endphp
                                                            <ul
                                                                style="@if ($res == 1) padding-bottom:30px !important; @endif @if ($res >= 2) padding-bottom:30px !important; padding-top:35px !important; @endif ">
                                                                @foreach ($confort_voice->descriptionpack as $key => $item)
                                                                    <li class="li-view text-dark">
                                                                        {{ $item }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                    <div class="pricing-footer">
                                                        <a href="{{ route('packs.validation', [$confort_voice->id, $confort_voice->type_entite]) }}"
                                                            class="btn bg-vert-louma text-light rounded-pill">Acheter
                                                            Maintenant</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif()
                                </div>
                                <div class="col-md-4">
                                    @if (isset($prestige_sms) && isset($prestige_voice))
                                        <div class="card mt-2 border-1 card-border" style="background-color: #d16208;">
                                            <h3 class="card-header text-light text-uppercase">
                                                PRESTIGE
                                            </h3>
                                            <div class="card-body bg-light corner-footer">
                                                <div class="pricing01 border-0 mb-0">
                                                    <div class="pt-3 text-center">
                                                        <i class="fa fa-envelope icon-size mr-2"> <span
                                                                class="ml-3 pricing-head-title text-uppercase">Services
                                                                Par SMS</span></i>
                                                        <br>
                                                        <small class="qty">
                                                            @if ($prestige_sms->maxproducteur != 1)
                                                                Plus de
                                                                {{ $prestige_sms->minproducteur }} Producteurs
                                                            @else
                                                                {{-- {{ $prestige_sms->descriptionpack[0] }} --}}
                                                            @endif
                                                        </small>
                                                    </div>
                                                    <div class="pricing-body">
                                                        <span class="price">{{ $prestige_sms->pricing }}</span>
                                                        <span class="sup"><small>FCFA</small></span>
                                                        @if ($acteur == 'ONG')
                                                            <span class="inf" style="font-style: italic"> Par
                                                                Producteur</span>
                                                        @endif
                                                        @if ($prestige_sms->descriptionpack != null)
                                                            @php
                                                                $count = count($prestige_sms->descriptionpack);
                                                                $res = 6 - $count;
                                                            @endphp
                                                            <ul
                                                                style="@if ($res == 1) padding-bottom:30px !important; @endif @if ($res >= 2) padding-bottom:30px !important; padding-top:35px !important; @endif ">
                                                                @foreach ($prestige_sms->descriptionpack as $key => $item)
                                                                    <li class="li-view text-dark">
                                                                        {{ $item }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                    <div class="pricing-footer">
                                                        <a href="{{ route('packs.validation', [$prestige_sms->id, $prestige_sms->type_entite]) }}"
                                                            class="btn bg-vert-louma text-light rounded-pill">Acheter
                                                            Maintenant</a>
                                                    </div>
                                                </div>
                                                <div class="pricing01 border-0 corner-footer mb-0 styled">
                                                    <div class="pt-3 text-center">
                                                        <i class="fa fa-microphone icon-size mr-2"> <span
                                                                class="ml-3 pricing-head-title text-uppercase">Services
                                                                Par Vocal</span></i>
                                                        <br>
                                                        <small class="qty">
                                                            @if ($prestige_voice->maxproducteur != 1)
                                                                Plus de
                                                                {{ $prestige_voice->minproducteur }} Producteurs
                                                            @else
                                                                {{-- {{ $prestige_voice->descriptionpack[0] }} --}}
                                                            @endif
                                                        </small>
                                                    </div>
                                                    <div class="pricing-body">
                                                        <span class="price">{{ $prestige_voice->pricing }}</span>
                                                        <span class="sup"><small>FCFA</small></span>
                                                        @if ($acteur == 'ONG')
                                                            <span class="inf" style="font-style: italic"> Par
                                                                Producteur</span>
                                                        @endif
                                                        @if ($prestige_voice->descriptionpack != null)
                                                            @php
                                                                $count = count($prestige_voice->descriptionpack);
                                                                $res = 6 - $count;
                                                            @endphp
                                                            <ul
                                                                style="@if ($res == 1) padding-bottom:30px !important; @endif @if ($res >= 2) padding-bottom:30px !important; padding-top:35px !important; @endif ">
                                                                @foreach ($prestige_voice->descriptionpack as $key => $item)
                                                                    <li class="li-view text-dark">
                                                                        {{ $item }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                    <div class="pricing-footer">
                                                        <a href="{{ route('packs.validation', [$prestige_voice->id, $prestige_voice->type_entite]) }}"
                                                            class="btn bg-vert-louma text-light rounded-pill">Acheter
                                                            Maintenant</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Section -->

