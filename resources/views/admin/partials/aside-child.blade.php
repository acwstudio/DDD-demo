@foreach($children as $child)

    <ul class="nav nav-treeview">
        <li class="nav-item {{ $child->level === 1 ? 'has-treeview ' . $child->open : '' }}">
            <a href="{{ $child->level === 1 ? '' : route($child->route ?? '') }}"
{{--            <a href="#"--}}
               class="nav-link {{ $child->level === 1 ? '' : $child->state . ' ' . $child->active }}">
                <i class="{{ $child->level === 1 ? 'fas' : 'far' }} fa-circle nav-icon"></i>
                <p>{{ $child->item }}
                    @if($child->level === 1)
                        <i class="right fas fa-angle-left"></i>
                        @else
                    <span class="right badge {{ $child->badgeColor }}">{{ $child->badgeText }}</span>
                    @endif
                </p>
            </a>
            @if(count($menu->children))
                @include('admin.partials.aside-child', ['children' => $child->children])
            @endif
        </li>
    </ul>

@endforeach
