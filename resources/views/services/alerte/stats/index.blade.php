@extends('layouts.master')
@section('page-title')
    Services Alertes
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('alertes') }}">Alertes</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#" style="color:#ffe900">Statistiques</a>
    </li>
@endsection
@section('main_content')
    <div class="users-list-table">
        <div class="card">
            <div class="card-header">
                <h5 class="pt-2 ml-3">Statistiques Alertes Diffusion</h5>
            </div>
            <div class="card-content">
                <div class="users-list-table">
                    <div class="card">
                        <div class="card-content">
                            <!-- datatable start -->
                            <div class="responsive-table">
                                <table id="statsTable" class="table display striped">
                                    <thead>
                                    <tr>
                                        <th>Contenu</th>
                                        {{-- <th>Nb Prod</th> --}}

                                        <th>Date Envoi</th>
                                        @if ($_SESSION['role'] == 'ADMIN' || $_SESSION['role'] == 'SUPERADMIN')
                                            <th>Type Alerte</th>
                                            <th>Structure</th>
                                            <th>Expediteur</th>
                                        @endif
                                        <th>Liste Cibles</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @isset($stats)
                                        @foreach ($stats as $stat)
                                            <tr>
                                                <td>
                                                    @if ($stat->sms != null)
                                                        @if (strlen($stat->sms) >= 20)
                                                            @php
                                                                // $var_sms = substr($stat->sms, 0, 15) . ' [..] '; //. substr($stat->sms, -10)
                                                                $var_sms = $stat->sms; //. substr($stat->sms, -10)
                                                            @endphp
                                                            {{ $var_sms }}
                                                        @else
                                                            {{ $stat->sms }}
                                                        @endif
                                                    @else
                                                        {{-- @if ($stat->voice != null) --}}
                                                        {{-- <a href="{{ $stat->voice }}"
                                                            style="display:flex;justify-content:center">
                                                            <i class="material-icons green-text"
                                                                style="font-size:40px">play_circle_filled</i>
                                                        </a> --}}
                                                        <audio controls src="{{ $stat->voice }}">
                                                            <source src="{{ $stat->voice }}">
                                                        </audio>
                                                    @endif
                                                </td>

                                                {{-- <td>
                                                    <span class="px-1"><i
                                                            class="">{{ $stat->nombre_sms }}</i></span>
                                                </td> --}}

                                                <td>{{ $stat->date }}</td>

                                                @if ($_SESSION['role'] == 'ADMIN' || $_SESSION['role'] == 'SUPERADMIN')
                                                    <td>
                                                        @if ($stat->type_sms == 'ALERTE')
                                                            Diffusion
                                                        @else
                                                            {{ $stat->type_sms }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $stat->nom_entite_utilisateur }}</td>
                                                    <td>{{ $stat->prenom_utilisateur }} {{ $stat->nom_utilisateur }}</td>
                                                @endif
                                                <td>
                                                    <form action="{{ route('alertes.stats.details') }}" method="post">
                                                        @csrf
                                                        <input type="text" hidden name="sms"
                                                               value="{{ $stat->sms }}">
                                                        <input type="text" hidden name="voice"
                                                               value="{{ $stat->voice }}">
                                                        <input type="text" hidden name="date_reception"
                                                               value="{{ $stat->date }}">
                                                        <input type="text" hidden name="type_alerte"
                                                               value="{{ $stat->id_type_sms }}">
                                                        <button type="submit" class="border-none bg-transparent">
                                                            <i class="material-icons green-text">visibility</i>

                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="{{ route('alertes.stats.list') }}" method="post">
                                                        @csrf
                                                        <input type="text" hidden name="sms"
                                                               value="{{ $stat->sms }}">
                                                        <input type="text" hidden name="voice"
                                                               value="{{ $stat->voice }}">
                                                        <input type="text" hidden name="date_reception"
                                                               value="{{ $stat->date }}">
                                                        <input type="text" hidden name="type_alerte"
                                                               value="{{ $stat->id_type_sms }}">
                                                        <button type="submit"
                                                                class="btn chip border-none waves-effect waves-light green lighten-2 white-text">
                                                            <i
                                                                class="material-icons right">file_download</i><span
                                                                class="white-text">{{ $stat->nombre_sms }}</span>

                                                        </button>
                                                    </form>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endisset

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Contenu</th>
                                        {{-- <th>Nb Prod</th> --}}

                                        <th>Date Envoi</th>
                                        @if ($_SESSION['role'] == 'ADMIN' || $_SESSION['role'] == 'SUPERADMIN')
                                            <th>Type Alerte</th>
                                            <th>Structure</th>
                                            <th>Expediteur</th>
                                        @endif
                                        <th>Liste Cibles</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- datatable ends -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
