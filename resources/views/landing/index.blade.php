@extends('welcome')
{{-- {{request()->path()}} --}}
@section('landingContent')
    @include('landing.layouts.dashboard')
    @include('landing.layouts.offres')
    @include('landing.layouts.activites')
    @include('landing.layouts.services')
    @include('landing.layouts.chiffres')
@endsection
