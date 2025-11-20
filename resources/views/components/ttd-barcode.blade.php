@props([
    'size' => '80',
    'id_pegawai' => null,
    'format' => 'svg',
])
<span>
    <img src="data:image/{{ $format }};base64,{!! base64_encode(QrCode::format($format)->size($size)->generate(route('verify-ttd', $id_pegawai))) !!}" width="{{ $size }}"
        height="{{ $size }}">
</span>
{{-- {{ QrCode::size($size)->generate(route('verify-ttd', $id_pegawai)) }} --}}
