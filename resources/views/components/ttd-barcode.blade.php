@props([
    'size' => '80',
    'id_pegawai' => null,
    'format' => 'png',
])
<span>
    @if ($format === 'svg')
        {{ QrCode::size($size)->generate(route('verify-ttd', $id_pegawai)) }}
    @else
        <img src="data:image/png;base64,{!! base64_encode(QrCode::format('png')->size($size)->generate(route('verify-ttd', $id_pegawai))) !!}">
    @endif
</span>
