@props(['width' => '250'])
<div class="text-center">
    <div>
        @if (empty(Auth::user()->ttd))
            &nbsp;
        @else
            <img src="{{ Storage::url(Auth::user()->ttd->link) }}" width="{{ $width }}" alt="">
        @endif
    </div>
    <div>
        <span class="text-sm">( {{ Auth::user()->name }} )</span>
    </div>
</div>
