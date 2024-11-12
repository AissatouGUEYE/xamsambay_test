@extends('layouts.master')
@section('other-css-files')
    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">--}}
    {{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">--}}
    {{--    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">--}}
@endsection
@section('page-title')
    Prévision
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">information-climatique</a>
    </li>
    <li class="breadcrumb-item active">
        <a class="yellow-text" href="#">Prévision </a>
    </li>
@endsection
@php
    //    dd($previsions_tab);
@endphp
@section('main_content')
    <section class="users-list-wrapper section">
        <div class="users-list-table">
            @if (in_array($_SESSION['role'], ['ADMIN', 'SUPERADMIN','ONG']))

                <div class="card">
                    <div class="card-header">
                        <h5 class="pt-2 ml-3">Statistiques Previsions</h5>
                        <input type="text" name="id_entite" id="id_entite"
                               value="{{ $_SESSION['id_entite'] }}" hidden>
                    </div>
                    <div class="card-content">
                        @if (in_array($_SESSION['role'], ['ADMIN', 'SUPERADMIN']))
                            <a class="waves-effect waves-light  green darken-1 btn  right"
                               href="{{url("/alertes/new")}}">
                                <i class="material-icons">add</i> Nouvelle Prévision
                            </a>
                            {{-- <a class="waves-effect waves-light  green darken-1 btn modal-trigger right mr-1"
                                href="#modal_prevision_voice">
                                <i class="material-icons">add</i> Nouvelle Prévision
                            </a> --}}
                        @endif

                        <table id="" class="previsionTable table striped  l12 display">
                            <thead>
                            <tr>
                                <th>Message</th>
                                <th>Zone</th>
                                <th>Région</th>
                                <th>Date</th>
                                @if($_SESSION['role'] == "ONG")
                                    <th>Nb Prod.</th>
                                    <th>Telechargement</th>
                                @endif
                                @if (in_array($_SESSION['role'],array("ADMIN","SUPERADMIN")))
                                    <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody id="">
                            @foreach ($previsions_tab as $key=>$prevision)
                                <tr>
                                    <td>
                                        @if ( is_array(explode(":",$prevision->message)) &&  (explode(":",$prevision->message)[0] === "https"))
                                            <audio controls>
                                                <source src="{{ $prevision->message }}">
                                            </audio>
                                        @else
                                            {{$prevision->message}}
                                        @endif
                                    </td>
                                    <td>{{$prevision->localite}}</td>
                                    <td>
                                        ---
                                    </td>


                                    <td>{{date('Y-m-d',strtotime($prevision->date_envoie))}}</td>
                                    @if($_SESSION['role'] == "ONG")
                                        <td>
                                            @isset($prevision->counter)
                                                {{$prevision->counter}}
                                            @endisset
                                        </td>
                                        <td>
                                            @if (explode(":",$prevision->message)[0] === "https")
                                                <a href="{{route('downloadPrevisionVoice',["date"=>date('d-m-Y',strtotime($prevision->date_envoie)),"voice"=>Crypt::encryptString($prevision->message)])}}">
                                                <span class='chip green lighten-3'>
                                                    <i class="material-icons right">file_download</i>
                                                    List
                                                </span>
                                                </a>
                                            @else
                                                <a href="{{route('downloadPrevision',["date"=>date('Y-m-d',strtotime($prevision->date_envoie)),"message"=>Crypt::encryptString($prevision->message)])}}">
                                                <span class='chip green lighten-3'>
                                                    <i class="material-icons right">file_download</i>
                                                    List
                                                </span>
                                                </a>
                                            @endif

                                        </td>

                                    @endif
                                    @if (in_array($_SESSION['role'],array("ADMIN","SUPERADMIN")))
                                        <td>
                                            {{--                                            <a href='#' id='{{$prevision->id}}' class='inactif '>--}}
                                            <a href='#' id='#' class='inactif '>
                                                <span class='chip yellow lighten-5'><span
                                                        class='yellow-text'>Modifier</span></span>
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <th>Message</th>
                            <th>Zone</th>
                            <th>Région</th>
                            <th>Date</th>
                            @if($_SESSION['role'] == "ONG")
                                <th>Nb Prod.</th>
                                <th>Telechargement</th>
                                {{--                                                                <th>Details</th>--}}
                            @endif
                            @if (in_array($_SESSION['role'],array("ADMIN","SUPERADMIN")))
                                <th>Action</th>
                            @endif
                            </tfoot>
                        </table>
                        @endif

                    </div>
                </div>
        </div>

    </section>
@endsection
@section('other-js-script')
    {{--    <script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>--}}
    {{--    <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>--}}
    {{--    <script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>--}}
    {{--    <script src="{{ asset('assets/js/scripts/extra-components-sweetalert.js') }}"></script>--}}
    {{--    <script src="{{ asset('assets/js/providers/message.js') }}"></script>--}}
    {{--    <script src="{{ asset('assets/js/providers/set_state.js') }}"></script>--}}
    {{--    <script src="{{ asset('assets/js/scripts/card-advanced.js') }}"></script>--}}
    {{--    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.0/js/dataTables.buttons.min.js"></script>--}}
    {{--    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.flash.min.js"></script>--}}
    {{--    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>--}}
    {{--    <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>--}}
    {{--    <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>--}}
    {{--    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.html5.min.js"></script>--}}
    {{--    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.print.min.js"></script>--}}

    <script>
        $(document).ready(() => {
            // alert('work');
            $('.previsionTable tfoot th').each(function () {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');

            });

            var table = $('.previsionTable').DataTable({
                dom: "Bfrtip",
                buttons: ["colvis", "excel", "print"],
                stateSave: true,
                buttons: true,
                language: {
                    decimal: "",
                    emptyTable: "Pas de données trouvées",
                    info: "_START_ à _END_ sur _TOTAL_ entrees",
                    infoEmpty: "0 sur 0 entrees",
                    infoFiltered: "(filtered from _MAX_ total entries)",
                    infoPostFix: "",
                    thousands: ",",
                    loadingRecords: "Chargement...",
                    processing: "",
                    search: "Recherche:",
                    zeroRecords: "No matching records found",
                    paginate: {
                        first: "Premier",
                        last: "Dernier",
                        next: "Suivant",
                        previous: "Précédent",
                    },
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending",
                    },
                },
                initComplete: function () {
                    // Apply the search
                    this.api()
                        .columns()
                        .every(function () {
                            var that = this;

                            $('input', this.footer()).on('keyup change clear', function () {
                                if (that.search() !== this.value) {
                                    that.search(this.value).draw();
                                }
                            });
                        });

                    var r = $('.previsionTable tfoot th');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('.previsionTable thead').append(r);
                    $('#search_0').css('text-align', 'center');
                },
            });

            // table.on('click', 'tbody tr td', function () {
            //     let data = table.cell(this).data();
            //     let row = table.row(this).data()[0]
            //     let counter = 0
            //     // alert(row)
            //     if (data.includes("btn_producer")) {
            //         // alert(row)
            //         //     Call API for Number
            //         let entite = $("#id_entite").val()
            //         let root = $('meta[name="url"]').attr("content")
            //
            //         $.ajax({
            //             async: false,
            //             type: "GET",
            //             url: root + "/allprevision/nbProducer/" + row + "/" + entite,
            //             dataType: "json",
            //             headers: {
            //                 Authorization:
            //                     "Bearer " +
            //                     jQuery('meta[name="token"]').attr("content"),
            //             },
            //             timeout: 10000,
            //             success: function (results) {
            //                 console.log(results)
            //                 counter = results
            //
            //             },
            //             error: function () {
            //                 counter = 0
            //                 console.log("API get nombre Producer doesn't work")
            //                 // alert(
            //                 //     "API get nombre Producer doesn't work"
            //                 // );
            //             },
            //         });
            //
            //         table.cell(this).data(counter)
            //
            //     }
            // });


        });
    </script>

@endsection
{{-- Old Modal for voice Creation Comment--}}
{{--<!-- Modal Structure -->--}}
{{--<div id="modal_prevision_sms" class="modal">--}}
{{--    <div class="modal-content">--}}
{{--        <h4>Nouvelle Prévision </h4>--}}
{{--        <div class="divider mt-2"></div>--}}
{{--        <div class="row">--}}
{{--            <div class="col s8">--}}
{{--                <ul class="tabs">--}}
{{--                    <li class="tab col m4"><a href="#test1" class="active">Localité</a></li>--}}
{{--                    <li class="tab col m4"><a class="" href="#test2">Réseau</a></li>--}}
{{--                    <li class="tab col m4"><a class="" href="#test4">Zone</a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            <div id="test1" class="col s12">--}}
{{--                <form id="form-campagne-update" method="POST" action="#">--}}
{{--                    @csrf--}}
{{--                    <div class="row">--}}
{{--                        --}}{{-- <div class="input-field col s12">--}}
{{--                      <textarea id="textarea1" class="materialize-textarea" data-length="120"></textarea>--}}
{{--                      <label for="textarea1">Textarea</label>--}}
{{--                    </div> --}}
{{--                        <div class="file-field input-field col s6">--}}
{{--                            <div class="btn">--}}
{{--                                <span>Fichier audio(MP3)</span>--}}
{{--                                <input type="file">--}}
{{--                            </div>--}}
{{--                            <div class="file-path-wrapper">--}}
{{--                                <input class="file-path validate" type="text">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col s12 m6 l6">--}}
{{--                            <div class="input-field">--}}
{{--                                <select class="browser-default region" id="pluvio"--}}
{{--                                        name="langue">--}}
{{--                                    <option value="" disabled selected>Choisissez la langue de--}}
{{--                                        réception--}}
{{--                                    </option>--}}
{{--                                    --}}{{-- @foreach ($regions as $region)--}}
{{--                                    <option value="{{ $region->id }}">{{ $region->region }}--}}
{{--                                    </option>--}}
{{--                                @endforeach --}}
{{--                                </select>--}}
{{--                                <label class="active" for="users-list-status">Langue</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col s12 m6 l6">--}}
{{--                            <div class="input-field">--}}
{{--                                <select class="browser-default region" id="pluvio"--}}
{{--                                        name="region">--}}
{{--                                    <option value="" disabled selected>Choisissez le région--}}
{{--                                    </option>--}}
{{--                                    @foreach ($regions as $region)--}}
{{--                                        <option value="{{ $region->id }}">{{ $region->region }}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                <label class="active" for="users-list-status">Région</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col s12 m6 l6">--}}
{{--                            <div class="input-field">--}}
{{--                                <select class="browser-default dept" id="date" name="dept">--}}
{{--                                    <option value="" disabled selected>Choisissez le--}}
{{--                                        département--}}
{{--                                    </option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}

{{--                        <div class="col s12 m6 l6">--}}
{{--                            <div class="input-field">--}}
{{--                                <select class="browser-default commune" id=""--}}
{{--                                        name="commune">--}}
{{--                                    <option value="" disabled selected>Choisissez le commune--}}
{{--                                    </option>--}}

{{--                                </select>--}}
{{--                                <label class="active" for="users-list-status">Commune</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col s12 m6 l6">--}}
{{--                            <div class="input-field">--}}
{{--                                <select class=" browser-default localite" id="localite"--}}
{{--                                        name="localite">--}}
{{--                                    <option value="" disabled selected>Choisissez la localité--}}
{{--                                    </option>--}}
{{--                                    <option value="">Localité 1</option>--}}
{{--                                </select>--}}
{{--                                <label class="active" for="users-list-status">Localité</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <a id=""--}}
{{--                           class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--            <div id="test2" class="col s12">--}}
{{--                <form id="form-campagne-update" method="POST" action="#">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col s12 m6 l12">--}}
{{--                            <div class="file-field input-field">--}}
{{--                                <div class="btn">--}}
{{--                                    <span>Fichier audio(MP3)</span>--}}
{{--                                    <input type="file">--}}
{{--                                </div>--}}
{{--                                <div class="file-path-wrapper">--}}
{{--                                    <input class="file-path validate" type="text">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col s12 m6 l6">--}}
{{--                            <div class="input-field">--}}
{{--                                <div class="input-field">--}}
{{--                                    <select class=" browser-default localite" id="localite"--}}
{{--                                            name="langue">--}}
{{--                                        <option value="" disabled selected>Choisissez la--}}
{{--                                            langue--}}
{{--                                            de réception--}}
{{--                                        </option>--}}
{{--                                        --}}{{-- <option value="">Localité 1</option> --}}
{{--                                    </select>--}}
{{--                                    <label class="active" for="users-list-status">Langue de--}}
{{--                                        réception</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col s12 m6 l6">--}}
{{--                            <div class="input-field">--}}
{{--                                <div class="input-field">--}}
{{--                                    <select class="browser-default localite" id="localite"--}}
{{--                                            name="localite">--}}
{{--                                        <option value="" disabled selected>Choisissez la--}}
{{--                                            localité--}}
{{--                                        </option>--}}
{{--                                        <option value="">Localité 1</option>--}}
{{--                                    </select>--}}
{{--                                    <label class="active"--}}
{{--                                           for="users-list-status">Localité</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <a id="swalert"--}}
{{--                           class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--            <div id="test4" class="col s12">--}}
{{--                <form id="form-campagne-update" method="POST" action="#">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col s12 m6 l12">--}}
{{--                            <div class="file-field input-field">--}}
{{--                                <div class="btn">--}}
{{--                                    <span>Fichier audio(MP3)</span>--}}
{{--                                    <input type="file">--}}
{{--                                </div>--}}
{{--                                <div class="file-path-wrapper">--}}
{{--                                    <input class="file-path validate" type="text">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col s12 m6 l6">--}}
{{--                            <div class="input-field">--}}
{{--                                <div class="input-field">--}}
{{--                                    <select class=" browser-default localite" id="localite"--}}
{{--                                            name="localite">--}}
{{--                                        <option value="" disabled selected>Choisissez la--}}
{{--                                            langue--}}
{{--                                            de réception--}}
{{--                                        </option>--}}
{{--                                        <option value="">Zone 1</option>--}}
{{--                                    </select>--}}
{{--                                    <label class="active" for="users-list-status">Langue de--}}
{{--                                        réception</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col s12 m6 l6">--}}
{{--                            <div class="input-field">--}}
{{--                                <div class="input-field">--}}
{{--                                    <select class=" browser-default localite" id="localite"--}}
{{--                                            name="localite">--}}
{{--                                        <option value="" disabled selected>Choisissez la zone--}}
{{--                                        </option>--}}
{{--                                        <option value="">Zone 1</option>--}}
{{--                                    </select>--}}
{{--                                    <label class="active" for="users-list-status">Zone</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <a id=""--}}
{{--                           class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="modal-footer">--}}
{{--        <a href="#!"--}}
{{--           class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div id="modal_prevision_voice" class="modal">--}}
{{--    <div class="modal-content">--}}
{{--        <h4>Nouvelle Prévision | SMS</h4>--}}
{{--        <div class="divider mt-2"></div>--}}
{{--        <div class="row">--}}
{{--            <div class="col s12">--}}
{{--                <ul class="tabs">--}}
{{--                    <li class="tab col m3"><a href="#test5">Localité</a></li>--}}
{{--                    <li class="tab col m3"><a class="active" href="#test6">Reseau</a></li>--}}
{{--                    <li class="tab col m3"><a href="#test7">Zone</a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            <div id="test5" class="col s12">--}}
{{--                <form id="form-create-prevision-localite-sms" method="POST" action="#">--}}
{{--                    @csrf--}}
{{--                    <div class="row">--}}
{{--                        <div class="input-field col s12">--}}
{{--                                                    <textarea id="textarea1" class="materialize-textarea"--}}
{{--                                                              data-length="120" name="message"></textarea>--}}
{{--                            <label for="textarea1">Textarea</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col s12 m6 l6">--}}
{{--                            <div class="input-field">--}}
{{--                                <select class="browser-default region" id="pluvio"--}}
{{--                                        name="region">--}}
{{--                                    <option value="" disabled selected>Choisissez la région----}}
{{--                                    </option>--}}
{{--                                    @foreach ($regions as $region)--}}
{{--                                        <option--}}
{{--                                            value="{{ $region->id }}">{{ $region->region }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                <label class="active" for="users-list-status">Région</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col s12 m6 l6">--}}
{{--                            <div class="input-field">--}}
{{--                                <select class="browser-default dept" id="date"--}}
{{--                                        name="dept">--}}
{{--                                    <option value="" disabled selected>Choisissez le--}}
{{--                                        Département--}}
{{--                                    </option>--}}
{{--                                    --}}{{-- <option value="">departement 1</option> --}}
{{--                                    --}}{{-- <option value="">Inactif</option> --}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}

{{--                        <div class="col s12 m6 l6">--}}
{{--                            <div class="input-field">--}}
{{--                                <select class="browser-default commune" id="pluvio"--}}
{{--                                        name="commune">--}}
{{--                                    <option value="" disabled selected>Choisissez le commune--}}
{{--                                    </option>--}}

{{--                                </select>--}}
{{--                                <label class="active" for="users-list-status">Commune</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col s12 m6 l6">--}}
{{--                            <div class="input-field">--}}
{{--                                <select class=" browser-default localite" id="localite"--}}
{{--                                        name="localite">--}}
{{--                                    <option value="" disabled selected>Choisissez la localité--}}
{{--                                    </option>--}}
{{--                                    <option value="">Localité 1</option>--}}
{{--                                </select>--}}
{{--                                <label class="active" for="users-list-status">Localité</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <a id="btn-create-localite-prevision-sms"--}}
{{--                           class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </form>--}}

{{--            </div>--}}
{{--            <div id="test6" class="col s12">--}}

{{--                <form id="form-campagne-update" method="POST" action="#">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col s12 m6 l12">--}}
{{--                            <div class="input-field">--}}
{{--                                <div class="input-field col s12">--}}
{{--                                                            <textarea id="textarea1" class="materialize-textarea"--}}
{{--                                                                      data-length="120"></textarea>--}}
{{--                                    <label for="textarea1">Textarea</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col s12 m6 l6">--}}
{{--                            <div class="input-field">--}}
{{--                                <div class="input-field">--}}
{{--                                    <select class=" browser-default" id="localite"--}}
{{--                                            name="langue">--}}
{{--                                        <option value="" disabled selected>Choisissez la--}}
{{--                                            langue de réception--}}
{{--                                        </option>--}}
{{--                                        --}}{{-- <option value="">Localité 1</option> --}}
{{--                                    </select>--}}
{{--                                    <label class="active" for="users-list-status">Langue de--}}
{{--                                        réception</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col s12 m6 l6">--}}
{{--                            <div class="input-field">--}}
{{--                                <div class="input-field">--}}
{{--                                    <select class=" browser-default localite" id="localite"--}}
{{--                                            name="localite">--}}
{{--                                        <option value="" disabled selected>Choisissez la--}}
{{--                                            localité--}}
{{--                                        </option>--}}
{{--                                        <option value="">Localité 1</option>--}}
{{--                                    </select>--}}
{{--                                    <label class="active"--}}
{{--                                           for="users-list-status">Localité</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <a id="swalert"--}}
{{--                           class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--            <div id="test7" class="col s12">--}}
{{--                <form id="form-create-prevision-zone-sms" method="" action="#">--}}

{{--                    <div class="row">--}}
{{--                        <div class="col s12 m6 l12">--}}
{{--                            <div class="input-field">--}}
{{--                                <div class="input-field col s12">--}}
{{--                                                            <textarea id="textarea1" class="materialize-textarea"--}}
{{--                                                                      name="message" data-length="120"></textarea>--}}
{{--                                    <label for="textarea1">Textarea</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col s12 m6 l12">--}}
{{--                            <div class="input-field">--}}
{{--                                <div class="input-field">--}}
{{--                                    <select class=" browser-default zone" id="zone" name="zone">--}}
{{--                                        <option value="" disabled selected>Choisissez la--}}
{{--                                            zone----}}
{{--                                        </option>--}}
{{--                                        @foreach ($zones as $zone)--}}
{{--                                            <option--}}
{{--                                                value="{{$zone->id_zone}}">{{$zone->designation}}</option>--}}
{{--                                        @endforeach--}}
{{--                                        --}}{{-- <option value="">Zone 1</option> --}}
{{--                                    </select>--}}
{{--                                    <label class="active" for="users-list-status">Zone</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <a id="btn-create-zone-prevision-sms"--}}
{{--                           class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                </form>--}}

{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--    <div class="modal-footer">--}}
{{--        <a href="#!"--}}
{{--           class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>--}}
{{--    </div>--}}
{{--</div>--}}
