@props([
    'size' => '80',
    'id_pegawai' => null,
    'format' => 'svg',
])
<span>
<<<<<<< Updated upstream
    <img src="data:image/svg;base64,{!! base64_encode(QrCode::format('svg')->size($size)->generate(route('verify-ttd', $id_pegawai))) !!}" width="{{ $size }}" height="{{ $size }}">
=======
    <img src="data:image/{{ $format }};base64,{!! base64_encode(QrCode::format($format)->size($size)->generate(route('verify-ttd', $id_pegawai))) !!}" width="{{ $size }}"
        height="{{ $size }}">
>>>>>>> Stashed changes
</span>
{{-- {{ QrCode::size($size)->generate(route('verify-ttd', $id_pegawai)) }} --}}
