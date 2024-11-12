@extends('layouts.master')
@section('page-title')
    Services Alertes
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('alertes') }}">Alertes</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#" style="color:#ffe900">Creation Liste Diffusion</a>
    </li>
@endsection
@section('main_content')
    <div class="users-list-table">
        <div class="card">
            <div class="card-header">
                <h5 class="pt-2 ml-3">Alertes Diffusion</h5>
            </div>
            <div class="card-content">
                <h4>Nouvelle liste de diffusion</h4>
                <div class="divider mt-2"></div>
                <form method="POST" action="{{ route('alertes.diffusion.create') }}">
                    @csrf
                    <div class="row">
                        <div class="col s12">
                            <div class="input-field">
                                <input type="text" name="libelle" id="libelle">
                                <label class="active" for="libelle">Nom Liste Diffusion</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="input-field">
                                <input type="text" name="description" id="description">
                                <label class="active" for="description">Description</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6 l12">
                            <button type="submit"
                                class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
