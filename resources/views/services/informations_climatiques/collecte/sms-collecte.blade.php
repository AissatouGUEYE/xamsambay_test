@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/app-invoice.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
@endsection
@section('page-title')
    Producteurs
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/admin">Accueil</a>
    </li>
    <li class="breadcrumb-item">
   <a href="#">Collecte</a>
</li>

    <li class="breadcrumb-item active yellow-text">Historique d'envoi</li>
@endsection

@section('main_content')
<section class="invoice-edit-wrapper section">
    <div class="row">
      <!-- invoice view page -->
      <div class="col xl9 m8 s12">
        <div class="card">
          <div class="card-content px-36">
            <!-- header section -->
                {{-- {{dd($smsCollecte)}} --}}
                <table class="mmtable table striped  l12 display">

                    <thead>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>Date</th>

                    </thead>
                    <tbody>
                        @foreach ($smsCollecte as $sms)

                        <tr>
                            <td>{{  Str::ucfirst($sms->prenom) }}</td>
                            <td>{{  Str::ucfirst( $sms->nom )}}</td>
                            <td>{{  $sms->telephone }}</td>
                            <td>{{  $sms->created_at  }}</td>

                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <th>Prenom</th>
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>Date</th>

                    </tfoot>
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
                <h5>Infos Collecte</h5>

                <ul id="" class="striped">
                    {{-- {{dd($collecte)}} --}}

                    @foreach ($collecte as $c)
                    {{-- @if ($c['etat'] == 1) --}}

                        <li class="display-flex justify-content-between">
                            <span class="invoice-subtotal-title">Quantité:</span>
                            <h6 class="invoice-subtotal-value" id="qte">{{ $c->quantite }}</h6>
                        </li>
                        <li class="display-flex justify-content-between">
                            <span class="invoice-subtotal-title">Phénoméne:</span>
                            <h6 class="invoice-subtotal-value" id="phenom">{{  $c->nom_phenomene }}</h6>
                        </li>
                        <li class="display-flex justify-content-between">
                            <span class="invoice-subtotal-title">Date:</span>
                            <h6 class="invoice-subtotal-value" id="datep">{{date("d-m-Y",strtotime($c->date_pluie))}}</h6>
                        </li>
                    @endforeach

                        <li class="display-flex justify-content-between">
                            <span class="invoice-subtotal-title">Jours de pluie:</span>
                            <h6 class="invoice-subtotal-value"id="tjp">{{ $collecte_pluvio->count }}</h6>
                        </li>
                        <li class="display-flex justify-content-between">
                            <span class="invoice-subtotal-title">Cumul:</span>
                            <h6 class="invoice-subtotal-value" id="cumul">{{ $collecte_pluvio->cumul }}</h6>
                        </li>
                    {{-- @else --}}
                        {{-- <li class="display-flex justify-content-between"> --}}
                            {{-- <span class="invoice-subtotal-title">Informations non disponible</span> --}}
                            {{-- <h6 class="invoice-subtotal-value">{{date("d-m-Y",strtotime($collected['date']))}}</h6> --}}
                        {{-- </li> --}}
                    {{-- @endif --}}



                    {{-- <li class="display-flex justify-content-between">
                        <span class="invoice-subtotal-title">Région</span>
                        <h6 class="invoice-subtotal-value"></h6>
                    </li><li class="display-flex justify-content-between">
                        <span class="invoice-subtotal-title">Région</span>
                        <h6 class="invoice-subtotal-value"></h6>
                    </li> --}}

                    <div class="divider"></div>
                    {{-- <li class="display-flex justify-content-between">
                        <span class="invoice-subtotal-title">Nb Producteurs:</span>
                        <h6 class="invoice-subtotal-value">{{$producteurs}}</h6>
                    </li>
                  <li class="display-flex justify-content-between mt-3">
                    <div class="display-flex justify-content-center">
                        <button class="btn invoice-repeat-btn right" id="btn-push-collecte" data-repeater-create type="button">
                            {{-- <i class="material-icons left">add</i>
                            <span>Soumettre</span>
                          </button>
                    </div>

                  </li> --}}

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
    {{-- <script src="{{ asset('assets/js/providers/message.js') }}"></script>
    <script src="{{ asset('assets/js/providers/set_state.js') }}"></script>
    <script src="{{ asset('assets/js/providers/diffusion.js') }}"></script>
    <script src="{{ asset('assets/js/crud/gestion/delete.js') }}"></script>
    <script src="{{ asset('assets/js/crud/gestion/edit.js') }}"></script>
    <script src="{{ asset('assets/js/crud/gestion/update.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/card-advanced.js') }}"></script>
    <script src="{{ asset('assets/js/crud/services/prix/messages.js') }}"></script> --}}
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.print.min.js"></script>
@endsection
