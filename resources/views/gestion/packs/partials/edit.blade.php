@php

    // $pack->service = (array) $pack->service;
    $desc = $pack->service;
    $desc = str_replace('{', '', $desc);
    $desc = str_replace('}', '', $desc);
    $desc = str_replace("\"", '', $desc);
    $desc = str_replace(' ', '', $desc);
    $desc = str_replace(':', ',', $desc);
    $array_desc = explode(',', $desc);
    $pack->service = $array_desc;
    // dd($profils);
    // dd($pack);

    $in = false;
@endphp
<div class="row">
    <form method="POST" action="{{ route('packs.update') }}">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-body">

                        <div class="row">
                            <div class="input-field col s6">
                                <label class="active" for="type_entite">Profil </label>
                                <select name="type_entite" required>
                                    <option value="" selected disabled> Choisir un profil *</option>
                                    @isset($profils)
                                        @foreach ($profils as $profil)
                                            @if ($profil->libelle != '')
                                                @if ($profil->nom_typentite == $pack->type_entite)
                                                    <option value="{{ $profil->id }}" selected>
                                                        {{ str_replace(' ', '', $profil->libelle) }}</option>
                                                @else
                                                    <option value="{{ $profil->id }}">
                                                        {{ str_replace(' ', '', $profil->libelle) }}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                            <div class="input-field col s6">
                                <label class="active" for="duree">Durée</label>
                                <select name="duree" id="" required>
                                    <option value="" selected disabled> Déterminer la durée du pack *</option>
                                    @isset($duree)
                                        @foreach ($duree as $item)
                                            @if ($pack->duree_pack == $item->duree)
                                                <option value="{{ $item->id }}" selected>{{ $item->duree }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->duree }}</option>
                                            @endif
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                @isset($typePacks)
                                    @foreach ($typePacks as $type)
                                        <div class="row">
                                            <label>
                                                <p>
                                                    @if ($pack->id_type_pack == $type->id)
                                                        <input value="{{ $type->id }}" name="type_pack" type="radio"
                                                            checked required />
                                                    @else
                                                        <input value="{{ $type->id }}" name="type_pack" type="radio"
                                                            required />
                                                    @endif
                                                    <span>{{ $type->type_pack }}</span>
                                                </p>
                                            </label>
                                        </div>
                                    @endforeach
                                @endisset
                            </div>
                            <div class="input-field col s6">
                                <div class="row">
                                    <label>
                                        <p>
                                            <input value="SMS" name="canal" type="radio"
                                                @if ($pack->canal == 'SMS') checked @endif required />
                                            <span>SMS</span>
                                        </p>
                                    </label>
                                </div>
                                <div class="row">
                                    <label>
                                        <p>
                                            <input value="VOICE" name="canal" type="radio"
                                                @if ($pack->canal == 'VOICE') checked @endif required />
                                            <span>VOICE</span>
                                        </p>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <input id="min" type="number" class="validate" name="minproducteur"
                                    value="{{ $pack->minproducteur }}" required>
                                <label class="active" for="min">Minimum de Cible</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="max" type="number" class="validate" name="maxproducteur"
                                    value="{{ $pack->maxproducteur }}" required>
                                <label class="active" for="max">Maximum de Cible</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="nombre" type="number" class="validate" name="nombre"
                                    value="{{ $pack->nombre }}" required>
                                <label class="active" for="nombre">Nombre de Push</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="prix" type="number" class="validate" name="prix"
                                    value="{{ $pack->pricing }}" required>
                                <label class="active" for="prix">Prix Unitaire</label>
                                <input id="idPack" type="number" class="validate" name="idPack"
                                    value="{{ $pack->id }}" hidden>
                            </div>
                        </div>
                        <br>
                        <div class="row ">
                            <div class="input-field">

                                <label class="active" for="select-multi">Services</label>
                                <select id="select-multi" class="select2-size-lg browser-default" multiple="multiple"
                                    name="services[]" required>
                                    <option disabled>Choisisser les services</option>
                                    @isset($services)
                                        @foreach ($services as $service)
                                            @php
                                                $in = false;
                                            @endphp
                                            @foreach ($pack->service as $key => $value)
                                                @if ($service->id == $value)
                                                    @php
                                                        $in = true;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($in)
                                                <option value="{{ $service->id }}--{{ $service->service }}" selected>
                                                    {{ $service->service }}</option>
                                            @else
                                                <option value="{{ $service->id }}--{{ $service->service }}">
                                                    {{ $service->service }}</option>
                                            @endif
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                        <br><br><br>
                        <div class="row">

                            <div class="input-field col s12">
                                <div class="row" id="load"></div>
                                <div class="col s12 display-flex justify-content-end mt-1">
                                    <button type="submit" class="btn indigo">
                                        Mettre à jour</button>
                                    {{-- <button type="button" class="ml-1 btn btn-light">Annuler</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
