@extends('layouts.master')
@section('page-title')
    Services Alertes
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('alertes.stats') }}">Alertes Stats</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#" style="color:#ffe900">Details Stats</a>
    </li>
@endsection
@php
    //    dd($stats);
        $campagn =isset ($stats['campaign_id'])?$stats['campaign_id']:1;
        $relance =isset ($stats['relance'])?$stats['relance']:1;
        $data = ($campagn == 1) ? $stats["data"]:$stats["data_lam"];
@endphp
@section('main_content')
    <div class="users-list-table">
        <div class="card">
            <div class="card-header">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s9">
                                @if ($stats['type_message'] == 'SMS')
                                    <h6 class="invoice-subtotal-value">{{ $stats['contenu'] }}</h6>
                                @else
                                    <audio controls src="{{ $stats['contenu'] }}">
                                        <source src="{{ $stats['contenu'] }}">
                                    </audio>
                                @endif
                            </div>
                            <div class="col s3">
                                {{--  Modal Formulaire with:
                                       the file storage link
                                       the id Campaign
                                       the input for file
                                                                   --}}
                                @if ($_SESSION['role'] == 'ADMIN' && $campagn!=1 && $relance == 0 )
                                    <a class="waves-effect waves-light  green darken-1 btn modal-trigger right"
                                       href="#modal-resend-alert"> <i class="material-icons">add</i> Relancer
                                    </a>
                                    {{--       Todo Checker la variable et travailler sur la mise a jour de cette variable apres resend                             --}}
                                @endif
                                <div id="modal-resend-alert" class="modal">
                                    <div class="modal-content">
                                        <h4 class="card-title">Relancer Alert - Campagne {{$campagn}}</h4>
                                        <div class="divider mt-2"></div>
                                        <form id="form-resend-alert" method="POST"
                                              action="{{route('alertes.stats.details.resend')}}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">

                                                <div class="col s12">
                                                    <div class="input-field">
                                                        <input type="text" id="campagn_id" name="campagn_id" hidden
                                                               value="{{$stats["campaign_id"]}}">
                                                        {{--                                                        <label for="campagn">Id Campaign</label>--}}
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <input type="text" id="link" name="link" hidden
                                                               value="{{$stats["contenu"]}}">
                                                        {{--                                                        <label class="active" for="campagn">Id Campaign</label>--}}
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col s12 m6 l12">
                                                    <div class="file-field input-field">
                                                        <div class="btn">
                                                            <span>Fichier audio(MP3)</span>
                                                            <input id="audiofile" type="file" name="audiofile"
                                                                   accept="audio/mp3,audio/*;capture=microphone">
                                                        </div>
                                                        <div class="file-path-wrapper">
                                                            <input class="file-path validate" type="text"
                                                                   name="audiofile_name">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">

                                                    <div class="col s12 display-flex justify-content-end mt-1">
                                                        <button id="formResendAlertBtn" type="button"
                                                                class="btn indigo">
                                                            Relancer
                                                        </button>
                                                        <a href="#"
                                                           class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-content">
                <div class="responsive-table">
                    <table id="page-length-option" class="display">

                        <thead>
                        <th>Numero</th>
                        <th>Status</th>
                        <th>Action</th>

                        </thead>
                        <tbody>
                        @if (!empty($data))
                            @foreach ($data as $num)
                                <tr>
                                    @if($campagn == 1)
                                        <td>{{ $num }}</td>
                                        <td> --</td>
                                    @else
                                        <td>{{ $num->phoneNumber }}</td>
                                        <td> {{$num->statusLabel}}</td>
                                    @endif
                                    <td>--</td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('other-js-script')
    <script>
        $(document).ready(function () {
            // let root = $('meta[name="url"]').attr("content");

            $('#formResendAlertBtn').click(function (e) {
                e.preventDefault();
                swal({
                    title: "Relancer Alertes",
                    text: "Voulez-vous relancer l'alerte?",
                    icon: 'info',
                    dangerMode: true,
                    buttons: {
                        cancel: 'Annuler',
                        delete: 'Oui'
                    }
                }).then(function (willDelete) {
                    if (willDelete) {
                        $('#form-resend-alert').submit();
                    } else {
                        // alert('Ajout annule!');
                    }
                });

            });
        });
    </script>
@endsection
