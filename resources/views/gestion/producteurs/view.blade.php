@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/producteurs-table.css') }}">
    <style>
        .text-center {
            text-align: center;
        }

        #map {
            width: '70%';
            height: 700px;
        }
    </style>
    <link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />
@endsection
@section('page-title')
    Producteurs
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item active ">
        <a href="/producteurs">Producteurs</a>
    </li>

    <li class="breadcrumb-item active yellow-text">Producteur
    </li>
@endsection
@php
    // dd($producteur);
@endphp
@section('main_content')
    <div class="section users-view">
        {{-- {{dd($producteur)}} --}}
        <!-- users view media object start -->
        @if (empty($producteur))
            <div class="card">
                <div class="card-content">
                    Information non disponible sur notre base de donnees

                </div>
            </div>
        @else
            <div class="card-panel">
                <div class="row">
                    <div class="col s8 m7">
                        <div class="display-flex media">
                            <a href="#" class="avatar">
                                <img @if (isset($producteur->logo) && $producteur->logo != '') src="{{ asset('storage/' . $producteur->logo) }}"  @else src="{{ asset('assets/images/avatar/person-icon.png') }}" @endif
                                    alt="users view avatar" class="z-depth-4 circle" height="64" width="64">
                            </a>
                            <div class="media-body">
                                <h6 class="media-heading">
                                    <span class="users-view-name">{{ $producteur->prenom }}</span>
                                    <span class="grey-text">@</span>
                                    <span class="users-view-username grey-text">{{ $producteur->nom }}</span>
                                </h6>
                                @if (isset($producteur->role))
                                    <span>Role:</span>
                                    <span class="users-view-id">{{ $producteur->role }}</span>
                                @else
                                    <span>Entite:</span>
                                    <span class="users-view-id">{{ $producteur->nom_entite }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div>
                        <a class="waves-effect waves-light  green darken-1 btn modal-trigger right"
                                    href="#modal-terre">
                                    <i class="material-icons">add</i> Nouvelle declarations de terres
                        </a>
                    </div>
                    <div class="col s4 m5">
                        <div class="display-flex media mt-2">
                            <div class="media-body">
                                @if (isset($meteombay) && $meteombay != 'null')
                                    <span>Producteur Meteo Mbay</span>
                                    <br>
                                @endif
                                @if (isset($prix) && $prix != 'null')
                                    <span>Producteur Prix du Marche</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- users view media object ends -->
            <!-- users view card data start -->
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12 m12">
                            <table class="striped">
                                <tbody>
                                    <tr>
                                        <td>Telephone:{{ $producteur->telephone }}</td>
                                        <td></td>
                                        <td>Mail:{{ $producteur->email }}</td>
                                        <td></td>
                                        <td>Adresse: {{ $producteur->localite }},
                                            {{ $producteur->commune }},{{ $producteur->departement }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Fonction:
                                        </td>
                                        <td></td>
                                        <td>Entite: {{ $producteur->nom_entite }}</td>
                                        <td></td>
                                        <td>Date d'inscription: </td>

                                    </tr>
                                    <tr>
                                        <td>Utilisateur: {{ $producteur->login }}</td>
                                        <td></td>
                                        <td>Desc: {{ $producteur->description }}</td>
                                        <td></td>
                                        @if ($producteur->actif == 0)
                                            <td>Statut: <span
                                                    class=" users-view-status chip red lighten-5 red-text">Inactif</span>
                                            </td>
                                        @else
                                            <td>Statut: <span
                                                    class=" users-view-status chip green lighten-5 green-text">Actif</span>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        {{-- <td></td> --}}
                                        {{-- @if (isset($producteur->groupement))
                                        <td> Groupement : {{ $producteur->nom_groupement }} </td>
                                    @endif
                                    <td></td> --}}
                                        @if (isset($producteur->pluvio))
                                            <td> Pluvio : {{ $producteur->pluvio }} </td>
                                            {{-- <td> Localité : {{ $producteur->pluvio }} </td> --}}
                                        @endif
                                        {{-- <td></td> --}}
                                        @if (isset($producteur->produit_prix) && $producteur->produit_prix != 'null')
                                            <td> Produit : {{ $producteur->produit_prix }}

                                            </td>
                                            <td>
                                                Region : {{ ucfirst(strtolower($producteur->region_prix)) }}
                                            </td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-content">
                    {{-- <div class="row">
                        <div class="col s12 m12"> --}}
                            @if (in_array($_SESSION['role'],["ADMIN","SUPERADMIN","ONG"]))
                                <div class="" id='map'></div>
                            @elseif (in_array($_SESSION['role'],["GERANT","MLOUMER","PRODUCTEUR"]))

                                    <table id="producteurTable" class="table display">
                                        <thead>

                                                <th>Superficie</th>
                                                <th>Type</th>
                                                <th>Action</th>


                                        </thead>
                                        <tbody id="tbody-terre">

                                                {{-- @foreach ($producteurs as $producteur) --}}



                                    </tbody>
                                    <tfoot>
                                        {{-- <tr> --}}
                                            <th>Superficie</th>
                                            <th>Type</th>
                                            <th>Action</th>


                                        {{-- </tr> --}}
                                    </tfoot>
                                    </table>

                            @endif

                        {{-- </div>

                    </div> --}}
                </div>
            </div>
        @endif
        <div id="modal-terre" class="modal">
            <div class="modal-content">
                <h4>Nouvelle declaration</h4>
                <div class="divider mt-2"></div>
                <form id="form-terre-declaration" method="POST" action="#">
                    <input type="number" value="{{$producteur->id_profil}}" name="profil" hidden>
                    @csrf
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field col s6">
                                <select class="browser-default" id="" name="type_sol">
                                    <option value="" disabled selected>--Type de sol</option>
                                    <option value="1">Dior</option>
                                </select>
                                <label class="active" for="pays">Type de sol</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="surface" type="number" class=""
                                    name="surface">
                                <label class="active" for="surface">Surface en m2</label>
                            </div>
                        </div>

                        <div class="row">
                            <a id="btn-terre-declaration"
                                class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</a>
                        </div>
                        <div class="modal-footer">
                            <a href="#!"
                                class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </div>

    {{-- @include('gestion.producteurs.edit') --}}
@endsection



@section('other-js-script')

<script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>

<script>
        $.ajax({
            url: "/terre/list/"+{{$producteur->id_profil}},
            method: "GET",
            headers: {"X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr("content")},
            contentType: false,
            processData: false,
            success: (res) => {
                        // alert(res.data)
                let marker = L.layerGroup();

                var mapOptions = {center: {lat: 14.3943095, lng:-15.349783},zoom: 7.5}
                var map = new L.map('map', mapOptions); // Creating a map object
                var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
                map.addLayer(layer);
                $.each(res, function (i) {

                    for (let index = 0; index < res.data.length; index++) {
                        // const element = array[index];
                        console.log(res.data[index].latitude, res.data[index].longitude)
                        L.marker([res.data[index].latitude, res.data[index].longitude]).addTo(map)
                        .bindPopup(`<ul><li><b>Superficie</b>:${res.data[index].surface} m2</li><li><b>Type</b>:${res.data[index].type_sol}</li></ul>`)
                        .openPopup();
                    }


                    // var el = `<ul><li><b>Superficie</b>:${res.data.surface} m2</li><li><b>Type</b>:${res.data.type_sol}</li></ul>`
                    // marker.bindPopup("ca marche").openPopup();
                    // marker.addTo(map); // Adding marker to the map

                });

                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload()
                    },
                });

</script>
<script>
    $.ajax({
        url: "/terre/list/"+{{$producteur->id_profil}},
        method: "GET",
        headers: {"X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr("content")},
        contentType: false,
        processData: false,
        success: (res) => {
                    // alert(res.data)

            $.each(res, function (i) {

                for (let index = 0; index < res.data.length; index++) {


                    // const element = array[index];
                    console.log(res.data[index].latitude, res.data[index].longitude)
                    L.marker([res.data[index].latitude, res.data[index].longitude]).addTo(map)
                    .bindPopup(`<ul><li><b>Superficie</b>:${res.data[index].surface} m2</li><li><b>Type</b>:${res.data[index].type_sol}</li></ul>`)
                    .openPopup();
                }


                // var el = `<ul><li><b>Superficie</b>:${res.data.surface} m2</li><li><b>Type</b>:${res.data.type_sol}</li></ul>`
                // marker.bindPopup("ca marche").openPopup();
                // marker.addTo(map); // Adding marker to the map

            });

            },
                error: () => {
                    swal({
                        title: "Erreur",
                        icon: "error",
                        text: res.message,
                        timer: 2000,
                        buttons: false,
                    });
                    location.reload()
                },
            });

</script>

@if (in_array($_SESSION['role'],["GERANT","MLOUMER","PRODUCTEUR"]))
@include('gestion.producteurs.edit')
<script>
    $(document).ready(function () {
        $.ajax({
            url: "/terre/list/"+{{$producteur->id_profil}},
            method: "GET",
            headers: {"X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr("content")},
            contentType: false,
            processData: false,
            success: (res) => {
                let el = $("#tbody-terre")
                $.each(res, function (i) {

                    for (let index = 0; index < res.data.length; index++) {

                        el.append(`<tr>
                            <td>${res.data[index].surface} m2</td>
                                <td>${res.data[index].type_sol}</td>
                                <td>
                                <span><a data-id='${res.data[index].id}' href='#terreEditModal' class='modal-trigger terre-edit'><i class="material-icons">edit</i></a></span>
                                <span><a id='${res.data[index].id}' href='#!' class='terre-delete'><i class="material-icons">delete</i></a></span>

                                </td>
                            </tr>`);

                    }


                });

                $(".terre-edit").click(function (e) {
                    e.preventDefault();
                    let id = $(this).attr("data-id");
                    let editForm = new FormData($("#form-terre-edit")[0])
                    $.ajax({
                        url: "/terre/edit/" + id,
                        method: "GET",
                        headers: {
                            // 'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
                            "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },

                        success: (res) => {

                            $(".label-edit").attr("class","label-edit active")
                            $("input#id").attr("value" , res.id)
                            $("select#type_sol").append(`<option value='${res.id_type_sol}' selected>${res.type_sol}</option>` )
                            $("input#surface").attr("value" , res.surface)
                        },
                        error: () => {
                            swal({
                                title: "Erreur",
                                icon: "error",
                                text: res.message,
                                timer: 2000,
                                buttons: false,
                            });
                            // location.reload()
                        },
                    });

                });

                $('.terre-delete').click(function (e) {
                e.preventDefault();
                    let id = $(this).attr('id')
                    // alert(id)
                    swal({
                        title: "Etes-vous sure",
                        text: "Voulez-vous supprimer l'enregistrement",
                        icon: 'warning',
                        dangerMode: true,
                        buttons: {
                            cancel: 'Annuler',
                            delete: 'Oui'
                        }
                    }).then(function (willDelete) {
                        if (willDelete) {
                            $.ajax({
                                url: "/terre/delete/"+id,
                                method: 'delete',
                                headers: {
                                    // 'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
                                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content'),

                                },
                                // data: $('#form-campagne-update').serialize(),
                                // dataType:'JSON',
                                success: (res) => {
                                    // alert(res)
                                    swal({
                                        title: 'Success',
                                        icon: 'success',
                                        text: res.message,
                                        timer: 2000,
                                        buttons: false
                                    });
                                    location.reload()

                                },
                                error: () => {
                                    swal({
                                        title: 'Erreur',
                                        icon: "error",
                                        text: res.message,
                                        timer: 2000,
                                        buttons: false

                                    });
                                    location.reload()
                                }
                            })

                        } else {

                            // swal({
                            //     title: 'Cancelled',
                            //     icon: "error",
                            //     text: "Erreur lors de la modification de la campagne",
                            //     timer: 2000,
                            //     buttons: false
                            // });
                        }
                    });


    });


                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload()
                    },
                });




    });
</script>

@endif

@endsection
