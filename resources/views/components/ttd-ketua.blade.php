@props(['userId', 'width' => '250', 'jabatan' => null])
<div class="text-center">
    <div>
        @php
            $ttd = \App\Models\Ttd::where('user_id', $userId)->first();
        @endphp
        @if (empty($ttd))
            &nbsp;
        @else
            <img src="{{ Storage::url($ttd->link) }}" width="{{ $width }}" alt="">
        @endif
    </div>
    <div style="margin-top: -10px;">
        <div style="position: relative; opacity: 0.5">ttd + nama</div>

        <span style="font-size: 12px">{{ \App\Models\User::find($userId)->name }}</span>
        <br>
        <span class="text-sm">({{ strtoupper($jabatan) }})</span>
    </div>

    <div>
    </div>
</div>
