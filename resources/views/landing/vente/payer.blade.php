@extends('welcome')

@section('landingContent')
    {{-- @include('landing.layouts.script') --}}
    @include('landing.layouts.dashboard_panier')
    @include('landing.vente.shop.panier')

@endsection
