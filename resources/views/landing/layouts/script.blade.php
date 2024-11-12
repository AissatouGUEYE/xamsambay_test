<!-- **********Included Scripts*********** -->


<!-- Jquery Library 2.1 JavaScript-->
<script src="{{ asset('assets/landing/plugin/jquery/jquery-2.1.4.min.js') }}"></script>
{{-- <script src="{{ asset('assets/landing/plugin/jquery/jquery-2.1.4.min.js') }}"></script> --}}
{{-- <!-- Popper JavaScript--> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script> --}}
{{-- <!-- Bootstrap Core JavaScript--> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script> --}}


{{-- Bootstrap 5 --}}

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>


<!-- Modernizr Core JavaScript-->
<script src="{{ asset('assets/landing/plugin/modernizr/modernizr.js') }}"></script>
<!-- Animaateheading JavaScript-->
<script src="{{ asset('assets/landing/plugin/animateheading/animateheading.js') }}"></script>
<!-- Material Design Lite JavaScript-->
<script src="{{ asset('assets/landing/plugin/material/material.min.js') }}"></script>
<!-- Material Select Field Script -->
<script src="{{ asset('assets/landing/plugin/material/mdl-selectfield.min.js') }}"></script>
<!-- Flexslider Plugin JavaScript-->
<script src="{{ asset('assets/landing/plugin/flexslider/jquery.flexslider.min.js') }}"></script>
<!-- Owl Carousel Plugin JavaScript-->
<script src="{{ asset('assets/landing/plugin/owl_carousel/owl.carousel.min.js') }}"></script>
<!-- Scrolltofixed Plugin JavaScript-->
<script src="{{ asset('assets/landing/plugin/scrolltofixed/jquery-scrolltofixed.min.js') }}"></script>
<!-- Magnific Popup Plugin JavaScript-->
<script src="{{ asset('assets/landing/plugin/magnific_popup/jquery.magnific-popup.min.js') }}"></script>
<!-- WayPoint Plugin JavaScript-->
<script src="{{ asset('assets/landing/plugin/waypoints/jquery.waypoints.min.js') }}"></script>
<!-- CounterUp Plugin JavaScript-->
<script src="{{ asset('assets/landing/plugin/counterup/jquery.counterup.js') }}"></script>
<!-- masonry Plugin JavaScript-->
<script src="{{ asset('assets/landing/plugin/masonry_pkgd/masonry.pkgd.min.js') }}"></script>
<!-- SmoothScroll Plugin JavaScript-->
<script src="{{ asset('assets/landing/plugin/smoothscroll/smoothscroll.min.js') }}"></script>
<!--Custom JavaScript-->
<script src="{{ asset('assets/landing/dist/js/custom.js') }}"></script>
<script src="{{ asset('assets/landing/dist/js/modal.js') }}"></script>

{{-- data-table --}}
<script src="{{ asset('assets/js/scripts/data-tables.js') }}"></script>
<script src="{{ asset('assets/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>

<script src="{{ asset('assets\js\providers\shop.js') }}"></script>
<script src="{{ asset('assets\js\providers\count_panier.js') }}"></script>
<script src="{{ asset('assets\js\providers\location.js') }}"></script>

{{-- select2 --}}
<script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>
<script src="{{ asset('assets/vendors/select2/select2.full.min.js') }}"></script>


<script>
    $(document).ready(function() {
        window.addEventListener('scroll', () => {
            const scrolled = window.scrollY;
            // console.log(scrolled);
            if (scrolled >= 568) {
                $('#header').addClass('header-bg');
            } else {
                $('#header').removeClass('header-bg');

            }
            if (scrolled >= 160) {
                $('#header2').addClass('header-bg');
            } else {
                $('#header2').removeClass('header-bg');

            }
        })
    });
</script>
