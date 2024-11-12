@extends('layouts.master')
@section('other-css-files')
<style>
    .compact-card .card-content {
        padding: 10px; /* Réduit l’espace intérieur de la carte */
    }

    .compact-card .center-align {
        margin-top: 0; /* Réduit l’espace vertical autour du contenu */
    }

    .compact-card .material-icons.large {
        font-size: 36px; /* Diminue la taille de l’icône */
    }

    .compact-card h5 {
        font-size: 1.2rem; /* Diminue la taille du titre */
        margin: 5px 0; /* Réduit les marges du titre */
    }

    .compact-card p {
        font-size: 0.9rem; /* Diminue la taille du texte */
        margin-bottom: 10px; /* Réduit la marge sous le texte */
    }

    .compact-card .btn {
        padding: 6px 12px; /* Rend le bouton plus compact */
    }
</style>
@endsection
@section('page-title')
    Credit Agricol
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text" href="#">Credit Agricol</a>
    </li>
@endsection
@section('main_content')
    <div class="users-list-table">
        <div @if ($suscribe == 2) class="card compact-card" @else class="card" @endif>
            <div class="card-content" >
                <div class="padding-4 text-center">

                    @if($suscribe == 0)
                        <div class="center-align">
                            <i class="material-icons large red-text">error_outline</i>
                            <h5 class="red-text text-darken-1">Service Non Souscrit</h5>
                            <p class="grey-text">VOUS N'ÊTES PAS SOUSCRIT À CE SERVICE !</p>
                            <a href="{{ route('greenapi.packs') }}"
                            class="btn bg-vert-louma text-light rounded-pill shadow mt-1">
                                <i class="material-icons left">visibility</i> Voir Pack
                            </a>
                        </div>

                    @elseif($suscribe == 1)
                        <div class="center-align">
                            <i class="material-icons large orange-text">warning</i>
                            <h5 class="orange-text text-darken-1">Abonnement Expiré</h5>
                            <p class="grey-text">Renouvelez votre abonnement pour continuer.</p>
                            <a href="{{ route('greenapi.validation', [$pack_id, 'GREENAPI']) }}" class="btn bg-vert-louma text-light rounded-pill shadow mt-1">
                                <i class="material-icons left">autorenew</i> Renouveler
                            </a>
                        </div>

                    @else
                        <div class="center-align">
                            <i class="material-icons large green-text">check_circle</i>
                            <h5 class="green-text text-darken-1">Abonnement Actif</h5>
                            <p class="grey-text">Créer un nouveau dossier d'emprunt.</p>
                            <a type="button" class="waves-effect waves-light green darken-1 btn modal-trigger right mt-1"
                                href="{{ route('credit.create') }}">
                                <i class="material-icons left">add_circle</i> Dossier D'emprunt
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>


        <div class="row">
            <div class="card">

                @isset($dossiers)
                    @forelse($dossiers as $dossier)
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col s12 m6 l4">
                                        Montant
                                        {{-- Montant Credit souhaite : {{ $dossier->credits[0]->montant_credit_souhaite }} --}}
                                    </div>
                                    <div class="col s12 m6 l4">
                                        Speculation : @isset($dossier->speculation_envisagee)
                                        {{ $dossier->speculation_envisagee }}
                                        @endisset
                                    </div>
                                    <div class="col s12 m6 l4">
                                        <a
                                            class="waves-effect waves-light  green-text darken-1 right"
                                            href="#">
                                            Details <span style="padding-top: 2px"><i class="material-icons">arrow_forward</i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    @empty
                        <div class="card">
                            <div class="card-content">
                                Liste des Dossiers de Prets crees
                            </div>
                        </div>
                    @endforelse
                @endisset
            </div>
        </div>

    </div>
@endsection
@section('other-js-script')
@endsection
