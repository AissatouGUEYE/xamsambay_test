@php
    // dd($stats);
@endphp
<div class="funfacts" id="ressources">
    <div class="layer-stretch text-center">
        <div class="layer-wrapper">
            <div class="layer-ttl">
                <h4>CHIFFRES & <span class="vert-louma">DONNEES DE LA BASE</span></h4>
            </div>
            <div class="row align-items-center pt-3 bg-light">
                <div class="col-md-7">
                    <div class="counter-block">
                        <i class="fa fa-circle-user"></i>
                        <h4><span class="counter">{{ $stats['producteur']->producteur }}</span></h4>
                        {{-- <h4><span class="counter">{{ $stats['individuel']->individuel }}</span></h4> --}}
                        <span>PRODUCTEURS</span>
                    </div>
                    <div class="counter-block">
                        <i class="fa fa-users"></i>
                        <h4><span class="counter">{{ $stats['OP']->OP }}</span></h4>
                        <span>ORGANISATION PRODUCTEURS</span>
                    </div>
                    <div class="counter-block">
                        <i class="fa-solid fa-hands-holding"></i>
                        <h4><span class="counter">{{ $stats['ONG']->ONG }}</span></h4>
                        <span>ONG</span>
                    </div>
                    <div class="counter-block">
                        <i class="fa fa-bank"></i>
                        <h4><span class="counter">{{ $stats['financier']->financier }}</span></h4>
                        <span>BANQUES / IMF</span>
                    </div>
                    <div class="counter-block">
                        <i class="fa fa-star"></i>
                        <h4><span class="counter">{{ $stats['mloumer']->mloumer }}</span></h4>
                        <span>MLOUMERS</span>
                    </div>
                    <div class="counter-block">
                        <i class="fa fa-truck"></i>
                        <h4><span class="counter">{{ $stats['transporteur']->transporteur }}</span></h4>
                        <span>TRANSPORTEURS</span>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="testimonial">
                        <div class=" owl-theme theme-owl-dot">
                            <div class="testimonial-block">
                                <div class="testimonial-detail">
                                    <i class="fa fa-quote-right "></i>
                                    <p>"Je veux être accompagné par MLouma
                                        pour mener un projet de transformation
                                        numérique dans ma coopérative ou mon
                                        entreprise de négoce agricole"</p>
                                </div>
                                <div class="testimonial-img">
                                    <img class="image-card" src="{{ asset('assets/images/logo/67788.png') }}"
                                        alt="">
                                    <br>
                                    <a class="btn btn-warning my-4 py-2 rounded-pill hdr-search"> Rejoindre notre
                                        communauté <i class="fa fa-chevron-right"></i></a>
                                    {{-- <span>Daniel Barnes</span>
                                    <p>CEO At Devstab</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- End FUnFacts Section -->
