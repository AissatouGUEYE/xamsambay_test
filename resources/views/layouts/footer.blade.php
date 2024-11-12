<footer class="page-footer footer footer-static footer-dark green  navbar-border navbar-shadow">
    <div class="footer-copyright">
        <div class="container"><span>&copy;
                @php echo date("Y");@endphp <a href="https://www.mlouma.com/" target="_blank">mLouma</a> tous les droits
                réservés</span></div>
    </div>
</footer>

<!-- END: Footer-->

<!-- BEGIN VENDOR JS-->
<script src="{{ asset('assets/js/vendors.min.js') }}"></script>

<!-- BEGIN VENDOR JS-->
<script src="{{ asset('assets/vendors/select2/select2.full.min.js') }}"></script>

<!-- BEGIN PAGE VENDOR JS-->
<script src="{{ asset('assets/vendors/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/vendors/chartjs/chart.min.js') }}"></script>
<script src="{{ asset('assets/vendors/chartist-js/chartist.min.js') }}"></script>
<script src="{{ asset('assets/vendors/chartist-js/chartist-plugin-tooltip.js') }}"></script>
<script src="{{ asset('assets/vendors/chartist-js/chartist-plugin-fill-donut.min.js') }}"></script>
<script src="{{ asset('assets/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/vendors/sweetalert/sweetalert.min.js') }}"></script>


<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>

<script src="{{ asset('assets/js/providers/set_state.js') }}"></script>
<script src="{{ asset('assets/js/crud/gestion/create.js') }}"></script>
<script src="{{ asset('assets/js/crud/gestion/delete.js') }}"></script>
<script src="{{ asset('assets/js/crud/gestion/edit.js') }}"></script>
<script src="{{ asset('assets/js/crud/gestion/update.js') }}"></script>
<script src="{{ asset('assets/js/providers/logout.js') }}"></script>
<script src="{{ asset('assets/js/providers/location.js') }}"></script>
{{-- <script src="{{ asset('assets/js/providers/ferme_profils.js')}}"></script> --}}
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/data-tables.js') }}"></script>
<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->
{{-- <script src="{{asset('assets/js/scripts/dashboard-modern.js')}}"></script> --}}
{{-- <script src="{{asset('assets/js/scripts/intro.js')}}"></script> --}}
{{-- <script src="{{ asset('assets/js/scripts/dashboard-analytics.js')}}"></script> --}}
<script src="{{ asset('assets/js/providers/pluvio.js') }}"></script>
<script src="{{ asset('assets/js/providers/produits.js') }}"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.print.min.js"></script>


{{-- <script src="{{asset('assets/js/analytics/ong-analytics.js')}}"></script> --}}
@yield('other-js-script')
<!-- END PAGE LEVEL JS-->
</body>

</html>
