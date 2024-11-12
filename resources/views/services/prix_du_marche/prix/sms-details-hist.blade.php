@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/app-invoice.css') }}">
@endsection
@section('page-title')
    Producteurs
@endsection
@section('ariane')
    <li class="breadcrumb-item"><a href="/dashboard">Accueil</a></li>
    <li class="breadcrumb-item"><a href="/prix-du-marche/prix">Prix du Marché</a></li>
    <li class="breadcrumb-item active">Historique</li>
@endsection

@section('main_content')
    <section class="invoice-edit-wrapper section">
        <div class="row">
            <!-- invoice view page -->
            <div class="col xl9 m8 s12">
                <div class="card">
                    <div class="card-content px-36">
                        <!-- header section -->
                        {{-- {{dd($smss)}} --}}
                        <table class="table data-table">

                            <thead>
                                <th>Message</th>
                                <th>Destinataire</th>
                                <th>Date et Heure</th>
                                {{-- <th>Etat</th> --}}

                            </thead>
                            <tbody>
                                @empty(!$smss)
                                    {{-- {{dd($smss)}} --}}
                                    @foreach ($smss as $sms)
                                        <tr>
                                            <td>{{ $sms->sms }}</td>
                                            <td>{{ $sms->telephone }}</td>
                                            {{-- <td>{{$sms->nom_phenomene}}</td> --}}
                                            <td>{{ date('d-m-Y h:m:s', strtotime($sms->date)) }}</td>
                                        </tr>
                                    @endforeach
                                @elseif($smss)
                                    <tr>
                                        <span>Informations non disponibles</span>
                                        {{-- <td>{{$sms->sms}}</td>
                                <td>{{$sms->telephone}}</td>
                                {{-- <td>{{$sms->nom_phenomene}}</td> --}}
                                        {{-- <td>{{date("d-m-Y h:mn:s",strtotime($sms->created_at))}}</td> --}} --}}
                                    </tr>
                                @endempty
                            </tbody>
                        </table>
                        <!-- invoice subtotal -->

                    </div>
                </div>
            </div>
            <!-- invoice action  -->
            <div class="col xl3 m4 s12">
                <div class="card invoice-action-wrapper mb-10">
                    <div class="card-content">
                        {{-- <div class="col xl4 m7 s12 offset-xl3"> --}}
                        <ul id="">

                            {{-- {{dd($sms)}} --}}
                            <li class="display-flex justify-content-between">
                                <span class="invoice-subtotal-title">Région: </span>
                                <h6 class="invoice-subtotal-value">
                                    {{ isset($sms) ? Str::ucfirst(((array) $sms)['region']) : '' }}</h6>
                            </li>
                            <li class="display-flex justify-content-between">
                                <span class="invoice-subtotal-title">Produit:</span>
                                <h6 class="invoice-subtotal-value">
                                    {{ isset($sms) ? Str::ucfirst(((array) $sms)['produit']) : '' }}</h6>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@section('other-js-script')
    <script src="{{ asset('assets/js/scripts/app-invoice.js') }}"></script>

    <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/extra-components-sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/providers/message.js') }}"></script>
    <script src="{{ asset('assets/js/providers/set_state.js') }}"></script>
    <script src="{{ asset('assets/js/providers/get-other-price.js') }}"></script>
    <script src="{{ asset('assets/js/crud/gestion/delete.js') }}"></script>
    <script src="{{ asset('assets/js/crud/gestion/edit.js') }}"></script>
    <script src="{{ asset('assets/js/crud/gestion/update.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/card-advanced.js') }}"></script>
    <script src="{{ asset('assets/js/crud/services/prix/messages.js') }}"></script>
@endsection
