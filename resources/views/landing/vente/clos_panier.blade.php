@extends('welcome')
<style>
    .blink {
        animation: blinker 1s linear infinite;
    }

    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }

    .fa {
        font-size: 20px;
    }
    #ul_top_hypers li {
        float: left;
    margin-right: 2em;
    text-transform: uppercase;
    font-size: 1.2em;
    line-height: 1;
    border-right: 1px dashed #d3ced2;
    padding-right: 2em;
    margin-left: 0;
    padding-left: 0;
    list-style-type: none;
}
    

   
strong{
    display: block;
    font-size: 1em;
    text-transform: none;
    line-height: 1.5;
}
</style>

@section('landingContent')
    {{-- @include('landing.layouts.script') --}}
    @include('landing.layouts.dashboard_panier')
    @include('landing.vente.shop.clos_panier')
    <script src="{{ asset('assets\js\providers\count_panier.js') }}"></script>

@endsection
