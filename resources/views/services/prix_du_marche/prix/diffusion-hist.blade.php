@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('page-title')
    Prix du Marché
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashbord">Accueil</a>
    </li>
    <li class="breadcrumb-item ">
        <a href="/prix-du-marche/prix">Prix du Marché</a>
    </li>
    <li class="breadcrumb-item active yellow-text">Historique de Diffusions</li>
@endsection

@section('main_content')
    <section class="users-list-wrapper section">

        <div class="users-list-table">
            <div class="card">
                <div class="card-content">

                    <div>
                    <div class="responsive-table mt-3">
                        {{-- {{dd($hist_prix_sms)}} --}}
                        <table id="HistoricPrice" class="table s3 m5 l5">
                            <thead>
                                <tr>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Expéditeur</th>
                                    <th>NB Producteurs</th>
                                    <th>Details</th>
                                    {{-- <th>Date</th>
                                    <th>Marché</th>
                                    <th>Localité</th> --}}
                                    {{-- <th>Campagne</th>                                               --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hist_prix_sms as $sms)

                                        {{-- @if ($sms->type_sms === "PRIX") --}}
                                            <tr>
                                                <td>{{$sms->sms}}</td>
                                                <td>{{date("d-m-Y",strtotime($sms->date))}}</td>
                                                <td>{{$sms->prenom_utilisateur." ".$sms->nom_utilisateur}}</td>
                                                <td>{{$sms->nombre_sms}}</td>
                                                <td>
                                                    <a href="{{url('/prix-du-marche/historiques/'. Str::replaceFirst('/', '_', $sms->sms) ."/". $sms->date)}}" id="" class=''>
                                                        <span class='chip green lighten-5'><span class='green-text'><i class="material-icons">visibility</i></span></span>
                                                    </a>
                                                </td>
                                            </tr>
                                        {{-- @endif --}}

                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Expéditeur</th>
                                    <th>NB Producteurs</th>
                                    <th>Details</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                    {{-- @include('services.informations_climatiques.parametrage.pluvio.edit') --}}

                </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('other-js-script')

    <script>
        $(document).ready(() => {

            $('#HistoricPrice tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');

            });

            var table = $('#HistoricPrice').DataTable({
                initComplete: function() {
                    // Apply the search 
                    this.api()
                        .columns()
                        .every(function() {
                            var that = this;

                            $('input', this.footer()).on('keyup change clear', function() {
                                if (that.search() !== this.value) {
                                    that.search(this.value).draw();
                                }
                            });
                        });
                    var r = $('#HistoricPrice tfoot tr');
                    r.find('th').each(function() {
                        $(this).css('padding', 8);
                    });
                    $('#HistoricPrice thead').append(r);
                    $('#search_0').css('text-align', 'center');
                },

                dom: "Bfrtip",
                buttons: ["colvis", "excel", "print"],
                buttons: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"],
                ],

            });
        });
    </script>
    <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/extra-components-sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/providers/message.js') }}"></script>
    <script src="{{ asset('assets/js/providers/set_state.js') }}"></script>
    <script src="{{ asset('assets/js/providers/progress.js') }}"></script>
    <script src="{{ asset('assets/js/crud/gestion/delete.js') }}"></script>
    <script src="{{ asset('assets/js/crud/gestion/edit.js') }}"></script>
    <script src="{{ asset('assets/js/crud/gestion/update.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/card-advanced.js') }}"></script>
    <script src="{{ asset('assets/js/crud/services/prix/messages.js') }}"></script>

@endsection
