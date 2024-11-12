<div class="layer-stretch">
    <div class="layer-wrapper pb-20">
        <div class="layer-ttl">
            <h4>LES <span class="vert-louma">ACTEURS</span> DE L'ECOSYSTEME</h4>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="panel panel-default">
                    <div class="panel-wrapper">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-12 related-product">
                                    <div class="owl-carousel owl-theme multi-item-slider">
                                        @isset($profils)
                                            @foreach ($profils as $key => $item)
                                                @if ($key % 2 == 0)
                                                    <div class="theme-owlslider-container text-center">
                                                        <div>
                                                            <a href="{{ route('packByActor', ['acteur' => $item->nom_typentite]) }}"
                                                               class="category-grid2  {{ $item->nom_typentite == $acteur ? 'active-carousel' : '' }}">
                                                                <div class="service-icon">
                                                                    <i
                                                                        class="fa {{ $item->icone }} text-success bg-white"></i>
                                                                </div>
                                                                <p class="title text-light">{{ $item->libelle }}</p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="theme-owlslider-container text-center">
                                                        <div>
                                                            <a href="{{ route('packByActor', ['acteur' => $item->nom_typentite]) }}"
                                                               class="category-grid2 {{ $item->nom_typentite == $acteur ? 'active-carousel' : '' }}">
                                                                <div class="service-icon">
                                                                    <i
                                                                        class="fa {{ $item->icone }} text-warning bg-white"></i>
                                                                </div>
                                                                <p class="title text-light">{{ $item->libelle }}</p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
