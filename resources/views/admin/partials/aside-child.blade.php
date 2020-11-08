@foreach($children as $child)

    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route($child->route ?? '') }}"
               class="nav-link {{ $child->state }} {{ $child->active }}">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ $child->item }}
                    <span class="right badge {{ $child->badgeColor }}">{{ $child->badgeText }}</span>
                </p>
            </a>
        </li>
    </ul>

@endforeach
