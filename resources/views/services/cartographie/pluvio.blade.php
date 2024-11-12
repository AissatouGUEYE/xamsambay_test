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
            width: '100%';
            height: 800px;
        }
    </style>
    <link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />
@endsection
@section('main_content')
@section('page-title')
    Pluvios
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">Cartographie</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text">Pluvios</a>
    </li>
@endsection

<section class="users-list-wrapper section">
    <div class="users-list-filter">
        {{-- <div class="card-panel">
            <div class="row"></div>
        </div> --}}
    </div>
    {{-- <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Nouveau Pluvio</h4>
            <div class="divider mt-2"></div>
            <form method="POST" id="formAddMarket" action="/prix-du-marche/marches/store">
                @csrf
                <div class="row">
                    <div class="input-field col s6">
                        <label for="market" class="active">Nom du marché</label>
                        <input type="text" class="form-control" id="market" name="market">
                    </div>

                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <div class="col s12 display-flex justify-content-end mt-1">
                            <button id="formAddMarketbtn" type="button" class="btn indigo">Enregistrer</button>
                            <a href="#!"
                                class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
        </div>
    </div> --}}

    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <!-- datatable start -->

                {{-- <div>
                    <a type="button" class="waves-effect waves-light  green darken-1 btn modal-trigger right"
                        href="#modal1"><i class="material-icons">add_circle</i> Nouveau Pluvio</a>
                </div> --}}


                <div class="row" style='margin-top: 50px'>

                    <div class="col s2">
                        <div id="filter-section">
                            <h3>Pluvios</h3>
                            <label>Réseau:</label>
                            <select id="reseau">
                                <option value="all">Tous les Réseaux</option>
                                @foreach ($groupements as $item)
                                    <option value="{{ $item['id_groupement'] }}">{{ $item['libelle'] }}</option>
                                @endforeach
                            </select>
                            <br>
                            <label>Région:</label>
                            <select class="browser-default" id="reg">
                                <option value="all" selected>Toutes les Régions</option>
                                {{-- @foreach ($regions as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['region'] }}</option>
                                @endforeach --}}
                            </select>
                            <br>
                            <label>Département:</label>
                            <select class="browser-default" id="dept">
                                {{-- <option value="all">Tous les Départements</option> --}}

                            </select>
                            <br>
                            <label>Commune:</label>
                            <select class="browser-default" id="commune">
                                {{-- <option value="all">Toutes les Communes</option> --}}

                            </select>
                            {{-- <br>
                            <label>Localité:</label>
                            <select class="browser-default" id="localite">
                            </select> --}}
                        </div>

                        <br><br><br>
                        <div id="pluvio-count">
                            <b>Nombre de Pluvios :
                                <span class='chip red lighten-5'>
                                    <span id="count" class='red-text'>{{ $nb_pluvios }}</span></b>
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

<script>

    var pluvio_icon = "{{ asset('/assets/images/cartographie/pluvio.png') }}"

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
            marker.addTo(map).bindPopup(
                `<b> ${data.name}
                    <br> Commune: ${data.commune}<br> Département: ${data.departement}<br> Région: ${data.region}
                    <br> Réseau: ${data.groupement}
                </b>`
            );
            marker.id_region = data.id_region;
            marker.region = data.region;
            marker.id_departement = data.id_departement;
            marker.departement = data.departement;
            marker.id_commune = data.id_commune;
            marker.commune = data.commune;
            marker.id_localite = data.id_localite;
            marker.localite = data.localite;
            marker.id_groupement = data.id_groupement;
            marker.groupement = data.groupement;
            map.panTo(data.position);
            markers.addLayer(marker);
        }
    }

    function generateMarker(data, index) {

        // Define the URL of the custom marker icon
        // const iconUrl = 'https://leafletjs.com/examples/custom-icons/leaf-green.png';
        const iconUrl = 'https://www.osi-perception.org/local/cache-vignettes/L200xH200/jpg_pluviome3294-fd905.jpg';
        // const iconUrl = 'https://img.freepik.com/vecteurs-premium/icone-goutte-eau-ondulations_420555-226.jpg'
        // const shadowUrl = 'https://leafletjs.com/examples/custom-icons/leaf-shadow.png';

        // Create a custom icon
        const icon = L.icon({
            iconUrl: pluvio_icon,
            // shadowUrl: shadowUrl,
            iconSize: [20, 30],
            // iconSize: [20, 60],
            iconAnchor: [1, 1],
            // shadowAnchor: [4, 62],
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

    $('#reseau, #reg, #dept, #commune').on('change', function() {

        var count = 0;

        var selectedReseau = $('#reseau').val();
        var selectedRegion = $('#reg').val();
        var selectedDept = $('#dept').val();
        var selectedCommune = $('#commune').val();
        // var selectedLocalite = $('#localite').val();

        markers.eachLayer(function(marker) {

            if (selectedReseau === 'all')
            {
                if (selectedRegion === 'all')
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

                    }
                }

            }
            else
            {
                if (selectedRegion === 'all')
                {
                    if (marker.id_groupement === parseInt(selectedReseau))
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
                    if (selectedDept === 'all' || selectedDept === '' || selectedDept === null)
                    {
                        if (marker.id_region === parseInt(selectedRegion) && marker.id_groupement === parseInt(selectedReseau))
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
                            if (marker.id_departement === parseInt(selectedDept) && marker.id_groupement === parseInt(selectedReseau))
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

                            if (marker.id_commune === parseInt(selectedCommune) && marker.id_groupement === parseInt(selectedReseau))
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
