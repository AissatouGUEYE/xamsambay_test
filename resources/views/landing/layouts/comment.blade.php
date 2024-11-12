{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous" />

<!-- Font Awesome 5 CSS -->
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css" /> --}}
<div class="body">
    <main>
        <!-- Start DEMO HTML (Use the following code into your project)-->

        <div class="client pt-3 pb-5 ">
            <div class="container">
                <div class="row text-center">
                    <div class="col-12">
                        <h1 class="display-3 fw-bold text-black">Testimonials</h1>
                        <hr class="bg-black mb-4 mt-0 d-inline-block mx-auto" style="width: 100px; height: 3px" />
                        <p class="p-text text-black">Ce que nos clients disent</p>
                    </div>
                </div>
                <div class="row align-items-md-center text-black">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                @isset($message)
                                    <div class="carousel-item active">
                                        <div class="row p-4">
                                            <div class="t-card">
                                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                                                <p class="lh-lg">
                                                    {{ $message[0]['commentaire'] }}
                                                </p>
                                                <i class="fa fa-quote-right" aria-hidden="true"></i><br />
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-2 pt-3">
                                                    <img src="https://th.bing.com/th/id/OIP.HjEil3IpeqDGH8CbGQgsygHaHx?pid=ImgDet&rs=1"
                                                        class="rounded-circle img-responsive img-fluid" />
                                                </div>
                                                <div class="col-sm-10">
                                                    <div class="arrow-down d-none d-lg-block"></div>
                                                    <h4><strong> {{ $message[0]['pseudo'] }}</strong></h4>
                                                    <p class="testimonial_subtitle">
                                                        <span>Client</span><br />

                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @foreach ($message as $item)
                                        <div class="carousel-item ">
                                            <div class="row p-4">
                                                <div class="t-card">
                                                    <i class="fa fa-quote-left" aria-hidden="true"></i>
                                                    <p class="lh-lg">
                                                        {{ $item['commentaire'] }}
                                                    </p>
                                                    <i class="fa fa-quote-right" aria-hidden="true"></i><br />
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-2 pt-3">
                                                        <img src="https://th.bing.com/th/id/OIP.HjEil3IpeqDGH8CbGQgsygHaHx?pid=ImgDet&rs=1"
                                                            class="rounded-circle img-responsive img-fluid" />
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <div class="arrow-down d-none d-lg-block"></div>
                                                        <h4><strong> {{ $item['pseudo'] }}</strong></h4>
                                                        <p class="testimonial_subtitle">
                                                            <span>Client</span><br />
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endisset

                            </div>
                        </div>
                        <div class="controls push-right">
                            <a class="left fa fa-chevron-left text-black btn btn btn-outline-light"
                                href="#carouselExampleCaptions" data-bs-slide="prev"></a>
                            <a class="right fa fa-chevron-right text-black btn btn btn-outline-light"
                                href="#carouselExampleCaptions" data-bs-slide="next"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="formulaire pt-5 pb-5 ">
            <div class="container">
                <div class="row text-center">
                    <div class="col-12">
                        <h1 class="display-3 fw-bold text-black">Commentaire</h1>
                        <div class="formmessage">Success/Error Message Goes Here</div>
                        <p class="p-text text-black">Dites-nous ce que vous pensez.</p>
                    </div>
                </div>
                <div class="align-items-md-center text-black">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <form id="commentform" method="post" action="{{ url('/louma/temoignage') }}">
                            @csrf
                            <div class="contact-form clearfix">
                                <div class="row">
                                    <div class="input">
                                        <label for="">Pseudo</label>
                                        <input class="form-control pseudo lh-lg" type="text"
                                            placeholder="Entrez votre pseudo" name="pseudo" />
                                    </div>
                                    <div class="input">
                                        <label for="">Message</label>
                                        <textarea class="form-control lh-lg" name="message" placeholder="Entrez votre message" id="" cols="20"
                                            rows="5"></textarea>
                                    </div>
                                </div>
                                @auth
                                    <button id="submit" type="submit" class="btn bg-vert-louma text-light mt-3">
                                        Envoyer
                                    </button>
                            </form>
                        @else
                            </form>
                            <a href="{{ url('/temoignage/connect') }}" class="btn bg-vert-louma text-light mt-3">Se
                                connecter pour continuer

                            </a>
                        @endauth
                    </div>

                    <div id="ajaxloader" style="display:none"><img class="mx-auto mt-30 mb-30 d-block"
                            src="{{ asset('assets/images/loader/loader-02.svg') }}" alt=""></div>
                </div>
            </div>
        </div>
</div>

<!-- END EDMO HTML (Happy Coding!)-->
</main>
</div>
