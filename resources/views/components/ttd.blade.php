@props(['width' => '250'])
<div class="text-center">
    <img src="{{ Storage::url(Auth::user()->ttd->link) }}" width="{{ $width }}" alt="">
    <span class="text-sm">{{ Auth::user()->name }}</span>
</div>
