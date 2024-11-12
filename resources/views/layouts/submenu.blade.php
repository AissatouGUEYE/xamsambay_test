<div class="collapsible-body">
    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
        @foreach ($menu as $submenu)
            @php
                $custom_classes="";
                if (isset($submenu->class)) {
                    $custom_classes = $submenu->class;
                }
            @endphp
            <li class="{{ request()->is($submenu->url . '*') ? 'active' : '' }}">
                <a class="{{ $custom_classes }}{{ request()->is($submenu->url . '*') ? ' active' : '' }}"
                    href="@if ($submenu->url === 'javascript:void(0)') {{ $submenu->url }} @else{{ url($submenu->url) }} @endif"
                    {{-- class="{{$custom_classes}} {{(request()->is($submenu->url.'*')) ? 'active '.$configData['activeMenuColor'] : '' }}" --}}
                    @if (!empty($configData['activeMenuColor'])) {{ 'style=background:none;box-shadow:none;' }} @endif
                    {{ isset($submenu->newTab) ? 'target="_blank"' : '' }}>
                    <i class="material-icons">radio_button_unchecked</i>
                    <span data-i18n="{{ $submenu->i18n }}">{{ $submenu->name }}</span>
                </a>
                @if (isset($submenu->submenu_child))
                    @include('layouts.submenu_child', ['menu' => $submenu->submenu_child])
                @endif
            </li>
        @endforeach
    </ul>
</div>
