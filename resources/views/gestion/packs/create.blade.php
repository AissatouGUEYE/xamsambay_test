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
    @if (isset($pack))
        <li class="breadcrumb-item active" style="color:#ffe900">Modification Pack
        </li>
    @else
        <li class="breadcrumb-item active" style="color:#ffe900">Nouveau Pack
        </li>
    @endif

@endsection
@section('main_content')

    @if (isset($pack))
        {{-- Modification Pack Include --}}
        @include('gestion.packs.partials.edit')
    @else
        {{-- creation de pack --}}
        @include('gestion.packs.partials.create')
    @endif

@endsection
@section('other-js-script')

    <script>
        $(".max-length1").select2({
            dropdownAutoWidth: true,
            width: '100%',
            maximumSelectionLength: 8,
            placeholder: "Select maximum 8 items"
        });

        // Large
        $('.select2-size-lg').select2({
            dropdownAutoWidth: true,
            width: '100%',
            containerCssClass: 'select-lg'
        });

        // Small
        $('.select2-size-sm').select2({
            dropdownAutoWidth: true,
            width: '100%',
            containerCssClass: 'select-sm'
        });
    </script>
@endsection
