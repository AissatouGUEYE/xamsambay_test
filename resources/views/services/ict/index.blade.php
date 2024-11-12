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
Traçabilité
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text" href="#">Traçabilité</a>
    </li>
@endsection

@section('main_content')
    @php
        if (request()->session()->exists('message2')) {
            $message2 = request()->session()->pull('message2', '');
            request()->session()->forget('message2');
        }
    @endphp

    <div class="users-list-table">
        <div class="card">
            <div class="card-header">
                <div class="padding-4">
                    <a type="button" class="waves-effect waves-light green darken-1 btn modal-trigger right"
                        href="{{ route('ict.farm') }}"><i class="material-icons">add_circle</i> Champ</a>
                </div>
            </div>

            <div class="card-content">
                @isset($message2)
                    <div class="row ">
                        <div class="red lighten-3 padding-2 rounded">
                            <span style="align-items: center">{{ $message2 }}</span>
                        </div>
                    </div>
                @endisset

                <div class="row">
                    <div @if ($suscribe == 2) class="col s12" @else class="col xl7 m12" @endif>
                        <div class="card compact-card">
                            <div class="card-content">
                                <div class="responsive-table">
                                    <table id="statsTable" class="table display striped">
                                        <thead>
                                            <tr>
                                                <th>Ferme</th>
                                                <th>Libelle</th>
                                                <th>Surface</th>
                                                <th>Produit</th>
                                                <th>Analyse du Sol</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            @isset($champs)
                                                @foreach ($champs as $item)
                                                    <tr>
                                                        <td>{{ $item->id_farm }}</td>
                                                        <td>{{ $item->libelle }}</td>
                                                        <td>{{ $item->surface }}</td>
                                                        <td>{{ $item->produit }}</td>
                                                        <td>
                                                            @if ($suscribe == 2)
                                                                <a href="{{ route('farm.analyse', ['id' => $item->id]) }}"
                                                                    class="btn chip green lighten-2">Analyse du Sol</a>
                                                                <a href="{{ route('farm.analyse.recommendation', ['id' => $item->id]) }}"
                                                                    class="btn chip green lighten-2">Analyse & Recommandation</a>
                                                            @else
                                                                ---
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('logFarm.analyse', ['idFarm' => $item->id]) }}"
                                                                class="" title="Historique des Analyses">
                                                                <i class="material-icons black-text">settings_backup_restore</i>
                                                            </a>
                                                            <a href="#" class="" title="Delete Farm">
                                                                <i class="material-icons red-text">delete</i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Subscription Message Cards -->
                    @if ($suscribe == 0)
                        <div class="col xl5 m12">
                            <div class="card compact-card">
                                <div class="card-content center-align">
                                    <i class="material-icons large red-text">error_outline</i>
                                    <h5 class="red-text text-darken-1">Service Non Souscrit</h5>
                                    <p class="grey-text">VOUS N'ÊTES PAS SOUSCRIT À CE SERVICE !</p>
                                    <a href="{{ route('greenapi.packs') }}"
                                        class="btn bg-vert-louma text-light rounded-pill btn-lg shadow">
                                        <i class="material-icons left">visibility</i> Voir Packs
                                    </a>
                                </div>
                            </div>
                        </div>
                    @elseif ($suscribe == 1)
                        <div class="col xl5 m12">
                            <div class="card compact-card">
                                <div class="card-content center-align">
                                    <i class="material-icons large orange-text">warning</i>
                                    <h5 class="orange-text text-darken-1">Abonnement Expiré</h5>
                                    <p class="grey-text">Renouvelez votre abonnement pour continuer.</p>
                                    <a href="{{ route('greenapi.validation', [$pack_id, 'GREENAPI']) }}"
                                        class="btn bg-vert-louma text-light rounded-pill btn-lg shadow">
                                        <i class="material-icons left">autorenew</i> Renouveler
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
