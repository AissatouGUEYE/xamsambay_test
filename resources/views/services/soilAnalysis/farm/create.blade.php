@extends('layouts.master')
@section('other-css-files')
    <style>
        .text-center {
            text-align: center;
        }

        #map {
            height: 500px;
        }
    </style>
    <link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />
@endsection
@section('page-title')
    Analyse du Sol
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('soil.analysis') }}">Analyse du Sol</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text" href="#">
            Nouvelle Parcelle
        </a>
    </li>
@endsection
@section('main_content')
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                Formulaire de Création d'une nouvelle Parcelle
                <div class="row padding-2">
                    <div class="col l7 s12 padding-4">
                        <form method="POST" id="" action="{{ route('store.farm') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="libelle" type="text" class="validate" name="libelle" required>
                                    <label class="active" for="libelle">Nom Parcelle</label>
                                    @error('libelle')
                                        <span class="red-text"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="select-field col s12">
                                    <select id="produitData" type="text" class="validate" name="produitData" required>
                                        <option value="">Choisissez le Produit</option>
                                        @foreach ($crops as $crop)
                                            <option value="{{ $crop->data->id }}/{{ $crop->data->crop_name }}">
                                                {{ $crop->data->crop_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label class="active" for="produitData">Libelle</label>
                                    @error('produitData')
                                        <span class="red-text"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="rendement" type="text" class="validate" name="rendement" required>
                                    <label class="active" for="rendement">Rendement Previsionnel (ha) </label>
                                    @error('rendement')
                                        <span class="red-text"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input id="lat1" type="text" class="validate" name="lat1" required>
                                    <label class="active" for="lat1">Latitude Point 1</label>
                                    @error('lat1')
                                        <span class="red-text"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-field col s6">
                                    <input id="long1" type="text" class="validate" name="long1" required>
                                    <label class="active" for="long1">Longitude Point 1</label>
                                    @error('long1')
                                        <span class="red-text"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input id="lat2" type="text" class="validate" name="lat2">
                                    <label class="active" for="lat2">Latitude Point 2</label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="long2" type="text" class="validate" name="long2">
                                    <label class="active" for="long2">Longitude Point 2</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input id="lat3" type="text" class="validate" name="lat3">
                                    <label class="active" for="lat3">Latitude Point 3</label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="long3" type="text" class="validate" name="long3">
                                    <label class="active" for="long3">Longitude Point 3</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input id="lat4" type="text" class="validate" name="lat4">
                                    <label class="active" for="lat4">Latitude Point 4</label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="long4" type="text" class="validate" name="long4">
                                    <label class="active" for="long4">Longitude Point 4</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <div class="row" id="load"></div>
                                    <div class="col s12 display-flex justify-content-end mt-1">
                                        <button type="submit" class="btn indigo">
                                            Enregistrer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col l5 s12">
                        <div>
                            <div class="card">
                                <div class="card-header padding-2">
                                    Selectionner un point de la parcelle sur la carte et repertoriez les coordonnes sur le
                                    formulaire
                                </div>
                                <div class="card-content">
                                    <form action="" class="form">
                                        <input type="text" id="latitude" placeholder="latitude">
                                        <input type="text" id="longitude" placeholder="longitude">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="map">

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('other-js-script')
    <script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>

    <script>
        var market_icon = "{{ asset('/assets/images/cartographie/market.png') }}"

        // console.log(market_icon);

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

            L.tileLayer(
                'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYWlzc2F0b3VndWV5ZSIsImEiOiJjbGl4NmQ4ZWkwMHliM2ttb291dWRndDMzIn0.XWjSw1rzOeMKg_Pf01At8w', {
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

        }

        let marker = null;
        map.on('click', (event) => {

            if (marker !== null) {
                map.removeLayer(marker);
            }

            marker = L.marker([event.latlng.lat, event.latlng.lng]).addTo(map);

            document.getElementById('latitude').value = event.latlng.lat;
            document.getElementById('longitude').value = event.latlng.lng;
        });

        function generateMarker(data, index) {

            // Define the URL of the custom marker icon
            const iconUrl =
                'data:image/jpeg;base64,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';

            const iconUrl2 =
                'https://e7.pngegg.com/pngimages/564/403/png-clipart-farmers-market-marketplace-marketplace-farmers-market-marketplace.png';

            const icon = L.icon({
                iconUrl: iconUrl,
                // shadowUrl: shadowUrl,
                iconSize: [20, 30],
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
