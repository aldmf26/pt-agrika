@props(['datas'])

@php
    // Reset index Collection supaya dimulai dari 0
    $items = $datas->values();
    $total = max($items->count(), 5);
    $letters = range('a', 'z');
@endphp

<b>
    <u>
        Jumlah pengiriman dengan kuantitas yang tidak sesuai:
        {{ $items->count() ? $items->count() . ' kali pengiriman' : 'Belum ada pengiriman' }},
        yaitu:
    </u>
    <br>
</b>

@for ($i = 0; $i < $total; $i++)
    @php $letter = $letters[$i] ?? chr(97 + $i); @endphp

    @if (isset($items[$i]))
        {{-- Data tersedia --}}
        {{ $letter }}. Terjadi pada
        {{ \Carbon\Carbon::parse($items[$i]->tanggal_ketidaksesuaian)->format('d/m/y') }}
        - karena : {{ $items[$i]->alasan }}
    @else
        {{-- Placeholder kosong --}}
        {{ $letter }}.
    @endif
    <br>
@endfor
