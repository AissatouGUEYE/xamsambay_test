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
            <a href="{{ route('greenapi.packs') }}">Packs</a>
        @else
            <a href="{{ route('greenapi.packs') }}">Packs</a>
        @endif
    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Recaputilatif
    </li>
@endsection

@section('main_content')

    <div class="container">
        <!-- Pack View Page -->
        <section class="pack-view-wrapper section">
            <div class="row">
                <!-- Pack Information -->
                <div class="col xl7 m7 s12">
                    <div class="card">
                        <div class="card-content">
                            <!-- Pack Title -->
                            <div class="row mt-3">
                                <div class="col s12 text-center">
                                    <h4 class="indigo-text">{{ $pack->nom }}</h4>
                                    <p>{{ $pack->description }}</p>
                                </div>
                            </div>
                            <div class="divider mb-3 mt-3"></div>

                            <!-- Pack Pricing Information -->
                            <div class="row pricing-info">
                                <div class="col m6 s12 text-center">
                                    <h6>INSCRIPTION</h6>
                                    <p class="price">{{ number_format($pack->montant_initial, 0, ',', ' ') }} FCFA</p>
                                </div>
                                <div class="col m6 s12 text-center">
                                    <h6>MENSUALITE</h6>
                                    <p class="price">{{ number_format($pack->montant_mensuel, 0, ',', ' ') }} FCFA</p>
                                </div>
                            </div>
                            <div class="divider mb-3 mt-3"></div>

                            <!-- Services List -->
                            <div class="row">
                                {{-- <h6 class="text-center">Services Inclus</h6> --}}
                                <ul class="collection">
                                    @foreach ($pack->services as $service)
                                        <li class="collection-item">
                                            <i class="material-icons">check_circle</i> {{ $service->service }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pack Action (Subscribe Button) -->
                {{-- <div class="container"> --}}
                    <!-- Other content of the page -->

                    @if($success == 1)
                        <div class="col xl5 m5 s12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="text-center">
                                        <p style="color: green; font-weight: bold;  display: flex; justify-content: center; align-items: center;">
                                            <i class="material-icons mr-4">check</i>SOUSCRIPTION RÉUSSIE !</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($success == 4)
                        <div class="col xl5 m5 s12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="text-center">
                                        <p style="color: green; font-weight: bold;  display: flex; justify-content: center; align-items: center;">
                                            <i class="material-icons mr-4">check</i>RENOUVELLEMENT RÉUSSI !</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif ($success == 2)
                        <div class="col xl5 m5 s12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="text-center">
                                        <p style="color: green; font-weight: bold;  display: flex; justify-content: center; align-items: center;">
                                            <i class="material-icons mr-4">check</i>VOUS ÊTES DÉJÀ SOUSCRITS À CE PACK !</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif ($success == 3)
                        <div class="col xl5 m5 s12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="text-center">
                                        <a href="{{ route('greenapi.renouveler', [$pack->id]) }}" class="btn btn-large white-text"
                                        style="background-color: #33a644; display: flex; justify-content: center; align-items: center;">
                                            RENOUVELER
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col xl5 m5 s12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="text-center">
                                        <a href="{{ route('greenapi.souscrire', [$pack->id]) }}" class="btn btn-large white-text"
                                        style="background-color: #33a644; display: flex; justify-content: center; align-items: center;">
                                            {{-- <i class="material-icons mr-4">check</i> --}}
                                            SOUSCRIRE
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                {{-- </div> --}}

            </div>
        </section>
    </div>


@endsection

@section('other-js-script')

@endsection
