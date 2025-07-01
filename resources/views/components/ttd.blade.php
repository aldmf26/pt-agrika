@props(['width' => '250'])
<div class="text-center">
    <div>
        <img src="{{ Storage::url(Auth::user()->ttd->link) }}" width="{{ $width }}" alt="">
    </div>
    <div>
        <span class="text-sm">{{ Auth::user()->name }}</span>
    </div>
</div>
