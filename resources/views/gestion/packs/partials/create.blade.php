<div class="row">
    <form method="POST" action="{{ route('packs.store') }}">
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
                                                <option value="{{ $profil->id }}">
                                                    {{ str_replace(' ', '', $profil->libelle) }}</option>
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
                                            <option value="{{ $item->id }}">{{ $item->duree }}</option>
                                        @endforeach
                                    @endisset
                                    {{-- <option value="3 mois">Trimestre</option>
                                    <option value="6 mois">Semestre</option>
                                    <option value="12 mois">Annee</option> --}}
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
                                                    <input value="{{ $type->id }}" name="type_pack" type="radio"
                                                           required/>
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
                                            <input value="SMS" name="canal" type="radio" required/>
                                            <span>SMS</span>
                                        </p>
                                    </label>
                                </div>
                                <div class="row">
                                    <label>
                                        <p>
                                            <input value="VOICE" name="canal" type="radio" required/>
                                            <span>VOICE</span>
                                        </p>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="min" type="number" class="validate" name="minproducteur" required>
                                <label class="active" for="min">Minimum de Cible</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="max" type="number" class="validate" name="maxproducteur" required>
                                <label class="active" for="max">Maximum de Cible</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="nombre" type="number" class="validate" name="nombre" required>
                                <label class="active" for="nombre">Nombre de Push</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="prix" type="number" class="validate" name="prix" required>
                                <label class="active" for="prix">Prix Unitaire</label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="input-field">
                                <label class="active" for="large-select-multi">Services</label>
                                <select id="large-select-multi" class="select2-size-lg browser-default"
                                        multiple="multiple"
                                        name="services[]" required>
                                    <option disabled>Choisisser les services</option>
                                    @isset($services)
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}--{{ $service->service }}">
                                                {{ $service->service }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">

                            <div class="input-field col s12">
                                <div class="row" id="load"></div>
                                <div class="col s12 display-flex justify-content-end mt-1">
                                    <button type="submit" class="btn indigo">
                                        Enregistrer
                                    </button>
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
