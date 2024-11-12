<style>
    .notification_icon {
        position: relative;
    }

    .notification_icon .badge {
        position: absolute;
        top: -7px;
        right: -1px;
        background-color: #a2673b;
        color: white;
        border-radius: 30%;
        padding: 4px;
        font-size: 12px;
        font-weight: bold;
        margin-top: 30px;
    }
</style>
<!-- Start Header Section -->
<header id="header2" class="">
    <div class="layer-stretch hdr">
        <div class="tbl animated ">
            <div class="tbl-row">
                <!-- Start Header Logo Section logo mlouma -->
                <div class="tbl-cell hdr-logo1 pt">
                    <a href="{{ url('/') }}"><img src="{{ asset('assets/images/logo/Logo_mlouma_v2.png') }}"
                                                  alt=""></a>
                </div>
                <!-- End Header Logo Section -->
                <div class="tbl-cell hdr-menu">
                    <!-- Start Menu Section -->
                    <ul class="menu">
                        <li class="">
                            <a href="{{ url('/') }}"
                               class="mdl-button mdl-js-button mdl-js-ripple-effect">Accueil</a>
                        </li>
                        <li>
                            <a href="{{ url('/' . '#services') }}"
                               class="mdl-button mdl-js-button mdl-js-ripple-effect">Services
                            </a>
                        </li>

                        <li class="">
                            <a href="{{ url('/shop') }}" class="mdl-button mdl-js-button mdl-js-ripple-effect">Le
                                louma</a>
                        </li>


                        <li style="">
                            <a href="{{ route('opportunites.offres') }}"
                               class="mdl-button mdl-js-button mdl-js-ripple-effect">Opportunités
                            </a>
                        </li>

                        <li style="margin-right: 8%">
                            <a href="{{ url('/offres') }}" class="mdl-button mdl-js-button mdl-js-ripple-effect">Packs
                            </a>
                        </li>
                        <li>
                            <a class="mdl-button mdl-js-button mdl-js-ripple-effect hdr-search2 notification_icon"
                               href="{{ url('/monPanier/produits') }}" title=" Mon panier"><i
                                    class="fa fa-shopping-bag" style="color: #fff" id="icon"></i>
                                <span class="badge">0</span>
                            </a>
                        </li>
                        @auth
                            <li>
                                <a class="mdl-button mdl-js-button mdl-js-ripple-effect hdr-search2"
                                   href="{{ route('dashboard') }}" title="Tableau de Bord"> <span> <i
                                            class="fa fa-tachometer" style="color: #fff"></i> Tableau de Bord</span></a>
                            </li>
                        @else
                            <li>
                                <a class="mdl-button mdl-js-button mdl-js-ripple-effect hdr-search2"
                                   href="{{ route('dashboard') }}" title=" Se connecter"><i class="fa fa-sign-in"
                                                                                            style="color: #fff"></i></a>
                            </li>
                            <li>
                                <a class="mdl-button mdl-js-button mdl-js-ripple-effect hdr-search2 text-light"
                                   href="{{ route('register') }}" title="Creer un compte">
                                    <i class="fas fa-user-plus" style="color: #fff"></i>
                                </a>
                            </li>
                        @endauth
                        <li class="mobile-menu-close"><i class="fa fa-times"></i></li>
                    </ul><!-- End Menu Section -->
                    <div id="menu-bar"><a><i class="fa fa-bars"></i></a></div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End Header Section -->

<!-- Start Page Title Section -->
<div class="page-ttl page-dark">
    <div class="layer-stretch">
        <div class="page-ttl-container">
            <h1 class="text-dark">Mes commandes </h1>
        </div>
    </div>
</div>
<!-- End Page Title Section -->
