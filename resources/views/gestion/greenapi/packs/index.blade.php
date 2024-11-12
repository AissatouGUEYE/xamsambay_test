@extends('layouts.master')
@section('main_content')
@section('page-title')
    Gestion des Packs
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
    <li class="breadcrumb-item active" style="color:#ffe900">Liste des packs
    </li>
@endsection

@section('main_content')

    <br>
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div id="image-card" class="section">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h4 class="header">Packs GREEN API</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="carousel">
                            @isset($pack)
                                @foreach ($pack as $item)
                                    @php
                                        $checked = 0;
                                        foreach ($abonnements as $abonnement) {
                                            if ($abonnement->pack->id == $item->id) {
                                                if ($abonnement->date_prochain_paiement > $today) {
                                                    $checked = 1;
                                                }
                                                else {
                                                    $checked = 2;
                                                }
                                                break;
                                            }
                                        }

                                    @endphp
                                    <div class="carousel-item col s10 m6 l6">
                                        <div class="card" style="background-image: linear-gradient(#b07f4a9e, #c99f68a9);">
                                            <div class="card-content white-text center" style="padding:5px !important">
                                                <h6 class="card-title font-weight-400"
                                                    style="color: #ffe900; text-decoration:underline">
                                                    {{ $item->nom }}
                                                </h6>
                                                <p class="price" style="color: black;font-weight:700">
                                                    Inscription: {{ number_format($item->montant_initial, 0, ',', ' ') }} FCFA
                                                </p>
                                                <p class="price" style="color: black;font-weight:700">
                                                    Mensualité: {{ number_format($item->montant_mensuel, 0, ',', ' ') }} FCFA
                                                </p>
                                                <ul style="padding-bottom: 2px">
                                                    @foreach ($item->services as $service)
                                                        <li>{{ $service->service }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="card-action border-none center pb-3"
                                                style="background-image: linear-gradient(to bottom right, #c99f68a9, #b07f4a9e);">
                                                @if ($checked != 1)
                                                    <a href="{{ route('packs.validation', [$item->id, "GREENAPI"]) }}"
                                                        class="waves-effect waves-light btn box-shadow"
                                                        @if ($checked == 2) style="background-color: #EB8A0CFF"
                                                        @else
                                                        style="background-color: #33a644" @endif>
                                                        @if ($checked == 2)
                                                            Renouveler Pack
                                                        @elseif ($checked == 0)
                                                            Souscrire
                                                        @endif
                                                    </a>
                                                @else
                                                    <p class="subscription-message">
                                                        <i class="material-icons" style="color: #33a644; vertical-align: middle;">check_circle</i>
                                                        <span style="font-weight: bold; color: #33a644;">Déjà Souscrit !</span>
                                                    </p>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('other-js-script')
    <script>
        $(document).ready(function() {
            $('.carousel').carousel();
        });
    </script>
@endsection
