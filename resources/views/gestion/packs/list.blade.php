@extends('layouts.master')
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
    <li class="breadcrumb-item active" style="color:#ffe900"> Mes Souscriptions
    </li>
@endsection
@section('main_content')

    {{-- Get Pack by Id Profil --}}
    @php
        // dd($list);
    @endphp
    @if (!empty($list))
        <div class="row">
            @foreach ($list as $key => $item)
                @php
                    $description = $item->descriptionpack;
                @endphp
                <div class="col s4 m4 l4" style="padding-top: 10px">
                    <div class="card" style="background-color:#c99f68">
                        <div class="card-content center" style="padding:5px !important;color:white">
                            <h6>Pack {{ $item->type_pack }}</h6>
                            @if ($item->reference)
                                <p>Reference : {{ $item->reference }}</p>
                            @endif
                            <em>
                                Du <br>
                                @php
                                    $input = strtotime($item->date_creation);
                                    echo date('d/m/Y', $input);
                                @endphp
                                <br> au <br>
                                @php
                                    $input = strtotime($item->date_expiration);
                                    echo date('d/m/Y', $input);
                                @endphp
                                {{-- @if ($item->date_expiration) --}}
                                {{-- @else
                                    @php
                                        echo date('d/m/Y', $item->date_fin_pack);
                                    @endphp
                                @endif --}}
                            </em>
                            <br><br>
                            <p>SMS restant : {{ $item->nb_sms_restant }}</p>
                            <p>Secondes d'appels restant : {{ $item->nb_sec_voice_restant }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="row" style="margin-top:100px ">
            <div class="card">
                <div class="card-content center">
                    Pas de souscriptions disponibles. Veuillez acheter un pack!
                </div>
            </div>
        </div>
    @endif

@endsection
