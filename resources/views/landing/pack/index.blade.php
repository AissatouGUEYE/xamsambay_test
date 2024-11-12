@extends('welcome')
@foreach ($profils as $item)
    @if ($item->nom_typentite == $acteur)
        @php
            $pro = $item->libelle;
            $description = $item->description;
            $annexe = $item->annexe;
            $section1 = $item->section1;
            $section2 = $item->section2;
            $section3 = $item->section3;
            $im1 = $item->image1;
            $im2 = $item->image2;
            $im3 = $item->image3;
            
        @endphp
    @endif
@endforeach

@section('landingContent')
    @include('landing.layouts.dashboard_pack')
    @include('landing.pack.partials.listPack')

    <!-- Start Blog Section -->
    <div class="blog text-dark">
        @include('landing.pack.partials.blog')

    </div><!-- End Blog Section -->

    @include('landing.layouts.activites')
@endsection
