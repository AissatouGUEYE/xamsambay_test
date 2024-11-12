@extends('layouts.master')
@section('main_content')
@section('page-title')
    Souscription de Pack
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        @if ($_SESSION['role'] == 'ADMIN')
            <a href="{{ route('packs') }}">Packs</a>
        @else
            <a href="{{ route('packs.index') }}">Packs</a>
        @endif
    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Recaputilatif
    </li>
@endsection

@section('main_content')
    @php

        // dd($_SESSION['role']);
        $desc = $pack->descriptionpack;
        $desc = str_replace('[', '', $desc);
        $desc = str_replace(']', '', $desc);
        $desc = str_replace("\"", '', $desc);
        $array_desc = explode(',', $desc);
        $pack->descriptionpack = $array_desc;
        if (isset($modules) && !empty($modules)) {
            foreach ($modules as $key => $module) {
                if ($module->id_produit != null) {
                    $produit = $module->nom_produit;
                    $marche = $module->nom_marche;
                }

                if ($module->id_cours != null) {
                    $course = $module->nom_cours;
                }
            }
        }
    @endphp

    {{-- Passer en parametre le type de pack et le Canal (y'as pas de pas de Get Pack by ID) --}}
    {{-- Detailler le pack choisi par l'utilisateur la duree et le prix --}}
    {{-- Valider Souscription --}}

    <div class="container">
        <!-- app invoice View Page -->
        <section class="invoice-view-wrapper section">
            <div class="row">
                <!-- invoice view page -->
                <div class="col xl7 m7 s12">
                    <div class="card">
                        <div class="card-content invoice-print-area">
                            <!-- header section -->
                            <div class="row invoice-date-number">
                                <div class="col xl4 s12">
                                    @if ($pack->type_entite == 'OP')
                                        <span class="invoice-number mr-1">Profil : OP | UOP | AUOP</span>
                                    @else
                                        <span class="invoice-number mr-1">Profil : {{ $pack->type_entite }}</span>
                                    @endif
                                    {{-- <span>000756</span> --}}
                                </div>
                                <div class="col xl8 s12">
                                    <div class="invoice-date display-flex align-items-center flex-wrap">
                                        @if ($pack->maxproducteur != 0)
                                            @if ($pack->maxproducteur == 1)
                                                @php
                                                    $min = 1;
                                                    $max = 1;
                                                @endphp
                                            @else
                                                @php
                                                    $min = $pack->minproducteur;
                                                    $max = $pack->maxproducteur;
                                                @endphp
                                                <div class="mr-3">
                                                    <small></small>
                                                    <span>De {{ $pack->minproducteur }} producteur(s)</span>
                                                </div>
                                                <div>
                                                    <small></small>
                                                    <span>à {{ $pack->maxproducteur }} producteurs</span>
                                                </div>
                                            @endif
                                        @else
                                            @php
                                                $min = $pack->minproducteur;
                                                $max = 10000000;
                                            @endphp
                                            <div class="mr-3">
                                                <small></small>
                                                <span>Plus {{ $pack->minproducteur }} producteurs</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- logo and title -->
                            <div class="row mt-3 invoice-logo-title">
                                <div class="col m6 s12 display-flex invoice-logo mt-1 push-m6">
                                    {{-- <img src="../../../app-assets/images/gallery/pixinvent-logo.png" alt="logo"
                                        height="46" width="164" /> --}}
                                </div>
                                <div class="col m6 s12 pull-m6">
                                    <h5 class="indigo-text">PACK {{ $pack->type_pack }}</h5>
                                    <span>Canal de Communication: {{ $pack->canal }} </span>
                                </div>
                            </div>
                            <div class="divider mb-3 mt-3"></div>
                            <!-- invoice address and contact -->
                            <div class="row invoice-info">
                                <h6 class="invoice-from" style="text-align: center">Services</h6>
                                <div class="col m6 s12">
                                    @foreach ($pack->descriptionpack as $key => $item)
                                        @if ($key % 2 == 0)
                                            <div class="invoice-address">
                                                <span>{{ $item }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="col m6 s12">
                                    @foreach ($pack->descriptionpack as $key => $item)
                                        @if ($key % 2 != 0)
                                            <div class="invoice-address">
                                                <span>{{ $item }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="divider mb-3 mt-3"></div>
                            @if ($pack->type_entite != 'TEST')
                                <div class="row center-align">
                                    <div class="col s6">
                                        <div class="input-field">
                                            @if ($pack->type_entite == 'INDIVIDUEL')
                                                <input id="effectifs" type="number" value="1" disabled />
                                            @else
                                                @if ($souscris)
                                                    <input type="number" id="effectifs" min="{{ $min }}"
                                                        max="{{ $max }}" step="1" name="effectifs" disabled
                                                        value="{{ $effectif }}" />
                                                @else
                                                    <input type="number" id="effectifs" min="{{ $min }}"
                                                        max="{{ $max }}" step="1" name="effectifs" />
                                                @endif
                                            @endif
                                            <label for="effectifs">Effectif à Enroller</label>
                                        </div>
                                    </div>
                                    <div class="col s1">
                                        <input id="unitaire" type="text" value="{{ $pack->pricing }}" hidden />
                                        <input id="min" type="number" value="{{ $min }}" hidden />
                                        <input id="max" type="number" value="{{ $max }}" hidden />
                                    </div>
                                    <div class="col s5">
                                        <a
                                            class="mt-3 btn-total btn display-flex align-items-center justify-content-center">
                                            <span class="text-nowrap" style="color:black ">
                                                Calculer le total
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            <div class="invoice-subtotal">
                                <div class="row">
                                    {{-- <div class="col m3 s12">
                                    </div> --}}
                                    <div class="col s12">
                                        <ul>
                                            <li class="display-flex justify-content-between">
                                                <span class="invoice-subtotal-title"
                                                    style="padding-right: 5px; width:50%">Prix
                                                    (FCFA)</span>
                                                @if ($souscris)
                                                    <input type="text" value="{{ $tarif }}" disabled
                                                        id="prix" style="color:black;font-size:17px;text-align:center">
                                                @else
                                                    <input type="text" value="{{ $pack->pricing }}" disabled
                                                        id="prix" style="color:black;font-size:17px;text-align:center">
                                                @endif
                                                {{-- <h6 class="invoice-subtotal-value">{{ $pack->pricing }} FCFA</h6> --}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- invoice action  -->
                <div class="col xl5 m5 s12">
                    <div class="card invoice-action-wrapper">
                        <div class="card-content">
                            <div class="invoice-action-btn">
                                {{-- <a href="{{ route('packs.souscripte', [$pack->id]) }}"
                                    @if ($souscris) disabled @endif
                                    class="btn display-flex align-items-center justify-content-center"
                                    style="background-color: #33a644">
                                    <i class="material-icons mr-4">check</i>

                                    <span class="text-nowrap">
                                        @if ($souscris)
                                            Deja Souscris
                                        @else
                                            Souscrire
                                        @endif
                                    </span>
                                </a> --}}
                                {{-- <a @if ($souscris) disabled @endif
                                    class="btn-souscrire-pack btn display-flex align-items-center justify-content-center"
                                    style="background-color: #33a644">
                                    <i class="material-icons mr-4">check</i>

                                    <span class="text-nowrap">
                                        @if ($souscris)
                                            Deja Souscris
                                        @else
                                            Souscrire
                                        @endif
                                    </span>
                                    <input id="url" value="{{ route('packs.souscripte', [$pack->id]) }}"
                                        type="text" hidden>
                                </a> --}}
                                {{-- <br> --}}
                                @if ($souscris && $pack->type_entite != 'TEST')
                                    <a class="mt-3 btn-renouveler-pack btn display-flex align-items-center justify-content-center"
                                        style="background-color: #ffe900">
                                        <i class="material-icons mr-4" style="color:black">check</i>

                                        <span class="text-nowrap" style="color:black ">
                                            Renouveler Pack
                                        </span>
                                        {{-- Id Abonnement --}}
                                        <input id="urlRenew" value="{{ route('packs.renouvellement', [$idAbonnement]) }}"
                                            type="text" hidden>
                                    </a>
                                @else
                                    <a @if ($souscris && $pack->type_entite == 'TEST') disabled @endif
                                        class="btn-souscrire-pack btn display-flex align-items-center justify-content-center"
                                        style="background-color: #33a644">
                                        <i class="material-icons mr-4">check</i>

                                        <span class="text-nowrap">
                                            Souscrire
                                        </span>
                                        <input id="url" value="{{ route('packs.souscripte', [$pack->id]) }}"
                                            type="text" hidden>
                                        <input id="profilChoisi" value="{{ $pack->type_entite }}" type="text" hidden>
                                        <input id="profilConnecte" value="{{ $_SESSION['role'] }}" type="text"
                                            hidden>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if ($souscris)
                        <div class="card">
                            <div class="card-content">
                                <h6>Pack {{ $abonnement->type_pack }} - {{ $abonnement->canal }}</h6>

                                @if ($abonnement->reference)
                                    <p>Reference : {{ $abonnement->reference }}</p>
                                @endif
                                @if ($abonnement->status == 0)
                                    <p>Statut : Initié</p>
                                @else
                                    <p>Statut : Validé</p>
                                @endif
                                @if ($abonnement->canal == 'SMS')
                                    <p>SMS restant : {{ $abonnement->nb_sms_restant }}</p>
                                @else
                                    <p>Secondes d'appels restant : {{ $abonnement->nb_sec_voice_restant }}</p>
                                @endif
                                @if (isset($produit))
                                    <p>Prix du Marche : {{ $produit }} {{ $marche }}</p>
                                @endif
                                @if (isset($course))
                                    <p>Module de Cours au choix : {{ $course }}</p>
                                @endif
                                {{-- date_creation --}}
                                <em> Souscription:
                                    @php echo date('d/m/Y', strtotime($abonnement->date_creation));  @endphp
                                    {{-- {{ $abonnement->date_creation }} --}}
                                </em>
                                <br>
                                <em> Expiration:
                                    @if ($abonnement->date_expiration)
                                        @php echo date('d/m/Y', strtotime($abonnement->date_expiration));  @endphp
                                        {{-- {{ $abonnement->date_expiration }} --}}
                                    @else
                                        @php echo date('d/m/Y', strtotime($abonnement->date_fin_pack));  @endphp
                                        {{-- {{ $abonnement->date_fin_pack }} --}}
                                    @endif
                                </em>
                                @if (isset($abonnement->fichier))
                                    <p>

                                        Evidence: <a href="{{ asset('storage/' . $abonnement->fichier) }}"
                                            target="_blank">
                                            <i class="material-icons green-text ">file_download</i>
                                    </p>
                                @endif

                            </div>
                        </div>

                        @if ($pack->type_entite != 'TEST')

                            @if ($pack->type_entite == 'INDIVIDUEL')
                                @include('gestion.packs.partials.individualValidation')
                            @else
                                @if (!isset($abonnement->fichier))
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 style="text-align: center; padding:10px; padding-bottom:5px">
                                                Joindre un évidence de paiement
                                            </h6>
                                        </div>
                                        <div class="card-content">
                                            <form method="post" action="{{ route('packs.souscription.contrat') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="col s12">
                                                    <div class="file-field input-field">
                                                        <div class="btn">
                                                            <span>Fichier</span>
                                                            <input type="file" name="glist"
                                                                accept="application/pdf">
                                                        </div>
                                                        <div class="file-path-wrapper">
                                                            <input class="file-path" name="glist_name" type="text">
                                                        </div>
                                                        <input type="text" name="idAbonnement" id="idAbonnement"
                                                            value="{{ $abonnement->id_abonnement }}" hidden>
                                                        <input type="text" name="idPack" id="idPack"
                                                            value="{{ $pack->id }}" hidden>
                                                        <input type="text" name="acteur" id="acteur"
                                                            value="{{ $pack->type_entite }}" hidden>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <button type="submit"
                                                        class="waves-effect waves-light green darken-1 s2 m3 l3 btn right">Ajouter
                                                        évidence
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                @endif
                            @endif
                        @endif
                    @endif
                </div>
            </div>

        </section>
    </div>

@endsection

@section('other-js-script')
    <script>
        $(document).ready(function() {
            let root = $('meta[name="url"]').attr("content");
            // $('.btn-souscrire-pack').removeAttr('disabled');
            $('.btn-renouveler-pack').removeAttr('disabled');
            $('.btn-souscrire-pack').click(function(e) {
                e.preventDefault();
                let url = $('#url').val();
                let prix = $('#prix').val();
                let effectifs = parseInt($('#effectifs').val());
                let profilConnecte = $('#profilConnecte').val();
                let profilChoisi = $('#profilChoisi').val();
                let jeton = 0;
                let racineMot = profilConnecte.charAt(profilConnecte.length - 2) + profilConnecte.charAt(
                    profilConnecte.length - 1);
                // alert(racineMot);
                if (racineMot == profilChoisi) {
                    jeton = 1;
                } else {
                    jeton = 0;
                }
                // alert(profilChoisi);

                if (profilChoisi != profilConnecte && profilChoisi != "TEST" && jeton != 1) {
                    swal({
                        title: 'Attention',
                        icon: 'warning',
                        text: "Profil Choisi different de votre type de Profil",
                        timer: 4000,
                        buttons: false
                    });
                } else {

                    // console.log(idPack + "-" + canal + "-" + nombre);
                    url = url + "?prix=" + prix;
                    if (effectifs) {
                        url += "&effectif=" + effectifs;
                    }
                    // console.log(url);
                    swal({
                        title: "Souscription",
                        text: "Voulez-vous souscrire au Pack",
                        icon: 'warning',
                        dangerMode: true,
                        buttons: {
                            delete: 'Oui',
                            cancel: 'Annuler'
                        }
                    }).then(function(willDelete) {
                        if (willDelete) {
                            swal({
                                title: 'Progression',
                                icon: 'warning',
                                text: "Souscription en cours...",
                                timer: 4000,
                                buttons: false
                            });
                            location.replace(url);


                        } else {

                            // swal({
                            // title: 'Cancelled',
                            // icon: "error",
                            // text: "Erreur lors de la modification de la campagne",
                            // timer: 2000,
                            // buttons: false
                            // });
                        }
                    });
                }


            });

            // Passer en parametre l'id Abonnement
            $('.btn-renouveler-pack').click(function(e) {
                e.preventDefault();
                let url = $('#urlRenew').val();
                let effectifs = parseInt($('#effectifs').val());
                // console.log(idPack + "-" + canal + "-" + nombre);
                let prix = $('#prix').val();
                url = url + "?prix=" + prix;
                if (effectifs) {
                    url += "&effectif=" + effectifs;
                }
                // console.log(url);
                swal({
                    title: "Renouvellement",
                    text: "Voulez-vous renouveler le Pack",
                    icon: 'warning',
                    dangerMode: true,
                    buttons: {
                        delete: 'Oui',
                        cancel: 'Annuler'
                    }
                }).then(function(willDelete) {
                    if (willDelete) {
                        swal({
                            title: 'Success',
                            icon: 'success',
                            text: "Renouvellement en cours.. Merci de payer",
                            timer: 2000,
                            buttons: false
                        });
                        location.replace(url);


                    } else {

                        // swal({
                        // title: 'Cancelled',
                        // icon: "error",
                        // text: "Erreur lors de la modification de la campagne",
                        // timer: 2000,
                        // buttons: false
                        // });
                    }
                });


            });
            $('.btn-total').click(() => {
                $('#prix').val('');
                let prix = $('#unitaire').val();
                let effectifs = parseInt($('#effectifs').val());
                let min = parseInt($('#min').val());
                let max = parseInt($('#max').val());
                // S'assurer que c'est un number if ($.isNumeric($('#input').val()))
                if ((min <= effectifs) && (max >= effectifs)) {
                    let total = prix * effectifs;
                    $('#prix').val(total);
                    $('.btn-souscrire-pack').removeAttr('disabled');
                    $('.btn-renouveler-pack').removeAttr('disabled');
                } else {
                    // $('#prix').val('Mettez un bon effectif');
                    let erreurText = 'Mettez un effectif compris entre ' + min + ' et ' + max +
                        ' producteurs!';
                    $('.btn-souscrire-pack').attr('disabled', true);
                    $('.btn-renouveler-pack').attr('disabled', true);
                    swal({
                        title: 'Attention',
                        icon: 'warning',
                        text: erreurText,
                        timer: 4000,
                        buttons: false
                    });


                }
            });

            $('#choixCours').click(() => {
                // console.log('clicked');
                swal({
                    title: "Etes-vous sure",
                    text: "Voulez-vous souscrire à ce service",
                    icon: 'warning',
                    dangerMode: true,
                    buttons: {
                        cancel: 'Annuler',
                        delete: 'Oui'
                    }
                }).then(function(willDelete) {
                    if (willDelete) {
                        $('#formChoixCours').submit()
                    } else {}
                });

            });

            $('#prixDuMarche').click(() => {
                // console.log('clicked');
                swal({
                    title: "Etes-vous sure",
                    text: "Voulez-vous souscrire à ce service",
                    icon: 'warning',
                    dangerMode: true,
                    buttons: {
                        cancel: 'Annuler',
                        delete: 'Oui'
                    }
                }).then(function(willDelete) {
                    if (willDelete) {
                        $('#formPrixMarche').submit()
                    } else {}
                });

            });
        });
    </script>
@endsection
