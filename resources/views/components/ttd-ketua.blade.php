@props(['userId', 'width' => '250'])
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
    <div>
        <span class="text-sm">{{ \App\Models\User::find($userId)->name }}</span>
    </div>
</div>
