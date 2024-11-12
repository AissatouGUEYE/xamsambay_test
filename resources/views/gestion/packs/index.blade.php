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

@php
    // Enlever la possbilite de souscrire a un pack deja souscrit
    // lister les abonnement concernant le profil connecte
    $test = $packs[0];
    $xeweul = $packs[1];
    $confort = $packs[2];
    $prestige = $packs[3];
    // $user = Auth::user();
    // dd($_SESSION['role_user']);
@endphp
@section('main_content')
    {{-- @if ($profil === 'ADMIN' || $profil === 'SUPERADMIN')
        <section class="users-list-wrapper section">
            <div class="users-list-filter">
                <div class="card-panel">
                    <div class="row">
                        <form method="POST" action="#">
                            @csrf
                            <div class="col s12 m6 l4">
                                <label for="users-list-verified">Type de Pack</label>
                                <div class="input-field">
                                    <select class="form-control" name="users-list-verified">
                                        <option value=null>Pas de filtre</option>
                                        <option value="M">M</option>
                                        <option value="F">F</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col s12 m6 l4">
                                <label for="users-list-status">Profil</label>
                                <div class="input-field">
                                    <select class="form-control" name="users-list-status">
                                        <option value=null>Pas de filtre</option>
                                        <option value=1>Actif</option>
                                        <option value=0>Inactif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col s12 m6 l4 mt-4">
                                <a href="{{ route('packs.create') }}" type="button"
                                    class="btn green waves-effect waves-light btn-sm ml-3" href="#"><i
                                        class="material-icons pt-1">add_circle</i>
                                    Pack</a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
    @endif --}}

    <br>
    @if ($profil != 'ADMIN' && $profil != 'SUPERADMIN')
        <div class="users-list-table">
            <div class="card">
                <div class="card-content">
                    <div id="image-card" class="section">
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <h4 class="header">Packs {{ $profil }}</h4>
                            </div>
                            <div class="col s12 m6 l6 mt-4" style="text-align: right">
                                <a type="button" class="btn green waves-effect waves-light btn-sm ml-3"
                                    href="{{ route('packs.list') }}">
                                    Mes Packs</a>
                            </div>
                        </div>
                        @isset($test)
                            <div class="row">
                                <p>PACK TEST</p>
                                {{-- <div class="carousel"> --}}
                                @foreach ($testProfil as $item)
                                    @php
                                        $description = $item->descriptionpack;
                                    @endphp
                                    <div class="col s10 m6 l6">
                                        <div class="card" style="background-image: linear-gradient(#b07f4a9e, #c99f68a9);">
                                            <div class="card-content white-text center" style="padding:5px !important">
                                                <h6 class="card-title font-weight-400"
                                                    style="color: #ffe900; text-decoration:underline">
                                                    {{ $item->type_pack }}
                                                    {{ $item->canal }}</h6>
                                                <p class="" style="color: black;font-weight:700">
                                                    {{ $item->pricing }} FCFA</p>
                                                <ul style="padding-bottom: 2px">
                                                    @foreach ($description as $li)
                                                        <li>{{ $li }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="card-action border-non center pb-3"
                                                style="background-image: linear-gradient(to bottom right,#c99f68a9,#b07f4a9e);">
                                                @if ($item->canal == 'SMS')
                                                    <a href="{{ route('packs.validation', [$item->id, $item->type_entite]) }}"
                                                        class="waves-effect waves-light btn box-shadow"
                                                        style="background-color: #33a644"
                                                        @if ($testSMS) disabled @endif>Souscrire</a>
                                                @endif
                                                @if ($item->canal == 'VOICE')
                                                    <a href="{{ route('packs.validation', [$item->id, $item->type_entite]) }}"
                                                        class="waves-effect waves-light btn box-shadow"
                                                        style="background-color: #33a644"
                                                        @if ($testVOICE) disabled @endif>Souscrire</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endisset
                    <div class="row">
                        <p>Liste des Packs pour le profil {{ $profil }}</p>
                        <div class="carousel">
                            @isset($pack)
                                @foreach ($pack as $item)
                                    @php
                                        $checked = false;
                                        $description = $item->descriptionpack;
                                        foreach ($abonnements as $key => $abonnement) {
                                            if ($abonnement->id_pack == $item->id) {
                                                $checked = true;
                                            }
                                        }
                                    @endphp
                                    <div class="carousel-item col s10 m6 l6">
                                        <div class="card" style="background-image: linear-gradient(#b07f4a9e, #c99f68a9);">
                                            <div class="card-content white-text center" style="padding:5px !important">
                                                <h6 class="card-title font-weight-400"
                                                    style="color: #ffe900; text-decoration:underline">
                                                    {{ $item->type_pack }}
                                                    {{ $item->canal }}</h6>
                                                <p class="" style="color: black;font-weight:700">
                                                    {{ $item->pricing }} FCFA</p>
                                                <ul style="padding-bottom: 2px">
                                                    @foreach ($description as $li)
                                                        <li>{{ $li }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="card-action border-non center pb-3"
                                                style="background-image: linear-gradient(to bottom right,#c99f68a9,#b07f4a9e);">
                                                <a href="{{ route('packs.validation', [$item->id, $item->type_entite]) }}"
                                                    class="waves-effect waves-light btn box-shadow"
                                                    @if ($checked) style="background-color: #ffe900"
                                                     @else
                                                    style="background-color: #33a644" @endif>
                                                    @if ($checked)
                                                        Renouveler Pack
                                                    @else
                                                        Souscrire
                                                    @endif
                                                </a>
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
    @else
        <div class="users-list-table">
            <div class="card">
                <div class="card-header">
                    {{-- <div class="row">
                        <div class="col s12 m6 l5">

                        </div>
                        <div class="col s12 m6 l5">

                        </div>
                        <div class="col s12 m6 l2 mt-2">


                        </div>
                    </div> --}}
                    {{-- @if (in_array($_SESSION['role_user'], ['ADMIN', 'FINANCE'])) --}}
                    <a href="{{ route('packs.create') }}" type="button"
                        class="btn green waves-effect waves-light btn-sm ml-3 right mt-3 mr-3" href="#"><i
                            class="material-icons pt-1">add_circle</i>
                        Pack</a>
                    {{-- @endif --}}
                </div>
                <div class="card-content">
                    <div id="image-card" class="section">

                        <div class="row">
                            <div class="col s12 m6 l6">
                                <h4 class="header">{{ $profil }}</h4>
                            </div>
                            <div class="col s12 m6 l6 mt-4" style="text-align: right">
                                {{-- <a type="button" class="btn green waves-effect waves-light btn-sm ml-3" href="#"><i
                                    class="material-icons pt-1">add_circle</i>
                                Pack</a> --}}
                            </div>
                        </div>
                        <p>Liste des Packs Xeweul</p>
                        <div class="carousel">
                            @isset($xeweul)
                                @foreach ($xeweul as $item)
                                    @php
                                        // dd($item);
                                        $description = $item->descriptionpack;
                                    @endphp
                                    <div class="carousel-item col s10 m6 l6">
                                        <div class="card" style="background-image: linear-gradient(#b07f4a9e, #c99f68a9);">
                                            <div class="card-content white-text center" style="padding:5px !important">
                                                <h6 class="card-title font-weight-400"
                                                    style="color: #ffe900; text-decoration:underline">
                                                    {{ $item->type_pack }}
                                                    {{ $item->canal }}</h6>
                                                <p style="color: black ; font-weight:700">PROFIL {{ $item->type_entite }} /
                                                    {{ $item->pricing }} FCFA</p>
                                                <ul style="padding-bottom: 2px">
                                                    @foreach ($description as $li)
                                                        <li>{{ $li }}</li>
                                                    @endforeach
                                                </ul>
                                                {{-- <p>{{ $item->pricing }}</p> --}}
                                            </div>
                                            <div class="card-action border-non center pb-3"
                                                style="background-image: linear-gradient(to bottom right,#c99f68a9,#b07f4a9e);">
                                                {{-- @if (in_array($_SESSION['role_user'], ['ADMIN', 'FINANCE'])) --}}
                                                <a title="Modifier Pack"
                                                    href="{{ route('pack.edit', [$item->id, $item->type_entite]) }}"
                                                    class="waves-effect waves-light btn box-shadow"
                                                    style="background-color: #ffa900"> <i class="material-icons">edit</i>
                                                </a>
                                                {{-- @endif --}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                        </div>

                        <p>Liste des Packs Confort</p>
                        <div class="carousel">
                            @isset($confort)
                                @foreach ($confort as $item)
                                    @php
                                        $description = $item->descriptionpack;
                                    @endphp
                                    <div class="carousel-item col s10 m6 l6">
                                        <div class="card" style="background-image: linear-gradient(#b07f4a9e, #c99f68a9);">
                                            <div class="card-content white-text center" style="padding:5px !important">
                                                <h6 class="card-title font-weight-400"
                                                    style="color: #ffe900; text-decoration:underline">
                                                    {{ $item->type_pack }}
                                                    {{ $item->canal }}</h6>
                                                <p style="color: black; font-weight:700">PROFIL {{ $item->type_entite }} /
                                                    {{ $item->pricing }} FCFA</p>
                                                <ul style="padding-bottom: 2px">
                                                    @foreach ($description as $li)
                                                        <li>{{ $li }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="card-action border-non center pb-3"
                                                style="background-image: linear-gradient(to bottom right,#c99f68a9,#b07f4a9e);">
                                                {{-- @if (in_array($_SESSION['role_user'], ['ADMIN', 'FINANCE'])) --}}
                                                <a title="Modifier Pack"
                                                    href="{{ route('pack.edit', [$item->id, $item->type_entite]) }}"
                                                    class="waves-effect waves-light btn box-shadow"
                                                    style="background-color: #ffa900"> <i class="material-icons">edit</i>
                                                </a>
                                                {{-- @endif --}}
                                                {{-- <a class="waves-effect waves-light btn box-shadow"
                                                style="background-color: #33a644"><i class="material-icons">delete</i>
                                            </a> --}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                        </div>

                        <p>Liste des Packs Prestige</p>
                        <div class="carousel">
                            @isset($prestige)
                                @foreach ($prestige as $item)
                                    @php
                                        $description = $item->descriptionpack;
                                    @endphp
                                    <div class="carousel-item col s10 m6 l6">
                                        <div class="card" style="background-image: linear-gradient(#b07f4a9e, #c99f68a9);">
                                            <div class="card-content white-text center" style="padding:5px !important">
                                                <h6 class="card-title font-weight-400"
                                                    style="color: #ffe900; text-decoration:underline">
                                                    {{ $item->type_pack }}
                                                    {{ $item->canal }} </h6>
                                                <p style="color: black; font-weight:700">PROFIL {{ $item->type_entite }} /
                                                    {{ $item->pricing }} FCFA</p>
                                                <ul style="padding-bottom: 2px">
                                                    @foreach ($description as $li)
                                                        <li>{{ $li }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="card-action border-non center pb-3"
                                                style="background-image: linear-gradient(to bottom right,#c99f68a9,#b07f4a9e);">
                                                {{-- @if (in_array($_SESSION['role_user'], ['ADMIN', 'FINANCE'])) --}}
                                                <a title="Modifier Pack"
                                                    href="{{ route('pack.edit', [$item->id, $item->type_entite]) }}"
                                                    class="waves-effect waves-light btn box-shadow"
                                                    style="background-color: #ffa900"> <i class="material-icons">edit</i>
                                                </a>
                                                {{-- @endif --}}
                                                {{-- <a class="waves-effect waves-light btn box-shadow"
                                                style="background-color: #33a644"><i class="material-icons">delete</i>
                                            </a> --}}
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
    @endif

@endsection
@section('other-js-script')
    <script>
        $(document).ready(function() {
            $('.carousel').carousel();
        });
    </script>
@endsection
