@extends('layouts.master')
@section('main_content')
@section('page-title')
    Journal
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
    <li class="breadcrumb-item">
        <a href="{{ route('packs.souscriptions') }}">Souscriptions</a>
    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Details Souscription
    </li>
@endsection

@section('main_content')
    @php
        // dd($pack);
    @endphp
    <section class="users-list-wrapper section">
        <div class="users-list-filter">
        </div>
        <div class="users-list-table">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12">
                            <div class="card" style="padding:10px;text-align: center !important">
                                <div class="row invoice-date-number">
                                    <h6 class="px-3"> <span class="invoice-number mr-1"> <strong> Référence :
                                                {{ $pack->reference }}</strong></span>
                                    </h6>
                                    <br><br>
                                    <div class="col m6 s12">
                                        <span>Nom Structure: {{ $pack->nom_entite }}</span> <br>
                                        <span>Type Structure: {{ $pack->nom_type_entite }}</span>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="invoice-date">
                                            <span>Type Pack: {{ $pack->type_pack }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider mb-3 mt-3"></div>
                                <div class="row invoice-date-number">
                                    <div class="col m6 s12">
                                        <span>Effectif : {{ $pack->effectif }}</span> <br>
                                        <span>Prix : {{ $pack->effectif * $pack->pricing }} FCFA</span>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="invoice-date  align-items-center ">
                                            <span>Nombre Push Sms: {{ $pack->nb_sms_restant }}</span> <br>
                                            <span>Secondes Voice restante: {{ $pack->nb_sec_voice_restant }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider mb-3 mt-3"></div>
                                <div class="row invoice-date-number">
                                    <div class="col m6 s12">
                                        <span>Statut : @if ($pack->status == 1)
                                                <span class="chip green lighten-5"> Validé</span>
                                            @else
                                                <span class="chip yellow lighten-5"> Initié</span>
                                            @endif
                                        </span> <br>
                                        <span>Paiement :@if ($pack->payer == 1)
                                                <span class="chip green lighten-5"> Validé</span>
                                            @else
                                                <span class="chip yellow lighten-5"> Initié</span>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="invoice-date align-items-center">
                                            <span>Evidence:
                                                @if (isset($pack->fichier))
                                                    <a href="{{ asset('storage/' . $pack->fichier) }}" target="_blank">
                                                        <i class="material-icons green-text ">file_download</i>
                                                    @else
                                                        ------
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @if ($pack->status == 0)
                                    <div class="divider mb-1 mt-3"></div>
                                    <div class="row invoice-date-number mb-2" style="text-align: center !important">
                                        <a href="{{ route('pack.activer.details', [$pack->id_abonnement]) }}"
                                            class="waves-effect waves-light green darken-1 s2 m3 l3 btn">Valider
                                            Souscription
                                            contrat
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="col s5">
                            @if (!isset($pack->fichier))
                                <div class="card">
                                    <div class="card-header">
                                        <h6 style="text-align: center; padding:10px">
                                            Joindre un contrat
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
                                                        <input type="file" name="glist" accept="application/pdf">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path" name="glist_name" type="text">
                                                    </div>
                                                    <input type="text" name="idAbonnement" id="idAbonnement"
                                                        value="{{ $pack->id_abonnement }}" hidden>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <button type="submit"
                                                    class="waves-effect waves-light green darken-1 s2 m3 l3 btn right">Ajouter
                                                    contrat
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @else
                            @endif
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('other-js-script')
@endsection
