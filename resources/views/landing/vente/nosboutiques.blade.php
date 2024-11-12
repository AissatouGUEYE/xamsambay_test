@extends('welcome')

@section('landingContent')

@include('landing.layouts.dashboard_vente')
@include('landing.vente.shop.nosboutiques')
    @include('landing.layouts.comment')

@endsection