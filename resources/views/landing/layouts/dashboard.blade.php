<!-- Start Header Section -->
<header id="header" class="">
    <div class="layer-stretch hdr">
        <div class="tbl animated">
            <div class="tbl-row">

                <!-- Start Header Logo Section logo mlouma -->
                <div class="tbl-cell hdr-logo1 pt">
                    <a href="{{ url('/') }}"><img src="{{ asset('assets/images/logo/Logo_mlouma_v2.png') }}"
                                                  style="height: 80px" alt=""></a>
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
                            <a href="#services" class="mdl-button mdl-js-button mdl-js-ripple-effect">Services
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
                                    class="fa fa-shopping-bag" style="color: #33A644"></i>
                                <span class="badge"></span>
                            </a>
                        </li>
                        @auth
                            <li>
                                <a class="mdl-button mdl-js-button mdl-js-ripple-effect hdr-search2"
                                   href="{{ route('dashboard') }}" title="Tableau de Bord"><span><i
                                            class="fa fa-tachometer" style="color: #33A644"></i> Tableau de Bord</span></a>
                            </li>
                        @else
                            <li>
                                <a class="mdl-button mdl-js-button mdl-js-ripple-effect hdr-search2"
                                   href="{{ route('dashboard') }}" title=" Se connecter"><i class="fa fa-sign-in"
                                                                                            style="color: #33A644"></i></a>
                            </li>
                            <li>
                                <a class="mdl-button mdl-js-button mdl-js-ripple-effect hdr-search2 text-light"
                                   href="{{ route('register') }}" title="Creer un compte">
                                    <i class="fas fa-user-plus" style="color: #33A644"></i>
                                </a>
                            </li>
                        @endauth

                        <li class="mobile-menu-close"><i class="fa fa-times"></i></li>
                    </ul><!-- End Menu Section -->
                    <div id="menu-bar"><a><i class="fa fa-bars"></i></a></div>
                </div>
            </div>
        </div>
        <div class="search-bar animated zoomIn">
            <div class="search-content">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h3 class="text-center">Exprimer vos besoins afin que l'on puisse vous mettre en contact avec
                            un Expert qualifié en la matiere</h3>
                        <form action="/" method="post">
                            @csrf
                            <div class="row mt-4 mr-5 ml-5">
                                <div class="col-md-6">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label form-input">
                                        <input class="mdl-textfield__input" type="text" id="name" name="name"
                                               required>
                                        <label class="mdl-textfield__label" for="name">Prenom & Nom *</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label form-input">
                                        <input class="mdl-textfield__input" type="email" id="email" name="email"
                                               required>
                                        <label class="mdl-textfield__label" for="email">Email *</label>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label form-input">
                                        <input class="mdl-textfield__input" type="text" id="phone">
                                        <label class="mdl-textfield__label" for="phone">Telephone</label>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label form-input">
                                        <input class="mdl-textfield__input" type="text" id="subject" name="subject"
                                               required>
                                        <label class="mdl-textfield__label" for="subject">Objet de la Requete*</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label form-input">
                                        <textarea class="mdl-textfield__input" rows="3" id="message" name="message"
                                                  required></textarea>
                                        <label class="mdl-textfield__label" for="message">Expression de Besoin*</label>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn bg-vert-louma">Envoyer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="search-close"><i class="icon-close"></i></div>
        </div>
    </div>
</header>
<!-- End Header Section -->
<!-- Start Slider Section -->
<div id="slider" class="slider-gradient2">
    <div class="flexslider slider-wrapper">
        <ul class="slides">
            <li>
                <div class="slider-backgroung-image bg-mlouma">
                    <div class="layer-stretch">
                        <div class="slider-search mt-5">
                            <div class="row mt-5 ">
                                <div class="col-lg-5 text-center">
                                    <div class="text-white">
                                        <span class="titre-crm v1">XAM SA MBAY</span>
                                        <br>
                                        <span class="titre-crm v2">Le CRM de l'AgriTech </span>

                                    </div>
                                </div>
                                <div class="col-lg-2"></div>
                                <div class="col-lg-5 center">
                                    <div class="icon-play">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-inline-success video-btn"
                                                data-bs-toggle="modal"
                                                data-src="https://www.youtube.com/embed/aScwVXyqPRA"
                                                data-bs-target="#myModal">
                                            <i class="fa fa-play-circle fa-5x" style="color: #33A644"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col s4 l3 m3  text-center">
                                    <div class="mt-3">
                                        <a href="{{ route('dashboard') }}"
                                           class="mdl-button mdl-js-button btn rounded-pill text-light"
                                           style="background-color: #d16208">Commencer Gratuitement <i
                                                class="fa fa-chevron-right"></i> </a>
                                    </div>
                                </div>
                                <div class="col s4 l3 m3 text-center">
                                    <div class="mt-3">
                                        <a class="btn rounded-pill bg-light mdl-button mdl-js-button mdl-js-ripple-effect hdr-search rencontre"
                                           href="#">Rencontrer un Expert <i
                                                class="fa fa-chevron-right"></i></a>

                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div><!-- End Slider Section -->

<!-- Modal 2-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body">
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always"
                            allow="autoplay" allowfullscreen></iframe>
                </div>

            </div>

        </div>
    </div>
</div>
