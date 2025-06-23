@props(['width' => '100%', 'maxHeight' => '80px'])

@if (Auth::user()?->ttd?->link)
    <img src="{{ Storage::url(Auth::user()->ttd->link) }}"
        style="
            display: block;
            margin: auto;
            width: {{ $width }};
            max-height: {{ $maxHeight }};
            object-fit: contain;
        "
        alt="Tanda Tangan" />
@endif
