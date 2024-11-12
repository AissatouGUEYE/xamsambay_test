@extends('layouts.master')
@section('page-title')
    @if ($_SESSION['nom_entite'] == 'Admin')
        @if (isset($_SESSION['role_user']))
            {{ $_SESSION['role_user'] }} ({{ $_SESSION['nom_entite'] }})
        @else
            {{ $_SESSION['nom_entite'] }}
        @endif
    @else
        {{ $_SESSION['nom_entite'] }}
    @endif
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Dashboard</a>
    </li>
@endsection
@php
    $userid = Auth::user()->id;
    $id_entite = $_SESSION['id_entite'];
    $id_profil = $_SESSION['id'];

    $id_groupement = isset($_SESSION['groupement']) ? $_SESSION['groupement'] : null;

    $appels = isset($_SESSION['appels'])?intval($_SESSION['appels']):0;
    $init = $appels;
    $hours = floor($init / 3600);
    $minutes = floor(($init / 60) % 60);
    $seconds = $init % 60;

@endphp

@section('main_content')
    {{-- {{dd($_SESSION['role_user'])}} --}}
    <input type="text" id="id_user" hidden value="{{ $userid }}">
    <input type="text" name="id_entite" id="id_entite" hidden value="{{ $id_entite }}">
    <input type="text" name="id_profil" id="id_profil" hidden value="{{ $id_profil }}">
    <input type="text" name="id_groupement" id="id_groupement" hidden value="{{ $id_groupement }}">

    @if ($_SESSION['role'] === 'ADMIN' || $_SESSION['role'] === 'SUPERADMIN')
        @include('layouts.dash_ext.dash_admin')
    @endif

    @if ( $_SESSION['role'] === 'ONG')
        @include('layouts.dash_ext.dash_ong_op')
    @endif
    @if ($_SESSION['role'] === 'GERANT' && $_SESSION['role_user'] && $_SESSION['role_user'] === 'GESTIONNAIRE BD')
        @include('layouts.dash_ext.dash_gb')
    @endif
    @if ($_SESSION['role'] === 'GERANT' && $_SESSION['role_user'] && $_SESSION['role_user'] === 'GERANT PLUVIO')
        @include('layouts.dash_ext.dash_gb')
    @endif
    @if (
        $_SESSION['role'] === 'INTERPROFESSION' ||
            ($_SESSION['role'] === 'OP' && $_SESSION['profil'] === 'RESPONSABLE OP') ||
            ($_SESSION['role'] === 'UOP' && $_SESSION['profil'] === 'RESPONSABLE UOP ') ||
            ($_SESSION['role'] === 'AUOP' && $_SESSION['profil'] === 'RESPONSABLE AUOP'))
        @include('layouts.dash_ext.dash_resp_grpmt_interpro')
    @endif
    @if ($_SESSION['role'] === 'MLOUMER' || $_SESSION['role'] === 'ACHETEUR')
        @include('layouts.dash_ext.dash_mloumer_achteur_gerant')
    @endif
    @if ($_SESSION['role'] === 'SERVICE_TRANSPORT')
        @include('layouts.dash_ext.dash_transporteur')
    @endif
    @if ($_SESSION['role'] === 'INDIVIDUEL' || $_SESSION['role'] === 'PRODUCTEUR')
        @include('layouts.dash_ext.dash_producteur_individuel_fourn_intrant')
    @endif

    @if ($_SESSION['role'] === 'FOURNISSEUR_INTRANT')
        @include('layouts.dash_ext.dash_fourn_intrant')
    @endif

    @if ($_SESSION['role'] === 'FINANCIER' || $_SESSION['role'] === 'ASSURANCE')
        @include('layouts.dash_ext.dash_finance_assurance')
    @endif
    @if ($_SESSION['role'] == 'SERVICE_ETATIQUE' || $_SESSION['nom_type_entite'] == 'COMMISSION_CESSION')
        @include('layouts.dash_ext.dash_service_etatique')
    @endif
@endsection

@section('other-js-script')
    <script src="{{ asset('assets/js/analytics/ong-analytics.js') }}"></script>
@endsection
