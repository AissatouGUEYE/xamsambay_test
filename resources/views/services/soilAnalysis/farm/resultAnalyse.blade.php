@extends('layouts.master')
@section('page-title')
    Analyse du Sol
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a class="" href="{{ route('soil.analysis') }}">Analyse du Sol</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text" href="#">Resultat Analyse</a>
    </li>
@endsection
@section('main_content')
    @php
        // dd($result);
    @endphp
    <div class="users-list-table">
        @isset($result->clay)
            <div class="card">
                <div class="card-header padding-4">
                    <span>Profondeur (cm) : {{ $result->depth }}</span>
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="col s3">Argile (%) : {{ $result->clay }}</div>
                        <div class="col s3">Limon (%) : {{ $result->silt }}</div>
                        <div class="col s3">Sable (%) : {{ $result->sand }}</div>
                        <div class="col s3">Matiere Organique (g/kg): {{ $result->organic_matter }}</div>
                    </div>
                    <div class="row">
                        <div class="col s3">Taux de Salinite (dS/m): {{ $result->salinity }}</div>
                        <div class="col s3">Teneur en Carbone (g/kg): {{ $result->carbon_content }}</div>
                        <div class="col s3">pH : {{ $result->ph_level }}</div>
                        <div class="col s3">CEC Efficace (cmol/kg): {{ $result->effective_cec }}</div>
                    </div>
                    <div class="row">
                        <div class="col s3">Azote (g/kg): {{ $result->nitrogen }}</div>
                        <div class="col s3">Phosphore (ppm): {{ $result->phosphorus }}</div>
                        <div class="col s3">Potassium (ppm): {{ $result->potassium }}</div>
                        <div class="col s3">Soufre (ppm): {{ $result->sulphur }}</div>
                    </div>
                    <div class="row">
                        <div class="col s3">Aluminium (ppm): {{ $result->alumunium }}</div>
                        <div class="col s3">Magnesium (ppm): {{ $result->magnesium }}</div>
                        <div class="col s3">Calcium (ppm): {{ $result->calcium }}</div>
                        <div class="col s3">Zinc (ppm): {{ $result->zinc }}</div>
                    </div>
                    <div class="row">
                        <div class="col s3">Pierre (%): {{ $result->stone }}</div>
                        <div class="col s3">Densite Volumique (%): {{ $result->bulk_density }}</div>
                        <div class="col s3"></div>
                        <div class="col s3"></div>
                    </div>
                </div>
            </div>
        @endisset
        @isset($result->message)
            <div class="card">

                <div class="card-content">
                    <div class="row">
                        <div class="col s12">Product: {{ $result->product }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col s6">Nutrition Gap: {{ $result->nutrient_gap }}</div>
                        <div class="col s6">Application Rate: {{ $result->application_rate }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="s3">N: {{ $result->N }}</div>
                        <div class="s3">P: {{ $result->P }}</div>
                        <div class="s3">K: {{ $result->K }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        Recommendation: {{ $result->message }}
                    </div>
                </div>
            </div>
        @endisset
    </div>
@endsection
