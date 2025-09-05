<tr>
    <td>{{ $no }}</td>
    <td>
        {!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level) !!}
        @if ($menu->children->count() > 0)
            <b>{{ $menu->title }}</b> {{-- induk dibold --}}
        @else
            {{ $menu->title }}
        @endif
    </td>
</tr>

@if ($menu->children->count() > 0)
    @foreach ($menu->children as $child)
        @include('menu.row', ['menu' => $child, 'level' => $level + 1, 'no' => $no])
        @php $no++; @endphp
    @endforeach
@endif
