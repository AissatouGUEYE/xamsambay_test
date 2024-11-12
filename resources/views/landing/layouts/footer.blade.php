<footer id="footer">
    <div class="layer-stretch">
        <!-- Start main Footer Section -->
        <div class="row">
            <div class="col-md-3 col-sm-4">
                <div class="d-flex justify-content-around mx-2 mt-4 footer-img">
                    {{-- -- images -- --}}
                    <img src="{{ asset('assets/images/logo/logo_icco.svg') }}" alt="ICCO logo"/>
                    <img src="{{ asset('assets/images/logo/logo_UNCDF.svg') }}" alt="UNCDF logo"/>
                </div>
            </div>
            <div class="col-md-3 col-sm-4">
                <div class="d-flex justify-content-around mx-2 mt-4 footer-img">
                    {{-- -- images -- --}}
                    <img src="{{ asset('assets/images/logo/logo-pam.png') }}" alt="PAM logo"/>
                    <img src="{{ asset('assets/images/logo/logo-meda.png') }}" alt="MEDA logo"/>
                </div>
            </div>
            <div class="col-md-3 col-sm-4">
                <div class="d-flex justify-content-around mx-2 mt-4 footer-img">
                    {{-- -- images -- --}}
                    <img src="{{ asset('assets/images/logo/logo_rikoltsvg.svg') }}" alt="RIKOLTO logo"/>
                    <img src="{{ asset('assets/images/logo/logo_jica.svg') }}" alt="JICA logo"/>
                </div>
            </div>
            <div class="col-md-3 col-sm-4">
                <div class="d-flex justify-content-around mx-2 mt-4 footer-img">
                    {{-- -- images -- --}}
                    <img src="{{ asset('assets/images/logo/logo_mastercard.svg') }}" alt="MASTERCARD logo"/>
                    <img src="{{ asset('assets/images/logo/logo_orange.svg') }}" alt="ORANGE logo"/>
                </div>
            </div>
        </div>
        <div class="row layer-wrapper">
            <div class="col-md-5 footer-block">
                <div class="footer-ttl">
                    <p>Basic Info</p>
                </div>
                <div class="footer-container footer-a">
                    <div class="tbl">
                        <div class="tbl-row">
                            <div class="tbl-cell"><i class="fa fa-map-marker"></i></div>
                            <div class="tbl-cell">
                                <p class="paragraph-medium paragraph-white">
                                    Immeuble Adja Aby Gueye, Appt 4B<br/>
                                    Rond Point Cité Keur GORGUI,Dakar, Sénégal
                                </p>
                            </div>
                        </div>
                        <div class="tbl-row">
                            <div class="tbl-cell"><i class="fa fa-phone"></i></div>
                            <div class="tbl-cell">
                                <p class="paragraph-medium paragraph-white"> +221 33 868 41 42 | +221 77 245
                                    40
                                    40</p>
                            </div>
                        </div>
                        <div class="tbl-row">
                            <div class="tbl-cell"><i class="fa fa-envelope"></i></div>
                            <div class="tbl-cell">
                                <a href="mailto:contact@mlouma.com"
                                   class="paragraph-medium paragraph-white">contact@mlouma.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 footer-block">
                <div class="footer-ttl">
                    <p>Quick Links</p>
                </div>
                <div class="footer-container footer-b">
                    <div class="tbl">
                        {{-- <div class="tbl-row">
                            <ul class="tbl-cell">
                                 <li><a href="#">Home</a></li>
                                <li><a href="about-1.html">About</a></li>
                                <li><a href="event-1.html">Event</a></li>
                                <li><a href="contact-1.html">Contact</a></li>
                                <li><a href="portfolio-1.html">Portfolio</a></li>
                                <li><a href="#">Link</a></li>
                            </ul>
                            <ul class="tbl-cell">
                                {{-- <li><a href="signin.html">Sign In</a></li>
                                <li><a href="signup.html">Sign Up</a></li>
                                <li><a href="services-1.html">Services</a></li>
                                <li><a href="Blogs-1.html">Blogs</a></li>
                                <li><a href="Blog-1.html">Blog</a></li>
                                <li><a href="team-1.html">Team</a></li>
                                <li><a href="faq.html">Faq</a></li>
                            </ul>
                        </div> --}}

                    </div>
                </div>
                <p class="text-center"><i class="fa fa-globe fa-2x"></i> <a href="https://www.mlouma.com/"
                                                                            target="_blank" class="text-lg">
                        www.mlouma.com </a></p>
            </div>
            <div class="col-md-4 footer-block">
                <div class="footer-ttl">
                    <p>Newsletter</p>
                </div>
                <div class="footer-container footer-c">
                    <div class="footer-subscribe">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label form-input">
                            <input class="mdl-textfield__input" type="text"
                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" id="subscribe-email">
                            <label class="mdl-textfield__label" for="subscribe-email">Your Email</label>
                            <span class="mdl-textfield__error">Please Enter Valid Email!</span>
                        </div>
                        <div class="footer-subscribe-button">
                            <button
                                class="mdl-button mdl-js-button mdl-js-ripple-effect button button-primary">Submit
                            </button>
                        </div>
                    </div>
                    <ul class="mt-3 social-list social-list-colored footer-social">
                        <li>
                            <a href="#" target="_blank" id="footer-facebook" class="fa-brands fa-facebook"
                               style="text-decoration:none"></a>
                            <span class="mdl-tooltip mdl-tooltip--top" data-mdl-for="footer-facebook">Facebook</span>
                        </li>
                        <li>
                            <a href="#" target="_blank" id="footer-twitter" class="fab fa-twitter"
                               style="text-decoration:none"></a>
                            <span class="mdl-tooltip mdl-tooltip--top" data-mdl-for="footer-twitter">Twitter</span>
                        </li>
                        <li>
                            <a href="#" target="_blank" id="footer-google" class="fab fa-google"
                               style="text-decoration:none"></a>
                            <span class="mdl-tooltip mdl-tooltip--top" data-mdl-for="footer-google">Google</span>
                        </li>
                        <li>
                            <a href="#" target="_blank" id="footer-instagram" class="fab fa-instagram"
                               style="text-decoration:none"></a>
                            <span class="mdl-tooltip mdl-tooltip--top" data-mdl-for="footer-instagram">Instagram</span>
                        </li>
                        <li>
                            <a href="#" target="_blank" id="footer-youtube" class="fab fa-youtube"
                               style="text-decoration:none"></a>
                            <span class="mdl-tooltip mdl-tooltip--top" data-mdl-for="footer-youtube">Youtube</span>
                        </li>
                        <li>
                            <a href="#" target="_blank" id="footer-linkedin" class="fab fa-linkedin"
                               style="text-decoration:none"></a>
                            <span class="mdl-tooltip mdl-tooltip--top" data-mdl-for="footer-linkedin">Linkedin</span>
                        </li>
                        {{-- <li>
                            <a href="#" target="_blank" id="footer-flickr" class="fab fa-flickr"></a>
                            <span class="mdl-tooltip mdl-tooltip--top" data-mdl-for="footer-flickr">Flickr</span>
                        </li>
                        <li>
                            <a href="#" target="_blank" id="footer-rss" class="fab fa-rss"></a>
                            <span class="mdl-tooltip mdl-tooltip--top" data-mdl-for="footer-rss">Rss</span>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- End main Footer Section -->
    <!-- Start Copyright Section -->
    <div id="copyright">
        <div class="layer-stretch d-flex align-items-center justify-content-around">
            <div>
                <a class="text-white" href="{{route('cgu')}}">Conditions Generales d'Utilisations</a>
            </div>
            <div class="paragraph-medium paragraph-white">&copy;
                @php echo date("Y");@endphp <a href="https://www.mlouma.com/" target="_blank">mLouma</a> All rights
                reserved.
            </div>
            <div>
                <a class="text-white" href="{{route('cp')}}">Politiques de
                    Confidentialites</a>
            </div>
        </div>
    </div><!-- End of Copyright Section -->
</footer><!-- End of Footer Section -->
</div>
