<div class="collapsible-body">
    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
        @foreach ($menu as $submenuChild)
            @php
                $custom_classes="";
                if (isset($submenuChild->class)) {
                    $custom_classes = $submenuChild->class;
                }
            @endphp
            <li class="{{ request()->is($submenuChild->url . '*') ? 'active' : '' }}">
                <a class="{{ $custom_classes }}{{ request()->is($submenuChild->url . '*') ? ' active' : '' }}"
                    href="@if ($submenuChild->url === 'javascript:void(0)') {{ $submenuChild->url }} @else{{ url($submenuChild->url) }} @endif"
                    {{-- class="{{$custom_classes}} {{(request()->is($submenu->url.'*')) ? 'active '.$configData['activeMenuColor'] : '' }}" --}}
                    @if (!empty($configData['activeMenuColor'])) {{ 'style=background:none;box-shadow:none;' }} @endif
                    {{ isset($submenuChild->newTab) ? 'target="_blank"' : '' }}>
                    <div class="d-flex justify-content-end">
                        <i class="material-icons">radio_button_unchecked</i>
                        <span data-i18n="{{ $submenuChild->i18n }}">{{ $submenuChild->name }}</span>
                    </div>
                </a>
                @if (isset($submenuChild->submenu_child))
                    @include('layouts.submenu_child', ['menu' => $submenuChild->submenu_child])
                @endif
            </li>
        @endforeach
    </ul>
</div>
