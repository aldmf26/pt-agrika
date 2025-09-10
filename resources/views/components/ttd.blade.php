@props(['width' => '250', 'jabatan' => null])
<div class="text-center">
    <div>
        @if (empty(Auth::user()->ttd))
            &nbsp;
        @else
            <img src="{{ Storage::url(Auth::user()->ttd->link) }}" width="{{ $width }}" alt="">
        @endif
    </div>
    <div style="margin-top: -10px;">
        <div style="position: relative; opacity: 0.5; font-size: 9px">ttd + nama</div>
        <span style="font-size: 12px">{{ Auth::user()->name }}</span>
        <br>
        <span class="text-sm">({{ strtoupper($jabatan) }})</span>
    </div>
</div>
