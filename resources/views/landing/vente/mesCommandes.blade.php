@extends('welcome')

@section('landingContent')
    @include('landing.layouts.dashboard_commandes')
    @include('landing.vente.shop.mesCommandes')

@endsection
