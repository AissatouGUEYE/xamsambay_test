@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">

    <style>
        .text-center {
            text-align: center;
        }

        #map {
            width: '70%';
            height: 800px;
        }
    </style>
    <link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />
@endsection
@section('main_content')
@section('page-title')
    Stocks
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">Cartographie</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text">Stocks</a>
    </li>
@endsection

<section class="users-list-wrapper section">
    <div class="users-list-filter">
        {{-- <div class="card-panel">
            <div class="row"></div>
        </div> --}}
    </div>

    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <!-- datatable start -->

                {{-- <div>
                    <a type="button" class="waves-effect waves-light  green darken-1 btn modal-trigger right"
                        href="#modal1"><i class="material-icons">add_circle</i> Nouveau Stock de Produit</a>
                </div> --}}


                <div class="row" style='margin-top: 50px'>

                    <div class="col s2">
                        <div id="filter-section">
                            <h3>Stocks</h3>
                            {{-- <label>Région:</label>
                            <select id="reg">
                                <option value="all">Toutes les Régions</option>
                                @foreach ($regions as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['region'] }}</option>
                                @endforeach
                            </select>
                            <br> --}}
                            <label>Catégorie Produit:</label>
                            <select class="browser-default" id="cat_prod" name="cat_produit">
                                <option value="all">Toutes les Catégories</option>
                            </select>
                            <br>
                            <label>Produit:</label>
                            <select class="browser-default" id="prod" name="produit">
                                {{-- <option value="all" hide selected >Tous les Produits</option> --}}
                            </select>
                            <br>
                            <label>Variété:</label>
                            <select class="browser-default" id="var" name="variete">
                                {{-- <option value="all" hide selected>Toutes les Variétés</option> --}}
                            </select>
                            <br>
                            <label>Région:</label>
                            <select class="browser-default" id="reg">
                                <option value="all" selected>Toutes les Régions</option>
                            </select>
                            <br>
                            <label>Département:</label>
                            <select class="browser-default" id="dept">
                            </select>
                            <br>
                            <label>Commune:</label>
                            <select class="browser-default" id="commune">
                            </select>
                        </div>

                        <br>
                        <div id="market-count">
                            <b>Nombre de Stocks :
                                <span class='chip red lighten-5'>
                                    <span id="count" class='red-text'>{{ $nb_stocks }}</span></b>
                                </span>
                        </div>
                    </div>
                    <div class="col s10" id='map'></div>
                </div>


            </div>
        </div>
    </div>

</section>
@endsection

@section('other-js-script')
<script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>

<script src="{{ asset('assets/js/crud/gestion/cartographie/produit.js') }}"></script>

<script>

    var stock_icon = "{{ asset('/assets/images/cartographie/stock.png') }}"

    let map = [];

    let markers = L.layerGroup();
    /* ----------------------------- Initialize Map ----------------------------- */
    function initMap() {
        map = L.map('map', {
            center: {
                lat: 14.6542968,
                lng: -16.2525346,
            },
            zoom: 7.5
        });

        // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     attribution: '© OpenStreetMap'
        // }).addTo(map);

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYWlzc2F0b3VndWV5ZSIsImEiOiJjbGl4NmQ4ZWkwMHliM2ttb291dWRndDMzIn0.XWjSw1rzOeMKg_Pf01At8w', {
            attribution: '© OpenStreetMap',
            id: 'mapbox/streets-v11',
            accessToken: 'pk.eyJ1IjoiYWlzc2F0b3VndWV5ZSIsImEiOiJjbGl4NmQ4ZWkwMHliM2ttb291dWRndDMzIn0.XWjSw1rzOeMKg_Pf01At8w'
        }).addTo(map);

        map.on('click', mapClicked);
        initMarkers();
    }
    initMap();

    /* --------------------------- Initialize Markers --------------------------- */
    function initMarkers() {
        const initialMarkers = <?php echo json_encode($initialMarkers); ?>;

        for (let index = 0; index < initialMarkers.length; index++) {

            const data = initialMarkers[index];
            const marker = generateMarker(data, index);

            if(data.variete != null) {
                marker.addTo(map).bindPopup(`<b> Variété: ${data.variete} <br> Produit: ${data.produit}
                <br> Catégorie: ${data.cat_produit} <br> Prix: ${data.prix} ${data.unite_prix} <br>
                Stock: ${data.stock} ${data.unite_stock}
                <br> Localité: ${data.commune} <br> Commune: ${data.commune}<br> Département: ${data.departement}<br> Région: ${data.region}</b>`);
            }
            else {
                marker.addTo(map).bindPopup(`<b> Produit: ${data.produit}
                <br> Catégorie: ${data.cat_produit} <br> Prix: ${data.prix} ${data.unite_prix} <br>
                Stock: ${data.stock} ${data.unite_stock}
                <br> Localité: ${data.commune} <br> Commune: ${data.commune}<br> Département: ${data.departement} <br> Région: ${data.region}</b>`);
            }

            marker.id_region = data.id_region;
            marker.region = data.region;
            marker.id_departement = data.id_departement;
            marker.departement = data.departement;
            marker.id_commune = data.id_commune;
            marker.commune = data.commune;
            marker.id_localite = data.id_localite;
            marker.localite = data.localite;
            marker.id_cat_produit = data.id_cat_produit;
            marker.cat_produit = data.cat_produit;
            marker.id_produit = data.id_produit;
            marker.produit = data.produit;
            marker.id_variete = data.id_variete;
            marker.variete = data.variete;
            marker.stock = data.stock;
            marker.unite_stock = data.unite_stock;
            marker.prix = data.prix;
            marker.unite_prix = data.unite_prix;
            map.panTo(data.position);
            markers.addLayer(marker);

        }
    }

    function generateMarker(data, index) {

        // Define the URL of the custom marker icon
        // const iconUrl = 'https://leafletjs.com/examples/custom-icons/leaf-green.png';
        const iconUrl = 'https://www.erplain.com/sites/all/themes/erplain_showcase/images/Inventory_Management_icon.png';
        // const shadowUrl = 'https://leafletjs.com/examples/custom-icons/leaf-shadow.png';

        // Create a custom icon
        const icon = L.icon({
            iconUrl: stock_icon,
            // shadowUrl: shadowUrl,
            iconSize: [30, 30],
            iconAnchor: [1, 1],
            // shadowAnchor: [4, 62    ],
            popupAnchor: [1, 1]
        });

        return L.marker(data.position, {
                draggable: data.draggable,
                // icon: icon
            })
            .on('click', (event) => markerClicked(event, index))
            .on('dragend', (event) => markerDragEnd(event, index));

    }

    /* ------------------------- Handle Map Click Event ------------------------- */
    function mapClicked($event) {
        console.log(map);
        console.log($event.latlng.lat, $event.latlng.lng);
    }

    /* ------------------------ Handle Marker Click Event ----------------------- */
    function markerClicked($event, index) {
        console.log(map);
        console.log($event.latlng.lat, $event.latlng.lng);
    }

    /* ----------------------- Handle Marker DragEnd Event ---------------------- */
    function markerDragEnd($event, index) {
        console.log(map);
        console.log($event.target.getLatLng());
    }

    // Add event listeners to the filter section elements to filter the markers based on the selected options

    $('#reg, #dept, #commune, #cat_prod, #prod, #var').on('change', function() {

    var count = 0;

    var selectedRegion = $('#reg').val();
    var selectedDept = $('#dept').val();
    var selectedCommune = $('#commune').val();
    var selectedCat = $('#cat_prod').val();
    var selectedProd = $('#prod').val();
    var selectedVar = $('#var').val();

    markers.eachLayer(function(marker) {

        if (selectedCat === 'all')
        {
            if (selectedRegion === 'all' || selectedRegion === '' || selectedRegion === null)
            {
                marker.addTo(map);
                count++;
            }
            else
            {
                if (selectedDept === 'all' || selectedDept === '' || selectedDept === null)
                {
                    if (marker.id_region === parseInt(selectedRegion))
                    {
                        marker.addTo(map);
                        count++;
                    }
                    else
                    {
                        marker.removeFrom(map);
                    }
                }
                else
                {

                    if (selectedCommune === 'all' || selectedCommune === '' || selectedCommune === null)
                    {
                        if (marker.id_departement === parseInt(selectedDept))
                        {
                            marker.addTo(map);
                            count++;
                        }
                        else
                        {
                            marker.removeFrom(map);
                        }
                    }
                    else
                    {
                        if (selectedLocalite === 'all' || selectedLocalite === '' || selectedLocalite === null)
                        {
                            if (marker.id_commune === parseInt(selectedCommune))
                            {
                                marker.addTo(map);
                                count++;
                            }
                            else
                            {
                                marker.removeFrom(map);
                            }
                        }
                        else
                        {
                            if (marker.id_localite === parseInt(selectedLocalite))
                            {
                                marker.addTo(map);
                                count++;
                            }
                            else
                            {
                                marker.removeFrom(map);
                            }
                        }
                    }

                }
            }

        }
        else
        {
            if(marker.id_cat_produit !== parseInt(selectedCat))
            {
                marker.removeFrom(map);
            }
            else
            {
                if(selectedProd === 'all' || selectedProd === '' || selectedProd === null)
                {

                    if (selectedRegion === 'all' || selectedRegion === '' || selectedRegion === null)
                    {
                        marker.addTo(map);
                        count++;
                    }
                    else
                    {
                        if (selectedDept === 'all' || selectedDept === '' || selectedDept === null)
                        {
                            if (marker.id_region === parseInt(selectedRegion))
                            {
                                marker.addTo(map);
                                count++;
                            }
                            else
                            {
                                marker.removeFrom(map);
                            }
                        }
                        else
                        {

                            if (selectedCommune === 'all' || selectedCommune === '' || selectedCommune === null)
                            {
                                if (marker.id_departement === parseInt(selectedDept))
                                {
                                    marker.addTo(map);
                                    count++;
                                }
                                else
                                {
                                    marker.removeFrom(map);
                                }
                            }
                            else
                            {
                                if (selectedLocalite === 'all' || selectedLocalite === '' || selectedLocalite === null)
                                {
                                    if (marker.id_commune === parseInt(selectedCommune))
                                    {
                                        marker.addTo(map);
                                        count++;
                                    }
                                    else
                                    {
                                        marker.removeFrom(map);
                                    }
                                }
                                else
                                {
                                    if (marker.id_localite === parseInt(selectedLocalite))
                                    {
                                        marker.addTo(map);
                                        count++;
                                    }
                                    else
                                    {
                                        marker.removeFrom(map);
                                    }
                                }
                            }

                        }
                    }
                }
                else
                {
                    if(marker.id_produit !== parseInt(selectedProd))
                    {
                        marker.removeFrom(map);
                    }
                    else
                    {
                        if(selectedVar === 'all' || selectedVar === '' || selectedVar === null)
                        {

                            if (selectedRegion === 'all' || selectedRegion=== '' || selectedRegion === null)
                            {
                                marker.addTo(map);
                                count++;
                            }
                            else
                            {
                                if (selectedDept === 'all' || selectedDept === '' || selectedDept === null)
                                {
                                    if (marker.id_region === parseInt(selectedRegion))
                                    {
                                        marker.addTo(map);
                                        count++;
                                    }
                                    else
                                    {
                                        marker.removeFrom(map);
                                    }
                                }
                                else
                                {

                                    if (selectedCommune === 'all' || selectedCommune === '' || selectedCommune === null)
                                    {
                                        if (marker.id_departement === parseInt(selectedDept))
                                        {
                                            marker.addTo(map);
                                            count++;
                                        }
                                        else
                                        {
                                            marker.removeFrom(map);
                                        }
                                    }
                                    else
                                    {
                                        if (selectedLocalite === 'all' || selectedLocalite === '' || selectedLocalite === null)
                                        {
                                            if (marker.id_commune === parseInt(selectedCommune))
                                            {
                                                marker.addTo(map);
                                                count++;
                                            }
                                            else
                                            {
                                                marker.removeFrom(map);
                                            }
                                        }
                                        else
                                        {
                                            if (marker.id_localite === parseInt(selectedLocalite))
                                            {
                                                marker.addTo(map);
                                                count++;
                                            }
                                            else
                                            {
                                                marker.removeFrom(map);
                                            }
                                        }
                                    }

                                }
                            }
                        }
                        else
                        {
                            if(marker.id_variete !== parseInt(selectedVar))
                            {
                                marker.removeFrom(map);
                            }
                            else
                            {
                                if (selectedRegion === 'all' || selectedRegion === '' || selectedRegion === null)
                                {
                                    marker.addTo(map);
                                    count++;
                                }
                                else
                                {
                                    if (selectedDept === 'all' || selectedDept === '' || selectedDept === null)
                                    {
                                        if (marker.id_region === parseInt(selectedRegion))
                                        {
                                            marker.addTo(map);
                                            count++;
                                        }
                                        else
                                        {
                                            marker.removeFrom(map);
                                        }
                                    }
                                    else
                                    {

                                        if (selectedCommune === 'all' || selectedCommune === '' || selectedCommune === null)
                                        {
                                            if (marker.id_departement === parseInt(selectedDept))
                                            {
                                                marker.addTo(map);
                                                count++;
                                            }
                                            else
                                            {
                                                marker.removeFrom(map);
                                            }
                                        }
                                        else
                                        {
                                            if (selectedLocalite === 'all' || selectedLocalite === '' || selectedLocalite === null)
                                            {
                                                if (marker.id_commune === parseInt(selectedCommune))
                                                {
                                                    marker.addTo(map);
                                                    count++;
                                                }
                                                else
                                                {
                                                    marker.removeFrom(map);
                                                }
                                            }
                                            else
                                            {
                                                if (marker.id_localite === parseInt(selectedLocalite))
                                                {
                                                    marker.addTo(map);
                                                    count++;
                                                }
                                                else
                                                {
                                                    marker.removeFrom(map);
                                                }
                                            }
                                        }

                                    }
                                }
                            }
                        }

                    }


                }

            }

        }

    });

    document.getElementById("count").textContent = count;
    });

    $('#reg, #dept, #commune, #cat_prod, #prod, #var').on('change', function() {

        var count = 0;
        var selectedRegion = $('#reg').val();
        var selectedDept = $('#dept').val();
        var selectedCommune = $('#commune').val();
        var selectedCat = $('#cat_prod').val();
        var selectedProd = $('#prod').val();
        var selectedVar = $('#var').val();

        markers.eachLayer(function(marker) {

            if (selectedRegion === 'all' ) {

                if(selectedCat === 'all')
                {
                    marker.addTo(map);
                    count++;
                }
                else
                {

                    if (selectedProd === 'all' || selectedProd === '' || selectedProd === null)
                    {
                        if (marker.id_cat_produit === parseInt(selectedCat)) {
                            marker.addTo(map);
                            count++;
                        }
                        else {
                                marker.removeFrom(map);
                        }
                    }
                    else {

                        if (selectedVar === 'all' || selectedVar === '' || selectedVar === null)
                        {
                            if (marker.id_produit === parseInt(selectedProd)) {
                                marker.addTo(map);
                                count++;
                            }
                            else {
                                    marker.removeFrom(map);
                            }
                        }
                        else
                        {
                            if (marker.id_variete === parseInt(selectedVar))
                            {
                                    marker.addTo(map);
                                    count++;
                            }
                            else
                            {
                                    marker.removeFrom(map);
                            }
                        }
                    }

                }
            }
            else
            {
                if(marker.id_region !== parseInt(selectedRegion))
                {
                    marker.removeFrom(map);
                }
                else
                if(selectedCat === 'all')
                {
                    marker.addTo(map);
                    count++;
                }
                else
                {

                    if (selectedProd === 'all' || selectedProd === '' || selectedProd === null)
                    {
                        if (marker.id_cat_produit === parseInt(selectedCat)) {
                            marker.addTo(map);
                            count++;
                        }
                        else {
                                marker.removeFrom(map);
                        }
                    }
                    else {

                        if (selectedVar === 'all' || selectedVar === '' || selectedVar === null)
                        {
                            if (marker.id_produit === parseInt(selectedProd)) {
                                marker.addTo(map);
                                count++;
                            }
                            else {
                                    marker.removeFrom(map);
                            }
                        }
                        else
                        {
                            if (marker.id_variete === parseInt(selectedVar))
                            {
                                    marker.addTo(map);
                                    count++;
                            }
                            else
                            {
                                    marker.removeFrom(map);
                            }
                        }
                    }

                }
            }



        });
        document.getElementById("count").textContent = count;
    });

</script>

<script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>

<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>

<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>

<script src="{{ asset('assets/js/crud/gestion/cartographie/localite.js') }}"></script>


@endsection
